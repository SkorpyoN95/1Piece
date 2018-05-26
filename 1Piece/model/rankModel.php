<?php
include_once 'model/model.php';

class RankModel extends Model
{
	public function getRank()
	{
		$rank = $this->select('users,bars', 'users.id,nickname,lvl,price', 'users.id=bars.id', 'act_exp DESC');
		return $rank;
	}
}
?>