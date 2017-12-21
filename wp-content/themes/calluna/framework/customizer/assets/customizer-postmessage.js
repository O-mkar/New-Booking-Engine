/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ) {
// Typography
wp.customize("body_typography[font-weight]", function(e) {
    $currentVal = $("body,h1,h2,h3,h4,h5,p,p.teaser,.wpb_wrapper,.simple-weather em,.calluna-time .time,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price, .offer_price,.nav-menu li a,.mobile-nav .mobile-menu ul li a,#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.site-footer p,.site-footer ul").css("font-weight");
    e.bind(function(e) {
        if (e) {
            $("body,h1,h2,h3,h4,h5,p,p.teaser,.wpb_wrapper,.simple-weather em,.calluna-time .time,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price, .offer_price,.nav-menu li a,.mobile-nav .mobile-menu ul li a,#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.site-footer p,.site-footer ul").css("font-weight", e);
        } else {
            $("body,h1,h2,h3,h4,h5,p,p.teaser,.wpb_wrapper,.simple-weather em,.calluna-time .time,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price, .offer_price,.nav-menu li a,.mobile-nav .mobile-menu ul li a,#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.site-footer p,.site-footer ul").css("font-weight", "");
        }
    });
});
wp.customize("body_typography[font-style]", function(e) {
    $currentVal = $("body,h1,h2,h3,h4,h5,p,p.teaser,.wpb_wrapper,.simple-weather em,.calluna-time .time,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price, .offer_price,.nav-menu li a,.mobile-nav .mobile-menu ul li a,#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.site-footer p,.site-footer ul").css("font-style");
    e.bind(function(e) {
        if (e) {
            $("body,h1,h2,h3,h4,h5,p,p.teaser,.wpb_wrapper,.simple-weather em,.calluna-time .time,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price, .offer_price,.nav-menu li a,.mobile-nav .mobile-menu ul li a,#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.site-footer p,.site-footer ul").css("font-style", e);
        } else {
            $("body,h1,h2,h3,h4,h5,p,p.teaser,.wpb_wrapper,.simple-weather em,.calluna-time .time,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price, .offer_price,.nav-menu li a,.mobile-nav .mobile-menu ul li a,#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.site-footer p,.site-footer ul").css("font-style", "");
        }
    });
});
wp.customize("body_typography[font-size]", function(e) {
    $currentVal = $("body,h1,h2,h3,h4,h5,p,p.teaser,.wpb_wrapper,.simple-weather em,.calluna-time .time,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price, .offer_price,.nav-menu li a,.mobile-nav .mobile-menu ul li a,#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.site-footer p,.site-footer ul").css("font-size");
    e.bind(function(e) {
        if (e) {
            $("body,h1,h2,h3,h4,h5,p,p.teaser,.wpb_wrapper,.simple-weather em,.calluna-time .time,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price, .offer_price,.nav-menu li a,.mobile-nav .mobile-menu ul li a,#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.site-footer p,.site-footer ul").css("font-size", parseInt(e, 10) + "px");
        } else {
            $("body,h1,h2,h3,h4,h5,p,p.teaser,.wpb_wrapper,.simple-weather em,.calluna-time .time,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price, .offer_price,.nav-menu li a,.mobile-nav .mobile-menu ul li a,#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.site-footer p,.site-footer ul").css("font-size", "");
        }
    });
});
wp.customize("body_typography[color]", function(e) {
    $currentVal = $("body,h1,h2,h3,h4,h5,p,p.teaser,.wpb_wrapper,.simple-weather em,.calluna-time .time,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price, .offer_price,.nav-menu li a,.mobile-nav .mobile-menu ul li a,#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.site-footer p,.site-footer ul").css("color");
    e.bind(function(e) {
        if (e) {
            $("body,h1,h2,h3,h4,h5,p,p.teaser,.wpb_wrapper,.simple-weather em,.calluna-time .time,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price, .offer_price,.nav-menu li a,.mobile-nav .mobile-menu ul li a,#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.site-footer p,.site-footer ul").css("color", e);
        } else {
            $("body,h1,h2,h3,h4,h5,p,p.teaser,.wpb_wrapper,.simple-weather em,.calluna-time .time,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price, .offer_price,.nav-menu li a,.mobile-nav .mobile-menu ul li a,#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.site-footer p,.site-footer ul").css("color", "");
        }
    });
});
wp.customize("body_typography[line-height]", function(e) {
    $currentVal = $("body,h1,h2,h3,h4,h5,p,p.teaser,.wpb_wrapper,.simple-weather em,.calluna-time .time,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price, .offer_price,.nav-menu li a,.mobile-nav .mobile-menu ul li a,#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.site-footer p,.site-footer ul").css("line-height");
    e.bind(function(e) {
        if (e) {
            $("body,h1,h2,h3,h4,h5,p,p.teaser,.wpb_wrapper,.simple-weather em,.calluna-time .time,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price, .offer_price,.nav-menu li a,.mobile-nav .mobile-menu ul li a,#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.site-footer p,.site-footer ul").css("line-height", e);
        } else {
            $("body,h1,h2,h3,h4,h5,p,p.teaser,.wpb_wrapper,.simple-weather em,.calluna-time .time,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price, .offer_price,.nav-menu li a,.mobile-nav .mobile-menu ul li a,#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.site-footer p,.site-footer ul").css("line-height", "");
        }
    });
});
wp.customize("body_typography[letter-spacing]", function(e) {
    $currentVal = $("body,h1,h2,h3,h4,h5,p,p.teaser,.wpb_wrapper,.simple-weather em,.calluna-time .time,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price, .offer_price,.nav-menu li a,.mobile-nav .mobile-menu ul li a,#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.site-footer p,.site-footer ul").css("letter-spacing");
    e.bind(function(e) {
        if (e) {
            $("body,h1,h2,h3,h4,h5,p,p.teaser,.wpb_wrapper,.simple-weather em,.calluna-time .time,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price, .offer_price,.nav-menu li a,.mobile-nav .mobile-menu ul li a,#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.site-footer p,.site-footer ul").css("letter-spacing", parseInt(e, 10) + "px");
        } else {
            $("body,h1,h2,h3,h4,h5,p,p.teaser,.wpb_wrapper,.simple-weather em,.calluna-time .time,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price, .offer_price,.nav-menu li a,.mobile-nav .mobile-menu ul li a,#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.site-footer p,.site-footer ul").css("letter-spacing", "");
        }
    });
});
wp.customize("body_typography[text-transform]", function(e) {
    $currentVal = $("body,h1,h2,h3,h4,h5,p,p.teaser,.wpb_wrapper,.simple-weather em,.calluna-time .time,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price, .offer_price,.nav-menu li a,.mobile-nav .mobile-menu ul li a,#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.site-footer p,.site-footer ul").css("text-transform");
    e.bind(function(e) {
        if (e) {
            $("body,h1,h2,h3,h4,h5,p,p.teaser,.wpb_wrapper,.simple-weather em,.calluna-time .time,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price, .offer_price,.nav-menu li a,.mobile-nav .mobile-menu ul li a,#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.site-footer p,.site-footer ul").css("text-transform", e);
        } else {
            $("body,h1,h2,h3,h4,h5,p,p.teaser,.wpb_wrapper,.simple-weather em,.calluna-time .time,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price, .offer_price,.nav-menu li a,.mobile-nav .mobile-menu ul li a,#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li,.event_grid_month,.event_grid_day,.post_date_wrapper .month,.post_date_wrapper .day,.inline_date_wrapper .day,.inline_date_wrapper .month,.site-footer p,.site-footer ul").css("text-transform", "");
        }
    });
});
wp.customize("paragraph_typography[font-weight]", function(e) {
    $currentVal = $(".wpb_wrapper p.teaser, p.teaser, .text-column p, p").css("font-weight");
    e.bind(function(e) {
        if (e) {
            $(".wpb_wrapper p.teaser, p.teaser, .text-column p, p").css("font-weight", e);
        } else {
            $(".wpb_wrapper p.teaser, p.teaser, .text-column p, p").css("font-weight", "");
        }
    });
});
wp.customize("paragraph_typography[font-style]", function(e) {
    $currentVal = $(".wpb_wrapper p.teaser, p.teaser, .text-column p, p").css("font-style");
    e.bind(function(e) {
        if (e) {
            $(".wpb_wrapper p.teaser, p.teaser, .text-column p, p").css("font-style", e);
        } else {
            $(".wpb_wrapper p.teaser, p.teaser, .text-column p, p").css("font-style", "");
        }
    });
});
wp.customize("paragraph_typography[font-size]", function(e) {
    $currentVal = $(".wpb_wrapper p.teaser, p.teaser, .text-column p, p").css("font-size");
    e.bind(function(e) {
        if (e) {
            $(".wpb_wrapper p.teaser, p.teaser, .text-column p, p").css("font-size", parseInt(e, 10) + "px");
        } else {
            $(".wpb_wrapper p.teaser, p.teaser, .text-column p, p").css("font-size", "");
        }
    });
});
wp.customize("paragraph_typography[color]", function(e) {
    $currentVal = $(".wpb_wrapper p.teaser, p.teaser, .text-column p, p").css("color");
    e.bind(function(e) {
        if (e) {
            $(".wpb_wrapper p.teaser, p.teaser, .text-column p, p").css("color", e);
        } else {
            $(".wpb_wrapper p.teaser, p.teaser, .text-column p, p").css("color", "");
        }
    });
});
wp.customize("paragraph_typography[line-height]", function(e) {
    $currentVal = $(".wpb_wrapper p.teaser, p.teaser, .text-column p, p").css("line-height");
    e.bind(function(e) {
        if (e) {
            $(".wpb_wrapper p.teaser, p.teaser, .text-column p, p").css("line-height", e);
        } else {
            $(".wpb_wrapper p.teaser, p.teaser, .text-column p, p").css("line-height", "");
        }
    });
});
wp.customize("paragraph_typography[letter-spacing]", function(e) {
    $currentVal = $(".wpb_wrapper p.teaser, p.teaser, .text-column p, p").css("letter-spacing");
    e.bind(function(e) {
        if (e) {
            $(".wpb_wrapper p.teaser, p.teaser, .text-column p, p").css("letter-spacing", parseInt(e, 10) + "px");
        } else {
            $(".wpb_wrapper p.teaser, p.teaser, .text-column p, p").css("letter-spacing", "");
        }
    });
});
wp.customize("paragraph_typography[text-transform]", function(e) {
    $currentVal = $(".wpb_wrapper p.teaser, p.teaser, .text-column p, p").css("text-transform");
    e.bind(function(e) {
        if (e) {
            $(".wpb_wrapper p.teaser, p.teaser, .text-column p, p").css("text-transform", e);
        } else {
            $(".wpb_wrapper p.teaser, p.teaser, .text-column p, p").css("text-transform", "");
        }
    });
});
wp.customize("headings_title_typography[font-weight]", function(e) {
    $currentVal = $("header_text_wrapper").css("font-weight");
    e.bind(function(e) {
        if (e) {
            $("h1").css("font-weight", e);
        } else {
            $("h1").css("font-weight", "");
        }
    });
});
wp.customize("headings_title_typography[font-style]", function(e) {
    $currentVal = $("h1").css("font-style");
    e.bind(function(e) {
        if (e) {
            $("h1").css("font-style", e);
        } else {
            $("h1").css("font-style", "");
        }
    });
});
wp.customize("headings_title_typography[font-size]", function(e) {
    $currentVal = $("h1").css("font-size");
    e.bind(function(e) {
        if (e) {
            $("h1").css("font-size", parseInt(e, 10) + "px");
        } else {
            $("h1").css("font-size", "");
        }
    });
});
wp.customize("headings_title_typography[color]", function(e) {
    $currentVal = $("h1").css("color");
    e.bind(function(e) {
        if (e) {
            $("h1").css("color", e);
        } else {
            $("h1").css("color", "");
        }
    });
});
wp.customize("headings_title_typography[line-height]", function(e) {
    $currentVal = $("h1").css("line-height");
    e.bind(function(e) {
        if (e) {
            $("h1").css("line-height", e);
        } else {
            $("h1").css("line-height", "");
        }
    });
});
wp.customize("headings_title_typography[letter-spacing]", function(e) {
    $currentVal = $("h1").css("letter-spacing");
    e.bind(function(e) {
        if (e) {
            $("h1").css("letter-spacing", parseInt(e, 10) + "px");
        } else {
            $("h1").css("letter-spacing", "");
        }
    });
});
wp.customize("headings_title_typography[text-transform]", function(e) {
    $currentVal = $("h1").css("text-transform");
    e.bind(function(e) {
        if (e) {
            $("h1").css("text-transform", e);
        } else {
            $("h1").css("text-transform", "");
        }
    });
});
wp.customize("headings2_typography[font-weight]", function(e) {
    $currentVal = $("h2").css("font-weight");
    e.bind(function(e) {
        if (e) {
            $("h2").css("font-weight", e);
        } else {
            $("h2").css("font-weight", "");
        }
    });
});
wp.customize("headings2_typography[font-style]", function(e) {
    $currentVal = $("h2").css("font-style");
    e.bind(function(e) {
        if (e) {
            $("h2").css("font-style", e);
        } else {
            $("h2").css("font-style", "");
        }
    });
});
wp.customize("headings2_typography[font-size]", function(e) {
    $currentVal = $("h2").css("font-size");
    e.bind(function(e) {
        if (e) {
            $("h2").css("font-size", parseInt(e, 10) + "px");
        } else {
            $("h2").css("font-size", "");
        }
    });
});
wp.customize("headings2_typography[color]", function(e) {
    $currentVal = $("h2").css("color");
    e.bind(function(e) {
        if (e) {
            $("h2").css("color", e);
        } else {
            $("h2").css("color", "");
        }
    });
});
wp.customize("headings2_typography[line-height]", function(e) {
    $currentVal = $("h2").css("line-height");
    e.bind(function(e) {
        if (e) {
            $("h2").css("line-height", e);
        } else {
            $("h2").css("line-height", "");
        }
    });
});
wp.customize("headings2_typography[letter-spacing]", function(e) {
    $currentVal = $("h2").css("letter-spacing");
    e.bind(function(e) {
        if (e) {
            $("h2").css("letter-spacing", parseInt(e, 10) + "px");
        } else {
            $("h2").css("letter-spacing", "");
        }
    });
});
wp.customize("headings2_typography[text-transform]", function(e) {
    $currentVal = $("h2").css("text-transform");
    e.bind(function(e) {
        if (e) {
            $("h2").css("text-transform", e);
        } else {
            $("h2").css("text-transform", "");
        }
    });
});
wp.customize("headings3_typography[font-weight]", function(e) {
    $currentVal = $("h3").css("font-weight");
    e.bind(function(e) {
        if (e) {
            $("h3").css("font-weight", e);
        } else {
            $("h3").css("font-weight", "");
        }
    });
});
wp.customize("headings3_typography[font-style]", function(e) {
    $currentVal = $("h3").css("font-style");
    e.bind(function(e) {
        if (e) {
            $("h3").css("font-style", e);
        } else {
            $("h3").css("font-style", "");
        }
    });
});
wp.customize("headings3_typography[font-size]", function(e) {
    $currentVal = $("h3").css("font-size");
    e.bind(function(e) {
        if (e) {
            $("h3").css("font-size", parseInt(e, 10) + "px");
        } else {
            $("h3").css("font-size", "");
        }
    });
});
wp.customize("headings3_typography[color]", function(e) {
    $currentVal = $("h3").css("color");
    e.bind(function(e) {
        if (e) {
            $("h3").css("color", e);
        } else {
            $("h3").css("color", "");
        }
    });
});
wp.customize("headings3_typography[line-height]", function(e) {
    $currentVal = $("h3").css("line-height");
    e.bind(function(e) {
        if (e) {
            $("h3").css("line-height", e);
        } else {
            $("h3").css("line-height", "");
        }
    });
});
wp.customize("headings3_typography[letter-spacing]", function(e) {
    $currentVal = $("h3").css("letter-spacing");
    e.bind(function(e) {
        if (e) {
            $("h3").css("letter-spacing", parseInt(e, 10) + "px");
        } else {
            $("h3").css("letter-spacing", "");
        }
    });
});
wp.customize("headings3_typography[text-transform]", function(e) {
    $currentVal = $("h3").css("text-transform");
    e.bind(function(e) {
        if (e) {
            $("h3").css("text-transform", e);
        } else {
            $("h3").css("text-transform", "");
        }
    });
});
wp.customize("headings4_typography[font-weight]", function(e) {
    $currentVal = $("h4").css("font-weight");
    e.bind(function(e) {
        if (e) {
            $("h4").css("font-weight", e);
        } else {
            $("h4").css("font-weight", "");
        }
    });
});
wp.customize("headings4_typography[font-style]", function(e) {
    $currentVal = $("h4").css("font-style");
    e.bind(function(e) {
        if (e) {
            $("h4").css("font-style", e);
        } else {
            $("h4").css("font-style", "");
        }
    });
});
wp.customize("headings4_typography[font-size]", function(e) {
    $currentVal = $("h4").css("font-size");
    e.bind(function(e) {
        if (e) {
            $("h4").css("font-size", parseInt(e, 10) + "px");
        } else {
            $("h4").css("font-size", "");
        }
    });
});
wp.customize("headings4_typography[color]", function(e) {
    $currentVal = $("h4").css("color");
    e.bind(function(e) {
        if (e) {
            $("h4").css("color", e);
        } else {
            $("h4").css("color", "");
        }
    });
});
wp.customize("headings4_typography[line-height]", function(e) {
    $currentVal = $("h4").css("line-height");
    e.bind(function(e) {
        if (e) {
            $("h4").css("line-height", e);
        } else {
            $("h4").css("line-height", "");
        }
    });
});
wp.customize("headings4_typography[letter-spacing]", function(e) {
    $currentVal = $("h4").css("letter-spacing");
    e.bind(function(e) {
        if (e) {
            $("h4").css("letter-spacing", parseInt(e, 10) + "px");
        } else {
            $("h4").css("letter-spacing", "");
        }
    });
});
wp.customize("headings4_typography[text-transform]", function(e) {
    $currentVal = $("h4").css("text-transform");
    e.bind(function(e) {
        if (e) {
            $("h4").css("text-transform", e);
        } else {
            $("h4").css("text-transform", "");
        }
    });
});
wp.customize("headings5_typography[font-weight]", function(e) {
    $currentVal = $("h5").css("font-weight");
    e.bind(function(e) {
        if (e) {
            $("h5").css("font-weight", e);
        } else {
            $("h5").css("font-weight", "");
        }
    });
});
wp.customize("headings5_typography[font-style]", function(e) {
    $currentVal = $("h5").css("font-style");
    e.bind(function(e) {
        if (e) {
            $("h5").css("font-style", e);
        } else {
            $("h5").css("font-style", "");
        }
    });
});
wp.customize("headings5_typography[font-size]", function(e) {
    $currentVal = $("h5").css("font-size");
    e.bind(function(e) {
        if (e) {
            $("h5").css("font-size", parseInt(e, 10) + "px");
        } else {
            $("h5").css("font-size", "");
        }
    });
});
wp.customize("headings5_typography[color]", function(e) {
    $currentVal = $("h5").css("color");
    e.bind(function(e) {
        if (e) {
            $("h5").css("color", e);
        } else {
            $("h5").css("color", "");
        }
    });
});
wp.customize("headings5_typography[line-height]", function(e) {
    $currentVal = $("h5").css("line-height");
    e.bind(function(e) {
        if (e) {
            $("h5").css("line-height", e);
        } else {
            $("h5").css("line-height", "");
        }
    });
});
wp.customize("headings5_typography[letter-spacing]", function(e) {
    $currentVal = $("h5").css("letter-spacing");
    e.bind(function(e) {
        if (e) {
            $("h5").css("letter-spacing", parseInt(e, 10) + "px");
        } else {
            $("h5").css("letter-spacing", "");
        }
    });
});
wp.customize("headings5_typography[text-transform]", function(e) {
    $currentVal = $("h5").css("text-transform");
    e.bind(function(e) {
        if (e) {
            $("h5").css("text-transform", e);
        } else {
            $("h5").css("text-transform", "");
        }
    });
});
wp.customize("nav_menu_typography[font-weight]", function(e) {
    $currentVal = $(".nav-menu li a").css("font-weight");
    e.bind(function(e) {
        if (e) {
            $(".nav-menu li a").css("font-weight", e);
        } else {
            $(".nav-menu li a").css("font-weight", "");
        }
    });
});
wp.customize("nav_menu_typography[font-style]", function(e) {
    $currentVal = $(".nav-menu li a").css("font-style");
    e.bind(function(e) {
        if (e) {
            $(".nav-menu li a").css("font-style", e);
        } else {
            $(".nav-menu li a").css("font-style", "");
        }
    });
});
wp.customize("nav_menu_typography[font-size]", function(e) {
    $currentVal = $(".nav-menu li a").css("font-size");
    e.bind(function(e) {
        if (e) {
            $(".nav-menu li a").css("font-size", parseInt(e, 10) + "px");
        } else {
            $(".nav-menu li a").css("font-size", "");
        }
    });
});
wp.customize("nav_menu_typography[color]", function(e) {
    $currentVal = $(".nav-menu li a").css("color");
    e.bind(function(e) {
        if (e) {
            $(".nav-menu li a").css("color", e);
        } else {
            $(".nav-menu li a").css("color", "");
        }
    });
});
wp.customize("nav_menu_typography[line-height]", function(e) {
    $currentVal = $(".nav-menu li a").css("line-height");
    e.bind(function(e) {
        if (e) {
            $(".nav-menu li a").css("line-height", e);
        } else {
            $(".nav-menu li a").css("line-height", "");
        }
    });
});
wp.customize("nav_menu_typography[letter-spacing]", function(e) {
    $currentVal = $(".nav-menu li a").css("letter-spacing");
    e.bind(function(e) {
        if (e) {
            $(".nav-menu li a").css("letter-spacing", parseInt(e, 10) + "px");
        } else {
            $(".nav-menu li a").css("letter-spacing", "");
        }
    });
});
wp.customize("nav_menu_typography[text-transform]", function(e) {
    $currentVal = $(".nav-menu li a").css("text-transform");
    e.bind(function(e) {
        if (e) {
            $(".nav-menu li a").css("text-transform", e);
        } else {
            $(".nav-menu li a").css("text-transform", "");
        }
    });
});
wp.customize("menu_dropdown_typography[font-weight]", function(e) {
    $currentVal = $(".nav-menu ul ul li a").css("font-weight");
    e.bind(function(e) {
        if (e) {
            $(".nav-menu ul ul li a").css("font-weight", e);
        } else {
            $(".nav-menu ul ul li a").css("font-weight", "");
        }
    });
});
wp.customize("menu_dropdown_typography[font-style]", function(e) {
    $currentVal = $(".nav-menu ul ul li a").css("font-style");
    e.bind(function(e) {
        if (e) {
            $(".nav-menu ul ul li a").css("font-style", e);
        } else {
            $(".nav-menu ul ul li a").css("font-style", "");
        }
    });
});
wp.customize("menu_dropdown_typography[font-size]", function(e) {
    $currentVal = $(".nav-menu ul ul li a").css("font-size");
    e.bind(function(e) {
        if (e) {
            $(".nav-menu ul ul li a").css("font-size", parseInt(e, 10) + "px");
        } else {
            $(".nav-menu ul ul li a").css("font-size", "");
        }
    });
});
wp.customize("menu_dropdown_typography[color]", function(e) {
    $currentVal = $(".nav-menu ul ul li a").css("color");
    e.bind(function(e) {
        if (e) {
            $(".nav-menu ul ul li a").css("color", e);
        } else {
            $(".nav-menu ul ul li a").css("color", "");
        }
    });
});
wp.customize("menu_dropdown_typography[line-height]", function(e) {
    $currentVal = $(".nav-menu ul ul li a").css("line-height");
    e.bind(function(e) {
        if (e) {
            $(".nav-menu ul ul li a").css("line-height", e);
        } else {
            $(".nav-menu ul ul li a").css("line-height", "");
        }
    });
});
wp.customize("menu_dropdown_typography[letter-spacing]", function(e) {
    $currentVal = $(".nav-menu ul ul li a").css("letter-spacing");
    e.bind(function(e) {
        if (e) {
            $(".nav-menu ul ul li a").css("letter-spacing", parseInt(e, 10) + "px");
        } else {
            $(".nav-menu ul ul li a").css("letter-spacing", "");
        }
    });
});
wp.customize("menu_dropdown_typography[text-transform]", function(e) {
    $currentVal = $(".nav-menu ul ul li a").css("text-transform");
    e.bind(function(e) {
        if (e) {
            $(".nav-menu ul ul li a").css("text-transform", e);
        } else {
            $(".nav-menu ul ul li a").css("text-transform", "");
        }
    });
});
wp.customize("mobile_menu_typography[font-weight]", function(e) {
    $currentVal = $(".mobile-nav .mobile-menu ul li a").css("font-weight");
    e.bind(function(e) {
        if (e) {
            $(".mobile-nav .mobile-menu ul li a").css("font-weight", e);
        } else {
            $(".mobile-nav .mobile-menu ul li a").css("font-weight", "");
        }
    });
});
wp.customize("mobile_menu_typography[font-style]", function(e) {
    $currentVal = $(".mobile-nav .mobile-menu ul li a").css("font-style");
    e.bind(function(e) {
        if (e) {
            $(".mobile-nav .mobile-menu ul li a").css("font-style", e);
        } else {
            $(".mobile-nav .mobile-menu ul li a").css("font-style", "");
        }
    });
});
wp.customize("mobile_menu_typography[font-size]", function(e) {
    $currentVal = $(".mobile-nav .mobile-menu ul li a").css("font-size");
    e.bind(function(e) {
        if (e) {
            $(".mobile-nav .mobile-menu ul li a").css("font-size", parseInt(e, 10) + "px");
        } else {
            $(".mobile-nav .mobile-menu ul li a").css("font-size", "");
        }
    });
});
wp.customize("mobile_menu_typography[color]", function(e) {
    $currentVal = $(".mobile-nav .mobile-menu ul li a").css("color");
    e.bind(function(e) {
        if (e) {
            $(".mobile-nav .mobile-menu ul li a").css("color", e);
        } else {
            $(".mobile-nav .mobile-menu ul li a").css("color", "");
        }
    });
});
wp.customize("mobile_menu_typography[line-height]", function(e) {
    $currentVal = $(".mobile-nav .mobile-menu ul li a").css("line-height");
    e.bind(function(e) {
        if (e) {
            $(".mobile-nav .mobile-menu ul li a").css("line-height", e);
        } else {
            $(".mobile-nav .mobile-menu ul li a").css("line-height", "");
        }
    });
});
wp.customize("mobile_menu_typography[letter-spacing]", function(e) {
    $currentVal = $(".mobile-nav .mobile-menu ul li a").css("letter-spacing");
    e.bind(function(e) {
        if (e) {
            $(".mobile-nav .mobile-menu ul li a").css("letter-spacing", parseInt(e, 10) + "px");
        } else {
            $(".mobile-nav .mobile-menu ul li a").css("letter-spacing", "");
        }
    });
});
wp.customize("mobile_menu_typography[text-transform]", function(e) {
    $currentVal = $(".mobile-nav .mobile-menu ul li a").css("text-transform");
    e.bind(function(e) {
        if (e) {
            $(".mobile-nav .mobile-menu ul li a").css("text-transform", e);
        } else {
            $(".mobile-nav .mobile-menu ul li a").css("text-transform", "");
        }
    });
});
wp.customize("sidebar_widget_title_typography[font-weight]", function(e) {
    $currentVal = $(".sidebar .widget h2").css("font-weight");
    e.bind(function(e) {
        if (e) {
            $(".sidebar .widget h2").css("font-weight", e);
        } else {
            $(".sidebar .widget h2").css("font-weight", "");
        }
    });
});
wp.customize("sidebar_widget_title_typography[font-style]", function(e) {
    $currentVal = $(".sidebar .widget h2").css("font-style");
    e.bind(function(e) {
        if (e) {
            $(".sidebar .widget h2").css("font-style", e);
        } else {
            $(".sidebar .widget h2").css("font-style", "");
        }
    });
});
wp.customize("sidebar_widget_title_typography[font-size]", function(e) {
    $currentVal = $(".sidebar .widget h2").css("font-size");
    e.bind(function(e) {
        if (e) {
            $(".sidebar .widget h2").css("font-size", parseInt(e, 10) + "px");
        } else {
            $(".sidebar .widget h2").css("font-size", "");
        }
    });
});
wp.customize("sidebar_widget_title_typography[color]", function(e) {
    $currentVal = $(".sidebar .widget h2").css("color");
    e.bind(function(e) {
        if (e) {
            $(".sidebar .widget h2").css("color", e);
        } else {
            $(".sidebar .widget h2").css("color", "");
        }
    });
});
wp.customize("sidebar_widget_title_typography[line-height]", function(e) {
    $currentVal = $(".sidebar .widget h2").css("line-height");
    e.bind(function(e) {
        if (e) {
            $(".sidebar .widget h2").css("line-height", e);
        } else {
            $(".sidebar .widget h2").css("line-height", "");
        }
    });
});
wp.customize("sidebar_widget_title_typography[letter-spacing]", function(e) {
    $currentVal = $(".sidebar .widget h2").css("letter-spacing");
    e.bind(function(e) {
        if (e) {
            $(".sidebar .widget h2").css("letter-spacing", parseInt(e, 10) + "px");
        } else {
            $(".sidebar .widget h2").css("letter-spacing", "");
        }
    });
});
wp.customize("sidebar_widget_title_typography[text-transform]", function(e) {
    $currentVal = $(".sidebar .widget h2").css("text-transform");
    e.bind(function(e) {
        if (e) {
            $(".sidebar .widget h2").css("text-transform", e);
        } else {
            $(".sidebar .widget h2").css("text-transform", "");
        }
    });
});
wp.customize("footer_widget_title_typography[font-weight]", function(e) {
    $currentVal = $(".site-footer .widget h3").css("font-weight");
    e.bind(function(e) {
        if (e) {
            $(".site-footer .widget h3").css("font-weight", e);
        } else {
            $(".site-footer .widget h3").css("font-weight", "");
        }
    });
});
wp.customize("footer_widget_title_typography[font-style]", function(e) {
    $currentVal = $(".site-footer .widget h3").css("font-style");
    e.bind(function(e) {
        if (e) {
            $(".site-footer .widget h3").css("font-style", e);
        } else {
            $(".site-footer .widget h3").css("font-style", "");
        }
    });
});
wp.customize("footer_widget_title_typography[font-size]", function(e) {
    $currentVal = $(".site-footer .widget h3").css("font-size");
    e.bind(function(e) {
        if (e) {
            $(".site-footer .widget h3").css("font-size", parseInt(e, 10) + "px");
        } else {
            $(".site-footer .widget h3").css("font-size", "");
        }
    });
});
wp.customize("footer_widget_title_typography[color]", function(e) {
    $currentVal = $(".site-footer .widget h3").css("color");
    e.bind(function(e) {
        if (e) {
            $(".site-footer .widget h3").css("color", e);
        } else {
            $(".site-footer .widget h3").css("color", "");
        }
    });
});
wp.customize("footer_widget_title_typography[line-height]", function(e) {
    $currentVal = $(".site-footer .widget h3").css("line-height");
    e.bind(function(e) {
        if (e) {
            $(".site-footer .widget h3").css("line-height", e);
        } else {
            $(".site-footer .widget h3").css("line-height", "");
        }
    });
});
wp.customize("footer_widget_title_typography[letter-spacing]", function(e) {
    $currentVal = $(".site-footer .widget h3").css("letter-spacing");
    e.bind(function(e) {
        if (e) {
            $(".site-footer .widget h3").css("letter-spacing", parseInt(e, 10) + "px");
        } else {
            $(".site-footer .widget h3").css("letter-spacing", "");
        }
    });
});
wp.customize("footer_widget_title_typography[text-transform]", function(e) {
    $currentVal = $(".site-footer .widget h3").css("text-transform");
    e.bind(function(e) {
        if (e) {
            $(".site-footer .widget h3").css("text-transform", e);
        } else {
            $(".site-footer .widget h3").css("text-transform", "");
        }
    });
});
wp.customize("footer_paragraph_typography[font-weight]", function(e) {
    $currentVal = $(".site-footer p").css("font-weight");
    e.bind(function(e) {
        if (e) {
            $(".site-footer p").css("font-weight", e);
        } else {
            $(".site-footer p").css("font-weight", "");
        }
    });
});
wp.customize("footer_paragraph_typography[font-style]", function(e) {
    $currentVal = $(".site-footer p").css("font-style");
    e.bind(function(e) {
        if (e) {
            $(".site-footer p").css("font-style", e);
        } else {
            $(".site-footer p").css("font-style", "");
        }
    });
});
wp.customize("footer_paragraph_typography[font-size]", function(e) {
    $currentVal = $(".site-footer p").css("font-size");
    e.bind(function(e) {
        if (e) {
            $(".site-footer p").css("font-size", parseInt(e, 10) + "px");
        } else {
            $(".site-footer p").css("font-size", "");
        }
    });
});
wp.customize("footer_paragraph_typography[color]", function(e) {
    $currentVal = $(".site-footer p").css("color");
    e.bind(function(e) {
        if (e) {
            $(".site-footer p").css("color", e);
        } else {
            $(".site-footer p").css("color", "");
        }
    });
});
wp.customize("footer_paragraph_typography[line-height]", function(e) {
    $currentVal = $(".site-footer p").css("line-height");
    e.bind(function(e) {
        if (e) {
            $(".site-footer p").css("line-height", e);
        } else {
            $(".site-footer p").css("line-height", "");
        }
    });
});
wp.customize("footer_paragraph_typography[letter-spacing]", function(e) {
    $currentVal = $(".site-footer p").css("letter-spacing");
    e.bind(function(e) {
        if (e) {
            $(".site-footer p").css("letter-spacing", parseInt(e, 10) + "px");
        } else {
            $(".site-footer p").css("letter-spacing", "");
        }
    });
});
wp.customize("footer_paragraph_typography[text-transform]", function(e) {
    $currentVal = $(".site-footer p").css("text-transform");
    e.bind(function(e) {
        if (e) {
            $(".site-footer p").css("text-transform", e);
        } else {
            $(".site-footer p").css("text-transform", "");
        }
    });
});
wp.customize("footer_list_typography[font-weight]", function(e) {
    $currentVal = $(".site-footer ul").css("font-weight");
    e.bind(function(e) {
        if (e) {
            $(".site-footer ul").css("font-weight", e);
        } else {
            $(".site-footer ul").css("font-weight", "");
        }
    });
});
wp.customize("footer_list_typography[font-style]", function(e) {
    $currentVal = $(".site-footer ul").css("font-style");
    e.bind(function(e) {
        if (e) {
            $(".site-footer ul").css("font-style", e);
        } else {
            $(".site-footer ul").css("font-style", "");
        }
    });
});
wp.customize("footer_list_typography[font-size]", function(e) {
    $currentVal = $(".site-footer ul").css("font-size");
    e.bind(function(e) {
        if (e) {
            $(".site-footer ul").css("font-size", parseInt(e, 10) + "px");
        } else {
            $(".site-footer ul").css("font-size", "");
        }
    });
});
wp.customize("footer_list_typography[color]", function(e) {
    $currentVal = $(".site-footer ul").css("color");
    e.bind(function(e) {
        if (e) {
            $(".site-footer ul").css("color", e);
        } else {
            $(".site-footer ul").css("color", "");
        }
    });
});
wp.customize("footer_list_typography[line-height]", function(e) {
    $currentVal = $(".site-footer ul").css("line-height");
    e.bind(function(e) {
        if (e) {
            $(".site-footer ul").css("line-height", e);
        } else {
            $(".site-footer ul").css("line-height", "");
        }
    });
});
wp.customize("footer_list_typography[letter-spacing]", function(e) {
    $currentVal = $(".site-footer ul").css("letter-spacing");
    e.bind(function(e) {
        if (e) {
            $(".site-footer ul").css("letter-spacing", parseInt(e, 10) + "px");
        } else {
            $(".site-footer ul").css("letter-spacing", "");
        }
    });
});
wp.customize("footer_list_typography[text-transform]", function(e) {
    $currentVal = $(".site-footer ul").css("text-transform");
    e.bind(function(e) {
        if (e) {
            $(".site-footer ul").css("text-transform", e);
        } else {
            $(".site-footer ul").css("text-transform", "");
        }
    });
});
wp.customize("blog_post_title_typography[font-weight]", function(e) {
    $currentVal = $(".post header h3").css("font-weight");
    e.bind(function(e) {
        if (e) {
            $(".post header h3").css("font-weight", e);
        } else {
            $(".post header h3").css("font-weight", "");
        }
    });
});
wp.customize("blog_post_title_typography[font-style]", function(e) {
    $currentVal = $(".post header h3").css("font-style");
    e.bind(function(e) {
        if (e) {
            $(".post header h3").css("font-style", e);
        } else {
            $(".post header h3").css("font-style", "");
        }
    });
});
wp.customize("blog_post_title_typography[font-size]", function(e) {
    $currentVal = $(".post header h3").css("font-size");
    e.bind(function(e) {
        if (e) {
            $(".post header h3").css("font-size", parseInt(e, 10) + "px");
        } else {
            $(".post header h3").css("font-size", "");
        }
    });
});
wp.customize("blog_post_title_typography[color]", function(e) {
    $currentVal = $(".post header h3").css("color");
    e.bind(function(e) {
        if (e) {
            $(".post header h3").css("color", e);
        } else {
            $(".post header h3").css("color", "");
        }
    });
});
wp.customize("blog_post_title_typography[line-height]", function(e) {
    $currentVal = $(".post header h3").css("line-height");
    e.bind(function(e) {
        if (e) {
            $(".post header h3").css("line-height", e);
        } else {
            $(".post header h3").css("line-height", "");
        }
    });
});
wp.customize("blog_post_title_typography[letter-spacing]", function(e) {
    $currentVal = $(".post header h3").css("letter-spacing");
    e.bind(function(e) {
        if (e) {
            $(".post header h3").css("letter-spacing", parseInt(e, 10) + "px");
        } else {
            $(".post header h3").css("letter-spacing", "");
        }
    });
});
wp.customize("blog_post_title_typography[text-transform]", function(e) {
    $currentVal = $(".post header h3").css("text-transform");
    e.bind(function(e) {
        if (e) {
            $(".post header h3").css("text-transform", e);
        } else {
            $(".post header h3").css("text-transform", "");
        }
    });
});
wp.customize("entry_h3_typography[font-weight]", function(e) {
    $currentVal = $(".post .author h3, .comments-title, .comment-reply-title").css("font-weight");
    e.bind(function(e) {
        if (e) {
            $(".post .author h3, .comments-title, .comment-reply-title").css("font-weight", e);
        } else {
            $(".post .author h3, .comments-title, .comment-reply-title").css("font-weight", "");
        }
    });
});
wp.customize("entry_h3_typography[font-style]", function(e) {
    $currentVal = $(".post .author h3, .comments-title, .comment-reply-title").css("font-style");
    e.bind(function(e) {
        if (e) {
            $(".post .author h3, .comments-title, .comment-reply-title").css("font-style", e);
        } else {
            $(".post .author h3, .comments-title, .comment-reply-title").css("font-style", "");
        }
    });
});
wp.customize("entry_h3_typography[font-size]", function(e) {
    $currentVal = $(".post .author h3, .comments-title, .comment-reply-title").css("font-size");
    e.bind(function(e) {
        if (e) {
            $(".post .author h3, .comments-title, .comment-reply-title").css("font-size", parseInt(e, 10) + "px");
        } else {
            $(".post .author h3, .comments-title, .comment-reply-title").css("font-size", "");
        }
    });
});
wp.customize("entry_h3_typography[color]", function(e) {
    $currentVal = $(".post .author h3, .comments-title, .comment-reply-title").css("color");
    e.bind(function(e) {
        if (e) {
            $(".post .author h3, .comments-title, .comment-reply-title").css("color", e);
        } else {
            $(".post .author h3, .comments-title, .comment-reply-title").css("color", "");
        }
    });
});
wp.customize("entry_h3_typography[line-height]", function(e) {
    $currentVal = $(".post .author h3, .comments-title, .comment-reply-title").css("line-height");
    e.bind(function(e) {
        if (e) {
            $(".post .author h3, .comments-title, .comment-reply-title").css("line-height", e);
        } else {
            $(".post .author h3, .comments-title, .comment-reply-title").css("line-height", "");
        }
    });
});
wp.customize("entry_h3_typography[letter-spacing]", function(e) {
    $currentVal = $(".post .author h3, .comments-title, .comment-reply-title").css("letter-spacing");
    e.bind(function(e) {
        if (e) {
            $(".post .author h3, .comments-title, .comment-reply-title").css("letter-spacing", parseInt(e, 10) + "px");
        } else {
            $(".post .author h3, .comments-title, .comment-reply-title").css("letter-spacing", "");
        }
    });
});
wp.customize("entry_h3_typography[text-transform]", function(e) {
    $currentVal = $(".post .author h3, .comments-title, .comment-reply-title").css("text-transform");
    e.bind(function(e) {
        if (e) {
            $(".post .author h3, .comments-title, .comment-reply-title").css("text-transform", e);
        } else {
            $(".post .author h3, .comments-title, .comment-reply-title").css("text-transform", "");
        }
    });
});
wp.customize("copyright_typography[font-weight]", function(e) {
    $currentVal = $(".site-info").css("font-weight");
    e.bind(function(e) {
        if (e) {
            $(".site-info").css("font-weight", e);
        } else {
            $(".site-info").css("font-weight", "");
        }
    });
});
wp.customize("copyright_typography[font-style]", function(e) {
    $currentVal = $(".site-info").css("font-style");
    e.bind(function(e) {
        if (e) {
            $(".site-info").css("font-style", e);
        } else {
            $(".site-info").css("font-style", "");
        }
    });
});
wp.customize("copyright_typography[font-size]", function(e) {
    $currentVal = $(".site-info").css("font-size");
    e.bind(function(e) {
        if (e) {
            $(".site-info").css("font-size", parseInt(e, 10) + "px");
        } else {
            $(".site-info").css("font-size", "");
        }
    });
});
wp.customize("copyright_typography[color]", function(e) {
    $currentVal = $(".site-info").css("color");
    e.bind(function(e) {
        if (e) {
            $(".site-info").css("color", e);
        } else {
            $(".site-info").css("color", "");
        }
    });
});
wp.customize("copyright_typography[line-height]", function(e) {
    $currentVal = $(".site-info").css("line-height");
    e.bind(function(e) {
        if (e) {
            $(".site-info").css("line-height", e);
        } else {
            $(".site-info").css("line-height", "");
        }
    });
});
wp.customize("copyright_typography[letter-spacing]", function(e) {
    $currentVal = $(".site-info").css("letter-spacing");
    e.bind(function(e) {
        if (e) {
            $(".site-info").css("letter-spacing", parseInt(e, 10) + "px");
        } else {
            $(".site-info").css("letter-spacing", "");
        }
    });
});
wp.customize("copyright_typography[text-transform]", function(e) {
    $currentVal = $(".site-info").css("text-transform");
    e.bind(function(e) {
        if (e) {
            $(".site-info").css("text-transform", e);
        } else {
            $(".site-info").css("text-transform", "");
        }
    });
});
wp.customize("button_typography[font-weight]", function(e) {
    $currentVal = $(".btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price").css("font-weight");
    e.bind(function(e) {
        if (e) {
            $(".btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price").css("font-weight", e);
        } else {
            $(".btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price").css("font-weight", "");
        }
    });
});
wp.customize("button_typography[font-style]", function(e) {
    $currentVal = $(".btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price").css("font-style");
    e.bind(function(e) {
        if (e) {
            $(".btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price").css("font-style", e);
        } else {
            $(".btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price").css("font-style", "");
        }
    });
});
wp.customize("button_typography[font-size]", function(e) {
    $currentVal = $(".btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price").css("font-size");
    e.bind(function(e) {
        if (e) {
            $(".btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price").css("font-size", parseInt(e, 10) + "px");
        } else {
            $(".btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price").css("font-size", "");
        }
    });
});
wp.customize("button_typography[color]", function(e) {
    $currentVal = $(".btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price").css("color");
    e.bind(function(e) {
        if (e) {
            $(".btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price").css("color", e);
        } else {
            $(".btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price").css("color", "");
        }
    });
});
wp.customize("button_typography[line-height]", function(e) {
    $currentVal = $(".btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price").css("line-height");
    e.bind(function(e) {
        if (e) {
            $(".btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price").css("line-height", e);
        } else {
            $(".btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price").css("line-height", "");
        }
    });
});
wp.customize("button_typography[letter-spacing]", function(e) {
    $currentVal = $(".btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price").css("letter-spacing");
    e.bind(function(e) {
        if (e) {
            $(".btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price").css("letter-spacing", parseInt(e, 10) + "px");
        } else {
            $(".btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price").css("letter-spacing", "");
        }
    });
});
wp.customize("button_typography[text-transform]", function(e) {
    $currentVal = $(".btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price").css("text-transform");
    e.bind(function(e) {
        if (e) {
            $(".btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price").css("text-transform", e);
        } else {
            $(".btn-primary, .room_grid_item .room_grid_price, .room_grid_item_hover .room_grid_price_hover, .room_grid_item_hover .room_grid_price").css("text-transform", "");
        }
    });
});
wp.customize("weather_time_typography[font-weight]", function(e) {
    $currentVal = $(".simple-weather em,.calluna-time .time").css("font-weight");
    e.bind(function(e) {
        if (e) {
            $(".simple-weather em,.calluna-time .time").css("font-weight", e);
        } else {
            $(".simple-weather em,.calluna-time .time").css("font-weight", "");
        }
    });
});
wp.customize("weather_time_typography[font-style]", function(e) {
    $currentVal = $(".simple-weather em,.calluna-time .time").css("font-style");
    e.bind(function(e) {
        if (e) {
            $(".simple-weather em,.calluna-time .time").css("font-style", e);
        } else {
            $(".simple-weather em,.calluna-time .time").css("font-style", "");
        }
    });
});
wp.customize("weather_time_typography[font-size]", function(e) {
    $currentVal = $(".simple-weather em,.calluna-time .time").css("font-size");
    e.bind(function(e) {
        if (e) {
            $(".simple-weather em,.calluna-time .time").css("font-size", parseInt(e, 10) + "px");
        } else {
            $(".simple-weather em,.calluna-time .time").css("font-size", "");
        }
    });
});
wp.customize("weather_time_typography[color]", function(e) {
    $currentVal = $(".simple-weather em,.calluna-time .time").css("color");
    e.bind(function(e) {
        if (e) {
            $(".simple-weather em,.calluna-time .time").css("color", e);
        } else {
            $(".simple-weather em,.calluna-time .time").css("color", "");
        }
    });
});
wp.customize("weather_time_typography[line-height]", function(e) {
    $currentVal = $(".simple-weather em,.calluna-time .time").css("line-height");
    e.bind(function(e) {
        if (e) {
            $(".simple-weather em,.calluna-time .time").css("line-height", e);
        } else {
            $(".simple-weather em,.calluna-time .time").css("line-height", "");
        }
    });
});
wp.customize("weather_time_typography[letter-spacing]", function(e) {
    $currentVal = $(".simple-weather em,.calluna-time .time").css("letter-spacing");
    e.bind(function(e) {
        if (e) {
            $(".simple-weather em,.calluna-time .time").css("letter-spacing", parseInt(e, 10) + "px");
        } else {
            $(".simple-weather em,.calluna-time .time").css("letter-spacing", "");
        }
    });
});
wp.customize("weather_time_typography[text-transform]", function(e) {
    $currentVal = $(".simple-weather em,.calluna-time .time").css("text-transform");
    e.bind(function(e) {
        if (e) {
            $(".simple-weather em,.calluna-time .time").css("text-transform", e);
        } else {
            $(".simple-weather em,.calluna-time .time").css("text-transform", "");
        }
    });
});
wp.customize("calendar_typography[font-weight]", function(e) {
    $currentVal = $("#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li").css("font-weight");
    e.bind(function(e) {
        if (e) {
            $("#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li").css("font-weight", e);
        } else {
            $("#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li").css("font-weight", "");
        }
    });
});
wp.customize("calendar_typography[font-style]", function(e) {
    $currentVal = $("#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li").css("font-style");
    e.bind(function(e) {
        if (e) {
            $("#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li").css("font-style", e);
        } else {
            $("#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li").css("font-style", "");
        }
    });
});
wp.customize("calendar_typography[font-size]", function(e) {
    $currentVal = $("#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li").css("font-size");
    e.bind(function(e) {
        if (e) {
            $("#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li").css("font-size", parseInt(e, 10) + "px");
        } else {
            $("#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li").css("font-size", "");
        }
    });
});
wp.customize("calendar_typography[color]", function(e) {
    $currentVal = $("#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li").css("color");
    e.bind(function(e) {
        if (e) {
            $("#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li").css("color", e);
        } else {
            $("#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li").css("color", "");
        }
    });
});
wp.customize("calendar_typography[line-height]", function(e) {
    $currentVal = $("#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li").css("line-height");
    e.bind(function(e) {
        if (e) {
            $("#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li").css("line-height", e);
        } else {
            $("#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li").css("line-height", "");
        }
    });
});
wp.customize("calendar_typography[letter-spacing]", function(e) {
    $currentVal = $("#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li").css("letter-spacing");
    e.bind(function(e) {
        if (e) {
            $("#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li").css("letter-spacing", parseInt(e, 10) + "px");
        } else {
            $("#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li").css("letter-spacing", "");
        }
    });
});
wp.customize("calendar_typography[text-transform]", function(e) {
    $currentVal = $("#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li").css("text-transform");
    e.bind(function(e) {
        if (e) {
            $("#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li").css("text-transform", e);
        } else {
            $("#datePicker, #datePicker .dateField, .dateField p.day, #datePicker .ui-state-default, #gasteSelect li").css("text-transform", "");
        }
    });
});
wp.customize("dates_typography[font-weight]", function(e) {
    $currentVal = $(".event_grid_month, .event_grid_day, .post_date_wrapper .month, .post_date_wrapper .day, .inline_date_wrapper .day, .inline_date_wrapper .month").css("font-weight");
    e.bind(function(e) {
        if (e) {
            $(".event_grid_month, .event_grid_day, .post_date_wrapper .month, .post_date_wrapper .day, .inline_date_wrapper .day, .inline_date_wrapper .month").css("font-weight", e);
        } else {
            $(".event_grid_month, .event_grid_day, .post_date_wrapper .month, .post_date_wrapper .day, .inline_date_wrapper .day, .inline_date_wrapper .month").css("font-weight", "");
        }
    });
});
wp.customize("dates_typography[font-style]", function(e) {
    $currentVal = $(".event_grid_month, .event_grid_day, .post_date_wrapper .month, .post_date_wrapper .day, .inline_date_wrapper .day, .inline_date_wrapper .month").css("font-style");
    e.bind(function(e) {
        if (e) {
            $(".event_grid_month, .event_grid_day, .post_date_wrapper .month, .post_date_wrapper .day, .inline_date_wrapper .day, .inline_date_wrapper .month").css("font-style", e);
        } else {
            $(".event_grid_month, .event_grid_day, .post_date_wrapper .month, .post_date_wrapper .day, .inline_date_wrapper .day, .inline_date_wrapper .month").css("font-style", "");
        }
    });
});
wp.customize("dates_typography[font-size]", function(e) {
    $currentVal = $(".event_grid_month, .event_grid_day, .post_date_wrapper .month, .post_date_wrapper .day, .inline_date_wrapper .day, .inline_date_wrapper .month").css("font-size");
    e.bind(function(e) {
        if (e) {
            $(".event_grid_month, .event_grid_day, .post_date_wrapper .month, .post_date_wrapper .day, .inline_date_wrapper .day, .inline_date_wrapper .month").css("font-size", parseInt(e, 10) + "px");
        } else {
            $(".event_grid_month, .event_grid_day, .post_date_wrapper .month, .post_date_wrapper .day, .inline_date_wrapper .day, .inline_date_wrapper .month").css("font-size", "");
        }
    });
});
wp.customize("dates_typography[color]", function(e) {
    $currentVal = $(".event_grid_month, .event_grid_day, .post_date_wrapper .month, .post_date_wrapper .day, .inline_date_wrapper .day, .inline_date_wrapper .month").css("color");
    e.bind(function(e) {
        if (e) {
            $(".event_grid_month, .event_grid_day, .post_date_wrapper .month, .post_date_wrapper .day, .inline_date_wrapper .day, .inline_date_wrapper .month").css("color", e);
        } else {
            $(".event_grid_month, .event_grid_day, .post_date_wrapper .month, .post_date_wrapper .day, .inline_date_wrapper .day, .inline_date_wrapper .month").css("color", "");
        }
    });
});
wp.customize("dates_typography[line-height]", function(e) {
    $currentVal = $(".event_grid_month, .event_grid_day, .post_date_wrapper .month, .post_date_wrapper .day, .inline_date_wrapper .day, .inline_date_wrapper .month").css("line-height");
    e.bind(function(e) {
        if (e) {
            $(".event_grid_month, .event_grid_day, .post_date_wrapper .month, .post_date_wrapper .day, .inline_date_wrapper .day, .inline_date_wrapper .month").css("line-height", e);
        } else {
            $(".event_grid_month, .event_grid_day, .post_date_wrapper .month, .post_date_wrapper .day, .inline_date_wrapper .day, .inline_date_wrapper .month").css("line-height", "");
        }
    });
});
wp.customize("dates_typography[letter-spacing]", function(e) {
    $currentVal = $(".event_grid_month, .event_grid_day, .post_date_wrapper .month, .post_date_wrapper .day, .inline_date_wrapper .day, .inline_date_wrapper .month").css("letter-spacing");
    e.bind(function(e) {
        if (e) {
            $(".event_grid_month, .event_grid_day, .post_date_wrapper .month, .post_date_wrapper .day, .inline_date_wrapper .day, .inline_date_wrapper .month").css("letter-spacing", parseInt(e, 10) + "px");
        } else {
            $(".event_grid_month, .event_grid_day, .post_date_wrapper .month, .post_date_wrapper .day, .inline_date_wrapper .day, .inline_date_wrapper .month").css("letter-spacing", "");
        }
    });
});
wp.customize("dates_typography[text-transform]", function(e) {
    $currentVal = $(".event_grid_month, .event_grid_day, .post_date_wrapper .month, .post_date_wrapper .day, .inline_date_wrapper .day, .inline_date_wrapper .month").css("text-transform");
    e.bind(function(e) {
        if (e) {
            $(".event_grid_month, .event_grid_day, .post_date_wrapper .month, .post_date_wrapper .day, .inline_date_wrapper .day, .inline_date_wrapper .month").css("text-transform", e);
        } else {
            $(".event_grid_month, .event_grid_day, .post_date_wrapper .month, .post_date_wrapper .day, .inline_date_wrapper .day, .inline_date_wrapper .month").css("text-transform", "");
        }
    });
});
wp.customize("prices_typography[font-weight]", function(e) {
    $currentVal = $(".offer_price").css("font-weight");
    e.bind(function(e) {
        if (e) {
            $(".offer_price").css("font-weight", e);
        } else {
            $(".offer_price").css("font-weight", "");
        }
    });
});
wp.customize("prices_typography[font-style]", function(e) {
    $currentVal = $(".offer_price").css("font-style");
    e.bind(function(e) {
        if (e) {
            $(".offer_price").css("font-style", e);
        } else {
            $(".offer_price").css("font-style", "");
        }
    });
});
wp.customize("prices_typography[font-size]", function(e) {
    $currentVal = $(".offer_price").css("font-size");
    e.bind(function(e) {
        if (e) {
            $(".offer_price").css("font-size", parseInt(e, 10) + "px");
        } else {
            $(".offer_price").css("font-size", "");
        }
    });
});
wp.customize("prices_typography[color]", function(e) {
    $currentVal = $(".offer_price").css("color");
    e.bind(function(e) {
        if (e) {
            $(".offer_price").css("color", e);
        } else {
            $(".offer_price").css("color", "");
        }
    });
});
wp.customize("prices_typography[line-height]", function(e) {
    $currentVal = $(".offer_price").css("line-height");
    e.bind(function(e) {
        if (e) {
            $(".offer_price").css("line-height", e);
        } else {
            $(".offer_price").css("line-height", "");
        }
    });
});
wp.customize("prices_typography[letter-spacing]", function(e) {
    $currentVal = $(".offer_price").css("letter-spacing");
    e.bind(function(e) {
        if (e) {
            $(".offer_price").css("letter-spacing", parseInt(e, 10) + "px");
        } else {
            $(".offer_price").css("letter-spacing", "");
        }
    });
});
wp.customize("prices_typography[text-transform]", function(e) {
    $currentVal = $(".offer_price").css("text-transform");
    e.bind(function(e) {
        if (e) {
            $(".offer_price").css("text-transform", e);
        } else {
            $(".offer_price").css("text-transform", "");
        }
    });
});

} )( jQuery );