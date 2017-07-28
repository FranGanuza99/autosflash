<?php
require("database.php");
require("validator.php");
class Page
{
	//se crea esta funcion lo cual lo que hace es capturar una consulta sql
	//y el resultado es mostrado en un combobox
	public static function setCombo($label, $name, $value, $query)
	{
		$data = Database::getRows($query, null);
		print("<select name='$name' required>");
		if($data != null)
		{
			
			foreach($data as $row)
			{
				if(isset($_POST[$name]) == $row[0] || $value == $row[0])
				{
					print("<option value='$row[0]' selected>$row[1]</option>");
				}
				else
				{
					print("<option value='$row[0]'>$row[1]</option>");
				}
			}
		}
		else
		{
			print("<option value='' disabled selected>No hay registros</option>");
		}
		print("
			</select>
			<label>$label</label>
		");
	}
//se mandan los mensajes en caso de que exita algun accion mediante el numero que sea recibido
	public static function showMessage($type, $message, $url)
	{
		$text = addslashes($message);
		switch($type)
		{
			case 1:
				$title = "Éxito";
				$icon = "success";
				break;
			case 2:
				$title = "Error";
				$icon = "error";
				break;
			case 3:
				$title = "Advertencia";
				$icon = "warning";
				break;
			case 4:
				$title = "Aviso";
				$icon = "info";
		}
		if($url != null)
		{
			print("<script>swal({title: '$title', text: '$text', type: '$icon', confirmButtonText: 'Aceptar', allowOutsideClick: false, allowEscapeKey: false}).then(function(){location.href = '$url'})</script>");
		}
		else
		{
			print("<script>swal({title: '$title', text: '$text', type: '$icon', confirmButtonText: 'Aceptar', allowOutsideClick: false, allowEscapeKey: false})</script>");
		}
	}

	public static function timer()
	{
		if ((time() - $_SESSION['tiempo']) > 300) {
			//session_destroy();
			/* Aquí redireccionas a la url especifica */
			header("Location: ../public/logout.php");
		}
		else
		{
			$_SESSION['tiempo']=time();
		}
	}

}
?>