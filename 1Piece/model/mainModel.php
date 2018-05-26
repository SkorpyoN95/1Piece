<?php
include_once 'model/model.php';

class MainModel extends Model
{
	public function newsIcon()
	{
		$info = $this->select('users', 'read_news', 'id='.$_SESSION['zalogowany']);
		return $info[0]['read_news'];
	}
	
	public function checkPW()
	{
		$ddm = $this->select('mailbox', 'id', 'to_id='.$_SESSION['zalogowany'].' AND is_read=0');
		$num = count($ddm);
		return $num;
	}
	
	public function checkLvl()
	{
		$wynik = $this->select('bars', 'act_exp,max_exp', 'id='.$_SESSION['zalogowany']);
		$act_exp = $wynik[0]['act_exp'];
		$max_exp = $wynik[0]['max_exp'];
		
		if($act_exp > $max_exp)
		{
			while($act_exp > $max_exp)
			{
				$wynik = $this->select('bars', 'lvl,max_exp,act_hp,max_hp,act_en,max_en', 'id='.$_SESSION['zalogowany']);
				
				$lvl = $wynik[0]['lvl'];
				$max_hp = $wynik[0]['max_hp'];
				$act_hp = $wynik[0]['act_hp'];
				$max_en = $wynik[0]['max_en'];
				$act_en = $wynik[0]['act_en'];
				$max_exp = $wynik[0]['max_exp'];
				
				$lvl++;
				$skip = (int)($lvl / 10) + 1;
				$max_exp = $skip * $skip * 400 * ($lvl + 1) * ($lvl +2);
				$max_hp += 100;
				$max_en += 50;
				if($act_hp < $max_hp) $act_hp = $max_hp;
				if($act_en < $max_en) $act_en = $max_en;
				
				$stmnt = $this->pdo->prepare("update bars set lvl=?, max_hp=?, act_hp=?, max_en=?, act_en=?, max_exp=? where id=?");
				$stmnt->bindValue(1, $lvl, PDO::PARAM_INT);
				$stmnt->bindValue(2, $max_hp, PDO::PARAM_INT);
				$stmnt->bindValue(3, $act_hp, PDO::PARAM_INT);
				$stmnt->bindValue(4, $max_en, PDO::PARAM_INT);
				$stmnt->bindValue(5, $act_en, PDO::PARAM_INT);
				$stmnt->bindValue(6, $max_exp, PDO::PARAM_INT);
				$stmnt->bindValue(7, $_SESSION['zalogowany'], PDO::PARAM_INT);
				$stmnt->execute();
			}
			return $lvl;
		}
		return 0;
	}
	
	public function regeneration()
	{
		$time = time();
		$wynik = $this->select('bars', 'regen', 'id='.$_SESSION['zalogowany']);
		$time2 = $wynik[0]['regen'];
		
		$bars = $this->select('bars', 'max_hp,act_hp,max_en,act_en,vitality,act_vit', 'id='.$_SESSION['zalogowany']);
		$act_hp = $bars[0]['act_hp'];
		$max_hp = $bars[0]['max_hp'];
		$act_en = $bars[0]['act_en'];
		$max_en = $bars[0]['max_en'];
		$act_vit = $bars[0]['act_vit'];
		$vitality = $bars[0]['vitality'];
		
		$interval = ($time - $time2)/120;
		if($act_hp <= ($max_hp - 20)) 
		{
			$act_hp += (int)$interval * 20;
			if($act_hp > $max_hp) $act_hp = $max_hp;
		}
		if($act_en <= ($max_en - 10))
		{
			$act_en += (int)$interval * 10;
			if($act_en > $max_en) $act_en = $max_en;
		}
		if($act_vit  <= ($vitality - 1)) 
		{
			$act_vit += (int)$interval;
			if($act_vit > $vitality) $act_vit = $vitality;
		}
		
		$time2 += (int)$interval * 120;
		
		$stmnt = $this->pdo->prepare("update bars set act_hp=?, act_en=?, act_vit=?, regen=? where id=?");
		$stmnt->bindValue(1, $act_hp, PDO::PARAM_INT);
		$stmnt->bindValue(2, $act_en, PDO::PARAM_INT);
		$stmnt->bindValue(3, $act_vit, PDO::PARAM_INT);
		$stmnt->bindValue(4, $time2, PDO::PARAM_INT);
		$stmnt->bindValue(5, $_SESSION['zalogowany'], PDO::PARAM_INT);
		$stmnt->execute();
	}
	
	public function online()
	{
		$stmnt = $this->pdo->prepare('update users set online=? where id=?');
		$stmnt->bindValue(1, time(), PDO::PARAM_INT);
		$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
		$stmnt->execute();
	}
	
	public function updateBars()
	{
		$wynik1 = $this->select('bars', 'lvl', 'id='.$_SESSION['zalogowany']);
		$wynik2 = $this->select('body', '*', 'id='.$_SESSION['zalogowany']);
		
		$hp = (int)((1000 + $wynik1[0]['lvl']*100) * (100 + $wynik2[0]['muscles']) / 100);
		$en = (int)((500 + $wynik1[0]['lvl']*50) * (100 + $wynik2[0]['lungs']) / 100);
		$vit = (int)((100 + $wynik1[0]['lvl']*2) * (100 + $wynik2[0]['heart']) / 100);
		
		$stmnt = $this->pdo->prepare("update bars set max_hp=?, max_en=?, vitality=? where id=?");
		$stmnt->bindValue(1, $hp, PDO::PARAM_INT);
		$stmnt->bindValue(2, $en, PDO::PARAM_INT);
		$stmnt->bindValue(3, $vit, PDO::PARAM_INT);
		$stmnt->bindValue(4, $_SESSION['zalogowany'], PDO::PARAM_INT);
		$stmnt->execute();
	}
	
	public function updateBStats()
	{
		$wynik1 = $this->select('b_stats', 'id', 'id='.$_SESSION['zalogowany']);
		if($wynik1[0]['id'] == null)
		{
			$stmnt = $this->pdo->prepare("insert into b_stats values(?,0,0,0,0,0)");
			$stmnt->bindValue(1, $_SESSION['zalogowany'], PDO::PARAM_INT);
			$stmnt->execute();
		}
		
		$wynik2 = $this->select('bars', 'lvl', 'id='.$_SESSION['zalogowany']);
		$wynik3 = $this->select('classes', 'theclass', 'id='.$_SESSION['zalogowany']);
		$increase = array(
					'' => '3,3,3,3,3',
					'warrior' => '3,5,4,2,1',
					'swordsman' => '5,3,1,4,2',
					'rifleman' => '4,2,3,1,5',
					'assasin' => '2,1,5,3,4',
					'cyborg' => '1,4,2,5,3'
					);
					
		$batstats = explode(',', $increase[$wynik3[0]['theclass']]);
		if($wynik2[0]['lvl'] > 10)
		{
			$stats[0] = 40 + ($wynik2[0]['lvl'] - 10) * $batstats[0];
			$stats[1] = 40 + ($wynik2[0]['lvl'] - 10) * $batstats[1];
			$stats[2] = 40 + ($wynik2[0]['lvl'] - 10) * $batstats[2];
			$stats[3] = 40 + ($wynik2[0]['lvl'] - 10) * $batstats[3];
			$stats[4] = 40 + ($wynik2[0]['lvl'] - 10) * $batstats[4];
		}
		else
		{
			$stats[0] = 10 + $wynik2[0]['lvl']*3;
			$stats[1] = 10 + $wynik2[0]['lvl']*3;
			$stats[2] = 10 + $wynik2[0]['lvl']*3;
			$stats[3] = 10 + $wynik2[0]['lvl']*3;
			$stats[4] = 10 + $wynik2[0]['lvl']*3;
		}
		
		$stmnt = $this->pdo->prepare("update b_stats set ATK=?, DEF=?, SPD=?, INTEL=?, CUN=? where id=?");
		$stmnt->bindValue(1, $stats[0], PDO::PARAM_INT);
		$stmnt->bindValue(2, $stats[1], PDO::PARAM_INT);
		$stmnt->bindValue(3, $stats[2], PDO::PARAM_INT);
		$stmnt->bindValue(4, $stats[3], PDO::PARAM_INT);
		$stmnt->bindValue(5, $stats[4], PDO::PARAM_INT);
		$stmnt->bindValue(6, $_SESSION['zalogowany'], PDO::PARAM_INT);
		$stmnt->execute();
	}
}
?>