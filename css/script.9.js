var is_opera =  (navigator.userAgent.indexOf("Opera") > -1) ? true : false;
var is_ie = (navigator.userAgent.indexOf("MSIE") > -1) ? true : false;
var is_moz    = ( (navigator.product == 'Gecko')  && (!is_opera) );

var tableStyle=is_ie & !is_opera ? 'block' : 'table';
var tableItemStyle=is_ie & !is_opera ? 'block' : 'table-cell';
var tableRowStyle=is_ie & !is_opera ? 'block' : 'table-row';

var images	= new Array();
var imagesSize	= 0;



function doImage(obj,base,down){
	/** I hate whent it jumps */
	if (obj.style.width==''  && obj.clientWidth>10)
		obj.style.width=obj.clientWidth+'px';

	if (obj.style.height=='' && obj.clientHeight>10)
		obj.style.height=obj.clientHeight+'px';

	var width	= obj.clientWidth;
	var height	= obj.clientHeight;


	/** Загрузка */
	var image1	= 'images/'+base+'_a.png';
	var image2	= 'images/'+base+'_p.png';

	if (down=='active'){
		var image2	= 'images/'+base+'_a.png';
		var down	= 'images/'+base+'_n.png';
	}

	if (down==undefined)
		var down	= 'images/'+base+'_n.png';

	if (down=='skip')
		var	down	= null;


	var id = 'img_'	+ imagesSize;
	if (obj.id==undefined || obj.id=="") {
		obj.id	= id;
	}else{
		id	= obj.id;
	}

	images[id]	= new Array(image1,image2,down);

	imagesSize++;
	/** Let's preload **/
	/*for(var temp in images[id]){
		var imgObj	= new Image(width,height);
		imgObj.src	= images[id][temp]
		images[id][temp]	= imgObj;
	}*/

	obj.onmouseuover	= function(){	changeImage(this,0)};
	obj.onmouseout		= function(){	changeImage(this,1)};
	obj.onmousedown		= function(){	changeImage(this,2)};

	changeImage(obj,0);
	//var runText	= "changeImageObj('"+id + "',0)";
	//setTimeout(runText,10);

}
function changeImageObj(id,num){
	return changeImage(doc(id),num);
}
function changeImage(obj,num){
	var id = obj.id;
	if (images[id]==undefined || images[id][num]==undefined || images[id][num]==null)
		return;

	obj.src	= images[id][num];
}


/**
 *
 * @access public
 * @return void
 **/
function setImage(obj,img){

	if (doc(obj)) {
		doc(obj).src	= img;
	}
}
/**
 *
 * @access public
 * @return void
 **/
function doWeapons(toShow){

	var weapons	= document.getElementById('weapons');
	var potions	= document.getElementById('potions');

	if (weapons==undefined || potions==undefined)
		return;

	var show	= potions.style.display=='none'	? 'potions'  : 'weapons';

	if (toShow!=undefined)
		show	= toShow;

	if (show=='potions'){
		potions.style.display  ='block';
		weapons.style.display  ='none';
		weapons_img.src		= 'images/'+LANG_NAME+'/but_pois_a.png';
	}else{
		potions.style.display	='none';
		weapons.style.display	='block';
		weapons_img.src		= 'images/'+LANG_NAME+'/but_pois_p.png';

	}
}

function doShopInfo(id){
	flipShowItem('item_'+id,'desc_'+id,'image_'+id,'images/'+LANG_NAME+'/buttons/but_shop_a.png','images/'+LANG_NAME+'/buttons/but_shop_p.png');
}
function doPetInfo(){
	flipShowItem('char_info','char_pet','char_pet_img','images/'+LANG_NAME+'/buttons/but_pets_a.png','images/'+LANG_NAME+'/buttons/but_pets_p.png');
}


function flipShowItem(item_1_name,item_2_name,image_name,image_1_url,image_2_url,toShow){
	var item_1	= document.getElementById(item_1_name);
	var item_2	= document.getElementById(item_2_name);
	var image	= document.getElementById(image_name);


	if (item_1==undefined || item_2==undefined || image==undefined)
		return;


	var show	= item_1.style.display=='none'	? 'item_1'  : 'item_2';

	if (toShow!=undefined)
		show	= toShow;

	if (show=='item_1'){
		item_1.style.display  ='block';
		item_2.style.display  ='none';
		image.src		= image_1_url;
	}else{
		item_1.style.display	='none';
		item_2.style.display	='block';
		image.src		= image_2_url;
	}

}

/**
 *
 * @access public
 * @return void
 **/

var mTitle 		= document.title;

var start_time	= new Date();
var countTimeout	= null;


function startCounter(obj_id,eventTime,update,funct){


	start_time	= new Date();

	countTime(obj_id,eventTime,update,null,funct);
}
/**
 *
 * @access public
 * @return void
 **/
function stopCounter(){
	if (countTimeout!=null)
		clearTimeout(countTimeout);
}

function countTime(obj_id,left_time,updateTitle,divElement,funct){
	//clearTimeout(countTimeout);
	if (updateTitle==undefined)
		updateTitle	= true;

	var obj	 = document.getElementById(obj_id);

	var now = new Date();

	//if (!(divElement!=undefined || divElement!=''))
	var left = left_time - Math.round((now.getTime()- start_time.getTime()) /1000.0);
	//else
	//	var left = event_time - Math.round(now.getTime() /1000.0);

	//ert(Math.round((now.getTime()- start_time.getTime()) /1000.0));

	// time out
	if (left<0) {
		obj.innerHTML	='0:00:00';

		var addr	= document.location.toString();
		if (addr.indexOf('?')==-1)
			addr += '?';

		addr += '&r2='+ Math.floor(Math.random()*1000);


		if (!(funct!=undefined || funct!='')) {
			window.setTimeout(funct+"('"+obj_id+"')",100);

		}else if (!(divElement!=undefined || divElement!='')){

			//alert(divElement);
			//alert(document.location);
			//doDivLoad(addr,'gameField');
		//	alert(123);
			doDivLoad(addr,divElement);
		}else if (updateTitle==1 || updateTitle==3)
			setTimeout("document.location='"+addr+"'",1000);


		return;
	}

	var hour = min	=0;
	if (left > 59) {
		min	 =	Math.floor(left / 60);
		left =	left %60;
	}
	if (min > 59) {
		hour =	Math.floor(min / 60);
		min =	min %60;
	}

	if(left<10)
		left	= "0"+ left;

	if(min<10)
		min		= "0"+ min;

	var stamp		= hour +":"+min +":"+ left;

	obj.innerHTML	= ' ' + stamp+' ';

	if (updateTitle && updateTitle!=3)
		document.title	=' [' + stamp + ']    ' + mTitle;

	countTimeout	= window.setTimeout("countTime('"+obj_id+"',"+left_time+","+updateTitle+",'"+divElement+"','"+funct+"');",1000);
}

var countTimeouts	= null;

function doTimers(base_name,end_func){

	for(var n in timers){
		var obj	 = document.getElementById(base_name+n);
		//alert(base_name+n);
		if (!obj)
			break;;

		if (timers[n]==undefined)
			continue;

		left_time	= timers[n];

		var now = new Date();
		var left = left_time - Math.round((now.getTime()- start_time.getTime()) /1000.0);


		// time out
		if (left<=0) {
			obj.innerHTML	='---';
			if (end_func!=undefined)
				window[end_func](n);
			timers[n]	= undefined;
			continue;
		}
		var hour = min	=0;
		if (left > 59) {
			min	 =	Math.floor(left / 60);
			left =	left %60;
		}
		if (min > 59) {
			hour =	Math.floor(min / 60);
			min =	min %60;
		}

		if(left<10)
			left	= "0"+ left;

		if(min<10)
			min		= "0"+ min;

		var stamp		= hour +":"+min +":"+ left;
		obj.innerHTML	= ' ' + stamp+' ';
	}




	countTimeouts	= window.setTimeout("doTimers('"+base_name+"','"+end_func+"');",1000);
}

function trade_timer(item){

	var bid	= document.getElementById('bid_'+item);
	var buy	= document.getElementById('buy_'+item);

	if (bid)
		bid.innerHTML	= texts['trade_ended'];
	if (buy)
		buy.innerHTML	= texts['trade_ended'];


	return "OK+"+item;
}
function shtab_timers(item){
	doc('sh2_'+item).innerHTML	= doc('sh_'+item).innerHTML;
}

function shtab_end(obj_id){
	$('#counter2').remove();
	document.title	= mTitle;
}


var tooltip_id=null;

/**
 *
 * @access public
 * @return void
 **/
function doInfo(key,add_text,e,object,item_class){
	if (popups==undefined)
		return;

	var string	 = popups[key];

	if (string==undefined)
		return;

	if (add_text!=undefined && add_text!='')
		string	 = string + "\n" + add_text;


	string	= string.replace(/\[GOLD\]/g, 	texts['money_1']);
	string	= string.replace(/\[GREEN\]/g, 	texts['money_3']);
	string	= string.replace(/\[CRYST\]/g, 	texts['money_2']);


	doPopup (string,e,object,item_class);
}

function doItem(item_id,add_text,add_subject, lev,e,object){
	if (popups==undefined)
		return;

	var parts	= item_id.split('/');


	var itemType	= null;
	if (parts.length>1) {
		item_id		= parts[0]	;
		itemType	= parts[1];
	}


	var item	= popups['item_'+item_id];

	//alert(item);
	if (item==undefined)
		return;


	var name	= item[0];
	var image	= item[1];
	var	string	= item[2];


	if (add_text!=undefined && add_text!='')
		string	 = string + "\n" + add_text;

	if (itemType=='nobody')
		string	= add_text;

	if (add_subject!=undefined && add_subject!=''){
		if (add_subject.indexOf('[NAME]')!==-1) {
			name	= add_subject.replace('[NAME]',name);
		}else{
			name	= name + add_subject;
		}
	}
	string	= string.replace(/\[GOLD\]/g, 	texts['money_1']);
	string	= string.replace(/\[GREEN\]/g, 	texts['money_3']);
	string	= string.replace(/\[CRYST\]/g, 	texts['money_2']);

	string	= string.replace('{l1}',	lev);
	if (lev==0 || itemType=='nobody') {
		string	= string.replace(/\[L\].*\[\/L\]\\n/,	'');
	}else{
		string	= string.replace(/\[L\](.*)\[\/L\]/,	'$1');
	}

	//alert(string);

	if (image.indexOf('.png')==-1) {
		image	+= '.jpg';
	}
	var html	 =	"<table class='popup_item'><tr><th colspan='2'>"+name+"</th></tr>";
	html		+=  "<tr><td class='image'><img src='images/" + image + "' alt='"+name+"' class='item2'><td>" + string;
	html		+=	"</table>";

	//alert(html);
	var tooltip	= document.getElementById('tooltip2');
	doPopup (html,e,object,tooltip,0,0,500);


}

function doPopup (string,e,object,tooltip,offX,offY,delay){
	if (offX==undefined)
		offX=0;
	if (offY==undefined)
		offY=0;
	if (delay==undefined)
		delay=100;

	var tooltip_width=300;
	clearTimeout(tooltip_id);

	if (tooltip==undefined)
		tooltip = document.getElementById('tooltip');

	string	=	string.replace(/-#39;/g,	"'"		);

	string	=	string.replace(/-#38;/g,	"\""		);
	string	=	string.replace(/\\n/g,	"\n"	);
	string	=	string.replace(/\n/g,	"<br>"	);

	if (string=='')
		return;

	tooltip.innerHTML		= string;
	tooltip.style.display	= "none";
	tooltip.style.position	= "absolute";

	if (object.onmouseout==undefined || object.onmouseout.toString().indexOf('hide_tooltip')==-1) {
		object.onmouseout=function () {hide_tooltip();}
	}

	object.alt	= '';
	if (is_ie  && !is_opera){
		x=event.clientX+document.documentElement.scrollLeft+document.body.scrollLeft;
		y=event.clientY+document.documentElement.scrollTop+document.body.scrollTop;
	}else if (is_moz){
		x=e.pageX;
		y=e.pageY;
	}else{
		x=event.pageX;
		y=event.pageY;

	}
	x+=offX;
	y+=offY;
	if (document.body.clientWidth){
		body_width=document.body.clientWidth;
		if(body_width < x+tooltip_width)
			x=body_width-tooltip_width-20;
	}

	tooltip_id=setTimeout("show_tooltip2("+x+","+y+",'"+tooltip.id+"')",delay);
}

function show_tooltip2(x,y,obj_id) {
	var tooltip = document.getElementById(obj_id);
	tooltip.style.left=x+"px";
	tooltip.style.top=(y+10)+"px";
	tooltip.style.display='block';
}
function hide_tooltip() {
	clearTimeout(tooltip_id);
	document.getElementById('tooltip').style.display='none';

	if (document.getElementById('tooltip2'))
		document.getElementById('tooltip2').style.display='none';
}


var started_tags	= new Array();
function AddTag(tag,obj_name,tag2){
	if (tag2==undefined)
		tag2=tag;

	insert_tag(tag,tag2,obj_name);
}

function insert_tag(t1,t2,target_object,tagType){
	obj		= document.getElementById(target_object);

	var useBackup	= true;
	if ((document.selection && obj.document.selection.createRange().text.length>0)) {
		obj.focus();

		obj.document.selection.createRange().text = '[' + t1 + ']'+ obj.document.selection.createRange().text+'[/' + t2 + ']';
		useBackup	= false;
	} else if (obj.selectionEnd){
		var start_s = obj.selectionStart;
		var end_s	= obj.selectionEnd;
		if (start_s!=end_s) {
			var start_text  = (obj.value).substring(0, start_s);
			var middle_text = (obj.value).substring(start_s, end_s);
			var end_text    = (obj.value).substring(end_s, obj.textLength);
			obj.value = start_text + "["+ t1 +"]"+middle_text+"[/"+ t2 +"]" + end_text;
			useBackup	= false;
		}
	}
	if (useBackup) {
		// только начальлный или только конечный тег.

		if (tagType==undefined)
			tagType	= t1;

		var add	= "";

	//	alert(started_tags[target_object]	);
		if (started_tags[target_object]==undefined)
			started_tags[target_object]	= new Array();

		if (started_tags[target_object][tagType]==undefined || started_tags[target_object][tagType]==0) {
			add	= '[' + t1 + ']';
			started_tags[target_object][tagType]	= 1;
		}else{
			add	= '[/' + t2 + ']';
			started_tags[target_object][tagType]	= 0;
		}

		obj.value += add;
	}


}

function insert_text(t1,target_object){
	obj=document.getElementById(target_object);
	if ((document.selection)) {
		obj.focus();
		obj.document.selection.createRange().text = t1;
	} else if (obj.selectionEnd){
		var start_s = obj.selectionStart;
		var end_s	= obj.selectionEnd;
		var start_text  = (obj.value).substring(0, start_s);
		var end_text    = (obj.value).substring(end_s, obj.textLength);
		obj.value = start_text + t1  + end_text;
	} else  obj.value += t1;
}


/**
 *
 * @access public
 * @return void
 **/
function ShowColor(sid,target_name){
	if (started_tags[target_name]!=undefined && started_tags[target_name]['COLOR'])
		return insert_tag('COLOR','ENDTAG',target_name,'COLOR');



	for(var n =1;; n++){
		var obj	= document.getElementById('colors_'+n);
		if (!obj)
			break;

		obj.style.display	 =  (n==sid)  ? 'block' : 'none';
	}
	return false;
}
/**
 *
 * @access public
 * @return void
 **/
function AddColor(color,target_name,sid){
	insert_tag('COLOR='+color,'ENDTAG',target_name,'COLOR');

	document.getElementById('colors_'+sid).style.display='none';

}
function insert_message(t1, t2, text){
	obj=document.getElementById(target_object);

	old_text=obj.value;
	if ((document.selection)) {
		obj.focus();
		obj.document.selection.createRange().text = t1+ text +t2;
	} else if (obj.selectionEnd){
		var start_s = obj.selectionStart;
		var end_s	= obj.selectionEnd;
		var start_text  = (obj.value).substring(0, start_s);
		var middle_text = (obj.value).substring(start_s, end_s);
		var end_text    = (obj.value).substring(end_s, obj.textLength);
		obj.value = start_text + "["+ t1 +"]"+middle_text+"[/"+ t2 +"]" + end_text;
	}else obj.value += t1 + text + t2;
}

function addCharacter(target_object){
	var text	= prompt(texts['txt_enter_char'],'');
	if (text==null || text==undefined)
		return;
	// http://www.botva-online.ru/player.php?id=16552
	// http://www.botva-online.ru/l.php?id=16552
	// alert(text);
	var match_pl	= text.search(/player.php\?id=([0-9]+)$/);
	var match_l		= text.search(/l.php\?id=([0-9]+)$/);
	var match_id	= text.search(/^([0-9]+)$/);
	var id			= 0;

	// as is
	if (match_id!=-1)				id	= text;
	else if(match_pl !=-1)			id  = text.substring(match_pl+14);
	else if(match_l !=-1)			id  = text.substring(match_l+9);

	if (id < 1) {
		alert(texts['txt_wrong_player']);
		return;
	}

	insert_text('[CHAR='+id+']',target_object);
}

function addClan(target_object){
	var text	= prompt(texts['txt_enter_clan'],'');
	if (text==null || text==undefined)
		return;

	// http://www.botva-online.ru/clan.php?id=1497
	// http://www.botva-online.ru/l.php?id=16552
	var match_cl	= text.search(/clan.php\?id=([0-9]+)$/);
	var match_id	= text.search(/^([0-9]+)$/);
	var id			= 0;

	if (match_id!=-1)				id	= text;
	else if(match_cl !=-1)			id  = text.substring(match_cl+12);

	if (id < 1) {
		alert(texts['txt_wrong_clan']);
		return;
	}

	insert_text('[CLAN='+id+']',target_object);
}


/**
 *
 * @access public
 * @return void
 **/

function doGroup(group,state){

	var groups	= new Array();
	groups['auction']	= new Array('bid_start',	'bid_type');
	groups['trade']		= new Array('fast_price',	'fast_type');

	if (groups[group]==undefined)
		return;

		//alert(groups[group]);
	for(var item in groups[group]){
		var itemName	=groups[group][item];
		document.getElementById(itemName).disabled	= state;
	}
}

/**
 *
 * @access public
 * @return void
 **/
function digitSeparate(n){
	return n;

    var a, s = Number(n).toFixed(1);
    while (a = s.match(/\d(\d\d\d\.)/)) s = s.replace(a[1], "." + a[1]);
    a = s.match(/((\d)\.0$)/);

    return s.replace(a[1],a[2]);
}


/**
 *
 * @access public
 * @return void
 **/
function updateBid(){
	var price	= parseInt(document.getElementById('bid_start').value);

	var moneyObj	= document.getElementById('bid_type');

	var money	= moneyObj.options[moneyObj.selectedIndex].value;

	var bid_step= Math.ceil(price/10);

	var min_bid	= bid_price[(money-1)*2];
	var max_bid	= bid_price[(money-1)*2+1];

	//alert(bid_step);
	document.getElementById('bid_step').value		= bid_step;
	document.getElementById('bid_min').innerHTML	= digitSeparate(min_bid);
	document.getElementById('bid_max').innerHTML	= digitSeparate(max_bid);

	var tax	= digitSeparate(Math.ceil(price	* bid_tax[money-1]/100));

	if (texts!=undefined && texts['money_'+money]!=undefined)
		tax	= tax + ' ' + texts['money_' + money];

	doc('bid_tax').innerHTML	= tax;
	doc('bid_tax2').innerHTML	= bid_tax[money-1];


}

/**
 *
 * @access public
 * @return void
 **/
function updateTax(){
	tradeConfirmed	= 0;
	var price		= parseInt(document.getElementById('fast_price').value);

	//var hoursObj	= document.getElementById('fast_hours');
	var moneyObj	= document.getElementById('fast_type');


	//var hours	= hoursObj.options[hoursObj.selectedIndex].value;
	var money	= moneyObj.options[moneyObj.selectedIndex].value;

	var tax	= digitSeparate(Math.ceil(price	* fast_tax[money-1]/100));

	if (texts!=undefined && texts['money_'+money]!=undefined)
		tax	= tax + ' ' + texts['money_' + money];

	doc('fast_tax').innerHTML	= tax;
	doc('fast_tax2').innerHTML	= fast_tax[money-1];

	var min_fast	= fast_price[(money-1)*2];
	var max_fast	= fast_price[(money-1)*2+1];


	doc('min_fast').innerHTML	= digitSeparate(min_fast);
	doc('max_fast').innerHTML	= digitSeparate(max_fast);
}
function tradeConfirm(obj){
	tradeConfirmed	= 0;

	obj.innerHTML	= texts['trade_conf_1'];

	if (obj.id==undefined ||obj.id=='') {
		var rand_name	= '';
		do{
			rand_name	= 'rand_' + Math.floor(Math.random()*10000);
		}while(document.getElementById(rand_name));

		obj.id	= rand_name;
	}
	setTimeout("tradeConfirm2('"+ obj.id +"')",2000);

	obj.onclick	= 'return false;';
}

var tradeConfirmed	= 0;

function tradeStartConfirm(obj_name){
	if (tradeConfirmed==1)
		return true;

	var obj	= document.getElementById(obj_name);

	if (texts['trade_conf_st_1'].length==0) {
		texts['trade_conf_st_1']	= obj.innerHTML;
	}

	obj.innerHTML	= texts['trade_conf_1'];

	if (obj.id==undefined ||obj.id=='') {
		var rand_name	= '';
		do{
			rand_name	= 'rand_' + Math.floor(Math.random()*10000);
		}while(document.getElementById(rand_name));

		obj.id	= rand_name;
	}
	setTimeout("tradeConfirm2('"+ obj.id +"','trade_conf_st_2')",2000);

	//alert('start');
	return false;
}

function tradeConfirm2(obj_id,key){
	if (key==undefined)
		key = 'trade_conf_2'

	var obj	= document.getElementById(obj_id);
	obj.innerHTML	= texts[key];
	obj.onclick	= 'return true';
}

function showBox(id){
	var body	= document.getElementById('b_'+id);
	var title	= document.getElementById('t_'+id);

	var setShow	= 0;
	if (body.className.search('hidden')>=0) { // object is hidden
		body.className	= body.className.replace('hidden',	'shown');
		title.className	= title.className.replace('hide',	'show');
		setShow	= 1;
	}else{
		body.className	= body.className.replace('shown',	'hidden');
		title.className	= title.className.replace('show',	'hide');
		setShow	= 0;
	}

	$.post('ajax.php?m=show',	{element: id, value: setShow});

}

var assault_interval = 30*1000;
var assault_sort 	= 'leader';
var assault_order 	= 'desc';
function updateAssault(){
	$("#assault").load(assault_url + " #assault");
}
function sortAssault(type){
	assault_url	= assault_url.replace(/&sort=[a-z]+/,		'');
	assault_url	= assault_url.replace(/&order=(asc|desc)/,	'');

	var order	= 'desc';
	if (type==assault_sort)
		order	= assault_order=='asc'	? 'desc' : 'asc';

	assault_sort	= type;
	assault_order	= order;

	assault_url	=	assault_url + '&sort=' + type	 + '&order=' + order;

	updateAssault();
}

function loadPage(link,target){
//	$("#"+target).load(link);
	$("#"+target).load(link + ' #' + target + ' > *');
	return false;
}
function loadPageObjFull(obj,target){
	$.get(obj.href,	function(answer){

		$("#"+target).html(answer);
	});
	return false;
}
function loadPageObj(obj,target){
	return loadPage(obj.href,target);
}

function loadPageSelect(obj,link,target){
	link	= link	+ '&' + obj.name + '=' + obj.options[obj.selectedIndex].value;;
	//alert(link);
	return loadPage(link,target);
}
function doc(id){
	return document.getElementById(id);
}

function selectValue(id){
	var obj = doc(id);
	if (obj)
		return obj.options[obj.selectedIndex].value;
	return null;
}

function assault_timer(id){
	if (doc('timer_'+id)==undefined)
		return;

	if (enemy[id]!=undefined)
		doc('timer_'+id).innerHTML	= "<a href='"+assault_url_k+'&attack='+enemy[id]+"'>" + texts['assault_attack']+ "</a>";


}


function assaultAttack(id){
	$("#assault_body").load(assault_url_k + "attack=" +id + " #assault_body");
}

function SelectAll(obj){
    obj.focus();
    obj.select();
}
var showOpens	 = new Array();

function showHiddenItemS(my_obj,gid,obj_id,hand_id,showValue,hideValue){
	var items	= showItems[gid];
	if (!items)
		return;

	items	= items.split(',');


	if (showOpens[gid]==undefined)
		showOpens[gid]	= 1;


	var toShow	= showOpens[gid]==1;

	my_obj.innerHTML	= toShow	? hideValue	: showValue;
	showOpens[gid]		= toShow	? 0 : 1;

	for(var n in items){
		obj	=	doc(hand_id + items[n]);
		if (!obj)
			continue;

		showHiddenItem(obj,obj_id+items[n],showValue,hideValue,toShow);
	}
}

function showHiddenItem(obj,obj_id,showValue,hideValue,toShow){

	var targ	= doc(obj_id);

	if (toShow==undefined)
		toShow= targ.className.search('hidden')>=0;

	if (toShow) { // object is hidden
		targ.className	= targ.className.replace('hidden',	'shown');

		if (hideValue!=undefined)
			obj.innerHTML	= hideValue;

	}else{
		targ.className	= targ.className.replace('shown',	'hidden');
		if (showValue!=undefined)
			obj.innerHTML	= showValue;
	}

	return false;
}
function updateLoginForm(obj){
	var form	= doc('loginForm');
	server		= obj.options[obj.selectedIndex].value;
	if (servers[server]==undefined)
		return;

	form.action	= servers[server]+'/login.php';
}


function doDivLoad(url,	divElement){
	$("#"+divElement).load(url);
}

function showHideCountry(){
	var value	= $('#countryList').val();

	for(var n = 1;n<100;n++)
		if (!$('#country_'+n).hide())
			break;
	$('#country_'+value).show();
}

function updateWellGlory(){
	var value	= $('#glory_type').val();

//	alert(value);
	value	= value.split('||');

	$('#can_fix').text(value[1]);
}

function updateParam(key,direction){

	if (disablePoints)
		return;

	var value	= $('#'+key).val();
	if (value==undefined)
		return;
	if (direction <0 && value<=params[key][0])
		return;
	if (direction >0 && value>=params[key][1] && params[key][1]!=0)
		return;

	value	= parseInt(value)+direction;

	$('#'+key).val(value)
	updatePoints();
}

function updatePoints(){
	var	temp=0;
	for(key in params) {
		if ($('#'+key).length>0)
			temp	+= $('#'+key).val()*parseFloat(params[key][2]);
	}

	if (disablePoints)
		totalPoints	= temp;

	$('#points').html(totalPoints-temp);
}

/**
 *
 * @access public
 * @return void
 **/
function doSubmit(formName){
	$('#'+formName).submit();
}

/**
 *
 * @access public
 * @return void
 **/
function doImageHover(id,doHover){
//alert(id);
	if (doHover==undefined)
		doHover=true;

	var newImage	= doc('img'+id).src;

	newImage	= (doHover)	? newImage.replace('_p.','_a.') : newImage.replace('_a.','_p.');

	doc('img'+id).src	=	newImage;
}

/**
 *
 * @access public
 * @return void
 **/
function doCastle(id){

	hideCastle();


	doc('castle_img').src	=	doc('castle_img').src.replace('_0_a','_'+id+'_a');

}

function hideCastle(){

	if (doc('castle_img').src.indexOf('_0_a')>0)
		return;

	var newImage	= doc('castle_img').src.replace(/_[0-9]_a/,'_0_a');


	doc('castle_img').src	=	newImage;
}

/**
 *
 * @access public
 * @return void
 **/
function moreGifts(id,type){
	//$("#moreGifts").replaceWith("<div id='moreGifts2'></div>");

	$("#moreGifts").load('ajax.php?m=gifts&id='+id+'&type='+type);
}


/**
 *
 * @access public
 * @return void
 **/
function change(item, direction, max){
	var value	= $('#'+item).val();
	if (value==undefined)
		return;

	if (direction <0 && value<=max)
		return;
	if (direction >0 && value>=max)
		return;

	$('#'+item).val(parseInt(value)+direction);
}

/**
 *
 * @access public
 * @return void
 **/
function changePrice(obj,target,multi){
	doc(target).innerHTML	= selectValue(obj.id) * multi;
}
function recountPandora(){
	var price	= 0;
	for(n=1;n<=PANDORA_AMOUNT;n++)
		price	+= selectValue('insurance['+n+']')==0	? 0 : PANDORA_PRICE	;

	doc('price').innerHTML	= price;


}
/**
 *
 * @access public
 * @return void
 **/
function addTradeImages(){
	$('DIV.trade IMG').each(function(num, img) {addTradeImage(img);});
	$('IMG.img_sells').each(function(num, img) {addTradeImage(img);});
}

function addTradeImage(img){

	var sells	=  $(img).attr('sells');

	if (sells==undefined)
		return;
	var	cl	= $(img).width()>60 ? 'sells_countL' : '';
	$(img).before("<span class='sells_count "+cl+"'>"+sells+"</span>");
}

function showAlert(message, buttons)
{
    if ( typeof showAlert.butPressed == 'undefined' )
    {
	    schetVizovov.butPressed = 0;
    }
}

/**
 *
 * @access public
 * @return void
 **/
function doScreens(){
	if (typeof(loadedScreens)=='undefined') {
		$.getScript('/css/screens.js',function(){startScreens();});
	}else{
		startScreens();
	}


}
/**
 *
 * @access public
 * @return void
 **/
function loadCss(url){
	$("head").append("<link>");
    css = $("head").children(":last");
    css.attr({
      rel:  "stylesheet",
      type: "text/css",
      href: url
    });

}