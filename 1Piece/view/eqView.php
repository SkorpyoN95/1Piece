<?php
include_once 'view/view.php';

class EqView extends View
{
	public function showEq($part = 1)
	{
		$model = $this->loadModel('eq');
		?>
		<div style='position: relative; height: 200px;'>
		<p style="position: absolute; left: 20px; top: 20px; font-size: 20pt; font-weight: bolder;">Twoje przedmioty: </p>
		<form style="position: absolute; left: 245px; top: 50px;">
		<select name="eq" size="1" onchange="window.location.href='main.php?action=eq&part=' + this.value;">
		<option value="1" <? if ($part=="1") echo "SELECTED"; ?>>Nakrycia glowy</option>
		<option value="2" <? if ($part=="2") echo "SELECTED"; ?>>Okrycia korpusu</option>
		<option value="3" <? if ($part=="3") echo "SELECTED"; ?>>Nogawice</option>
		<option value="4" <? if ($part=="4") echo "SELECTED"; ?>>Buty</option>
		<option value="5" <? if ($part=="5") echo "SELECTED"; ?>>Bizuteria</option>
		<option value="6" <? if ($part=="6") echo "SELECTED"; ?>>Dlon</option>
		<option value="7" <? if ($part=="7") echo "SELECTED"; ?>>Pozostale</option>
		</select>
		</form>
		<?

		switch($part)
		{
			case 1: $part2='all_head'; break;
			case 2: $part2='all_body'; break;
			case 3: $part2='all_legs'; break;
			case 4: $part2='all_shoes'; break;
			case 5: $part2='jewellery'; break;
			case 6: $part2='all_hand'; break;
			case 7: $part2='others'; break;
			default: break;
		}
				$wynik = $model->select('equipment',$part2, 'id='.$_SESSION['zalogowany']);
				$itemek = $wynik[0][$part2];
				$item = explode(',', $itemek);
				$ile = count($item);
				if($itemek == '') $ile = 0;
				for($i = 0; $i < $ile; $i++)
				{
					if($i / 7 > 1.0) $add_top = 110;
					else $add_top = 0;
					$info = explode('-', $item[$i]);
					if($part == 7)
					{
						$iid = $info[0];
						$icount = $info[1];
						$wynik2 = $model->select('usable_items', 'name,type,effect', 'id='.$iid);
						$avatar = 'templates/img/EQ/'.$wynik2[0]['name'].'.png';
						$name = $wynik2[0]['name'];
						switch($wynik2[0]['type'])
						{
							case 'food': $type = "Zywność"; break;
						}
						$effect = explode('+', $wynik2[0]['effect']);
						switch($effect[0])
						{
							case 'hp': $comm = 'Zwiększa punkty życia'; break;
							case 'en': $comm = 'Zwiększa punkty energii'; break;
						}
						$bonus = $effect[1];
						?><div class="slot2" id="s<? echo $i; ?>" style="position: absolute; left: <? echo (15 + 70*$i); ?>px; top: 100px;"><p style='position: absolute; right: 5px; margin-bottom: 0px; bottom: 0px; color: #ff0000; font-weight: bolder; font-size: 20px;'><?php echo $icount; ?></p><img style="cursor:pointer;" src="<? echo $avatar; ?>" width="60" height="60" onclick="window.location.href='main.php?action=eq&use=<? echo $i; ?>';" onmouseover="$('#desc').css('display','block'); $('#name').html('Nazwa: <? echo $name; ?>'); $('#lvl').html('Bonus: <? echo $bonus; ?>'); $('#atr').html('Typ: <? echo $type; ?>'); $('#comm').html('<? echo $comm; ?>');" onmouseout="$('#desc').css('display','none');"/></div><?
					}
					else
					{
						$iid = $info[0];
						$ilvl = $info[1];
						$wynik2 = $model->select('items', 'name,atr', 'id='.$iid);
						$avatar = 'templates/img/EQ/'.$wynik2[0]['name'].'.jpg';
						$name = $wynik2[0]['name'];
						$iatr = $wynik2[0]['atr'];
						if($iatr == 'str') $atr = 'Siła';
						if($iatr == 'dex') $atr = 'Zręczność';
						if($iatr == 'stam') $atr = 'Wytrzymałość';
						if($iatr == 'ment') $atr = 'Siła duchowa';
						if($iatr == 'con') $atr = 'Kondycja';
						?><div class="slot2" id="s<? echo $i; ?>" style="position: absolute; left: <? echo (15 + 70*$i); ?>px; top: 100px;"><img style="cursor:pointer;" src="<? echo $avatar; ?>" width="60" height="60" onclick="window.location.href='main.php?action=eq&wear=<? echo $part.'/'.$i; ?>';" onmouseover="$('#desc').css('display','block'); $('#name').html('Nazwa: <? echo $name; ?>'); $('#lvl').html('Bonus: <? echo $ilvl; ?>'); $('#atr').html('Atrybut: <? echo $atr; ?>');" onmouseout="$('#desc').css('display','none');"/></div><?
					}
				}
				for($i = 9; $i >= $ile; $i--)
				{
					?><div class="slot2" id="s<? echo $i; ?>" style="position: absolute; left: <? echo (15 + 70*$i); ?>px; top: 100px;"></div><?
				}
				
		?>
		</div>
		<div style='position: relative;'>
			<img style="position: relative; opacity: 0.5;" src="/templates/img/EQ/enel.png" />
			
			<div id="desc" style="position: absolute; left: 50px; top: 20px; display: none; border: solid 5px #1a1a1a; background-color: #a0a0a0; opacity: 0.8; height: 100px; width: 600px;">
			<p id="name" style="position: absolute; left: 10px; top: 10px; font-size: 14;"></p>
			<p id="lvl" style="position: absolute; left: 10px; top: 50px; font-size: 12;"></p>
			<p id="atr" style="position: absolute; left: 300px; top: 10px; font-size: 12;"></p>
			<p id="comm" style="position: absolute; left: 300px; top: 50px; font-size: 12;"></p>
			</div>
			<?
			$wynik3 = $model->select('equipment', 'head,body,legs,shoes,left_hand,right_hand,necklace,ring1,ring2,bracelet1,bracelet2', 'id='.$_SESSION['zalogowany']);
			$he = $wynik3[0]['head'];
			$bo = $wynik3[0]['body'];
			$le = $wynik3[0]['legs'];
			$sh = $wynik3[0]['shoes'];
			$lh = $wynik3[0]['left_hand'];
			$rh = $wynik3[0]['right_hand'];
			$ne = $wynik3[0]['necklace'];
			$r1 = $wynik3[0]['ring1'];
			$r2 = $wynik3[0]['ring2'];
			$b1 = $wynik3[0]['bracelet1'];
			$b2 = $wynik3[0]['bracelet2'];
			?>
			<div class="slot" style="position: absolute; left: 0px; top: 380px;">
			<?
			if($r1 != '')
			{
				$info = explode('-', $r1);
				$iid = $info[0];
				$ilvl = $info[1];
				$wynik2 = $model->select('items', 'name,atr', 'id='.$iid);
					$avatar = 'templates/img/EQ/'.$wynik2[0]['name'].'.jpg';
					$name = $wynik2[0]['name'];
					$iatr = $wynik2[0]['atr'];
				if($iatr == 'str') $atr = 'Siła';
				if($iatr == 'dex') $atr = 'Zręczność';
				if($iatr == 'stam') $atr = 'Wytrzymałość';
				if($iatr == 'ment') $atr = 'Siła duchowa';
				if($iatr == 'con') $atr = 'Kondycja';
				?><img style="cursor:pointer;" src="<? echo $avatar; ?>" width="90" height="90" onclick="window.location.href='main.php?action=eq&drop=r1';" onmouseover="$('#desc').css('display','block'); $('#name').html('Nazwa: <? echo $name; ?>'); $('#lvl').html('Bonus: <? echo $ilvl; ?>'); $('#atr').html('Atrybut: <? echo $atr; ?>');" onmouseout="$('#desc').css('display','none');"/><?
				
			}
			?>
			</div>
			<div class="slot" style="position: absolute; left: 100px; top: 380px;">
			<?
			if($rh != '')
			{
				$info = explode('-', $rh);
				$iid = $info[0];
				$ilvl = $info[1];
				$wynik2 = $model->select('items', 'name,atr', 'id='.$iid);
					$avatar = 'templates/img/EQ/'.$wynik2[0]['name'].'.jpg';
					$name = $wynik2[0]['name'];
					$iatr = $wynik2[0]['atr'];
				if($iatr == 'str') $atr = 'Siła';
				if($iatr == 'dex') $atr = 'Zręczność';
				if($iatr == 'stam') $atr = 'Wytrzymałość';
				if($iatr == 'ment') $atr = 'Siła duchowa';
				if($iatr == 'con') $atr = 'Kondycja';
				?><img style="cursor:pointer; " src="<? echo $avatar; ?>" width="90" height="90" onclick="window.location.href='main.php?action=eq&drop=rh';" onmouseover="$('#desc').css('display','block'); $('#name').html('Nazwa: <? echo $name; ?>'); $('#lvl').html('Bonus: <? echo $ilvl; ?>'); $('#atr').html('Atrybut: <? echo $atr; ?>');" onmouseout="$('#desc').css('display','none');"/><?
				
			}
			?>
			</div>
			<div class="slot" style="position: absolute; left: 200px; top: 310px;">
			<?
			if($b1 != '')
			{
				$info = explode('-', $b1);
				$iid = $info[0];
				$ilvl = $info[1];
				$wynik2 = $model->select('items', 'name,atr', 'id='.$iid);
					$avatar = 'templates/img/EQ/'.$wynik2[0]['name'].'.jpg';
					$name = $wynik2[0]['name'];
					$iatr = $wynik2[0]['atr'];
				if($iatr == 'str') $atr = 'Siła';
				if($iatr == 'dex') $atr = 'Zręczność';
				if($iatr == 'stam') $atr = 'Wytrzymałość';
				if($iatr == 'ment') $atr = 'Siła duchowa';
				if($iatr == 'con') $atr = 'Kondycja';
				?><img style="cursor:pointer; " src="<? echo $avatar; ?>" width="90" height="90" onclick="window.location.href='main.php?action=eq&drop=b1';" onmouseover="$('#desc').css('display','block'); $('#name').html('Nazwa: <? echo $name; ?>'); $('#lvl').html('Bonus: <? echo $ilvl; ?>'); $('#atr').html('Atrybut: <? echo $atr; ?>');" onmouseout="$('#desc').css('display','none');"/><?
				
			}
			?>
			</div>
			<div class="slot" style="position: absolute; left: 375px; top: 200px;">
			<?
			if($he != '')
			{
				$info = explode('-', $he);
				$iid = $info[0];
				$ilvl = $info[1];
				$wynik2 = $model->select('items', 'name,atr', 'id='.$iid);
					$avatar = 'templates/img/EQ/'.$wynik2[0]['name'].'.jpg';
					$name = $wynik2[0]['name'];
					$iatr = $wynik2[0]['atr'];
				if($iatr == 'str') $atr = 'Siła';
				if($iatr == 'dex') $atr = 'Zręczność';
				if($iatr == 'stam') $atr = 'Wytrzymałość';
				if($iatr == 'ment') $atr = 'Siła duchowa';
				if($iatr == 'con') $atr = 'Kondycja';
				?><img style="cursor:pointer; " src="<? echo $avatar; ?>" width="90" height="90" onclick="window.location.href='main.php?action=eq&drop=he';" onmouseover="$('#desc').css('display','block'); $('#name').html('Nazwa: <? echo $name; ?>'); $('#lvl').html('Bonus: <? echo $ilvl; ?>'); $('#atr').html('Atrybut: <? echo $atr; ?>');" onmouseout="$('#desc').css('display','none');"/><?
				
			}
			?>
			</div>
			<div class="slot" style="position: absolute; left: 375px; top: 310px;"><?
			if($ne != '')
			{
				$info = explode('-', $ne);
				$iid = $info[0];
				$ilvl = $info[1];
				$wynik2 = $model->select('items', 'name,atr', 'id='.$iid);
					$avatar = 'templates/img/EQ/'.$wynik2[0]['name'].'.jpg';
					$name = $wynik2[0]['name'];
					$iatr = $wynik2[0]['atr'];
				if($iatr == 'str') $atr = 'Siła';
				if($iatr == 'dex') $atr = 'Zręczność';
				if($iatr == 'stam') $atr = 'Wytrzymałość';
				if($iatr == 'ment') $atr = 'Siła duchowa';
				if($iatr == 'con') $atr = 'Kondycja';
				?><img style="cursor:pointer; " src="<? echo $avatar; ?>" width="90" height="90" onclick="window.location.href='main.php?action=eq&drop=ne';" onmouseover="$('#desc').css('display','block'); $('#name').html('Nazwa: <? echo $name; ?>'); $('#lvl').html('Bonus: <? echo $ilvl; ?>'); $('#atr').html('Atrybut: <? echo $atr; ?>');" onmouseout="$('#desc').css('display','none');"/><?
				
			}
			?>
			</div>
			<div class="slot" style="position: absolute; left: 375px; top: 410px;"><?
			if($bo != '')
			{
				$info = explode('-', $bo);
				$iid = $info[0];
				$ilvl = $info[1];
				$wynik2 = $model->select('items', 'name,atr', 'id='.$iid);
					$avatar = 'templates/img/EQ/'.$wynik2[0]['name'].'.jpg';
					$name = $wynik2[0]['name'];
					$iatr = $wynik2[0]['atr'];
				if($iatr == 'str') $atr = 'Siła';
				if($iatr == 'dex') $atr = 'Zręczność';
				if($iatr == 'stam') $atr = 'Wytrzymałość';
				if($iatr == 'ment') $atr = 'Siła duchowa';
				if($iatr == 'con') $atr = 'Kondycja';
				?><img style="cursor:pointer; " src="<? echo $avatar; ?>" width="90" height="90" onclick="window.location.href='main.php?action=eq&drop=bo';" onmouseover="$('#desc').css('display','block'); $('#name').html('Nazwa: <? echo $name; ?>'); $('#lvl').html('Bonus: <? echo $ilvl; ?>'); $('#atr').html('Atrybut: <? echo $atr; ?>');" onmouseout="$('#desc').css('display','none');"/><?
				
			}
			?>
			</div>
			<div class="slot" style="position: absolute; left: 375px; top: 610px;"><?
			if($le != '')
			{
				$info = explode('-', $le);
				$iid = $info[0];
				$ilvl = $info[1];
				$wynik2 = $model->select('items', 'name,atr', 'id='.$iid);
					$avatar = 'templates/img/EQ/'.$wynik2[0]['name'].'.jpg';
					$name = $wynik2[0]['name'];
					$iatr = $wynik2[0]['atr'];
				if($iatr == 'str') $atr = 'Siła';
				if($iatr == 'dex') $atr = 'Zręczność';
				if($iatr == 'stam') $atr = 'Wytrzymałość';
				if($iatr == 'ment') $atr = 'Siła duchowa';
				if($iatr == 'con') $atr = 'Kondycja';
				?><img style="cursor:pointer; " src="<? echo $avatar; ?>" width="90" height="90" onclick="window.location.href='main.php?action=eq&drop=le';" onmouseover="$('#desc').css('display','block'); $('#name').html('Nazwa: <? echo $name; ?>'); $('#lvl').html('Bonus: <? echo $ilvl; ?>'); $('#atr').html('Atrybut: <? echo $atr; ?>');" onmouseout="$('#desc').css('display','none');"/><?
				
			}
			?>
			</div>
			<div class="slot" style="position: absolute; left: 375px; top: 850px;"><?
			if($sh != '')
			{
				$info = explode('-', $sh);
				$iid = $info[0];
				$ilvl = $info[1];
				$wynik2 = $model->select('items', 'name,atr', 'id='.$iid);
					$avatar = 'templates/img/EQ/'.$wynik2[0]['name'].'.jpg';
					$name = $wynik2[0]['name'];
					$iatr = $wynik2[0]['atr'];
				if($iatr == 'str') $atr = 'Siła';
				if($iatr == 'dex') $atr = 'Zręczność';
				if($iatr == 'stam') $atr = 'Wytrzymałość';
				if($iatr == 'ment') $atr = 'Siła duchowa';
				if($iatr == 'con') $atr = 'Kondycja';
				?><img style="cursor:pointer; " src="<? echo $avatar; ?>" width="90" height="90" onclick="window.location.href='main.php?action=eq&drop=sh';" onmouseover="$('#desc').css('display','block'); $('#name').html('Nazwa: <? echo $name; ?>'); $('#lvl').html('Bonus: <? echo $ilvl; ?>'); $('#atr').html('Atrybut: <? echo $atr; ?>');" onmouseout="$('#desc').css('display','none');"/><?
				
			}
			?>
			</div>
			<div class="slot" style="position: absolute; left: 550px; top: 360px;">
			<?
			if($b2 != '')
			{
				$info = explode('-', $b2);
				$iid = $info[0];
				$ilvl = $info[1];
				$wynik2 = $model->select('items', 'name,atr', 'id='.$iid);
					$avatar = 'templates/img/EQ/'.$wynik2[0]['name'].'.jpg';
					$name = $wynik2[0]['name'];
					$iatr = $wynik2[0]['atr'];
				if($iatr == 'str') $atr = 'Siła';
				if($iatr == 'dex') $atr = 'Zręczność';
				if($iatr == 'stam') $atr = 'Wytrzymałość';
				if($iatr == 'ment') $atr = 'Siła duchowa';
				if($iatr == 'con') $atr = 'Kondycja';
				?><img style="cursor:pointer; " src="<? echo $avatar; ?>" width="90" height="90" onclick="window.location.href='main.php?action=eq&drop=b2';" onmouseover="$('#desc').css('display','block'); $('#name').html('Nazwa: <? echo $name; ?>'); $('#lvl').html('Bonus: <? echo $ilvl; ?>'); $('#atr').html('Atrybut: <? echo $atr; ?>');" onmouseout="$('#desc').css('display','none');"/><?
				
			}
			?>
			</div>
			<div class="slot" style="position: absolute; left: 475px; top: 480px;">
			<?
			if($lh != '')
			{
				$info = explode('-', $lh);
				$iid = $info[0];
				$ilvl = $info[1];
				$wynik2 = $model->select('items', 'name,atr', 'id='.$iid);
					$avatar = 'templates/img/EQ/'.$wynik2[0]['name'].'.jpg';
					$name = $wynik2[0]['name'];
					$iatr = $wynik2[0]['atr'];
				if($iatr == 'str') $atr = 'Siła';
				if($iatr == 'dex') $atr = 'Zręczność';
				if($iatr == 'stam') $atr = 'Wytrzymałość';
				if($iatr == 'ment') $atr = 'Siła duchowa';
				if($iatr == 'con') $atr = 'Kondycja';
				?><img style="cursor:pointer; " src="<? echo $avatar; ?>" width="90" height="90" onclick="window.location.href='main.php?action=eq&drop=lh';" onmouseover="$('#desc').css('display','block'); $('#name').html('Nazwa: <? echo $name; ?>'); $('#lvl').html('Bonus: <? echo $ilvl; ?>'); $('#atr').html('Atrybut: <? echo $atr; ?>');" onmouseout="$('#desc').css('display','none');"/><?
				
			}
			?>
			</div>
			<div class="slot" style="position: absolute; left: 575px; top: 480px;">
			<?
			if($r2 != '')
			{
				$info = explode('-', $r2);
				$iid = $info[0];
				$ilvl = $info[1];
				$wynik2 = $model->select('items', 'name,atr', 'id='.$iid);
					$avatar = 'templates/img/EQ/'.$wynik2[0]['name'].'.jpg';
					$name = $wynik2[0]['name'];
					$iatr = $wynik2[0]['atr'];
				if($iatr == 'str') $atr = 'Siła';
				if($iatr == 'dex') $atr = 'Zręczność';
				if($iatr == 'stam') $atr = 'Wytrzymałość';
				if($iatr == 'ment') $atr = 'Siła duchowa';
				if($iatr == 'con') $atr = 'Kondycja';
				?><img style="cursor:pointer; " src="<? echo $avatar; ?>" width="90" height="90" onclick="window.location.href='main.php?action=eq&drop=r2';" onmouseover="$('#desc').css('display','block'); $('#name').html('Nazwa: <? echo $name; ?>'); $('#lvl').html('Bonus: <? echo $ilvl; ?>'); $('#atr').html('Atrybut: <? echo $atr; ?>');" onmouseout="$('#desc').css('display','none');"/><?
				
			}
			?>
			</div>
		</div>
		<?
	}
}
?>