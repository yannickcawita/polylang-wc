<?php
/**
 * @package Polylang-WC
 */

/**
 * Manages the compatibility with Mix and Match Products.
 * Version tested: 1.2.6.
 *
 * It handles the synchronization of products metas
 * and the translation of the cart when the language is switched.
 *
 * @since 1.1
 */
class PLLWC_Mix_Match {
	/**
	 * An array of translated cart keys.
	 *
	 * @var array
	 */
	private $translated_cart_keys;

	/**
	 * Constructor.
	 * Setup filters.
	 *
	 * @since 1.1
	 */
	public function __construct() {
		// Product synchronization.
		add_filter( 'pllwc_copy_post_metas', array( $this, 'copy_product_metas' ) );
		add_filter( 'pllwc_translate_product_meta', array( $this, 'translate_product_meta' ), 10, 3 );

		// Cart.
		add_filter( 'pllwc_translate_cart_item', array( $this, 'translate_cart_item' ), 10, 2 );
		add_filter( 'pllwc_add_cart_item_data', array( $this, 'add_cart_item_data' ), 10, 2 );
		add_action( 'pllwc_translated_cart_item', array( $this, 'translated_cart_item' ), 10, 2 );
		add_filter( 'pllwc_translate_cart_contents', array( $this, 'translate_cart_contents' ) );
		add_action( 'woocommerce_cart_loaded_from_session', array( $this, 'cart_loaded_from_session' ), 20 ); // After PLLWC_Frontend_Cart.
	}

	/**
	 * Adds metas to synchronize when saving a product.
	 * Hooked to the filter 'pllwc_copy_post_metas'.
	 *
	 * @since 1.1
	 *
	 * @param string[] $metas List of custom fields names.
	 * @return string[]
	 */
	public function copy_product_metas( $metas ) {
		$to_sync = array(
			'_mnm_base_price',
			'_mnm_base_regular_price',
			'_mnm_base_sale_price',
			'_mnm_data',
			'_mnm_max_container_size',
			'_mnm_min_container_size',
			'_mnm_per_product_pricing',
			'_mnm_per_product_shipping',
		);

		return array_merge( $metas, array_combine( $to_sync, $to_sync ) );
	}

	/**
	 * Translates the Mix and Match contents.
	 * Hooked to the filter 'pllwc_translate_product_meta'.
	 *
	 * @since 1.1
	 *
	 * @param mixed  $value Meta value.
	 * @param string $key   Meta key.
	 * @param string $lang  Language of target.
	 * @return mixed
	 */
	public function translate_product_meta( $value, $key, $lang ) {
		if ( '_mnm_data' === $key ) {
			$data_store = PLLWC_Data_Store::load( 'product_language' );
			foreach ( $value as $id => $n ) {
				if ( $tr_id = $data_store->get( $id, $lang ) ) {
					$value[ $tr_id ] = $n;
					unset( $value[ $id ] );
				}
			}
		}
		return $value;
	}

	/**
	 * Translates items in the cart.
	 * Hooked to the filter 'pllwc_translate_cart_item'.
	 *
	 * @since 1.1
	 *
	 * @param array  $item Cart item.
	 * @param string $lang Language code.
	 * @return array
	 */
	public function translate_cart_item( $item, $lang = '' ) {
		if ( isset( $item['mnm_config'] ) ) {
			foreach ( $item['mnm_config'] as $id => $config ) {
				$data_store = PLLWC_Data_Store::load( 'product_language' );

				$orig_lang = $data_store->get_language( $config['product_id'] );

				$tr_id = $data_store->get( $config['product_id'], $lang );
				$config['product_id'] = $tr_id;

				if ( ! empty( $config['variation_id'] ) ) {
					$config['variation_id'] = $data_store->get( $config['variation_id'], $lang );
				}

				if ( ! empty( $config['variation'] ) ) {
					$config['variation'] = PLLWC()->cart->translate_attributes_in_cart( $config['variation'], $lang, $orig_lang );
				}

				$item['mnm_config'][ $tr_id ] = $config;
				unset( $item['mnm_config'][ $id ] );
			}
		}

		if ( isset( $item['mnm_contents'] ) ) {
			$item['mnm_contents'] = array();
		}

		if ( isset( $item['mnm_container'], $this->translated_cart_keys[ $item['mnm_container'] ] ) ) {
			$item['mnm_container'] = $this->translated_cart_keys[ $item['mnm_container'] ];
		}

		return $item;
	}

	/**
	 * Adds Mix and Match Product informations to the cart item data when translated.
	 * Hooked to the filter 'pllwc_add_cart_item_data'.
	 *
	 * @since 1.1
	 *
	 * @param array $cart_item_data Cart item data.
	 * @param array $item           Cart item.
	 * @return array
	 */
	public function add_cart_item_data( $cart_item_data, $item ) {
		$keys = array(
			'mnm_config',
			'mnm_contents',
			'mnm_container',
		);
		return array_merge( $cart_item_data, array_intersect_key( $item, array_flip( $keys ) ) );
	}

	/**
	 * Stores new cart keys as function of previous values.
	 * Later needed to restore the relationship between the Mix and Match product and contained products.
	 * Hooked to the action 'pllwc_translated_cart_item'.
	 *
	 * @since 1.1
	 *
	 * @param array  $item Cart item.
	 * @param string $key  Previous cart item key. The new key can be found in $item['key'].
	 * @return void
	 */
	public function translated_cart_item( $item, $key ) {
		$this->translated_cart_keys[ $key ] = $item['key'];
	}

	/**
	 * Assigns correct mnm_contents values to the Mix and Match product
	 * once the contained cart items have been translated.
	 * Hooked to the filter pllwc_translate_cart_contents.
	 *
	 * @since 1.1
	 *
	 * @param array $contents Cart contents.
	 * @return array
	 */
	public function translate_cart_contents( $contents ) {
		$mnm_container = array();

		foreach ( $contents as $cart_key => $item ) {
			if ( isset( $item['mnm_container'] ) ) {
				$mnm_container[ $cart_key ] = $item['mnm_container'];
			}
		}

		if ( ! empty( $mnm_container ) ) {
			foreach ( $contents as $cart_key => $item ) {
				if ( isset( $item['mnm_contents'] ) ) {
					$contents[ $cart_key ]['mnm_contents'] = array_keys( $mnm_container, $item['key'] );
				}
			}
		}

		return $contents;
	}

	/**
	 * Allows WooCommerce Mix and Match to filter the cart prices after the cart has been translated.
	 * We need to do it here as WooCommerce Mix and Match directly access to WC()->cart->cart_contents.
	 * Hooked to the action 'woocommerce_cart_loaded_from_session'.
	 *
	 * @since 1.1
	 *
	 * @return void
	 */
	public function cart_loaded_from_session() {
		foreach ( WC()->cart->cart_contents as $cart_key => $item ) {
			if ( ! empty( $item['data'] ) ) {
				WC()->cart->cart_contents[ $cart_key ] = WC_Mix_and_Match::instance()->cart->add_cart_item_filter( $item, $cart_key );
			}
		}
	}
}
