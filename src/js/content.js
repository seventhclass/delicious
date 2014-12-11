addEvent(window, "load", init, false);

var menuItems = new Array();	//menu items
var sections = new Array();   
var pages = new Array();  		//pages for different languages 
var mouseMenu = null;			//the menu item that the mouse clicks on
var index = "";
var prev = 0; 					//used to remember the menu item clicked last time

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
			sections[i].style.display="block";} 
			
		else{
			sections[i].style.display="none";}
		addEvent(menuItems[i], "click", changeShowDiv, false);
	}
}

function changeShowDiv(e){
	var evt = e || window.event;
	mouseMenu = evt.target || evt.srcElement;
	
	//evt.stopPropagation();  //stop bubbling
	//evt.preventDefault();   //prevent default event for tag 'a'
	if (prev == mouseMenu.id){
		return;
	}
	else{
		prev = mouseMenu.id;
	}
	index = "content_" + mouseMenu.id;
	for(var i = 0; i < sections.length; i++){
		if(sections[i].style.display == "block"){
				$(sections[i]).fadeOut();
				sections[i].style.display="none";
		}else{
			if(sections[i].id == index){
				$(sections[i]).fadeIn(1500);
				sections[i].style.display="block";
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
	var myCenter=new google.maps.LatLng(45.4853106,-73.6273434);
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

