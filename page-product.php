<?php
get_header();
?>

<section id="content">
	<div class="content-wrap">
		<div class="container clearfix">
			<div class="row gutter-40 col-mb-80">
                <!-- Post Content
						  ============================================= -->
                <div class="postcontent col-lg-9 order-lg-last">
                    <!-- Shop
								============================================= -->
                    <div
                            id="shop"
                            class="shop row grid-container gutter-20"
                            data-layout="fitRows">


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
                            <div class="product col-md-4 col-sm-6 col-12">
                                <div class="grid-inner">
                                    <div class="product-image">
                                        <a href="#"
                                        ><img
                                                    src="<?php echo esc_url( $image_url ) ?>"
                                                    alt="Checked Short Dress"
                                            /></a>
                                        <a href="#"
                                        ><img
                                                    src="<?php echo esc_url( $image_url ) ?>"
                                                    alt="Checked Short Dress"
                                            /></a>
                                        <div class="sale-flash badge bg-secondary p-2">
                                            Out of Stock
                                        </div>
                                        <div class="bg-overlay">
                                            <div
                                                    class="bg-overlay-content align-items-end justify-content-between"
                                                    data-hover-animate="fadeIn"
                                                    data-hover-speed="400">
                                                <a href="#" class="btn btn-dark me-2"
                                                ><i class="icon-shopping-cart"></i
                                                    ></a>
                                                <a
                                                        href="include/ajax/shop-item.html"
                                                        class="btn btn-dark"
                                                        data-lightbox="ajax"
                                                ><i class="icon-line-expand"></i
                                                    ></a>
                                            </div>
                                            <div class="bg-overlay-bg bg-transparent"></div>
                                        </div>
                                    </div>
                                    <div class="product-desc">
                                        <div class="product-title">
                                            <h3><a href="#"><?php echo esc_html( $product_name ) ?></a></h3>
                                        </div>
                                        <div class="product-price">
                                            <del><?php echo esc_html( number_format($product_price, 0, ',', '.') ) ?></del> <ins><?php echo esc_html( number_format($product_price, 0, ',', '.') ) ?></ins>
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
                    <!-- #shop end -->
                </div>
                <!-- .postcontent end -->

                <!-- Sidebar
						  ============================================= -->
                <div class="sidebar col-lg-3">
                    <div class="sidebar-widgets-wrap">
                        <div class="widget widget_links clearfix">
                            <h4>Shop Categories</h4>
                            <ul>
                                <li><a href="#">Shirts</a></li>
                                <li><a href="#">Pants</a></li>
                                <li><a href="#">Tshirts</a></li>
                                <li><a href="#">Sunglasses</a></li>
                                <li><a href="#">Shoes</a></li>
                                <li><a href="#">Bags</a></li>
                                <li><a href="#">Watches</a></li>
                            </ul>
                        </div>

                        <div class="widget clearfix">
                            <h4>Recent Items</h4>
                            <div
                                    class="posts-sm row col-mb-30"
                                    id="recent-shop-list-sidebar">
                                <div class="entry col-12">
                                    <div class="grid-inner row g-0">
                                        <div class="col-auto">
                                            <div class="entry-image">
                                                <a href="#"
                                                ><img src="images/shop/small/1.jpg" alt="Image"
                                                    /></a>
                                            </div>
                                        </div>
                                        <div class="col ps-3">
                                            <div class="entry-title">
                                                <h4><a href="#">Blue Round-Neck Tshirt</a></h4>
                                            </div>
                                            <div class="entry-meta no-separator">
                                                <ul>
                                                    <li class="color">$29.99</li>
                                                    <li>
                                                        <i class="icon-star3"></i
                                                        ><i class="icon-star3"></i
                                                        ><i class="icon-star3"></i
                                                        ><i class="icon-star3"></i
                                                        ><i class="icon-star-half-full"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="entry col-12">
                                    <div class="grid-inner row g-0">
                                        <div class="col-auto">
                                            <div class="entry-image">
                                                <a href="#"
                                                ><img src="images/shop/small/6.jpg" alt="Image"
                                                    /></a>
                                            </div>
                                        </div>
                                        <div class="col ps-3">
                                            <div class="entry-title">
                                                <h4><a href="#">Checked Short Dress</a></h4>
                                            </div>
                                            <div class="entry-meta no-separator">
                                                <ul>
                                                    <li class="color">$23.99</li>
                                                    <li>
                                                        <i class="icon-star3"></i
                                                        ><i class="icon-star3"></i
                                                        ><i class="icon-star3"></i
                                                        ><i class="icon-star-half-full"></i
                                                        ><i class="icon-star-empty"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="entry col-12">
                                    <div class="grid-inner row g-0">
                                        <div class="col-auto">
                                            <div class="entry-image">
                                                <a href="#"
                                                ><img src="images/shop/small/7.jpg" alt="Image"
                                                    /></a>
                                            </div>
                                        </div>
                                        <div class="col ps-3">
                                            <div class="entry-title">
                                                <h4><a href="#">Light Blue Denim Dress</a></h4>
                                            </div>
                                            <div class="entry-meta no-separator">
                                                <ul>
                                                    <li class="color">$19.99</li>
                                                    <li>
                                                        <i class="icon-star3"></i
                                                        ><i class="icon-star3"></i
                                                        ><i class="icon-star3"></i
                                                        ><i class="icon-star-empty"></i
                                                        ><i class="icon-star-empty"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="widget clearfix">
                            <h4>Last Viewed Items</h4>
                            <div
                                    class="posts-sm row col-mb-30"
                                    id="last-viewed-shop-list-sidebar">
                                <div class="entry col-12">
                                    <div class="grid-inner row g-0">
                                        <div class="col-auto">
                                            <div class="entry-image">
                                                <a href="#"
                                                ><img src="images/shop/small/3.jpg" alt="Image"
                                                    /></a>
                                            </div>
                                        </div>
                                        <div class="col ps-3">
                                            <div class="entry-title">
                                                <h4><a href="#">Round-Neck Tshirt</a></h4>
                                            </div>
                                            <div class="entry-meta no-separator">
                                                <ul>
                                                    <li class="color">$15</li>
                                                    <li>
                                                        <i class="icon-star3"></i
                                                        ><i class="icon-star3"></i
                                                        ><i class="icon-star3"></i
                                                        ><i class="icon-star3"></i
                                                        ><i class="icon-star3"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="entry col-12">
                                    <div class="grid-inner row g-0">
                                        <div class="col-auto">
                                            <div class="entry-image">
                                                <a href="#"
                                                ><img
                                                            src="images/shop/small/10.jpg"
                                                            alt="Image"
                                                    /></a>
                                            </div>
                                        </div>
                                        <div class="col ps-3">
                                            <div class="entry-title">
                                                <h4><a href="#">Green Trousers</a></h4>
                                            </div>
                                            <div class="entry-meta no-separator">
                                                <ul>
                                                    <li class="color">$19</li>
                                                    <li>
                                                        <i class="icon-star3"></i
                                                        ><i class="icon-star3"></i
                                                        ><i class="icon-star-empty"></i
                                                        ><i class="icon-star-empty"></i
                                                        ><i class="icon-star-empty"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="entry col-12">
                                    <div class="grid-inner row g-0">
                                        <div class="col-auto">
                                            <div class="entry-image">
                                                <a href="#"
                                                ><img
                                                            src="images/shop/small/11.jpg"
                                                            alt="Image"
                                                    /></a>
                                            </div>
                                        </div>
                                        <div class="col ps-3">
                                            <div class="entry-title">
                                                <h4><a href="#">Silver Chrome Watch</a></h4>
                                            </div>
                                            <div class="entry-meta no-separator">
                                                <ul>
                                                    <li class="color">$34.99</li>
                                                    <li>
                                                        <i class="icon-star3"></i
                                                        ><i class="icon-star3"></i
                                                        ><i class="icon-star3"></i
                                                        ><i class="icon-star-half-full"></i
                                                        ><i class="icon-star-empty"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="widget clearfix">
                            <h4>Popular Items</h4>
                            <div
                                    class="posts-sm row col-mb-30"
                                    id="popular-shop-list-sidebar">
                                <div class="entry col-12">
                                    <div class="grid-inner row g-0">
                                        <div class="col-auto">
                                            <div class="entry-image">
                                                <a href="#"
                                                ><img src="images/shop/small/8.jpg" alt="Image"
                                                    /></a>
                                            </div>
                                        </div>
                                        <div class="col ps-3">
                                            <div class="entry-title">
                                                <h4><a href="#">Pink Printed Dress</a></h4>
                                            </div>
                                            <div class="entry-meta no-separator">
                                                <ul>
                                                    <li class="color">$21</li>
                                                    <li>
                                                        <i class="icon-star3"></i
                                                        ><i class="icon-star3"></i
                                                        ><i class="icon-star3"></i
                                                        ><i class="icon-star3"></i
                                                        ><i class="icon-star-half-full"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="entry col-12">
                                    <div class="grid-inner row g-0">
                                        <div class="col-auto">
                                            <div class="entry-image">
                                                <a href="#"
                                                ><img src="images/shop/small/5.jpg" alt="Image"
                                                    /></a>
                                            </div>
                                        </div>
                                        <div class="col ps-3">
                                            <div class="entry-title">
                                                <h4><a href="#">Blue Round-Neck Tshirt</a></h4>
                                            </div>
                                            <div class="entry-meta no-separator">
                                                <ul>
                                                    <li class="color">$19.99</li>
                                                    <li>
                                                        <i class="icon-star3"></i
                                                        ><i class="icon-star3"></i
                                                        ><i class="icon-star3"></i
                                                        ><i class="icon-star-empty"></i
                                                        ><i class="icon-star-empty"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="entry col-12">
                                    <div class="grid-inner row g-0">
                                        <div class="col-auto">
                                            <div class="entry-image">
                                                <a href="#"
                                                ><img
                                                            src="images/shop/small/12.jpg"
                                                            alt="Image"
                                                    /></a>
                                            </div>
                                        </div>
                                        <div class="col ps-3">
                                            <div class="entry-title">
                                                <h4><a href="#">Men Aviator Sunglasses</a></h4>
                                            </div>
                                            <div class="entry-meta no-separator">
                                                <ul>
                                                    <li class="color">$14.99</li>
                                                    <li>
                                                        <i class="icon-star3"></i
                                                        ><i class="icon-star3"></i
                                                        ><i class="icon-star-half-full"></i
                                                        ><i class="icon-star-empty"></i
                                                        ><i class="icon-star-empty"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="widget clearfix">
                            <iframe
                                    src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FEnvato&amp;width=240&amp;height=290&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true&amp;appId=499481203443583"
                                    style="
                        border: none;
                        overflow: hidden;
                        width: 100% !important;
                        height: 290px;
                      "></iframe>
                        </div>

                        <div class="widget subscribe-widget clearfix">
                            <h4>Subscribe For Latest Offers</h4>
                            <h5>
                                Subscribe to Our Newsletter to get Important News, Amazing
                                Offers &amp; Inside Scoops:
                            </h5>
                            <form action="#" class="my-0">
                                <div class="input-group mx-auto">
                                    <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Enter your Email"
                                            required="" />
                                    <button class="btn btn-success" type="submit">
                                        <i class="icon-email2"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="widget clearfix">
                            <div
                                    id="oc-clients-full"
                                    class="owl-carousel image-carousel carousel-widget"
                                    data-items="1"
                                    data-margin="10"
                                    data-loop="true"
                                    data-nav="false"
                                    data-autoplay="5000"
                                    data-pagi="false">
                                <div class="oc-item">
                                    <a href="#"
                                    ><img src="images/clients/1.png" alt="Clients"
                                        /></a>
                                </div>
                                <div class="oc-item">
                                    <a href="#"
                                    ><img src="images/clients/2.png" alt="Clients"
                                        /></a>
                                </div>
                                <div class="oc-item">
                                    <a href="#"
                                    ><img src="images/clients/3.png" alt="Clients"
                                        /></a>
                                </div>
                                <div class="oc-item">
                                    <a href="#"
                                    ><img src="images/clients/4.png" alt="Clients"
                                        /></a>
                                </div>
                                <div class="oc-item">
                                    <a href="#"
                                    ><img src="images/clients/5.png" alt="Clients"
                                        /></a>
                                </div>
                                <div class="oc-item">
                                    <a href="#"
                                    ><img src="images/clients/6.png" alt="Clients"
                                        /></a>
                                </div>
                                <div class="oc-item">
                                    <a href="#"
                                    ><img src="images/clients/7.png" alt="Clients"
                                        /></a>
                                </div>
                                <div class="oc-item">
                                    <a href="#"
                                    ><img src="images/clients/8.png" alt="Clients"
                                        /></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- .sidebar end -->
            </div>
		</div>
	</div>
</section>

<?php
get_footer();
?>

