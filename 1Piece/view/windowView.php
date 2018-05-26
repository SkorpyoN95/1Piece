<?php
include_once 'view/view.php';

class WindowView extends View
{
	public function createWindow($id, $size_type, $top, $left, $width, $min_height, $text) //$size_type: 'px' or '%'
	{
		echo '<div id="'.$id.'" style="display: none; position: fixed; top: '.$top.$size_type.'; left: '.$left.$size_type.'; width: '.$width.$size_type.'; min-height: '.$min_height.$size_type.'; background-color: #000022; 
					border-color: #999999; border-style: solid; border-width: thick; border-radius: 50px; padding: 25px; box-shadow: 0px 0px 10px 1px #ffffff; color: #ffffff; z-index: 999; text-align: center;">';
		?> <img style="position: absolute; top: 0px; right: 0px; width: 30px; height: 30px; cursor: pointer;" src="/templates/img/close.png" onclick="$('#<? echo $id; ?>').css('display','none');" /><?php
		echo $text;
		echo '</div>';
	}
	
	public function newsSheet($text)
	{
		?><div id="newsSheet" style="display: none; position: fixed; top: <?php echo ($_COOKIE['height']-340)/2;?>px; left: <?php echo ($_COOKIE['width']-500)/2;?>px; width: 350px; min-height: 240px; max-height: <?php echo ($_COOKIE['height']-340)/2;?>px;
				background-image: url('/templates/img/newspaper.gif'); background-size: 100% 100%; padding: 75px; color: #666666; z-index: 999;">
		<img style="position: absolute; top: 0px; right: 0px; width: 30px; height: 30px; cursor: pointer;" src="/templates/img/close.png" onclick="$('#newsSheet').css('display','none');" />
		<div style="position: relative; top: 0px; left: 0px; width: 100%; max-height: <?php echo ($_COOKIE['height']-340)/2;?>px; overflow: auto;"><?php
		echo nl2br($text);
		?>
		</div>
		</div><?php
	}
	
	public function dialogPW($id, $title, $text, $author)
	{
		?><div id="pw<?php echo $id;?>" style="display: none; position: fixed; top: <?php echo ($_COOKIE['height']-550)/2;?>px; left: <?php echo ($_COOKIE['width']-700)/2;?>px; width: 550px; min-height: 0px; 
				background-image: url('/templates/img/DDM/paper.png'); background-size: 100% 100%; padding: 25px 75px; color: #000000; z-index: 999;">
		<img style="position: absolute; top: 0px; right: 0px; width: 50px; height: 50px; cursor: pointer;" src="/templates/img/close.png" onclick="$('#pw<?php echo $id;?>').css('display','none');" />
		<img style="position: absolute; top: 0px; right: 53px; width: 50px; height: 50px; cursor: pointer;" src="/templates/img/DDM/rewrite.png" onclick="window.location.href='main.php?action=ddm&p=3&re_who=<?php echo $author;?>&re_title=<?php echo $title;?>'" />
		<p id="title" style="text-align: center; font-size: 18pt; font-weight: bolder;"><?php echo $title;?></p>
		<p id="text" style="text-align: justify; font-size: 14pt;"><?php echo nl2br($text);?></p>
		<p id="author" style="text-align: right; font-family: mistral; font-size: 20pt;"><?php echo $author;?></p>
		<?php
		echo '</div>';
	}
	
	public function showWindow($id)
	{
		echo '<script>$(document).ready(function(){$("#'.$id.'").css("display","block")});</script>';
	}
	
	public function hideWindow($id)
	{
		echo '<script>$(document).ready(function(){$("#'.$id.'").css("display","none")});</script>';
	}
}
?>