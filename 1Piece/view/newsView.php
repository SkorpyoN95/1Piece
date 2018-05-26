<?php
include_once 'view/view.php';

class NewsView extends View
{
	public function listOfNews($data)
	{
		$model = $this->loadModel('news');
		$wynik = $model->select('users', 'read_news', 'id='.$_SESSION['zalogowany']);
		$read_news = explode(',', $wynik[0]['read_news']);

		echo '<div style="position: relative; width: 420px; margin: 0px auto;"><table>';
		echo '<tr style="font-weight: bolder; font-size: 20px;"><td>Stan</td><td>Tytuł</td><td>Dodał:</td><td>Data</td></tr>';
		for($i = count($data) - 1; $i >= 0; $i--)
		{
			if(in_array($data[$i]['id'], $read_news) == true) $read = '1';
			else $read = '0';
			?>
			<tr>
				<td style="width: 30px;">
					<img style="width: 30px; height: 30px;" src="/templates/img/newspaper<?php echo $read; ?>.png" />
				</td>
				<td style="width: 140px;">
					<a href='main.php?action=news&pon=<?php echo $data[$i]['id'];?>'><?php echo $data[$i]['title'];?></a>
				</td>
				<td style="width: 140px;">
					<?php echo $data[$i]['autor'];?>
				</td>
				<td style="width: 140px;">
					<?php echo date('d.m.Y h:i', $data[$i]['date']);?>
				</td>
			</tr>
			<?php
		}
		echo '</table></div>';
	}
}
?>