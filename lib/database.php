<?php
class Database
{
    private static $connection;
    private static $statement;
    public static $id;
    //se inicia la conexion
    private static function connect()
    {
        //se colocan las credenciales y la base a la que se va a conectar
        $server = "localhost";
        $database = "tienda";
        $username = "root";
        $password = "";
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8");
        self::$connection = null;
        try
        {
            self::$connection = new PDO("mysql:host=".$server."; dbname=".$database, $username, $password, $options);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $exception)
        {
            //mensaje en caso de error con la base
            die($exception->getMessage());
        }
    }

    private static function desconnect()
    {
        //se deconecta
        self::$connection = null;
    }

    public static function executeRow($query, $values)
    {
        self::connect();
        self::$statement = self::$connection->prepare($query);
        try {
            $state = self::$statement->execute($values);
            self::$id = self::$connection->lastInsertId();
            return $state;
        } catch(PDOException $exception){
            $error = self::$statement->errorInfo();
            $errorcode = $error[1];
            self::errorMessages($errorcode);
        }
        self::desconnect();
    }

    public static function getRow($query, $values)
    {
        //se almacenan de forma orgaizada la data para luego mandarla donde se solicita
        self::connect();
        $statement = self::$connection->prepare($query);
        $statement->execute($values);
        self::desconnect();
        return $statement->fetch(PDO::FETCH_BOTH);
    }

    public static function getRows($query, $values)
    {
        //se almacenan de forma orgaizada la data para luego mandarla donde se solicita
        self::connect();
        $statement = self::$connection->prepare($query);
        $statement->execute($values);
        self::desconnect();
        return $statement->fetchAll(PDO::FETCH_BOTH);
    }

    public static function errorMessages($code){
        switch ($code) {
            
            case 1048:
                self::showMessage(2, "Uno o mas campos requeridos se encuentran vacios", null);
                break;
            case 1062:
                self::showMessage(2, "El registro que desea procesar ya se encuentra en la base de datos.", null);
                break;
            case 1216:
                self::showMessage(2, "No se encontraron datos requeridos. Verifique que se disponga de datos en otras tablas.", null);
                break;
            case 1217:
                self::showMessage(2, "El registro no puede ser eliminado porque actualmente está siendo utilizado. Elimine las dependencias y vuelva a intentarlo.", null);
                break;
            case 1451:
                self::showMessage(2, "El registro no puede ser eliminado porque actualmente está siendo utilizado. Elimine las dependencias y vuelva a intentarlo", null);
                break;
            case 1452:
                self::showMessage(2, "No se encontraron datos requeridos. Verifique que se disponga de datos en otras tablas..", null);
                break;
            case 1586:
                self::showMessage(2, "El registro que desea procesar ya se encuentra en la base de datos.", null);
                break;
        }
    }

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
}
?>