<?php
include_once 'controller/controller.php';

class DdmController extends Controller
{
	public function index()
	{
		$model = $this->loadModel('ddm');
		$view = $this->loadView('ddm');
	
		if(isset($_POST['to_whom']) && isset($_POST['title']) && isset($_POST['text']) && isset($_POST['but1']))
					{
						$who = $this->safeData($_POST['to_whom']);
						$title = $this->safeData($_POST['title']);
						$text = $this->safeData($_POST['text']);
						
						if($title == '') {$title = '(Bez tytułu)';}
						
						if($text == '') 
						{ 
							$wv = $this->loadView('window');
							$wv->createWindow('info_box', '%', 47, 45, 10, 6, 'Brak treści!'); 
							$wv->showWindow('info_box');
						}
						else
						{
							try
							{
								if($model->select('users', 'id', 'nickname="'.$who.'"') == false) throw new Exception;
								else $id = $model->select('users', 'id', 'nickname="'.$who.'"');
							}
							catch(Exception $e)
							{ 
								$wv = $this->loadView('window');
								$wv->createWindow('info_box', '%', 47, 45, 10, 6, 'Brak gracza o podanym nicku!'); 
								$wv->showWindow('info_box');
							}
							
							if($id[0]['id'])
							{
								$model->addDDM($id[0]['id'], $text, $title);
								$wv = $this->loadView('window');
								$wv->createWindow('info_box', '%', 47, 45, 10, 6, 'Wiadomość wysłana!'); 
								$wv->showWindow('info_box');
							}
						}
					}
					
		if(isset($_GET['y']))
		{
			$odp = $model->buyDDM();
			$wv = $this->loadView('window');
			$wv->createWindow('info_box', '%', 47, 45, 10, 6, $odp); 
			$wv->showWindow('info_box');
		}
		
		if(isset($_GET['p']))
		{
			$p = $this->safeData($_GET['p']);
			switch($p)
			{
				case 1: $view->syst($this->loadView('window')); break;
				case 2: $view->sentDDM($this->loadView('window')); break;
				case 3: $view->newDDM(); break;
				default: break;
			}
		}
		else $view->index($this->loadView('window'));
		if(isset($_POST['idd']))
		{
			$idd = $this->safeData($_POST['idd']);
			$model->statePW($idd);
		}
	}
}
?>