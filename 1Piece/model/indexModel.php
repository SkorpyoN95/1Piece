<?php
include 'model/model.php';

class IndexModel extends Model{

	public function log_in($login, $password)
	{
		$pass = md5($password);
		$data = $this->select('users', '*', 'login="'.$login.'" AND password="'.$pass.'"');
		if(!count($data))
		{
			return 'Logowanie nie powiodło się. </br>Błędny login i/lub hasło.';
		}
		else 
		{
			if($data[0]['active'] == 0) return 'Logowanie nie powiodło się. </br>Konto nieaktywne.';
			if($data[0]['banned'] == 1)
			{
				$wynik = $this->select('banned', '*', 'id_who='.$data[0]['id']);
				$end = $wynik[0]['end_date'];
				$end2 = date('d.m.Y h:i', $end);
				$reason = $wynik[0]['reason'];
				return "Konto zostało zablokowane! <br> Powód: ".$reason.". <br> Koniec kary: ".$end2.".";
			}
			//echo '<script>alert("'.$data[0]['id'].'");</script>';
			$_SESSION['zalogowany'] = $data[0]['id'];
			return '';
		}
	}
	
	public function register($login, $pass, $pass2, $nick, $email)
	{
	   if($pass != $pass2) return 'Hasła muszą być takie same!';
	   $wynik = $this->select('users', '*', 'login="'.$login.'"');
	   $ile = count($wynik);
       if($ile > 0)	return "Login zajęty, musisz wybrać inny!";
       else
	   {
		   $wynik = $this->select('users', '*', 'nickname="'.$nick.'"');
		   $ile = count($wynik);
		   if($ile > 0)	return "Nick zajęty, musisz wybrać inny!";
		   
		   $wynik = $this->select('users', '*', 'email="'.$email.'"');
		   $ile = count($wynik);
		   if($ile > 0)	return "Wykryto próbę założenia multikonta!";
		   else
		   {
				$date = date("d-m-Y H:i"); 
				$code = md5($date."GhC3491aaw"); 
				$password = md5($pass); 

				$stmnt = $this->pdo->prepare("INSERT INTO users VALUES(null, 0, ?, ?, ?, ?, 0, ?, 0, '')");
				$stmnt->bindValue(1, $login, PDO::PARAM_STR);
				$stmnt->bindValue(2, $password, PDO::PARAM_STR);
				$stmnt->bindValue(3, $nick, PDO::PARAM_STR);
				$stmnt->bindValue(4, $email, PDO::PARAM_STR);
				$stmnt->bindValue(5, $code, PDO::PARAM_STR);
				$stmnt->execute();
				
				$zapytanie = $this->select('users', 'id', 'login="'.$login.'" AND password="'.$password.'"');
				$id = $zapytanie[0]['id'];
				
				$stmnt = $this->pdo->prepare("INSERT INTO descriptions VALUES('?', '')");
				$stmnt->bindValue(1, $id, PDO::PARAM_INT);
				$stmnt->execute();
				
				$stmnt = $this->pdo->prepare("INSERT INTO bars VALUES(?, 0, 1000, 1000, 500, 500, 0, 500, 0, 100, 100, 0, ?)");
				$stmnt->bindValue(1, $id, PDO::PARAM_INT);
				$stmnt->bindValue(2, time(), PDO::PARAM_INT);
				$stmnt->execute();
				
				$stmnt = $this->pdo->prepare("INSERT INTO statistics VALUES(?,'',0,0,25,0,0,25,0,0,25,0,0,25,0,0,25,0,0,25,0,0,25,0,0,25)");
				$stmnt->bindValue(1, $id, PDO::PARAM_INT);
				$stmnt->execute();
				
				$stmnt = $this->pdo->prepare("INSERT INTO fights VALUES(null,false,false,0,0,0,0,0,0,false,false,0,0,0,0,0,0)");
				$stmnt->execute();
				
				$stmnt = $this->pdo->prepare("INSERT INTO training VALUES(".$id.",false,'',0,0,0)");
				$stmnt->bindValue(1, $id, PDO::PARAM_INT);
				$stmnt->execute();
				
				$stmnt = $this->pdo->prepare('insert into equipment values('.$id.', false, "","","","","","","","","","","","","","","","","","")');
				$stmnt->bindValue(1, $id, PDO::PARAM_INT);
				$stmnt->execute();
				
				$wynik = $this->select('users', 'code', 'id='.$id);
				$title = "Potwierdzenie rejestracji";
				$text = '<html><body>Oto link aktywacyjny dla Twojego konta: <br> <a href="http://1piece.cba.pl/index.php?mail='.$email.'&action='.$wynik[0]['code'].'">Link</a></body></html>';
				$this->sendMail($title, $text, $email);
				
				return "Rejestracja przebiegła pomyślnie! Aktywuj swoje konto za pomocą linku wysłanego na podany adres. Jeżeli nie dostałeś wiadomości, sprawdź SPAM.";
		   }
	   }
	   return true;
	}
	
	public function remind($email)
	{
		$wynik = $this->select('users', 'id', 'email="'.$email.'"');
		if(count($wynik) == 0) return 'Podany adres mailowy nie widnieje przy żadnym koncie.';
		
		$letters = 'abcdefghijklmnopqrstuvwxyz';
		$letters .= strtoupper($letters);
		$letters2 = str_split($letters);
		
		$new_pass = '';
		
		for($i = 0; $i < 10; $i++)
		{
			$pass .= $letters2[rand(0, (count($letters2) - 1) )];
		}
		
		$new_pass = md5($pass);
		$title = "Nowe hasło";
		$text = '<html><body>Twoje nowe hasło to: '.$pass.'.<br>Oto link, którym aktywujesz nowe hasło (dopóki tego nie zrobisz, będzie obowiązywać stare): <br> <a href="http://1piece.cba.pl/index.php?imail='.$email.'&new_password='.$new_pass.'">Link</a><br><br>
				Jeżeli nie prosiłeś o nowe hasło lub przypomniałeś sobie stare, po prostu zignoruj tą wiadomość.</body></html>';
				
		$this->sendMail($title, $text, $email);
				
		return "Wysłano maila z nowym hasłem. Jeżeli nie dostałeś wiadomości, sprawdź SPAM.";
 
	}

	public function sendMail($title, $text, $address)
	{
		$naglowki  = "From: admin@cba.pl\r\n";
		$naglowki .= 'MIME-Version: 1.0'."\r\n";
		$naglowki .= 'Content-type: text/html; charset=utf-8'."\r\n";
		
		mail($address, $title, $text, $naglowki);
	}
	
	public function active($mail, $code)
	{
		$wynik = $this->select('users', 'active,code', 'email="'.$mail.'"');
		if(count($wynik) == 0) return 'Podany adres mailowy nie widnieje przy żadnym koncie.';
		if($wynik[0]['code'] != $code) return 'Nieprawidłowy kod walidacyjny!';
		if($wynik[0]['active'] == true) return 'Konto zostało już aktywowane; nie ma potrzeby robić tego drugi raz.';
		
		$stmnt = $this->pdo->prepare('update users set active=true where email=? AND code=?');
		$stmnt->bindValue(1, $mail, PDO::PARAM_STR);
		$stmnt->bindValue(2, $code, PDO::PARAM_STR);
		$stmnt->execute();
		
		return 'Aktywacja konta przebiegła pomyślnie - możesz się zalogować.';
	}
	
	public function changePass($mail, $pass)
	{
		$stmnt = $this->pdo->prepare("update users set password=? where email=?");
		$stmnt->bindValue(1, $pass, PDO::PARAM_STR);
		$stmnt->bindValue(2, $mail, PDO::PARAM_STR);
		$count = $stmnt->execute();
		if($count == 1) return 'Hasło zostało zmienione. Możesz zalogować się hasłem, otrzymanym w emialu.<br>Przypominam, że własne hasło możesz ustalić w Opcjach.';
		else return 'Wystąpił błąd, nowe hasło nie zostało zmienione.';
	}
}

?>