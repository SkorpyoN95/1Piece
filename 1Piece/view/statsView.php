<?php
include_once 'view/view.php';

class StatsView extends View
{
	public function showStats($stats)
	{
		$str_lvl = $stats[0]['str_lvl'];
		$dex_lvl = $stats[0]['dex_lvl'];
		$stam_lvl = $stats[0]['stam_lvl'];
		$ment_lvl = $stats[0]['ment_lvl'];
		$will_lvl = $stats[0]['will_lvl'];
		$ref_lvl = $stats[0]['ref_lvl'];
		$acc_lvl = $stats[0]['acc_lvl'];
		$ins_lvl = $stats[0]['ins_lvl'];
		$str_exp = $stats[0]['str_exp'];
		$dex_exp = $stats[0]['dex_exp'];
		$stam_exp = $stats[0]['stam_exp'];
		$ment_exp = $stats[0]['ment_exp'];
		$will_exp = $stats[0]['will_exp'];
		$ref_exp = $stats[0]['ref_exp'];
		$acc_exp = $stats[0]['acc_exp'];
		$ins_exp = $stats[0]['ins_exp'];
		$max_str_exp = $stats[0]['max_str_exp'];
		$max_dex_exp = $stats[0]['max_dex_exp'];
		$max_stam_exp = $stats[0]['max_stam_exp'];
		$max_ment_exp = $stats[0]['max_ment_exp'];
		$max_will_exp = $stats[0]['max_will_exp'];
		$max_ref_exp = $stats[0]['max_ref_exp'];
		$max_acc_exp = $stats[0]['max_acc_exp'];
		$max_ins_exp = $stats[0]['max_ins_exp'];
	
		$minexp = 25 * ($str_lvl) * ($str_lvl + 1);
		$bar_str = ($str_exp - $minexp)/($max_str_exp - $minexp) * 100;
		if($bar_str > 100) $bar_str = 100;
		$minexp = 25 * ($dex_lvl) * ($dex_lvl + 1);
		$bar_dex = ($dex_exp - $minexp)/($max_dex_exp - $minexp) * 100;
		if($bar_dex > 100) $bar_dex = 100;
		$minexp = 25 * ($stam_lvl) * ($stam_lvl + 1);
		$bar_stam = ($stam_exp - $minexp)/($max_stam_exp - $minexp) * 100;
		if($bar_stam > 100) $bar_stam = 100;
		$minexp = 25 * ($ment_lvl) * ($ment_lvl + 1);
		$bar_ment = ($ment_exp - $minexp)/($max_ment_exp - $minexp) * 100;
		if($bar_ment > 100) $bar_ment = 100;
		$minexp = 25 * ($will_lvl) * ($will_lvl + 1);
		$bar_will = ($will_exp - $minexp)/($max_will_exp - $minexp) * 100;
		if($bar_will > 100) $bar_will = 100;
		$minexp = 25 * ($ref_lvl) * ($ref_lvl + 1);
		$bar_ref = ($ref_exp - $minexp)/($max_ref_exp - $minexp) * 100;
		if($bar_ref > 100) $bar_ref = 100;
		$minexp = 25 * ($acc_lvl) * ($acc_lvl + 1);
		$bar_acc = ($acc_exp - $minexp)/($max_acc_exp - $minexp) * 100;
		if($bar_acc > 100) $bar_acc = 100;
		$minexp = 25 * ($ins_lvl) * ($ins_lvl + 1);
		$bar_ins = ($ins_exp - $minexp)/($max_ins_exp - $minexp) * 100;
		if($bar_ins > 100) $bar_ins = 100;
		
		echo '<p style="font-weight: bolder; font-size: 24px;">Twoje statystyki:</p>';
		echo '<table cellspacing="10" style="width: 400px; text-align: center; margin: 0 auto;">';
		echo '<tr><td style="text-align: left;"><strong>Parametr</strong></td><td><strong>Poziom</strong></td><td><strong>Postęp</strong></td></tr>';
		echo '<tr><td></td><td></td><td></td><td></td></tr>';
		
		echo '<tr><td style="text-align: left;">Refleks</td><td>'.$ref_lvl.'</td><td><div title="'.$ref_exp.'/'.$max_ref_exp.'" style="width: 100px; height: 10px; background-color: black; border: solid 3px #ff00ff; border-radius: 50px; box-shadow: 0px 0px 20px 2px #ff00ff; overflow: hidden; margin: 5px;"><div style="position: relative; left: 0%; top: 0%; height: 10px; width: '.$bar_ref.'%; background-color: #7F007F;" title="'.$ref_exp.'/'.$max_ref_exp.'"></div></div></td></tr>';
		echo '<tr><td style="text-align: left;">Siła</td><td>'.$str_lvl.'</td><td><div title="'.$str_exp.'/'.$max_str_exp.'" style="width: 100px; height: 10px; background-color: black; border: solid 3px #ff00ff; border-radius: 50px; box-shadow: 0px 0px 20px 2px #ff00ff; overflow: hidden; margin: 5px;"><div style="position: relative; left: 0%; top: 0%; height: 10px; width: '.$bar_str.'%; background-color: #7F007F;" title="'.$str_exp.'/'.$max_str_exp.'"></div></div></td></tr>';
		echo '<tr><td style="text-align: left;">Celność</td><td>'.$acc_lvl.'</td><td><div title="'.$acc_exp.'/'.$max_acc_exp.'" style="width: 100px; height: 10px; background-color: black; border: solid 3px #ff00ff; border-radius: 50px; box-shadow: 0px 0px 20px 2px #ff00ff; overflow: hidden; margin: 5px;"><div style="position: relative; left: 0%; top: 0%; height: 10px; width: '.$bar_acc.'%; background-color: #7F007F;" title="'.$acc_exp.'/'.$max_acc_exp.'"></div></div></td></tr>';
		echo '<tr><td style="text-align: left;">Zwinność</td><td>'.$dex_lvl.'</td><td><div title="'.$dex_exp.'/'.$max_dex_exp.'" style="width: 100px; height: 10px; background-color: black; border: solid 3px #ff00ff; border-radius: 50px; box-shadow: 0px 0px 20px 2px #ff00ff; overflow: hidden; margin: 5px;"><div style="position: relative; left: 0%; top: 0%; height: 10px; width: '.$bar_dex.'%; background-color: #7F007F;" title="'.$dex_exp.'/'.$max_dex_exp.'"></div></div></td></tr>';
		echo '<tr><td style="text-align: left;">Intelekt</td><td>'.$ment_lvl.'</td><td><div title="'.$ment_exp.'/'.$max_ment_exp.'" style="width: 100px; height: 10px; background-color: black; border: solid 3px #ff00ff; border-radius: 50px; box-shadow: 0px 0px 20px 2px #ff00ff; overflow: hidden; margin: 5px;"><div style="position: relative; left: 0%; top: 0%; height: 10px; width: '.$bar_ment.'%; background-color: #7F007F;" title="'.$ment_exp.'/'.$max_ment_exp.'"></div></div></td></tr>';
		echo '<tr style="height: 25px;"><td></td><td></td><td></td><td></td></tr>';
		echo '<tr><td style="text-align: left;">Wytrzymałość</td><td>'.$stam_lvl.'</td><td><div title="'.$stam_exp.'/'.$max_stam_exp.'" style="width: 100px; height: 10px; background-color: black; border: solid 3px #ff00ff; border-radius: 50px; box-shadow: 0px 0px 20px 2px #ff00ff; overflow: hidden; margin: 5px;"><div style="position: relative; left: 0%; top: 0%; height: 10px; width: '.$bar_stam.'%; background-color: #7F007F;" title="'.$stam_exp.'/'.$max_stam_exp.'"></div></div></td></tr>';
		echo '<tr><td style="text-align: left;">Instynkt</td><td>'.$ins_lvl.'</td><td><div title="'.$ins_exp.'/'.$max_ins_exp.'" style="width: 100px; height: 10px; background-color: black; border: solid 3px #ff00ff; border-radius: 50px; box-shadow: 0px 0px 20px 2px #ff00ff; overflow: hidden; margin: 5px;"><div style="position: relative; left: 0%; top: 0%; height: 10px; width: '.$bar_ins.'%; background-color: #7F007F;" title="'.$ins_exp.'/'.$max_ins_exp.'"></div></div></td></tr>';
		echo '<tr><td style="text-align: left;">Silna Wola</td><td>'.$will_lvl.'</td><td><div title="'.$will_exp.'/'.$max_will_exp.'" style="width: 100px; height: 10px; background-color: black; border: solid 3px #ff00ff; border-radius: 50px; box-shadow: 0px 0px 20px 2px #ff00ff; overflow: hidden; margin: 5px;"><div style="position: relative; left: 0%; top: 0%; height: 10px; width: '.$bar_will.'%; background-color: #7F007F;" title="'.$will_exp.'/'.$max_will_exp.'"></div></div></td></tr>';
		
		echo '</table>';
		
		$model = $this->loadModel('stats');
		$wynik = $model->select('body', '*', 'id='.$_SESSION['zalogowany']);
		
		echo '<p style="font-weight: bolder; font-size: 24px;">Organizm:</p>';
		echo '<table cellspacing="10" style="width: 400px; text-align: center; margin: 0 auto;">';
		echo '<tr><td style="text-align: left;"></td><td><strong>Zwiększa</strong></td><td><strong>Bonus</strong></td></tr>';
		echo '<tr><td></td><td></td><td></td><td></td></tr>';
		echo '<tr><td style="text-align: left;">Mięśnie</td><td style="color: #00ff00;">Zdrowie</td><td style="color: #00ff00;">+'.$wynik[0]['muscles'].'%</td></tr>';
		echo '<tr><td style="text-align: left;">Płuca</td><td style="color: #00ff00;">Energia</td><td style="color: #00ff00;">+'.$wynik[0]['lungs'].'%</td></tr>';
		echo '<tr><td style="text-align: left;">Serce</td><td style="color: #00ff00;">Witalność</td><td style="color: #00ff00;">+'.$wynik[0]['heart'].'%</td></tr>';
		echo '</table>';
		
		$bstats = $model->battleStats();
		$off = $bstats[0];
		$def = $bstats[1];
		$spd = $bstats[2];
		$int = $bstats[3];
		$cun = $bstats[4];
		
		echo '<p style="font-weight: bolder; font-size: 24px;">Statystyki bojowe:</p>';
		echo '<table cellspacing="10" style="width: 600px; text-align: center; margin: 0 auto;">';
		echo '<tr><td style="text-align: left;"><strong>Parametr</strong></td><td><strong>Wartość</strong></td><td><strong>Opis działania</strong></td></tr>';
		echo '<tr><td></td><td></td><td></td><td></td></tr>';
		echo '<tr><td style="text-align: left;">Atak</td><td>'.$off.'</td><td>Podstawa ofensywy.</td></tr>';
		echo '<tr><td style="text-align: left;">Obrona</td><td>'.$def.'</td><td>Podstawa defensywy.</td></tr>';
		echo '<tr><td style="text-align: left;">Szybkość</td><td>'.$spd.'</td><td>Umożliwia uniki, decyduje o kolejności ataku.</td></tr>';
		echo '<tr><td style="text-align: left;">Inteligencja</td><td>'.$int.'</td><td>Zwiększa szanse na wystąpienie czynników losowych (np. uderzenie krytyczne).</td></tr>';
		echo '<tr><td style="text-align: left;">Cwaniactwo</td><td>'.$cun.'</td><td>Wykorzystywane do zagrań, które z duchem "fair play" nie mają niczego wspólnego.</td></tr>';
		echo '</table>';
		
		$profs = $model->select('proficiency', '*', 'id='.$_SESSION['zalogowany']);
		$combat_lvl = $profs[0]['combat_lvl'];
		$fencing_lvl = $profs[0]['fencing_lvl'];
		$shooting_lvl = $profs[0]['shooting_lvl'];
		$assasination_lvl = $profs[0]['assasination_lvl'];
		$military_lvl = $profs[0]['military_lvl'];
		$brutality_lvl = $profs[0]['brutality_lvl'];
		$combat_exp = $profs[0]['combat_exp'];
		$fencing_exp = $profs[0]['fencing_exp'];
		$shooting_exp = $profs[0]['shooting_exp'];
		$assasination_exp = $profs[0]['assasination_exp'];
		$military_exp = $profs[0]['military_exp'];
		$brutality_exp = $profs[0]['brutality_exp'];
		$max_combat_exp = $profs[0]['max_combat_exp'];
		$max_fencing_exp = $profs[0]['max_fencing_exp'];
		$max_shooting_exp = $profs[0]['max_shooting_exp'];
		$max_assasination_exp = $profs[0]['max_assasination_exp'];
		$max_military_exp = $profs[0]['max_military_exp'];
		$max_brutality_exp = $profs[0]['max_brutality_exp'];
		
		$minexp = 1000 * ($combat_lvl) * ($combat_lvl + 1);
		$bar_combat = ($combat_exp - $minexp)/($max_combat_exp - $minexp) * 100;
		if($bar_combat > 100) $bar_combat = 100;
		$minexp = 1000 * ($fencing_lvl) * ($fencing_lvl + 1);
		$bar_fencing = ($fencing_exp - $minexp)/($max_fencing_exp - $minexp) * 100;
		if($bar_fencing > 100) $bar_fencing = 100;
		$minexp = 1000 * ($shooting_lvl) * ($shooting_lvl + 1);
		$bar_shooting = ($shooting_exp - $minexp)/($max_shooting_exp - $minexp) * 100;
		if($bar_shooting > 100) $bar_shooting = 100;
		$minexp = 1000 * ($assasination_lvl) * ($assasination_lvl + 1);
		$bar_assasination = ($assasination_exp - $minexp)/($max_assasination_exp - $minexp) * 100;
		if($bar_assasination > 100) $bar_assasination = 100;
		$minexp = 1000 * ($military_lvl) * ($military_lvl + 1);
		$bar_military = ($military_exp - $minexp)/($max_military_exp - $minexp) * 100;
		if($bar_military > 100) $bar_military = 100;
		$minexp = 1000 * ($brutality_lvl) * ($brutality_lvl + 1);
		$bar_brutality = ($brutality_exp - $minexp)/($max_brutality_exp - $minexp) * 100;
		if($bar_brutality > 100) $bar_brutality = 100;
		
		echo '<p style="font-weight: bolder; font-size: 24px;">Biegłości:</p>';
		echo '<table cellspacing="10" style="width: 400px; text-align: center; margin: 0 auto;">';
		echo '<tr><td style="text-align: left;"><strong>Biegłość</strong></td><td><strong>Poziom</strong></td><td><strong>Postęp</strong></td></tr>';
		echo '<tr><td></td><td></td><td></td><td></td></tr>';
		
		echo '<tr><td style="text-align: left;">Walka w zwarciu</td><td>'.$combat_lvl.'</td><td><div title="'.$combat_exp.'/'.$max_combat_exp.'" style="width: 100px; height: 10px; background-color: black; border: solid 3px #00ffff; border-radius: 50px; box-shadow: 0px 0px 20px 2px #00ffff; overflow: hidden; margin: 5px;"><div style="position: relative; left: 0%; top: 0%; height: 10px; width: '.$bar_combat.'%; background-color: #007F7F;" title="'.$combat_exp.'/'.$max_combat_exp.'"></div></div></td></tr>';
		echo '<tr><td style="text-align: left;">Fechtunek</td><td>'.$fencing_lvl.'</td><td><div title="'.$fencing_exp.'/'.$max_fencing_exp.'" style="width: 100px; height: 10px; background-color: black; border: solid 3px #00ffff; border-radius: 50px; box-shadow: 0px 0px 20px 2px #00ffff; overflow: hidden; margin: 5px;"><div style="position: relative; left: 0%; top: 0%; height: 10px; width: '.$bar_fencing.'%; background-color: #007F7F;" title="'.$fencing_exp.'/'.$max_fencing_exp.'"></div></div></td></tr>';
		echo '<tr><td style="text-align: left;">Strzelectwo</td><td>'.$shooting_lvl.'</td><td><div title="'.$shooting_exp.'/'.$max_shooting_exp.'" style="width: 100px; height: 10px; background-color: black; border: solid 3px #00ffff; border-radius: 50px; box-shadow: 0px 0px 20px 2px #00ffff; overflow: hidden; margin: 5px;"><div style="position: relative; left: 0%; top: 0%; height: 10px; width: '.$bar_shooting.'%; background-color: #007F7F;" title="'.$shooting_exp.'/'.$max_shooting_exp.'"></div></div></td></tr>';
		echo '<tr><td style="text-align: left;">Skrytobójstwo</td><td>'.$assasination_lvl.'</td><td><div title="'.$assasination_exp.'/'.$max_assasination_exp.'" style="width: 100px; height: 10px; background-color: black; border: solid 3px #00ffff; border-radius: 50px; box-shadow: 0px 0px 20px 2px #00ffff; overflow: hidden; margin: 5px;"><div style="position: relative; left: 0%; top: 0%; height: 10px; width: '.$bar_assasination.'%; background-color: #007F7F;" title="'.$assasination_exp.'/'.$max_assasination_exp.'"></div></div></td></tr>';
		echo '<tr><td style="text-align: left;">Militaria</td><td>'.$military_lvl.'</td><td><div title="'.$military_exp.'/'.$max_military_exp.'" style="width: 100px; height: 10px; background-color: black; border: solid 3px #00ffff; border-radius: 50px; box-shadow: 0px 0px 20px 2px #00ffff; overflow: hidden; margin: 5px;"><div style="position: relative; left: 0%; top: 0%; height: 10px; width: '.$bar_military.'%; background-color: #007F7F;" title="'.$military_exp.'/'.$max_military_exp.'"></div></div></td></tr>';
		echo '<tr><td style="text-align: left;">Brutalność</td><td>'.$brutality_lvl.'</td><td><div title="'.$brutality_exp.'/'.$max_brutality_exp.'" style="width: 100px; height: 10px; background-color: black; border: solid 3px #00ffff; border-radius: 50px; box-shadow: 0px 0px 20px 2px #00ffff; overflow: hidden; margin: 5px;"><div style="position: relative; left: 0%; top: 0%; height: 10px; width: '.$bar_brutality.'%; background-color: #007F7F;" title="'.$brutality_exp.'/'.$max_brutality_exp.'"></div></div></td></tr>';
		
		echo '</table>';
	}
}
?>