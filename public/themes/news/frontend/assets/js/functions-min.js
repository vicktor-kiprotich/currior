var i_refresh={},is_RTL=!1;!function(e){"use strict";var a,t,i,r,n,o,s,d,l,c,u=!1;e(document).ready((function(){function p(e,a){if(void 0!==e)var t=e.find(".rating-percentages-inner"),i=e.find(".bdaia-fp-post-img-container, .mm-img, .img, .img-lazy, .lazy-bg, .article-thumb-bg .article-link-thumb-bg");else t=jQuery(".rating-percentages-inner"),i=jQuery(".bdaia-fp-post-img-container, .mm-img, .img, .img-lazy:visible, .lazy-bg:visible, .article-thumb-bg .article-link-thumb-bg");t.viewportChecker({callbackFunction:function(e,a){setTimeout((function(){var a=e.data("rate-val")+"%";e.velocity("stop").velocity({width:a},{stagger:200,duration:600})}),500)}}),i.viewportChecker({callbackFunction:function(e,a){setTimeout((function(){e.lazy({effect:"fadeIn",effectTime:500})}),500)}})}performance.mark("KolStart"),p(),a=e(document),t=jQuery(document.body),i=jQuery(window),r=jQuery("html"),u=!1,n=jQuery("nav#navigation.fixed-enabled"),jQuery(".navigation-outer"),o=jQuery(window).width(),!0,!0,!0,!0,!1,!0,!1,!0,"","",s=jQuery(".bd-push-menu #mobile-menu"),d=jQuery(".bdaia-popup"),t.is(".admin-bar")?jQuery("#wpadminbar").height():0,!0,jQuery(".insta-lazy").lazy({effect:"fadeIn",effectTime:500}),jQuery('a[href^="#"]').on("click",(function(e){var a=jQuery(this.getAttribute("href"));a.length&&(e.preventDefault(),jQuery("html, body").stop().animate({scrollTop:a.offset().top},1e3))})),jQuery(".prev, .nxt, .flex-next, .flex-prev, .bdaia-load-comments-btn a, .bd-login-j a").on("click",(function(e){e.preventDefault()})),jQuery("#page").fitVids({ignore:"",customSelector:"iframe[src*='maps.google.com'], iframe[src*='google.com/maps'], iframe[src*='dailymotion.com'], iframe[src*='twitter.com/i/videos']"}),jQuery("span.bdaia__top_header_search_icon").on("touchend click",(function(e){!1===jQuery("div.bdaia__top_header_search").hasClass("bdaia__top_expanded_search")?(e.preventDefault(),jQuery("div.bdaia__top_header_search").addClass("bdaia__top_expanded_search"),jQuery("div.bdaia__top_header_search input.search-field").focus()):jQuery("div.bdaia__top_header_search input.search-field").val()||(e.preventDefault(),jQuery("div.bdaia__top_header_search").removeClass("bdaia__top_expanded_search"),jQuery("div.bdaia__top_header_search input.search-field").blur())}));jQuery(".bd-subnav-wrapper").outerHeight();var y=n.outerHeight();if(n.parent().css({height:y}),n.tiesticky("destroy"),n.length>0&&o>991){var b=n.offset().top;n.tiesticky({offset:b,tolerance:0})}function f(e,a){return e!==document&&(!!jQuery(e).hasClass(a)||e.parentNode&&f(e.parentNode,a))}var m=function(){t.removeClass("bd-push-menu-open")},h=function(e){f(e.target,"bd-push-menu")||(m(),document.removeEventListener("touchstart",h),document.removeEventListener("click",h))};jQuery(".bdaia-push-menu").on("touchstart click",(function(e){e.stopPropagation(),e.preventDefault(),jQuery("body").addClass("bd-push-menu-open"),jQuery("aside.bd-push-menu .lazy-img").lazy({bind:"event"})})),t.on("touchstart click",h),a.on("keydown",(function(e){27==e.which&&(m(),document.removeEventListener("touchstart",h),document.removeEventListener("click",h))})),jQuery("body").on("click",".bd-push-menu-close",(function(){m()})),i.resize((function(){991==(o=i.width())&&m()}));var g=jQuery(".bdaia-header-default #navigation #menu-primary").clone();g.find(".sub_cats_posts .mega-menu-content, .nav-logo, .logo, .bd-push-menu-btn").remove(),s.append(g);var v=jQuery(".bdaia-header-default .topbar ul.top-nav").clone();s.append(v);var j=jQuery(".bd-subnav-wrapper .sub-nav").clone();function _(){return l=jQuery("<div>").css({visibility:"hidden",width:100,display:"none",overflow:"scroll"}).appendTo("body"),c=jQuery("<div>").css({width:"100%"}).appendTo(l).outerWidth(),l.remove(),100-c}function Q(e){jQuery(e).show(),setTimeout((function(){t.addClass("bdaia-popup-is-opend")}),10),r.css({marginRight:_(),overflow:"hidden"})}function x(){jQuery.when(d.fadeOut(500)).done((function(){r.removeAttr("style")})),t.removeClass("bdaia-popup-is-opend")}if(s.append(j),jQuery(".bd-push-menu #mobile-menu .menu-item-has-children").append('<span class="mobile-arrows fa fa-chevron-down isOpen"></span>'),a.on("click","#mobile-menu .menu-item-has-children .mobile-arrows",(function(){jQuery(this).hasClass("isOpen")?jQuery(this).removeClass("isOpen"):jQuery(this).removeClass("isOpen").addClass("isOpen"),jQuery(this).parent().find("ul:first").toggle()})),a.on("click",".bd-login-j a",(function(e){e.preventDefault(),Q("#bd-login-join")})),"undefined"==typeof $adbDE3&&(u=!0,r.css({marginRight:_(),overflow:"hidden"}),setTimeout((function(){t.addClass("bdaia-popup-is-opend")}),10),Q("#bdaia-popup-adblock")),d.length&&!u&&a.keyup((function(e){"27"==e.which&&t.hasClass("bdaia-popup-is-opend")&&x()})),d.on("click",(function(e){jQuery(e.target).is(".bdaia-popup:not(.is-fixed-popup)")&&(e.preventDefault(),x())})),jQuery(".bdaia-btn-close").on("click",(function(){return x(),!1})),jQuery(".points-rating-div").each((function(e,a){var t=jQuery(this),i=t.attr("data-rate-val")+"%",r=t.attr("id"),n=jQuery("#"+r);t&&n.velocity("stop").velocity({width:i},{stagger:200,duration:600})})),jQuery().iLightBox){var w=jQuery(".bdaia-post-template");i_refresh=jQuery('a.lightbox-enabled, a[rel="lightbox-enabled, .bd-video-ilightbox"]').iLightBox({autostart:!1}),jQuery('a.lightbox-enabled, a[rel="lightbox-enabled"], .bd-video-ilightbox').iLightBox({autostart:!1}),w.find("div.bdaia-post-content a, .bdaia-post-heading a").not("div.bdaia-post-gallery a").not("div.bdaia-e3-container a").not("._e3lann a").each((function(a,t){t.href;e(this).find("img").length&&e(this).addClass("post_content_image")})),w.find(".ilightbox-gallery").iLightBox({path:"horizontal"}),jQuery(".bdaia-post-content a.post_content_image, .bdaia-post-heading a.post_content_image").iLightBox()}window.devicePixelRatio>1&&(jQuery(".bd-retina").each((function(){var e=jQuery(this).attr("src").replace(".png","@2x.png");e=e.replace(".jpg","@2x.jpg"),jQuery(this).attr("src",e)})),jQuery(".bd-retina-data").each((function(){jQuery(this).attr("src",jQuery(this).data("retina")),jQuery(this).addClass("bd-retina-src")}))),jQuery.fn.theiaStickySidebar&&o>900&&(jQuery(".theia_sticky").theiaStickySidebar({additionalMarginTop:32,minWidth:990}),jQuery(".is-sticky").theiaStickySidebar({additionalMarginTop:32,additionalMarginBottom:32,minWidth:990})),jQuery('iframe[src*="youtube.com"]').each((function(){var e=jQuery(this).attr("src");jQuery(this).attr("src").indexOf("?")>0?jQuery(this).attr({src:e+"&wmode=transparent",wmode:"Opaque"}):jQuery(this).attr({src:e+"?wmode=transparent",wmode:"Opaque"})}));var C=jQuery(".gotop");jQuery(window).scroll((function(){jQuery(this).scrollTop()>220?C.css({opacity:"1",bottom:"5px"}):C.css({opacity:"0",bottom:"-60px"})})),C.on("click",(function(e){return e.preventDefault(),jQuery("html, body").animate({scrollTop:0},500),!1})),jQuery("div.mega-cat-wrapper").each((function(){jQuery(this).find("div.mega-cat-content-tab").hide(),jQuery(this).find("ul.mega-cat-sub-categories li:first").addClass("cat-active").show(),jQuery(this).find("div.mega-cat-content-tab:first").addClass("already-loaded").show(),jQuery(this).find("ul.mega-cat-sub-categories li").mouseover((function(e){e.preventDefault(),jQuery(this).parent().find("li").removeClass("cat-active"),jQuery(this).addClass("cat-active"),jQuery(this).parent().parent().parent().find("div.mega-cat-content-tab").hide();var a=jQuery(this).find("a").attr("id");return jQuery(a).hasClass("already-loaded")?jQuery(a).fadeIn("fast"):jQuery(a).addClass("loading-items").fadeIn("fast",(function(){jQuery(this).removeClass("loading-items").addClass("already-loaded")})),!1}))}));var k=function(e){this.target=e,this.target.find(".components-sub-menu").css({dispay:"none",opacity:0}),this.target.on({mouseenter:this.reveal,mouseleave:this.conceal},"li")};k.prototype.reveal=function(){var e=jQuery(this).children(".components-sub-menu");e.hasClass("is_open")?e.velocity("stop").velocity("reverse"):e.velocity("stop").velocity("transition.slideDownIn",{duration:250,delay:0,complete:function(){e.addClass("is_open")}})},k.prototype.conceal=function(){var e=jQuery(this).children(".components-sub-menu");e.velocity("stop").velocity("transition.fadeOut",{duration:100,delay:0,complete:function(){e.removeClass("is_open")}})};new k(jQuery("ul.bd-components"));jQuery(".breaking-cont ul").each((function(){jQuery(this).find("li.active").length||jQuery(this).find("li:first").addClass("active fadeIn");var e=jQuery(this);window.setInterval((function(){var a=e.find("li.active");a.fadeOut((function(){var t=a.next();t.length||(t=e.find("li:first")),t.addClass("active fadeIn").fadeIn(),a.removeClass("active fadeIn")}))}),5e3)})),jQuery.fn.mCustomScrollbar&&jQuery(".push-menu-has-custom-scroll, .bd-login-join-wrapper").each((function(){var e=jQuery(this),a=e.data("height")?e.data("height"):"auto",t=e.data("padding")?e.data("padding"):0;if(e.mCustomScrollbar("destroy"),"window"==e.data("height")){var r=e.height(),n=i.height()-t-50;a=r<n?r:n}e.mCustomScrollbar({scrollButtons:{enable:!1},autoHideScrollbar:!e.hasClass("show-scroll"),scrollInertia:100,mouseWheel:{enable:!0,scrollAmount:60},set_height:a,advanced:{updateOnContentResize:!0},callbacks:{whileScrolling:function(){p(e)}}})})),jQuery(".articles-box").each((function(e,a){var t=jQuery(this).attr("id"),i=jQuery("#"+t),r=jQuery(i).find(".articles-box-filter-links-more-inner"),n=jQuery(i).find(".articles-box-filter-links").clone();r.append(n),jQuery(i).find(".button-more").on("click",(function(){var e=r.is(":visible"),a=e?"slideUp":"slideDown",t=e?100:200;r.velocity("stop").velocity(a,{easing:"easeOutQuart",duration:t})}))})),jQuery("body").on("click",".articles-box-title-arrow, .more-btn",(function(a){if(a.preventDefault(),e(this).hasClass("pagination-disabled"))return!1;var t=jQuery(this).closest(".articles-box"),i=t.get(0).id,r=jQuery("#"+i),n=jQuery.extend({},window["js_"+i]),o=jQuery("#"+i).attr("data-page"),s=jQuery(this).attr("data-type"),d=(jQuery(r).find(".bd_element_widget"),t.find(".articles-box-content")),l=(t.find(".articles-box-items"),t.find(".articles-box-container-wrapper"));if(jQuery(r).find(".articles-box-filter-links").hasClass("filter_categories"))var c=jQuery(r).find(".articles-box-filter-links li.active a").attr("data-id");else if(jQuery(r).find(".articles-box-filter-links").hasClass("filter_tags"))var u=jQuery(r).find(".articles-box-filter-links li.active a").attr("data-id");if("prev"==s){o--;var y=1}else{o++;y=n.max_num_pages}if(jQuery(r).hasClass("bd_element_widget_article"))var b="new_ajax_ele";else b="new_ajax";var f={action:b,the_box:n,"data-page":o,category_id:c,tag:u,type:s};return(o<=y&&("next"==s||"load_more"==s||"show_more"==s)||o>=y&&"prev"==s)&&jQuery.ajax({type:"post",url:bdaia.ajaxurl,data:f,beforeSend:function(){d.height();l.addClass("is-loading")},success:function(e){"prev"===s?(r.attr("data-page",o),r.find(".next_arrow").removeClass("pagination-disabled"),r.find(".more-btn").css("display","inline-block"),1==o&&jQuery("#"+i).find(".prev_arrow").addClass("pagination-disabled")):(r.attr("data-page",o),r.find(".prev_arrow").removeClass("pagination-disabled"),o==n.max_num_pages&&(r.find(".next_arrow").addClass("pagination-disabled"),r.find(".more-btn").css("display","none"))),"load_more"==s?r.find(".articles-box-content").append(e):r.find(".articles-box-content").html(e);var a=t.find(".articles-items-"+o);"prev"===s?a.find("li").hide().velocity("stop").velocity("transition.slideLeftIn",{stagger:100,duration:488,display:"inline-block",complete:function(){a.attr("style",""),p(a)}}):"next"===s?a.find("li").hide().velocity("stop").velocity("transition.slideRightIn",{stagger:100,duration:488,display:"inline-block",complete:function(){a.attr("style",""),p(a)}}):"show_more"===s?a.find("li").hide().velocity("stop").velocity("transition.fadeIn",{stagger:0,duration:488,display:"inline-block",complete:function(){a.attr("style",""),p(a)}}):a.find("li").hide().velocity("stop").velocity("transition.slideUpIn",{stagger:100,duration:488,display:"inline-block",complete:function(){a.attr("style",""),p(a)}}),(jQuery(r).find(".end_posts").length>0||""==e)&&(r.find(".next_arrow").addClass("pagination-disabled"),r.find(".more-btn").css("display","none"))},complete:function(e){l.removeClass("is-loading")}}),!1})),jQuery(".filter_categories,.filter_tags").on("click","li a",(function(e){e.preventDefault();var a=jQuery(this).closest(".articles-box"),t=a.attr("id"),i=jQuery("#"+t),r=jQuery.extend({},window["js_"+t]);if(jQuery(this).closest(".articles-box-filter-links").hasClass("filter_categories")){jQuery(".filter_categories li").removeClass("active"),jQuery(this).parent("li").addClass("active");var n=jQuery(this).attr("data-id")}else{jQuery(".filter_tags li").removeClass("active"),jQuery(this).parent("li").addClass("active");var o=jQuery(this).attr("data-id")}var s=jQuery(".articles-box-content"),d=a.find(".articles-box-items"),l=a.find(".articles-box-container-wrapper"),c=a.find(".articles-box-container");if(i.find(".end_posts").remove(),i.find(".next_arrow").removeClass("pagination-disabled"),i.find(".more-btn").removeAttr("style"),i.attr("data-page",1),jQuery(i).hasClass("bd_element_widget_article"))var u="filter_ajax_ele";else u="filter_ajax";var y={action:u,the_box:r,tag:o,category_id:n};return jQuery.ajax({type:"POST",url:bdaia.ajaxurl,data:y,beforeSend:function(){s.height();l.addClass("is-loading"),c.append('<div class="loader-overlay"><div class="bd-loading"></div></div>'),l.find(".articles-box-load-more").css("max-height","0px","transition","max-height 1s ease"),d.css("opacity","0.5"),a.hasClass("articles-box-next_prev")&&a.find(".loader-overlay").remove()},success:function(e){i.find(".articles-box-content").html(e),jQuery(i).find(".end_posts").length>0&&(i.find(".next_arrow").addClass("pagination-disabled"),i.find(".more-btn").css("display","none"))},complete:function(e){l.removeClass("is-loading"),c.find(".loader-overlay").remove(),l.find(".articles-box-load-more").css("max-height","100%","transition","max-height 1s ease"),d.css("opacity","1"),jQuery(i).find("ul.articles-box-items li").hide().velocity("stop").velocity("transition.slideRightIn",{stagger:100,duration:488,display:"inline-block",complete:function(){jQuery(i).find("ul.articles-box-items li").attr("style",""),p(jQuery(i).find("ul.articles-box-items li"))}})}}),!1})),jQuery("body").on("click",".general-more-btn",(function(e){e.preventDefault();var a=jQuery(".general-more-btn");if(!a.length)return!1;var t=a.attr("data-q"),i=(a.attr("data-url"),a.attr("data-max-num")),r=a.attr("data-query-vars"),n=a.attr("data-posts-per-page"),o=(a.attr("data-text"),a.attr("data-latest")),s=jQuery(this).closest(".articles-box"),d=s.attr("id"),l=jQuery("#"+d),c=jQuery(".articles-box"),u=(c.attr("id"),js_cat_box.block),y=c.find(".articles-box-content"),b=c.find(".articles-box-container-wrapper"),f=jQuery(this).attr("data-count"),m=jQuery("#"+d).attr("data-page");m++;var h={action:"general_ajax",query:t,max_num:i,query_vars:r,posts_per_page:n,page:m,latest_post:o,offset:s.find(".articles-box-item").length,count:f,layout:js_cat_box.layout,post_meta:js_cat_box.post_meta,read_more:js_cat_box.read_more,excerpt:js_cat_box.excerpt,excerpt_length:js_cat_box.excerpt_length,type:jQuery(this).attr("data-type"),block:u,data_page:m,id:jQuery(this).attr("data-id")};return jQuery.ajax({url:bdaia.ajaxurl,type:"post",data:h,beforeSend:function(){b.addClass("is-loading")},success:function(e){e.hide_next,1!=i&&i!=m||jQuery(".general-more-btn").css("display","none"),a.attr("data-latest",o),l.attr("data-page",m),a.attr("data-page",m);var t=jQuery(e);y.append(t);var r=s.find(".articles-items-"+m);r.find("li").hide().velocity("stop").velocity("transition.slideUpIn",{stagger:100,duration:1e3,display:"inline-block",complete:function(){r.attr("style",""),p(r)}})},complete:function(){b.removeClass("is-loading")}}),!1})),window.onload=function(){console.log("Loaded")},performance.mark("KolEnd"),performance.measure("Kol Custom JS","KolStart","KolEnd")}))}(jQuery);var win_height_padded=.9*jQuery(window).height();function bd_images_scroll(){var e=jQuery(window).scrollTop(),a=.9*jQuery(window).height();jQuery(".bdaia-lazyload .post-thumb, .bdaia-lazyload .block-article-img-container, .bdaia-lazyload .bdaia-fp-post-img-container, .bdaia-lazyload .big-grids, .bdaia-lazyload .bd-post-carousel, .bdaia-lazyload .post-image, .bdaia-lazyload .bdaia-post-featured-image, .bdaia-lazyload .bdaia-post-content img, .bdaia-lazyload .bd-block-mega-menu-post, .bdaia-lazyload .bdaia-featured-img-cover, .bdaia-lazyload .thumbnail-cover, .bdaia-lazyload .ei-slider, .bdaia-lazyload .bd-post-thumb, .bdaia-lazyload .bwb-article-img-container, .bdaia-lazyload div.bdaia-instagram-footer ul li a").each((function(){var t=jQuery(this).offset().top;e+a>t&&jQuery(this).addClass("bdaia-img-show")}))}function kolyoum_wb_ajax_js(e,a){var t=jQuery(".bdaia-wb-id"+e),i=jQuery(".bdaia-wb-id"+e+" .bdayh-posts-load-wait"),r=jQuery(".bdaia-wb-id"+e+" .bdaia-wb-more-btn"),n=jQuery(".bdaia-wb-id"+e+" .carousel-nav .mo-next"),o=jQuery(".bdaia-wb-id"+e+" .carousel-nav .mo-prev"),s=jQuery(".bdaia-wb-id"+e+" .bdaia-wb-inner"),d=jQuery(".bdaia-wb-id"+e+" .bdaia-nip-inner ul"),l=parseInt(t.attr("data-paged")),c=parseInt(t.attr("data-num_posts")),u=parseInt(t.attr("data-cat_uid")),p=t.attr("data-sort_order"),y=t.attr("data-tag_slug"),b=t.attr("data-cat_uids"),f=t.attr("data-posts"),m=t.attr("data-ajax_pagination"),h=t.attr("data-box_nu"),g=t.attr("data-max_nu"),v=(t.attr("data-total_posts_num"),t.attr("data-com_meta")),j=t.attr("data-review"),_=t.attr("data-author_meta"),Q=t.attr("data-date_meta"),x=t.attr("data-thumbnail");if("load_more"==m)l<g&&l++;else if(m="next_prev")if("next"==a)l<g&&l++;else{if(1==l)return!1;l-=1}return t.attr("data-paged",l),jQuery.ajax({type:"POST",url:bdaia.ajaxurl,dataType:"html",data:"action=bdaia_wboxs&nonce="+bdaia.nonce+"&paged="+l+"&sort_order="+p+"&num_posts="+c+"&tag_slug="+y+"&cat_uid="+u+"&cat_uids="+b+"&ajax_pagination="+m+"&box_nu="+h+"&com_meta="+v+"&author_meta="+_+"&review="+j+"&thumbnail="+x+"&date_meta="+Q+"&posts="+f,cache:!1,beforeSend:function(){i.css("display","block"),"wb1"!=h&&"wb2"!=h&&"wb3"!=h&&"wb4"!=h&&"wb5"!=h&&"wb6"!=h&&"wb7"!=h&&"wb9"!=h||("load_more"==m?s.css("opacity","1"):(m="next_prev")&&s.css("opacity","0.4")),"wb8"==h&&("load_more"==m?d.css("opacity","1"):(m="next_prev")&&d.css("opacity","0.4"))},success:function(e){if(""!==e.trim()){var a=jQuery(e);"wb1"!=h&&"wb2"!=h&&"wb3"!=h&&"wb4"!=h&&"wb5"!=h&&"wb6"!=h&&"wb7"!=h&&"wb9"!=h||("load_more"==m?s.append(a).fadeIn("fast"):(m="next_prev")&&(s.html(a).fadeIn("fast"),s.css("opacity","1"))),"wb8"==h&&("load_more"==m?d.append(a).fadeIn("fast"):(m="next_prev")&&(d.html(a).fadeIn("fast"),d.css("opacity","1"))),r.css("display","block"),i_refresh.refresh(),a.fitVids(),jQuery(".ttip").tipsy({fade:!0,gravity:"s"}),a.each((function(e){jQuery().mediaelementplayer&&jQuery(this).find(".wp-audio-shortcode, .wp-video-shortcode").mediaelementplayer()})),s.find(".bwb-article-img-container").addClass("bdaia-img-show")}i.css("display","none"),g==l?(r.remove(),n.addClass("ajax-page-disabled")):n.removeClass("ajax-page-disabled"),1==l?o.addClass("ajax-page-disabled"):o.removeClass("ajax-page-disabled")}},"html"),!1}jQuery(window).on("scroll",bd_images_scroll),bd_images_scroll();