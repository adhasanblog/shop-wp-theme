<?php
get_header()
?>
<section id="slider" class="slider-element swiper_wrapper" style="height: 500px; ">
    <div class="slider-inner" style="height: 500px;">

        <div class="swiper-container swiper-parent">
            <div class="swiper-wrapper">

				<?php $slider = new WP_Query( array(
					'post_type'      => 'slider',
					'posts_per_page' => - 1
				) );

				if ( $slider->have_posts() ) :
					while ( $slider->have_posts() ) : $slider->the_post();

						?>
                        <div class="swiper-slide <?php esc_attr( the_field( 'style' ) ) ?>">
							<?php
							$title_description   = get_field( 'title_description' );
							$description         = get_field( 'description' );
							$style               = get_field( 'style' );
							$background_gradient = "0deg, rgba(213, 213, 214, 0.85), rgba(213, 213, 214, 0.85)";

							if ( $style ) {
								$background_gradient = "0deg, rgba(23, 22, 39, 0.55), rgba(23, 22, 39, 0.85)";
							}

							if ( $title_description || $description ) :
								?>
                                <div class="container">
                                    <div class="slider-caption slider-caption-center">
                                        <h2 data-animate="fadeInUp"><?php echo esc_html( $title_description ); ?></h2>
                                        <p class="d-none d-sm-block" data-animate="fadeInUp"
                                           data-delay="200"><?php echo esc_html( $description ); ?></p>
                                    </div>
                                </div>

							<?php
							endif;
							?>
                            <div class="swiper-slide-bg"
                                 style="background: linear-gradient(<?php echo esc_attr( $background_gradient ) ?>), url('<?php echo esc_url( the_field( 'image_slider' ) ); ?>');"></div>
                        </div>


					<?php

					endwhile;

				endif;

				wp_reset_postdata();


				?>
            </div>
            <div class="slider-arrow-left"><i class="icon-angle-left"></i></div>
            <div class="slider-arrow-right"><i class="icon-angle-right"></i></div>
            <div class="slide-number">
                <div class="slide-number-current"></div>
                <span>/</span>
                <div class="slide-number-total"></div>
            </div>
        </div>

    </div>
</section>

<section id="content">
    <div class="content-wrap">







        <div class="container clearfix">
            <div class="row align-items-stretch gutter-20 min-vh-60">
                <div class="col-md-8">

                    <div class="row align-items-stretch gutter-20 h-100">
                        <div class="col-md-6 min-vh-25 min-vh-md-0">
                            <a href="#" class="grid-inner d-block h-100" style="background-image: url('<?php echo esc_url(get_theme_file_uri('images/shop/banners/2.jpg'))?>');"></a>
                        </div>

                        <div class="col-md-6 min-vh-25 min-vh-md-0">
                            <a href="#" class="grid-inner d-block h-100" style="background-image: url('<?php echo esc_url(get_theme_file_uri('images/shop/banners/8.jpg'))?>'); background-position: right center;"></a>
                        </div>

                        <div class="col-md-12 min-vh-25 min-vh-md-0 pb-md-0">
                            <a href="#" class="grid-inner d-block h-100" style="background-image: url('<?php echo esc_url(get_theme_file_uri('images/shop/banners/4.jpg'))?>');"></a>
                        </div>
                    </div>

                </div>

                <div class="col-md-4 min-vh-50">
                    <a href="#" class="grid-inner d-block h-100" style="background-image: url('<?php echo esc_url(get_theme_file_uri('images/shop/banners/9.jpg'))?>'); background-position: center top;"></a>
                </div>
            </div>

            <div class="clear"></div>
            <div class="grid-filter-wrap">

                <!-- Portfolio Filter
				============================================= -->
                <ul class="grid-filter" data-container="#portfolio">
                    <li class="activeFilter"><a href="#" data-filter="*">Show All</a></li>

					<?php
					global $product;
					$args       = array(
						'taxonomy'   => 'product_cat',
						'hide_empty' => true,
					);
					$categories = get_categories( $args );

					foreach ( $categories as $category ) {
						$cat_link            = get_category_link( $category->term_id );
						$cat_name            = $category->name;
						$cat_slug            = $category->slug;
						$dataset_cat_product = '.pf-' . $cat_slug

						?>

                        <li><a href="#"
                               data-filter="<?php echo esc_attr( $dataset_cat_product ) ?>"><?php echo esc_html( $cat_name ) ?></a>
                        </li>


					<?php } ?>

                </ul><!-- .grid-filter end -->

                <div class="grid-shuffle rounded" data-container="#portfolio">
                    <i class="icon-random"></i>
                </div>

            </div>

            <!-- Portfolio Items
			============================================= -->
            <div id="portfolio" class="portfolio row grid-container gutter-20" data-layout="fitRows">

				<?php
				$args     = array(
					'post_type'      => 'product',
					'posts_per_page' => 8,
				);
				$products = new WC_Product_Query( $args );
				$products = $products->get_products();

				foreach ( $products as $product ) {
					$product_id = $product->get_id();
					$image      = $product->get_image();
					preg_match( '@src="([^"]+)"@', $image, $match );
					$image_url                 = array_pop( $match );
					$product_name              = $product->get_name();
					$product_short_description = $product->get_short_description();
					$product_description       = $product->get_description();
					$product_permalink         = $product->get_permalink();
					$product_price             = $product->get_price();
					$terms                     = wp_get_object_terms( $product_id, 'product_cat' );
					$cat_slug                  = '';
					$cat_name                  = '';
					foreach ( $terms as $term ) {
						$cat_slug = $term->slug;
						$cat_name = $term->name;
					}
					$product_dataset = 'pf-' . $cat_slug;

					?>
                    <!-- Portfolio Item: Start -->
                    <article
                            class="portfolio-item col-lg-3 col-md-4 col-sm-6 col-12 <?php echo esc_attr( $product_dataset ) ?>">
                        <!-- Grid Inner: Start -->
                        <div class="grid-inner">
                            <!-- Image: Start -->
                            <div class="portfolio-image"
                                 style="height: 210px; object-fit: cover; object-position: center">
                                <a href="<?php echo esc_url( $product_permalink ) ?>">
                                    <img src="<?php echo esc_url( $image_url ) ?>" alt="Open Imagination">
                                </a>
                                <!-- Overlay: Start -->
                                <div class="bg-overlay">
                                    <div class="bg-overlay-content dark" data-hover-animate="fadeIn">
                                        <a href="images/portfolio/full/1.jpg"
                                           class="overlay-trigger-icon bg-light text-dark"
                                           data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall"
                                           data-hover-speed="350" data-lightbox="image" title="Image"><i
                                                    class="icon-line-plus"></i></a>
                                        <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark"
                                           data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall"
                                           data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>
                                    </div>
                                    <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>
                                </div>
                                <!-- Overlay: End -->
                            </div>
                            <!-- Image: End -->
                            <!-- Decription: Start -->
                            <div class="portfolio-desc" style="height: 240px">
                                <h3 style="min-height: 100px;"><a href="portfolio-single.html"><?php echo esc_html( $product_name ) ?></a></h3>
                                <div class="product-price"><?php echo esc_html( number_format($product_price, 0, ',', '.') ) ?></div>
								<?php
								if ( ! $product->is_purchasable() ) {
									return;
								}

								echo wc_get_stock_html( $product ); // WPCS: XSS ok.

								if ( $product->is_in_stock() ) : ?>

									<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

                                    <form class="cart"
                                          action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>"
                                          method="post" enctype='multipart/form-data'>
										<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

										<?php
										do_action( 'woocommerce_before_add_to_cart_quantity' );

										woocommerce_quantity_input(
											array(
												'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
												'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
												'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(),
												// WPCS: CSRF ok, input var ok.
											)
										);

										do_action( 'woocommerce_after_add_to_cart_quantity' );
										?>

                                        <button type="submit" name="add-to-cart"
                                                value="<?php echo esc_attr( $product->get_id() ); ?>"
                                                class="single_add_to_cart_button button alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"><i class="icon-shopping-cart"></i></button>

										<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
                                    </form>

									<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

								<?php endif; ?>


                            </div>
                            <!-- Description: End -->
                        </div>
                        <!-- Grid Inner: End -->
                    </article>
                    <!-- Portfolio Item: End -->

				<?php } ?>

            </div>
        </div>

        <div class="section mb-0">
            <div class="container">

                <div class="row col-mb-50">
                    <div class="col-sm-6 col-lg-3">
                        <div class="feature-box fbox-plain fbox-dark fbox-sm">
                            <div class="fbox-icon">
                                <i class="icon-thumbs-up2"></i>
                            </div>
                            <div class="fbox-content">
                                <h3>100% Original</h3>
                                <p class="mt-0">We guarantee you the sale of Original Brands.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="feature-box fbox-plain fbox-dark fbox-sm">
                            <div class="fbox-icon">
                                <i class="icon-credit-cards"></i>
                            </div>
                            <div class="fbox-content">
                                <h3>Payment Options</h3>
                                <p class="mt-0">We accept Visa, MasterCard and American Express.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="feature-box fbox-plain fbox-dark fbox-sm">
                            <div class="fbox-icon">
                                <i class="icon-truck2"></i>
                            </div>
                            <div class="fbox-content">
                                <h3>Free Shipping</h3>
                                <p class="mt-0">Free Delivery to 100+ Locations on orders above $40.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="feature-box fbox-plain fbox-dark fbox-sm">
                            <div class="fbox-icon">
                                <i class="icon-undo"></i>
                            </div>
                            <div class="fbox-content">
                                <h3>30-Days Returns</h3>
                                <p class="mt-0">Return or exchange items purchased within 30 days.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</section><!-- #content end -->


<?php
get_footer()
?>
