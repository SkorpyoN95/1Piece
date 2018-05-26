<?php
	$model = $this->loadModel('techqs');
	$techqs = $model->getTechniques();
	$user_techqs = $model->getUserTechniques();
?>
<table style="border-spacing: 10px;">
	<tr style="font-weight: bolder; font-size: 20px;">
		<td>
			
		</td>
		<td>
			Nazwa
		</td>
		<td>
			Opis
		</td>
		<td>
			DMG
		</td>
		<td>
			Typ
		</td>
		<td style="width: 200px;">
			Bonus
		</td>
	</tr>
	<?php
	for($i = 0; $i < count($techqs); $i++)
	{
		if(in_array($techqs[$i]['id'], $user_techqs)) $sign = 'tick.png';
		else $sign = 'cross.png';
		switch($techqs[$i]['class'])
		{
			case 'fighter': $type = 'Wojownik'; $bonus = 'Technika offensywno - defensywna.'; break;
			case 'swordsman': $type = 'Szermierz'; $bonus = 'Uderzenie krytyczne, szansa: '.$techqs[$i]['param'].'%.'; break;
			case 'rifleman': $type = 'Strzelec'; $bonus = 'Atak dystansowy, dystans: '.$techqs[$i]['param'].'m'; break;
			case 'thief': $type = 'Złodziej'; break;
			case 'cyborg': $type = 'Cyborg'; break;
			case 'beast': $type = 'Bestia'; break;
			case 'special': $type = 'Special'; break;
			default: $type = 'Normal'; $bonus = 'Nie dotyczy.'; break;
		}
		?>
		<tr>
			<td>
				<img style="width: 25px; height: 25px;" src='/templates/img/<?php echo $sign; ?>' />
			</td>
			<td>
				<a href="main.php?action=techqs&techq=<?php echo $techqs[$i]['id']; ?>"><?php echo $techqs[$i]['name']; ?></a>
			</td>
			<td>
				<?php echo $techqs[$i]['description']; ?>
			</td>
			<td>
				<?php echo $techqs[$i]['base_dmg']; ?>
			</td>
			<td>
				<?php echo $type; ?>
			</td>
			<td>
				<?php echo $bonus; ?>
			</td>
		</tr>
		<?php
	}
	?>
</table>