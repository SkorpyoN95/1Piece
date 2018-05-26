<?php
include_once 'view/view.php';

class MainView extends View
{
	public function newsIcon()
	{
		$model = $this->loadModel('main');
		$icon = explode(',', $model->newsIcon());
		$wynik = $model->select('news', 'id');
		if(count($icon) == count($wynik))
		{
			?> <script> $(document).ready(function(){$('#newsId').html('<a href="main.php?action=news"><img style="position: absolute; right: 30px; top: 30px; width: 100px; height: 100px;" src="/templates/img/newsCoo2.png" /></a>');});</script> <?php

		}
		else
		{
			?> <script> $(document).ready(function(){$('#newsId').html('<a href="main.php?action=news"><img style="position: absolute; left: 50px; bottom: 30px; width: 100px; height: 100px;" src="/templates/img/newsCoo.png" /></a><p style="position: absolute; left: 140px; bottom: 60px; font-size: 36px; color: #ff0000"><?php echo (count($wynik) - count($icon)); ?></p>');});</script> <?php

		}
	}
	
	public function checkPW()
	{
		$model = $this->loadModel('main');
		$ddm = $model->checkPW();
		if($ddm)
		{
			?> <script> $(document).ready(function(){$('#ddm').html('<?php echo $ddm; ?>'); $('#ddm').css('color', '#ff0000');});</script> <?php
		}
		else
		{
			?> <script> $(document).ready(function(){$('#ddm').html('<?php echo $ddm; ?>');});</script> <?php
		}
	}
	
	public function whoOnline()
	{
		$model = $this->loadModel('main');
		$now = time();
		$wynik = $model->select('users', 'id,nickname', $now." - online <= 600 AND ".$now." - online >= 0", 'id asc');
		$ile = count($wynik);
		echo '<p style="font-weight: bolder; color: #ffffff;">Online: '.$ile.' graczy.</p>';
		echo '<p style="color: #ffffff;">';
		for($i = 0; $i < $ile; $i++)
		{
			$id = $wynik[$i]['id'];
			$nick = $wynik[$i]['nickname'];
			if($i == ($ile - 1)) echo '<a href="/main.php?id='.$id.'">'.$nick.'</a>.';
			else echo '<a href="/main.php?id='.$id.'">'.$nick.'</a>, ';
		}
		echo '</p>';
	}
	
	public function leftProfil()
	{
		$model = $this->loadModel('main');
		$nick = $model->select('users', 'nickname', 'id='.$_SESSION['zalogowany']);
		$bars = $model->select('bars', 'lvl,price,max_hp,act_hp,max_en,act_en,vitality,act_vit,max_exp,act_exp,gold', 'id='.$_SESSION['zalogowany']);
		
			$bar_hp = ($bars[0]['act_hp']/$bars[0]['max_hp']) * 100;
			if($bar_hp > 100) $bar_hp = 100;
			$bar_en = ($bars[0]['act_en']/$bars[0]['max_en']) * 100;
			if($bar_en > 100) $bar_en = 100;
			$bar_v = ($bars[0]['act_vit']/$bars[0]['vitality']) * 100;
			if($bar_v > 100) $bar_v = 100;
			$a_e = $bars[0]['act_exp'];
			$m_e = $bars[0]['max_exp'];
			$skip = (int)($bars[0]['lvl'] / 10);
			if($bars[0]['lvl'] % 10) $skip++;
			$minexp = $skip * $skip * 400 * ($bars[0]['lvl']) * ($bars[0]['lvl'] + 1);
			$a_e -= $minexp;
			$m_e -= $minexp;
			$bar_exp = ($a_e/$m_e) * 100;
			if($bar_exp > 100) $bar_exp = 100;
			?>
			<p style='text-align: center; font-size: 30px; font-weight: bolder;'>
			<?php echo $nick[0]['nickname']; ?><br>
			<?php echo $bars[0]['lvl']; ?> lvl<br>
			Złoto: <?php echo $bars[0]['gold']; ?><img style='width: 15px; height: 20px;' src='/templates/img/whiteBeli.png' />
			</p>
			<img style='width: 295px; height: 213px;' src='/templates/img/Avatary/<?php if(!file_exists('templates/img/Avatary/'.$_SESSION['zalogowany'].'.jpg')) echo 'brak_avka.jpg'; else echo $_SESSION['zalogowany'].'.jpg';?>' />
			<div>
				<div title="Doświadczenie: <?php echo $bars[0]['act_exp'].'/'.$bars[0]['max_exp'];?>" style="width: 300px; height: 10px; background-color: black; margin: 10px 0; border: solid 3px #ffff00; border-radius: 50px; box-shadow: 0px 0px 20px 2px #ffff00; overflow: hidden;"><div style="position: relative; left: 0%; top: 0%; height: 10px; width: <?php echo $bar_exp; ?>%; background-color: #bbbb00;" title="Doświadczenie: <?php echo $bars[0]['act_exp'].'/'.$bars[0]['max_exp'];?>"></div></div>
				
				<div title="Życie: <?php echo $bars[0]['act_hp'].'/'.$bars[0]['max_hp'];?>" style="width: 300px; height: 10px; margin: 10px 0; background-color: black; border: solid 3px #ff0000; border-radius: 50px; box-shadow: 0px 0px 20px 2px #ff0000; overflow: hidden;"><div style="position: relative; left: 0%; top: 0%; height: 10px; width: <?php echo $bar_hp; ?>%; background-color: #bb0000;" title="Życie: <?php echo $bars[0]['act_hp'].'/'.$bars[0]['max_hp'];?>"></div></div>

				<div title="Energia: <?php echo $bars[0]['act_en'].'/'.$bars[0]['max_en'];?>" style="width: 300px; height: 10px; margin: 10px 0; background-color: black; border: solid 3px #0000ff; border-radius: 50px; box-shadow: 0px 0px 20px 2px #0000ff; overflow: hidden;"><div title="Energia: <?php echo $bars[0]['act_en'].'/'.$bars[0]['max_en'];?>" style="position: relative; left: 0%; top: 0%; height: 10px; width: <?php echo $bar_en; ?>%; background-color: #0000bb;"></div></div>

				<div title="Witalność: <?php echo $bars[0]['act_vit'].'/'.$bars[0]['vitality'];?>" style="width: 300px; height: 10px; margin: 10px 0; background-color: black; border: solid 3px #00ff00; border-radius: 50px; box-shadow: 0px 0px 20px 2px #00ff00; overflow: hidden;"><div title="Witalność: <?php echo $bars[0]['act_vit'].'/'.$bars[0]['vitality'];?>" style="position: relative; left: 0%; top: 0%; height: 10px; width: <?php echo $bar_v; ?>%; background-color: #00bb00;"></div></div>
						
			</div><?php
	}
}
?>