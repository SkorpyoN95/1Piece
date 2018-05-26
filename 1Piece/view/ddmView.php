<?php
include_once 'view/view.php';

class DdmView extends View
{
	public function ddmMenu()
	{
		$model = $this->loadModel('ddm');
		$sys = $model->select('mailbox', 'id', 'to_id='.$_SESSION['zalogowany'].' AND from_id=0 AND is_read=0');
		$hm_sys = count($sys);
		$ppl = $model->select('mailbox', 'id', 'to_id='.$_SESSION['zalogowany'].' AND from_id>0 AND is_read=0');
		$hm_ppl = count($ppl);
		if($hm_sys) $color1 = "#ff0000";
		else $color1 = "#ffffff";
		if($hm_ppl) $color2 = "#ff0000";
		else $color2 = "#ffffff";
		echo '<p style="position: relative; word-spacing: 1.5cm; text-align: center;">
				<a style="word-spacing: normal;" href="main.php?action=ddm&p=1">Systemowe (<span style="color: '.$color1.'; font-weight: bolder;">'.$hm_sys.'</span>)</a> 
				<a style="word-spacing: normal;" href="main.php?action=ddm">Od graczy (<span style="color: '.$color2.'; font-weight: bolder;">'.$hm_ppl.'</span>)</a> 
				<a href="main.php?action=ddm&p=2">Wysłane</a> 
				<a style="word-spacing: normal;" href="main.php?action=ddm&p=3">Napisz nową</a></p>';
	}
	
	
	public function index($wv)
	{
		$model = $this->loadModel('ddm');
		$ddm = $model->select('equipment', 'ddm', 'id='.$_SESSION['zalogowany']);
		If($ddm[0]['ddm'] == 1)
		{
			$this->ddmMenu();
			$pw = $model->select('mailbox', 'id,from_id,title,text,date,is_read', 'to_id='.$_SESSION['zalogowany'].' AND from_id>0', 'id DESC');
			$ile = count($pw);
			if($ile)
			{
				echo '<br><center><table style="text-align: center;">';
				for($i = 0; $i < $ile; $i++)
				{
					if(!$pw[$i]['is_read']) $lamp = '<img src="/templates/img/DDM/light_dot.png" width="18" height="18" title="Nowa wiadomość"/>';
					else $lamp = '<img src="/templates/img/DDM/blank_dot.png" width="18" height="18" title="Wiadomość odczytana"/>';
					$nick = $model->select('users', 'nickname', 'id='.$pw[$i]['from_id']);
					$wv->dialogPW($i, $pw[$i]['title'], $pw[$i]['text'], $nick[0]['nickname']);		
					echo '<tr><td align="center" style="width: 50px;">'.$lamp.'</td><td style="min-width: 100px;"><a href="/main.php?id='.$pw[$i]['from_id'].'">'.$nick[0]['nickname'].'</a></td><td style="min-width: 300px;">';?><a onclick="$('#pw<?php echo $i;?>').css('display', 'block'); $.ajax({type: 'POST', url: 'main.php?action=ddm', data: {idd: <? echo $pw[$i]['id']; ?>}, success: function(){}, complete: function(r){}, error: function(error){}});"><? echo $pw[$i]['title'].'</a></td><td style="width: 100px;">'.date("d-m-y", $pw[$i]['date']).'</td></tr>';
				}
				echo '</table></center>';
			}else echo '<p style="position: relative; top: 20px; text-align: center;">Skrzynka jest pusta!</p>';
		}
		else
		{
			echo '<p style="width: 500px; margin: 0px auto;">Niestety, nie posiadasz Den Den Mushi. Czy chcesz go kupić za 500<img src="/templates/img/Beli.png"/>?<br>';
			echo '<a href="main.php?action=ddm&y">TAK</a> <a href="main.php">NIE</a><br><br>';
			echo 'Den Den Mushi, inaczej ślimakofon, służy do prowadzenia rozmów między piratami.';
		}
	}
	
	
	public function sentDDM($wv)
	{
		$model = $this->loadModel('ddm');
		$ddm = $model->select('equipment', 'ddm', 'id='.$_SESSION['zalogowany']);
		If($ddm[0]['ddm'] == 1)
		{
			$this->ddmMenu();
			$pw = $model->select('mailbox', 'id,from_id,to_id,title,text,date,is_read', 'from_id='.$_SESSION['zalogowany'], 'id DESC');
			$ile = count($pw);
			if($ile)
			{
				echo '<br><center><table style="text-align: center;">';
				for($i = 0; $i < $ile; $i++)
				{
					if(!$pw[$i]['is_read']) $lamp = '<img src="/templates/img/DDM/light_dot.png" width="18" height="18" title="Nowa wiadomość"/>';
					else $lamp = '<img src="/templates/img/DDM/blank_dot.png" width="18" height="18" title="Wiadomość odczytana"/>';
					$nick = $model->select('users', 'nickname', 'id='.$pw[$i]['from_id']);
					$wv->dialogPW($i, $pw[$i]['title'], $pw[$i]['text'], $nick[0]['nickname']);	
					$nick_to = $model->select('users', 'nickname', 'id='.$pw[$i]['to_id']);
					echo '<tr><td align="center" style="width: 50px;">'.$lamp.'</td><td style="min-width: 100px;"><a href="/main.php?id='.$pw[$i]['to_id'].'">'.$nick_to[0]['nickname'].'</a></td><td style="min-width: 300px;">';?><a onclick="$('#pw<?php echo $i;?>').css('display', 'block');"><? echo $pw[$i]['title'].'</a></td><td style="width: 100px;">'.date("d-m-y", $pw[$i]['date']).'</td></tr>';
				}
				echo '</table></center>';
			}else echo '<p style="position: relative; top: 20px; text-align: center;">Skrzynka nadawcza jest pusta!</p>';
		}
		else
		{
			echo '<p style="width: 500px; margin: 0px auto;">Niestety, nie posiadasz Den Den Mushi. Czy chcesz go kupić za 500<img src="/templates/img/Beli.png"/>?<br>';
			echo '<a href="main.php?action=ddm&y">TAK</a> <a href="main.php">NIE</a><br><br>';
			echo 'Den Den Mushi, inaczej ślimakofon, służy do prowadzenia rozmów między piratami.';
		}
	}
	
	
	public function syst($wv)
	{
		$model = $this->loadModel('ddm');
		$ddm = $model->select('equipment', 'ddm', 'id='.$_SESSION['zalogowany']);
		If($ddm[0]['ddm'] == 1)
		{
			$this->ddmMenu();
			$pw = $model->select('mailbox', 'id,from_id,title,text,date,is_read', 'to_id='.$_SESSION['zalogowany'].' AND from_id=0', 'id DESC');
			$ile = count($pw);
			if($ile)
			{
				echo '<br><center><table style="text-align: center;">';
				for($i = 0; $i < $ile; $i++)
				{
					if(!$pw[$i]['is_read']) $lamp = '<img src="/templates/img/DDM/light_dot.png" width="18" height="18" title="Nowa wiadomość"/>';
					else $lamp = '<img src="/templates/img/DDM/blank_dot.png" width="18" height="18" title="Wiadomość odczytana"/>';
					$wv->dialogPW($i, $pw[$i]['title'], $pw[$i]['text'], 'System Grand Line');		
					echo '<tr><td align="center" style="width: 50px;">'.$lamp.'</td><td style="min-width: 100px;">System Grand Line</td><td style="min-width: 300px;">';?><a onclick="$('#pw<?php echo $i;?>').css('display', 'block'); $.ajax({type: 'GET', url: 'main.php?action=ddm', data: {idd: <? echo $pw[0]['id']; ?>}, success: function(){}, complete: function(r){}, error: function(error){}});"><? echo $pw[$i]['title'].'</a></td><td style="width: 100px;">'.date("d-m-y", $pw[$i]['date']).'</td></tr>';
				}
				echo '</table></center>';
			}else echo '<p style="position: relative; top: 20px; text-align: center;">Skrzynka jest pusta!</p>';
		}
		else
		{
			echo '<p style="width: 500px; margin: 0px auto;">Niestety, nie posiadasz Den Den Mushi. Czy chcesz go kupić za 500<img src="/templates/img/Beli.png"/>?<br>';
			echo '<a href="main.php?action=ddm&y">TAK</a> <a href="main.php">NIE</a><br><br>';
			echo 'Den Den Mushi, inaczej ślimakofon, służy do prowadzenia rozmów między piratami.';
		}
	}
	
	
	public function newDDM()
	{
		$model = $this->loadModel('ddm');
		$ddm = $model->select('equipment', 'ddm', 'id='.$_SESSION['zalogowany']);
		If($ddm[0]['ddm'] == 1)
		{
			$this->ddmMenu();
			?>
					<br>
					<form action="main.php?action=ddm" method="post">
					<table style='position: relative; width: 600px; margin: 0px auto; text-align: center;'>
					<tr>
					<td><input type="text" name="to_whom" id="to_whom" <? if(isset($_GET['bc'])) echo 'value="Portgas D. Ace"'; if(isset($_GET['re_who'])) {$re_who = $_GET['re_who']; echo 'value="'.$re_who.'"';} ?> ></td>
					<td><label for="to_whom">Adresat</label></td>
					</tr>
					<tr>
					<td><input type="text" name="title" id="title" <? if(isset($_GET['bc'])) echo 'value="Błąd, problem"'; if(isset($_GET['re_title'])) {$re_title = $_GET['re_title']; echo 'value="'.$re_title.'"';} ?> ></td>
					<td><label for="title">Tytuł</label></td>
					</tr>
					<tr>
					<td><textarea name="text" rows="10" cols="50" id="text"></textarea></td>
					<td><label for="text">Tekst wiadomości</label></td>
					</tr>
					<tr><td><input style='display: inline;' type="submit" name="but1" value="Wyślij!"></td><td></td></tr>
					</table>
					</form>
			<?
		}
		else
		{
			echo '<p style="width: 500px; margin: 0px auto;">Niestety, nie posiadasz Den Den Mushi. Czy chcesz go kupić za 500<img src="/templates/img/Beli.png"/>?<br>';
			echo '<a href="main.php?action=ddm&y">TAK</a> <a href="main.php">NIE</a><br><br>';
			echo 'Den Den Mushi, inaczej ślimakofon, służy do prowadzenia rozmów między piratami.';
		}	
	}
}
?>