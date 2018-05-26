<?php
include_once 'model/model.php';

class ClassModel extends Model
{
	public function checkDb()
	{
		$wynik = $this->select('classes', 'id', 'id='.$_SESSION['zalogowany']);
		if($wynik[0]['id'] == null)
		{
			$stmnt = $this->pdo->prepare('insert into classes values(?,"")');
			$stmnt->bindValue(1, $_SESSION['zalogowany'], PDO::PARAM_INT);
			$stmnt->execute();
		}
	}
	
	public function chooseClass($class)
	{
		switch($_GET['ch'])
		{
			case 1: $text = 'warrior'; break;
			case 2: $text = 'swordsman'; break;
			case 3: $text = 'rifleman'; break;
			case 4: $text = 'assasin'; break;
			case 5: $text = 'cyborg'; break;
			default: break;
		}
		
		$stmnt = $this->pdo->prepare('update classes set theclass=? where id=?');
		$stmnt->bindValue(1, $text, PDO::PARAM_STR);
		$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
		$stmnt->execute();
	}
}
?>