<?php
get_header()
?>

<section id="content">
    <div class="content-wrap">
        <div class="container">
			<?php defined( 'ABSPATH' ) || exit; ?>
			<?php do_action( 'woocommerce_before_cart' ); ?>

            <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
				<?php do_action( 'woocommerce_before_cart_table' ); ?>
                <table class="table cart mb-5">
                    <thead>
                    <tr>
                        <th class="cart-product-remove">&nbsp;</th>
                        <th class="cart-product-thumbnail">&nbsp;</th>
                        <th class="cart-product-name">Product</th>
                        <th class="cart-product-price">Unit Price</th>
                        <th class="cart-product-quantity">Quantity</th>
                        <th class="cart-product-subtotal">Total</th>
                    </tr>
                    </thead>
                    <tbody>
					<?php do_action( 'woocommerce_before_cart_contents' ); ?>

					<?php
					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
						?>
                        <tr class="cart_item">
                            <td class="cart-product-remove">
	                            <?php
	                            echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		                            'woocommerce_cart_item_remove_link',
		                            sprintf(
			                            '<a href="%s" class="remove" title="Remove this item" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="icon-trash2"></i></a>',
			                            esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
			                            esc_html__( 'Remove this item', 'woocommerce' ),
			                            esc_attr( $product_id ),
			                            esc_attr( $_product->get_sku() )
		                            ),
		                            $cart_item_key
	                            );
	                            ?>

                            </td>

                            <td class="cart-product-thumbnail">
                                <a href="#">
									<?php echo $_product->get_image() ?>
                                </a>
                            </td>

                            <td class="cart-product-name">
                                <a href="<?php echo esc_url( $_product->get_permalink() ) ?>"><?php echo esc_html( $_product->get_title() ) ?></a>
                            </td>

                            <td class="cart-product-price">
                                <span class="amount"><?php echo wc_price( $_product->get_price() ) ?></span>
                            </td>

                            <td class="cart-product-quantity">

                                <div class="quantity">
                                    <button type="button" class="minus">-</button>
									<?php

									$product_quantity = woocommerce_quantity_input(
										array(
											'input_name'   => "cart[{$cart_item_key}][qty]",
											'input_value'  => $cart_item['quantity'],
											'product_name' => $_product->get_name(),
										),
										$_product,
										false
									);

									echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
									?>
                                    <button type="button" class="plus">+</button>
                                </div>
                            </td>

                            <td class="cart-product-subtotal">
                                <span class="amount"><?php echo wc_price( $_product->get_price() * $cart_item['quantity'] ) ?></span>
                            </td>
                        </tr>

					<?php } ?>
                    <tr class="cart_item">
                        <td colspan="6">
                            <div class="row justify-content-between py-2 col-mb-30">

								<?php if ( wc_coupons_enabled() ) { ?>

                                    <div class="col-lg-auto ps-lg-0 ">
                                        <div class="row">
                                            <div class="col-md-8 coupon">
                                                <input type="text" name="coupon_code" id="coupon_code" value=""
                                                       class=" input-text sm-form-control text-center text-md-start"
                                                       placeholder="Enter Coupon Code.."/>
                                            </div>
                                            <div class="col-md-4 mt-3 mt-md-0">
                                                <button type="submit" name="apply_coupon" href="#"
                                                        class="button button-3d button-black m-0"
                                                        value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
												<?php do_action( 'woocommerce_cart_coupon' ); ?>
                                            </div>
                                        </div>
                                    </div>

								<?php } ?>

                                <div class="col-lg-auto pe-lg-0">
                                    <button type="submit"
                                            class="button button-3d m-0<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"
                                            name="update_cart"
                                            value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
									<?php do_action( 'woocommerce_cart_actions' ); ?>
									<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>

                                    <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="button button-3d mt-2 mt-sm-0 me-0"><?php esc_html_e( 'Proceed to checkout', 'woocommerce' ); ?></a>

                                </div>
                            </div>
                        </td>
                    </tr>

                    </tbody>

                </table>
				<?php do_action( 'woocommerce_after_cart_contents' ); ?>


            <div class="row col-mb-30">
                <div class="col-lg-6" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
                    <h4>Calculate Shipping</h4>
						<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_country', true ) ) : ?>
                            <div class="col-12 form-group">
                                <select name="calc_shipping_country" id="calc_shipping_country"
                                        class="sm-form-control country_to_state country_select" rel="calc_shipping_state">
                                    <option value="default"><?php esc_html_e( 'Select a country / region&hellip;', 'woocommerce' ); ?></option>
									<?php
									foreach ( WC()->countries->get_shipping_countries() as $key => $value ) {
										echo '<option value="' . esc_attr( $key ) . '"' . selected( WC()->customer->get_shipping_country(), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
									}
									?>
                                </select>

                            </div>
						<?php endif; ?>
						<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_state', true ) ) : ?>
                            <div class="col-12 form-group">
								<?php
								$current_cc = WC()->customer->get_shipping_country();
								$current_r  = WC()->customer->get_shipping_state();
								$states     = WC()->countries->get_states( $current_cc );

								if ( is_array( $states ) && empty( $states ) ) {
									?>
                                    <input type="hidden" name="calc_shipping_state" id="calc_shipping_state"
                                           placeholder="<?php esc_attr_e( 'State / County', 'woocommerce' ); ?>"/>
								<?php } elseif ( is_array( $states ) ) { ?>
                                    <span>
                            <select  name="calc_shipping_country" id="calc_shipping_country"
                                    class=" country_to_state country_select " rel="calc_shipping_state">
                               <option value=""><?php esc_html_e( 'Select an option&hellip;', 'woocommerce' ); ?></option>
							<?php
							foreach ( $states as $ckey => $cvalue ) {
								echo '<option value="' . esc_attr( $ckey ) . '" ' . selected( $current_r, $ckey, false ) . '>' . esc_html( $cvalue ) . '</option>';
							}
							?>
                            </select>
</span>
								<?php } else { ?>
                                    <label for="calc_shipping_state"
                                           class="screen-reader-text"><?php esc_html_e( 'State / County:', 'woocommerce' ); ?></label>
                                    <input type="text" class="input-text" value="<?php echo esc_attr( $current_r ); ?>"
                                           placeholder="<?php esc_attr_e( 'State / County', 'woocommerce' ); ?>"
                                           name="calc_shipping_state" id="calc_shipping_state"/>
								<?php } ?>
                            </div>
						<?php endif; ?>
	                    <?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_city', true ) ) : ?>

                        <div class="col-6 form-group">
                                <input type="text" class="sm-form-control" placeholder="Kota / Kabupaten" name="calc_shipping_city" id="calc_shipping_city" />
                        </div>
	                    <?php endif; ?>
	                    <?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_postcode', true ) ) : ?>

                        <div class="col-6 form-group">
                            <input type="text" class="sm-form-control" placeholder="Kode Pos" name="calc_shipping_postcode" id="calc_shipping_postcode"/>
                        </div>
	                    <?php endif; ?>
                        <div class="col-12 form-group">
                            <button type="submit" name="calc_shipping" value="1" class="button-3d m-0 button-black button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"><?php esc_html_e( 'Update', 'woocommerce' ); ?></button>
	                        <?php wp_nonce_field( 'woocommerce-shipping-calculator', 'woocommerce-shipping-calculator-nonce' ); ?>

                        </div>
                    </form>
	                <?php do_action( 'woocommerce_after_shipping_calculator' ); ?>

                </div>

                <div class="col-lg-6">
                    <h4>Cart Totals</h4>

                    <div class="table-responsive">
                        <table class="table cart cart-totals">
                            <tbody>

                            <tr class="cart_item">
                                <td class="cart-product-name">
                                    <strong><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></strong>
                                </td>

                                <td class="cart-product-name"
                                    data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
									<?php echo WC()->cart->get_cart_subtotal() ?>
                                </td>

                            </tr>
							<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                                <tr class="cart_item coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                                    <td class="cart-product-name">
                                        <strong><?php wc_cart_totals_coupon_label( $coupon ); ?></strong>
                                    </td>

                                    <td class="cart-product-name"
                                        data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>">
										<?php wc_cart_totals_coupon_html( $coupon ); ?>
                                    </td>

                                </tr>
							<?php endforeach; ?>


                            <tr class="cart_item">
                                <td class="cart-product-name">
                                    <strong><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></strong>
                                </td>

                                <td class="cart-product-name">
                                    <span class="amount"><?php woocommerce_shipping_calculator(); ?></span>
                                </td>
                            </tr>
                            <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

                            <tr class="cart_item">
                                <td class="cart-product-name">
                                    <strong><?php esc_html_e( 'Total', 'woocommerce' ); ?></strong>
                                </td>

                                <td class="cart-product-name" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>">
                                    <span class="amount color lead"><strong><?php wc_cart_totals_order_total_html(); ?></strong></span>
                                </td>
                            </tr>

                            <?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section><!-- #content end -->


<?php
get_footer()
?>

