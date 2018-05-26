<?php
include_once 'view/view.php';

class MovesView extends View
{
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
		<select name="eq" size="1" onchange="window.location.href='main.php?action=moves&type=' + this.value;">
		<option value="1" <? if ($type=="1") echo "SELECTED"; ?>>Wojownik</option>
		<option value="2" <? if ($type=="2") echo "SELECTED"; ?>>Szermierz</option>
		<option value="3" <? if ($type=="3") echo "SELECTED"; ?>>Strzelec</option>
		<option value="4" <? if ($type=="4") echo "SELECTED"; ?>>Zabójca</option>
		<option value="5" <? if ($type=="5") echo "SELECTED"; ?>>Cyborg</option>
		</select>
		</form>
		</div>
		
		<table>
			<tr style="font-weight: bolder;">
				<td>Nazwa</td>
				<td>Atak</td>
				<td>Obrona</td>
				<td>Szybkość</td>
				<td>Koszt</td>
				<td><?php echo $type2; ?></td>
				<td title="Wytrzymałość, Intelekt, Silna Wola">W,I,S</td>
			</tr>
			<?php
			$model2 = $this->loadModel('stats');
			$stats = $model2->battleStats();
			for($i = 0; $i < count($wynik); $i++)
			{
			?>
			<tr style="text-align: center;">
				<td><?php echo $wynik[$i]['name']; ?></td>
				<td><?php echo $wynik[$i]['ATK'] * $stats[0]; ?></td>
				<td><?php echo $wynik[$i]['DEF'] * $stats[1]; ?></td>
				<td><?php echo $wynik[$i]['SPD'] + $stats[2]; ?></td>
				<td><?php echo $wynik[$i]['cost']; ?></td>
				<td><?php echo $wynik[$i]['stat1']; ?></td>
				<td><?php echo $wynik[$i]['stat2']; ?></td>
			</tr>
			<?php
			}
			?>
		</table>
		<?php
	}
}
?>