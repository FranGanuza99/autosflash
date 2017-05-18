<?php
class Database
{
    private static $connection;
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
        $statement = self::$connection->prepare($query);
        $statement->execute($values);
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
}
?>