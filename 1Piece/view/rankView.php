<?php
include_once 'view/view.php';

class RankView extends View
{
	public function showRank($data, $page)
	{
	?>
	<p style='font-size: 30px; text-align: center;'>Ranking graczy:</p>
	<table style='position: relative; left: 160px; width: 400px; text-align: center;'>
		<tr style="font-weight: bolder;">
			<td style='width: 50px;'>Pozycja</td><td style='width: 150px;'>Nick</td><td style='width: 50px;'>Poziom</td><td style='width: 150px;'>Nagroda</td>
		</tr>
		<tr style="height: 10px;"></tr>
		<?php
			for($i = (0 + $page*25); $i < (25 + $page*25) && $i < count($data); $i++)
			{
				?>
				<tr>
					<td>
						<?php echo ($i+1).'.'; ?>
					</td>
					<td>
						<a href='main.php?id=<?php echo $data[$i]['id']; ?>'><?php echo $data[$i]['nickname']; ?></a>
					</td>
					<td>
						<?php echo $data[$i]['lvl']; ?>
					</td>
					<td style="text-align: right;">
						<?php echo $data[$i]['price']; ?><img src="/templates/img/whiteBeli.png" />
					</td>
				</tr>
				<?php
			}
		?>
	</table>
	<p style='text-align: center;'>
	<?php
	for($i = 0; $i <= (int)(count($data)/25); $i++)
			echo '<a href="/main.php?action=rank&page='.$i.'">'.($i + 1).'</a> ';
	?> </p> <?php
	}
}
?>