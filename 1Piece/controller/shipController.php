<?php
include_once 'controller/controller.php';

class ShipController extends Controller
{
	public function index()
	{
		$model = $this->loadModel('ship');
	}
}
?>