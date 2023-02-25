<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="author" content="SemiColonWeb"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>


	<?php wp_head() ?>

    <!-- Document Title
	============================================= -->
    <title>Menu - Style 7 | Canvas</title>


</head>


<body class="stretched">

<!-- Document Wrapper
	============================================= -->
<div id="wrapper" class="clearfix">

    <!-- Top Bar
	============================================= -->
    <div id="top-bar">
        <div class="container clearfix">

            <div class="row justify-content-between">
                <div class="col-12 col-md-auto">

                    <!-- Top Links
					============================================= -->
                    <div class="top-links on-click">
                        <ul class="top-links-container">
                            <li class="top-links-item"><a href="index.html">Home</a>
                                <ul class="top-links-sub-menu">
                                    <li class="top-links-item"><a href="about.html">About</a></li>
                                    <li class="top-links-item"><a href="faqs.html">FAQs</a></li>
                                    <li class="top-links-item"><a href="contact.html">Contact</a></li>
                                    <li class="top-links-item"><a href="sitemap.html">Sitemap</a></li>
                                </ul>
                            </li>
                            <li class="top-links-item"><a href="faqs.html">FAQs</a></li>
                            <li class="top-links-item"><a href="contact.html">Contact</a></li>
                            <li class="top-links-item"><a href="login-register.html">Login</a>
                                <div class="top-links-section">
                                    <form id="top-login" autocomplete="off">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="email" class="form-control" placeholder="Email address">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" placeholder="Password"
                                                   required="">
                                        </div>
                                        <div class="form-group form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                   id="top-login-checkbox">
                                            <label class="form-check-label" for="top-login-checkbox">Remember Me</label>
                                        </div>
                                        <button class="btn btn-danger w-100" type="submit">Sign in</button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div><!-- .top-links end -->

                </div>

                <div class="col-12 col-md-auto">

                    <!-- Top Social
					============================================= -->
                    <ul id="top-social">
                        <li><a href="#" class="si-facebook"><span class="ts-icon"><i
                                            class="icon-facebook"></i></span><span class="ts-text">Facebook</span></a>
                        </li>
                        <li><a href="#" class="si-twitter"><span class="ts-icon"><i
                                            class="icon-twitter"></i></span><span class="ts-text">Twitter</span></a>
                        </li>
                        <li class="d-none d-sm-flex"><a href="#" class="si-dribbble"><span class="ts-icon"><i
                                            class="icon-dribbble"></i></span><span class="ts-text">Dribbble</span></a>
                        </li>
                        <li><a href="#" class="si-github"><span class="ts-icon"><i
                                            class="icon-github-circled"></i></span><span
                                        class="ts-text">Github</span></a></li>
                        <li class="d-none d-sm-flex"><a href="#" class="si-pinterest"><span class="ts-icon"><i
                                            class="icon-pinterest"></i></span><span class="ts-text">Pinterest</span></a>
                        </li>
                        <li><a href="#" class="si-instagram"><span class="ts-icon"><i
                                            class="icon-instagram2"></i></span><span
                                        class="ts-text">Instagram</span></a></li>
                        <li><a href="tel:+1.11.85412542" class="si-call"><span class="ts-icon"><i class="icon-call"></i></span><span
                                        class="ts-text">+1.11.85412542</span></a></li>
                        <li><a href="mailto:info@canvas.com" class="si-email3"><span class="ts-icon"><i
                                            class="icon-email3"></i></span><span class="ts-text">info@canvas.com</span></a>
                        </li>
                    </ul><!-- #top-social end -->

                </div>

            </div>

        </div>
    </div><!-- #top-bar end -->

    <!-- Header
	============================================= -->
    <header id="header" class="header-size-sm">
        <div class="container">
            <div class="header-row flex-column flex-lg-row justify-content-center justify-content-lg-start">

                <!-- Logo
				============================================= -->
                <div id="logo" class="me-0 me-lg-auto">
                    <a href="index.html" class="standard-logo"
                       data-dark-logo="<?php echo esc_url( get_theme_mod( 'logo_shop' ) ) ?>"><img
                                src="<?php echo esc_url( get_theme_mod( 'logo_shop' ) ) ?>" alt="Canvas Logo"></a>
                </div><!-- #logo end -->

                <div class="header-misc mb-4 mb-lg-0 order-lg-last">

                    <ul class="header-extras me-0 me-sm-4">
                        <li>
                            <i class="i-plain icon-email3 m-0"></i>
                            <div class="he-text">
                                Drop an Email
                                <span><?php echo esc_html( get_theme_mod( 'email_shop' ) ) ?></span>
                            </div>
                        </li>
                        <li>
                            <i class="i-plain icon-call m-0"></i>
                            <div class="he-text">
                                Get in Touch
                                <span><?php echo esc_html( get_theme_mod( 'telp_shop' ) ) ?></span>
                            </div>
                        </li>
                    </ul>

                    <!-- Top Cart
					============================================= -->
                    <div id="top-cart" class="header-misc-icon d-none d-sm-block">
                        <a href="#" id="top-cart-trigger"><i class="icon-line-bag"></i><span
                                    class="top-cart-number"><?php echo sizeof(WC()->cart->get_cart())?></span></a>
                        <div class="top-cart-content">
                            <div class="top-cart-title">
                                <h4>Shopping Cart</h4>
                            </div>
                            <div class="top-cart-items">


								<?php
								foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
									$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
									$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
									?>

                                    <div class="top-cart-item">
                                        <div class="top-cart-item-image">
											<?php echo $_product->get_image() ?>
                                        </div>
                                        <div class="top-cart-item-desc">
                                            <div class="top-cart-item-desc-title">
                                                <a href="<?php echo esc_url($_product->get_permalink()) ?>"><?php echo esc_html( $_product->get_title() ) ?></a>
                                                <span class="top-cart-item-price d-block"><?php echo esc_html( number_format( $_product->get_price(), 0, ',', '.' ) ) ?></span>
                                            </div>
                                            <div class="top-cart-item-quantity">

                                                x <?php echo esc_html( $cart_item['quantity'] ) ?>
                                            </div>

                                        </div>
                                    </div>
								<?php } ?>
                            </div>
                            <div class="top-cart-action">
                                <span class="top-checkout-price"><?php echo WC()->cart->get_cart_total(); ?></span>
                                <a href="<?php echo esc_url( wc_get_cart_url())?>" class="button button-3d button-small m-0">View Cart</a>
                            </div>
                        </div>
                    </div><!-- #top-cart end -->

                </div>

            </div>
        </div>

        <div id="header-wrap" class="border-top border-f5">
            <div class="container">
                <div class="header-row justify-content-between flex-row-reverse flex-lg-row">

                    <div class="header-misc">

                        <!-- Top Search
						============================================= -->
                        <div id="top-search" class="header-misc-icon">
                            <a href="#" id="top-search-trigger"><i class="icon-line-search"></i><i
                                        class="icon-line-cross"></i></a>
                        </div><!-- #top-search end -->

                    </div>

                    <div id="primary-menu-trigger">
                        <svg class="svg-trigger" viewBox="0 0 100 100">
                            <path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path>
                            <path d="m 30,50 h 40"></path>
                            <path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path>
                        </svg>
                    </div>

                    <!-- Primary Navigation
					============================================= -->

					<?php
					wp_nav_menu( array(
						'theme_location'  => 'primary',
						'menu'            => 'Primary Navigation',
						'menu_class'      => 'menu-container',
						'container'       => 'nav',
						'container_class' => 'primary-menu',
						'add_a_class'     => 'menu-link',
						'link_before'     => '<div>',
						'link_after'      => '</div>',
						'depth'           => 4
					) )
					?>


                    <form class="top-search-form" action="search.html" method="get">
                        <input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter.."
                               autocomplete="off">
                    </form>

                </div>

            </div>
        </div>
        <div class="header-wrap-clone"></div>
    </header><!-- #header end -->