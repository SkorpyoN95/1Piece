<?php
include_once 'model/model.php';

class FightModel extends Model
{
	public function attack($tech)
	{
		$exp_table = Array(
					'warrior' => 'combat_exp',
					'swordsman' => 'fencing_exp',
					'rifleman' => 'shooting_exp',
					'assasin' => 'assasination_exp',
					'cyborg' => 'military_exp'
					);
					
		$profs = Array(
					'warrior' => 'combat_lvl',
					'swordsman' => 'fencing_lvl',
					'rifleman' => 'shooting_lvl',
					'assasin' => 'assasination_lvl',
					'cyborg' => 'military_lvl'
					);
					
		for($i = 0; $i < count($tech); $i++)
		{
			if($tech[$i] != 0) $tech2[] = $this->select('moves', '*', 'id='.$tech[$i]);
		}
		
		$sum_atk = 0;
		$sum_def = 0;
		$sum_cost = 0;
		
		for($i = 0; $i < count($tech2); $i++)
		{
			$sum_atk += $tech2[$i][0]['ATK'];
			$sum_def += $tech2[$i][0]['DEF'];
			$sum_cost += $tech2[$i][0]['cost'];
			$spds[] = $tech2[$i][0]['SPD'];
		}
		
		$min_spd = min($spds);
		$model = $this->loadModel('stats');
		$stats = $model->battleStats();
		
		$atk = $sum_atk * $stats[0];
		$def = $sum_def * $stats[1];
		$spd = $min_spd + $stats[2];
		
		$wynik = $this->select('fights', '*', 'id='.$_SESSION['zalogowany']);
		$wynik2 = $this->select('enemies', 'theclass', 'id='.$wynik[0]['opponent']);
		$wynik3 = $this->select('moves', '*', 'type="'.$wynik2[0]['theclass'].'"');
		$wynik4 = $this->select('bars', 'act_hp, act_en', 'id='.$_SESSION['zalogowany']);
		$t = rand(0, count($wynik3) - 1);
		
		$m_atk = $wynik[0]['mob_atk'] * $wynik3[$t]['ATK'];
		$m_def = $wynik[0]['mob_def'] * $wynik3[$t]['DEF'];
		$m_spd = $wynik[0]['mob_spd'] + $wynik3[$t]['SPD'];
		$m_cost = $wynik3[$t]['cost'];
		
		$type = $exp_table[$tech2[0][0]['type']];
		$prof = $profs[$tech2[0][0]['type']];
		
		$wynik5 = $this->select('proficiency', $type, 'id='.$_SESSION['zalogowany']);
		$wynik6 = $this->select('proficiency', $prof, 'id='.$_SESSION['zalogowany']);
		
		if($stats[2] == $wynik[0]['mob_spd']) $ch = 5;
		if($stats[2] > $wynik[0]['mob_spd']) $ch = 1;
		if($stats[2] < $wynik[0]['mob_spd']) $ch = 9;
		
		$q = rand(1, 10);
		if($ch > $q) 
		{
			$p_en = $wynik4[0]['act_en'];
			if($p_en >= $sum_cost)
			{
				$atk *= ((100 + $wynik6[0][$prof]) / 100);
				$dmg_on_m = $atk - $m_def;
				if($dmg_on_m < 0) $dmg_on_m = 0;
				$m_hp = $wynik[0]['opp_hp'] - $dmg_on_m;
				if($m_hp < 0) $m_hp = 0;
				$stmnt = $this->pdo->prepare('update proficiency set '.$type.'=? where id=?');
				$stmnt->bindValue(1, $wynik5[0][$type] + $dmg_on_m, PDO::PARAM_INT);
				$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
				$stmnt->execute();
				$stmnt = $this->pdo->prepare('update fights set opp_hp=? where id=?');
				$stmnt->bindValue(1, $m_hp, PDO::PARAM_INT);
				$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
				$stmnt->execute();
				$stmnt = $this->pdo->prepare('update bars set act_en=? where id=?');
				$stmnt->bindValue(1, $p_en - $sum_cost , PDO::PARAM_INT);
				$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
				$stmnt->execute();
			}
			
			if($this->checkBattleStatus() == 1) return;
			
			$m_en = $wynik[0]['opp_en'];
			if($m_en >= $m_cost)
			{
				$dmg_on_p = $m_atk - $def;
				if($dmg_on_p < 0) $dmg_on_p = 0;
				$p_hp = $wynik4[0]['act_hp'] - $dmg_on_p;
				if($p_hp < 0) $p_hp = 0;
				$stmnt = $this->pdo->prepare('update bars set act_hp=? where id=?');
				$stmnt->bindValue(1, $p_hp, PDO::PARAM_INT);
				$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
				$stmnt->execute();
				$stmnt = $this->pdo->prepare('update fights set opp_en=? where id=?');
				$stmnt->bindValue(1, $m_en - $m_cost , PDO::PARAM_INT);
				$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
				$stmnt->execute();
			}
		}
		else
		{
			$m_en = $wynik[0]['opp_en'];
			if($m_en >= $m_cost)
			{
				$dmg_on_p = $m_atk - $def;
				if($dmg_on_p < 0) $dmg_on_p = 0;
				$p_hp = $wynik4[0]['act_hp'] - $dmg_on_p;
				if($p_hp < 0) $p_hp = 0;
				$stmnt = $this->pdo->prepare('update bars set act_hp=? where id=?');
				$stmnt->bindValue(1, $p_hp, PDO::PARAM_INT);
				$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
				$stmnt->execute();
				$stmnt = $this->pdo->prepare('update fights set opp_en=? where id=?');
				$stmnt->bindValue(1, $m_en - $m_cost , PDO::PARAM_INT);
				$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
				$stmnt->execute();
			}
			
			if($this->checkBattleStatus() == 1) return;
			
			$p_en = $wynik4[0]['act_en'];
			if($p_en >= $sum_cost)
			{
				$atk *= ((100 + $wynik6[0][$prof]) / 100);
				$dmg_on_m = $atk - $m_def;
				if($dmg_on_m < 0) $dmg_on_m = 0;
				$m_hp = $wynik[0]['opp_hp'] - $dmg_on_m;
				if($m_hp < 0) $m_hp = 0;
				$stmnt = $this->pdo->prepare('update proficiency set '.$type.'=? where id=?');
				$stmnt->bindValue(1, $wynik5[0][$type] + $dmg_on_m, PDO::PARAM_INT);
				$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
				$stmnt->execute();
				$stmnt = $this->pdo->prepare('update fights set opp_hp=? where id=?');
				$stmnt->bindValue(1, $m_hp, PDO::PARAM_INT);
				$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
				$stmnt->execute();
				$stmnt = $this->pdo->prepare('update bars set act_en=? where id=?');
				$stmnt->bindValue(1, $p_en - $sum_cost , PDO::PARAM_INT);
				$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
				$stmnt->execute();
			}
		}
	}
	
	public function checkBattleStatus()
	{
		$p_hp = $this->select('bars', 'act_hp', 'id='.$_SESSION['zalogowany']);
		$m_hp = $this->select('fights', 'opp_hp', 'id='.$_SESSION['zalogowany']);
		$is_pvm = $this->select('fights', 'is_pvm', 'id='.$_SESSION['zalogowany']);
		
		if($is_pvm[0]['is_pvm'] == 0) return 0;
		
		if($p_hp[0]['act_hp'] == 0)
		{
			$stmnt = $this->pdo->prepare('update fights set is_end=1 where id=?');
			$stmnt->bindValue(1, $_SESSION['zalogowany'], PDO::PARAM_INT);
			$stmnt->execute();
			return 1;
		}
		else
			if($m_hp[0]['opp_hp'] == 0)
			{
				$stmnt = $this->pdo->prepare('update fights set is_end=1,win=1 where id=?');
				$stmnt->bindValue(1, $_SESSION['zalogowany'], PDO::PARAM_INT);
				$stmnt->execute();
				return 1;
			}
			else
				return 0;
	}
	
	public function endOfBattle()
	{
		$wynik = $this->select('fights', 'is_end,win,opp_lvl', 'id='.$_SESSION['zalogowany']);
		if($wynik[0]['is_end'] == 0) return 0;
		
		if($wynik[0]['win'] == 1)
		{
			$wynik2 = $this->select('bars', 'act_exp,gold', 'id='.$_SESSION['zalogowany']);
			$exp = $wynik[0]['opp_lvl'] * 15 + $wynik2[0]['act_exp'];
			$gold = $wynik[0]['opp_lvl'] * 25 + $wynik2[0]['gold'];
			
			$stmnt = $this->pdo->prepare('update bars set act_exp=?,gold=? where id=?');
			$stmnt->bindValue(1, $exp, PDO::PARAM_INT);
			$stmnt->bindValue(2, $gold, PDO::PARAM_INT);
			$stmnt->bindValue(3, $_SESSION['zalogowany'], PDO::PARAM_INT);
			$stmnt->execute();
		}
		
		$stmnt = $this->pdo->prepare('update fights set is_pvm=0,opponent=0,habitat=0,opp_lvl=0,opp_hp=0,opp_en=0,win=0,is_end=0,mob_atk=0,mob_def=0,mob_spd=0,mob_int=0,mob_cun=0 where id=?');
		$stmnt->bindValue(1, $_SESSION['zalogowany'], PDO::PARAM_INT);
		$stmnt->execute();
		
		return 1;
	}
}
?>