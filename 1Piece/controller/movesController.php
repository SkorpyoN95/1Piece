<?php
include_once 'controller/controller.php';

class MovesController extends Controller
{
	public function index()
	{
		$view = $this->loadView('moves');
		$type = 1;
		if(isset($_GET['type'])) $type = $_GET['type'];
		$view->showMoves($type);
	}
}
?>