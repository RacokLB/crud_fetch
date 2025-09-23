<?php

    class Database {
        private $host = '10.100.202.66';
        private $dbName = 'fttc';
        private $username = 'pma';
        private $password = '';
        private $pdo;
        private $error;

        public function __construct(){
            //Configuracion del DSN (Data Source Name) DSN define el tipo de Base de datos en este caso MYSQL
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
            
            //Opciones para PDO (manejo de errores, modo de fetch por defecto)
            $options = array(
                PDO::ATTR_PERSISTENT => true,//Intenta usar una conexion persistente con las DB para mejorar el rendimiento
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,//configura el PDO para que arroje las excepciones en caso encontrarse alguna
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC//Establece por defecto que el manejo de consutlas devuelva un array associativo y asi manejar mejor los datos
            );

            //Intenta crear una instancia de PDO
            try{
                $this->pdo = new PDO(dsn: $dsn, username: $this->username, password: $this->password, options: $options);

            }catch(PDOException $e){
                $this->error= $e->getMessage();
                echo "Error: AL CONECTAR A LA DB " . $this->error;
            }
            
        }

        //Metodo para obtener la instancia de PDO
        //Este metodo permite llamar a la instancia de la conexion PDO($this->pdo) desde fuera de la clase, sirve para que las otras partes de la aplicacion puedan interactuar con la DB
        public function getPDO(){
            return $this->pdo;
        }

        // Método para manejar errores (opcional, pero útil)
        //En caso de que haya un fallo con la conexion esta function permite acceder al mensaje de error
        public function getError() {
            return $this->error;
        }
    }

?>