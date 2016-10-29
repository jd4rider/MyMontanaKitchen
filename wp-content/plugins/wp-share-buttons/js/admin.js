jQuery(document).ready(function () {

	jQuery('.pro input').change(function(){
		alert('Oops. This option are disabled in free version please follow the link on the top to get pro version.');
		return false;
	})

	jQuery('#socials-list li input').click(function(){
		if(jQuery(this).is(':checked')){
			jQuery('#huge-it-share-buttons-bottom li').eq(jQuery('#socials-list li input.text').index(this)).each(function(){jQuery(this).removeClass('none');});
			jQuery('#huge-it-share-buttons-top li').eq(jQuery('#socials-list li input.text').index(this)).each(function(){jQuery(this).removeClass('none');});
		}else{
			jQuery('#huge-it-share-buttons-bottom li').eq(jQuery('#socials-list li input.text').index(this)).each(function(){jQuery(this).addClass('none');});
			jQuery('#huge-it-share-buttons-top li').eq(jQuery('#socials-list li input.text').index(this)).each(function(){jQuery(this).addClass('none');});
		}
	});

	jQuery('#buttons_size_list  input').click(function(){
		var thisval=jQuery(this).val();
		if(thisval=="20"){jQuery('#buttons_size_block  h4').html('Small');}
		else if(thisval=="30"){jQuery('#buttons_size_block  h4').html('Medium');}
		else{jQuery('#buttons_size_block  h4').html('Big');}
		jQuery(this).parents('ul').find('li.active').removeClass('active');
		jQuery(this).parents('li').addClass('active');
		var i=0;
		jQuery(".huge-it-share-buttons li a").each(function(){

			strleft = thisval*i;
			strtop= thisval*jQuery('#styles_list li input:checked').val();
			
			if(i==18) {
				i = 0;
				strleft=jQuery('#styles_list  li input:checked').val()*i;
			}				
			
			jQuery(this).removeClass('size20 size30 size40');
			jQuery(this).addClass('size'+thisval);
			jQuery(this).css({'background-position':'-'+strleft+'px -'+strtop+'px','width':thisval,'height':thisval});
			i++;
		});
		
	});
	
	jQuery('#position_list input').click(function(){
		jQuery(this).parents('ul').find('li.active').removeClass('active');
		jQuery(this).parents('li').addClass('active');
		
		var arr=jQuery(this).val().split('-');
		if(arr[1]=='top'){
			jQuery('#huge-it-share-buttons-bottom').removeClass('active');
			jQuery('#huge-it-share-buttons-top').addClass('active');
		}else{
			jQuery('#huge-it-share-buttons-top').removeClass('active');
			jQuery('#huge-it-share-buttons-bottom').addClass('active');
		}
		
		if(arr[0]=="left"){
			jQuery('.huge-it-share-buttons h3').css({'text-align':'left'});
			jQuery('.huge-it-share-buttons ul').css({'float':'left', 'text-align':'left'});
		}else if(arr[0]=="right"){
			jQuery('.huge-it-share-buttons h3').css({'text-align':'right'});
			jQuery('.huge-it-share-buttons ul').css({'float':'right', 'text-align':'right'});
		}else {
			jQuery('.huge-it-share-buttons h3').css({'text-align':'center'});
			jQuery('.huge-it-share-buttons ul').css({'margin':'0px auto','float':'none','text-align':'center'});
		}
	});
	
	var el = jQuery('#hugeit-share-buttons-preview-container');
	var elpos_original = el.offset().top;
	jQuery(window).scroll(function(){
		var elpos = el.offset().top;
		var windowpos = jQuery(window).scrollTop();
		var finaldestination = windowpos;
		if(windowpos<elpos_original) {
			finaldestination = elpos_original;
			el.stop().css({'top':3});
		} else {
			el.stop().animate({'top':finaldestination-elpos_original+40},500);
		}
	});
	
	
	var strel = jQuery('#hugeit_share-buttons-unique-options');
	var strelpos_original = strel.offset().top;
	jQuery(window).scroll(function(){
		var elpos = strel.offset().top;
		var windowpos = jQuery(window).scrollTop();
		var finaldestination = windowpos;
		if(windowpos<strelpos_original) {
			finaldestination = strelpos_original;
			strel.stop().css({'top':3});
		} else {
			strel.stop().animate({'top':finaldestination-elpos_original+90},500);
		}
	});
});