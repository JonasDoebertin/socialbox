window.smoothScroll=function(t,e,o){"use strict";var a={speed:500,easing:"easeInOutCubic",offset:0,updateURL:!1,callbackBefore:function(){},callbackAfter:function(){}},n=function(t,e){for(var o in e)t[o]=e[o];return t},i=function(t,e){return"easeInQuad"==t?e*e:"easeOutQuad"==t?e*(2-e):"easeInOutQuad"==t?.5>e?2*e*e:-1+(4-2*e)*e:"easeInCubic"==t?e*e*e:"easeOutCubic"==t?--e*e*e+1:"easeInOutCubic"==t?.5>e?4*e*e*e:(e-1)*(2*e-2)*(2*e-2)+1:"easeInQuart"==t?e*e*e*e:"easeOutQuart"==t?1- --e*e*e*e:"easeInOutQuart"==t?.5>e?8*e*e*e*e:1-8*--e*e*e*e:"easeInQuint"==t?e*e*e*e*e:"easeOutQuint"==t?1+--e*e*e*e*e:"easeInOutQuint"==t?.5>e?16*e*e*e*e*e:1+16*--e*e*e*e*e:e},c=function(t,e,o){var a=0;if(t.offsetParent)do a+=t.offsetTop,t=t.offsetParent;while(t);return a=a-e-o,a>=0?a:0},r=function(){return Math.max(e.body.scrollHeight,e.documentElement.scrollHeight,e.body.offsetHeight,e.documentElement.offsetHeight,e.body.clientHeight,e.documentElement.clientHeight)},l=function(t){if(null===t||t===o)return{};var e={};return t=t.split(";"),t.forEach(function(t){t=t.trim(),""!==t&&(t=t.split(":"),e[t[0]]=t[1].trim())}),e},s=function(t,e){e!==!0&&"true"!==e||!history.pushState||history.pushState({pos:t.id},"",t)},u=function(o,u,f,d){f=n(a,f||{});var h,p,b,v=l(o?o.getAttribute("data-options"):null),x=parseInt(v.speed||f.speed,10),g=v.easing||f.easing,m=parseInt(v.offset||f.offset,10),y=v.updateURL||f.updateURL,S=e.querySelector("[data-scroll-header]"),I=null===S?0:S.offsetHeight+S.offsetTop,O=t.pageYOffset,Q=c(e.querySelector(u),I,m),j=Q-O,C=r(),k=0;o&&"A"===o.tagName&&d&&d.preventDefault(),s(u,y);var w=function(e,a,n){var i=t.pageYOffset;(e==a||i==a||t.innerHeight+i>=C)&&(clearInterval(n),f.callbackAfter(o,u))},A=function(){k+=16,p=k/x,p=p>1?1:p,b=O+j*i(g,p),t.scrollTo(0,Math.floor(b)),w(b,Q,h)},E=function(){f.callbackBefore(o,u),h=setInterval(A,16)};0===t.pageYOffset&&t.scrollTo(0,0),E()},f=function(o){if("querySelector"in e&&"addEventListener"in t&&Array.prototype.forEach){o=n(a,o||{});var i=e.querySelectorAll("[data-scroll]");Array.prototype.forEach.call(i,function(t){t.addEventListener("click",u.bind(null,t,t.getAttribute("href"),o),!1)})}};return{init:f,animateScroll:u}}(window,document),smoothScroll.init(),jQuery(function(t){var e=t(".js-socialbox-toc-item");e.each(function(){var e=t(this);e.tooltipster({animation:"fade",content:e.attr("data-tooltip"),delay:0,maxWidth:400,position:"top",theme:"tooltipster-socialbox"})})}),jQuery(function(t){var e=t(".js-socialbox-context");e.each(function(){var e=t(this);e.tooltipster({content:e.attr("data-message"),maxWidth:700,position:"top-right",theme:"tooltipster-socialbox"})})}),jQuery(function(t){var e=t(".js-socialbox-cache-show"),o=t(".js-socialbox-cache-clear"),a=t(".js-socialbox-cache-refresh");o.on("click",function(e){e.preventDefault();var o=t(this).prev("i").addClass("socialbox-icon-loading");data={action:Socialbox.action.clear,nonce:Socialbox.nonce.clear},t.post(ajaxurl,data,function(t){o.removeClass("socialbox-icon-loading"),alert(t)})}),a.on("click",function(e){e.preventDefault();var o=t(this).prev("i").addClass("socialbox-icon-loading");data={action:Socialbox.action.refresh,nonce:Socialbox.nonce.refresh},t.post(ajaxurl,data,function(t){o.removeClass("socialbox-icon-loading"),alert(t)})}),e.on("click",function(e){e.preventDefault();var o=t(this).prev("i").addClass("socialbox-icon-loading");data={action:Socialbox.action.show,nonce:Socialbox.nonce.show},t.post(ajaxurl,data,function(t){o.removeClass("socialbox-icon-loading"),alert(t)})})});