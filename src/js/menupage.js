
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
			showDetail();
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
			timeout:3000,
			error: function(xhr){
				alert("Load Page Error!");
			},
			success: function(res){								
//				alert(page);
//				alert(cateid);
//				alert(res.totalPage);
//				alert(res.dishinfo[1].dish_name_cn);
//				alert(res.dishinfo[1].album_path);
				$('#dishbox').html("");
				if(res.dishinfo.length>0){
					$.each(res.dishinfo,function(i, item){
						$('#dishbox').append(
								"<div class='pic'>"
								+ "<img src='./image_350/" + item.album_path + "'" + " alt='" + item.dish_name_en + "'" + " />" 
								+ "<div class='info'>" 
								+ "<span class='t_left'>" + item.dish_name_en + "</span>"
								+ "<span class='t_right'>" + "$&nbsp;" + item.current_price + "</span>"
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
		});
		$(document).scrollTop(0);	
	}
})

