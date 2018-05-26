<?php
include_once 'model/model.php';

class DdmModel extends Model
{
	public function statePW($idd)
	{
		$stmnt = $this->pdo->prepare('update mailbox set is_read=true where id=?');
		$stmnt->bindValue(1, $idd, PDO::PARAM_INT);
		$stmnt->execute();
	}
	
	public function addDDM($id, $text, $title)
	{
		$now = time();
		$stmnt = $this->pdo->prepare('insert into mailbox values(null,?,?,?,?,?,0)');
		$stmnt->bindValue(1, $_SESSION['zalogowany'], PDO::PARAM_INT);
		$stmnt->bindValue(2, $id, PDO::PARAM_INT);
		$stmnt->bindValue(3, $title, PDO::PARAM_STR);
		$stmnt->bindValue(4, $text, PDO::PARAM_STR);
		$stmnt->bindValue(5, $now, PDO::PARAM_INT);
		$stmnt->execute();
	}
	
	public function buyDDM()
	{
		$ddm = $this->select('equipment', 'ddm', 'id='.$_SESSION['zalogowany']);
		if($ddm[0]['ddm'] == 1) return 'Już masz Den-Den Mushi!';
		$gold = $this->select('bars', 'gold', 'id='.$_SESSION['zalogowany']);
		if($gold[0]['gold'] < 500) return 'Nie stać Cię na Den-Den Mushi!';
		$gold[0]['gold'] -= 500;
		$stmnt = $this->pdo->prepare('update bars set gold=? where id=?');
		$stmnt->bindValue(1, $gold[0]['gold'], PDO::PARAM_INT);
		$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
		$stmnt->execute();
		return 'Kupiłeś Den-Den Mushi.';
	}
}
?>