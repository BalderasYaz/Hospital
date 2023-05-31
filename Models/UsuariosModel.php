<?php
class UsuariosModel extends Query {
  private $Id_estudio,$Nombre,$Cantidad,$Cuota,$Fecha,$id,$Total;
  public function __construct() {
      parent::__construct();
  }
public function getUsuario(string $usuario, string $clave) {

    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";
    $data = $this->select($sql);
    return $data;
    
}
public function getEstudio() {

  $sql = "SELECT * FROM ingresos_laboratorio";
  $data = $this->selectALL($sql);
  return $data;
}
public function getfiltro(string $Fechain, string $Fechater) {

  $sql = "SELECT * FROM ingresos_laboratorio WHERE Fecha >= '$Fechain' AND Fecha <= '$Fechater'";
  $data = $this->selectALL($sql);
  return $data;
}
public function getTotales() {

  $sql = "SELECT Nombre,sum(Cantidad) AS Cantidad,sum(Total) AS Total FROM ingresos_laboratorio GROUP BY Nombre";
  $data = $this->selectALL($sql);
  return $data;
}
public function getId() {
    $sql = "SELECT Id_estudio, Nombre FROM estudios_de_laboratorio";
    $data = $this->selectALL($sql);
    return $data;
  
}
public function insertarEnOtraTabla(int $Cantidad,Float $Cuota,string $Paciente,string $Fecha)
{
    $sql = "INSERT INTO ingresos_generales(Id_tipo, Nombre, cuota, Paciente, Fecha) VALUES (11,'Laboratorio',?,?,?)"; 
    $datos = array($Cuota,$Paciente,$Fecha);
    for($i = 0; $i < $Cantidad; $i++) {
      $this->save($sql,$datos);
    }
}
public function getCuota($idEstudio) {
  $this->idEstudio=$idEstudio;
  $params = [$this->idEstudio];
  $sql = "SELECT CuotaR FROM estudios_de_laboratorio WHERE Id_estudio = ?";
  $data = $this->selectvalor($sql, $params);
  return $data;
}
public function registrarEstudio(int $Nombre,int $Cantidad,float $Cuota,string $Paciente,string $Fecha)
{
  $this->Id_estudio=$Nombre;
  $this->Cantidad=$Cantidad;
  $this->Cuota=$Cuota;
  $this->Paciente=$Paciente;
  $this->Fecha=$Fecha;
  $params = [$this->Id_estudio];
  $sqlId = "SELECT Nombre FROM  estudios_de_laboratorio  WHERE Id_estudio = ?";
  $this->Nombre = $this->selectNom($sqlId, $params);
  $this->Total = $Cantidad * $Cuota;
  $sql = "INSERT INTO ingresos_laboratorio(Id_estudio, Nombre, Cantidad, Cuota, Paciente, Fecha, Total) VALUES (?,?,?,?,?,?,?)"; 
  $datos = array($this->Id_estudio,$this->Nombre,$this->Cantidad,$this->Cuota, $this->Paciente ,$this->Fecha,$this->Total);
  $data = $this->save($sql,$datos);
  if($data == 1){
    $this->insertarEnOtraTabla($this->Cantidad,$this->Cuota,$this->Paciente,$this->Fecha);
    return true;
  } 
  else{
    return false;
  }
}

  public function eliminaregistro(int $id){
    $this->id=$id;
    $sql = "DELETE FROM ingresos_laboratorio WHERE Id_registro=?";
    $datos = array($this->id);
    $data = $this->save($sql, $datos);
    return $data;
  }

}
?>