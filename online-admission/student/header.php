<?php
if ($_SESSION['user_type']=="" || !isset($_SESSION['user_type']) || !isset($_SESSION['user_name']) || !isset($_SESSION['user_id']) )
{
	header("location:logout.php");
	exit;
}
   
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Welcome to Kandra RKK Mahavidyalaya : Student Panel</title>
<link rel="stylesheet"  href="jscal/skins/aqua/theme.css" type="text/css" />
<link rel="stylesheet" href="../css/modal-message.css" type="text/css">
<link rel="stylesheet"  href="jscal/skins/aqua/theme.css" type="text/css" />
<script type="text/javascript" src="../js/function.js"></script>
<script language="javascript" src="../js/ajax.js" type="text/javascript"></script>
<script language="javascript" src="../js/load.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/modal-message.js"></script>
<script type="text/javascript" src="../js/dom-drag.js"></script>
<!--calendar-->
<script language="javascript" type="text/javascript" src="jscal/calendar.js"></script>
<script language="javascript" type="text/javascript" src="jscal/calendar-setup.js"></script>
<script type="text/javascript" src="jscal/lang/calendar-en.js"></script>

<script type="text/javascript" src="../js/jquery-1.3.2.min.js" ></script>

<script type="text/javascript">AC_FL_RunContent = 0;</script>
<script src="../Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script src="../js/my-applications.js" type="text/javascript"></script>
<?php
require "./inc/link_styles_js.php";
?>

<script language="javascript">
var XMLHttpRequestObject = false;
if (window.XMLHttpRequest) {
XMLHttpRequestObject = new XMLHttpRequest();
} else if (window.ActiveXObject) {
XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
}
function getData(dataSource, divID)
{
if(XMLHttpRequestObject) {
var obj = document.getElementById(divID);
XMLHttpRequestObject.open("GET", dataSource);
XMLHttpRequestObject.onreadystatechange = function()
{
if (XMLHttpRequestObject.readyState == 4 &&
XMLHttpRequestObject.status == 200) {
obj.innerHTML = XMLHttpRequestObject.responseText;
//alert( XMLHttpRequestObject.responseText);
}
}
XMLHttpRequestObject.send(null);
}
}
</script>
<style type="text/css">
	
	/* Entire pane */
	
	#dhtmlgoodies_xpPane{
		background-color:#589EE2;
		float:left;
		width:200px;
		font-size:11px;
	}
	#dhtmlgoodies_xpPane .dhtmlgoodies_panel{
		margin-left:10px;
		margin-right:10px;
		margin-top:10px;
		font-size:11px;
	}
	#dhtmlgoodies_xpPane .panelContent{
		font-size:0.7em;
		background-image:url('images/bg_pane_right.gif');
		background-position:top right;
		background-repeat:repeat-y;
		border-left:1px solid #FFF;
		border-bottom:1px solid #FFF;	
		padding-left:2px;
		padding-right:2px;	
		overflow:hidden;
		position:relative;
		clear:both;
		font-size:11px;
	}
	#dhtmlgoodies_xpPane .panelContent div{
		position:relative;
		font-size:11px;
	}
	#dhtmlgoodies_xpPane .dhtmlgoodies_panel .topBar{
		background-image:url('images/bg_panel_top_right.gif');
		background-repeat:no-repeat;
		background-position:top right;
		height:25px;
		padding-right:5px;
		cursor:pointer;
		overflow:hidden;
		font-size:11px;
	
	}
	#dhtmlgoodies_xpPane .dhtmlgoodies_panel .topBar span{
		line-height:25px;
		vertical-align:middle;
		font-family:arial;
		font-size:0.7em;
		color:#589EE2;
		font-weight:bold;
		float:left;
		padding-left:5px;
		font-size:11px;
	}
	#dhtmlgoodies_xpPane .dhtmlgoodies_panel .topBar img{
		float:right;
		cursor:pointer;
	}
	#otherContent{	/* Normal text content */
		float:left;	/* Firefox - to avoid blank white space above panel */
		padding-left:10px;	/* A little space at the left */
		font-size:11px;
	}	
	</style>
	<script type="text/javascript">
	/************************************************************************************************************
	@fileoverview
	Floating window
	
	Copyright (C) October, 2005  Alf Magne Kalleland(post@dhtmlgoodies.com)
	
	This library is free software; you can redistribute it and/or
	modify it under the terms of the GNU Lesser General Public
	License as published by the Free Software Foundation; either
	version 2.1 of the License, or (at your option) any later version.
	
	This library is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
	Lesser General Public License for more details.
	
	You should have received a copy of the GNU Lesser General Public
	License along with this library; if not, write to the Free Software
	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
	
	
	www.dhtmlgoodies.com 
	Alf Magne Kalleland

	/* Update LOG 
	
	January, 28th - Fixed problem when double clicking on a pane(i.e. expanding and collapsing).
	
	*/
	var xpPanel_slideActive = true;	// Slide down/up active?
	var xpPanel_slideSpeed = 20;	// Speed of slide
	var xpPanel_onlyOneExpandedPane = false;	// Only one pane expanded at a time ?
	
	var dhtmlgoodies_xpPane;
	var dhtmlgoodies_paneIndex;
	
	var savedActivePane = false;
	var savedActiveSub = false;

	var xpPanel_currentDirection = new Array();
	
	var cookieNames = new Array();
	
	
	var currentlyExpandedPane = false;
	
	/*
	These cookie functions are downloaded from 
	http://www.mach5.com/support/analyzer/manual/html/General/CookiesJavaScript.htm
	*/	
	function Get_Cookie(name) { 
	   var start = document.cookie.indexOf(name+"="); 
	   var len = start+name.length+1; 
	   if ((!start) && (name != document.cookie.substring(0,name.length))) return null; 
	   if (start == -1) return null; 
	   var end = document.cookie.indexOf(";",len); 
	   if (end == -1) end = document.cookie.length; 
	   return unescape(document.cookie.substring(len,end)); 
	} 
	// This function has been slightly modified
	function Set_Cookie(name,value,expires,path,domain,secure) { 
		expires = expires * 60*60*24*1000;
		var today = new Date();
		var expires_date = new Date( today.getTime() + (expires) );
	    var cookieString = name + "=" +escape(value) + 
	       ( (expires) ? ";expires=" + expires_date.toGMTString() : "") + 
	       ( (path) ? ";path=" + path : "") + 
	       ( (domain) ? ";domain=" + domain : "") + 
	       ( (secure) ? ";secure" : ""); 
	    document.cookie = cookieString; 
	}

	function cancelXpWidgetEvent()
	{
		return false;	
		
	}
	
	function showHidePaneContent(e,inputObj)
	{
		if(!inputObj)inputObj = this;
		
		var img = inputObj.getElementsByTagName('IMG')[0];
		var numericId = img.id.replace(/[^0-9]/g,'');
		var obj = document.getElementById('paneContent' + numericId);
		if(img.src.toLowerCase().indexOf('up')>=0){
			currentlyExpandedPane = false;
			img.src = img.src.replace('up','down');
			if(xpPanel_slideActive){
				obj.style.display='block';
				xpPanel_currentDirection[obj.id] = (xpPanel_slideSpeed*-1);
				slidePane((xpPanel_slideSpeed*-1), obj.id);
			}else{
				obj.style.display='none';
			}
			if(cookieNames[numericId])Set_Cookie(cookieNames[numericId],'0',100000);
		}else{
			if(this){
				if(currentlyExpandedPane && xpPanel_onlyOneExpandedPane)showHidePaneContent(false,currentlyExpandedPane);
				currentlyExpandedPane = this;	
			}else{
				currentlyExpandedPane = false;
			}
			img.src = img.src.replace('down','up');
			if(xpPanel_slideActive){
				if(document.all){
					obj.style.display='block';
					//obj.style.height = '1px';
				}
				xpPanel_currentDirection[obj.id] = xpPanel_slideSpeed;
				slidePane(xpPanel_slideSpeed,obj.id);
			}else{
				obj.style.display='block';
				subDiv = obj.getElementsByTagName('DIV')[0];
				obj.style.height = subDiv.offsetHeight + 'px';
			}
			if(cookieNames[numericId])Set_Cookie(cookieNames[numericId],'1',100000);
		}	
		return true;	
	}
	
	
	
	function slidePane(slideValue,id)
	{
		if(slideValue!=xpPanel_currentDirection[id]){
			return false;
		}
		var activePane = document.getElementById(id);
		if(activePane==savedActivePane){
			var subDiv = savedActiveSub;
		}else{
			var subDiv = activePane.getElementsByTagName('DIV')[0];
		}
		savedActivePane = activePane;
		savedActiveSub = subDiv;
		
		var height = activePane.offsetHeight;
		var innerHeight = subDiv.offsetHeight;
		height+=slideValue;
		if(height<0)height=0;
		if(height>innerHeight)height = innerHeight;
		
		if(document.all){
			activePane.style.filter = 'alpha(opacity=' + Math.round((height / subDiv.offsetHeight)*100) + ')';
		}else{
			var opacity = (height / subDiv.offsetHeight);
			if(opacity==0)opacity=0.01;
			if(opacity==1)opacity = 0.99;
			activePane.style.opacity = opacity;
		}			
		
					
		if(slideValue<0){			
			activePane.style.height = height + 'px';
			subDiv.style.top = height - subDiv.offsetHeight + 'px';
			if(height>0){
				setTimeout('slidePane(' + slideValue + ',"' + id + '")',10);
			}else{
				if(document.all)activePane.style.display='none';
			}
		}else{			
			subDiv.style.top = height - subDiv.offsetHeight + 'px';
			activePane.style.height = height + 'px';
			if(height<innerHeight){
				setTimeout('slidePane(' + slideValue + ',"' + id + '")',10);				
			}		
		}
		
		
		
		
	}
	
	function mouseoverTopbar()
	{
		var img = this.getElementsByTagName('IMG')[0];
		var src = img.src;
		img.src = img.src.replace('.gif','_over.gif');
		
		var span = this.getElementsByTagName('SPAN')[0];
		span.style.color='#428EFF';		
		
	}
	function mouseoutTopbar()
	{
		var img = this.getElementsByTagName('IMG')[0];
		var src = img.src;
		img.src = img.src.replace('_over.gif','.gif');		
		
		var span = this.getElementsByTagName('SPAN')[0];
		span.style.color='';
		
		
		
	}
	
	
	function initDhtmlgoodies_xpPane(panelTitles,panelDisplayed,cookieArray)
	{
		dhtmlgoodies_xpPane = document.getElementById('dhtmlgoodies_xpPane');
		var divs = dhtmlgoodies_xpPane.getElementsByTagName('DIV');
		dhtmlgoodies_paneIndex=0;
		cookieNames = cookieArray;
		for(var no=0;no<divs.length;no++){
			if(divs[no].className=='dhtmlgoodies_panel'){
				
				var outerContentDiv = document.createElement('DIV');	
				var contentDiv = divs[no].getElementsByTagName('DIV')[0];
				outerContentDiv.appendChild(contentDiv);	
			
				outerContentDiv.id = 'paneContent' + dhtmlgoodies_paneIndex;
				outerContentDiv.className = 'panelContent';
				var topBar = document.createElement('DIV');
				topBar.onselectstart = cancelXpWidgetEvent;
				var span = document.createElement('SPAN');				
				span.innerHTML = panelTitles[dhtmlgoodies_paneIndex];
				topBar.appendChild(span);
				topBar.onclick = showHidePaneContent;
				if(document.all)topBar.ondblclick = showHidePaneContent;
				topBar.onmouseover = mouseoverTopbar;
				topBar.onmouseout = mouseoutTopbar;
				topBar.style.position = 'relative';

				var img = document.createElement('IMG');
				img.id = 'showHideButton' + dhtmlgoodies_paneIndex;
				img.src = 'images/arrow_up.gif';				
				topBar.appendChild(img);
				
				if(cookieArray[dhtmlgoodies_paneIndex]){
					cookieValue = Get_Cookie(cookieArray[dhtmlgoodies_paneIndex]);
					if(cookieValue)panelDisplayed[dhtmlgoodies_paneIndex] = cookieValue==1?true:false;
					
				}
				
				if(!panelDisplayed[dhtmlgoodies_paneIndex]){
					outerContentDiv.style.height = '0px';
					contentDiv.style.top = 0 - contentDiv.offsetHeight + 'px';
					if(document.all)outerContentDiv.style.display='none';
					img.src = 'images/arrow_down.gif';
				}
								
				topBar.className='topBar';
				divs[no].appendChild(topBar);				
				divs[no].appendChild(outerContentDiv);	
				dhtmlgoodies_paneIndex++;			
			}			
		}
	}
	
	</script>
    
    	<style type="text/css">
	body{
		font-family: Trebuchet MS, Lucida Sans Unicode, Arial, sans-serif;
	}
	
	#dhtmlgoodies_colorPicker{
		position:absolute;
		width:224px;
		padding-bottom:1px;
		background-color:#FFF;
		border:1px solid #317082;
	}
	
	#dhtmlgoodies_colorPicker .colorPicker_topRow{
		height:16px;
		padding-bottom:1px;
		border-bottom:3px double #317082;
		background-color:#E2EBED;
		padding-left:2px;

		width: 224px;	/* IE 5.x */
		width/* */:/**/222px;	/* Other browsers */
		width: /**/222px;
		
		height: 20px;	/* IE 5.x */
		height/* */:/**/16px;	/* Other browsers */
		height: /**/16px;
		
		
			
	}
	
	#dhtmlgoodies_colorPicker .colorPicker_statusBar{
		height:13px;
		padding-bottom:2px;
		
		border-top:3px double #317082;	
		background-color:#E2EBED;
		padding-left:2px;
		clear:both;
		
		width: 224px;	/* IE 5.x */
		width/* */:/**/222px;	/* Other browsers */
		width: /**/222px;	
		
		height: 18px;	/* IE 5.x */
		height/* */:/**/13px;	/* Other browsers */
		height: /**/13px;		
	}
	
	#dhtmlgoodies_colorPicker .colorSquare{
		width:10px;
		height:10px;
		margin-left:1px;
		margin-bottom:1px;
		float:left;
		border:1px solid #000;
		cursor:pointer;
		
		width: 12px;	/* IE 5.x */
		width/* */:/**/10px;	/* Other browsers */
		width: /**/10px;			
	}
	
	.colorPickerTab_inactive,.colorPickerTab_active{
	
		height:17px;
		padding-left:4px;
		cursor:pointer;	
		
		
	}
	.colorPickerTab_inactive span{
		background-image:url('images/tab_left_inactive.gif');
	}
	
	.colorPickerTab_active span{
		background-image:url('images/tab_left_active.gif');

	}
	.colorPickerTab_inactive span, .colorPickerTab_active span{
		line-height:16px;
		font-weight:bold;
		font-family:arial;
		font-size:11px;
		padding-top:1px;
		vertical-align:middle;
		background-position:top left;
		background-repeat: no-repeat;	
		float:left;
		padding-left:6px;
		-moz-user-select:no;
	}	
	.colorPickerTab_inactive img,.colorPickerTab_active img{
		float:left;
	}
	.colorPickerCloseButton{
		text-align:center;
		line-height:11px;
		border:1px solid #317082;
		position:absolute;
		right:1px;
		font-size:12px;
		font-weight:bold;
		top:1px;
		padding:1px;
		cursor:pointer;	
		
		width: 13px;	/* IE 5.x */
		width/* */:/**/11px;	/* Other browsers */
		width: /**/11px;
		
		height: 13px;	/* IE 5.x */
		height/* */:/**/11px;	/* Other browsers */
		height: /**/11px;	
				
		
	}
	#colorPicker_statusBarTxt{
		font-size:11px;
		font-family:arial;
		vertical-align:top;
		line-height:13px;

	}
	form{
		padding-left:5px;
	}
	</style>
	<script type="text/javascript">
	/************************************************************************************************************
	(C) www.dhtmlgoodies.com, October 2005
	
	This is a script from www.dhtmlgoodies.com. You will find this and a lot of other scripts at our website.	
	
	Terms of use:
	You are free to use this script as long as the copyright message is kept intact. However, you may not
	redistribute, sell or repost it without our permission.
	
	Thank you!
	
	www.dhtmlgoodies.com
	Alf Magne Kalleland
	
	************************************************************************************************************/	

	var MSIE = navigator.userAgent.indexOf('MSIE')>=0?true:false;
	var navigatorVersion = navigator.appVersion.replace(/.*?MSIE (\d\.\d).*/g,'$1')/1;
		
	var namedColors = new Array('AliceBlue','AntiqueWhite','Aqua','Aquamarine','Azure','Beige','Bisque','Black','BlanchedAlmond','Blue','BlueViolet','Brown',
	'BurlyWood','CadetBlue','Chartreuse','Chocolate','Coral','CornflowerBlue','Cornsilk','Crimson','Cyan','DarkBlue','DarkCyan','DarkGoldenRod','DarkGray',
	'DarkGreen','DarkKhaki','DarkMagenta','DarkOliveGreen','Darkorange','DarkOrchid','DarkRed','DarkSalmon','DarkSeaGreen','DarkSlateBlue','DarkSlateGray',
	'DarkTurquoise','DarkViolet','DeepPink','DeepSkyBlue','DimGray','DodgerBlue','Feldspar','FireBrick','FloralWhite','ForestGreen','Fuchsia','Gainsboro',
	'GhostWhite','Gold','GoldenRod','Gray','Green','GreenYellow','HoneyDew','HotPink','IndianRed','Indigo','Ivory','Khaki','Lavender','LavenderBlush',
	'LawnGreen','LemonChiffon','LightBlue','LightCoral','LightCyan','LightGoldenRodYellow','LightGrey','LightGreen','LightPink','LightSalmon','LightSeaGreen',
	'LightSkyBlue','LightSlateBlue','LightSlateGray','LightSteelBlue','LightYellow','Lime','LimeGreen','Linen','Magenta','Maroon','MediumAquaMarine',
	'MediumBlue','MediumOrchid','MediumPurple','MediumSeaGreen','MediumSlateBlue','MediumSpringGreen','MediumTurquoise','MediumVioletRed','MidnightBlue',
	'MintCream','MistyRose','Moccasin','NavajoWhite','Navy','OldLace','Olive','OliveDrab','Orange','OrangeRed','Orchid','PaleGoldenRod','PaleGreen',
	'PaleTurquoise','PaleVioletRed','PapayaWhip','PeachPuff','Peru','Pink','Plum','PowderBlue','Purple','Red','RosyBrown','RoyalBlue','SaddleBrown',
	'Salmon','SandyBrown','SeaGreen','SeaShell','Sienna','Silver','SkyBlue','SlateBlue','SlateGray','Snow','SpringGreen','SteelBlue','Tan','Teal','Thistle',
	'Tomato','Turquoise','Violet','VioletRed','Wheat','White','WhiteSmoke','Yellow','YellowGreen');
	
	 var namedColorRGB = new Array('#F0F8FF','#FAEBD7','#00FFFF','#7FFFD4','#F0FFFF','#F5F5DC','#FFE4C4','#000000','#FFEBCD','#0000FF','#8A2BE2','#A52A2A','#DEB887',
	'#5F9EA0','#7FFF00','#D2691E','#FF7F50','#6495ED','#FFF8DC','#DC143C','#00FFFF','#00008B','#008B8B','#B8860B','#A9A9A9','#006400','#BDB76B','#8B008B',
	'#556B2F','#FF8C00','#9932CC','#8B0000','#E9967A','#8FBC8F','#483D8B','#2F4F4F','#00CED1','#9400D3','#FF1493','#00BFFF','#696969','#1E90FF','#D19275',
	'#B22222','#FFFAF0','#228B22','#FF00FF','#DCDCDC','#F8F8FF','#FFD700','#DAA520','#808080','#008000','#ADFF2F','#F0FFF0','#FF69B4','#CD5C5C','#4B0082',
	'#FFFFF0','#F0E68C','#E6E6FA','#FFF0F5','#7CFC00','#FFFACD','#ADD8E6','#F08080','#E0FFFF','#FAFAD2','#D3D3D3','#90EE90','#FFB6C1','#FFA07A','#20B2AA',
	'#87CEFA','#8470FF','#778899','#B0C4DE','#FFFFE0','#00FF00','#32CD32','#FAF0E6','#FF00FF','#800000','#66CDAA','#0000CD','#BA55D3','#9370D8','#3CB371',
	'#7B68EE','#00FA9A','#48D1CC','#C71585','#191970','#F5FFFA','#FFE4E1','#FFE4B5','#FFDEAD','#000080','#FDF5E6','#808000','#6B8E23','#FFA500','#FF4500',
	'#DA70D6','#EEE8AA','#98FB98','#AFEEEE','#D87093','#FFEFD5','#FFDAB9','#CD853F','#FFC0CB','#DDA0DD','#B0E0E6','#800080','#FF0000','#BC8F8F','#4169E1',
	'#8B4513','#FA8072','#F4A460','#2E8B57','#FFF5EE','#A0522D','#C0C0C0','#87CEEB','#6A5ACD','#708090','#FFFAFA','#00FF7F','#4682B4','#D2B48C','#008080',
	'#D8BFD8','#FF6347','#40E0D0','#EE82EE','#D02090','#F5DEB3','#FFFFFF','#F5F5F5','#FFFF00','#9ACD32');	
	
	
	var color_picker_div = false;
	var color_picker_active_tab = false;
	var color_picker_form_field = false;
	var color_picker_active_input = false;
	function baseConverter (number,ob,nb) {
		number = number + "";
		number = number.toUpperCase();
		var list = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		var dec = 0;
		for (var i = 0; i <=  number.length; i++) {
			dec += (list.indexOf(number.charAt(i))) * (Math.pow(ob , (number.length - i - 1)));
		}
		number = "";
		var magnitude = Math.floor((Math.log(dec))/(Math.log(nb)));
		for (var i = magnitude; i >= 0; i--) {
			var amount = Math.floor(dec/Math.pow(nb,i));
			number = number + list.charAt(amount); 
			dec -= amount*(Math.pow(nb,i));
		}
		if(number.length==0)number=0;
		return number;
	}
	
	function colorPickerGetTopPos(inputObj)
	{
		
	  var returnValue = inputObj.offsetTop;
	  while((inputObj = inputObj.offsetParent) != null){
	  	returnValue += inputObj.offsetTop;
	  }
	  return returnValue;
	}
	
	function colorPickerGetLeftPos(inputObj)
	{
	  var returnValue = inputObj.offsetLeft;
	  while((inputObj = inputObj.offsetParent) != null)returnValue += inputObj.offsetLeft;
	  return returnValue;
	}
	
	function cancelColorPickerEvent(){
		return false;
	}
	
	function showHideColorOptions()
	{
		var parentNode = this.parentNode;
		var subDiv = parentNode.getElementsByTagName('DIV')[0];
		counter=0;		
		var contentDiv = document.getElementById('color_picker_content').getElementsByTagName('DIV')[0];
		do{			
			if(subDiv.tagName=='DIV' && subDiv.className!='colorPickerCloseButton'){
				if(subDiv==this){
					this.className='colorPickerTab_active';
					this.style.zIndex = 50;
					var img = this.getElementsByTagName('IMG')[0];
					img.src = "images/tab_right_active.gif"
					img.src = img.src.replace(/inactive/,'active');							
					contentDiv.style.display='block';
					self.status = counter;					
				}else{
					subDiv.className = 'colorPickerTab_inactive';	
					var img = subDiv.getElementsByTagName('IMG')[0];
					img.src = "images/tab_right_inactive.gif"
					self.status = img.src;
					subDiv.style.zIndex = 10 - counter;
					contentDiv.style.display='none';
				}
				counter++;
			}
			subDiv = subDiv.nextSibling;
			contentDiv = contentDiv.nextSibling;
		}while(subDiv);
		
		document.getElementById('colorPicker_statusBarTxt').innerHTML = ' ';


	}
	
	function createColorPickerTopRow(inputObj){
		var tabs = ['RGB','Named colors'];
		var tabWidths = [37,90,70];
		var div = document.createElement('DIV');
		div.className='colorPicker_topRow';
	
		inputObj.appendChild(div);	
		var currentWidth = 0;
		for(var no=0;no<tabs.length;no++){			
			
			var tabDiv = document.createElement('DIV');
			tabDiv.onselectstart = cancelColorPickerEvent;
			tabDiv.ondragstart = cancelColorPickerEvent;
			if(no==0){
				suffix = 'active'; 
				color_picker_active_tab = this;
			}else suffix = 'inactive';
			
			tabDiv.id = 'colorPickerTab' + no;
			tabDiv.onclick = showHideColorOptions;
			if(no==0)tabDiv.style.zIndex = 50; else tabDiv.style.zIndex = 1 + (tabs.length-no);
			tabDiv.style.left = currentWidth + 'px';
			tabDiv.style.position = 'absolute';
			tabDiv.className='colorPickerTab_' + suffix;
			var tabSpan = document.createElement('SPAN');
			tabSpan.innerHTML = tabs[no];
			tabDiv.appendChild(tabSpan);
			var tabImg = document.createElement('IMG');
			tabImg.src = "images/tab_right_" + suffix + ".gif";
			tabDiv.appendChild(tabImg);
			if(navigatorVersion<6 && MSIE){	/* Lower IE version fix */
				tabSpan.style.position = 'relative';
				tabImg.style.position = 'relative';
				tabImg.style.left = '-3px';		
				tabDiv.style.cursor = 'hand';	
			}			
			div.appendChild(tabDiv);
			currentWidth = currentWidth + tabWidths[no];
		
		}
		
		var closeButton = document.createElement('DIV');
		closeButton.className='colorPickerCloseButton';
		closeButton.innerHTML = 'x';
		closeButton.onclick = closeColorPicker;
		closeButton.onmouseover = toggleCloseButton;
		closeButton.onmouseout = toggleOffCloseButton;
		div.appendChild(closeButton);
		
	}
	
	function toggleCloseButton()
	{
		this.style.color='#FFF';
		this.style.backgroundColor = '#317082';	
	}
	function toggleOffCloseButton()
	{
		this.style.color='';
		this.style.backgroundColor = '';			
		
	}
	function closeColorPicker()
	{
		color_picker_div.style.display='none';
	}
	function createWebColors(inputObj){
		var webColorDiv = document.createElement('DIV');
		inputObj.appendChild(webColorDiv);
		for(var r=15;r>=0;r-=3){
			for(var g=0;g<=15;g+=3){
				for(var b=0;b<=15;b+=3){
					var red = baseConverter(r,10,16) + '';
					var green = baseConverter(g,10,16) + '';
					var blue = baseConverter(b,10,16) + '';
					
					var color = '#' + red + red + green + green + blue + blue;
					var div = document.createElement('DIV');
					div.style.backgroundColor=color;
					div.innerHTML = '<span></span>';
					div.className='colorSquare';
					div.title = color;	
					div.onclick = chooseColor;
					div.setAttribute('rgbColor',color);
					div.onmouseover = colorPickerShowStatusBarText;
					div.onmouseout = colorPickerHideStatusBarText;
					webColorDiv.appendChild(div);
				}
			}
		}
	}
		
	function createNamedColors(inputObj){
		var namedColorDiv = document.createElement('DIV');
		namedColorDiv.style.display='none';
		inputObj.appendChild(namedColorDiv);
		for(var no=0;no<namedColors.length;no++){
			var color = namedColorRGB[no];
			var div = document.createElement('DIV');
			div.style.backgroundColor=color;
			div.innerHTML = '<span></span>';
			div.className='colorSquare';
			div.title = namedColors[no];	
			div.onclick = chooseColor;
			div.onmouseover = colorPickerShowStatusBarText;
			div.onmouseout = colorPickerHideStatusBarText;
			div.setAttribute('rgbColor',color);
			namedColorDiv.appendChild(div);				
		}		
	}
	
	function colorPickerHideStatusBarText()
	{
		document.getElementById('colorPicker_statusBarTxt').innerHTML = ' ';
	}
	
	function colorPickerShowStatusBarText()
	{
		var txt = this.getAttribute('rgbColor');
		if(this.title.indexOf('#')<0)txt = txt + " (" + this.title + ")";
		document.getElementById('colorPicker_statusBarTxt').innerHTML = txt;	
	}
	
	function createAllColorDiv(inputObj){
		var namedColorDiv = document.createElement('DIV');
		namedColorDiv.style.display='none';
		inputObj.appendChild(namedColorDiv);	
	}
	
	function chooseColor()
	{
		color_picker_form_field.value = this.getAttribute('rgbColor');
		color_picker_div.style.display='none';
	}
	
	function createStatusBar(inputObj)
	{
		var div = document.createElement('DIV');
		div.className='colorPicker_statusBar';	
		var innerSpan = document.createElement('SPAN');
		innerSpan.id = 'colorPicker_statusBarTxt';
		div.appendChild(innerSpan);
		inputObj.appendChild(div);
	}
	
	function showColorPicker(inputObj,formField)
	{
		if(!color_picker_div){
			color_picker_div = document.createElement('DIV');
			color_picker_div.id = 'dhtmlgoodies_colorPicker';
			color_picker_div.style.display='none';
			createColorPickerTopRow(color_picker_div);
			
			var contentDiv = document.createElement('DIV');
			contentDiv.id = 'color_picker_content';
			color_picker_div.appendChild(contentDiv);
			
			createWebColors(contentDiv);
			createNamedColors(contentDiv);
			createAllColorDiv(contentDiv);
			createStatusBar(color_picker_div);
			document.body.appendChild(color_picker_div);
		}		
		if(color_picker_div.style.display=='none' || color_picker_active_input!=inputObj)color_picker_div.style.display='block'; else color_picker_div.style.display='none';		
		color_picker_div.style.left = colorPickerGetLeftPos(inputObj) + 'px';
		color_picker_div.style.top = colorPickerGetTopPos(inputObj) + inputObj.offsetHeight + 2 + 'px';
		color_picker_form_field = formField;
		color_picker_active_input = inputObj;
	}
	
	</script>

</head>

<body style="margin:2px;">

<TABLE class="borderTRL" cellSpacing="0" cellPadding="0" width="100%" border="0" style="background:url(images/headerbk.gif)">
    <TR>
	    <TD style=" height:100px; background:url(images/logomain.gif) right no-repeat;">
        	<span style="color:#FFFFFF; font-family:Trebuchet MS; font-size:24px; font-weight:bold;">
				<?php
                $cdata=mysql_fetch_array(mysql_query("select * from cname"));
				echo $cdata['aname'];
				?> 
			</span>
        </TD>
    </TR>
    <TR><TD><?php echo "NAME: ".$_SESSION['user_name']." #USER ID: ".$_SESSION['user_id']; ?></TD></TR>
</TABLE>
		  
<table align="center" width="100%" class="borderall">
    <tr>
        <td align="left" width="18%" valign="top" class="borderR" style="background:#589EE2;">
        <?php 
        require_once "menu.php";
        ?>
        </td>
		<td align="center" width="80%" valign="top" height="420">
			<div style="margin:10px; margin-top:20px;">
