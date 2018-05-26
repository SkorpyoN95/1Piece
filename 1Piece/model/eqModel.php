<?php
include_once 'model/model.php';

class EqModel extends Model
{
	public function wearItem($wear)
	{
		/*$item = explode('/', $wear);
		switch($item[0])
		{
			case 1: $part2='all_head'; $part3='head'; break;
			case 2: $part2='all_body'; $part3='body'; break;
			case 3: $part2='all_legs'; $part3='legs'; break;
			case 4: $part2='all_shoes'; $part3='shoes'; break;
			case 5: $part2='jewellery'; 
					$wynik = $this->select('equipment', $part2, 'id='.$_SESSION['zalogowany']);
					$itemek = $wynik[0][$part2];
					$item2 = explode(',', $itemek);
					$item_to_eq = $item2[$item[1]];
					$item3 = explode('-', $item_to_eq);
					$wynik2 = $this->select('items', 'part', 'id='.$item3[0]);
					$part4 = $wynik2[0]['part'];
					if($part4 == 'necklace') $part3 = 'necklace';
					if($part4 == 'ring')
					{
						$wynik = $this->select('equipment', 'ring1', 'id='.$_SESSION['zalogowany']);
						$itemek = $wynik[0]['ring1'];
						if($itemek == '') $part3 = 'ring1';
						else $part3 = 'ring2';
					}
					if($part4 == 'bracelet')
					{
						$wynik = $this->select('equipment', 'bracelet1', 'id='.$_SESSION['zalogowany']);
						$itemek = $wynik[0]['bracelet1'];
						if($itemek == '') $part3 = 'bracelet1';
						else $part3 = 'bracelet2';
					}
					break;
			case 6: $part2='all_hand'; 
					$wynik = $this->select('equipment', 'right_hand', 'id='.$_SESSION['zalogowany']);
					$itemek = $wynik[0]['right_hand'];
					if($itemek == '') $part3 = 'right_hand';
					else $part3 = 'left_hand';
					break;
			case 7: $part2='others'; $part3='head'; break;
			default: break;
		}
		$wynik = $this->select('equipment', $part3, 'id='.$_SESSION['zalogowany']);
		$itemek = $wynik[0][$part3];
		if($itemek != '') return "Slot zajęty!";
		else
		{
			$wynik = $this->select('equipment', $part2, 'id='.$_SESSION['zalogowany']);
			$itemek = $wynik[0][$part2];
			$item2 = explode(',', $itemek);
			$item_to_eq = $item2[$item[1]];
			$item3 = explode('-', $item_to_eq);
			$wynik = $this->select('bars', 'lvl', 'id='.$_SESSION['zalogowany']);
			$lvl = $wynik[0]['lvl'];
			if($item3[1] > $lvl) return "Twój poziom jest za mały!";
			else
			{
				$ilvl = $item3[1];
				$wynik = $this->select('items', 'atr', 'id='.$item3[0]);
				$iatr = $wynik[0]['atr'];
				
				$wynik = $this->select('statistics', 'add_'.$iatr, 'id='.$_SESSION['zalogowany']);
				$add = $wynik[0]['add_'.$iatr];
				$add += $ilvl;
				
				$stmnt = $this->pdo->prepare('update statistics set add_'.$iatr.'=? where id=?');
				$stmnt->bindValue(1, $add, PDO::PARAM_INT);
				$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
				$stmnt->execute();
				
				unset($item2[$item[1]]);
				$itemy = implode(',', $item2);
				$stmnt = $this->pdo->prepare('update equipment set '.$part3.'=?,'.$part2.'=? where id=?');
				$stmnt->bindValue(1, $item_to_eq, PDO::PARAM_STR);
				$stmnt->bindValue(2, $itemy, PDO::PARAM_STR);
				$stmnt->bindValue(3, $_SESSION['zalogowany'], PDO::PARAM_INT);
				$stmnt->execute();
			}
		}
		return (int)$item[0];
		*/
	}
	
	public function dropItem($drop)
	{
	/*
		switch($drop)
		{
			case 'he': $part3='head'; $part2='all_head'; $part = 1; break;
			case 'ne': $part3='necklace'; $part2='jewellery'; $part = 5; break;
			case 'bo': $part3='body'; $part2='all_body'; $part = 2; break;
			case 'le': $part3='legs'; $part2='all_legs'; $part = 3; break;
			case 'sh': $part3='shoes'; $part2='all_shoes'; $part = 4; break;
			case 'rh': $part3='right_hand'; $part2='all_hand'; $part = 6; break;
			case 'lh': $part3='left_hand'; $part2='all_hand'; $part = 6; break;
			case 'r1': $part3='ring1'; $part2='jewellery'; $part = 5; break;
			case 'r2': $part3='ring2'; $part2='jewellery'; $part = 5; break;
			case 'b1': $part3='bracelet1'; $part2='jewellery'; $part = 5; break;
			case 'b2': $part3='bracelet2'; $part2='jewellery'; $part = 5; break;
			default: break;
		}
		
		$wynik = $this->select('equipment', $part2, 'id='.$_SESSION['zalogowany']);
		$itemek = $wynik[0][$part2];
		$item = explode(',', $itemek);
		if(count($item) == 10) return "Nie masz miejsca w plecaku!";
		else
		{
			$wynik = $this->select('equipment', $part2.','.$part3, 'id='.$_SESSION['zalogowany']);
			$itemek = $wynik[0][$part3];
			$itemek2 = $wynik[0][$part2];
			$item2 = explode(',', $itemek2);
			for($i = 0; $i < count($item2); $i++) if($item2[$i] == '') unset($item2[$i]);
			$item2[] = $itemek;
			$itemy = implode(',', $item2);
			
			$item3 = explode('-', $itemek);
			$ilvl = $item3[1];
			$wynik = $this->select('items', 'atr', 'id='.$item3[0]);
			$iatr = $wynik[0]['atr'];
			
			$wynik = $this->select('statistics', 'add_'.$iatr, 'id='.$_SESSION['zalogowany']);
			$add = $wynik[0]['add_'.$iatr];
			$add -= $ilvl;
				
			$stmnt = $this->pdo->prepare('update statistics set add_'.$iatr.'=? where id=?');
			$stmnt->bindValue(1, $add, PDO::PARAM_INT);
			$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
			$stmnt->execute();
			
			$stmnt = $this->pdo->prepare('update equipment set '.$part3.'="",'.$part2.'=? where id=?');
			$stmnt->bindValue(1, $itemy, PDO::PARAM_STR);
			$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
			$stmnt->execute();
		}
		
		return (int)$part;
		*/
	}
	
	public function useItem($use)
	{
		$wynik = $this->select('equipment', 'others', 'id='.$_SESSION['zalogowany']);
		$itemek = $wynik[0]['others'];
		$item = explode(',', $itemek);
		$item2 = $item[$use];
		$info = explode('-', $item2);
		$wynik2 = $this->select('usable_items', 'type,effect', 'id='.$info[0]);
		$type = $wynik2[0]['type'];
		$effect = explode('+', $wynik2[0]['effect']);
		switch($type)
		{
			case 'food': switch($effect[0])
							{
								case 'hp': $hp = $this->select('bars', 'act_hp, max_hp', 'id='.$_SESSION['zalogowany']);
											if($hp[0]['act_hp'] == $hp[0]['max_hp']) return 'Jesteś pełen i nie zmieścisz już ani okruszka!';
											else 
												if(($hp[0]['max_hp'] - $hp[0]['act_hp']) < $effect[1]) $new_hp = $hp[0]['max_hp'];
												else $new_hp = $hp[0]['act_hp'] + $effect[1];
											
											$stmnt = $this->pdo->prepare('update bars set act_hp=? where id=?');
											$stmnt->bindValue(1, $new_hp, PDO::PARAM_INT);
											$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
											$stmnt->execute();
											
											$info[1]--;
											if($info[1] == 0)
											{
												unset($item[$use]);
												$eq_val = implode(',', $item);
											}
											else
											{
												$item[$use] = $info[0].'-'.$info[1];
												$eq_val = implode(',', $item);
											}
											
											$stmnt = $this->pdo->prepare('update equipment set others=? where id=?');
											$stmnt->bindValue(1, $eq_val, PDO::PARAM_STR);
											$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
											$stmnt->execute();
											break;
											
								case 'en': $en = $this->select('bars', 'act_en, max_en', 'id='.$_SESSION['zalogowany']);
											if($en[0]['act_en'] == $en[0]['max_en']) return 'Rozpiera Cię energia, większa ilość alkoholu skończyłaby się źle.';
											else 
												if(($en[0]['max_en'] - $en[0]['act_en']) < $effect[1]) $new_en = $en[0]['max_en'];
												else $new_en = $en[0]['act_en'] + $effect[1];
											
											$stmnt = $this->pdo->prepare('update bars set act_en=? where id=?');
											$stmnt->bindValue(1, $new_en, PDO::PARAM_INT);
											$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
											$stmnt->execute();
											
											$info[1]--;
											if($info[1] == 0)
											{
												unset($item[$use]);
												$eq_val = implode(',', $item);
											}
											else
											{
												$item[$use] = $info[0].'-'.$info[1];
												$eq_val = implode(',', $item);
											}
											
											$stmnt = $this->pdo->prepare('update equipment set others=? where id=?');
											$stmnt->bindValue(1, $eq_val, PDO::PARAM_STR);
											$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
											$stmnt->execute();
											break;
								default: return 'Nieznane działanie przedmiotu. Lepiej poinformuj o tym Administratora.'; break;
							}
							break;
			default: return 'Nieznany typ przedmiotu. Lepiej poinformuj o tym Administratora.'; break;
		}
	}
}
?>