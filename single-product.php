<?php
get_header();
global $product;
?>


<?php
while ( have_posts() ) : the_post();

	$product_image_id  = get_post_thumbnail_id();
	$product_image_url = wp_get_attachment_url( $product_image_id );
	$product_image_alt = get_post_meta( $product_image_id, '_wp_attachment_image_alt', true );

	$categories = get_the_terms( get_the_ID(), 'product_cat' );
	$tags       = get_the_terms( get_the_ID(), 'product_tag' );

	?>

    <section id="page-title" style="padding: 1.5rem;">

        <div class="container clearfix">
            <h1 style="max-width: 650px; line-height: 1.5em;"><?php echo esc_html( get_the_title() ) ?></h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shop Single</li>
            </ol>
        </div>

    </section><!-- #page-title end -->

    <!-- Content
	============================================= -->
    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">

                <div class="row gutter-40 col-mb-80">
                    <div class="postcontent col-lg-9 order-lg-last">

                        <div class="single-product">
                            <div class="product">
                                <div class="row gutter-40">

                                    <div class="col-md-6">

                                        <!-- Product Single - Gallery
										============================================= -->
                                        <div class="product-image">
                                            <div class="fslider" data-pagi="false" data-arrows="false"
                                                 data-thumbs="true">
                                                <div class="flexslider">

                                                    <div class="slider-wrap" data-lightbox="gallery">
                                                        <div class="slide"
                                                             data-thumb="<?php echo esc_url( $product_image_url ) ?>"><a
                                                                    href="#" title="Pink Printed Dress - Front View"
                                                                    data-lightbox="gallery-item"><img
                                                                        src="<?php echo esc_url( $product_image_url ) ?>"
                                                                        alt="<?php echo esc_attr( $product_image_alt ) ?>"></a>
                                                        </div>

														<?php

														$attachment_ids = $product->get_gallery_image_ids();

														foreach ( $attachment_ids as $attachment_id ) {
															$product_image_gallery_url = wp_get_attachment_url( $attachment_id );
															$product_image_gallery_alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );

															?>
                                                            <div class="slide"
                                                                 data-thumb="<?php echo esc_url( $product_image_gallery_url ) ?>">
                                                                <a href="images/shop/dress/3-1.jpg"
                                                                   title="Pink Printed Dress - Side View"
                                                                   data-lightbox="gallery-item"><img
                                                                            src="<?php echo esc_url( $product_image_gallery_url ) ?>"
                                                                            alt="<?php echo esc_attr( $product_image_gallery_alt ) ?>"></a>
                                                            </div>

														<?php } ?>
                                                    </div>
                                                </div>
                                            </div>
											<?php
											$price_regular = $product->get_regular_price();
											$price_sale    = $product->get_sale_price();

											?>
											<?php if ( $price_sale ) : ?>
                                                <div class="sale-flash badge bg-danger p-2">Sale!</div>
											<?php endif ?>
                                        </div><!-- Product Single - Gallery End -->

                                    </div>

                                    <div class="col-md-6 product-desc">

                                        <div class="d-flex align-items-center justify-content-between">


                                            <!-- Product Single - Price
											============================================= -->
                                            <div class="product-price">
												<?php if ( $price_sale ) : ?>
                                                    <del><?php echo wc_price( $price_regular ) ?></del>
                                                    <ins><?php echo wc_price( $price_sale ) ?></ins>
												<?php else : ?>
                                                    <ins><?php echo wc_price( $price_regular ) ?></ins>
												<?php endif ?>

                                            </div><!-- Product Single - Price End -->

                                            <!-- Product Single - Rating
											============================================= -->
                                            <div class="product-rating">
                                                <i class="icon-star3"></i>
                                                <i class="icon-star3"></i>
                                                <i class="icon-star3"></i>
                                                <i class="icon-star-half-full"></i>
                                                <i class="icon-star-empty"></i>
                                            </div><!-- Product Single - Rating End -->

                                        </div>

                                        <div class="line"></div>

                                        <!-- Product Single - Quantity & Cart Button
										============================================= -->
										<?php if ( $product->is_in_stock() ) : ?>
                                            <form class="cart mb-0 d-flex justify-content-between align-items-center"
                                                  action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>"
                                                  method="post" enctype='multipart/form-data'>
                                                <div class="quantity clearfix">
                                                    <button type="button" value="-" class="minus">-</button>
													<?php

													woocommerce_quantity_input(
														array(
															'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
															'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
															'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(),
														)
													);

													?>
                                                    <button type="button" value="+" class="plus">+</button>
                                                </div>

                                                <button type="submit" name="add-to-cart"
                                                        value="<?php echo esc_attr( $product->get_id() ); ?>"
                                                        class="add-to-cart button m-0 single_add_to_cart_button button alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

                                            </form><!-- Product Single - Quantity & Cart Button End -->

										<?php else : ?>
                                            <span style="color: red;">Out of Stock</span>
										<?php endif; ?>
                                        <div class="line"></div>

                                        <!-- Product Single - Short Description
										============================================= -->
										<?php echo esc_html( $product->get_short_description() ); ?></p>

                                        <!-- Product Single - Meta
										============================================= -->
                                        <div class="card product-meta">
                                            <div class="card-body">
                                                <span itemprop="productID" class="sku_wrapper">SKU: <span class="sku">8465415</span></span>
												<?php if ( $categories ) : ?>
                                                    <span class="posted_in">Category:
                                                    <?php
                                                    foreach ( $categories as $index => $category ) { ?>

                                                        <a
                                                        href="<?php echo esc_url( get_term_link( $category->term_id ) ) ?>"
                                                        rel="tag"><?php echo esc_html( $category->name ) ?></a><?php echo ( $index < count( $categories ) - 1 ) ? ', ' : '.'; ?>

                                                    <?php } ?>
                                                  </span>
												<?php endif; ?>
												<?php if ( $tags ) : ?>
                                                    <span class="tagged_as">Tags:
                                                      <?php

                                                      foreach ( $tags as $index => $tag ) { ?>

                                                          <a
                                                          href="<?php echo esc_url( get_term_link( $tag->term_id ) ) ?>"
                                                          rel="tag"><?php echo esc_html( $tag->name ) ?></a><?php echo ( $index < count( $tags ) - 1 ) ? ', ' : '.'; ?>

                                                      <?php } ?>
                                                    </span>
												<?php endif; ?>
                                            </div>
                                        </div><!-- Product Single - Meta End -->

                                        <!-- Product Single - Share
										============================================= -->
                                        <div class="si-share border-0 d-flex justify-content-between align-items-center mt-4">
                                            <span>Share:</span>
                                            <div>
                                                <a href="#" class="social-icon si-borderless si-facebook">
                                                    <i class="icon-facebook"></i>
                                                    <i class="icon-facebook"></i>
                                                </a>
                                                <a href="#" class="social-icon si-borderless si-twitter">
                                                    <i class="icon-twitter"></i>
                                                    <i class="icon-twitter"></i>
                                                </a>
                                                <a href="#" class="social-icon si-borderless si-pinterest">
                                                    <i class="icon-pinterest"></i>
                                                    <i class="icon-pinterest"></i>
                                                </a>
                                                <a href="#" class="social-icon si-borderless si-gplus">
                                                    <i class="icon-gplus"></i>
                                                    <i class="icon-gplus"></i>
                                                </a>
                                                <a href="#" class="social-icon si-borderless si-rss">
                                                    <i class="icon-rss"></i>
                                                    <i class="icon-rss"></i>
                                                </a>
                                                <a href="#" class="social-icon si-borderless si-email3">
                                                    <i class="icon-email3"></i>
                                                    <i class="icon-email3"></i>
                                                </a>
                                            </div>
                                        </div><!-- Product Single - Share End -->

                                    </div>

                                    <div class="w-100"></div>

                                    <div class="col-12 mt-5">

                                        <div class="tabs clearfix mb-0" id="tab-1">

                                            <ul class="tab-nav clearfix">
                                                <li><a href="#tabs-1"><i class="icon-align-justify2"></i><span
                                                                class="d-none d-md-inline-block"> Deskripsi</span></a>
                                                </li>
                                                <li><a href="#tabs-2"><i class="icon-info-sign"></i><span
                                                                class="d-none d-md-inline-block"> Informasi Tambahan</span></a>
                                                </li>
                                                <li><a href="#tabs-3"><i class="icon-star3"></i><span
                                                                class="d-none d-md-inline-block"> Reviews (2)</span></a>
                                                </li>
                                            </ul>

                                            <div class="tab-container">

                                                <div class="tab-content clearfix" id="tabs-1">
													<?php echo wpautop( get_the_content() ); ?>
                                                </div>
                                                <div class="tab-content clearfix" id="tabs-2">

													<?php
													$product_attributes = $product->get_attributes();

													if ( ! empty( $product_attributes ) ) :

														?>
                                                        <table class="table table-striped table-bordered">
                                                            <tbody>

															<?php foreach ( $product_attributes as $product_attribute_key => $value ) { ?>

                                                                <tr>
                                                                    <td><?php echo esc_html( $value['name'] ); ?></td>
                                                                    <td><?php echo esc_html( $value['value'] ); ?></td>
                                                                </tr>
															<?php } ?>
                                                            </tbody>
                                                        </table>
													<?php else : ?>
                                                        <h3>Tidak ada informasi</h3>
													<?php endif; ?>

                                                </div>
                                                <div class="tab-content clearfix" id="tabs-3">

                                                    <div id="reviews" class="clearfix">

                                                        <ol class="commentlist clearfix">

                                                            <li class="comment even thread-even depth-1"
                                                                id="li-comment-1">
                                                                <div id="comment-1" class="comment-wrap clearfix">

                                                                    <div class="comment-meta">
                                                                        <div class="comment-author vcard">
																				<span class="comment-avatar clearfix">
																				<img alt='Image'
                                                                                     src='https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=60'
                                                                                     height='60' width='60'/></span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="comment-content clearfix">
                                                                        <div class="comment-author">John Doe<span><a
                                                                                        href="#"
                                                                                        title="Permalink to this comment">April 24, 2021 at 10:46AM</a></span>
                                                                        </div>
                                                                        <p>Lorem ipsum dolor sit amet, consectetur
                                                                            adipisicing elit. Quo perferendis aliquid
                                                                            tenetur. Aliquid, tempora, sit aliquam
                                                                            officiis nihil autem eum at repellendus
                                                                            facilis quaerat consequatur commodi laborum
                                                                            saepe non nemo nam maxime quis error tempore
                                                                            possimus est quasi reprehenderit fuga!</p>
                                                                        <div class="review-comment-ratings">
                                                                            <i class="icon-star3"></i>
                                                                            <i class="icon-star3"></i>
                                                                            <i class="icon-star3"></i>
                                                                            <i class="icon-star3"></i>
                                                                            <i class="icon-star-half-full"></i>
                                                                        </div>
                                                                    </div>

                                                                    <div class="clear"></div>

                                                                </div>
                                                            </li>

                                                            <li class="comment even thread-even depth-1"
                                                                id="li-comment-2">
                                                                <div id="comment-2" class="comment-wrap clearfix">

                                                                    <div class="comment-meta">
                                                                        <div class="comment-author vcard">
																				<span class="comment-avatar clearfix">
																				<img alt='Image'
                                                                                     src='https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=60'
                                                                                     height='60' width='60'/></span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="comment-content clearfix">
                                                                        <div class="comment-author">Mary Jane<span><a
                                                                                        href="#"
                                                                                        title="Permalink to this comment">June 16, 2021 at 6:00PM</a></span>
                                                                        </div>
                                                                        <p>Quasi, blanditiis, neque ipsum numquam odit
                                                                            asperiores hic dolor necessitatibus libero
                                                                            sequi amet voluptatibus ipsam velit qui
                                                                            harum temporibus cum nemo iste aperiam
                                                                            explicabo fuga odio ratione sint fugiat
                                                                            consequuntur vitae adipisci delectus eum
                                                                            incidunt possimus tenetur excepturi at
                                                                            accusantium quod doloremque reprehenderit
                                                                            aut expedita labore error atque?</p>
                                                                        <div class="review-comment-ratings">
                                                                            <i class="icon-star3"></i>
                                                                            <i class="icon-star3"></i>
                                                                            <i class="icon-star3"></i>
                                                                            <i class="icon-star-empty"></i>
                                                                            <i class="icon-star-empty"></i>
                                                                        </div>
                                                                    </div>

                                                                    <div class="clear"></div>

                                                                </div>
                                                            </li>

                                                        </ol>

                                                        <!-- Modal Reviews
														============================================= -->
                                                        <a href="#" data-bs-toggle="modal"
                                                           data-bs-target="#reviewFormModal"
                                                           class="button button-3d m-0 float-end">Add a Review</a>

                                                        <div class="modal fade" id="reviewFormModal" tabindex="-1"
                                                             role="dialog" aria-labelledby="reviewFormModalLabel"
                                                             aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title"
                                                                            id="reviewFormModalLabel">Submit a
                                                                            Review</h4>
                                                                        <button type="button" class="btn-close btn-sm"
                                                                                data-bs-dismiss="modal"
                                                                                aria-hidden="true"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form class="row mb-0" id="template-reviewform"
                                                                              name="template-reviewform" action="#"
                                                                              method="post">

                                                                            <div class="col-6 mb-3">
                                                                                <label for="template-reviewform-name">Name
                                                                                    <small>*</small></label>
                                                                                <div class="input-group">
                                                                                    <div class="input-group-text"><i
                                                                                                class="icon-user"></i>
                                                                                    </div>
                                                                                    <input type="text"
                                                                                           id="template-reviewform-name"
                                                                                           name="template-reviewform-name"
                                                                                           value=""
                                                                                           class="form-control required"/>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-6 mb-3">
                                                                                <label for="template-reviewform-email">Email
                                                                                    <small>*</small></label>
                                                                                <div class="input-group">
                                                                                    <div class="input-group-text">@
                                                                                    </div>
                                                                                    <input type="email"
                                                                                           id="template-reviewform-email"
                                                                                           name="template-reviewform-email"
                                                                                           value=""
                                                                                           class="required email form-control"/>
                                                                                </div>
                                                                            </div>

                                                                            <div class="w-100"></div>

                                                                            <div class="col-12 mb-3">
                                                                                <label for="template-reviewform-rating">Rating</label>
                                                                                <select id="template-reviewform-rating"
                                                                                        name="template-reviewform-rating"
                                                                                        class="form-select">
                                                                                    <option value="">-- Select One --
                                                                                    </option>
                                                                                    <option value="1">1</option>
                                                                                    <option value="2">2</option>
                                                                                    <option value="3">3</option>
                                                                                    <option value="4">4</option>
                                                                                    <option value="5">5</option>
                                                                                </select>
                                                                            </div>

                                                                            <div class="w-100"></div>

                                                                            <div class="col-12 mb-3">
                                                                                <label for="template-reviewform-comment">Comment
                                                                                    <small>*</small></label>
                                                                                <textarea class="required form-control"
                                                                                          id="template-reviewform-comment"
                                                                                          name="template-reviewform-comment"
                                                                                          rows="6" cols="30"></textarea>
                                                                            </div>

                                                                            <div class="col-12">
                                                                                <button class="button button-3d m-0"
                                                                                        type="submit"
                                                                                        id="template-reviewform-submit"
                                                                                        name="template-reviewform-submit"
                                                                                        value="submit">Submit Review
                                                                                </button>
                                                                            </div>

                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Close
                                                                        </button>
                                                                    </div>
                                                                </div><!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div><!-- /.modal -->
                                                        <!-- Modal Reviews End -->

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="line"></div>

                                        <div class="row">
                                            <div class="col-md-4 d-none d-md-block">
                                                <a href="#" title="Brand Logo"><img src="images/shop/brand2.jpg"
                                                                                    alt="Brand Logo"></a>
                                            </div>

                                            <div class="col-md-8">

                                                <div class="row gutter-30">

                                                    <div class="col-lg-6">
                                                        <div class="feature-box fbox-plain fbox-dark fbox-sm">
                                                            <div class="fbox-icon">
                                                                <i class="icon-thumbs-up2"></i>
                                                            </div>
                                                            <div class="fbox-content">
                                                                <h3>100% Original Brands</h3>
                                                                <p class="mt-0">We guarantee you the sale of Original
                                                                    Brands with warranties.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="feature-box fbox-plain fbox-dark fbox-sm">
                                                            <div class="fbox-icon">
                                                                <i class="icon-credit-cards"></i>
                                                            </div>
                                                            <div class="fbox-content">
                                                                <h3>Lots of Payment Options</h3>
                                                                <p class="mt-0">We accept Visa, MasterCard and American
                                                                    Express &amp; of-course PayPal.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="feature-box fbox-plain fbox-dark fbox-sm">
                                                            <div class="fbox-icon">
                                                                <i class="icon-truck2"></i>
                                                            </div>
                                                            <div class="fbox-content">
                                                                <h3>Free Express Shipping</h3>
                                                                <p class="mt-0">Free Delivery to 100+ Locations
                                                                    Worldwide on orders above $40.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="feature-box fbox-plain fbox-dark fbox-sm">
                                                            <div class="fbox-icon">
                                                                <i class="icon-undo"></i>
                                                            </div>
                                                            <div class="fbox-content">
                                                                <h3>30-Days Returns Policy</h3>
                                                                <p class="mt-0">Return or exchange items purchased
                                                                    within 30 days for Free.</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="line"></div>

                        <div class="w-100">

                            <h4>Related Products</h4>

                            <div class="owl-carousel product-carousel carousel-widget" data-margin="30"
                                 data-pagi="false" data-autoplay="5000" data-items-xs="1" data-items-md="2"
                                 data-items-lg="3" data-items-xl="4">


                            </div>

                        </div>

                    </div>

                    <div class="sidebar col-lg-3">
                        <div class="sidebar-widgets-wrap">

                            <div class="widget widget_links clearfix">

                                <h4>Kategori Produk</h4>
                                <ul>
									<?php foreach ( $categories as  $category ) { ?>
                                        <li><a href="<?php echo get_term_link($category->term_id)?>"><?php echo esc_html($category->name)?></a></li>
									<?php } ?>
                                </ul>

                            </div>

                            <div class="widget clearfix">

                                <h4>Recent Items</h4>
                                <div class="posts-sm row col-mb-30" id="recent-shop-list-sidebar">
                                    <div class="entry col-12">
                                        <div class="grid-inner row g-0">
                                            <div class="col-auto">
                                                <div class="entry-image">
                                                    <a href="#"><img src="images/shop/small/1.jpg" alt="Image"></a>
                                                </div>
                                            </div>
                                            <div class="col ps-3">
                                                <div class="entry-title">
                                                    <h4><a href="#">Blue Round-Neck Tshirt</a></h4>
                                                </div>
                                                <div class="entry-meta no-separator">
                                                    <ul>
                                                        <li class="color">$29.99</li>
                                                        <li><i class="icon-star3"></i><i class="icon-star3"></i><i
                                                                    class="icon-star3"></i><i class="icon-star3"></i><i
                                                                    class="icon-star-half-full"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="entry col-12">
                                        <div class="grid-inner row g-0">
                                            <div class="col-auto">
                                                <div class="entry-image">
                                                    <a href="#"><img src="images/shop/small/6.jpg" alt="Image"></a>
                                                </div>
                                            </div>
                                            <div class="col ps-3">
                                                <div class="entry-title">
                                                    <h4><a href="#">Checked Short Dress</a></h4>
                                                </div>
                                                <div class="entry-meta no-separator">
                                                    <ul>
                                                        <li class="color">$23.99</li>
                                                        <li><i class="icon-star3"></i><i class="icon-star3"></i><i
                                                                    class="icon-star3"></i><i
                                                                    class="icon-star-half-full"></i><i
                                                                    class="icon-star-empty"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="entry col-12">
                                        <div class="grid-inner row g-0">
                                            <div class="col-auto">
                                                <div class="entry-image">
                                                    <a href="#"><img src="images/shop/small/7.jpg" alt="Image"></a>
                                                </div>
                                            </div>
                                            <div class="col ps-3">
                                                <div class="entry-title">
                                                    <h4><a href="#">Light Blue Denim Dress</a></h4>
                                                </div>
                                                <div class="entry-meta no-separator">
                                                    <ul>
                                                        <li class="color">$19.99</li>
                                                        <li><i class="icon-star3"></i><i class="icon-star3"></i><i
                                                                    class="icon-star3"></i><i
                                                                    class="icon-star-empty"></i><i
                                                                    class="icon-star-empty"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="widget clearfix">

                                <h4>Last Viewed Items</h4>
                                <div class="posts-sm row col-mb-30" id="last-viewed-shop-list-sidebar">
                                    <div class="entry col-12">
                                        <div class="grid-inner row g-0">
                                            <div class="col-auto">
                                                <div class="entry-image">
                                                    <a href="#"><img src="images/shop/small/3.jpg" alt="Image"></a>
                                                </div>
                                            </div>
                                            <div class="col ps-3">
                                                <div class="entry-title">
                                                    <h4><a href="#">Round-Neck Tshirt</a></h4>
                                                </div>
                                                <div class="entry-meta no-separator">
                                                    <ul>
                                                        <li class="color">$15</li>
                                                        <li><i class="icon-star3"></i><i class="icon-star3"></i><i
                                                                    class="icon-star3"></i><i class="icon-star3"></i><i
                                                                    class="icon-star3"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="entry col-12">
                                        <div class="grid-inner row g-0">
                                            <div class="col-auto">
                                                <div class="entry-image">
                                                    <a href="#"><img src="images/shop/small/10.jpg" alt="Image"></a>
                                                </div>
                                            </div>
                                            <div class="col ps-3">
                                                <div class="entry-title">
                                                    <h4><a href="#">Green Trousers</a></h4>
                                                </div>
                                                <div class="entry-meta no-separator">
                                                    <ul>
                                                        <li class="color">$19</li>
                                                        <li><i class="icon-star3"></i><i class="icon-star3"></i><i
                                                                    class="icon-star-empty"></i><i
                                                                    class="icon-star-empty"></i><i
                                                                    class="icon-star-empty"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="entry col-12">
                                        <div class="grid-inner row g-0">
                                            <div class="col-auto">
                                                <div class="entry-image">
                                                    <a href="#"><img src="images/shop/small/11.jpg" alt="Image"></a>
                                                </div>
                                            </div>
                                            <div class="col ps-3">
                                                <div class="entry-title">
                                                    <h4><a href="#">Silver Chrome Watch</a></h4>
                                                </div>
                                                <div class="entry-meta no-separator">
                                                    <ul>
                                                        <li class="color">$34.99</li>
                                                        <li><i class="icon-star3"></i><i class="icon-star3"></i><i
                                                                    class="icon-star3"></i><i
                                                                    class="icon-star-half-full"></i><i
                                                                    class="icon-star-empty"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="widget clearfix">

                                <h4>Popular Items</h4>
                                <div class="posts-sm row col-mb-30" id="popular-shop-list-sidebar">
                                    <div class="entry col-12">
                                        <div class="grid-inner row g-0">
                                            <div class="col-auto">
                                                <div class="entry-image">
                                                    <a href="#"><img src="images/shop/small/8.jpg" alt="Image"></a>
                                                </div>
                                            </div>
                                            <div class="col ps-3">
                                                <div class="entry-title">
                                                    <h4><a href="#">Pink Printed Dress</a></h4>
                                                </div>
                                                <div class="entry-meta no-separator">
                                                    <ul>
                                                        <li class="color">$21</li>
                                                        <li><i class="icon-star3"></i><i class="icon-star3"></i><i
                                                                    class="icon-star3"></i><i class="icon-star3"></i><i
                                                                    class="icon-star-half-full"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="entry col-12">
                                        <div class="grid-inner row g-0">
                                            <div class="col-auto">
                                                <div class="entry-image">
                                                    <a href="#"><img src="images/shop/small/5.jpg" alt="Image"></a>
                                                </div>
                                            </div>
                                            <div class="col ps-3">
                                                <div class="entry-title">
                                                    <h4><a href="#">Blue Round-Neck Tshirt</a></h4>
                                                </div>
                                                <div class="entry-meta no-separator">
                                                    <ul>
                                                        <li class="color">$19.99</li>
                                                        <li><i class="icon-star3"></i><i class="icon-star3"></i><i
                                                                    class="icon-star3"></i><i
                                                                    class="icon-star-empty"></i><i
                                                                    class="icon-star-empty"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="entry col-12">
                                        <div class="grid-inner row g-0">
                                            <div class="col-auto">
                                                <div class="entry-image">
                                                    <a href="#"><img src="images/shop/small/12.jpg" alt="Image"></a>
                                                </div>
                                            </div>
                                            <div class="col ps-3">
                                                <div class="entry-title">
                                                    <h4><a href="#">Men Aviator Sunglasses</a></h4>
                                                </div>
                                                <div class="entry-meta no-separator">
                                                    <ul>
                                                        <li class="color">$14.99</li>
                                                        <li><i class="icon-star3"></i><i class="icon-star3"></i><i
                                                                    class="icon-star-half-full"></i><i
                                                                    class="icon-star-empty"></i><i
                                                                    class="icon-star-empty"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="widget clearfix">
                                <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FEnvato&amp;width=240&amp;height=290&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true&amp;appId=499481203443583"
                                        style="border:none; overflow:hidden; width:240px; height:290px;"></iframe>
                            </div>

                            <div class="widget subscribe-widget clearfix">

                                <h4>Subscribe For Latest Offers</h4>
                                <h5>Subscribe to Our Newsletter to get Important News, Amazing Offers &amp; Inside
                                    Scoops:</h5>
                                <form action="#" class="my-0">
                                    <div class="input-group mx-auto">
                                        <input type="text" class="form-control" placeholder="Enter your Email"
                                               required="">
                                        <button class="btn btn-success" type="submit"><i class="icon-email2"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="widget clearfix">

                                <div id="oc-clients-full" class="owl-carousel image-carousel carousel-widget"
                                     data-items="1" data-margin="10" data-loop="true" data-nav="false"
                                     data-autoplay="5000" data-pagi="false">

                                    <div class="oc-item"><a href="#"><img src="images/clients/1.png" alt="Clients"></a>
                                    </div>
                                    <div class="oc-item"><a href="#"><img src="images/clients/2.png" alt="Clients"></a>
                                    </div>
                                    <div class="oc-item"><a href="#"><img src="images/clients/3.png" alt="Clients"></a>
                                    </div>
                                    <div class="oc-item"><a href="#"><img src="images/clients/4.png" alt="Clients"></a>
                                    </div>
                                    <div class="oc-item"><a href="#"><img src="images/clients/5.png" alt="Clients"></a>
                                    </div>
                                    <div class="oc-item"><a href="#"><img src="images/clients/6.png" alt="Clients"></a>
                                    </div>
                                    <div class="oc-item"><a href="#"><img src="images/clients/7.png" alt="Clients"></a>
                                    </div>
                                    <div class="oc-item"><a href="#"><img src="images/clients/8.png" alt="Clients"></a>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
<?php

endwhile; // End of the loop.
?>
<?php
get_footer()
?>
