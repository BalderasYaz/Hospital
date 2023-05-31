<?php
class FarmaciaModel extends Query {
  private $Nombre_Comercial,$Descripcion,$Cantidad,$Precio;
  public function __construct() {
      parent::__construct();
  }

public function getMedicamento() {

  $sql = "SELECT * FROM farmacia";
  $data = $this->selectALL($sql);

  return $data;
}
public function editarr(int $id) {
  $sql = "SELECT * FROM farmacia WHERE Id_registro=$id";
  $data = $this->selectALL($sql);
  return $data;
}
public function getMed(){
  $sql = "SELECT Nombre_Comercial,Cantidad FROM farmacia WHERE Cantidad<5";
  $data = $this->selectALL($sql);
  return $data;
}
public function editarMedicamento(string $Nombre_Comercial,string $Descripcion,int $Cantidad,float $Precio, int $id)
{
  $this->Nombre_Comercial=$Nombre_Comercial;
  $this->Cantidad=$Cantidad;
  $this->Precio=$Precio;
  $this->Descripcion=$Descripcion;
  $this->id=$id;
  $sql = "UPDATE farmacia SET Nombre_Comercial= ?,Descripcion=?, Cantidad= ?, Precio=? WHERE Id_registro=?"; 
  $datos = array($this->Nombre_Comercial,$this->Descripcion,$this->Cantidad,$this->Precio,$this->id);
  $data = $this->save($sql,$datos);
  if($data == 1){
    $res = "modificado";
  } 
  else{
    $res="error";
  }
  return $res;
  }
  public function Incremento(int $id)
{
  
  $this->id=$id;
  $sql = "UPDATE farmacia SET Cantidad =Cantidad+1 WHERE Id_registro=?"; 
  $datos = array($this->id);
  $data = $this->save($sql,$datos);
  if($data == 1){
    $res = "modificado";
  } 
  else{
    $res="error";
  }
  return $res;
  }
  public function Decremento(int $id)
  {
    
    $this->id=$id;
    $sql = "UPDATE farmacia SET Cantidad =Cantidad-1 WHERE Id_registro=?"; 
    $datos = array($this->id);
    $data = $this->save($sql,$datos);
    if($data == 1){
      $res = "modificado";
    } 
    else{
      $res="error";
    }
    return $res;
    }

public function registrarMedicamento(string $Nombre_Comercial,string $Descripcion,int $Cantidad,float $Precio)
{
  $this->Nombre_Comercial=$Nombre_Comercial;
  $this->Cantidad=$Cantidad;
  $this->Precio=$Precio;
  $this->Descripcion=$Descripcion;
  $sql = "INSERT INTO farmacia( Nombre_Comercial, Descripcion, Cantidad, Precio) VALUES (?,?,?,?)"; 
  $datos = array($this->Nombre_Comercial,$this->Descripcion,$this->Cantidad,$this->Precio);
  $data = $this->save($sql,$datos);
  if($data == 1){
    $res = "ok";
  } 
  else{
    $res="error";
  }
  return $res;
  }
  public function eliminarr(int $id){
    $this->id=$id;
    $sql = "DELETE FROM farmacia WHERE Id_registro=?";
    $datos = array($this->id);
    $data = $this->save($sql, $datos);
    return $data;
  }

}
?>