<?php
include_once 'view/view.php';

class ProfileView extends View
{
	public function showProfile($data, $mode)
	{
		if($mode)
		{
			$bar_hp = ($data[3][0]['act_hp']/$data[3][0]['max_hp']) * 100;
			if($bar_hp > 100) $bar_hp = 100;
			$bar_en = ($data[3][0]['act_en']/$data[3][0]['max_en']) * 100;
			if($bar_en > 100) $bar_en = 100;
			$bar_v = ($data[3][0]['act_vit']/$data[3][0]['vitality']) * 100;
			if($bar_v > 100) $bar_v = 100;
			$a_e = $data[3][0]['act_exp'];
			$m_e = $data[3][0]['max_exp'];
			$skip = (int)($data[1][0]['lvl'] / 10);
			if($data[1][0]['lvl'] % 10) $skip++;
			$minexp = $skip * $skip * 400 * ($data[1][0]['lvl']) * ($data[1][0]['lvl'] + 1);
			$a_e -= $minexp;
			$m_e -= $minexp;
			$bar_exp = ($a_e/$m_e) * 100;
			if($bar_exp > 100) $bar_exp = 100;
			
			
			?>
			<p style='text-align: center; font-size: 30px; font-weight: bolder;'>
			Złoto: <?php echo $data[3][0]['gold']; ?><img style='width: 15px; height: 20px;' src='/templates/img/whiteBeli.png' />
			</p>
			<div>
				<div title="Doświadczenie: <?php echo $data[3][0]['act_exp'].'/'.$data[3][0]['max_exp'];?>" style="width: 720px; height: 10px; background-color: black; margin: 5px; border: solid 3px #ffff00; border-radius: 50px; box-shadow: 0px 0px 20px 2px #ffff00; overflow: hidden;"><div style="position: relative; left: 0%; top: 0%; height: 10px; width: <?php echo $bar_exp; ?>%; background-color: #bbbb00;" title="Doświadczenie: <?php echo $data[3][0]['act_exp'].'/'.$data[3][0]['max_exp'];?>"></div></div>
				<table><tr>
					<td>
						<div title="Życie: <?php echo $data[3][0]['act_hp'].'/'.$data[3][0]['max_hp'];?>" style="width: 230px; height: 10px; margin: 5px; background-color: black; border: solid 3px #ff0000; border-radius: 50px; box-shadow: 0px 0px 20px 2px #ff0000; overflow: hidden;"><div style="position: relative; left: 0%; top: 0%; height: 10px; width: <?php echo $bar_hp; ?>%; background-color: #bb0000;" title="Życie: <?php echo $data[3][0]['act_hp'].'/'.$data[3][0]['max_hp'];?>"></div></div>
					</td>
					<td>
						<div title="Energia: <?php echo $data[3][0]['act_en'].'/'.$data[3][0]['max_en'];?>" style="width: 230px; height: 10px; margin: 5px; background-color: black; border: solid 3px #0000ff; border-radius: 50px; box-shadow: 0px 0px 20px 2px #0000ff; overflow: hidden;"><div title="Energia: <?php echo $data[3][0]['act_en'].'/'.$data[3][0]['max_en'];?>" style="position: relative; left: 0%; top: 0%; height: 10px; width: <?php echo $bar_en; ?>%; background-color: #0000bb;"></div></div>
					</td>
					<td>
						<div title="Witalność: <?php echo $data[3][0]['act_vit'].'/'.$data[3][0]['vitality'];?>" style="width: 220px; height: 10px; margin: 5px; background-color: black; border: solid 3px #00ff00; border-radius: 50px; box-shadow: 0px 0px 20px 2px #00ff00; overflow: hidden;"><div title="Witalność: <?php echo $data[3][0]['act_vit'].'/'.$data[3][0]['vitality'];?>" style="position: relative; left: 0%; top: 0%; height: 10px; width: <?php echo $bar_v; ?>%; background-color: #00bb00;"></div></div>
					</td>
				</tr></table>
			</div>
			<br><br>
			<?php
		}
		$model = $this->loadModel('class');
		$wynik = $model->select('classes', 'theclass', 'id='.$data[0][0]['id']);
		switch($wynik[0]['theclass'])
		{
			case '': $class = 'Brak'; break;
			case 'warrior': $class = 'Wojownik'; break;
			case 'swordsman': $class = 'Szermierz'; break;
			case 'rifleman': $class = 'Strzelec'; break;
			case 'assasin': $class = 'Zabójca'; break;
			case 'cyborg': $class = 'Cyborg'; break;
		}
		?>
		<table>
			<tr>
				<td>
					<div style='position: relative; top: 0px; left: 0px; width: 350px; height: 496px;  background-image: url(/templates/img/wanted.gif); background-size: 100% 100%;'>
						<img style='position: absolute; top: 107px; left: 31px; width: 295px; height: 213px;' src='/templates/img/Avatary/<?php echo $data[1][1];?>' />
						<p style="position: absolute; left: 32px; top: 320px; height: 40px; width: 294px; text-align: center; color: #663333; font-size: 40px; letter-spacing: 0px; 
									font-family: 'BebasNeue'; text-transform: uppercase;"><?php echo $data[0][0]['nickname']; ?></p>		
						<p style="position: absolute; left: 32px; top: 367px; height: 40px; width: 270px; text-align: right; color: #663333; font-size: 40px; 
									font-family: 'BebasNeue'; text-transform: uppercase;"><?php echo $data[1][0]['price'];?></p>
					</div>
				</td>
				<td style='width: 350px;'>
					<center><table style='border-spacing: 25px 0px;'>
						<tr>
							<td>Poziom:</td>
							<td><?php echo $data[1][0]['lvl'];?></td>
						</tr>
						<tr>
							<td>Owoc:</td>
							<td>Brak</td>
						</tr>
						<tr>
							<td>W związku:</td>
							<td>Brak</td>
						</tr>
						<tr>
							<td>Klasa:</td>
							<td><?php echo $class; ?></td>
						</tr>
						<tr>
							<td>Profesja:</td>
							<td>Brak</td>
						</tr>
					</table></center>
		</td>
		</tr>
		</table>
		<p style='font-size: 16px; text-align: center;'>Ostatnio online: 
		<?php 
		//echo '<script>alert("'.$data[1][0]['online'].'");</script>';
			$last = $data[0][0]['online'];
			$now = time();
			$online = $now - $last;
			$year = 60*60*24*365;
			
			if($online <= 300)
				$last_online = 'teraz.';
			else if($online < $year)
				{
					$d = (int)($online/(3600*24));
					$online -= $d*3600*24;
					$h = (int)($online/3600);
					$online -= $h*3600;
					$m = (int)($online/60);
					$online -= $m*60;
					$s = $online;
					$last_online = $d.' dni '.$h.' h '.$m.' min '.$s.' sec temu.';
				}
				else
					$last_online = 'ponad rok temu.'; 
			echo $last_online; 
		?>
		</p>
		<p style='font-size: 24px; text-align: center;'><?php $opis = $data[2][0]['opis']; echo nl2br($opis);?></p>
		<?php
	}
}
?>