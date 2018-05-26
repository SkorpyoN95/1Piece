<?php include('templates/header.html.php'); ?>

<div style='position:absolute; top: 10px; left: 200px; height: 50px; width: 800px; font-size: 45px;'>
<div style='position:absolute; top: 0px; left: 0px; height: 50px; width: 200px; border-radius: 30px; padding: 5px 20px;
background: -webkit-linear-gradient(left, rgba(255,255,0,0.25), rgba(255,255,0,0.75), rgba(255,255,0,1), rgba(255,255,0,0.75), rgba(255,255,0,0.25)); /* For Safari 5.1 to 6.0 */
background: -o-linear-gradient(right, rgba(255,255,0,0.25), rgba(255,255,0,0.75), rgba(255,255,0,1), rgba(255,255,0,0.75), rgba(255,255,0,0.25)); /* For Opera 11.1 to 12.0 */
background: -moz-linear-gradient(right, rgba(255,255,0,0.25), rgba(255,255,0,0.75), rgba(255,255,0,1), rgba(255,255,0,0.75), rgba(255,255,0,0.25)); /* For Firefox 3.6 to 15 */
background: linear-gradient(right, rgba(255,255,0,0.25), rgba(255,255,0,0.75), rgba(255,255,0,1), rgba(255,255,0,0.75), rgba(255,255,0,0.25)); /* Standard syntax (must be last) */'>
	<a href="#" style="color: black;" onclick='$("#register").css("display","none"); $("#remind").css("display","none"); $("#log_in").css("display","block");'>Logowanie</a>
</div>

<div style='position:absolute; top: 0px; left: 300px; height: 50px; width: 200px; border-radius: 30px; padding: 5px 20px;
background: -webkit-linear-gradient(left, rgba(255,255,0,0.25), rgba(255,255,0,0.75), rgba(255,255,0,1), rgba(255,255,0,0.75), rgba(255,255,0,0.25)); /* For Safari 5.1 to 6.0 */
background: -o-linear-gradient(right, rgba(255,255,0,0.25), rgba(255,255,0,0.75), rgba(255,255,0,1), rgba(255,255,0,0.75), rgba(255,255,0,0.25)); /* For Opera 11.1 to 12.0 */
background: -moz-linear-gradient(right, rgba(255,255,0,0.25), rgba(255,255,0,0.75), rgba(255,255,0,1), rgba(255,255,0,0.75), rgba(255,255,0,0.25)); /* For Firefox 3.6 to 15 */
background: linear-gradient(right, rgba(255,255,0,0.25), rgba(255,255,0,0.75), rgba(255,255,0,1), rgba(255,255,0,0.75), rgba(255,255,0,0.25)); /* Standard syntax (must be last) */'>
	<a href="#" style="color: black;" onclick='$("#log_in").css("display","none"); $("#remind").css("display","none"); $("#register").css("display","block");'>Rejestracja</a>
</div>

<div style='position:absolute; top: 0px; left: 600px; height: 50px; width: 200px; border-radius: 30px; padding: 5px 20px;
background: -webkit-linear-gradient(left, rgba(255,255,0,0.25), rgba(255,255,0,0.75), rgba(255,255,0,1), rgba(255,255,0,0.75), rgba(255,255,0,0.25)); /* For Safari 5.1 to 6.0 */
background: -o-linear-gradient(right, rgba(255,255,0,0.25), rgba(255,255,0,0.75), rgba(255,255,0,1), rgba(255,255,0,0.75), rgba(255,255,0,0.25)); /* For Opera 11.1 to 12.0 */
background: -moz-linear-gradient(right, rgba(255,255,0,0.25), rgba(255,255,0,0.75), rgba(255,255,0,1), rgba(255,255,0,0.75), rgba(255,255,0,0.25)); /* For Firefox 3.6 to 15 */
background: linear-gradient(right, rgba(255,255,0,0.25), rgba(255,255,0,0.75), rgba(255,255,0,1), rgba(255,255,0,0.75), rgba(255,255,0,0.25)); /* Standard syntax (must be last) */'>
	<a href="#" style="color: black;" onclick='$("#register").css("display","none"); $("#log_in").css("display","none"); $("#remind").css("display","block");'>Nowe hasło</a>
</div>
</div>

<div style='position:absolute; top: 70px; left: 400px; height: 400px; width:400px; margin: 20px; background-image: url("/templates/img/frame.png"); background-size: 100% 100%; padding: 10px;'>
	<div id='log_in' style='display: block; color: #ffffff;'>
		<p style='position: absolute; top: 0px; left: 112px; font-size: 45px;'>Logowanie</p>
		<form style='position: absolute; left: 91px; top: 150px;' method="post" action="index.php">
			<table>
				<tr>
					<td>Login:</td> <td><input type="text" name="login" /></td>
				</tr>
				<tr>
					<td>Hasło:</td> <td><input type="password" name="haslo" /></td>
				</tr>
				<tr>
					<td colspan='2'><center><input type="submit" value="Loguj" /></center></td>
				</tr>
			</table>
		</form>
	</div>

	<div id='register' style='display: none; color: #ffffff;'>
		<p style='position: absolute; top: 0px; left: 112px; font-size: 45px;'>Rejestracja</p>
		<form style='position: absolute; left: 75px; top: 150px;' method="post" action="index.php">
			<table>
				<tr>
					<td>Login:</td> <td><input type="text" name="login2" /></td>
				</tr>
				<tr>
					<td>Haslo:</td> <td><input type="password" name="haslo2" /></td>
				</tr>
				<tr>
					<td>Powtórz haslo:</td> <td><input type="password" name="haslo22" /></td>
				</tr>
				<tr>
					<td>Nick:</td> <td><input type="text" name="nick" /></td>
				</tr>
				<tr>
					<td>E-mail:</td> <td><input type="text" name="email" /></td>
				</tr>
				<tr>
					<td colspan='2'><center><input type="submit" value="Wyślij" /></center></td>
				</tr>
			</table>
		</form>
	</div>

	<div id='remind' style='display: none; color: #ffffff;'>
		<p style='position: absolute; top: 0px; left: 90px; font-size: 45px;'>Zmiana hasła</p>
		<form style='position: absolute; left: 95px; top: 150px;' method="post" action="index.php">
			<table>
				<tr>
					<td>E-mail:</td> <td><input type="text" name="email2" /></td>
				</tr>
				<tr>
					<td colspan='2'><center><input type="submit" value="Wyślij" /></center></td>
				</tr>
			</table>
		</form>
	</div>
</div>
<?php include('templates/footer.html.php'); ?>

<?php
include('controller/indexController.php');
$ob = new IndexController();

if(isset($_POST['login']) && isset($_POST['haslo']))
{
	$login = $ob->safeData($_POST['login']);
	$password = $ob->safeData($_POST['haslo']);
	$ob->log_in($login, $password);
}

if(isset($_POST['login2']) && isset($_POST['haslo2']) && isset($_POST['haslo22']) && isset($_POST['nick']) && isset($_POST['email']))
{
	$login = $ob->safeData($_POST['login2']);
	$password = $ob->safeData($_POST['haslo2']);
	$password2 = $ob->safeData($_POST['haslo22']);
	$nick = $ob->safeData($_POST['nick']);
	$email = $ob->safeData($_POST['email']);
	$ob->register($login, $password, $password2, $nick, $email);
}

if(isset($_POST['email2']))
{
	$email = $ob->safeData($_POST['email2']);
	$ob->remind($email);
}

if(isset($_GET['mail']) && isset($_GET['action']))
{
	$mail = $_GET['mail'];
	$code = $_GET['action'];
	
	$ob->active($mail, $code);
}

if(isset($_GET['imail']) && isset($_GET['new_password']))
{
	$mail = $_GET['imail'];
	$pass = $_GET['new_password'];
	
	$ob->changePass($mail, $pass);
}
?>