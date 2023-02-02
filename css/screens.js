var loadedScreens	= false;

prepareScreens();

/**
 *
 * @access public
 * @return void
 **/
function startScreens(){
	if (!loadedScreens)
		return postponeStart();



	var content = new Array();

	for(var n = 1; n<=11; n++){
		  content.push({
			   'content': '<img src="../images/screens/' + n + '.jpg" alt=""/>',
			   'title': "test: "+n
		  });
	 }

	 $.fancybox( content, {
			'padding'			:	0,
			'margin'			:	0,
			'overlayShow'		:	true,
			'transitionIn'		:	'none',
			'transitionOut'		:	'none',
			'showNavArrows'		:	true,
			'width'				:	740,
			'height'			:	600,
			'autoDimensions' 	:	false,
			'changeFade'		:	0,
			'cyclic'			:	true,
			'titlePosition'		:	'inside',
		 	'titleFormat'		: function( title, currentArray, currentIndex, currentOpts )
			{
				var text	= texts['txt_screens'];

				text	= text.replace('{now}',currentIndex+1);
				text	= text.replace('{total}',currentArray.length);
				text	= text.replace('{txt}',texts['txt_screen_'+(currentIndex+1)]);
				return text;
			}
	 });

}
/**
 *
 * @access public
 * @return void
 **/
function postponeStart(){
	setTimeout( 'startScreens()',300);
}

/**
 *
 * @access public
 * @return void
 **/
function prepareScreens(){
	if (loadedScreens)
		return false;



	var addr = '&r2='+ Math.floor(Math.random()*1000);
	loadCss('/css/fancybox/jquery.fancybox-1.3.1.css');
	loadCss('/css/screens.css?id='+addr);

   	$.getScript('/css/fancybox/jquery.fancybox-1.3.1.pack.js',function(){loadedScreens=true});


}
