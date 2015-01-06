
$(document).ready(function (){
	$('#category').click(function(e){
		if($(e.target).is('li')){
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
		
	$('#popup_page').click(function(e){
		if($(e.target).is('img')){
			changeDishImage(e);
		}
	});
	
	function getMenuItem(e){
		var page = $(e.target).attr("data-page");
		var cateid = $(e.target).attr("data-cateid");
		$.ajax({
			url:'./include/doMenu.php',
			cache:false,
			async: false,
			type:'GET',
			data: {"do":"third","page":page,"cateid":cateid},
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
//				alert(dishid);
//				alert(res.dishinfo.dish_name_cn);
//				alert(res.dishimages[0].album_path);
//				alert(res.cateinfo.cate_name_cn);
				createDetailPage(res);
			}
		});
	}
	
	function createMenuPage(res){
		$('#dishbox').html("");
		if(res.dishinfo.length>0){
			$.each(res.dishinfo,function(i, item){
				$('#dishbox').append(
						"<div class='pic'>"
						+ "<img src='./image_350/" + item.album_path + "'" + " alt='" + item.dish_name_en + "'" + " data-dishid='" + item.dish_id + "' />" 
						+ "<div class='info'" + " data-dishid='" + item.dish_id + "' >" 
						+ "<span class='left'>" + item.dish_name_en + "</span>"
						+ "<span class='right'>" + "$&nbsp;" + item.current_price + "</span>"
						+ "</div>"
						+ "</div>"
				);
			});
			if(res.totalRows>res.pageSize){
				$('#dishbox').append(								
						"<div class='pagebox'>" + res.pageLink + "</div>"
				);
			}
		}else{
			$('#dishbox').append("<h4>Sorry, no dish found. </h4>");
		}			
	}
	
	function createDetailPage(res){
		$('#popup_page').html("");		
		if(res.dishinfo.dish_id){
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
			
			if(res.dishimages.length>0){
				$('#pic_large').append(
						"<img  id='img_pic_large' src='./image_800/" + res.dishimages[0].album_path + "'" + " alt='" + res.dishinfo.dish_name_en + "'  width='460' height='350 'style='opacity:1;'>"	
				);
				$('#pic_small').append("<i id='s_back'></i>");
				$.each(res.dishimages,function(i, item){
					$('#pic_small').append(
						"<div class='thumb_nail'><img src='./image_50/" + item.album_path + "'" + " alt='" + item.album_path + "' width='64' height='64'" + " ></div>"
					);					
				});
				$('#pic_small').append("<i id='s_forward'></i>");
			}else{
				$('#pic_large').append(
						"<img src='' alt='' style='opacity:1;'>"	
				);
				$('#pic_small').append("<i id='s_back'></i>");
				$.each(res.dishimages,function(i, item){
					$('#pic_small').append(
						"<div class='thumb_nail'><img src='' alt=''></div>"
					);							
				});	
				$('#pic_small').append("<i id='s_forward'></i>");
			}
				
			if(res.dishinfo.is_spicy==1){
				var spicyinfo = "id='is_spicy'";
			}else{
				var spicyinfo = null;
			}
			
			$('#dish_text').append(
				"<h1>" + res.dishinfo.dish_name_en + "</h1>"
				+ "<ul>"
					+ "<li>"
						+ "<div class='dt'>Dish No.</div>"
						+ "<div class='dd'>" + res.dishinfo.dish_no + "</div>"
					+ "</li>"
					+ "<li>"
						+ "<div class='dt'>Category:</div>"
						+ "<div class='dd'>" + res.cateinfo.cate_name_en + "</div>"
					+ "</li>"
					+ "<li>"
						+ "<div class='dt'>Spicy:</div>"
						+ "<div class='dd' " + spicyinfo + "></div>"
					+ "</li>"	
					+ "<li>"
						+ "<div class='dt'>Current Price:</div>"
						+ "<div class='dd' >" + "$" + res.dishinfo.current_price + "</div>"
					+ "</li>"	
					+ "<li>"
						+ "<div class='dt'>Regular Price:</div>"
						+ "<div class='dd' >" + "$" + res.dishinfo.reg_price + "</div>"
					+ "</li>"					
				+ "</ul>"
			);	
			
			$('#dish_desc').append("<h1>" + res.dishinfo.dish_desc_en + "</h1>");				
		}else{
			$('#popup_page').append("<h1>Sorry, no dish detail information. </h1>");
		}			
	}
	
	function changeDishImage(e){
		var dish_name = $('#pic_large img').attr("alt");
		var pic_name = $(e.target).attr("alt");

		/* $('#pic_large').html("");		
		$('#pic_large').append(
			"<img src='./image_800/" + pic_name + "'" + " alt='" + dish_name + "'" + " width='460' height='350' style='opacity:1;'>"
		); */
		
		$('#pic_large').fadeOut(300,function(){
			$('#pic_large').html("");		
			$('#pic_large').append(
				"<img src='./image_800/" + pic_name + "'" + " alt='" + dish_name + "'" + " width='460' height='350' >");
		
			$('#pic_large').fadeIn(500,function(){
				//$('#img_pic_large').css("opacity","1");
			});		
		} );	
	}
	

	/* function changeDishImage(e){
		var dish_name = $('#pic_large img').attr("alt");
		var pic_name = $(e.target).attr("alt");
		//var detailBox = document.getElementById("img_pic_large");
		
		fadeOut("img_pic_large", 100, 0.2, 0);  //the img element fade outerHeight
		setTimeout(function() {
			//detailBox.style.display = "none";
			$('#img_pic_large').css("display","none");
		}, 200);
		$("img_pic_large").attr("src","./image_800/" + pic_name); //change attributes
		$("img_pic_large").attr("alt",dish_name);
		//detailBox.style.display = "block";
		$('#img_pic_large').css("display","block");
		fadeIn("img_pic_large", 100, 0.3, 0);
	} */
})

