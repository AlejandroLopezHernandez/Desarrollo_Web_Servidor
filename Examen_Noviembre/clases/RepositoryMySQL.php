<?php
class RepositorioSQLFlotaVehiculos{
    private $conexion;
    public function __construct($servername,$dbname,$username,$password){
        $this->conexion = new PDO(
            "mysql:host=$servername;dbname=$dbname",
            $username,
            $password
        );
        $this->conexion->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
    }
    public function ConseguirUsuarioYContraseña($usuario){
        $consulta_sql ="
        SELECT *
        FROM ADMINISTRADOR
        WHERE id_admin = :username";
        $consulta_parametrizada = $this->conexion->prepare($consulta_sql);
        $consulta_parametrizada->bindParam(':username',$usuario,PDO::PARAM_STR);
        $consulta_parametrizada->execute();
        return $consulta_parametrizada->fetch(PDO::FETCH_ASSOC);
    }
  
}
