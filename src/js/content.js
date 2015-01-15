/* 
functions:

	setOpacity(objID, value)  
		  Set the opacity of the document object with the id, objID to value.
		  
	fadeIn(objID, maxOpacity, fadeTime, delay)
		  Fades in an object with the id, objID up to a maximum opacity of 
		  maxOpacity over an interval of fadeTime seconds with a delay of
		  delay seconds.

	fadeOut(objID, maxOpacity, fadeTime, delay)
	  Fades out an object with the id, objID from a maximum opacity of 
	  maxOpacity down to 0 over an interval of fadeTime seconds with a 
	  delay of delay seconds.
	
	addEvent(object, evName, fnName, cap)
		add a event named evName to object in capturing way, execute function fnName.
		
	removeEvent(object, evName, fnName, cap)
	
	getStyle(object, styleName)
*/  
addEvent(window, "load", init, false);

var menuItems = new Array();	//menu items
var sections = new Array();   
var pages = new Array();  		//pages for different languages 
var mouseMenu = null;			//the menu item that the mouse clicks on
var index = "";
var prevMenu = 0; 				//attribute 'id' of the menu item clicked last time

var menuNav = new Array();		//menu page, category nav items
var ptCate = null;				//the category that the mouse clicks on
var prevCate = null;			//the category selected last time

var overlay = null;				//object of div id='page_overlay'
var detailBox = null;			//popup div for displaying detailed dish info
var clsoeBtn = null;			//close button on detail div
var dishPics = new Array();		//dish thumbnail pictures in 'menu' div
var content_id = null;			//
//initialize to show home section and hide all other sections
function init(){
	var searchString = location.search.slice(1);
	var formString = searchString.replace(/\+/g," ");
	var dataString = unescape(formString);
	data = dataString.split(/[&=]/g);
	
	//console.log("length="+data.length);
	//Finding the value of content_id from url array
	for(var i=0; i<data.length; i+=2){
		if(data[i]=="content_id")
			content_id = data[i+1];
	}		
	
	
	backToTop();	//When scroll far, appears an icon being used to go back to top.
	
	var allElem = document.getElementsByTagName("*");
	
	for(var i = 0; i < allElem.length; i++){
		if(allElem[i].className == "content"){
			sections.push(allElem[i]);
			var idx = allElem[i].id;
			menuItems.push(document.getElementById(idx.substring(8,idx.length)));  //cut 'content_' to get menu item id
		}
	}
	
	//console.log(content_id);
	if (!content_id)  {content_id ="content_home";}
	//console.log(content_id);
	
	for(var i = 0; i < menuItems.length; i++){
		
		if(sections[i].id == content_id){
			sections[i].style.display="block";
			prevMenu = menuItems[i].id;				//home item
			menuItems[i].className = "on";
			//menuItems[i].style.color = "white";
			//mouseMenu = menuItems[i];
		}else{
			sections[i].style.display="none";
			menuItems[i].className = "";
		}
		addEvent(menuItems[i], "click", changeShowDiv, false);
	}
	
	initMenuNav(); 	//find menu category lists and add onclick events
	//register onclick function to send email	
	registerListener();
	
	
	overlay = document.getElementById("page_overlay");
	detailBox = document.getElementById("popup");
	overlay.style.display = "none";
	detailBox.style.display = "none";
	closeBtn = document.getElementById("close");
	addEvent(closeBtn, "click", closeDetail, false);
	
	/* var pic_container = document.getElementById("iframeId");
	var innerDoc = pic_container.contentDocument || pic_container.contentWindow.document;
	allElem = innerDoc.getElementsByTagName("div"); */
	
	for(var i = 0; i < allElem.length; i++){
		if(allElem[i].className == "pic"){
			dishPics.push(allElem[i]);
		}	
	}
	
	for(var i = 0; i < dishPics.length; i++){
		addEvent(dishPics[i], "click", showDetail, false);
	}
		
	addEvent(closeBtn, "click", closeDetail, false); //when click on close button, close popup page
	addEvent(overlay, "click", closeDetail, false); //when click on overlay area, close popup page
	
}

//click on items on the header bar, switch page content accordingly:
function changeShowDiv(e){
	var evt = e || window.event;
	mouseMenu = evt.target || evt.srcElement;
	var itemClicked=null;
	
	if (mouseMenu.id=="logo_img"){
		itemClicked ="home";
	}else{
		itemClicked = mouseMenu.id;
	}
	//evt.stopPropagation();  //stop bubbling
	//evt.preventDefault();   //prevent default event for tag 'a'
	
	if (prevMenu == itemClicked){
		return;
	}
	else{
		prevMenu = itemClicked;
	}
	index = "content_" + itemClicked;
	for(var i = 0; i < sections.length; i++){
		if(sections[i].style.display == "block"){
				$(sections[i]).fadeOut();
				sections[i].style.display="none";
				menuItems[i].className = "";
		}else{
			if(sections[i].id == index){			
				$(sections[i]).fadeIn(500);
				sections[i].style.display="block";
				menuItems[i].className = "on";
				if(index=="content_contact"){
					initMap();
				}
			}
		}
	}
}

function addEvent(object, evName, fnName, cap){
	if(object.attachEvent)
		object.attachEvent("on" + evName , fnName);
	else if (object.addEventListener)
		object.addEventListener(evName, fnName, cap);
}

function removeEvent(object, evName, fnName, cap) {
	if (object.detachEvent)
		object.detachEvent("on" + evName, fnName);
	else if (object.removeEventListener)
		object.removeEventListener(evName, fnName, cap);
}

function getStyle(object, styleName) {
   if (window.getComputedStyle) {
      return document.defaultView.getComputedStyle(object, null).getPropertyValue(styleName);
   } else if (object.currentStyle) {
      return object.currentStyle[styleName]
   }
}

/* load google map */
function initMap(){
	var myCenter=new google.maps.LatLng(45.498620,-73.626997);
	var mapProp = {
    	      center:myCenter,
    	      zoom:15,
    	      mapTypeId:google.maps.MapTypeId.ROADMAP
  	  };

  	var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
  	var marker=new google.maps.Marker({
  		position:myCenter,
  		animation:google.maps.Animation.BOUNCE
  	});
  	marker.setMap(map);
}

//find menu category lists and add onclick events
function initMenuNav(){
	var ulobj = document.getElementById("category");
	if(ulobj){
		menuNav = ulobj.getElementsByTagName("li");
		prevCate = menuNav[0];
		for(var i = 0; i < menuNav.length; i++){
			addEvent(menuNav[i],"click",switchOn, false);
		}
	}
}

//change the class name of the clicked item to 'on', while others to ''
function switchOn(e){
	var evt = e || window.event;
	ptCate = evt.target || evt.srcElement;
	
	if (prevCate == ptCate){
		return;
	}
	else{
		prevCate.className = "";
		ptCate.className = "on";
		prevCate = ptCate;
	}
}

function registerListener(){
	var emailBtnId = document.getElementById('emailBtnId');
	addEvent(emailBtnId,"click",sendEmail,false);
	//alert("111");
}

function sendEmail(){
	var commentForm=document.getElementById('commnetFormId');
	commentForm.action='./include/sendMail.php';
	commentForm.submit();
}	

function showDetail() {
	// Change the image based on dish_id
	//changeSlide(this);
	
	// Reveal the slide show
	setOpacity("popup", 0);
	setOpacity("page_overlay", 0);
	var objBody = document.getElementsByTagName("body");
	objBody[0].style.overflow = "hidden";
	detailBox.style.display = "block";
	overlay.style.display = "block";
	fadeIn("popup", 100, 0.5, 0);
	fadeIn("page_overlay", 80, 0.5, 0);
	
	// Halt propagation of the click event
	return false;
}

//close detailed dish info div and page overlay div
function closeDetail(){
	fadeOut("popup", 100, 0.5, 0);
	fadeOut("page_overlay", 80, 0.5, 0);
	setTimeout(function() {
		detailBox.style.display = "none";
		overlay.style.display = "none";
		}, 500);
	var objBody = document.getElementsByTagName("body");
	objBody[0].style.overflow = "auto";
}

function setOpacity(objID, value) {
	var object = document.getElementById(objID);
	// Apply the opacity value for IE and non-IE browsers
	object.style.filter = "alpha(opacity = " + value + ")";
	object.style.opacity = value/100;
}

function fadeIn(objID, maxOpacity, fadeTime, delay) {
	// Calculate the interval between opacity changes
	var fadeInt = Math.round(fadeTime*1000)/maxOpacity;
	// Loop up the range of opacity values
	for (var i = 0; i <= maxOpacity; i++) {
		setTimeout("setOpacity('" + objID + "', " + i + ")", delay);
		delay += fadeInt;
	}
}

function fadeOut(objID, maxOpacity, fadeTime, delay) {
	// Calculate the interval between opacity changes
	var fadeOut = Math.round(fadeTime*1000)/maxOpacity;
	// Loop down the range of opacity values
	for (var i = maxOpacity; i >= 0; i--) {
		setTimeout("setOpacity('" + objID + "', " + i + ")", delay);
		delay += fadeOut;
	}
}

function backToTop(){
	var obtn = document.getElementById("back-to-top");
	var timer = null;
	var isTop = true;
	//获取页面可视区的高度
	var clientHeight = document.documentElement.clientHeight;
	
	window.onscroll = function(){
		var osTop = document.documentElement.scrollTop || document.body.scrollTop;
		if(osTop >= clientHeight){
			obtn.style.display = "block";
		}else{
			obtn.style.display = "none";
		}
		
		if (!isTop){
			clearInterval(timer);
		}
		isTop = false;
	}
	
	obtn.onclick = function(){
		//设置定时器
		timer = setInterval(function(){
			//获取滚动条距离顶部的高度， IE || Chrome兼容
			var osTop = document.documentElement.scrollTop || document.body.scrollTop;
			ispeed = Math.ceil(osTop/6);
			document.documentElement.scrollTop -= ispeed;
			document.body.scrollTop -= ispeed;
			
			//console.log(osTop-ispeed);
			
			isTop = true;
			
			if(osTop == 0){
				clearInterval(timer);
			}
		},30);
	}
}

function cate_clicked(cat_id){
	var category="";
	
	if(cat_id)
		category = "&cate_id="+ cat_id ;
	
//	window.location= "./include/dishGallery.php?content_id=content_menu"+category;
//	target="mainFrame";
	window.open("./include/dishGallery.php?content_id=content_menu"+category,'mainFrame');
	
}
