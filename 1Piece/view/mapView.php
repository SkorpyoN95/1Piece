<?php
include_once 'view/view.php';

class MapView extends View
{
	public function barView()
	{
		$model = $this->loadModel('map');
		$wynik = $model->select('users', 'nickname', 'id='.$_SESSION['zalogowany']);
		$nick = $wynik[0]['nickname'];
		echo '<p style="text-align: center; font-weight: bolder; font-size: 30px;">Wszedłeś do baru</p>';
		echo '<div  style="position: relative; width: 720px; height: 475px; background-image: url(/templates/img/stages/menu_bar.png); background-size: 100% 100%;">';
		echo '<img style="position: absolute; top: 90px; left: 90px; width: 90px; height: 90px;" src="/templates/img/EQ/Mięso.png" />';
		echo '<p style="position: absolute; top: 25px; left: 200px; width: 100px; text-align: right; color: #000000; font-size: 72px;">100</p>';
		echo '<img style="position: absolute; top: 190px; left: 90px; width: 90px; height: 90px;" src="/templates/img/EQ/Sake.png" />';
		echo '<p style="position: absolute; top: 125px; left: 200px; width: 100px; text-align: right; color: #000000; font-size: 72px;">50</p>';
		echo '</div>';
		?>
		<form method="post" action="main.php?action=map&city=1">
		<table style="width: 200px; margin: 0px auto;">
			<tr>
				<td>Mięso, sztuk:</td>
				<td><input style="width: 50px;" type="number" min="0" name='meat' value="0" /></td>
			</tr>
			
			<tr>
				<td>Sake, butelek:</td>
				<td><input style="width: 50px;" type="number" min="0" name='sake' value="0" /></td>
			</tr>
			
			<tr>
				<td></td>
				<td><input type="submit" value="Zamów" /></td>
			</tr>
		</table>
		</form>
		<?php
	}
	
	public function trainingView()
	{
		$model = $this->loadModel('map');
		$wynik = $model->select('users', 'nickname', 'id='.$_SESSION['zalogowany']);
		$nick = $wynik[0]['nickname'];
		echo '<p style="text-align: center; font-weight: bolder; font-size: 30px;">Wszedłeś do sali treningowej';
		echo '<img src="/templates/img/NPCs/zoro2.png"/></p>';
		echo '<table style="width: 500px; margin: 0px auto;"><tr><td><strong>Trener: </strong></td><td>*zieeeew!* Tak?</td></tr>';
		echo '<tr><td valign="top"><strong>'.$nick.': </strong></td><td>Czy można tutaj poćwiczyć?</td></tr>';
		echo '<tr><td valign="top"><strong>Trener: </strong></td><td>Nie, tutaj się sieka cebulkę. No jasne, że tutaj można poćwiczyć, ale nie za darmo.<br>
																	Nad czym dziś popracujemy?</td></tr>';
		echo '<tr><td valign="top"><strong>'.$nick.': </strong></td><td>	<a href="main.php?action=map&city=2&train=1">Chcę być silniejszy.</a><br>
																					<a href="main.php?action=map&city=2&train=2">Chcę być zwinniejszy.</a><br>
																					<a href="main.php?action=map&city=2&train=3">Chcę być bardziej wytrzymały.</a><br>
																					<a href="main.php?action=map&city=2&train=4">Chcę wzmocnić swój intelekt.</a><br>
																					<a href="main.php?action=map&city=2&train=5">Chcę mieć silniejszą wolę.</a><br>
																					<a href="main.php?action=map&city=2&train=6">Chcę mieć lepszy refleks.</a><br>
																					<a href="main.php?action=map&city=2&train=7">Chcę mieć celniejsze oko.</a><br>
																					<a href="main.php?action=map&city=2&train=8">Chcę rozwinąć swój instynkt.</a><br>
																					<a href="main.php?action=map">Chcę wyjść. (powrót)</a><br></td></tr>';
		echo '</table>';
	}
	
	public function letsTrain($train)
	{
		$model = $this->loadModel('map');
		echo '<p style="text-align: center; font-weight: bolder; font-size: 30px;">Wszedłeś do sali treningowej';
		echo '<img src="/templates/img/NPCs/zoro2.png"/></p>';
		
		switch($train)
			{
				case 1:
				
				echo '<center><h3>Trening siłowy</h3>';
				echo '<strong>Trener:</strong><br>';
				echo 'Ten trening kosztuje 50<img src="/templates/img/whiteBeli.png"/> za godzinę i polega na wyciskaniu sztangi. W trakcie treningu wzmacniasz siłę. Porządny trening pożera wiele sił witalnych, więc nie przesadź! Nie chce mi się Ciebie wynosić z sali...<br>';
				
				$wynik = $model->select('statistics', 'str_lvl', 'id='.$_SESSION['zalogowany']);
				$str_lvl = $wynik[0]['str_lvl'];
				
				if($str_lvl < 5)
					echo '<br><strong>Na początek zalecam Ci wybranie obciążenia 1KG.</strong><br><br>';
				if($str_lvl >= 5 && $str_lvl < 10)
					echo '<br><strong>Teraz możemy pomyśleć o 5KG.</strong><br><br>';
				if($str_lvl >= 10 && $str_lvl < 15)
					echo '<br><strong>Teraz możemy pomyśleć o 10KG.</strong><br><br>';
				if($str_lvl >= 15 && $str_lvl < 25)
					echo '<br><strong>Teraz możemy pomyśleć o 15KG. Tylko tak dalej!</strong><br><br>';
				if($str_lvl >= 25 && $str_lvl < 50)
					echo '<br><strong>Dobrze Ci idzie! Teraz możemy pomyśleć o 25KG.</strong><br><br>';
				if($str_lvl >= 50 && $str_lvl < 100)
					echo '<br><strong>No, nareszcie dojrzałeś do porządnego obciążenia! Teraz możemy pomyśleć o 50KG.</strong><br><br>';
				if($str_lvl >= 100 && $str_lvl < 150)
					echo '<br><strong>100KG... Może będą z Ciebie ludzie.</strong><br><br>';
			?>
				<form method="post" action="main.php?action=map&city=2" name="frame">
				<label for="weight">Obciążenie (KG):</label> <select name="weight" style="width: 100px; text-align: center;">
						<option>1</option>
						<?if($str_lvl >= 5) {?><option>5</option><?} ?>
						<?if($str_lvl >= 10) {?><option>10</option><?} ?>
						<?if($str_lvl >= 15) {?><option>15</option><?} ?>
						<?if($str_lvl >= 25) {?><option>25</option><?} ?>
						<?if($str_lvl >= 50) {?><option>50</option><?} ?>
						<?if($str_lvl >= 100) {?><option>100</option><?} ?>
					</select>
					<div id="slider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-willtent ui-corner-all" style="width: 200px;">
					<a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 0%;"></a>
					</div>
					<label for="currentValue">Liczba godzin treningu:</label> <input id="currentValue" type="text" name="currentValue" readonly="readonly" value="1" style="width: 20px;"/>
					<input type="hidden" value="str" name='atr' />
					<br><input type="submit" name="str" value="Trenuj"/>
					<br><a href="main.php?action=map&city=2">Rozmyśliłem się (powrót)</a>
				</form>
			<?php				
				break;
				
				case 2:
				
				echo '<center><h3>Trening zwinności</h3>';
				echo '<strong>Trener:</strong><br>';
				echo 'Ten trening kosztuje 40<img src="/templates/img/whiteBeli.png"/> za godzinę i polega na sprintach. W trakcie treningu pracujesz nad swoją zwinnością. Porządny trening pożera wiele sił witalnych, więc nie przesadź! Nie chce mi się Ciebie wynosić z sali...<br>';
				
				$wynik = $model->select('statistics', 'dex_lvl', 'id='.$_SESSION['zalogowany']);
				$dex_lvl = $wynik[0]['dex_lvl'];
				
				if($dex_lvl < 5)
					echo '<br><strong>Na początek zalecam Ci pojedyncze serie.</strong><br><br>';
				if($dex_lvl >= 5 && $dex_lvl < 10)
					echo '<br><strong>Teraz możemy pomyśleć o 5 seriach.</strong><br><br>';
				if($dex_lvl >= 10 && $dex_lvl < 15)
					echo '<br><strong>Teraz możemy pomyśleć o 10 seriach.</strong><br><br>';
				if($dex_lvl >= 15 && $dex_lvl < 25)
					echo '<br><strong>Teraz możemy pomyśleć o 15 seriach. Tylko tak dalej!</strong><br><br>';
				if($dex_lvl >= 25 && $dex_lvl < 50)
					echo '<br><strong>Dobrze Ci idzie! Teraz możemy pomyśleć o 25 seriach.</strong><br><br>';
				if($dex_lvl >= 50 && $dex_lvl < 100)
					echo '<br><strong>No, nareszcie dojrzałeś do porządnego sprintu! Teraz możemy pomyśleć o 50 seriach.</strong><br><br>';
				if($dex_lvl >= 100 && $dex_lvl < 150)
					echo '<br><strong>100 serii... Może będą z Ciebie ludzie.</strong><br><br>';
			?>
				<form method="post" action="main.php?action=map&city=2" name="frame">
				<label for="weight">Ilość powtórzeń w serii:</label> <select name="weight" style="width: 100px; text-align: center;">
						<option>1</option>
						<?if($dex_lvl >= 5) {?><option>5</option><?} ?>
						<?if($dex_lvl >= 10) {?><option>10</option><?} ?>
						<?if($dex_lvl >= 15) {?><option>15</option><?} ?>
						<?if($dex_lvl >= 25) {?><option>25</option><?} ?>
						<?if($dex_lvl >= 50) {?><option>50</option><?} ?>
						<?if($dex_lvl >= 100) {?><option>100</option><?} ?>
					</select>
					<div id="slider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-willtent ui-corner-all" style="width: 200px;">
					<a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 0%;"></a>
					</div>
					<label for="currentValue">Liczba godzin treningu:</label> <input id="currentValue" type="text" name="currentValue" readonly="readonly" value="1" style="width: 20px;"/>
					<input type="hidden" value="dex" name='atr' />
					<br><input type="submit" name="dex" value="Trenuj"/>
					<br><a href="main.php?action=map&city=2">Rozmyśliłem się (powrót)</a>
				</form>
			<?php
				
				break;
				
				case 3:
				
				echo '<center><h3>Trening wytrzymałościowy</h3>';
				echo '<strong>Trener:</strong><br>';
				echo 'Ten trening kosztuje 60<img src="/templates/img/whiteBeli.png"/> za godzinę i polega na ćwiczeniach na tzw. stacji obwodowej. W trakcie treningu wzmacniasz wytrzymałość. Porządny trening pożera wiele sił witalnych, więc nie przesadź! Nie chce mi się Ciebie wynosić z sali...<br>';
				
				$wynik = $model->select('statistics', 'stam_lvl', 'id='.$_SESSION['zalogowany']);
				$stam_lvl = $wynik[0]['stam_lvl'];
				
				if($stam_lvl < 5)
					echo '<br><strong>Na początek zalecam Ci wybranie 1 stacji.</strong><br><br>';
				if($stam_lvl >= 5 && $stam_lvl < 10)
					echo '<br><strong>Teraz możemy pomyśleć o 5 stacji.</strong><br><br>';
				if($stam_lvl >= 10 && $stam_lvl < 15)
					echo '<br><strong>Teraz możemy pomyśleć o 10 stacji.</strong><br><br>';
				if($stam_lvl >= 15 && $stam_lvl < 25)
					echo '<br><strong>Teraz możemy pomyśleć o 15 stacjach. Tylko tak dalej!</strong><br><br>';
				if($stam_lvl >= 25 && $stam_lvl < 50)
					echo '<br><strong>Dobrze Ci idzie! Teraz możemy pomyśleć o 25 stacjach.</strong><br><br>';
				if($stam_lvl >= 50 && $stam_lvl < 100)
					echo '<br><strong>No, nareszcie dojrzałeś do porządnego treningu obwodowego! Teraz możemy pomyśleć o 50 stacjach.</strong><br><br>';
				if($stam_lvl >= 100 && $stam_lvl < 150)
					echo '<br><strong>100 stacji... Może będą z Ciebie ludzie.</strong><br><br>';
			?>
				<form method="post" action="main.php?action=map&city=2" name="frame">
				<label for="weight">Ilość stacji:</label> <select name="weight" style="width: 100px; text-align: center;">
						<option>1</option>
						<?if($stam_lvl >= 5) {?><option>5</option><?} ?>
						<?if($stam_lvl >= 10) {?><option>10</option><?} ?>
						<?if($stam_lvl >= 15) {?><option>15</option><?} ?>
						<?if($stam_lvl >= 25) {?><option>25</option><?} ?>
						<?if($stam_lvl >= 50) {?><option>50</option><?} ?>
						<?if($stam_lvl >= 100) {?><option>100</option><?} ?>
					</select>
					<div id="slider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-willtent ui-corner-all" style="width: 200px;">
					<a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 0%;"></a>
					</div>
					<label for="currentValue">Liczba godzin treningu:</label> <input id="currentValue" type="text" name="currentValue" readonly="readonly" value="1" style="width: 20px;"/>
					<input type="hidden" value="stam" name="atr"/>
					<br><input type="submit" name="stam" name='atr' value="Trenuj"/>
					<br><a href="main.php?action=map&city=2">Rozmyśliłem się (powrót)</a>
				</form>
			<?php
				
				break;
				
				case 4:
				
				echo '<center><h3>Trening intelektu</h3>';
				echo '<strong>Trener:</strong><br>';
				echo 'Ten trening kosztuje 25<img src="/templates/img/whiteBeli.png"/> za godzinę i polega na rozwiązywaniu łamigłówek. W trakcie treningu ćwiczysz swój intelekt. Porządny trening pożera wiele sił witalnych, więc nie przesadź! Nie chce mi się Ciebie wynosić z sali...<br>';
				
				$wynik = $model->select('statistics', 'ment_lvl', 'id='.$_SESSION['zalogowany']);
				$ment_lvl = $wynik[0]['ment_lvl'];
				
				if($ment_lvl < 5)
					echo '<br><strong>Na początek zaczniesz od 1 łamigłówki.</strong><br><br>';
				if($ment_lvl >= 5 && $ment_lvl < 10)
					echo '<br><strong>Teraz możemy pomyśleć o 5 łamigłówkach.</strong><br><br>';
				if($ment_lvl >= 10 && $ment_lvl < 15)
					echo '<br><strong>Teraz możemy pomyśleć o 10 łamigłówkach.</strong><br><br>';
				if($ment_lvl >= 15 && $ment_lvl < 25)
					echo '<br><strong>Teraz możemy pomyśleć o 15 łamigłówkach. Tylko tak dalej!</strong><br><br>';
				if($ment_lvl >= 25 && $ment_lvl < 50)
					echo '<br><strong>Dobrze Ci idzie! Teraz możemy pomyśleć o 25 łamigłówkach.</strong><br><br>';
				if($ment_lvl >= 50 && $ment_lvl < 100)
					echo '<br><strong>No, nareszcie dojrzałeś do porządnej medytacji! Teraz możemy pomyśleć o 50 łamigłówkach.</strong><br><br>';
				if($ment_lvl >= 100 && $ment_lvl < 150)
					echo '<br><strong>100 łamigłówek... Może będą z Ciebie ludzie.</strong><br><br>';
			?>
				<form method="post" action="main.php?action=map&city=2" name="frame">
				<label for="weight">Ilość zadań:</label> <select name="weight" style="width: 100px; text-align: center;">
						<option>1</option>
						<?if($ment_lvl >= 5) {?><option>5</option><?} ?>
						<?if($ment_lvl >= 10) {?><option>10</option><?} ?>
						<?if($ment_lvl >= 15) {?><option>15</option><?} ?>
						<?if($ment_lvl >= 25) {?><option>25</option><?} ?>
						<?if($ment_lvl >= 50) {?><option>50</option><?} ?>
						<?if($ment_lvl >= 100) {?><option>100</option><?} ?>
					</select>
					<div id="slider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-willtent ui-corner-all" style="width: 200px;">
					<a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 0%;"></a>
					</div>
					<label for="currentValue">Liczba godzin treningu:</label> <input id="currentValue" type="text" name="currentValue" readonly="readonly" value="1" style="width: 20px;"/>
					<input type="hidden" value="ment" name='atr' />
					<br><input type="submit" name="ment" value="Trenuj"/>
					<br><a href="main.php?action=map&city=2">Rozmyśliłem się (powrót)</a>
				</form>
			<?php
				
				break;
				
				case 5:
				
				echo '<center><h3>Trening Silnej Woli</h3>';
				echo '<strong>Trener:</strong><br>';
				echo 'Ten trening kosztuje 75<img src="/templates/img/whiteBeli.png"/> za godzinę i polega na rozmaitych wyzwaniach, testujących siłę Twojej woli. Porządny trening pożera wiele sił witalnych, więc nie przesadź! Nie chce mi się Ciebie wynosić z sali...<br>';
				
				$wynik = $model->select('statistics', 'will_lvl', 'id='.$_SESSION['zalogowany']);
				$will_lvl = $wynik[0]['will_lvl'];
				
				if($will_lvl < 5)
					echo '<br><strong>Na początek zalecam Ci wybranie pojedynczego wyzwania.</strong><br><br>';
				if($will_lvl >= 5 && $will_lvl < 10)
					echo '<br><strong>Teraz możemy pomyśleć o 5 wyzwaniach.</strong><br><br>';
				if($will_lvl >= 10 && $will_lvl < 15)
					echo '<br><strong>Teraz możemy pomyśleć o 10 wyzwaniach.</strong><br><br>';
				if($will_lvl >= 15 && $will_lvl < 25)
					echo '<br><strong>Teraz możemy pomyśleć o 15 wyzwaniach. Tylko tak dalej!</strong><br><br>';
				if($will_lvl >= 25 && $will_lvl < 50)
					echo '<br><strong>Dobrze Ci idzie! Teraz możemy pomyśleć o 25 wyzwaniach.</strong><br><br>';
				if($will_lvl >= 50 && $will_lvl < 100)
					echo '<br><strong>No, nareszcie dojrzałeś do porządnego treningu interwałowego! Teraz możemy pomyśleć o 50 wyzwaniach.</strong><br><br>';
				if($will_lvl >= 100 && $will_lvl < 150)
					echo '<br><strong>100 wyzwań... Może będą z Ciebie ludzie.</strong><br><br>';
			?>
				<form method="post" action="main.php?action=map&city=2" name="frame">
				<label for="weight">Ilość wyzwań:</label> <select name="weight" style="width: 100px; text-align: center;">
						<option>1</option>
						<?if($will_lvl >= 5) {?><option>5</option><?} ?>
						<?if($will_lvl >= 10) {?><option>10</option><?} ?>
						<?if($will_lvl >= 15) {?><option>15</option><?} ?>
						<?if($will_lvl >= 25) {?><option>25</option><?} ?>
						<?if($will_lvl >= 50) {?><option>50</option><?} ?>
						<?if($will_lvl >= 100) {?><option>100</option><?} ?>
					</select>
					<div id="slider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-willtent ui-corner-all" style="width: 200px;">
					<a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 0%;"></a>
					</div>
					<label for="currentValue">Liczba godzin treningu:</label> <input id="currentValue" type="text" name="currentValue" readonly="readonly" value="1" style="width: 20px;"/>
					<input type="hidden" value="will" name='atr' />
					<br><input type="submit" name="will" value="Trenuj"/>
					<br><a href="main.php?action=map&city=2">Rozmyśliłem się (powrót)</a>
				</form>
			<?php
				
				break;
				
				case 6:
				
				echo '<center><h3>Trening refleksu</h3>';
				echo '<strong>Trener:</strong><br>';
				echo 'Ten trening kosztuje 55<img src="/templates/img/whiteBeli.png"/> za godzinę i polega na łapaniu rzucanych piłeczek. Porządny trening pożera wiele sił witalnych, więc nie przesadź! Nie chce mi się Ciebie wynosić z sali...<br>';
				
				$wynik = $model->select('statistics', 'ref_lvl', 'id='.$_SESSION['zalogowany']);
				$ref_lvl = $wynik[0]['ref_lvl'];
				
				if($ref_lvl < 5)
					echo '<br><strong>Na początek zalecam Ci wybranie 1 piłeczki.</strong><br><br>';
				if($ref_lvl >= 5 && $ref_lvl < 10)
					echo '<br><strong>Teraz możemy pomyśleć o 5 piłeczkach.</strong><br><br>';
				if($ref_lvl >= 10 && $ref_lvl < 15)
					echo '<br><strong>Teraz możemy pomyśleć o 10 piłeczkach.</strong><br><br>';
				if($ref_lvl >= 15 && $ref_lvl < 25)
					echo '<br><strong>Teraz możemy pomyśleć o 15 piłeczkach. Tylko tak dalej!</strong><br><br>';
				if($ref_lvl >= 25 && $ref_lvl < 50)
					echo '<br><strong>Dobrze Ci idzie! Teraz możemy pomyśleć o 25 piłeczkach.</strong><br><br>';
				if($ref_lvl >= 50 && $ref_lvl < 100)
					echo '<br><strong>No, nareszcie dojrzałeś do porządnego treningu interwałowego! Teraz możemy pomyśleć o 50 piłeczkach.</strong><br><br>';
				if($ref_lvl >= 100 && $ref_lvl < 150)
					echo '<br><strong>100 piłeczek... Może będą z Ciebie ludzie.</strong><br><br>';
			?>
				<form method="post" action="main.php?action=map&city=2" name="frame">
				<label for="weight">Liczba piłeczek:</label> <select name="weight" style="width: 100px; text-align: center;">
						<option>1</option>
						<?if($ref_lvl >= 5) {?><option>5</option><?} ?>
						<?if($ref_lvl >= 10) {?><option>10</option><?} ?>
						<?if($ref_lvl >= 15) {?><option>15</option><?} ?>
						<?if($ref_lvl >= 25) {?><option>25</option><?} ?>
						<?if($ref_lvl >= 50) {?><option>50</option><?} ?>
						<?if($ref_lvl >= 100) {?><option>100</option><?} ?>
					</select>
					<div id="slider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-willtent ui-corner-all" style="width: 200px;">
					<a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 0%;"></a>
					</div>
					<label for="currentValue">Liczba godzin treningu:</label> <input id="currentValue" type="text" name="currentValue" readonly="readonly" value="1" style="width: 20px;"/>
					<input type="hidden" value="ref" name='atr' />
					<br><input type="submit" name="ref" value="Trenuj"/>
					<br><a href="main.php?action=map&city=2">Rozmyśliłem się (powrót)</a>
				</form>
			<?php
				
				break;
				
				case 7:
				
				echo '<center><h3>Trening celności</h3>';
				echo '<strong>Trener:</strong><br>';
				echo 'Ten trening kosztuje 65<img src="/templates/img/whiteBeli.png"/> za godzinę i polega na strzelaniu do celu. Porządny trening pożera wiele sił witalnych, więc nie przesadź! Nie chce mi się Ciebie wynosić z sali...<br>';
				
				$wynik = $model->select('statistics', 'acc_lvl', 'id='.$_SESSION['zalogowany']);
				$acc_lvl = $wynik[0]['acc_lvl'];
				
				if($acc_lvl < 5)
					echo '<br><strong>Na początek zalecam Ci wybranie 1m.</strong><br><br>';
				if($acc_lvl >= 5 && $acc_lvl < 10)
					echo '<br><strong>Teraz możemy pomyśleć o 5m.</strong><br><br>';
				if($acc_lvl >= 10 && $acc_lvl < 15)
					echo '<br><strong>Teraz możemy pomyśleć o 10m.</strong><br><br>';
				if($acc_lvl >= 15 && $acc_lvl < 25)
					echo '<br><strong>Teraz możemy pomyśleć o 15m. Tylko tak dalej!</strong><br><br>';
				if($acc_lvl >= 25 && $acc_lvl < 50)
					echo '<br><strong>Dobrze Ci idzie! Teraz możemy pomyśleć o 25m.</strong><br><br>';
				if($acc_lvl >= 50 && $acc_lvl < 100)
					echo '<br><strong>No, nareszcie dojrzałeś do porządnego treningu interwałowego! Teraz możemy pomyśleć o 50m.</strong><br><br>';
				if($acc_lvl >= 100 && $acc_lvl < 150)
					echo '<br><strong>100m... Może będą z Ciebie ludzie.</strong><br><br>';
			?>
				<form method="post" action="main.php?action=map&city=2" name="frame">
				<label for="weight">Odległość od celu (m):</label> <select name="weight" style="width: 100px; text-align: center;">
						<option>1</option>
						<?if($acc_lvl >= 5) {?><option>5</option><?} ?>
						<?if($acc_lvl >= 10) {?><option>10</option><?} ?>
						<?if($acc_lvl >= 15) {?><option>15</option><?} ?>
						<?if($acc_lvl >= 25) {?><option>25</option><?} ?>
						<?if($acc_lvl >= 50) {?><option>50</option><?} ?>
						<?if($acc_lvl >= 100) {?><option>100</option><?} ?>
					</select>
					<div id="slider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-willtent ui-corner-all" style="width: 200px;">
					<a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 0%;"></a>
					</div>
					<label for="currentValue">Liczba godzin treningu:</label> <input id="currentValue" type="text" name="currentValue" readonly="readonly" value="1" style="width: 20px;"/>
					<input type="hidden" value="acc" name='atr' />
					<br><input type="submit" name="acc" value="Trenuj"/>
					<br><a href="main.php?action=map&city=2">Rozmyśliłem się (powrót)</a>
				</form>
			<?php
				
				break;
				
				case 8:
				
				echo '<center><h3>Trening instynktu</h3>';
				echo '<strong>Trener:</strong><br>';
				echo 'Ten trening kosztuje 45<img src="/templates/img/whiteBeli.png"/> za godzinę i polega na unikaniu przeszkód przy przewiązanych opaską oczach. Porządny trening pożera wiele sił witalnych, więc nie przesadź! Nie chce mi się Ciebie wynosić z sali...<br>';
				
				$wynik = $model->select('statistics', 'ins_lvl', 'id='.$_SESSION['zalogowany']);
				$ins_lvl = $wynik[0]['ins_lvl'];
				
				if($ins_lvl < 5)
					echo '<br><strong>Na początek zalecam Ci wybranie pojedynczej przeszkody.</strong><br><br>';
				if($ins_lvl >= 5 && $ins_lvl < 10)
					echo '<br><strong>Teraz możemy pomyśleć o 5 przeszkodach.</strong><br><br>';
				if($ins_lvl >= 10 && $ins_lvl < 15)
					echo '<br><strong>Teraz możemy pomyśleć o 10 przeszkodach.</strong><br><br>';
				if($ins_lvl >= 15 && $ins_lvl < 25)
					echo '<br><strong>Teraz możemy pomyśleć o 15 przeszkodach. Tylko tak dalej!</strong><br><br>';
				if($ins_lvl >= 25 && $ins_lvl < 50)
					echo '<br><strong>Dobrze Ci idzie! Teraz możemy pomyśleć o 25 przeszkodach.</strong><br><br>';
				if($ins_lvl >= 50 && $ins_lvl < 100)
					echo '<br><strong>No, nareszcie dojrzałeś do porządnego treningu interwałowego! Teraz możemy pomyśleć o 50 przeszkodach.</strong><br><br>';
				if($ins_lvl >= 100 && $ins_lvl < 150)
					echo '<br><strong>100 przeszkód... Może będą z Ciebie ludzie.</strong><br><br>';
			?>
				<form method="post" action="main.php?action=map&city=2" name="frame">
				<label for="weight">Interwały:</label> <select name="weight" style="width: 100px; text-align: center;">
						<option>1</option>
						<?if($ins_lvl >= 5) {?><option>5</option><?} ?>
						<?if($ins_lvl >= 10) {?><option>10</option><?} ?>
						<?if($ins_lvl >= 15) {?><option>15</option><?} ?>
						<?if($ins_lvl >= 25) {?><option>25</option><?} ?>
						<?if($ins_lvl >= 50) {?><option>50</option><?} ?>
						<?if($ins_lvl >= 100) {?><option>100</option><?} ?>
					</select>
					<div id="slider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-willtent ui-corner-all" style="width: 200px;">
					<a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 0%;"></a>
					</div>
					<label for="currentValue">Liczba godzin treningu:</label> <input id="currentValue" type="text" name="currentValue" readonly="readonly" value="1" style="width: 20px;"/>
					<input type="hidden" value="ins" name='atr' />
					<br><input type="submit" name="ins" value="Trenuj"/>
					<br><a href="main.php?action=map&city=2">Rozmyśliłem się (powrót)</a>
				</form>
			<?php
				
				break;
				
				default: break;
				
			}
	}
	
	public function shopView()
	{
		$model = $this->loadModel('map');
		$wynik = $model->select('users', 'nickname', 'id='.$_SESSION['zalogowany']);
		$nick = $wynik[0]['nickname'];
		
		echo '<center><h3>Wszedłeś do sklepu.</h3></center>';
		echo '<center><img src="/templates/img/NPCs/sprzedawca.png"/></center><br>';
		echo '<center><table><tr><td><strong>Sprzedawca: </strong></td><td>*hiik!* W czym mogę pomóc?</td></tr>';
		echo '<tr><td valign="top"><strong>'.$nick.': </strong></td><td>	<a href="main.php?action=map&city=3&shop=1">Chcę coś kupić.</a><br>
																					<a href="main.php?action=map&city=3&shop=2">Chcę coś sprzedać.</a><br>
																					<a href="main.php?action=map">Właśnie wychodziłem (koniec).</a>';
		echo '</table></center>';
	}
	
	public function buySth()
	{
		$model = $this->loadModel('map');
		$wynik = $model->select('users', 'nickname', 'id='.$_SESSION['zalogowany']);
		$nick = $wynik[0]['nickname'];
		
		echo '<center><img src="/templates/img/NPCs/sprzedawca.png"/></center><br>';
		echo '<center><table><tr><td><strong>Sprzedawca: </strong></td><td>Przykro mi, ale *hiik!* chwilowo nie mamy asortymentu.</td></tr>';
		echo '<tr><td valign="top"><strong>'.$nick.': </strong></td><td>	<a href="main.php?action=map&city=3">Okay... (powrót)</a><br>
																					<a href="main.php?action=map">No nie, co to za sklep?! Wychodzę! (koniec).</a><br>';
		echo '</table></center>';
	}
	
	public function sellSth($part)
	{
		$model = $this->loadModel('map');
		$wynik = $model->select('users', 'nickname', 'id='.$_SESSION['zalogowany']);
		$nick = $wynik[0]['nickname'];
		
		echo '<center><img src="/templates/img/NPCs/sprzedawca.png"/></center><br>';
		echo '<center><table><tr><td><strong>Sprzedawca: </strong></td><td>Zobaczmy, co szanowny pan ma do zaoferowania. *hiik!*</td></tr>';
		echo '</table></center>';
			
		 ?>
			
		<div>
		<p style="font-size: 20pt; font-weight: bolder;">Twoje przedmioty: </p>
		<form style="position: absolute; left: 245px; top: 560px;">
		<select name="eq" size="1" onchange="window.location.href='main.php?action=map&city=3&shop=2&part=' + this.value;">
		<option value="1" <? if ($part=="1") echo "SELECTED"; ?>>Nakrycia glowy</option>
		<option value="2" <? if ($part=="2") echo "SELECTED"; ?>>Okrycia korpusu</option>
		<option value="3" <? if ($part=="3") echo "SELECTED"; ?>>Nogawice</option>
		<option value="4" <? if ($part=="4") echo "SELECTED"; ?>>Buty</option>
		<option value="5" <? if ($part=="5") echo "SELECTED"; ?>>Bizuteria</option>
		<option value="6" <? if ($part=="6") echo "SELECTED"; ?>>Dlon</option>
		<option value="7" <? if ($part=="7") echo "SELECTED"; ?>>Pozostale</option>
		</select>
		</form>
		</div>
		<div id="desc" style="position: absolute; top: 320px; left: 100px; display: none; border: solid 5px #1a1a1a; background-color: #a0a0a0; opacity: 0.8; height: 100px; width: 600px;">
			<p id="name" style="position: absolute; left: 10px; top: 10px; font-size: 14;"></p>
			<p id="lvl" style="position: absolute; left: 10px; top: 50px; font-size: 12;"></p>
			<p id="atr" style="position: absolute; left: 300px; top: 10px; font-size: 12;"></p>
			<p id="comm" style="position: absolute; left: 300px; top: 50px; font-size: 12;"></p>
		</div>
		<div style=" position: relative; height: 150px;">
		<?php
		switch($part)
		{
			case 1: $part2='all_head'; break;
			case 2: $part2='all_body'; break;
			case 3: $part2='all_legs'; break;
			case 4: $part2='all_shoes'; break;
			case 5: $part2='jewellery'; break;
			case 6: $part2='all_hand'; break;
			case 7: $part2='others'; break;
			default: break;
		}
		$wynik = $model->select('equipment', $part2, 'id='.$_SESSION['zalogowany']);
		$itemek = $wynik[0][$part2];
		$item = explode(',', $itemek);
		$ile = count($item);
		if($itemek == '') $ile = 0;
		for($i = 0; $i < $ile; $i++)
		{
			$info = explode('-', $item[$i]);
			$iid = $info[0];
			$ilvl = $info[1];
			$wynik = $model->select('items', 'name,atr', 'id='.$iid);
			$avatar = '/templates/img/EQ/'.$wynik[0]['name'].'.jpg';
			$name = $wynik[0]['name'];
			$iatr = $wynik[0]['atr'];
			if($iatr == 'str') $atr = 'Siła';
			if($iatr == 'dex') $atr = 'Zręczność';
			if($iatr == 'stam') $atr = 'Wytrzymałość';
			if($iatr == 'ment') $atr = 'Siła duchowa';
			if($iatr == 'will') $atr = 'Kondycja';
			?>
			<form action='main.php?action=map&city=3&shop=2' method='post'>
			<input style='position: absolute; top: 110px; left: <? echo (58 + 100*$i); ?>px; width: 14px; height: 14px;' type="checkbox" name="sell[]" value="<? echo $part.'/'.$i; ?>"/><div class="slot" id="s<? echo $i; ?>" style="position: absolute; left: <? echo (15 + 100*$i); ?>px; top: 10px;"><img style="overflow: hidden;" src="<? echo $avatar; ?>" width="90" height="90" onmouseover="$('#desc').css('display','block'); $('#name').html('Nazwa: <? echo $name; ?>'); $('#lvl').html('Bonus: <? echo $ilvl; ?>'); $('#atr').html('Atrybut: <? echo $atr; ?>');" onmouseout="$('#desc').css('display','none');"/></div><?php
		}
		for($i = 6; $i >= $ile; $i--)
		{
			?>
			<input style='position: absolute; top: 110px; left: <? echo (58 + 100*$i); ?>px; width: 14px; height: 14px;' type="checkbox" name="sell[]" value="<? echo $part.'/'.$i; ?>" disabled="disabled" /><div class="slot" id="s<? echo $i; ?>" style="position: absolute; left: <? echo (15 + 100*$i); ?>px; top: 10px;"></div>
			<?php
		}
		?> 
		<input style='position: absolute; left: 344px; top: 130px;' type='submit' value='Oferuj' name='offerButton'/>
		</form></div>
		<?php
	}
	
	public function dialog($sell)
	{
				$model = $this->loadModel('map');
				$items = Array();
				$ile = count($sell);
				$suma = 0;
				for($i = 0; $i < $ile; $i++)
				{
				$item = explode('/', $sell[$i]);
				$items[] = $item[1];
				switch($item[0])
				{
					case 1: $part2='all_head'; break;
					case 2: $part2='all_body'; break;
					case 3: $part2='all_legs'; break;
					case 4: $part2='all_shoes'; break;
					case 5: $part2='jewellery'; break;
					case 6: $part2='all_hand';break;
					case 7: $part2='others';break;
					default: break;
				}
				
					$wynik = $model->select('equipment', $part2, 'id='.$_SESSION['zalogowany']);
					$itemek = $wynik[0][$part2];
					$item2 = explode(',', $itemek);
					$item_to_sell = $item2[$item[1]];
					$item3 = explode('-', $item_to_sell);
					$suma += $item3[1];
				}
				$whichones = $part2.'|';
				$whichones .= implode(',', $items);
					

				?> <script type='text/javascript'> $(document).ready(function() {$('input:hidden[name=items]').val('<? echo $whichones; ?>'); $('input:hidden[name=gold]').val('<? echo (10*$suma); ?>'); $('#info').html('Za to wszystko mogę Ci dać... <? echo (10*$suma); ?>' + '\u003Cimg src="/templates/img/whiteBeli.png"\u2044\u003E.'); $('#desc2').css('display','block');});</script> <?

	?>
		<div id="desc2" style="position: absolute; left: 220px; top: 200px; border: solid 5px #000055; display: none; border-radius: 30px; background-color: #0000ff; width: 300px; padding-left: 20px; padding-top: 10px; padding-right: 20px; padding-bottom: 10px;">
		<p id="info" style="text-align: center; text-size: 32px;"> </p>
		<p style="text-align: center; text-size: 32px;">Przyjmujesz?</p>
		<center>
		<form action='main.php?action=map&city=3&shop=2&part=<? echo $item[0]; ?>' method='post'>
		<input type="hidden" name="items" value="" />
		<input type="hidden" name="gold" value="" />
		<input type='submit' name='submitItems' value='Tak' onclick='$("#desc2").css("display","none");'/></form>
		<button onclick='$("#desc2").css("display","none"); return false;'>Nie</button>
		</center>
		</div>
	<?php
	}
}
?>