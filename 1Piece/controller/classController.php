<?php
include_once 'controller/controller.php';

class ClassController extends Controller
{
	public function index()
	{
		$model = $this->loadModel('class');
		$view = $this->loadView('class');
		
		if(isset($_GET['ch'])) 
		{
			if(!isset($_GET['y']))
			{
				switch($_GET['ch'])
				{
					case 1: $text = 'Wojownikiem'; break;
					case 2: $text = 'Szermierzem'; break;
					case 3: $text = 'Strzelcem'; break;
					case 4: $text = 'Zabójcą'; break;
					case 5: $text = 'Cyborgiem'; break;
					default: break;
				}
				
				$text2 = 'Czy na pewno chcesz zostać '.$text.'? Pamiętaj, od tej decyzji nie będzie odwrotu!<br><a href="main.php?action=class&ch='.$_GET['ch'].'&y">TAK</a>    <a href="main.php?action=class">NIE</a>';
				
				$win = $this->loadView('window');
				$win->createWindow('class_ask', '%', 46, 40, 20, 8, $text2);
				$win->showWindow('class_ask');
			}
			else
			$model->chooseClass($_GET['ch']);
		}
		
		$model->checkDb();
		if($view->checkClass() == 1)
		{
		
		}
		else
		{
			$wynik2 = $model->select('bars', 'lvl', 'id='.$_SESSION['zalogowany']);
			
			if($wynik2[0]['lvl'] >= 10) $view->letsChoice();
			else echo 'Musisz osiągnąć 10 poziom doświadczenia, aby któryś z trenerów wziął Cię do terminu.';
		}
	}
}
?>