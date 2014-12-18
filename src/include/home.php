<?php 
require_once './include.php';

$sql="select slider_id,dish_id,album_path from slider_album order by slider_id";
$rows=fetchAll($sql);
print_r($rows);	
?>
<section class="content" id="content_home">
	 <div id="list" style="left: -980px;">
		<?php if (!$rows) {?>
		   <img src="./images/5.jpg" alt="5" height="490" width="980"/>
		   <img src="./images/1.jpg" alt="1" height="490" width="980"/>
		   <img src="./images/2.jpg" alt="2" height="490" width="980"/>
		   <img src="./images/3.jpg" alt="3" height="490" width="980"/>
		   <img src="./images/4.jpg" alt="4" height="490" width="980"/>
		   <img src="./images/5.jpg" alt="5" height="490" width="980"/>
		   <img src="./images/1.jpg" alt="1" height="490" width="980"/>	
		<?php 
			}else{
				foreach ($rows as $row):?>
							<img src="./admin/uploads/<?php echo $row['album_path']?>" alt="<?php echo $row['album_path']?>" height="490" width="980"/>
		<?php endforeach; }?>
	 </div> 
	 <div id="buttons">
	 <span index="1" class="on"></span>
	 <span index="2" ></span>
	 <span index="3" ></span>
	 <span index="4" ></span>
	 <span index="5" ></span>
	 </div>	
	 <a href="javascript:;" class="arrow" id="prev">&lt;</a>			 
	 <a href="javascript:;" class="arrow" id="next">&gt;</a>
</section>