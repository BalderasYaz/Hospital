<?php
class Query extends Conexion{
    private $pdo, $con, $sql, $datos;
    public function __construct(){
        parent::__construct();
        $this->pdo = $this->conect();
    }
    public function selectvalor(string $sql, $params = [])
    {
    $this->sql = $sql;
    $resul = $this->pdo->prepare($this->sql);
    $resul->execute($params);
    $data = (int) $resul->fetchColumn(); 
    return $data;
    }
    public function selectNom(string $sql, $params = [])
    {
    $this->sql = $sql;
    $resul = $this->pdo->prepare($this->sql);
    $resul->execute($params);
    $data = (String) $resul->fetchColumn(); 
    return $data;
    }
    public function select(string $sql)
    {
        $this->sql = $sql;
        $resul = $this->pdo->prepare($this->sql);
        $resul->execute();
        $data = $resul->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function selectALL(string $sql)
    {
        $this->sql = $sql;
        $resul = $this->pdo->prepare($this->sql);
        $resul->execute();
        $data = $resul->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function save(string $sql, array $datos)
    {
        $this->sql = $sql;
        $this->datos = $datos;
        $insert = $this->pdo->prepare($this->sql);
        $data = $insert->execute($this->datos);
        if($data){
            $res = 1;
        }else{
            $res = 0;
        }
        return $res;
       
    }
}
?>