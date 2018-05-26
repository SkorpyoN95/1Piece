<?php
include_once 'view/view.php';

class ChatView extends View
{
	public function index($msgs, $page = 0)
	{
		$model = $this->loadModel('chat');
		?>
		<p></p>
		<div style="width: 305px;">
		<?php
		for($i = 0 + $page*10; $i < 10 + $page*10; $i++)
		{
		$id = $msgs[$i]['id'];
		$nick = $msgs[$i]['author'];
		$wynik = $model->select('users', 'nickname', 'id='.$nick);
		$author = $wynik[0]['nickname'];
		$text = $model->censore($msgs[$i]['text']);
		$text2 = $model->links($text);
		$text3 = $model->emots($text2);
		$time =  $msgs[$i]['date'];
		$data = date("d.m H:i", $time);
		$style='';
		if($nick == 1) $style = 'color: #dd7700;';
		echo '<div style="position: relative; border-bottom: solid 1px #ffff00; color: #ffffff; margin: 10px 0px;"><a style="'.$style.' font-size: 14px; font-weight: bolder;" href="/main.php?id='.$nick.'">'.$author.':</a><p style="display: inline; position: absolute; top: -15px; right: 10px; text-align: right;">'.$data.'</p><p>'.$text3.'</p></div>';
		}

		?>
		</div>
		<p style='text-align: center;'>
		<?php
		$ile = count($msgs);
		if($ile == 100) $ile = 99;
		for($i = 0; $i <= (int)($ile/10); $i++)
			echo '<a href="/main.php?chat='.$i.'">'.($i + 1).'</a>   ';
		?>
		</p>
		<?php
	}
}
?>