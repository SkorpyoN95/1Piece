<?php
include_once 'model/model.php';

class PaModel extends Model
{
	public function addNews($title, $author, $text)
	{
		$now = time();
		
		$stmnt = $this->pdo->prepare("insert into news values(null, ?, ?, ?, ?)");
		$stmnt->bindValue(1, $title, PDO::PARAM_STR);
		$stmnt->bindValue(2, $author, PDO::PARAM_STR);
		$stmnt->bindValue(3, $text, PDO::PARAM_STR);
		$stmnt->bindValue(4, $now, PDO::PARAM_INT);
		$stmnt->execute();
	}
	
	public function addMove($id, $name, $type, $ATK, $DEF, $SPD, $cost, $stat1, $stat2)
	{
		$stmnt = $this->pdo->prepare("insert into moves values(?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmnt->bindValue(1, $id, PDO::PARAM_INT);
		$stmnt->bindValue(2, $name, PDO::PARAM_STR);
		$stmnt->bindValue(3, $type, PDO::PARAM_STR);
		$stmnt->bindValue(4, $ATK, PDO::PARAM_INT);
		$stmnt->bindValue(5, $DEF, PDO::PARAM_INT);
		$stmnt->bindValue(6, $SPD, PDO::PARAM_INT);
		$stmnt->bindValue(7, $cost, PDO::PARAM_INT);
		$stmnt->bindValue(8, $stat1, PDO::PARAM_INT);
		$stmnt->bindValue(9, $stat2, PDO::PARAM_INT);
		$stmnt->execute();
	}
}
?>