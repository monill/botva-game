function smith_initGame(){

	if($(".game_field").hasClass('ended'))
		return;
	$(".game_field  TD").click(function () {
		smith_DoClick(this);
	});

	$(".game_field TD").hover(
	  function () {	$(this).addClass("hover");	},
	  function () {	$(this).removeClass("hover");	}
	);
}
function smith_DoClick(obj){
	if (game_id==1)
		return smith_DoClick_1(obj);

	if (game_id==2)
		return smith_DoClick_2(obj);

	if (game_id==4)
		return smith_DoClick_2(obj);

	// шахта
	if (game_id==10)
		return smith_DoClick_10(obj);
}

function smith_DoClick_1(obj){
	var type= $('input[name=cmd]:radio:checked').val();

	$("#gameField").load(game_url + '&' + type +"=" +obj.id+ '&l='+Math.random(),function(){
		smith_initGame();
	});
}
function smith_DoClick_2(obj){
	$("#gameField").load(game_url + '&open=' +obj.id,function(){
		smith_initGame();
	});
}
function smith_DoClick_10(obj){
	// id = obj.id.toString().match(/(\d+)/);

	$("#gameField").load(game_url + '&i=' + obj.id,function(answer){

//		smith_initGame();

	});
}

/**
 *
 * @access public
 * @return void
 **/
function tryAvatar(type){
	var race	= type.substring(0,1);
	var sex		= type.substring(1,2);

	if (sex==1)
		var layers	= getAvatarLayersM(race,	sex,	type);
	else
		var layers	= getAvatarLayersF(race,	sex,	type);

	var start	= end = body ="";

	for(n in layers){
		postfix	= n==0	? '.jpg'	 : '.png';
		start	+= "<div style='background: url(images/avatars/"+layers[n]+postfix+")'>";
		end		+= "</div>";
		body	+= layers[n]+"<br />";
	}

	if (parseInt(type.substring(2,type.length))==0) {
		var race2	= race=='0'	? 2	: race;
		var sex2	= sex=='2'	? 0	: sex;
		start	= "<img src='images/avatars/"+race2+sex2+"0000000000.png' />";

		body	= end="";
	}

	var html	= "<div class='avatar'>$center</div>";
	var desc	= type+"<br />"+body;
	desc	 ="";
	html	= html.replace(/\$center/g,start+desc+end);
	$('.avatar_page DIV.avatar').replaceWith(html);
}
/**
 *	Мужские аватары
 **/
function getAvatarLayersM(race,sex,type){
	var body	= type.substring(2,3);
	var prefix	= race+(sex%2)+body;

	var layers	= new Array();
	layers[layers.length]	= prefix+'a'+type.substring(3,5);

	// кольца + шрамы
	if (type.substring(12,14)!='00')
		layers[layers.length] = prefix+'d'+type.substring(12,14);

	// одежда
	if (type.substring(10,11)!='0')
		layers[layers.length] = prefix+'e'+type.substring(10,11);

	// уши, волосы, растительность
	layers[layers.length]	= prefix+'b'+type.substring(5,8);

	// рога
	layers[layers.length]	= prefix+'c'+type.substring(8,10);

	// цветные рога (украшение)
	if (type.substring(14,15)!='0'){
		var temp	= type.substring(14,15);

		temp	= 	(race==0)	? type.substring(8,9)+''+temp : '0'+temp;

		layers[layers.length] = prefix+'f'+temp;
	}
	return layers;
}
function getAvatarLayersF(race,sex,type){
	var prefix	= race+(sex%2)+1;

	var layers	= new Array();
	// тело + ajy
	layers[layers.length]	= prefix+'a'+type.substring(3,5);
	// глаза и нос
	layers[layers.length]	= prefix+'b'+type.substring(5,7);

	// одежда
	if (type.substring(10,11)!='0')
		layers[layers.length]	= 'cloth-'+type.substring(10,12);

	// волосы
	layers[layers.length]	= 'hair-'+type.substring(8,10);
	// уши, от цвета тела
	layers[layers.length]	= prefix+'c'+type.substring(4,5)+type.substring(7,8);

	if (type.substring(12,13)!='0')
		layers[layers.length]	= 'u1-0'+type.substring(12,13);
	if (type.substring(14,15)!='0')
		layers[layers.length]	= 'u2-0'+type.substring(14,15);
	if (type.substring(15,16)!='0')
		layers[layers.length]	= 'u3-0'+type.substring(15,16);
	return layers;
}

/**
 *
 * @access public
 * @return void
 **/
function doAvatar(page,type){
//alert('avatar.php?page='+page+'&type='+type);
	$('DIV#av_block').load('avatar.php?page='+page+'&type='+type);

	return false;
}

/**
 *
 * @access public
 * @return void
 **/
function upgradeOrderPrice(){
	var workType	= $('#work').val();

	$('.work_1, .work_2, .work_3').hide();

	$('.work_'+workType).show();

	$('#smithers').html("");
	$('#split').html("");
	$('#message').html("");


	var arr	= countOrderPrice(workType);

	var priceType	= $('#priceType').val();
	$('#price_min').html(digitSeparate(arr[0]) + ' ' + texts['money_' + priceType]);
	$('#price_max').html(digitSeparate(arr[1]) + ' ' + texts['money_' + priceType]);



}
/**
 *
 * @access public
 * @return void
 **/
function countOrderPrice(workType){
	var priceType	= $('#priceType').val();


	var level	= 0;
	// улучшение
	if (workType==1) {
		level	= $('#upgrade1').val()/5;
		//alert( $('#upgrade2').val());
		if (level>4 && $('#upgrade2:checked').val()==1){
			level=1;
			workType=10;

		}

	}else if(workType==2){
		level	= $('#magic2').val();
	}else if(workType==3){
		level	= $('#splitLevel').val();
	}


	var min	= limits['w_'+workType+'_min_'+priceType][level];
	var max	= limits['w_'+workType+'_max_'+priceType][level];

	if (min==undefined)
		return new Array(0,0);

	return new Array(min,max);

}

/**
 *
 * @access public
 * @return void
 **/
function doSmithOrderSearch(){
	var serial	= $('#menuForm').serialize();
	$.post(link_base+'&type=search',
		serial,
		function(data){
			$('#smithers').html(data);
			$('#message').html('');
			$('#split').html('');
		}
	);
}
function doSmithOrderSearch2(){
	var serial	= $('#menuForm').serialize();
	$.post(link_base+'&type=split',
		serial,
		function(data){
		    $('#split').html(data);
		    if($('#smith_close_search').attr('value') == 1){
			$('#smithers').html('');
			$('#split').html('');
			$('.cmd').toggle();
		    }
		}
	);
}
function doSmithOrder(){
	var serial	= $('#menuForm').serialize();
	$.post(link_base+'&type=save',
		serial,
		function(data){
		    $('#message').html(data);
		    if($('#smith_close_search').attr('value') == 1){
			$('#smithers').html('');
			$('#split').html('');
			$('#search_button').toggle();
		    }


		}
	);
}
function tavernUpdateBid(){

	var amount 	= parseInt($('#amount').val())+0;
	var type 	= parseInt($('#money').val());


	if (texts['money_'+type]==undefined)
		return;

	var win	= (amount*WIN_MULTI);
	// игра 3

	if (WIN_MULTI!=undefined) {
		var gtype 	= parseInt($('input[name=gtype]:radio:checked').val());
		if (gtype==3)
			win	= amount*WIN_MULTI;

	}

	if (isNaN(amount) || amount < 1 || amount > 1000000) {
		win	= '0';
	}

	var text	= win + ' ' + texts['money_'+type];

	$('#bidget').html(text);
}


var ajaxInt	= null;

/**
 *
 * @access public
 * @return void
 **/
function startAjaxReload(timeout,target){
	//return ;

	if (timeout==undefined)
		timeout	= 15000;
	if (target==undefined)
		target	= '.contentBlock';

	if (ajaxInt==null)
		ajaxInt	= setInterval('ajaxReload("'+target+'")',timeout);
}
/**

 *
 * @access public
 * @return void
 **/
function stopAjaxReload(){
	clearInterval(ajaxInt);
}

/**
 *
 * @access public
 * @return void
 **/
function ajaxReload(target){
	
	//var addr	= document.location.toString();

	//$(target).load(addr);
	document.location = document.location;
}


function smithShamanPoints(key,direction,max){
	var value	= $('#'+key).val();
	if (value==undefined)
		return;
	if (direction <0 && value<=max)
		return;
	if (direction >0 && value>=max)
		return;

	value	= parseInt(value)+direction;

	$('#'+key).val(value)
}