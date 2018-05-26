<?php
include_once 'model/model.php';

class NewsModel extends Model
{
	public function newsInfo()
	{
		$data = $this->select('news', 'id,title,autor,date');
		return $data;
	}
	
	public function pieceOfNews($id)
	{
		$data = $this->select('news', 'text', 'id='.$id);
		$data2 = $this->select('users', 'read_news', 'id='.$_SESSION['zalogowany']);
		$news = explode(',', $data2[0]['read_news']);
		for($i = 0; $i < count($news); $i++) if($news[$i] == '') unset($news[$i]);
		if(in_array($id, $news) == false) $news[] = $id;
		$data3 = implode(',', $news);
		$stmnt = $this->pdo->prepare('update users set read_news=? where id=?');
		$stmnt->bindValue(1, $data3, PDO::PARAM_STR);
		$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
		$stmnt->execute();
		return $data[0]['text'];
	}
}
?>