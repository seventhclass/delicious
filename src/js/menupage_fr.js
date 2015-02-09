var min_height=0;		//height of the category is the minimum height for #content_menu
var diff_height = 0;	//#content_menu.height - #gallery.height

$(document).ready(function (){
//$(window).ready(function (){
	$('#category tr:last-child td').css("border-bottom","0");  //remove the bottom border of the last category list item. 
	//get the height of the category area, as minimum height of #content_menu
	$("td").each(function(){
		min_height += $("td").height()+parseInt($("td").css("margin-top"))+parseInt($("td").css("margin-bottom"))
				+parseInt($("td").css("padding-top"))+parseInt($("td").css("padding-bottom"))
				+parseInt($("td").css("border-top"))+parseInt($("td").css("border-bottom"));
		
	})
	min_height -= 1;	//remove the border-bottom height of the last td
	
	$('#content_menu').css("min-height",min_height+"px");//set the minimum height of the menu page content div, 
	diff_height =  parseInt($('#gallery').css("margin-top")) + parseInt($('#gallery').css("margin-bottom"))
					+ parseInt($('#gallery').css("border-top"))+ parseInt($('#gallery').css("border-bottom"))
					+ parseInt($('#gallery').css("padding-top"))+ parseInt($('#gallery').css("padding-bottom"));
	$('#gallery').css("min-height",(min_height - diff_height)+"px");	//set the minimum height of the gallery div, gallery's padding top + bottom = 60
	
	$('#content_menu').css("height",$('#gallery').height+diff_height);

	var jWindow = $(window);
	//initialize
	/*$('#categorybox').css({
		'position':'relative',
		'top':'0',
		'left':'0'
	});	
	
	var cate_left = $('.cat_sidebar').offset().left;
	console.log ('cate_left='+cate_left);*/
	
	jWindow.scroll(function(){
		var cate_left = $('#categorybox').offset().left;
		var gal_left = $('#gallery').offset().left;
		var scrollHeight = jWindow.scrollTop();					
		var screenHeight = jWindow.height();
		var cateboxHeight = $('#categorybox').height();
		var galleryHeight = $('#gallery').height();
		
		//console.log ('cate_left='+cate_left);
		
		//alert("scrollHeight="+scrollHeight);
		//alert("cateboxHeight="+cateboxHeight);
		//alert("galleryHeight="+galleryHeight);
		
/*		if(cateboxHeight>(galleryHeight+60)){
			$('.cat_sidebar').css({
				'position':'relative',
				'top':'0',
				'left':'0'
			});											
			
			if(scrollHeight+screenHeight-50>(galleryHeight+60)){
				$('#gallery').css({
					'position':'fixed',
					'top':-(galleryHeight+60-screenHeight),
					'right':69
					left:gal_left+'px'
				});				
			}
			else{
				$('#gallery').css({
					'position':'static'
				});							
			}
			
			if(cateboxHeight-scrollHeight<screenHeight-50){				
				$('#gallery').css({
					'position':'relative',
					'right':0,
					'top':cateboxHeight-(galleryHeight+60)
				});	
			}					
		}else{*/
			if(galleryHeight+60-scrollHeight<cateboxHeight){
				var topVal = (galleryHeight+60-cateboxHeight)+"px";
				$('.cat_sidebar').css({
					'position':'relative',
					'left':'0',
					'top':topVal
				});
				//console.log($('#categorybox').css("top"));
				
			}else{
				$('#categorybox').css({
					'position':'fixed',
					'top':'50px',
					'left':cate_left+'px'
				});
			}
		/*}	*/
			
		if(scrollHeight==0){
			$('#categorybox').css({
				'position':'relative',
				'top':'0',
				'left':'0'
			});
		}
	});	
	
	moveText();
	
	
	$('#category').click(function(e){
		if($(e.target).is('td')){
			var index = $(e.target).attr('id');
			var offset = index * 58 +17 ;
			$('.dot_curr').animate({top:offset},{duration:"slow",easing:"easeOutCubic"});
			getMenuItem(e);
		}
	});
	
	$('#gallery').click(function(e){
		if($(e.target).is('.availablePage')){
			getMenuItem(e);
		}
		if($(e.target).is('img') || $(e.target).is('.info') ){
			getDetailItem(e);
			showDetail();
		}
	});	
	
	$('.dishdetail').click(function(e){
		if($(e.target).is('span')){
			getDetailItem(e);
			showDetail();
		}		
	});
		
	$('#popup_page').click(function(e){
		if($(e.target).is('img')){
			changeDishImage(e);
		}
	});
	
	$('.des_smimg').click(function(e){
		if($(e.target).is('.icon_back')){
			getThumbImages(e,0);
		}	
		if($(e.target).is('.icon_forward')){
			getThumbImages(e,1);
		}			
	});
	
	function getMenuItem(e){
		var page = $(e.target).attr("data-page");
		var cateid = $(e.target).attr("data-cateid");
		//alert("page="+page);
		//alert("cateid="+cateid);
		$.ajax({
			url:'./include/doMenu.php',
			cache:false,
			async: false,
			type:'GET',
			data: {"page":page,"cateid":cateid},
			dataType:'json',
			timeout:5000,
			error: function(xhr){
				alert("Load Page Error!");
			},
			success: function(res){								
//				alert(page);
//				alert(cateid);
//				alert(res.totalPage);
//				alert(res.dishinfo[1].dish_name_cn);
//				alert(res.dishinfo[1].album_path);
				createMenuPage(res);
			}
		});
		$(document).scrollTop(0);	
	}
	
	function getDetailItem(e){
		var dishid = $(e.target).attr("data-dishid");
		$.ajax({
			url:'./include/doDetail.php',
			cache:false,
			async: false,
			type:'GET',
			data: {"do":"third","dish_id":dishid},
			dataType:'json',
			timeout:5000,
			error: function(xhr){
				alert("Load Page Error!");
			},
			success: function(res){								
				//alert(dishid);
				//alert(res.dishinfo.dish_name_cn);
				//alert(res.dishimages[0].album_path);
				//alert(res.cateinfo.cate_name_cn);
				createDetailPage(res);
			}
		});
	}
	
	function createMenuPage(res){
		$('#dishbox').html("");				//clear contents inside #dishbox
		$('#dishbox').nextAll().remove();	//remove all following siblings
		
		if(res.dishinfo && res.dishinfo.length>0){
			$.each(res.dishinfo,function(i, item){
				$('#dishbox').append(
						"<li class='pic'>"
						+ "<img src='./image_350/" + item.album_path + "'" + " alt='" + item.dish_name_fr + "'" + " data-dishid='" + item.dish_id + "' />" 
						+ "<div class='info'" + " data-dishid='" + item.dish_id + "' >" 
						+ "<div class='visible_area'>"
						+ "<span class='left'>" + item.dish_name_fr + "</span>"
						+ "<span class='right'>" + "$&nbsp;" + item.current_price + "</span>"
						+ "</div></div>"
						+ "</li>"
				);
			});
			
			$('#content_menu').css("height",$('#gallery').height+diff_height);
			moveText();
			
			if(res.totalRows>res.pageSize){
				$("<div class='pagebox'>" + res.pageLink + "</div>").insertAfter('#dishbox');								
			}
		}else{
			$("<h4>Désolé, Pas de Plats. </h4>").insertAfter('#dishbox');
		}
		
	}
	
	function createDetailPage(res){
		$('#popup_page').html("");
		if(res.dishinfo && res.dishinfo.dish_id){
			$('#popup_page').append(
				"<div id='dish_pic'>" 
					+ "<div id='pic_large'>"
					+ "</div>"
					+ "<div id='pic_small'>"
					+ "</div>"
				+ "</div>"	
				+ "<div id='dish_text'>"
				+ "</div>"	
				+ "<div id='dish_desc'>"
				+ "</div>"
			);	

			if(res.dishimages && res.dishimages.length>0){
				$('#pic_large').append(
						"<img  id='org_pic' data-path='" + res.dishimages[0].album_path + "' src='./image_800/" + res.dishimages[0].album_path + "'" + " alt='" + res.dishinfo.dish_name_fr + "'  width='460' height='350' style='opacity:1;'>"	
				);
				$('#pic_small').append("<i id='s_back'></i>");
				$.each(res.dishimages,function(i, item){
					if(i<4){
						$('#pic_small').append(
							"<div class='thumb_nail'><img src='./image_50/" + item.album_path + "'" + " alt='" + item.album_path + "' width='64' height='64'" + " ></div>"
						);		
					}
				});
				$('#pic_small').append("<i id='s_forward'></i>");
			}else{
				$('#pic_large').append(
						"<img id='org_pic' width='460' height='350' style='opacity: 1'>"	
				);
				$('#pic_small').append(
					"<i id='s_back'></i>"
					+ "<div class='thumb_nail'><img src='' alt=''></div>"
					+ "<i id='s_forward'></i>"
				);
			}
				
			if(res.dishinfo.is_spicy==1){
				var spicyinfo = "id='is_spicy'";
			}else{
				var spicyinfo = null;
			}
			
			$('#dish_text').append(
				"<h1 style='text-align:center'>" + res.dishinfo.dish_name_fr + "</h1>"
				+ "<ul>"
					+ "<li>"
						+ "<div class='dt'>Plat No:</div>"
						+ "<div class='dd'>" + res.dishinfo.dish_no + "</div>"
					+ "</li>"
					+ "<li>"
						+ "<div class='dt'>Galerie:</div>"
						+ "<div class='dd'>" + res.cateinfo.cate_name_fr + "</div>"
					+ "</li>"
					+ "<li>"
						+ "<div class='dt'>Épicé:</div>"
						+ "<div class='dd' " + spicyinfo + ">"+(!spicyinfo?"Non":"")+"</div>"
					+ "</li>"	
					+ "<li>"
						+ "<div class='dt'>Prix Actuel:</div>"
						+ "<div class='dd' style='color:red' >" + "$" + res.dishinfo.current_price + "</div>"
					+ "</li>"	
					+ "<li>"
						+ "<div class='dt'>Prix Régulier:</div>"
						+ "<div class='dd' ><s>" + "$" + res.dishinfo.reg_price + "</s></div>"
					+ "</li>"					
				+ "</ul>"
			);	
			
			$('#dish_desc').append("<h1>" + res.dishinfo.dish_desc_fr + "</h1>");				
		}else{
			$('#popup_page').append("<h1>Désolé, Pas de Plats. </h1>");
		}			
	}
	
	function changeDishImage(e){
		var prev_pic = $('#org_pic').attr("data-path"); //'xxx.jpg' of the previous image
		var dish_name = $('#org_pic').attr("alt");		//dish name
		var pic_name = $(e.target).attr("alt");			//'xxx.jpg' of the small image being clicked
		
		//if the image clicked is the same as the large one, don't change image
		if (prev_pic == pic_name){
			return;
		}
		$('#pic_large').append(
			"<img class='fake_pic' src='./image_800/" + prev_pic + "'" + " alt='" + dish_name + "'" + " width='460' height='350' style='opacity:1; position:absolute;left:0;top:0;z-index:2;' >"
		);
		$('#org_pic').attr("src","./image_800/"+ pic_name);//change src of the original image tag to new image
		$('#org_pic').attr("data-path", pic_name);//change 'xxx.jpg' of the original image tag to new image
		
		$('.fake_pic').fadeOut(400,function(){
			$('.fake_pic').remove();	//remove the img tag
			$('#org_pic').css("position","static");	//before adding the new img tag, change the position style back
		} );
	}
	
	function getThumbImages(e,ort){
		var data_index = $(e.target).attr("data-index");
		var index = parseInt(data_index);
		var promid = $(e.target).attr("data-promid");
		var imgList = $(e.target).attr("data-imgs");
		data = imgList.split(" ");
		if(data.length>4){
			if(ort==0){		//back				
				if(index+4<data.length){
					var newIndex = (index+4);
					var thumbNode = ".thumb"+promid;
					var forwardNode = ".icon_forward"+promid;
					$(thumbNode).html("");
					for(var i=newIndex; i<(newIndex+4);i++ ){
//						alert("data"+i+"="+data[i]);
						if(data[i]){
							$(thumbNode).append(
									"<li>"
									+"<img src='./image_50/" + data[i] + "' alt=''>"
									+"</li>"	
							);
						}
					}
					index=newIndex;
					$(e.target).attr("data-index",index);
					$(forwardNode).attr("data-index",index);
				}
			}else{			//forward
				//alert("index="+index);
				if(index-4>=0){
					var newIndex = (index-4);
					//alert("newIndex="+newIndex);
					var thumbNode = ".thumb"+promid;
					var backNode = ".icon_back"+promid;
					$(thumbNode).html("");
					for(var i=newIndex; i<(newIndex+4);i++ ){
						if(data[i]){
							$(thumbNode).append(
									"<li>"
									+"<img src='./image_50/" + data[i] + "' alt=''>"
									+"</li>"	
							);
						}
					}
					index=newIndex;
					$(e.target).attr("data-index",index);	
					$(backNode).attr("data-index",index);
				}
			}			
		}			
	}
});


function moveText(){
	$('.info').each(function(){
		
		$(this).mouseenter(function(){  // 	when mouse enter, scroll up to see all text content
			var info_height = $(this).innerHeight();
			var content_height = $(this).find('.visible_area').innerHeight();
			var diff = content_height - info_height;
			//console.log(diff);
			
			if(diff > 0){
				$(this).find('.visible_area').animate({top:-diff});
			}
			
		});
	
		$(this).mouseleave(function(){  //when mouse leave, back to original position
			var info_height = $(this).innerHeight();
			var content_height = $(this).find('.visible_area').innerHeight();
			var diff = content_height - info_height;
			//console.log(diff);
			
			if(diff > 0){
				$(this).find('.visible_area').animate({top:0});
			}
			
		});
	});
}

