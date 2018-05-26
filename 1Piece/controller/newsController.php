<?php
include_once 'controller/controller.php';

class NewsController extends Controller
{
	public function index()
	{
		$model = $this->loadModel('news');
		$news = $model->newsInfo();
		$view = $this->loadView('news');
		if(isset($_GET['pon']))
		{
			$text = $model->pieceOfNews($this->safeData($_GET['pon']));
			$wv = $this->loadView('window');
			$wv->newsSheet($text);
			$wv->showWindow('newsSheet');
		}
		$view->listOfNews($news);
	}
}
?>