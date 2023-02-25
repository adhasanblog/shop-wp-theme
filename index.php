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
                            <a href="#" class="grid-inner d-block h-100"
                               style="background-image: url('<?php echo esc_url( get_theme_file_uri( 'images/shop/banners/2.jpg' ) ) ?>');"></a>
                        </div>

                        <div class="col-md-6 min-vh-25 min-vh-md-0">
                            <a href="#" class="grid-inner d-block h-100"
                               style="background-image: url('<?php echo esc_url( get_theme_file_uri( 'images/shop/banners/8.jpg' ) ) ?>'); background-position: right center;"></a>
                        </div>

                        <div class="col-md-12 min-vh-25 min-vh-md-0 pb-md-0">
                            <a href="#" class="grid-inner d-block h-100"
                               style="background-image: url('<?php echo esc_url( get_theme_file_uri( 'images/shop/banners/4.jpg' ) ) ?>');"></a>
                        </div>
                    </div>

                </div>

                <div class="col-md-4 min-vh-50">
                    <a href="#" class="grid-inner d-block h-100"
                       style="background-image: url('<?php echo esc_url( get_theme_file_uri( 'images/shop/banners/9.jpg' ) ) ?>'); background-position: center top;"></a>
                </div>
            </div>

            <div class="clear"></div>

            <div id="shop" class="shop row grid-container gutter-30" data-layout="fitRows">

				<?php
				$args     = array(
					'post_type'      => 'product',
					'posts_per_page' => 8,
				);
				$products = new WC_Product_Query( $args );
				$products = $products->get_products();

				foreach ( $products as $product ) {
					$product_id                = $product->get_id();
					$product_image_id          = get_post_thumbnail_id( $product_id );
					$product_image_url         = get_the_post_thumbnail_url( $product_id );
					$product_image_alt         = get_post_meta( $product_image_id, '_wp_attachment_image_alt', true );
					$product_name              = $product->get_name();
					$product_short_description = $product->get_short_description();
					$product_description       = $product->get_description();
					$product_permalink         = $product->get_permalink();
					$product_regular_price     = $product->get_regular_price();
					$product_sale_price        = $product->get_sale_price();
					$terms                     = wp_get_object_terms( $product_id, 'product_cat' );
					$cat_slug                  = '';
					$cat_name                  = '';
					foreach ( $terms as $term ) {
						$cat_slug = $term->slug;
						$cat_name = $term->name;
					}
					$product_dataset = 'pf-' . $cat_slug;
					?>


                    <div class="product col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="grid-inner">
                            <div class="product-image">
                                <a href="#"><img style="height: 210px; object-position: center; object-fit: cover;"
                                                 src="<?php echo esc_url( $product_image_url ) ?>"
                                                 alt="<?php echo esc_attr( $product_image_alt ) ?>"></a>
                                <a href="#"><img style="height: 210px; object-position: center; object-fit: cover;"
                                                 src="<?php echo esc_url( $product_image_url ) ?>"
                                                 alt="<?php echo esc_attr( $product_image_alt ) ?>  "></a>

								<?php if ( ! $product->is_in_stock() ) : ?>
                                    <div class="sale-flash badge bg-secondary p-2">Out of Stock</div>
								<?php endif; ?>
                            </div>
                            <div class="product-desc">
                                <div class="product-title" style="height: 90px;"><h3><a
                                                href="<?php echo esc_url( $product_permalink ) ?>"><?php echo esc_html( $product_name ) ?></a>
                                    </h3></div>
                                <div class="product-price">

									<?php if ( $product_sale_price ) : ?>

                                        <del><?php echo( wc_price( $product_regular_price ) ) ?></del>
                                        <ins><?php echo( wc_price( $product_sale_price ) ) ?></ins>

									<?php else : ?>

                                        <ins><?php echo( wc_price( $product_regular_price ) ) ?></ins>


									<?php endif; ?>


                                </div>
                                <div class="product-rating">
                                    <i class="icon-star3"></i>
                                    <i class="icon-star3"></i>
                                    <i class="icon-star3"></i>
                                    <i class="icon-star3"></i>
                                    <i class="icon-star-half-full"></i>
                                </div>
                            </div>
                        </div>
                    </div>
				<?php } ?>
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
