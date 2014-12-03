/* window.onload = init; */
addEvent(window, "load", init, false);

var menuItems = new Array();	/*menu items*/
var sections = new Array();   
var pages = new Array();  		/*pages for different languages*/ 
var mouseMenu = null;			/*the menu item that the mouse clicks on */
var index = "";

/*initialize to show home section and hide all other sections*/
function init(){
	var allElem = document.getElementsByTagName("*");
	
	for(var i = 0; i < allElem.length; i++){
		if(allElem[i].className == "content"){
			sections.push(allElem[i]);
			var idx = allElem[i].id;
			menuItems.push(document.getElementById(idx.substring(8,idx.length)));  /*cut 'content_' to get menu item id*/
		}
	}
	
	for(var i = 0; i < menuItems.length; i++){
		/* sections[i].style.display = getStyle(sections[i],"display"); */
		
		if(sections[i].id == "content_home") 
			sections[i].style.display="block";
		else
			sections[i].style.display="none";
			
		
		/* addEvent(menuItems[i], "mousedown", changeShowDiv, false);*/
		removeEvent(menuItems[i], "mouseup", changeShowDiv, false); 
		/* sections[i].style.display="none"; 
		menuItems[i].onclick = changeShowDiv;*/
	}
}

function changeShowDiv(e){
	var evt = e || window.event;
	mouseMenu = evt.target || evt.srcElement;
	index = "content_" + mouseMenu.id;
	
	for(var i = 0; i < sections.length; i++){
		/* alert(sections[i].id +","+ sections[i].style.display); */
		sections[i].style.display="none";
		/* alert(sections[i].id +","+ sections[i].style.display); */
	}
	
	for(var i = 0; i < sections.length; i++){
		if(sections[i].id == index){
		
			alert(sections[i].id+".display="+sections[i].style.display);  /* debug */
			
			sections[i].style.display="block";
			alert(sections[i].id+".display="+sections[i].style.display);  /* debug */
			
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