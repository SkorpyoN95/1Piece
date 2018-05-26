<?php
include_once 'view/view.php';

class FightView extends View
{
	public function displayBattle()
	{
		$model = $this->loadModel('fight');
		$wynik = $model->select('users', 'nickname', 'id='.$_SESSION['zalogowany']);
		$wynik2 = $model->select('fights', '*', 'id='.$_SESSION['zalogowany']);
		$wynik3 = $model->select('bars', '*', 'id='.$_SESSION['zalogowany']);
		$wynik4 = $model->select('enemies', '*', 'id='.$wynik2[0]['opponent']);
		
		switch($wynik2[0]['habitat'])
		{
			case 1: $terrain = 'las.png'; break;
			case 2: $terrain = 'morze.jpg'; break;
			case 3: $terrain = 'Góry.png'; break;
			case 4: $terrain = 'graveyard2.jpg'; break;
		}
		
		if(!file_exists('templates/img/Avatary/'.$_SESSION['zalogowany'].'.jpg')) $p_av = 'brak_avka.jpg';
		else $p_av = $_SESSION['zalogowany'].'.jpg';
		
		$bar_hp = ($wynik3[0]['act_hp']/$wynik3[0]['max_hp']) * 100;
		if($bar_hp > 100) $bar_hp = 100;
		$bar_en = ($wynik3[0]['act_en']/$wynik3[0]['max_en']) * 100;
		if($bar_en > 100) $bar_en = 100;
		
		if($bar_hp > 80) $color = '#00ff00';
		else if($bar_hp > 50) $color = '#ffff00';
		else if($bar_hp > 20) $color = '#ff9900';
		else $color = '#ff0000';
		
		$opp_max_hp = 1000 + $wynik2[0]['opp_lvl'] * 100;
		$opp_max_en = 500 + $wynik2[0]['opp_lvl'] * 50;
		
		$opp_bar_hp = ($wynik2[0]['opp_hp'] / $opp_max_hp) * 100;
		if($opp_bar_hp > 100) $opp_bar_hp = 100;
		$opp_bar_en = ($wynik2[0]['opp_en'] / $opp_max_en) * 100;
		if($opp_bar_en > 100) $opp_bar_en = 100;
		
		if($opp_bar_hp > 80) $opp_color = '#00ff00';
		else if($opp_bar_hp > 50) $opp_color = '#ffff00';
		else if($opp_bar_hp > 20) $opp_color = '#ff9900';
		else $opp_color = '#ff0000';
		
		?>
		<div style="position: relative; height: 300px;">
			<img style='position: absolute; top: 0px; left: 0px; width: 100%; height: 300px; opacity: 0.7;' src='/templates/img/Stages/<?php echo $terrain;?>' />
			
			<div style="position: absolute; width: 300px; left: 10px;">
				<p style='position: absolute; top: -5px; left: 0px; width: 100%; text-align: center; font-size: 26px; font-weight: bolder;'><?php echo $wynik[0]['nickname'];?></p>
				<div title="Życie: <?php echo $wynik3[0]['act_hp'].'/'.$wynik3[0]['max_hp'];?>" style="position: absolute; top: 53px; width: 295px; height: 10px; background-color: black;"><div style="position: relative; left: 0%; top: 0%; height: 10px; width: <?php echo $bar_hp; ?>%; background-color: <?php echo $color; ?>;" title="Życie: <?php echo $wynik3[0]['act_hp'].'/'.$wynik3[0]['max_hp'];?>"></div></div>
				<div title="Energia: <?php echo $wynik3[0]['act_en'].'/'.$wynik3[0]['max_en'];?>" style="position: absolute; top: 65px; width: 295px; height: 10px; background-color: black;"><div title="Energia: <?php echo $wynik3[0]['act_en'].'/'.$wynik3[0]['max_en'];?>" style="position: relative; left: 0%; top: 0%; height: 10px; width: <?php echo $bar_en; ?>%; background-color: #004fff;"></div></div>
				<img style='position: absolute; top: 77px; left: 0px; width: 295px; height: 213px;' src='/templates/img/Avatary/<?php echo $p_av;?>' />
			</div>
			
			<img style='position: absolute; top: 100px; left: 310px; width: 100px; height: 100px;' src='/templates/img/vs.png' />
			
			<div style="position: absolute; width: 300px; right: 5px;">
				<p style='position: absolute; top: -5px; left: 0px; font-size: 26px; font-weight: bolder;'><?php echo $wynik4[0]['name'];?></p>
				<p style='position: absolute; top: -5px; right: 10px; font-size: 26px; font-weight: bolder;'><?php echo $wynik2[0]['opp_lvl'];?></p>
				<div title="Życie: <?php echo $wynik2[0]['opp_hp'].'/'.$opp_max_hp;?>" style="position: absolute; top: 53px; width: 295px; height: 10px; background-color: black;"><div style="position: relative; left: 0%; top: 0%; height: 10px; width: <?php echo $opp_bar_hp; ?>%; background-color: <?php echo $opp_color; ?>;" title="Życie: <?php echo $wynik2[0]['opp_hp'].'/'.$opp_max_hp;?>"></div></div>
				<div title="Energia: <?php echo $wynik2[0]['opp_en'].'/'.$opp_max_en;?>" style="position: absolute; top: 65px; width: 295px; height: 10px; background-color: black;"><div title="Energia: <?php echo $wynik2[0]['opp_en'].'/'.$opp_max_en;?>" style="position: relative; left: 0%; top: 0%; height: 10px; width: <?php echo $opp_bar_en; ?>%; background-color: #004fff;"></div></div>
				<img style='position: absolute; top: 77px; left: 0px; width: 295px; height: 213px;' src='<?php echo $wynik4[0]['avatar'];?>' />
			</div>
		</div>
		
		<div style="position: relative; min-height: 300px;">
			<?php 
			if(isset($_GET['type'])) $type = $_GET['type']; else $type = 1;
			$this->showMoves($type); 
			?>
		</div>
		
		<div style="position: relative; min-height: 175px;">
			<div id="at1" style="position: absolute; top: 20px; left: 0px; width: 100px; height: 100px; background-color: #000000; border-radius: 10px;"></div>
			<div id="at2" style="position: absolute; top: 20px; left: 110px; width: 100px; height: 100px; background-color: #000000; border-radius: 10px;"></div>
			<div id="at3" style="position: absolute; top: 20px; left: 220px; width: 100px; height: 100px; background-color: #000000; border-radius: 10px;"></div>
			
			<form style="position: absolute; top: 130px; left: 200px;" method='post' action='main.php?action=fight'>
				<input id='tech1' name='tech[]' type='hidden' value='0'/>
				<input id='tech2' name='tech[]' type='hidden' value='0'/>
				<input id='tech3' name='tech[]' type='hidden' value='0'/>
				<input name='fight' type='submit' value='Atakuj!'/>
			</form>
		</div>
		<?php
	}
	
	public function showMoves($type)
	{
		switch($type)
		{
			case 1: $type2 = "Refleks"; $type3 = 'warrior'; break;
			case 2: $type2 = "Siła"; $type3 = 'swordsman'; break;
			case 3: $type2 = "Celność"; $type3 = 'rifleman'; break;
			case 4: $type2 = "Zwinność"; $type3 = 'assasin'; break;
			case 5: $type2 = "Intelekt"; $type3 = 'cyborg'; break;
			default: break;
		}
		
		$model = $this->loadModel('moves');
		$wynik = $model->select('moves', '*', 'type="'.$type3.'"');
		?>
		<div style='position: relative; height: 100px;'>
		<p style="position: absolute; left: 0px; top: 0px; font-size: 20pt; font-weight: bolder;">Typ posunięć: </p>
		<form style="position: absolute; left: 170px; top: 33px;">
		<select name="eq" size="1" onchange="window.location.href='main.php?action=fight&type=' + this.value;">
		<option value="1" <? if ($type=="1") echo "SELECTED"; ?>>Wojownik</option>
		<option value="2" <? if ($type=="2") echo "SELECTED"; ?>>Szermierz</option>
		<option value="3" <? if ($type=="3") echo "SELECTED"; ?>>Strzelec</option>
		<option value="4" <? if ($type=="4") echo "SELECTED"; ?>>Zabójca</option>
		<option value="5" <? if ($type=="5") echo "SELECTED"; ?>>Cyborg</option>
		</select>
		</form>
		</div>
		
		<table style="width: 500px; margin: 0px auto;">
			<?php
			$model2 = $this->loadModel('stats');
			$stats = $model2->battleStats();
			for($j = 0; $j < 3; $j++)
			{
				echo '<tr style="text-align: center;">';
				for($i = 0; $i < 5; $i++)
				{
					$k = $j * 5 + $i;
					if($wynik[$k]['name'] == null)
					{
						?>
						<td><button style="width: 100px; height: 100px;"></button></td>
						<?php
					}else
					{
						?>
							<td><button style="width: 100px; height: 100px;" 
										onclick="PutAttack('<?php echo $wynik[$k]['name']; ?>', <?php echo $wynik[$k]['id']; ?>);"
										title="Atak: <?php echo $wynik[$k]['ATK'] * $stats[0]; ?> &#xA;Obrona: <?php echo $wynik[$k]['DEF'] * $stats[1]; ?>&#xA;Szybkość: <?php echo $wynik[$k]['SPD'] + $stats[2]; ?>&#xA;Koszt: <?php echo $wynik[$k]['cost']; ?>">
										<?php echo $wynik[$k]['name']; ?>
							</button></td>
						<?php
					}
				}
				echo '</tr>';
			}
			?>
		</table>
		<?php
	}
	
	public function displayEoB()
	{
		$model = $this->loadModel('fight');
		$wynik = $model->select('fights', 'opp_lvl,win', 'id='.$_SESSION['zalogowany']);
		
		if($wynik[0]['win'] == 1)
		{
		?>
		<div style='position: relative; width: 400px; margin: 0px auto;'>
		<p style='position: relative; width: 100%; text-align: center; font-size: 30px; font-weight: bolder;'>Gratulacje!</p>
		<p style='position: relative; width: 100%; text-align: center; font-size: 20px; font-weight: bolder;'>Wygrałeś</p>
		<p style='position: relative; width: 100%; text-align: center; font-size: 20px;'>Twoja nagroda: <?php echo 15*$wynik[0]['opp_lvl'];?> exp.</p>
		<p style='position: relative; width: 100%; text-align: center; font-size: 20px;'>Twój łup: <?php echo 25*$wynik[0]['opp_lvl'];?> <img style='position: relative; top: 4px;' src='/templates/img/whiteBeli.png' />.</p>
		<p style='position: relative; width: 100%; text-align: center; font-size: 20px;'><a href='main.php?action=fight&eob'>Zakończ</a></p>
		<img style='width: 400px; height: 300px;' src='/templates/img/battle_win.jpg' />
		</div>
		<?php
		}
		else
		{
		?>
		<div style='position: relative; width: 400px; margin: 0px auto;'>
		<p style='position: relative; width: 100%; text-align: center; font-size: 30px; font-weight: bolder;'>Niestety!</p>
		<p style='position: relative; width: 100%; text-align: center; font-size: 20px; font-weight: bolder;'>Przegrałeś</p>
		<p style='position: relative; width: 100%; text-align: center; font-size: 20px;'><a href='main.php?action=fight&eob'>Zakończ</a></p>
		<img style='width: 400px; height: 300px;' src='/templates/img/battle_lose.jpg' />
		</div>
		<?php
		}
	}
}
?>