<?php 

class DB_CONEXION {
    private $host = 'localhost';
    private $dbNombre = 'db_veterinaria';
    private $usuario = 'root';
    private $password = '104233';
    private $conn = null;

    //Metodo Conexion
    public function connect(){

        $this->conn = new mysqli($this->host,$this->usuario,$this->password,$this->dbNombre);

        if ($this->conn->connect_error) {
            die("Ha ocurrido un error de conexión: " . $this->conn->connect_error);
        }
        return $this->conn;
    }

    //Metodo Desconexion
    public function disconnect() {
        if ($this->conn) {
            $this->conn->close();
        }
    }


}


?>