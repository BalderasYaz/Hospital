<?php
class Farmacia extends Controller{ 
    public function __construct()
    {
        session_start();
        parent::__construct();
    }
    public function index()
    {
        
        $this->views->getView($this,"index");
    }
    public function Medi()
    {   
       
        $data = $this->model->getMed();  
        $response = array(
            "data" => $data
        );
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function Listar()
    {   
       
        $data = $this->model->getMedicamento();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-danger" type="button" onclick="beliminar('.$data[$i]['Id_registro'].');">Eliminar</button>
            <button class="btn btn-primary" type="button" onclick="beditar('.$data[$i]['Id_registro'].');">Editar</button>
            </div>';
        }
        $response = array(
            "data" => $data
        );
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrarm()
{   
    $Nombre_Comercial= $_POST['Nombre_Comercial'];
    $Descripcion = $_POST['Descripcion'];
    $Cantidad = $_POST['Cantidad'];
    $Precio = $_POST['Precio'];
    $id = $_POST['id'];
    if(empty($_POST['Nombre_Comercial'])  || empty($_POST['Descripcion'])|| empty($_POST['Cantidad']) || empty($_POST['Precio'])  )
    {
         $msg = "Los campos estan vacios";
    }
    else{
        if($id ==""){
       $data = $this->model->registrarMedicamento($Nombre_Comercial,$Descripcion, $Cantidad,$Precio);
       if($data == "ok"){
           $msg = "si";
       }
       else{
          $msg = "error registrado";
       }
    } 
    else{ 
       $data = $this->model->editarMedicamento( $Nombre_Comercial,$Descripcion, $Cantidad,$Precio,$id);
       if($data == "modificado"){
           $msg = "si";
       }
       else{
          $msg = "error registrado";
       }
    } 
} 
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();

}

public function eliminar(int $id)
{
    $data = $this->model->eliminarr($id);
    print_r($data);
}
public function editar(int $id)
{
    $data = $this->model->editarr($id);
     echo json_encode($data, JSON_UNESCAPED_UNICODE);

    die();
}



public function IncrementarCantidad(int $id)
{
    $data = $this->model->incremento($id);
     echo json_encode($data, JSON_UNESCAPED_UNICODE);

    die();
}
public function DisminuirCantidad(int $id)
{
    $data = $this->model->Decremento($id);
     echo json_encode($data, JSON_UNESCAPED_UNICODE);

    die();
}
}
?>
