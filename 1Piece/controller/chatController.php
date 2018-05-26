<?php
include_once 'controller/controller.php';

class ChatController extends Controller
{
	public function index($page)
	{
		$model = $this->loadModel('chat');
		$view = $this->loadView('chat');
		if(isset($_POST['ChatText']))
		{
			$model->newMsg(strip_tags($_POST['ChatText']));
		}
		$msgs = $model->getMsgs();
		$view->index($msgs, $page);
	}
}
?>