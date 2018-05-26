<?php
include_once 'view/view.php';

class PaView extends View
{
	public function choice()
	{
		?>
		<a style="" href="main.php?action=pa&op=news">Dodaj news</a> <br>
		<a style="" href="main.php?action=pa&op=newMove">Dodaj posunięcie</a>
		<?php
	}
	
	public function news()
	{
		?>
		<p>Dodaj news:</p>
		<form method="post" action="main.php?action=pa">
		<table>
		<tr>
		<td>Tytuł:</td> <td><input type="text" name="dn1" /></td>
		</tr>
		<tr>
		<td>Autor:</td> <td><input type="text" name="dn2" /></td>
		</tr>
		<tr>
		<td>Treść:</td> <td><textarea name="dn3" cols="40" rows="5"></textarea></td>
		</tr>
		<tr>
		<td><input type="submit" value="Dodaj" name="dnS"/></td>
		</tr>
		</table>
		</form>
		<?php
	}
	
	public function newMove()
	{
		?>
		<p>Dodaj posunięcie:</p>
		<form method="post" action="main.php?action=pa">
		<table>
		<tr>
		<td>ID:</td> <td><input type="text" name="nm1" /></td>
		</tr>
		<tr>
		<td>Name:</td> <td><input type="text" name="nm2" /></td>
		</tr>
		<tr>
		<td>Type:</td> <td><input type="text" name="nm3" /></td>
		</tr>
		<tr>
		<td>ATK:</td> <td><input type="text" name="nm4" /></td>
		</tr>
		<tr>
		<td>DEF:</td> <td><input type="text" name="nm5" /></td>
		</tr>
		<tr>
		<td>SPD:</td> <td><input type="text" name="nm6" /></td>
		</tr>
		<tr>
		<td>Cost:</td> <td><input type="text" name="nm7" /></td>
		</tr>
		<tr>
		<td>Wymóg1:</td> <td><input type="text" name="nm8" /></td>
		</tr>
		<tr>
		<td>Wymóg2:</td> <td><input type="text" name="nm9" /></td>
		</tr>
		<tr>
		<td><input type="submit" value="Dodaj" name="nmS"/></td>
		</tr>
		</table>
		</form>
		<?php
	}
}
?>