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

//initialize to show home section and hide all other sections
function init(){
	var allElem = document.getElementsByTagName("*");
	
	for(var i = 0; i < allElem.length; i++){
		if(allElem[i].className == "content"){
			sections.push(allElem[i]);
			var idx = allElem[i].id;
			menuItems.push(document.getElementById(idx.substring(8,idx.length)));  //cut 'content_' to get menu item id
		}
	}
	
	for(var i = 0; i < menuItems.length; i++){
		
		if(sections[i].id == "content_home"){
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
}

//click on items on the header bar, switch page content accordingly:
function changeShowDiv(e){
	var evt = e || window.event;
	mouseMenu = evt.target || evt.srcElement;
	
	//evt.stopPropagation();  //stop bubbling
	//evt.preventDefault();   //prevent default event for tag 'a'
	if (prevMenu == mouseMenu.id){
		return;
	}
	else{
		prevMenu = mouseMenu.id;
	}
	index = "content_" + mouseMenu.id;
	for(var i = 0; i < sections.length; i++){
		if(sections[i].style.display == "block"){
				$(sections[i]).fadeOut();
				sections[i].style.display="none";
				//menuItems[i].style.color = "#d9b181";
				menuItems[i].className = "";
		}else{
			if(sections[i].id == index){
				$(sections[i]).fadeIn(1500);
				sections[i].style.display="block";
				menuItems[i].className = "on";
				//menuItems[i].style.color = "white";
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
	var myCenter=new google.maps.LatLng(45.4997032,-73.6251816);
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
