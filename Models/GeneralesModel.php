<?php
class GeneralesModel extends Query {
  private $Id_tipo,$Nombre,$cuota,$Fecha,$id;
  public function __construct() {
      parent::__construct();
  }
  public function gettotal(string $Paciente){
    $this->Paciente=$Paciente;
    $params = [$this->Paciente];
    $sql = "SELECT Nombre, cuota FROM ingresos_generales WHERE Paciente=?";
    $data = $this->selectNom($sql,$params);
    return $data;
  }
public function getIngreso() {

  $sql = "SELECT * FROM ingresos_generales";
  $data = $this->selectALL($sql);
  return $data;
}
public function getf(string $Fechain2, string $Fechater2) {

  $sql = "SELECT * FROM ingresos_generales WHERE Fecha >= '$Fechain2' AND Fecha <= '$Fechater2'";
  $data = $this->selectALL($sql);
  return $data;
}
public function getNombre() {

  $sql = "SELECT Nombre FROM tipoingreso ";
  $data = $this->selectALL($sql);
  return $data;
  
}

public function registraringreso(string $Nombre,float $cuota,string $Paciente,string $Fecha)
{
  $this->Nombre=$Nombre;
  $this->cuota=$cuota;
  $this->Paciente=$Paciente;
  $this->Fecha=$Fecha;
  $params = [$this->Nombre];
  $sqlId = "SELECT Id_tipo FROM  tipoingreso  WHERE Nombre = ?";
  $this->Id_tipo = $this->selectvalor($sqlId, $params);
  $sql = "INSERT INTO ingresos_generales(Id_tipo, Nombre, cuota, Paciente, Fecha) VALUES (?,?,?,?,?)"; 
  $datos = array($this->Id_tipo,$this->Nombre,$this->cuota,$this->Paciente,$this->Fecha);
  $data = $this->save($sql,$datos);
  if($data == 1){
    $res = "ok";
  } 
  else{
    $res="error";
  }
  return $res;


}


  public function eliminaregistro(int $id){
    $this->id=intval($id);
    $sql = "DELETE FROM ingresos_generales WHERE Id_registro=?";
    $datos = array($this->id);
    $data = $this->save($sql, $datos);
    return $data;
  }

}
?>