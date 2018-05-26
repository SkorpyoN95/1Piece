<?php
include_once 'model/model.php';

class ProfileModel extends Model
{
	public function showProfile($id, $mode)
	{
		$nick = $this->select('users', 'nickname, online, id', 'id='.$id);
		$info = $this->select('bars', 'lvl,price', 'id='.$id);
		$opis = $this->select('descriptions', 'opis', 'id='.$id);
		if(!file_exists('templates/img/Avatary/'.$id.'.jpg')) $info[] = 'brak_avka.jpg';
		else $info[] = $id.'.jpg';
		if($mode)
		{
			$bars = $this->select('bars', 'max_hp,act_hp,max_en,act_en,vitality,act_vit,max_exp,act_exp,gold', 'id='.$id);
		}
		else $bars = '';
		$a = array($nick, $info, $opis, $bars);
		return $a;
	}
}
?>