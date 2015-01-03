var PreColor = null;

Date.prototype.format = function(format) {
	var o = {
		"M+" : this.getMonth() + 1, // month
		"d+" : this.getDate(), // day
		"h+" : this.getHours(), // hour
		"m+" : this.getMinutes(), // minute
		"s+" : this.getSeconds(), // second
		"q+" : Math.floor((this.getMonth() + 3) / 3), // quarter
		"S" : this.getMilliseconds()
	// millisecond
	};

	if (/(y+)/.test(format)) {
		format = format.replace(RegExp.$1, (this.getFullYear() + "")
				.substr(4 - RegExp.$1.length));
	}

	for ( var k in o) {
		if (new RegExp("(" + k + ")").test(format)) {
			format = format.replace(RegExp.$1, RegExp.$1.length == 1 ? o[k]
					: ("00" + o[k]).substr(("" + o[k]).length));
		}
	}

	return format;
};

var searchString = location.search.slice(1);
var formString = searchString.replace(/\+/g, " ");
var dataString = unescape(formString);
var data = dataString.split(/[&=]/g);

function loadUserInfo() {
	$.post("../QueryUserInfoServlet", {
		userid : data[1]
	}, function(data) {
		var result = null;
		var lastname = null;
		var firstname = null;
		var RoleName = null;
		x = data.getElementsByTagName("userquery");
		for (var i = 0; i < x.length; i++) {
			xx = x[i].getElementsByTagName("result");
			result = xx[0].firstChild.nodeValue;
			xx = x[i].getElementsByTagName("lastname");
			lastname = xx[0].firstChild.nodeValue;
			xx = x[i].getElementsByTagName("firstname");
			firstname = xx[0].firstChild.nodeValue;
			xx = x[i].getElementsByTagName("rolename");
			RoleName = xx[0].firstChild.nodeValue;
		}
		if (result == "Success") {
			document.getElementById("username").value = firstname + " "
					+ lastname;
			document.getElementById("role").value = RoleName;
			var myDate = new Date();
			document.getElementById("currdate").value = myDate
					.format("MM/dd, yyyy");
		}
	}, "xml");
}

function generateSelect(url,params,nodeid)
{
	if (window.XMLHttpRequest) 
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} 
	else 
	{// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.onreadystatechange = function() 
	{
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
		{
			x = xmlhttp.responseXML.getElementsByTagName("RD");
			txt = "";
			var id;
			var name;
			for (var i = 0; i < x.length; i++) 
			{			
				xx = x[i].getElementsByTagName("id");
				id = xx[0].firstChild.nodeValue;				
				xx = x[i].getElementsByTagName("name");
				name = xx[0].firstChild.nodeValue;
				{
					try
					{						
						txt = txt + "<option value='"+ id + "'>" + name + "</option>";
					}
			        catch (er)
					{
			        	txt = txt + "<option> </option>";
					}					
				}
			}
			//console.log("nodeid="+nodeid);			
			document.getElementById(nodeid).innerHTML=txt;								
		}
	};
	
	xmlhttp.open("POST", url, false);
	//xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded;charset=UTF-8");
	xmlhttp.setRequestHeader("Content-type",
			"application/x-www-form-urlencoded");
	//xmlhttp.setRequestHeader("Content-length", params.length);
	//xmlhttp.setRequestHeader("Connection", "close");
	
	xmlhttp.send(params);	
}

function over()
{
	var oObj = window.event.srcElement;
	
	if(oObj.tagName.toLowerCase() == "td")
	{   	
		//change the color of the line that was selected.
		var oTr = oObj.parentNode; 
		PreColor = oTr.style.backgroundColor;			//store current line's background color before it is changed
		oTr.style.backgroundColor = "#F6CEF5";  
	}

}

function out()
{	
	var oObj = window.event.srcElement;
	
	if(oObj.tagName.toLowerCase() == "td")
	{   	
		//change the color of the line that was selected.
		var oTr = oObj.parentNode; 		
		oTr.style.backgroundColor = PreColor;  			//restore the color of the line to the default
	}	
}


