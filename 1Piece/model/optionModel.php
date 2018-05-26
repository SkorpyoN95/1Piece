<?php
include_once 'model/model.php';

class OptionModel extends Model
{
	public function changeAvatar()
	{
		if ($_FILES['avatar']['error'] > 0)
			{
				switch ($_FILES['avatar']['error'])
				{
					// jest większy niż domyślny maksymalny rozmiar,
					// podany w pliku konfiguracyjnym
					case 1: {$info = 'Rozmiar pliku jest zbyt duzy.'; break;} 
	  
					// jest większy niż wartość pola formularza 
					// MAX_FILE_SIZE
					case 2: {$info = 'Rozmiar pliku jest zbyt duży.'; break;}
	  
					// plik nie został wysłany w całości
					case 3: {$info = 'Plik wysłany tylko częściowo.'; break;}
	  
					// plik nie został wysłany
					case 4: {$info = 'Nie wysłano żadnego pliku.'; break;}
	  
					// pozostałe błędy
					default: {$info = 'Wystąpił błąd podczas wysyłania.'; break;}
				}
			}else
			if(is_uploaded_file($_FILES['avatar']['tmp_name']))
			{
				if ($_FILES['avatar']['type'] != 'image/jpeg') $info = 'Złe rozszerzenie!';
				else
				{
					$size = getimagesize($_FILES['avatar']['tmp_name']);
					if($size[0] > 295 || $size[1] > 213)
						$info = 'Wymiary obrazka są za duże!';
					else
					{
						$lokalizacja = "templates/img/Avatary/".$_SESSION['zalogowany'].".jpg";
						if(!move_uploaded_file($_FILES['avatar']['tmp_name'], $lokalizacja))
							$info = 'Błąd przy przenoszeniu pliku.';
						else 
							$info = 'Ładowanie avatara zakończone pomyślnie! Jeżeli nie widzisz zmian, wciśnij [Shift]+[F5].';
					}
				}
			}
			else
				$info = 'Nie wskazałeś żadnego pliku!';
		return $info;
	}
	
	public function changeDesc()
	{
		if(isset($_POST['opis']) && isset($_POST['submitOpis']))
		{
			$opis = $this->safeData($_POST['opis']);
			$stmnt = $this->pdo->prepare("update descriptions set opis=? where id=?");
			$stmnt->bindValue(1, $opis, PDO::PARAM_STR);
			$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
			$count = $stmnt->execute();
			if($count == 1) return 'Opis został zmieniony.';
			else return 'Wystąpił błąd, opis nie został zapisany.';
		}
	}
	
	public function changePass()
	{
		if(isset($_POST['nowe']) && isset($_POST['stare'])  && ($_POST['nowe'] != '') && isset($_POST['submitHaslo']))	
		{
			$stare = md5($this->safeData($_POST['stare']));
			$nowe = md5($this->safeData($_POST['nowe']));
			$obecne = $this->select('users', 'password', 'id='.$_SESSION['zalogowany']);
			if($stare === $obecne[0]['password'])
			{
				$stmnt = $this->pdo->prepare("update users set password=? where id=?");
				$stmnt->bindValue(1, $nowe, PDO::PARAM_STR);
				$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
				$count = $stmnt->execute();
				if($count == 1) return 'Hasło zostało zmienione.';
				else return 'Wystąpił błąd, nowe hasło nie zostało zapisane.';
			}else return 'Podane hasło jest nieprawidłowe.';
		}	
		else return 'Uzupełnij pola!';
	}
	
	public function changeMail()
	{
		if(isset($_POST['mail']) && isset($_POST['confpass']) && ($_POST['mail'] != '') && isset($_POST['submitMail']))	
		{
			$mail = $this->safeData($_POST['mail']);
			$pass = $this->safeData($_POST['confpass']);
			$obecne = $this->select('users', 'password', 'id='.$_SESSION['zalogowany']);
			if($pass === $obecne[0]['password'])
			{
				$stmnt = $this->pdo->prepare("update users set email=? where id=?");
				$stmnt->bindValue(1, $mail, PDO::PARAM_STR);
				$stmnt->bindValue(2, $_SESSION['zalogowany'], PDO::PARAM_INT);
				$count = $stmnt->execute();
				if($count == 1) return 'Adres został zmieniony.';
				else return 'Wystąpił błąd, nowy adres nie został zapisany.';
			}else return 'Podane hasło jest nieprawidłowe.';
		}
		else return 'Uzupełnij pola!';
	}
}
?>