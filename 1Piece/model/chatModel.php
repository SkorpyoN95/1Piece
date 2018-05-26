<?php
include_once 'model/model.php';

class ChatModel extends Model
{
	public function getMsgs()
	{
		$wynik = $this->select('chats', '*', NULL, 'id DESC', '100');
		return $wynik;
	}
	
	public function newMsg($text)
	{
		mysql_query("insert into chats values(null,".$_SESSION['zalogowany'].",'".$chattext."',".$now.")");
		$stmnt = $this->pdo->prepare("insert into chats values(null,?,?,?)");
		$stmnt->bindValue(1, $_SESSION['zalogowany'], PDO::PARAM_INT);
		$stmnt->bindValue(2, $text, PDO::PARAM_STR);
		$stmnt->bindValue(3, time(), PDO::PARAM_INT);
		$stmnt->execute();
	}
	
	public function emots($inputString)
	{
	   $emots = file('templates/emots/emots.txt');
	   for ( $i=0; $i < count($emots); $i++ )
	   {
		  list($code, $emot) = explode("|!|", $emots[$i]);
		  $inputString = str_replace($code, "<img src=\"/templates/emots/$emot\" border=\"0\" alt=\"$emot\" />", $inputString);
	   }
	   return $inputString;
	}
	
	public function links($inputString)
	{
		$wynik = $this->select('users', 'id,nickname');

		for($i = 0; $i < count($wynik); $i++)
			$inputString = preg_replace('/@'.$wynik[$i]['nickname'].'/', '<a style="color: #00ff00;" href="main.php?id='.$wynik[$i]['id'].'">'.$wynik[$i]['nickname'].'</a>', $inputString);
		
		$inputString = preg_replace('/(http(|s):\/\/[^\s]*)/', '<a style="color: #ffffbd;" href="\\1" target="_blank">LINK</a>', $inputString);
		
		return $inputString;
	}
	
	public function censore($inputString)
	{
		//echo '<script>alert("Działam!");</script>';
		$curses = array('/[^\s]*k+u+r+w+[^\s]*/i',
						'/[^\s]*h+u+j+[^\s]*/i',
						'/[^\s]*c+i+p+[^\s]*/i',
						'/[^\s]*d+u+p+[^\s]*/i',
						'/[^\s]*j+e+b+[^\s]*/i',
						'/[^\s]*p+i+e+r+d+[^z][^\s]*/i');
		
		$inputString = preg_replace($curses, ' <img src="/templates/emots/censored.gif" border="0" alt="***" /> ', $inputString);
		return $inputString;
	}
}
?>