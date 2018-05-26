	<div style='position: relative; width: 500px; margin: 50px auto; text-align: center;'>
	<p style='text-align: center; font-size: 36px; font-weight: bolder;'>Ustaw avatar</p>
	<form enctype="multipart/form-data" action="main.php?action=option" method="post" >
	<input type="hidden" name="MAX_FILE_SIZE" value="150000" />
	<input type="hidden" name="changeObject" value="changeAvatar" />
	<input type="file" name="avatar" /> <input type="submit" value="Zmień" />
	<p style='text-align: center; font-size: 18px; font-weight: bolder;'>Maksymalne wymiary to: 295 x 213. Maksymalny rozmiar: 150KB. Dopuszczane rozszerzenie: .jpg.</p>
	</form>
	</div>
	
	
	<div style='position: relative; width: 500px; margin: 50px auto; text-align: center;'>
	<p style='text-align: center; font-size: 36px; font-weight: bolder;'>Ustaw opis</p>
	<form action="main.php?action=option" method="post">
	<input type="hidden" name="changeObject" value="changeDesc" />
	<textarea name="opis" cols="55" rows="10"></textarea><br>
	<input type="submit" name="submitOpis" value="Zmień" />
	</form>
	</div>
	
	
	<div style='position: relative; width: 500px; margin: 50px auto; text-align: center;'>
	<p style='text-align: center; font-size: 36px; font-weight: bolder;'>Zmiana hasła</p>
	<form action="main.php?action=option" method="post">
	<input type="hidden" name="changeObject" value="changePass" />
	<label for="stare">Stare hasło: </label><input id="stare" type="password" name="stare" /><br>
	<label for="nowe">Nowe hasło: </label><input id="nowe" type="password" name="nowe" /><br>
	<input type="submit" name="submitHaslo" value="Potwierdź" />
	</form>
	</div>
	
	
	<div style='position: relative; width: 500px; margin: 50px auto; text-align: center;'>
	<p style='text-align: center; font-size: 36px; font-weight: bolder;'>Zmiana adresu mailowego</p>
	<form action="main.php?action=option" method="post">
	<input type="hidden" name="changeObject" value="changeMail" />
	<label for="mail">Nowy email: </label><input id="mail" type="text" name="mail" /><br>
	<label for="confpass">Hasło: </label><input style="position: relative; left: 19px;" id="confpass" type="password" name="confpass" /><br>
	<input type="submit" name="submitMail" value="Potwierdź" />
	</form>
	</div>