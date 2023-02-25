let tpj=jQuery;
tpj.noConflict();
let $ = jQuery.noConflict();

tpj(document).ready(function() {

    let apiRevoSlider = tpj('#rev_slider_ishop').show().revolution(
        {
            sliderType:"standard",
            jsFileLocation:"include/rs-plugin/js/",
            sliderLayout:"fullwidth",
            dottedOverlay:"none",
            delay:9000,
            navigation: {},
            responsiveLevels:[1200,992,768,480,320],
            gridwidth:1140,
            gridheight:500,
            lazyType:"none",
            shadow:0,
            spinner:"off",
            autoHeight:"off",
            disableProgressBar:"on",
            hideThumbsOnMobile:"off",
            hideSliderAtLimit:0,
            hideCaptionAtLimit:0,
            hideAllCaptionAtLilmit:0,
            debugMode:false,
            fallbacks: {
                simplifyAll:"off",
                disableFocusListener:false,
            },
            navigation: {
                keyboardNavigation:"off",
                keyboard_direction: "horizontal",
                mouseScrollNavigation:"off",
                onHoverStop:"off",
                touch:{
                    touchenabled:"on",
                    swipe_threshold: 75,
                    swipe_min_touches: 1,
                    swipe_direction: "horizontal",
                    drag_block_vertical: false
                },
                arrows: {
                    style: "ares",
                    enable: true,
                    hide_onmobile: false,
                    hide_onleave: false,
                    tmp: '<div class="tp-title-wrap">	<span class="tp-arr-titleholder">{{title}}</span> </div>',
                    left: {
                        h_align: "left",
                        v_align: "center",
                        h_offset: 10,
                        v_offset: 0
                    },
                    right: {
                        h_align: "right",
                        v_align: "center",
                        h_offset: 10,
                        v_offset: 0
                    }
                }
            }
        });

    apiRevoSlider.on("revolution.slide.onloaded",function (e) {
        SEMICOLON.slider.sliderDimensions();
    });

}); //ready