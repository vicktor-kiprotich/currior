!function(e){"use strict";function t(){n=e.innerWidth||document.documentElement.clientWidth,a=e.innerHeight||document.documentElement.clientHeight}function i(e,t,i){e.addEventListener?e.addEventListener(t,i):e.attachEvent("on"+t,function(){i.call(e)})}function o(i){e.requestAnimationFrame(function(){"scroll"!==i.type&&t();for(var e=0,o=f.length;e<o;e++)"scroll"!==i.type&&(f[e].coverImage(),f[e].clipContainer()),f[e].onScroll()})}Date.now||(Date.now=function(){return(new Date).getTime()}),e.requestAnimationFrame||function(){for(var t=["webkit","moz"],i=0;i<t.length&&!e.requestAnimationFrame;++i){var o=t[i];e.requestAnimationFrame=e[o+"RequestAnimationFrame"],e.cancelAnimationFrame=e[o+"CancelAnimationFrame"]||e[o+"CancelRequestAnimationFrame"]}if(/iP(ad|hone|od).*OS 6/.test(e.navigator.userAgent)||!e.requestAnimationFrame||!e.cancelAnimationFrame){var n=0;e.requestAnimationFrame=function(e){var t=Date.now(),i=Math.max(n+16,t);return setTimeout(function(){e(n=i)},i-t)},e.cancelAnimationFrame=clearTimeout}}();var n,a,r=function(){if(!e.getComputedStyle)return!1;var t,i=document.createElement("p"),o={webkitTransform:"-webkit-transform",OTransform:"-o-transform",msTransform:"-ms-transform",MozTransform:"-moz-transform",transform:"transform"};(document.body||document.documentElement).insertBefore(i,null);for(var n in o)void 0!==i.style[n]&&(i.style[n]="translate3d(1px,1px,1px)",t=e.getComputedStyle(i).getPropertyValue(o[n]));return(document.body||document.documentElement).removeChild(i),void 0!==t&&t.length>0&&"none"!==t}(),s=navigator.userAgent.toLowerCase().indexOf("android")>-1,l=/iPad|iPhone|iPod/.test(navigator.userAgent)&&!e.MSStream,p=!!e.opera,m=/Edge\/\d+/.test(navigator.userAgent),d=/Trident.*rv[ :]*11\./.test(navigator.userAgent),c=!!Function("/*@cc_on return document.documentMode===10@*/")(),u=document.all&&!e.atob;t();var f=[],y=function(){function e(e,i){var o,n=this;if(n.$item=e,n.defaults={type:"scroll",speed:.5,imgSrc:null,imgWidth:null,imgHeight:null,enableTransform:!0,elementInViewport:null,zIndex:-100,noAndroid:!1,noIos:!0,onScroll:null,onInit:null,onDestroy:null,onCoverImage:null},o=JSON.parse(n.$item.getAttribute("data-jarallax")||"{}"),n.options=n.extend({},n.defaults,o,i),!(s&&n.options.noAndroid||l&&n.options.noIos)){n.options.speed=Math.min(2,Math.max(-1,parseFloat(n.options.speed)));var a=n.options.elementInViewport;a&&"object"==typeof a&&void 0!==a.length&&(a=a[0]),!a instanceof Element&&(a=null),n.options.elementInViewport=a,n.instanceID=t++,n.image={src:n.options.imgSrc||null,$container:null,$item:null,width:n.options.imgWidth||null,height:n.options.imgHeight||null,useImgTag:l||s||p||d||c||m},n.initImg()&&n.init()}}var t=0;return e}();y.prototype.css=function(t,i){if("string"==typeof i)return e.getComputedStyle?e.getComputedStyle(t).getPropertyValue(i):t.style[i];i.transform&&(i.WebkitTransform=i.MozTransform=i.transform);for(var o in i)t.style[o]=i[o];return t},y.prototype.extend=function(e){e=e||{};for(var t=1;t<arguments.length;t++)if(arguments[t])for(var i in arguments[t])arguments[t].hasOwnProperty(i)&&(e[i]=arguments[t][i]);return e},y.prototype.initImg=function(){var e=this;return null===e.image.src&&(e.image.src=e.css(e.$item,"background-image").replace(/^url\(['"]?/g,"").replace(/['"]?\)$/g,"")),!(!e.image.src||"none"===e.image.src)},y.prototype.init=function(){function e(){t.coverImage(),t.clipContainer(),t.onScroll(!0),t.options.onInit&&t.options.onInit.call(t),setTimeout(function(){t.$item&&t.css(t.$item,{"background-image":"none","background-attachment":"scroll","background-size":"auto"})},0)}var t=this,i={position:"absolute",top:0,left:0,width:"100%",height:"100%",overflow:"hidden",pointerEvents:"none"},o={position:"fixed"};t.$item.setAttribute("data-jarallax-original-styles",t.$item.getAttribute("style")),"static"===t.css(t.$item,"position")&&t.css(t.$item,{position:"relative"}),"auto"===t.css(t.$item,"z-index")&&t.css(t.$item,{zIndex:0}),t.image.$container=document.createElement("div"),t.css(t.image.$container,i),t.css(t.image.$container,{visibility:"hidden","z-index":t.options.zIndex}),t.image.$container.setAttribute("id","jarallax-container-"+t.instanceID),t.$item.appendChild(t.image.$container),t.image.useImgTag&&r&&t.options.enableTransform?(t.image.$item=document.createElement("img"),t.image.$item.setAttribute("src",t.image.src),o=t.extend({"max-width":"none"},i,o)):(t.image.$item=document.createElement("div"),o=t.extend({"background-position":"50% 50%","background-size":"100% auto","background-repeat":"no-repeat no-repeat","background-image":'url("'+t.image.src+'")'},i,o)),u&&(o.backgroundAttachment="fixed"),t.parentWithTransform=0;for(var n=t.$item;null!==n&&n!==document&&0===t.parentWithTransform;){var a=t.css(n,"-webkit-transform")||t.css(n,"-moz-transform")||t.css(n,"transform");a&&"none"!==a&&(t.parentWithTransform=1,t.css(t.image.$container,{transform:"translateX(0) translateY(0)"})),n=n.parentNode}t.css(t.image.$item,o),t.image.$container.appendChild(t.image.$item),t.image.width&&t.image.height?e():t.getImageSize(t.image.src,function(i,o){t.image.width=i,t.image.height=o,e()}),f.push(t)},y.prototype.destroy=function(){for(var e=this,t=0,i=f.length;t<i;t++)if(f[t].instanceID===e.instanceID){f.splice(t,1);break}var o=e.$item.getAttribute("data-jarallax-original-styles");e.$item.removeAttribute("data-jarallax-original-styles"),"null"===o?e.$item.removeAttribute("style"):e.$item.setAttribute("style",o),e.$clipStyles&&e.$clipStyles.parentNode.removeChild(e.$clipStyles),e.image.$container.parentNode.removeChild(e.image.$container),e.options.onDestroy&&e.options.onDestroy.call(e),delete e.$item.jarallax;for(var n in e)delete e[n]},y.prototype.getImageSize=function(e,t){if(e&&t){var i=new Image;i.onload=function(){t(i.width,i.height)},i.src=e}},y.prototype.clipContainer=function(){if(!u){var e=this,t=e.image.$container.getBoundingClientRect(),i=t.width,o=t.height;e.$clipStyles||(e.$clipStyles=document.createElement("style"),e.$clipStyles.setAttribute("type","text/css"),e.$clipStyles.setAttribute("id","#jarallax-clip-"+e.instanceID),(document.head||document.getElementsByTagName("head")[0]).appendChild(e.$clipStyles));var n=["#jarallax-container-"+e.instanceID+" {","   clip: rect(0 "+i+"px "+o+"px 0);","   clip: rect(0, "+i+"px, "+o+"px, 0);","}"].join("\n");e.$clipStyles.styleSheet?e.$clipStyles.styleSheet.cssText=n:e.$clipStyles.innerHTML=n}},y.prototype.coverImage=function(){var e=this;if(e.image.width&&e.image.height){var t=e.image.$container.getBoundingClientRect(),i=t.width,o=t.height,n=t.left,s=e.image.width,l=e.image.height,p=e.options.speed,m="scroll"===e.options.type||"scroll-opacity"===e.options.type,d=0,c=0,u=o,f=0,y=0;m&&(d=p<0?p*Math.max(o,a):p*(o+a),p>1?u=Math.abs(d-a):p<0?u=d/p+Math.abs(d):u+=Math.abs(a-o)*(1-p),d/=2),c=u*s/l,c<i&&(c=i,u=c*l/s),e.bgPosVerticalCenter=0,!(m&&u<a)||r&&e.options.enableTransform||(e.bgPosVerticalCenter=(a-u)/2,u=a),m?(f=n+(i-c)/2,y=(a-u)/2):(f=(i-c)/2,y=(o-u)/2),r&&e.options.enableTransform&&e.parentWithTransform&&(f-=n),e.parallaxScrollDistance=d,e.css(e.image.$item,{width:c+"px",height:u+"px",marginLeft:f+"px",marginTop:y+"px"}),e.options.onCoverImage&&e.options.onCoverImage.call(e)}},y.prototype.isVisible=function(){return this.isElementInViewport||!1},y.prototype.onScroll=function(e){var t=this;if(t.image.width&&t.image.height){var i=t.$item.getBoundingClientRect(),o=i.top,s=i.height,l={position:"absolute",visibility:"visible",backgroundPosition:"50% 50%"},p=i;if(t.options.elementInViewport&&(p=t.options.elementInViewport.getBoundingClientRect()),t.isElementInViewport=p.bottom>=0&&p.right>=0&&p.top<=a&&p.left<=n,e||t.isElementInViewport){var m=Math.max(0,o),d=Math.max(0,s+o),c=Math.max(0,-o),f=Math.max(0,o+s-a),y=Math.max(0,s-(o+s-a)),g=Math.max(0,-o+a-s),h=1-2*(a-o)/(a+s),v=1;if(s<a?v=1-(c||f)/s:d<=a?v=d/a:y<=a&&(v=y/a),"opacity"!==t.options.type&&"scale-opacity"!==t.options.type&&"scroll-opacity"!==t.options.type||(l.transform="translate3d(0, 0, 0)",l.opacity=v),"scale"===t.options.type||"scale-opacity"===t.options.type){var b=1;t.options.speed<0?b-=t.options.speed*v:b+=t.options.speed*(1-v),l.transform="scale("+b+") translate3d(0, 0, 0)"}if("scroll"===t.options.type||"scroll-opacity"===t.options.type){var I=t.parallaxScrollDistance*h;r&&t.options.enableTransform?(t.parentWithTransform&&(I-=o),l.transform="translate3d(0, "+I+"px, 0)"):t.image.useImgTag?l.top=I+"px":(t.bgPosVerticalCenter&&(I+=t.bgPosVerticalCenter),l.backgroundPosition="50% "+I+"px"),l.position=u?"absolute":"fixed"}t.css(t.image.$item,l),t.options.onScroll&&t.options.onScroll.call(t,{section:i,beforeTop:m,beforeTopEnd:d,afterTop:c,beforeBottom:f,beforeBottomEnd:y,afterBottom:g,visiblePercent:v,fromViewportCenter:h})}}},i(e,"scroll",o),i(e,"resize",o),i(e,"orientationchange",o),i(e,"load",o);var g=function(e){("object"==typeof HTMLElement?e instanceof HTMLElement:e&&"object"==typeof e&&null!==e&&1===e.nodeType&&"string"==typeof e.nodeName)&&(e=[e]);var t,i=arguments[1],o=Array.prototype.slice.call(arguments,2),n=e.length,a=0;for(a;a<n;a++)if("object"==typeof i||void 0===i?e[a].jarallax||(e[a].jarallax=new y(e[a],i)):e[a].jarallax&&(t=e[a].jarallax[i].apply(e[a].jarallax,o)),void 0!==t)return t;return e};g.constructor=y;var h=e.jarallax;if(e.jarallax=g,e.jarallax.noConflict=function(){return e.jarallax=h,this},"undefined"!=typeof jQuery){var v=function(){var t=arguments||[];Array.prototype.unshift.call(t,this);var i=g.apply(e,t);return"object"!=typeof i?i:this};v.constructor=y;var b=jQuery.fn.jarallax;jQuery.fn.jarallax=v,jQuery.fn.jarallax.noConflict=function(){return jQuery.fn.jarallax=b,this}}i(e,"DOMContentLoaded",function(){g(document.querySelectorAll("[data-jarallax], [data-jarallax-video]"))})}(window),function(e){"use strict";function t(e){e=e||{};for(var t=1;t<arguments.length;t++)if(arguments[t])for(var i in arguments[t])arguments[t].hasOwnProperty(i)&&(e[i]=arguments[t][i]);return e}function i(){this._done=[],this._fail=[]}function o(e,t,i){e.addEventListener?e.addEventListener(t,i):e.attachEvent("on"+t,function(){i.call(e)})}i.prototype={execute:function(e,t){var i=e.length;for(t=Array.prototype.slice.call(t);i--;)e[i].apply(null,t)},resolve:function(){this.execute(this._done,arguments)},reject:function(){this.execute(this._fail,arguments)},done:function(e){this._done.push(e)},fail:function(e){this._fail.push(e)}};var n=function(){function e(e,o){var n=this;n.url=e,n.options_default={autoplay:1,loop:1,mute:1,controls:0,startTime:0,endTime:0},n.options=t({},n.options_default,o),n.videoID=n.parseURL(e),n.videoID&&(n.ID=i++,n.loadAPI(),n.init())}var i=0;return e}();n.prototype.parseURL=function(e){function t(e){var t=/.*(?:youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=)([^#\&\?]*).*/,i=e.match(t);return!(!i||11!==i[1].length)&&i[1]}function i(e){var t=/https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)/,i=e.match(t);return!(!i||!i[3])&&i[3]}function o(e){for(var t=e.split(/,(?=mp4\:|webm\:|ogv\:|ogg\:)/),i={},o=0,n=0;n<t.length;n++){var a=t[n].match(/^(mp4|webm|ogv|ogg)\:(.*)/);a&&a[1]&&a[2]&&(i["ogv"===a[1]?"ogg":a[1]]=a[2],o=1)}return!!o&&i}var n=t(e),a=i(e),r=o(e);return n?(this.type="youtube",n):a?(this.type="vimeo",a):!!r&&(this.type="local",r)},n.prototype.isValid=function(){return!!this.videoID},n.prototype.on=function(e,t){this.userEventsList=this.userEventsList||[],(this.userEventsList[e]||(this.userEventsList[e]=[])).push(t)},n.prototype.off=function(e,t){if(this.userEventsList&&this.userEventsList[e])if(t)for(var i=0;i<this.userEventsList[e].length;i++)this.userEventsList[e][i]===t&&(this.userEventsList[e][i]=!1);else delete this.userEventsList[e]},n.prototype.fire=function(e){var t=[].slice.call(arguments,1);if(this.userEventsList&&void 0!==this.userEventsList[e])for(var i in this.userEventsList[e])this.userEventsList[e][i]&&this.userEventsList[e][i].apply(this,t)},n.prototype.play=function(e){var t=this;t.player&&("youtube"===t.type&&t.player.playVideo&&(void 0!==e&&t.player.seekTo(e||0),t.player.playVideo()),"vimeo"===t.type&&(void 0!==e&&t.player.setCurrentTime(e),t.player.getPaused().then(function(e){e&&t.player.play()})),"local"===t.type&&(void 0!==e&&(t.player.currentTime=e),t.player.play()))},n.prototype.pause=function(){this.player&&("youtube"===this.type&&this.player.pauseVideo&&this.player.pauseVideo(),"vimeo"===this.type&&this.player.pause(),"local"===this.type&&this.player.pause())},n.prototype.getImageURL=function(e){var t=this;if(t.videoImage)return void e(t.videoImage);if("youtube"===t.type){var i=["maxresdefault","sddefault","hqdefault","0"],o=0,n=new Image;n.onload=function(){120!==(this.naturalWidth||this.width)||o===i.length-1?(t.videoImage="https://img.youtube.com/vi/"+t.videoID+"/"+i[o]+".jpg",e(t.videoImage)):(o++,this.src="https://img.youtube.com/vi/"+t.videoID+"/"+i[o]+".jpg")},n.src="https://img.youtube.com/vi/"+t.videoID+"/"+i[o]+".jpg"}if("vimeo"===t.type){var a=new XMLHttpRequest;a.open("GET","https://vimeo.com/api/v2/video/"+t.videoID+".json",!0),a.onreadystatechange=function(){if(4===this.readyState&&this.status>=200&&this.status<400){var i=JSON.parse(this.responseText);t.videoImage=i[0].thumbnail_large,e(t.videoImage)}},a.send(),a=null}},n.prototype.getIframe=function(t){var i=this;if(i.$iframe)return void t(i.$iframe);i.onAPIready(function(){function n(e,t,i){var o=document.createElement("source");o.src=t,o.type=i,e.appendChild(o)}var a;if(i.$iframe||(a=document.createElement("div"),a.style.display="none"),"youtube"===i.type){i.playerOptions={},i.playerOptions.videoId=i.videoID,i.playerOptions.playerVars={autohide:1,rel:0,autoplay:0},i.options.controls||(i.playerOptions.playerVars.iv_load_policy=3,i.playerOptions.playerVars.modestbranding=1,i.playerOptions.playerVars.controls=0,i.playerOptions.playerVars.showinfo=0,i.playerOptions.playerVars.disablekb=1);var r,s;i.playerOptions.events={onReady:function(e){i.options.mute&&e.target.mute(),i.options.autoplay&&i.play(i.options.startTime),i.fire("ready",e)},onStateChange:function(e){i.options.loop&&e.data===YT.PlayerState.ENDED&&i.play(i.options.startTime),r||e.data!==YT.PlayerState.PLAYING||(r=1,i.fire("started",e)),e.data===YT.PlayerState.PLAYING&&i.fire("play",e),e.data===YT.PlayerState.PAUSED&&i.fire("pause",e),e.data===YT.PlayerState.ENDED&&i.fire("end",e),i.options.endTime&&(e.data===YT.PlayerState.PLAYING?s=setInterval(function(){i.options.endTime&&i.player.getCurrentTime()>=i.options.endTime&&(i.options.loop?i.play(i.options.startTime):i.pause())},150):clearInterval(s))}};var l=!i.$iframe;if(l){var p=document.createElement("div");p.setAttribute("id",i.playerID),a.appendChild(p),document.body.appendChild(a)}i.player=i.player||new e.YT.Player(i.playerID,i.playerOptions),l&&(i.$iframe=document.getElementById(i.playerID),i.videoWidth=parseInt(i.$iframe.getAttribute("width"),10)||1280,i.videoHeight=parseInt(i.$iframe.getAttribute("height"),10)||720)}if("vimeo"===i.type){i.playerOptions="",i.playerOptions+="player_id="+i.playerID,i.playerOptions+="&autopause=0",i.options.controls||(i.playerOptions+="&badge=0&byline=0&portrait=0&title=0"),i.playerOptions+="&autoplay="+(i.options.autoplay?"1":"0"),i.playerOptions+="&loop="+(i.options.loop?1:0),i.$iframe||(i.$iframe=document.createElement("iframe"),i.$iframe.setAttribute("id",i.playerID),i.$iframe.setAttribute("src","https://player.vimeo.com/video/"+i.videoID+"?"+i.playerOptions),i.$iframe.setAttribute("frameborder","0"),a.appendChild(i.$iframe),document.body.appendChild(a)),i.player=i.player||new Vimeo.Player(i.$iframe),i.player.getVideoWidth().then(function(e){i.videoWidth=e||1280}),i.player.getVideoHeight().then(function(e){i.videoHeight=e||720}),i.player.setVolume(i.options.mute?0:100);var m;i.player.on("timeupdate",function(e){m||i.fire("started",e),m=1,i.options.endTime&&i.options.endTime&&e.seconds>=i.options.endTime&&(i.options.loop?i.play(i.options.startTime):i.pause())}),i.player.on("play",function(e){i.fire("play",e),i.options.startTime&&0===e.seconds&&i.play(i.options.startTime)}),i.player.on("pause",function(e){i.fire("pause",e)}),i.player.on("ended",function(e){i.fire("end",e)}),i.player.on("loaded",function(e){i.fire("ready",e)})}if("local"===i.type){if(!i.$iframe){i.$iframe=document.createElement("video"),i.options.mute&&(i.$iframe.muted=!0),i.options.loop&&(i.$iframe.loop=!0),i.$iframe.setAttribute("id",i.playerID),a.appendChild(i.$iframe),document.body.appendChild(a);for(var d in i.videoID)n(i.$iframe,i.videoID[d],"video/"+d)}i.player=i.player||i.$iframe;var c;o(i.player,"playing",function(e){c||i.fire("started",e),c=1}),o(i.player,"timeupdate",function(){i.options.endTime&&i.options.endTime&&this.currentTime>=i.options.endTime&&(i.options.loop?i.play(i.options.startTime):i.pause())}),o(i.player,"play",function(e){i.fire("play",e)}),o(i.player,"pause",function(e){i.fire("pause",e)}),o(i.player,"ended",function(e){i.fire("end",e)}),o(i.player,"loadedmetadata",function(){i.videoWidth=this.videoWidth||1280,i.videoHeight=this.videoHeight||720,i.fire("ready"),i.options.autoplay&&i.play(i.options.startTime)})}t(i.$iframe)})},n.prototype.init=function(){var e=this;e.playerID="VideoWorker-"+e.ID};var a=0,r=0;n.prototype.loadAPI=function(){var t=this;if(!a||!r){var i="";if("youtube"!==t.type||a||(a=1,i="//www.youtube.com/iframe_api"),"vimeo"!==t.type||r||(r=1,i="//player.vimeo.com/api/player.js"),i){"file://"===e.location.origin&&(i="http:"+i);var o=document.createElement("script"),n=document.getElementsByTagName("head")[0];o.src=i,n.appendChild(o),n=null,o=null}}};var s=0,l=0,p=new i,m=new i;n.prototype.onAPIready=function(t){var i=this;if("youtube"===i.type&&("undefined"!=typeof YT&&0!==YT.loaded||s?"object"==typeof YT&&1===YT.loaded?t():p.done(function(){t()}):(s=1,e.onYouTubeIframeAPIReady=function(){e.onYouTubeIframeAPIReady=null,p.resolve("done"),t()})),"vimeo"===i.type)if("undefined"!=typeof Vimeo||l)"undefined"!=typeof Vimeo?t():m.done(function(){t()});else{l=1;var o=setInterval(function(){"undefined"!=typeof Vimeo&&(clearInterval(o),m.resolve("done"),t())},20)}"local"===i.type&&t()},e.VideoWorker=n}(window),function(){"use strict";if("undefined"!=typeof jarallax){var e=jarallax.constructor,t=e.prototype.init;e.prototype.init=function(){var e=this;t.apply(e),e.video&&e.video.getIframe(function(t){var i=t.parentNode;e.css(t,{position:"fixed",top:"0px",left:"0px",right:"0px",bottom:"0px",width:"100%",height:"100%",maxWidth:"none",maxHeight:"none",visibility:"visible",margin:0,zIndex:-1}),e.$video=t,e.image.$container.appendChild(t),i.parentNode.removeChild(i)})};var i=e.prototype.coverImage;e.prototype.coverImage=function(){var e=this;i.apply(e),e.video&&"IFRAME"===e.image.$item.nodeName&&e.css(e.image.$item,{height:e.image.$item.getBoundingClientRect().height+400+"px",marginTop:-200+parseFloat(e.css(e.image.$item,"margin-top"))+"px"})};var o=e.prototype.initImg;e.prototype.initImg=function(){var e=this,t=o.apply(e);if(e.options.videoSrc||(e.options.videoSrc=e.$item.getAttribute("data-jarallax-video")||!1),e.options.videoSrc){var i=new VideoWorker(e.options.videoSrc,{startTime:e.options.videoStartTime||0,endTime:e.options.videoEndTime||0});if(i.isValid()&&(e.image.useImgTag=!0,i.on("ready",function(){var t=e.onScroll;e.onScroll=function(){t.apply(e),e.isVisible()?i.play():i.pause()}}),i.on("started",function(){e.image.$default_item=e.image.$item,e.image.$item=e.$video,e.image.width=e.options.imgWidth=e.video.videoWidth||1280,e.image.height=e.options.imgHeight=e.video.videoHeight||720,e.coverImage(),e.clipContainer(),e.onScroll(),e.image.$default_item&&(e.image.$default_item.style.display="none")}),e.video=i,"local"!==i.type&&i.getImageURL(function(t){e.image.src=t,e.init()})),"local"!==i.type)return!1;if(!t)return e.image.src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7",!0}return t};var n=e.prototype.destroy;e.prototype.destroy=function(){var e=this;n.apply(e)}}}();