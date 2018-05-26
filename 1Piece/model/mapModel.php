<?php
include_once 'model/model.php';

class MapModel extends Model
{
	public function buyMeat($meat)
	{
		if($meat > 0)
		{
			$wynik = $this->select('bars', 'gold', 'id='.$_SESSION['zalogowany']);
			$gold = $wynik[0]['gold'];
			$cost = $meat * 100;
			if($cost > $gold) return 'Nie stać Cię na to mięso!';
			$gold -= $cost;
			
			$stmnt = $this->pdo->prepare('update bars set gold=? where id=?');
			$stmnt->bindValue(1, $gold, PDO::PARAM_INT);
			$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
			$stmnt->execute();

			$wynik = $this->select('equipment', 'others', 'id='.$_SESSION['zalogowany']);
			$others = $wynik[0]['others'];
			$items = explode(',', $others);
			for($i = 0; $i < count($items); $i++)
			{
				$info = explode('-', $items[$i]);
				if($info[0] == 1)
				{
					$info[1] += $meat;
					$items[$i] = $info[0].'-'.$info[1];
					for($j = 0; $j < count($items); $j++)	if($items[$j] == '') unset($items[$j]);
					$items2 = implode(',', $items);
						
					$stmnt = $this->pdo->prepare('update equipment set others=? where id=?');
					$stmnt->bindValue(1, $items2, PDO::PARAM_STR);
					$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
					$stmnt->execute();
					break;
				}
				else
					if(count($items) - $i == 1)
					{
						if(count($items) == 10) return 'Brak miejsca na mięso w plecaku.';
						$items[] = '1-'.$meat;
						for($j = 0; $j < count($items); $j++)	if($items[$j] == '') unset($items[$j]);
						$items2 = implode(',', $items);
							
						$stmnt = $this->pdo->prepare('update equipment set others=? where id=?');
						$stmnt->bindValue(1, $items2, PDO::PARAM_STR);
						$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
						$stmnt->execute();
						break;
					}
				}
			
			return 'Oto pańskie '.$meat.' sztuk mięsa. Zapraszamy ponownie.';
		}
	}
	
	public function buySake($sake)
	{
		if($sake > 0)
		{
			$wynik = $this->select('bars', 'gold', 'id='.$_SESSION['zalogowany']);
			$gold = $wynik[0]['gold'];
			$cost = $sake * 50;
			if($cost > $gold) return 'Nie stać Cię na tą sake!';
			$gold -= $cost;
			
			$stmnt = $this->pdo->prepare('update bars set gold=? where id=?');
			$stmnt->bindValue(1, $gold, PDO::PARAM_INT);
			$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
			$stmnt->execute();

			$wynik = $this->select('equipment', 'others', 'id='.$_SESSION['zalogowany']);
			$others = $wynik[0]['others'];
			$items = explode(',', $others);
			for($i = 0; $i < count($items); $i++)
			{
				$info = explode('-', $items[$i]);
				if($info[0] == 2)
				{
					$info[1] += $sake;
					$items[$i] = $info[0].'-'.$info[1];
					for($j = 0; $j < count($items); $j++)	if($items[$j] == '') unset($items[$j]);
					$items2 = implode(',', $items);
						
					$stmnt = $this->pdo->prepare('update equipment set others=? where id=?');
					$stmnt->bindValue(1, $items2, PDO::PARAM_STR);
					$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
					$stmnt->execute();
					break;
				}
				else
					if(count($items) - $i == 1)
					{
						if(count($items) == 10) return 'Brak miejsca na sake w plecaku.';
						$items[] = '2-'.$sake;
						for($j = 0; $j < count($items); $j++)	if($items[$j] == '') unset($items[$j]);
						$items2 = implode(',', $items);
							
						$stmnt = $this->pdo->prepare('update equipment set others=? where id=?');
						$stmnt->bindValue(1, $items2, PDO::PARAM_STR);
						$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
						$stmnt->execute();
						break;
					}
			}
				
			return 'Oto pańskie '.$sake.' butelek sake. Zapraszamy ponownie.';
		}
	}
	
	public function startTrain($hours, $weight, $atr)
	{
		$price = array(
					'str' => 50,
					'dex' => 40,
					'stam' => 60,
					'ment' => 25,
					'will' => 75,
					'ref' => 55,
					'acc' => 65,
					'ins' => 45
					);
		$wynik = $this->select('bars', 'act_vit, gold', 'id='.$_SESSION['zalogowany']);		
		$vit = $wynik[0]['act_vit'];
		$vit_cost = $weight * $hours * 0.70;
		$gold = $wynik[0]['gold'];
		$gold_cost = $hours * $price[$atr];
		if($vit_cost > $vit) return 'Jesteś zbyt zmęczony, aby podjąć ten trening';
		if($gold_cost > $gold) return 'Nie stać Cię na ten trening.';
		
		$end = time() + $hours*3600;
		$stmnt = $this->pdo->prepare("update training set is_train=true,type=?,param=?,hours=?,end=? where id=?");
		$stmnt->bindValue(1, $atr, PDO::PARAM_STR);
		$stmnt->bindValue(2, $weight, PDO::PARAM_INT);
		$stmnt->bindValue(3, $hours, PDO::PARAM_INT);
		$stmnt->bindValue(4, $end, PDO::PARAM_INT);
		$stmnt->bindValue(5, $_SESSION['zalogowany'], PDO::PARAM_INT);
		$stmnt->execute();
		
		$consumed = $gold - $gold_cost;
		$stmnt = $this->pdo->prepare('update bars set gold=? where id=?');
		$stmnt->bindValue(1, $consumed, PDO::PARAM_INT);
		$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
		$stmnt->execute();
		
		return '';
	}
	
	public function breakTraining()
	{
		$stmnt = $this->pdo->prepare("update training set is_train=false,type='',param=0,hours=0,end=0 where id=?");
		$stmnt->bindValue(1, $_SESSION['zalogowany'], PDO::PARAM_INT);
		$stmnt->execute();
	}
	
	public function sellItems($items, $gold)
	{
					$items = $_POST['items'];
					$gold = $_POST['gold'];
					//echo '<script>alert("'.$items.$gold.'");</script>';
					$info = explode('|', $items);
					$itemek = $info[0];
					$itemy = explode(',', $info[1]);
					$wynik = $this->select('bars', 'gold', 'id='.$_SESSION['zalogowany']);
					$us_gold = $wynik[0]['gold'];
					$us_gold += $gold;
					
					$stmnt = $this->pdo->prepare('update bars set gold=? where id=?');
					$stmnt->bindValue(1, $us_gold, PDO::PARAM_INT);
					$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
					$stmnt->execute();
					
					$wynik = $this->select('equipment', $itemek, 'id='.$_SESSION['zalogowany']);
					$itemek2 = $wynik[0][$itemek];
					$item2 = explode(',', $itemek2);
					for($i = 0; $i < count($itemy);$i++)
					unset($item2[$itemy[$i]]);
					$itemki = implode(',', $item2);
					$stmnt = $this->pdo->prepare('update equipment set '.$itemek.'=? where id=?');
					$stmnt->bindValue(1, $itemki, PDO::PARAM_STR);
					$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
					$stmnt->execute();
	}
	
	public function startBattle($habit)
	{
		$wynikx = $this->select('fights', 'is_pvm', 'id='.$_SESSION['zalogowany']);
		$is_pvm = $wynikx[0]['is_pvm'];
		
		$wyniky = $this->select('bars', 'act_vit,act_hp', 'id='.$_SESSION['zalogowany']);
		$vit= $wyniky[0]['act_vit'];
		$hp = $wyniky[0]['act_hp'];
		
		if($hp == 0) return;
		if($vit < $habit) return;
		if($is_pvm == 1) return;
	
		$wynik = $this->select('bars', 'lvl', 'id='.$_SESSION['zalogowany']);
		$p_lvl = $wynik[0]['lvl'];
		
		$m_id = rand($habit*3 - 2, $habit*3);
		$wynik2 = $this->select('enemies', 'theclass', 'id='.$m_id);
		$m_class = $wynik[0]['theclass'];
		
		$m_lvl = rand($p_lvl + 1 + ($habit - 1)*5, $habit*($p_lvl + 5));
		
		$increase = array(
					'beast' => '4,4,3,2,2',
					'warrior' => '3,5,4,2,1',
					'swordsman' => '5,3,1,4,2',
					'rifleman' => '4,2,3,1,5',
					'assasin' => '2,1,5,3,4',
					'cyborg' => '1,4,2,5,3'
					);
					
		$batstats = explode(',', $increase[$wynik2[0]['theclass']]);
		
		$stats[0] = $m_lvl * $batstats[0];
		$stats[1] = $m_lvl * $batstats[1];
		$stats[2] = $m_lvl * $batstats[2];
		$stats[3] = $m_lvl * $batstats[3];
		$stats[4] = $m_lvl * $batstats[4];
		
		$m_hp = 1000 + $m_lvl * 100;
		$m_en = 500 + $m_lvl * 50;
		
		$stmnt = $this->pdo->prepare('update fights set is_pvm=1, opponent=?, habitat=?, opp_lvl=?, opp_hp=?, opp_en=?, mob_atk=?, mob_def=?, mob_spd=?, mob_int=?, mob_cun=? where id=?');
		$stmnt->bindValue(1, $m_id, PDO::PARAM_INT);
		$stmnt->bindValue(2, $habit, PDO::PARAM_INT);
		$stmnt->bindValue(3, $m_lvl, PDO::PARAM_INT);
		$stmnt->bindValue(4, $m_hp, PDO::PARAM_INT);
		$stmnt->bindValue(5, $m_en, PDO::PARAM_INT);
		$stmnt->bindValue(6, $stats[0], PDO::PARAM_INT);
		$stmnt->bindValue(7, $stats[1], PDO::PARAM_INT);
		$stmnt->bindValue(8, $stats[2], PDO::PARAM_INT);
		$stmnt->bindValue(9, $stats[3], PDO::PARAM_INT);
		$stmnt->bindValue(10, $stats[4], PDO::PARAM_INT);
		$stmnt->bindValue(11, $_SESSION['zalogowany'], PDO::PARAM_INT);
		$stmnt->execute();
		
		$stmnt = $this->pdo->prepare('update bars set act_vit=? where id=?');
		$stmnt->bindValue(1, $vit - $habit, PDO::PARAM_INT);
		$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
		$stmnt->execute();
	}
}
?>