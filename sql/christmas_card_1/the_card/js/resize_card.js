jQuery( window ).resize(function() {
  jQuery('.christmasStreet1').css({
	 '-webkit-animation-name': 'no_animation',
	'-moz-animation-name': 'no_animation',
	'animation-name': 'no_animation'
  });

  jQuery('.christmasStreet2').css({
	 '-webkit-animation-name': 'no_animation',
	'-moz-animation-name': 'no_animation',
	'animation-name': 'no_animation'
  });

  jQuery('.foreground1').css({
	 '-webkit-animation-name': 'no_animation',
	'-moz-animation-name': 'no_animation',
	'animation-name': 'no_animation'
  });

   jQuery('.foreground2').css({
	 '-webkit-animation-name': 'no_animation',
	'-moz-animation-name': 'no_animation',
	'animation-name': 'no_animation'
  });



  setTimeout(function(){
	  jQuery('.christmasStreet1').css({
		 '-webkit-animation-name': 'christmasStreet1',
		'-moz-animation-name': 'christmasStreet1',
		'animation-name': 'christmasStreet1'
	  });

	  jQuery('.christmasStreet2').css({
		 '-webkit-animation-name': 'christmasStreet2',
		'-moz-animation-name': 'christmasStreet2',
		'animation-name': 'christmasStreet2'
	  });

	  jQuery('.foreground1').css({
		 '-webkit-animation-name': 'foreground1',
		'-moz-animation-name': 'foreground1',
		'animation-name': 'foreground1'
	  });

	  jQuery('.foreground2').css({
		 '-webkit-animation-name': 'foreground2',
		'-moz-animation-name': 'foreground2',
		'animation-name': 'foreground2'
	  });

  },10);

  var my_min_height=parseInt(jQuery( window ).height()*0.95,10);
  if (jQuery('.the_card_1_wrapper').parent().is('body')) {
    my_min_height=jQuery( window ).height();
  }

  jQuery('.the_card_1_wrapper').css({
   'min-height': my_min_height+'px'
  });
});

jQuery(document).ready(function() {
  var my_min_height=parseInt(jQuery( window ).height()*0.95,10);
  if (jQuery('.the_card_1_wrapper').parent().is('body')) {
    my_min_height=jQuery( window ).height();
  }

  jQuery('.the_card_1_wrapper').css({
   'min-height': my_min_height+'px',
   'display':'block'
  });
  //alert (parseInt(jQuery( window ).height()*0.95,10));
});
