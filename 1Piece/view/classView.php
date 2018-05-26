<?php
include_once 'view/view.php';

class ClassView extends View
{
	public function checkClass()
	{
		$model = $this->loadModel('class');
		
		$wynik = $model->select('classes', 'theclass', 'id='.$_SESSION['zalogowany']);
		
		if($wynik[0]['theclass'] != '') return true;
		else return false;
	}
	
	public function letsChoice()
	{
		?>
		<div style="position: relative; height: 600px;">
			<p style="position: absolute; top: 0px; width: 100%; text-align: center; font-weight: bolder; font-size: 26px;">Nadszedł czas wyboru. Wybierz klasę, do której chcesz należeć.</p>
			<img style="position: absolute; top: 30px; left: 175px;" src="templates/img/Masters/Marco.png" />
			<img style="position: absolute; top: 200px; left: 0px;" src="templates/img/Masters/Zoro.png" />
			<img style="position: absolute; top: 250px; left: 180px;" src="templates/img/Masters/Franky.png" />
			<img style="position: absolute; top: 250px; left: 370px;" src="templates/img/Masters/Kuro.png" />
			<img style="position: absolute; top: 200px; left: 550px;" src="templates/img/Masters/Usopp.png" />
			
			<table style="position: absolute; left: 50px; top: 550px; width: 700px;">
				<tr>
					<td style="width: 140px;"><a href="main.php?action=class&ch=2">Szermierz</a></td>
					<td style="width: 140px;"><a href="main.php?action=class&ch=5">Cyborg</a></td>
					<td style="width: 140px;"><a href="main.php?action=class&ch=1">Wojownik</a></td>
					<td style="width: 140px;"><a href="main.php?action=class&ch=4">Zabójca</a></td>
					<td style="width: 140px;"><a href="main.php?action=class&ch=3">Strzelec</a></td>
				</tr>
			</table>
		</div>
		<p style="position: relative; top: 0px; width: 100%; text-align: center; font-weight: bolder; font-size: 26px;">Porównanie klas (przyrost cech następuje przy każdym awansie poziomu).</p>
		<table style="position: relative; left: 0px; top: 0px; width: 700px;">
				<tr style="font-weight: bolder;">
					<td style="width: 100px; text-align: right;">Klasa</td>
					<td style="width: 40px; text-align: right;" title="Przyrost Ataku">(A)</td>
					<td style="width: 40px; text-align: right;" title="Przyrost Obrony">(O)</td>
					<td style="width: 40px; text-align: right;" title="Przyrost Szybkości">(S)</td>
					<td style="width: 40px; text-align: right;" title="Przyrost Inteligencji">(I)</td>
					<td style="width: 40px; text-align: right;" title="Przyrost Cwaniactwa">(C)</td>
					<td style="width: 400px; text-align: center;">Talent</td>
				</tr>
				
				<tr>
					<td style="width: 100px; text-align: right;">Wojownik</td>
					<td style="width: 40px; text-align: right;">+3</td>
					<td style="width: 40px; text-align: right;">+5</td>
					<td style="width: 40px; text-align: right;">+4</td>
					<td style="width: 40px; text-align: right;">+2</td>
					<td style="width: 40px; text-align: right;">+1</td>
					<td style="width: 400px; text-align: center;">Garda - szansa na kontratak po bloku.</td>
				</tr>
				
				<tr>
					<td style="width: 100px; text-align: right;">Szermierz</td>
					<td style="width: 40px; text-align: right;">+5</td>
					<td style="width: 40px; text-align: right;">+3</td>
					<td style="width: 40px; text-align: right;">+1</td>
					<td style="width: 40px; text-align: right;">+4</td>
					<td style="width: 40px; text-align: right;">+2</td>
					<td style="width: 400px; text-align: center;">Zranienie - szansa na wywołanie krwotoku u przeciwnika.</td>
				</tr>
				
				<tr>
					<td style="width: 100px; text-align: right;">Strzelec</td>
					<td style="width: 40px; text-align: right;">+4</td>
					<td style="width: 40px; text-align: right;">+2</td>
					<td style="width: 40px; text-align: right;">+3</td>
					<td style="width: 40px; text-align: right;">+1</td>
					<td style="width: 40px; text-align: right;">+5</td>
					<td style="width: 400px; text-align: center;">Penetracja - szansa na całkowite zignorowanie defensywy przeciwnika.</td>
				</tr>
				
				<tr>
					<td style="width: 100px; text-align: right;">Zabójca</td>
					<td style="width: 40px; text-align: right;">+2</td>
					<td style="width: 40px; text-align: right;">+1</td>
					<td style="width: 40px; text-align: right;">+5</td>
					<td style="width: 40px; text-align: right;">+3</td>
					<td style="width: 40px; text-align: right;">+4</td>
					<td style="width: 400px; text-align: center;">Skrytobójstwo - szansa na natychmiastowe pokonanie przeciwnika.</td>
				</tr>
				
				<tr>
					<td style="width: 100px; text-align: right;">Cyborg</td>
					<td style="width: 40px; text-align: right;">+1</td>
					<td style="width: 40px; text-align: right;">+4</td>
					<td style="width: 40px; text-align: right;">+2</td>
					<td style="width: 40px; text-align: right;">+5</td>
					<td style="width: 40px; text-align: right;">+3</td>
					<td style="width: 400px; text-align: center;">Autonaprawa - szansa na regenerację części HP.</td>
				</tr>
			</table>
		<?php
	}
}
?>