/* ------------------------------------------------------------------------
	Class: prettyPhotoFamous
	Use: Lightbox clone for jQuery
	Author: Stephane Caron (http://www.no-margin-for-errors.com)
	Version: 3.1.6
------------------------------------------------------------------------- */

(function(a){function w(){var a=location.href;(hashtag=-1!==a.indexOf("lightBoxLBG")?decodeURI(a.substring(a.indexOf("#lightBoxLBG")+1,a.length)):!1)&&(hashtag=hashtag.replace(/<|>/g,""));return hashtag}function k(a,k){a=a.replace(/[\[]/,"\\[").replace(/[\]]/,"\\]");var e=(new RegExp("[\\?&]"+a+"=([^&#]*)")).exec(k);return null==e?"":e[1]}a.prettyPhotoFamous={version:"3.1.6"};a.fn.prettyPhotoFamous=function(e){function p(){a(".famous_pp_loaderIcon").hide();projectedTop=scroll_pos.scrollTop+(f/2-c.containerHeight/
2);0>projectedTop&&(projectedTop=0);$ppt.fadeTo(famous_settings.animation_speed,1);$pp_pic_holder.find(".famous_pp_content").animate({height:c.contentHeight,width:c.contentWidth},famous_settings.animation_speed);$pp_pic_holder.animate({top:projectedTop,left:0>d/2-c.containerWidth/2?0:d/2-c.containerWidth/2,width:c.containerWidth},famous_settings.animation_speed,function(){$pp_pic_holder.find(".famous_pp_hoverContainer,#famous_fullResImage").height(c.height).width(c.width);$pp_pic_holder.find(".famous_pp_fade").fadeIn(famous_settings.animation_speed);
isSet&&"image"==q(pp_images[set_position])?$pp_pic_holder.find(".famous_pp_hoverContainer").show():$pp_pic_holder.find(".famous_pp_hoverContainer").hide();famous_settings.allow_expand&&(c.resized?a("a.famous_pp_expand,a.famous_pp_contract").show():a("a.famous_pp_expand").hide());!famous_settings.autoplay_slideshow||m||r||a.prettyPhotoFamous.startSlideshow();famous_settings.changepicturecallback();r=!0});isSet&&famous_settings.overlay_gallery&&"image"==q(pp_images[set_position])?(itemWidth=57,navWidth=
"facebook"==famous_settings.theme||"famous_pp_default"==famous_settings.theme?50:30,itemsPerPage=Math.floor((c.containerWidth-100-navWidth)/itemWidth),itemsPerPage=itemsPerPage<pp_images.length?itemsPerPage:pp_images.length,totalPage=Math.ceil(pp_images.length/itemsPerPage)-1,0==totalPage?(navWidth=0,$pp_gallery.find(".famous_pp_arrow_next,.famous_pp_arrow_previous").hide()):$pp_gallery.find(".famous_pp_arrow_next,.famous_pp_arrow_previous").show(),galleryWidth=itemsPerPage*itemWidth,fullGalleryWidth=
pp_images.length*itemWidth,$pp_gallery.css("margin-left",-(galleryWidth/2+navWidth/2)).find("div:first").width(galleryWidth+5).find("ul").width(fullGalleryWidth).find("li.selected").removeClass("selected"),goToPage=Math.floor(set_position/itemsPerPage)<totalPage?Math.floor(set_position/itemsPerPage):totalPage,a.prettyPhotoFamous.changeGalleryPage(goToPage),$pp_gallery_li.filter(":eq("+set_position+")").addClass("selected")):$pp_pic_holder.find(".famous_pp_content").unbind("mouseenter mouseleave");
e.ajaxcallback()}function x(b){$pp_pic_holder.find("#famous_pp_full_res object,#famous_pp_full_res embed").css("visibility","hidden");$pp_pic_holder.find(".famous_pp_fade").fadeOut(famous_settings.animation_speed,function(){a(".famous_pp_loaderIcon").show();b()})}function C(b){1<b?a(".famous_pp_nav").show():a(".famous_pp_nav").hide()}function g(a,c){resized=!1;y(a,c);imageWidth=a;imageHeight=c;if((h>d||l>f)&&doresize&&famous_settings.allow_resize&&!n){resized=!0;for(fitting=!1;!fitting;)h>d?(imageWidth=
750<=window.innerWidth?d-300:d-100,imageHeight=c/a*imageWidth):l>f?(imageHeight=750<=window.innerHeight?f-300:f-100,imageWidth=a/c*imageHeight):fitting=!0,l=imageHeight,h=imageWidth;(h>d||l>f)&&g(h,l);y(imageWidth,imageHeight)}return{width:Math.floor(imageWidth),height:Math.floor(imageHeight),containerHeight:Math.floor(l),containerWidth:Math.floor(h)+2*famous_settings.horizontal_padding,contentHeight:Math.floor(t),contentWidth:Math.floor(z),resized:resized}}function y(b,c){b=parseFloat(b);c=parseFloat(c);
$pp_details=$pp_pic_holder.find(".famous_pp_details");$pp_details.width(b);detailsHeight=parseFloat($pp_details.css("marginTop"))+parseFloat($pp_details.css("marginBottom"));$pp_details=$pp_details.clone().addClass(famous_settings.theme).width(b).appendTo(a("body")).css({position:"absolute",top:-1E4});detailsHeight+=$pp_details.height();detailsHeight=34>=detailsHeight?36:detailsHeight;$pp_details.remove();$pp_title=$pp_pic_holder.find(".famous_ppt");$pp_title.width(b);titleHeight=parseFloat($pp_title.css("marginTop"))+
parseFloat($pp_title.css("marginBottom"));$pp_title=$pp_title.clone().appendTo(a("body")).css({position:"absolute",top:-1E4});titleHeight+=$pp_title.height();$pp_title.remove();t=c+detailsHeight;z=b;l=t+titleHeight+$pp_pic_holder.find(".famous_pp_top").height()+$pp_pic_holder.find(".famous_pp_bottom").height();h=b}function q(a){return a.match(/youtube\.com\/watch/i)||a.match(/youtu\.be/i)?"youtube":a.match(/vimeo\.com/i)?"vimeo":a.match(/\b.mov\b/i)?"quicktime":a.match(/\b.swf\b/i)?"flash":a.match(/\biframe=true\b/i)?
"iframe":a.match(/\bajax=true\b/i)?"ajax":a.match(/\bcustom=true\b/i)?"custom":"#"==a.substr(0,1)?"inline":"image"}function u(){doresize&&"undefined"!=typeof $pp_pic_holder&&(scroll_pos=A(),contentHeight=$pp_pic_holder.height(),contentwidth=$pp_pic_holder.width(),projectedTop=f/2+scroll_pos.scrollTop-contentHeight/2,0>projectedTop&&(projectedTop=0),contentHeight>f||$pp_pic_holder.css({top:projectedTop,left:d/2+scroll_pos.scrollLeft-contentwidth/2}))}function A(){if(self.pageYOffset)return{scrollTop:self.pageYOffset,
scrollLeft:self.pageXOffset};if(document.documentElement&&document.documentElement.scrollTop)return{scrollTop:document.documentElement.scrollTop,scrollLeft:document.documentElement.scrollLeft};if(document.body)return{scrollTop:document.body.scrollTop,scrollLeft:document.body.scrollLeft}}function B(b){famous_settings.social_tools&&(facebook_like_link=famous_settings.social_tools.replace("{location_href}",encodeURIComponent(location.href)));famous_settings.famous_markup=famous_settings.famous_markup.replace("{famous_pp_social}",
"");a("body").append(famous_settings.famous_markup);$pp_pic_holder=a(".famous_pp_pic_holder");$ppt=a(".famous_ppt");$pp_overlay=a("div.famous_pp_overlay");if(isSet&&famous_settings.overlay_gallery){currentGalleryPage=0;toInject="";for(b=0;b<pp_images.length;b++)pp_images[b].match(/\b(jpg|jpeg|png|gif)\b/gi)?(classname="",img_src=pp_images[b]):(classname="default",img_src=""),toInject+="<li class='"+classname+"'><a href='#'><img src='"+img_src+"' width='50' alt='' /></a></li>";toInject=famous_settings.gallery_famous_markup.replace(/{gallery}/g,
toInject);$pp_pic_holder.find("#famous_pp_full_res").after(toInject);$pp_gallery=a(".famous_pp_pic_holder .famous_pp_gallery");$pp_gallery_li=$pp_gallery.find("li");$pp_gallery.find(".famous_pp_arrow_next").click(function(){a.prettyPhotoFamous.changeGalleryPage("next");a.prettyPhotoFamous.stopSlideshow();return!1});$pp_gallery.find(".famous_pp_arrow_previous").click(function(){a.prettyPhotoFamous.changeGalleryPage("previous");a.prettyPhotoFamous.stopSlideshow();return!1});$pp_pic_holder.find(".famous_pp_content").hover(function(){$pp_pic_holder.find(".famous_pp_gallery:not(.disabled)").fadeIn()},
function(){$pp_pic_holder.find(".famous_pp_gallery:not(.disabled)").fadeOut()});itemWidth=57;$pp_gallery_li.each(function(b){a(this).find("a").click(function(){a.prettyPhotoFamous.changePage(b);a.prettyPhotoFamous.stopSlideshow();return!1})})}famous_settings.slideshow&&($pp_pic_holder.find(".famous_pp_nav").prepend('<a href="#" class="famous_pp_play">Play</a>'),$pp_pic_holder.find(".famous_pp_nav .famous_pp_play").click(function(){a.prettyPhotoFamous.startSlideshow();return!1}));$pp_pic_holder.attr("class",
"famous_pp_pic_holder "+famous_settings.theme);$pp_overlay.css({opacity:0,height:a(document).height(),width:a(window).width()}).bind("click",function(){famous_settings.modal||a.prettyPhotoFamous.close()});a("a.famous_pp_close").bind("click",function(){a.prettyPhotoFamous.close();return!1});famous_settings.allow_expand&&a("a.famous_pp_expand").bind("click",function(b){a(this).hasClass("famous_pp_expand")?(a(this).removeClass("famous_pp_expand").addClass("famous_pp_contract"),doresize=!1):(a(this).removeClass("famous_pp_contract").addClass("famous_pp_expand"),
doresize=!0);x(function(){a.prettyPhotoFamous.open()});return!1});$pp_pic_holder.find(".famous_pp_previous, .famous_pp_nav .famous_pp_arrow_previous").bind("click",function(){a.prettyPhotoFamous.changePage("previous");a.prettyPhotoFamous.stopSlideshow();return!1});$pp_pic_holder.find(".famous_pp_next, .famous_pp_nav .famous_pp_arrow_next").bind("click",function(){a.prettyPhotoFamous.changePage("next");a.prettyPhotoFamous.stopSlideshow();return!1});u()}e=jQuery.extend({hook:"rel",animation_speed:"fast",
ajaxcallback:function(){},slideshow:5E3,autoplay_slideshow:!1,opacity:.8,show_title:!0,allow_resize:!0,allow_expand:!0,default_width:500,default_height:344,counter_separator_label:"/",theme:"famous_pp_default",horizontal_padding:20,hideflash:!1,wmode:"opaque",autoplay:!0,modal:!1,deeplinking:!0,overlay_gallery:!0,overlay_gallery_max:30,keyboard_shortcuts:!0,changepicturecallback:function(){},callback:function(){},ie6_fallback:!0,famous_markup:'<div class="famous_pp_pic_holder"> \t\t\t\t\t\t<div class="famous_ppt">&nbsp;</div> \t\t\t\t\t\t<div class="famous_pp_top"> \t\t\t\t\t\t\t<div class="famous_pp_left"></div> \t\t\t\t\t\t\t<div class="famous_pp_middle"></div> \t\t\t\t\t\t\t<div class="famous_pp_right"></div> \t\t\t\t\t\t</div> \t\t\t\t\t\t<div class="famous_pp_content_container"> \t\t\t\t\t\t\t<div class="famous_pp_left"> \t\t\t\t\t\t\t<div class="famous_pp_right"> \t\t\t\t\t\t\t\t<div class="famous_pp_content"> \t\t\t\t\t\t\t\t\t<div class="famous_pp_loaderIcon"></div> \t\t\t\t\t\t\t\t\t<div class="famous_pp_fade"> \t\t\t\t\t\t\t\t\t\t<a href="#" class="famous_pp_expand" title="Expand the image">Expand</a> \t\t\t\t\t\t\t\t\t\t<div class="famous_pp_hoverContainer"> \t\t\t\t\t\t\t\t\t\t\t<a class="famous_pp_next" href="#">next</a> \t\t\t\t\t\t\t\t\t\t\t<a class="famous_pp_previous" href="#">previous</a> \t\t\t\t\t\t\t\t\t\t</div> \t\t\t\t\t\t\t\t\t\t<div id="famous_pp_full_res"></div> \t\t\t\t\t\t\t\t\t\t<div class="famous_pp_details"> \t\t\t\t\t\t\t\t\t\t\t<div class="famous_pp_nav"> \t\t\t\t\t\t\t\t\t\t\t\t<a href="#" class="famous_pp_arrow_previous">Previous</a> \t\t\t\t\t\t\t\t\t\t\t\t<p class="famous_currentTextHolder">0/0</p> \t\t\t\t\t\t\t\t\t\t\t\t<a href="#" class="famous_pp_arrow_next">Next</a> \t\t\t\t\t\t\t\t\t\t\t</div> \t\t\t\t\t\t\t\t\t\t\t<p class="famous_pp_description"></p> \t\t\t\t\t\t\t\t\t\t\t<div class="famous_pp_social">{famous_pp_social}</div> \t\t\t\t\t\t\t\t\t\t\t<a class="famous_pp_close" href="#">Close</a> \t\t\t\t\t\t\t\t\t\t</div> \t\t\t\t\t\t\t\t\t</div> \t\t\t\t\t\t\t\t</div> \t\t\t\t\t\t\t</div> \t\t\t\t\t\t\t</div> \t\t\t\t\t\t</div> \t\t\t\t\t\t<div class="famous_pp_bottom"> \t\t\t\t\t\t\t<div class="famous_pp_left"></div> \t\t\t\t\t\t\t<div class="famous_pp_middle"></div> \t\t\t\t\t\t\t<div class="famous_pp_right"></div> \t\t\t\t\t\t</div> \t\t\t\t\t</div> \t\t\t\t\t<div class="famous_pp_overlay"></div>',
gallery_famous_markup:'<div class="famous_pp_gallery"> \t\t\t\t\t\t\t\t<a href="#" class="famous_pp_arrow_previous">Previous</a> \t\t\t\t\t\t\t\t<div> \t\t\t\t\t\t\t\t\t<ul> \t\t\t\t\t\t\t\t\t\t{gallery} \t\t\t\t\t\t\t\t\t</ul> \t\t\t\t\t\t\t\t</div> \t\t\t\t\t\t\t\t<a href="#" class="famous_pp_arrow_next">Next</a> \t\t\t\t\t\t\t</div>',image_famous_markup:'<img id="famous_fullResImage" src="{path}" />',flash_famous_markup:'<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="{width}" height="{height}"><param name="wmode" value="{wmode}" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="{path}" /><embed src="{path}" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="{width}" height="{height}" wmode="{wmode}"></embed></object>',
quicktime_famous_markup:'<object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab" height="{height}" width="{width}"><param name="src" value="{path}"><param name="autoplay" value="{autoplay}"><param name="type" value="video/quicktime"><embed src="{path}" height="{height}" width="{width}" autoplay="{autoplay}" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/"></embed></object>',iframe_famous_markup:'<iframe src ="{path}" width="{width}" height="{height}" frameborder="no"></iframe>',
inline_famous_markup:'<div class="famous_pp_inline">{content}</div>',custom_famous_markup:"",social_tools:'<div class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js">\x3c/script></div><div class="facebook"><iframe src="//www.facebook.com/plugins/like.php?locale=en_US&href={location_href}&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:500px; height:23px;" allowTransparency="true"></iframe></div>'},
e);var v=this,n=!1,c,r,t,z,l,h,f=a(window).height(),d=a(window).width(),m;doresize=!0;scroll_pos=A();a(window).unbind("resize.prettyphoto").bind("resize.prettyphoto",function(){u();f=a(window).height();d=a(window).width();"undefined"!=typeof $pp_overlay&&$pp_overlay.height(a(document).height()).width(d)});e.keyboard_shortcuts&&a(document).unbind("keydown.prettyphoto").bind("keydown.prettyphoto",function(b){if("undefined"!=typeof $pp_pic_holder&&$pp_pic_holder.is(":visible"))switch(b.keyCode){case 37:a.prettyPhotoFamous.changePage("previous");
b.preventDefault();break;case 39:a.prettyPhotoFamous.changePage("next");b.preventDefault();break;case 27:famous_settings.modal||a.prettyPhotoFamous.close(),b.preventDefault()}});a.prettyPhotoFamous.initialize=function(){famous_settings=e;"famous_pp_default"==famous_settings.theme&&(famous_settings.horizontal_padding=16);theRel=a(this).attr(famous_settings.hook);galleryRegExp=/\[(?:.*)\]/;pp_images=(isSet=galleryRegExp.exec(theRel)?!0:!1)?jQuery.map(v,function(b,c){if(-1!=a(b).attr(famous_settings.hook).indexOf(theRel))return a(b).attr("href")}):
a.makeArray(a(this).attr("href"));pp_titles=isSet?jQuery.map(v,function(b,c){if(-1!=a(b).attr(famous_settings.hook).indexOf(theRel))return a(b).find("img").attr("alt")?a(b).find("img").attr("alt"):""}):a.makeArray(a(this).find("img").attr("alt"));pp_descriptions=isSet?jQuery.map(v,function(b,c){if(-1!=a(b).attr(famous_settings.hook).indexOf(theRel))return a(b).attr("title")?a(b).attr("title"):""}):a.makeArray(a(this).attr("title"));pp_images.length>famous_settings.overlay_gallery_max&&(famous_settings.overlay_gallery=
!1);set_position=jQuery.inArray(a(this).attr("href"),pp_images);rel_index=isSet?set_position:a("a["+famous_settings.hook+"^='"+theRel+"']").index(a(this));B(this);famous_settings.allow_resize&&a(window).bind("scroll.prettyphoto",function(){u()});a.prettyPhotoFamous.open();return!1};a.prettyPhotoFamous.open=function(b,d,f,h){"undefined"==typeof famous_settings&&(famous_settings=e,pp_images=a.makeArray(b),pp_titles=d?a.makeArray(d):a.makeArray(""),pp_descriptions=f?a.makeArray(f):a.makeArray(""),isSet=
1<pp_images.length?!0:!1,set_position=h?h:0,B(b.target));famous_settings.hideflash&&a("object,embed,iframe[src*=youtube],iframe[src*=vimeo]").css("visibility","hidden");C(a(pp_images).size());a(".famous_pp_loaderIcon").show();famous_settings.deeplinking&&"undefined"!=typeof theRel&&(location.hash=theRel+"/"+rel_index+"/");famous_settings.social_tools&&(facebook_like_link=famous_settings.social_tools.replace("{location_href}",encodeURIComponent(location.href)),$pp_pic_holder.find(".famous_pp_social").html(facebook_like_link));
$ppt.is(":hidden")&&$ppt.css("opacity",0).show();$pp_overlay.show().fadeTo(famous_settings.animation_speed,famous_settings.opacity);$pp_pic_holder.find(".famous_currentTextHolder").text(set_position+1+famous_settings.counter_separator_label+a(pp_images).size());"undefined"!=typeof pp_descriptions[set_position]&&""!=pp_descriptions[set_position]?$pp_pic_holder.find(".famous_pp_description").show().html(unescape(pp_descriptions[set_position])):$pp_pic_holder.find(".famous_pp_description").hide();movie_width=
parseFloat(k("width",pp_images[set_position]))?k("width",pp_images[set_position]):famous_settings.default_width.toString();movie_height=parseFloat(k("height",pp_images[set_position]))?k("height",pp_images[set_position]):famous_settings.default_height.toString();n=!1;-1!=movie_height.indexOf("%")&&(movie_height=parseFloat(a(window).height()*parseFloat(movie_height)/100-150),n=!0);-1!=movie_width.indexOf("%")&&(movie_width=parseFloat(a(window).width()*parseFloat(movie_width)/100-150),n=!0);$pp_pic_holder.fadeIn(function(){famous_settings.show_title&&
""!=pp_titles[set_position]&&"undefined"!=typeof pp_titles[set_position]?$ppt.html(unescape(pp_titles[set_position])):$ppt.html("&nbsp;");imgPreloader="";skipInjection=!1;switch(q(pp_images[set_position])){case "image":imgPreloader=new Image;nextImage=new Image;isSet&&set_position<a(pp_images).size()-1&&(nextImage.src=pp_images[set_position+1]);prevImage=new Image;isSet&&pp_images[set_position-1]&&(prevImage.src=pp_images[set_position-1]);$pp_pic_holder.find("#famous_pp_full_res")[0].innerHTML=famous_settings.image_famous_markup.replace(/{path}/g,
pp_images[set_position]);imgPreloader.onload=function(){c=g(imgPreloader.width,imgPreloader.height);p()};imgPreloader.onerror=function(){alert("Image cannot be loaded. Make sure the path is correct and image exist.");a.prettyPhotoFamous.close()};imgPreloader.src=pp_images[set_position];break;case "youtube":c=g(movie_width,movie_height);movie_id=k("v",pp_images[set_position]);""==movie_id&&(movie_id=pp_images[set_position].split("youtu.be/"),movie_id=movie_id[1],0<movie_id.indexOf("?")&&(movie_id=
movie_id.substr(0,movie_id.indexOf("?"))),0<movie_id.indexOf("&")&&(movie_id=movie_id.substr(0,movie_id.indexOf("&"))));movie="http://www.youtube.com/embed/"+movie_id;k("rel",pp_images[set_position])?movie+="?rel="+k("rel",pp_images[set_position]):movie+="?rel=1";famous_settings.autoplay&&(movie+="&autoplay=1");toInject=famous_settings.iframe_famous_markup.replace(/{width}/g,c.width).replace(/{height}/g,c.height).replace(/{wmode}/g,famous_settings.wmode).replace(/{path}/g,movie);break;case "vimeo":c=
g(movie_width,movie_height);movie_id=pp_images[set_position];movie="http://player.vimeo.com/video/"+movie_id.match(/http(s?):\/\/(www\.)?vimeo.com\/(\d+)/)[3]+"?title=0&amp;byline=0&amp;portrait=0";famous_settings.autoplay&&(movie+="&autoplay=1;");vimeo_width=c.width+"/embed/?moog_width="+c.width;toInject=famous_settings.iframe_famous_markup.replace(/{width}/g,vimeo_width).replace(/{height}/g,c.height).replace(/{path}/g,movie);break;case "quicktime":c=g(movie_width,movie_height);c.height+=15;c.contentHeight+=
15;c.containerHeight+=15;toInject=famous_settings.quicktime_famous_markup.replace(/{width}/g,c.width).replace(/{height}/g,c.height).replace(/{wmode}/g,famous_settings.wmode).replace(/{path}/g,pp_images[set_position]).replace(/{autoplay}/g,famous_settings.autoplay);break;case "flash":c=g(movie_width,movie_height);flash_vars=pp_images[set_position];flash_vars=flash_vars.substring(pp_images[set_position].indexOf("flashvars")+10,pp_images[set_position].length);filename=pp_images[set_position];filename=
filename.substring(0,filename.indexOf("?"));toInject=famous_settings.flash_famous_markup.replace(/{width}/g,c.width).replace(/{height}/g,c.height).replace(/{wmode}/g,famous_settings.wmode).replace(/{path}/g,filename+"?"+flash_vars);break;case "iframe":c=g(movie_width,movie_height);frame_url=pp_images[set_position];frame_url=frame_url.substr(0,frame_url.indexOf("iframe")-1);toInject=famous_settings.iframe_famous_markup.replace(/{width}/g,c.width).replace(/{height}/g,c.height).replace(/{path}/g,frame_url);
break;case "ajax":doresize=!1;c=g(movie_width,movie_height);skipInjection=doresize=!0;a.get(pp_images[set_position],function(a){toInject=famous_settings.inline_famous_markup.replace(/{content}/g,a);$pp_pic_holder.find("#famous_pp_full_res")[0].innerHTML=toInject;p()});break;case "custom":c=g(movie_width,movie_height);toInject=famous_settings.custom_famous_markup;break;case "inline":myClone=a(pp_images[set_position]).clone().append('<br clear="all" />').css({width:famous_settings.default_width}).wrapInner('<div id="famous_pp_full_res"><div class="famous_pp_inline"></div></div>').appendTo(a("body")).show(),
doresize=!1,c=g(a(myClone).width(),a(myClone).height()),doresize=!0,a(myClone).remove(),toInject=famous_settings.inline_famous_markup.replace(/{content}/g,a(pp_images[set_position]).html())}imgPreloader||skipInjection||($pp_pic_holder.find("#famous_pp_full_res")[0].innerHTML=toInject,p())});return!1};a.prettyPhotoFamous.lbgAddSocial=function(b,c,e){var d=String(window.location);-1!=b.indexOf("youtube.com/")||-1!=b.indexOf("vimeo.com/")?b=jQuery.gallery1.getVideoImageForShare(b):-1==b.indexOf("http://")&&
-1==b.indexOf("https://")&&(b=-1==d.indexOf("#lightBoxLBG")?d+b:d.substr(0,d.indexOf("#lightBoxLBG"))+b);var f=c+" - "+e;setTimeout(function(){a(".famous_pp_social").html('<div class="lbg_facebook"><a href="javascript:void(0)" onclick="jQuery.gallery1.shareOverrideOGMeta(\''+encodeURI(window.location).replace("#","%23")+"', '"+c.replace("'","%27")+"', '"+e.replace("'","%27")+"', '"+encodeURI(b)+'\')">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></div><div class="lbg_twitter"><a href="javascript:void(0)" onclick="window.open(\'https://twitter.com/home?status='+
encodeURI(f)+" "+encodeURI(window.location).replace("#","%23")+"' , 'windowName', 'width="+.6*a(window).width()+', height=300, left=24, top=24, scrollbars, resizable\'); return false;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></div><div class="lbg_pinterest"><a data-pin-do="buttonPin" href="javascript:void(0)" onclick="window.open(\'https://www.pinterest.com/pin/create/button/?url='+encodeURIComponent(window.location)+"&media="+encodeURIComponent(b)+"&description="+encodeURIComponent(f)+
"' , 'windowName', 'width=1000, height=700, left=24, top=24, scrollbars, resizable'); return false;\" data-pin-shape=\"round\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></div>")},1100)};a.prettyPhotoFamous.changePage=function(b){currentGalleryPage=0;"previous"==b?(set_position--,0>set_position&&(set_position=a(pp_images).size()-1)):"next"==b?(set_position++,set_position>a(pp_images).size()-1&&(set_position=0)):set_position=b;rel_index=set_position;doresize||(doresize=!0);famous_settings.allow_expand&&
a(".famous_pp_contract").removeClass("famous_pp_contract").addClass("famous_pp_expand");if(""!=location.hash){b=location.href.indexOf("#lightBoxLBG");var c=location.href.indexOf("[lbg_pp_gal]");b=location.href.substr(b,c-b);location.hash=b+"[lbg_pp_gal]/"+set_position+"/"}$text_arr=pp_descriptions[set_position].split("<br>");$text_arr[0]=$text_arr[0].replace(/<(?:.|\n)*?>/gm," ");$text_arr[1]=$text_arr[1].replace(/<(?:.|\n)*?>/gm," ");a.prettyPhotoFamous.lbgAddSocial(pp_images[set_position],$text_arr[0],
$text_arr[1]);x(function(){a.prettyPhotoFamous.open()})};a.prettyPhotoFamous.changeGalleryPage=function(a){"next"==a?(currentGalleryPage++,currentGalleryPage>totalPage&&(currentGalleryPage=0)):"previous"==a?(currentGalleryPage--,0>currentGalleryPage&&(currentGalleryPage=totalPage)):currentGalleryPage=a;slide_speed="next"==a||"previous"==a?famous_settings.animation_speed:0;slide_to=currentGalleryPage*itemsPerPage*itemWidth;$pp_gallery.find("ul").animate({left:-slide_to},slide_speed)};a.prettyPhotoFamous.startSlideshow=
function(){"undefined"==typeof m?($pp_pic_holder.find(".famous_pp_play").unbind("click").removeClass("famous_pp_play").addClass("famous_pp_pause").click(function(){a.prettyPhotoFamous.stopSlideshow();return!1}),m=setInterval(a.prettyPhotoFamous.startSlideshow,famous_settings.slideshow)):a.prettyPhotoFamous.changePage("next")};a.prettyPhotoFamous.stopSlideshow=function(){$pp_pic_holder.find(".famous_pp_pause").unbind("click").removeClass("famous_pp_pause").addClass("famous_pp_play").click(function(){a.prettyPhotoFamous.startSlideshow();
return!1});clearInterval(m);m=void 0};a.prettyPhotoFamous.close=function(){$pp_overlay.is(":animated")||(a.prettyPhotoFamous.stopSlideshow(),$pp_pic_holder.stop().find("object,embed").css("visibility","hidden"),a("div.famous_pp_pic_holder,div.famous_ppt,.famous_pp_fade").fadeOut(famous_settings.animation_speed,function(){a(this).remove()}),$pp_overlay.fadeOut(famous_settings.animation_speed,function(){famous_settings.hideflash&&a("object,embed,iframe[src*=youtube],iframe[src*=vimeo]").css("visibility",
"visible");a(this).remove();a(window).unbind("scroll.prettyphoto");if(-1!==location.href.indexOf("#lightBoxLBG")){var b=location.href.indexOf("#lightBoxLBG"),c=location.href.indexOf("[lbg_pp_gal]");location.hash=location.href.substr(b,c-b)}famous_settings.callback();doresize=!0;r=!1;delete famous_settings}))};!pp_alreadyInitializedFamous&&w()&&(pp_alreadyInitializedFamous=!0,hashRel=hashIndex=w(),hashIndex=hashIndex.substring(hashIndex.indexOf("/")+1,hashIndex.length-1),hashRel=hashRel.substring(0,
hashRel.indexOf("/")),setTimeout(function(){a("a["+e.hook+"^='"+hashRel+"']:eq("+hashIndex+")").trigger("click");a("a["+e.hook+"^='"+hashRel+"']:eq("+hashIndex+")").trigger("click")},2050));return this.unbind("click.prettyphoto").bind("click.prettyphoto",a.prettyPhotoFamous.initialize)};a(window).resize(function(){clearTimeout(e);var e=setTimeout(function(){a(".famous_pp_pic_holder").css({top:window.pageYOffset+window.innerHeight/2-a(".famous_pp_pic_holder").height()/2,left:window.innerWidth/2-a(".famous_pp_pic_holder").width()/
2})},200)})})(jQuery);var pp_alreadyInitializedFamous=!1;
