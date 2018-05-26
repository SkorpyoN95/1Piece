<?php
include_once 'model/model.php';

class StatsModel extends Model
{
	public function getStats()
	{
		return $this->select('statistics', '*', 'id='.$_SESSION['zalogowany']);
	}
	
	public function checkStats()
	{
		$stats = $this->getStats();
		
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
		
		$display = false;
		$text = 'Rezultat treningu:<br>';
		
		while($str_exp >= $max_str_exp) 
		{
		$display = true;
		$str_lvl++;
		$max_str_exp = 25 * ($str_lvl + 1) * ($str_lvl + 2);
		$stmnt = $this->pdo->prepare("update statistics set str_lvl=?, max_str_exp=? where id=?");
		$stmnt->bindValue(1,$str_lvl,PDO::PARAM_INT);
		$stmnt->bindValue(2,$max_str_exp,PDO::PARAM_INT);
		$stmnt->bindValue(3,$_SESSION['zalogowany'],PDO::PARAM_INT);
		$stmnt->execute();
		$text .= 'Rozwinąłeś siłę na '.$str_lvl.' poziom.<br>';
		}
		
		while($dex_exp >= $max_dex_exp) 
		{
		$display = true;
		$dex_lvl++;
		$max_dex_exp = 25 * ($dex_lvl + 1) * ($dex_lvl + 2);
		$stmnt = $this->pdo->prepare("update statistics set dex_lvl=?, max_dex_exp=? where id=?");
		$stmnt->bindValue(1,$dex_lvl,PDO::PARAM_INT);
		$stmnt->bindValue(2,$max_dex_exp,PDO::PARAM_INT);
		$stmnt->bindValue(3,$_SESSION['zalogowany'],PDO::PARAM_INT);
		$stmnt->execute();
		$text .= 'Rozwinąłeś zwinność na '.$dex_lvl.' poziom.<br>';
		}
		
		while($stam_exp >= $max_stam_exp) 
		{
		$display = true;
		$stam_lvl++;
		$max_stam_exp = 25 * ($stam_lvl + 1) * ($stam_lvl + 2);
		$stmnt = $this->pdo->prepare("update statistics set stam_lvl=?, max_stam_exp=? where id=?");
		$stmnt->bindValue(1,$stam_lvl,PDO::PARAM_INT);
		$stmnt->bindValue(2,$max_stam_exp,PDO::PARAM_INT);
		$stmnt->bindValue(3,$_SESSION['zalogowany'],PDO::PARAM_INT);
		$stmnt->execute();
		$text .= 'Rozwinąłeś wytrzymałość na '.$stam_lvl.' poziom.<br>';
		}
		
		while($ment_exp >= $max_ment_exp) 
		{
		$display = true;
		$ment_lvl++;
		$max_ment_exp = 25 * ($ment_lvl + 1) * ($ment_lvl + 2);
		$stmnt = $this->pdo->prepare("update statistics set ment_lvl=?, max_ment_exp=? where id=?");
		$stmnt->bindValue(1,$ment_lvl,PDO::PARAM_INT);
		$stmnt->bindValue(2,$max_ment_exp,PDO::PARAM_INT);
		$stmnt->bindValue(3,$_SESSION['zalogowany'],PDO::PARAM_INT);
		$stmnt->execute();
		$text .= 'Rozwinąłeś intelekt na '.$ment_lvl.' poziom.<br>';
		}
		
		while($will_exp >= $max_will_exp) 
		{
		$display = true;
		$will_lvl++;
		$max_will_exp = 25 * ($will_lvl + 1) * ($will_lvl + 2);
		$stmnt = $this->pdo->prepare("update statistics set will_lvl=?, max_will_exp=? where id=?");
		$stmnt->bindValue(1,$will_lvl,PDO::PARAM_INT);
		$stmnt->bindValue(2,$max_will_exp,PDO::PARAM_INT);
		$stmnt->bindValue(3,$_SESSION['zalogowany'],PDO::PARAM_INT);
		$stmnt->execute();
		$text .= 'Rozwinąłeś swoją wolę na '.$will_lvl.' poziom.<br>';
		}
		
		while($ref_exp >= $max_ref_exp) 
		{
		$display = true;
		$ref_lvl++;
		$max_ref_exp = 25 * ($ref_lvl + 1) * ($ref_lvl + 2);
		$stmnt = $this->pdo->prepare("update statistics set ref_lvl=?, max_ref_exp=? where id=?");
		$stmnt->bindValue(1,$ref_lvl,PDO::PARAM_INT);
		$stmnt->bindValue(2,$max_ref_exp,PDO::PARAM_INT);
		$stmnt->bindValue(3,$_SESSION['zalogowany'],PDO::PARAM_INT);
		$stmnt->execute();
		$text .= 'Rozwinąłeś refleks na '.$ref_lvl.' poziom.<br>';
		}
		
		while($acc_exp >= $max_acc_exp) 
		{
		$display = true;
		$acc_lvl++;
		$max_acc_exp = 25 * ($acc_lvl + 1) * ($acc_lvl + 2);
		$stmnt = $this->pdo->prepare("update statistics set acc_lvl=?, max_acc_exp=? where id=?");
		$stmnt->bindValue(1,$acc_lvl,PDO::PARAM_INT);
		$stmnt->bindValue(2,$max_acc_exp,PDO::PARAM_INT);
		$stmnt->bindValue(3,$_SESSION['zalogowany'],PDO::PARAM_INT);
		$stmnt->execute();
		$text .= 'Rozwinąłeś celność na '.$acc_lvl.' poziom.<br>';
		}
		
		while($ins_exp >= $max_ins_exp) 
		{
		$display = true;
		$ins_lvl++;
		$max_ins_exp = 25 * ($ins_lvl + 1) * ($ins_lvl + 2);
		$stmnt = $this->pdo->prepare("update statistics set ins_lvl=?, max_ins_exp=? where id=?");
		$stmnt->bindValue(1,$ins_lvl,PDO::PARAM_INT);
		$stmnt->bindValue(2,$max_ins_exp,PDO::PARAM_INT);
		$stmnt->bindValue(3,$_SESSION['zalogowany'],PDO::PARAM_INT);
		$stmnt->execute();
		$text .= 'Rozwinąłeś instynkt na '.$ins_lvl.' poziom.<br>';
		}
		
		if($display) return $text;
		else return null;
	}
	
	public function checkProfs()
	{
		$profs = $this->select('proficiency', '*', 'id='.$_SESSION['zalogowany']);
		
		$combat_lvl = $profs[0]['combat_lvl'];
		$fencing_lvl = $profs[0]['fencing_lvl'];
		$shooting_lvl = $profs[0]['shooting_lvl'];
		$assasination_lvl = $profs[0]['assasination_lvl'];
		$military_lvl = $profs[0]['military_lvl'];
		$combat_exp = $profs[0]['combat_exp'];
		$fencing_exp = $profs[0]['fencing_exp'];
		$shooting_exp = $profs[0]['shooting_exp'];
		$assasination_exp = $profs[0]['assasination_exp'];
		$military_exp = $profs[0]['military_exp'];
		$max_combat_exp = $profs[0]['max_combat_exp'];
		$max_fencing_exp = $profs[0]['max_fencing_exp'];
		$max_shooting_exp = $profs[0]['max_shooting_exp'];
		$max_assasination_exp = $profs[0]['max_assasination_exp'];
		$max_military_exp = $profs[0]['max_military_exp'];
		
		$display = false;
		$text = 'W ogniu ciągłych walk podciągnąłeś swoje umiejętności:<br>';
		
		while($combat_exp >= $max_combat_exp) 
		{
		$display = true;
		$combat_lvl++;
		$max_combat_exp = 1000 * ($combat_lvl + 1) * ($combat_lvl + 2);
		$stmnt = $this->pdo->prepare("update proficiency set combat_lvl=?, max_combat_exp=? where id=?");
		$stmnt->bindValue(1,$combat_lvl,PDO::PARAM_INT);
		$stmnt->bindValue(2,$max_combat_exp,PDO::PARAM_INT);
		$stmnt->bindValue(3,$_SESSION['zalogowany'],PDO::PARAM_INT);
		$stmnt->execute();
		$text .= 'Rozwinąłeś Walkę w zwarciu na '.$combat_lvl.' poziom.<br>';
		}
		
		while($fencing_exp >= $max_fencing_exp) 
		{
		$display = true;
		$fencing_lvl++;
		$max_fencing_exp = 1000 * ($fencing_lvl + 1) * ($fencing_lvl + 2);
		$stmnt = $this->pdo->prepare("update proficiency set fencing_lvl=?, max_fencing_exp=? where id=?");
		$stmnt->bindValue(1,$fencing_lvl,PDO::PARAM_INT);
		$stmnt->bindValue(2,$max_fencing_exp,PDO::PARAM_INT);
		$stmnt->bindValue(3,$_SESSION['zalogowany'],PDO::PARAM_INT);
		$stmnt->execute();
		$text .= 'Rozwinąłeś Fechtunek na '.$fencing_lvl.' poziom.<br>';
		}
		
		while($shooting_exp >= $max_shooting_exp) 
		{
		$display = true;
		$shooting_lvl++;
		$max_shooting_exp = 1000 * ($shooting_lvl + 1) * ($shooting_lvl + 2);
		$stmnt = $this->pdo->prepare("update proficiency set shooting_lvl=?, max_shooting_exp=? where id=?");
		$stmnt->bindValue(1,$shooting_lvl,PDO::PARAM_INT);
		$stmnt->bindValue(2,$max_shooting_exp,PDO::PARAM_INT);
		$stmnt->bindValue(3,$_SESSION['zalogowany'],PDO::PARAM_INT);
		$stmnt->execute();
		$text .= 'Rozwinąłeś Strzelectwo na '.$shooting_lvl.' poziom.<br>';
		}
		
		while($assasination_exp >= $max_assasination_exp) 
		{
		$display = true;
		$assasination_lvl++;
		$max_assasination_exp = 1000 * ($assasination_lvl + 1) * ($assasination_lvl + 2);
		$stmnt = $this->pdo->prepare("update proficiency set assasination_lvl=?, max_assasination_exp=? where id=?");
		$stmnt->bindValue(1,$assasination_lvl,PDO::PARAM_INT);
		$stmnt->bindValue(2,$max_assasination_exp,PDO::PARAM_INT);
		$stmnt->bindValue(3,$_SESSION['zalogowany'],PDO::PARAM_INT);
		$stmnt->execute();
		$text .= 'Rozwinąłeś Skrytobójstwo na '.$assasination_lvl.' poziom.<br>';
		}
		
		while($military_exp >= $max_military_exp) 
		{
		$display = true;
		$military_lvl++;
		$max_military_exp = 1000 * ($military_lvl + 1) * ($military_lvl + 2);
		$stmnt = $this->pdo->prepare("update proficiency set military_lvl=?, max_military_exp=? where id=?");
		$stmnt->bindValue(1,$military_lvl,PDO::PARAM_INT);
		$stmnt->bindValue(2,$max_military_exp,PDO::PARAM_INT);
		$stmnt->bindValue(3,$_SESSION['zalogowany'],PDO::PARAM_INT);
		$stmnt->execute();
		$text .= 'Rozwinąłeś Militaria na '.$military_lvl.' poziom.<br>';
		}
		
		if($display) return $text;
		else return null;
	}
	
	public function endOfTraining()
	{
		$text = '';
		$tr_info = $this->select('training', '*', 'id='.$_SESSION['zalogowany']);
		$end = $tr_info[0]['end'];
		$now = time();
		if($now >= $end)
		{
			$type = $tr_info[0]['type'];
			$param = $tr_info[0]['param'];
			$hours = $tr_info[0]['hours'];
			
			$point = $param * $hours + 500;
			$chance = rand(1, 5000);
			if($point >= $chance && $param != 0 && $hours != 0)
			{
				$var = rand(1, 10);
				if($var >= 1 && $var < 7) {$body = 'muscles'; $text = 'Czujesz wzrost swoich mięśni. <p style="color: #ff0000; text-align: center;">Zdrowie: +';}
				if($var >= 7 && $var < 10) {$body = 'lungs'; $text = 'Czujesz wzrost pojemności swoich płuc. <p style="color: #ff0000; text-align: center;">Energia: +';}
				if($var == 10) {$body = 'heart'; $text = 'Czujesz wzrost wydolności swojego serca. <p style="color: #ff0000; text-align: center;">Witalność: +';}

				$var2 = rand(1, 10);
				if($var2 >= 1 && $var2 < 7) $add = 1;
				if($var2 >= 7 && $var2 < 10) $add = 2;
				if($var2 == 10) $add = 3;
				
				$text .= $add.'%</p>';
				
				$wynik = $this->select('body', $body, 'id='.$_SESSION['zalogowany']);
				$wynik[0][$body] += $add;
				
				$stmnt = $this->pdo->prepare('update body set '.$body.'=?  where id=?');
				$stmnt->bindValue(1, $wynik[0][$body], PDO::PARAM_INT);
				$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
				$stmnt->execute();
			}
			
			$stats = $this->getStats();
			$str_exp = $stats[0]['str_exp'];
			$dex_exp = $stats[0]['dex_exp'];
			$stam_exp = $stats[0]['stam_exp'];
			$ment_exp = $stats[0]['ment_exp'];
			$will_exp = $stats[0]['will_exp'];
			$ref_exp = $stats[0]['ref_exp'];
			$acc_exp = $stats[0]['acc_exp'];
			$ins_exp = $stats[0]['ins_exp'];
			
			switch($type)
			{
			case 'str':
				$str = $param * $hours * 16;
				$stam = $param * $hours * 3;
				$ins = $param * $hours * 3;
				$will = $param * $hours * 3;
				
				$stmnt = $this->pdo->prepare('update statistics set str_exp=?, stam_exp=?, ins_exp=?, will_exp=?  where id=?');
				$stmnt->bindValue(1,$str_exp + $str,PDO::PARAM_INT);
				$stmnt->bindValue(2,$stam_exp + $stam,PDO::PARAM_INT);
				$stmnt->bindValue(3,$ins_exp + $ins,PDO::PARAM_INT);
				$stmnt->bindValue(4,$will_exp + $will,PDO::PARAM_INT);
				$stmnt->bindValue(5,$_SESSION['zalogowany'],PDO::PARAM_INT);
				$stmnt->execute();
			break;
			
			case 'dex':
				$dex = $param * $hours * 16;
				$stam = $param * $hours * 3;
				$ins = $param * $hours * 3;
				$will = $param * $hours * 3;
				
				$stmnt = $this->pdo->prepare('update statistics set dex_exp=?, stam_exp=?, ins_exp=?, will_exp=? where id=?');
				$stmnt->bindValue(1,$dex_exp + $dex,PDO::PARAM_INT);
				$stmnt->bindValue(2,$stam_exp + $stam,PDO::PARAM_INT);
				$stmnt->bindValue(3,$ins_exp + $ins,PDO::PARAM_INT);
				$stmnt->bindValue(4,$will_exp + $will,PDO::PARAM_INT);
				$stmnt->bindValue(5,$_SESSION['zalogowany'],PDO::PARAM_INT);
				$stmnt->execute();
			break;
			
			case 'stam':
				$stam = $param * $hours * 25;
				$will = $param * $hours * 9;
				$ins = $param * $hours * 4;
				
				$stmnt = $this->pdo->prepare('update statistics set ins_exp=?, stam_exp=?, will_exp=? where id=?');
				$stmnt->bindValue(1,$ins_exp + $ins,PDO::PARAM_INT);
				$stmnt->bindValue(2,$stam_exp + $stam,PDO::PARAM_INT);
				$stmnt->bindValue(3,$will_exp + $will,PDO::PARAM_INT);
				$stmnt->bindValue(4,$_SESSION['zalogowany'],PDO::PARAM_INT);
				$stmnt->execute();
			break;
			
			case 'ment':
				$ment = $param * $hours * 16;
				$stam = $param * $hours * 3;
				$ins = $param * $hours * 3;
				$will = $param * $hours * 3;
				
				$stmnt = $this->pdo->prepare('update statistics set ment_exp=?, stam_exp=?, ins_exp=?, will_exp=? where id=?');
				$stmnt->bindValue(1,$ment_exp + $ment,PDO::PARAM_INT);
				$stmnt->bindValue(2,$stam_exp + $stam,PDO::PARAM_INT);
				$stmnt->bindValue(3,$ins_exp + $ins,PDO::PARAM_INT);
				$stmnt->bindValue(4,$will_exp + $will,PDO::PARAM_INT);
				$stmnt->bindValue(5,$_SESSION['zalogowany'],PDO::PARAM_INT);
				$stmnt->execute();
			break;
			
			case 'will':
				$will = $param * $hours * 25;
				$ins = $param * $hours * 9;
				$stam = $param * $hours * 4;
				
				$stmnt = $this->pdo->prepare('update statistics set stam_exp=?, ins_exp=?, will_exp=? where id=?');
				$stmnt->bindValue(1,$stam_exp + $stam,PDO::PARAM_INT);
				$stmnt->bindValue(2,$ins_exp + $ins,PDO::PARAM_INT);
				$stmnt->bindValue(3,$will_exp + $will,PDO::PARAM_INT);
				$stmnt->bindValue(4,$_SESSION['zalogowany'],PDO::PARAM_INT);
				$stmnt->execute();	
			break;
			
			case 'ref':
				$ref = $param * $hours * 16;
				$stam = $param * $hours * 3;
				$ins = $param * $hours * 3;
				$will = $param * $hours * 3;
				
				$stmnt = $this->pdo->prepare('update statistics set ref_exp=?, stam_exp=?, ins_exp=?, will_exp=? where id=?');
				$stmnt->bindValue(1,$ref_exp + $ref,PDO::PARAM_INT);
				$stmnt->bindValue(2,$stam_exp + $stam,PDO::PARAM_INT);
				$stmnt->bindValue(3,$ins_exp + $ins,PDO::PARAM_INT);
				$stmnt->bindValue(4,$will_exp + $will,PDO::PARAM_INT);
				$stmnt->bindValue(5,$_SESSION['zalogowany'],PDO::PARAM_INT);
				$stmnt->execute();	
			break;
			
			case 'acc':
				$acc = $param * $hours * 16;
				$stam = $param * $hours * 3;
				$ins = $param * $hours * 3;
				$will = $param * $hours * 3;
				
				$stmnt = $this->pdo->prepare('update statistics set acc_exp=?, stam_exp=?, ins_exp=?, will_exp=? where id=?');
				$stmnt->bindValue(1,$acc_exp + $acc,PDO::PARAM_INT);
				$stmnt->bindValue(2,$stam_exp + $stam,PDO::PARAM_INT);
				$stmnt->bindValue(3,$ins_exp + $ins,PDO::PARAM_INT);
				$stmnt->bindValue(4,$will_exp + $will,PDO::PARAM_INT);
				$stmnt->bindValue(5,$_SESSION['zalogowany'],PDO::PARAM_INT);
				$stmnt->execute();	
			break;
			
			case 'ins':
				$ins = $param * $hours * 25;
				$stam = $param * $hours * 9;
				$will = $param * $hours * 4;
				
				$stmnt = $this->pdo->prepare('update statistics set ins_exp=?, stam_exp=?, will_exp=? where id=?');
				$stmnt->bindValue(1,$ins_exp + $ins,PDO::PARAM_INT);
				$stmnt->bindValue(2,$stam_exp + $stam,PDO::PARAM_INT);
				$stmnt->bindValue(3,$will_exp + $will,PDO::PARAM_INT);
				$stmnt->bindValue(4,$_SESSION['zalogowany'],PDO::PARAM_INT);
				$stmnt->execute();	
			break;
			
			default: break;
			}
			$stmnt = $this->pdo->prepare("update training set is_train=false,type='',param=0,hours=0,end=0 where id=?");
			$stmnt->bindValue(1,$_SESSION['zalogowany'],PDO::PARAM_INT);
			$stmnt->execute();
			$cost = $param * $hours * 0.7;
			$wynik = $this->select('bars', 'act_vit', 'id='.$_SESSION['zalogowany']);
			$act_vit = $wynik[0]['act_vit'];
			$act_vit -= $cost;
			$stmnt = $this->pdo->prepare("update bars set act_vit=? where id=?");
			$stmnt->bindValue(1,$act_vit,PDO::PARAM_INT);
			$stmnt->bindValue(2,$_SESSION['zalogowany'],PDO::PARAM_INT);
			$stmnt->execute();
			
		}
		
		return $text;
	}
	
	public function checkStatsArray()
	{
		$wynik = $this->select('body', '*', 'id='.$_SESSION['zalogowany']);
		if($wynik[0]['id'] == null)
		{
			$stmnt = $this->pdo->prepare('insert into body values(?,0,0,0)');
			$stmnt->bindValue(1, $_SESSION['zalogowany'], PDO::PARAM_INT);
			$stmnt->execute();
		}
		
		$wynik2 = $this->select('proficiency', '*', 'id='.$_SESSION['zalogowany']);
		if($wynik2[0]['id'] == null)
		{
			$stmnt = $this->pdo->prepare('insert into proficiency values(?,0,0,1000,0,0,1000,0,0,1000,0,0,1000,0,0,1000,0,0,1000)');
			$stmnt->bindValue(1, $_SESSION['zalogowany'], PDO::PARAM_INT);
			$stmnt->execute();
		}
	}
	
	public function battleStats()
	{
		$wynik2 = $this->select('b_stats', '*', 'id='.$_SESSION['zalogowany']);
		
		$stats[0] = $wynik2[0]['ATK'];
		$stats[1] = $wynik2[0]['DEF'];
		$stats[2] = $wynik2[0]['SPD'];
		$stats[3] = $wynik2[0]['INTEL'];
		$stats[4] = $wynik2[0]['CUN'];
		
		return $stats;
	}
}
?>