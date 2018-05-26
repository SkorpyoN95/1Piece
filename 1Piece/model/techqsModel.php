<?php
include_once 'model/model.php';

class TechqsModel extends Model
{
	public function getTechniques()
	{
		return $this->select('techniques', '*', 'id > 3');
	}
	
	public function getUserTechniques()
	{
		$string = $this->select('statistics', 'techniques', 'id='.$_SESSION['zalogowany']);
		$techqs = explode(',', $string[0]['techniques']);
		return $techqs;
	}
	
	public function setTechnique($techq)
	{
		$techqs = $this->getUserTechniques();
		if(in_array($techq, $techqs))
		{
			return 'Już znasz tą technikę.';
		}
		else
		{
			$techqs[] = $techq;
			$string = implode(',', $techqs);
			$stmnt = $this->pdo->prepare('update statistics set techniques=? where id=?');
			$stmnt->bindValue(1, $string, PDO::PARAM_STR);
			$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
			$count = $stmnt->execute();
			if($count == 1) return 'Nauczyłeś się nowej techniki.';
			else return 'Bład bazy danych. Poinformuj Admina.';
		}
	}
}
?>