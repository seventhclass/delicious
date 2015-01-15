
$(document).ready(function (){

	$('.thumblist').click(function(e){
		if($(e.target).is('img')){
			
			changePromImage(e);
		}
	});

	
	function changePromImage(e){
		var prom_index =$(e.target).parents('ul').attr("data-listid");  //get the index of the promotion(1 to n)
		var prev_pic =$('#big'+prom_index +' img').attr("src").slice(-36); //'xxx.jpg' of the previous image
		
		var pic_name = $(e.target).attr("src").slice(-36);	//'xxx.jpg' of the small image being clicked
		
		//if the image clicked is the same as the large one, don't change image
		if (prev_pic == pic_name){
			return;
		}
		$('#big'+prom_index +' img').before(
			"<img class='fake_pic' src='./image_350/" + prev_pic + "'" + " style='opacity:1; position:absolute;left:0;top:0;'>"
		);
		
		$('#big'+prom_index +' .big_img').attr("src","./image_350/"+ pic_name);//change src of the original image tag to new image
				
		$('.fake_pic').fadeOut(400,function(){
			$('.fake_pic').remove();	//remove the img tag(s)
		} );
	}
})

