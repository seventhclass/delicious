<?php require_once './include.php'; $sql="select slider_id,dish_id,album_path from slider_album order by slider_id" ; $rows=fetchAll($sql); //print_r($rows); ?>
<section class="content" id="content_home">
	<div id="list" style="left: -980px;">
		<?php if (!$rows){
		?>
		<img src="./images/5.jpg"  height="490" width="980" />
		<img src="./images/1.jpg"  height="490" width="980" />
		<img src="./images/2.jpg"  height="490" width="980" />
		<img src="./images/3.jpg"  height="490" width="980" />
		<img src="./images/4.jpg"  height="490" width="980" />
		<img src="./images/5.jpg"  height="490" width="980" />
		<img src="./images/1.jpg"  height="490" width="980" />
		
		<?php
			} else {
				if(count($rows)==1){
		?>
					<img src="./admin/uploads/<?php echo $rows[0]['album_path']?>"  height="490" width="980" />
		<?php
				}else{
		?>
					<img src="./admin/uploads/<?php echo $rows[count($rows)-1]['album_path']?>"  height="490" width="980" />
		<?php
					foreach ($rows as $row):
		?>
						<img src="./admin/uploads/<?php echo $row['album_path']?>"  height="490" width="980" />
		
		<?php 
					endforeach;
		?>			
					<img src="./admin/uploads/<?php echo $rows[0]['album_path']?>"  height="490" width="980" />
		<?php
				}
			}
		?>
	</div>
	<?php
		if(!$rows){
	?>
		<!-- default index buttons -->
		<div id="buttons">
			<span index="1" class="on"></span>
			<span index="2"></span>
			<span index="3"></span>
			<span index="4"></span>
			<span index="5"></span>
		</div>
	<?php
		}else{
	?>
		<div id='buttons'>
		<?php 
			for($i=1;$i<=count($rows);$i++){
				if($i==1){
					echo "<span index='$i' class=on></span>";
				}else{
					echo "<span index='$i'></span>";
				}	
			}
		?>
			</div>
	<?php
		}
	?>
	<a href="javascript:;" class="arrow" id="prev">&lt;</a>
	<a href="javascript:;" class="arrow" id="next">&gt;</a>
</section>