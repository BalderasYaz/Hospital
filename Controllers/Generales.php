<?php
class Generales extends Controller{ 
    public function __construct()
    {
        session_start();
        parent::__construct();
    }
    public function index()
    {
        $data['id'] = $this->model->getNombre();
        $this->views->getView($this,"index",$data);
    }
    public function total()
    {   
        $Paciente = $_POST['Paciente'];
        $data = $this->model->gettotal($Paciente);  
        $response = array(
            "data" => $data
        );
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function filtrarfecha2()
    {   
        $Fechain2 = $_POST['Fechain2'];
        $Fechater2 = $_POST['Fechater2'];

        if(empty($Fechain2) && empty($Fechater2) ){
        $data = $this->model->getIngreso();
        }else
        {
        $data = $this->model->getf($Fechain2,$Fechater2);
        }
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-danger" type="button" onclick="eliminaringreso('.$data[$i]['Id_registro'].');">Eliminar</button>
            </div>';
        }
        $response = array(
            "data" => $data
        );
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {   
        $Nombre = $_POST['Nombre'];
        $cuota = $_POST['cuota'];
        $Paciente = $_POST['Paciente'];
        $Fecha = $_POST['Fecha'];
        if(empty($_POST['Nombre'])  || empty($_POST['cuota'])|| empty($_POST['Paciente']) || empty($_POST['Fecha']) )
        {
             $msg = "Los campos estan vacios";
        }
        else{
           $data = $this->model->registraringreso($Nombre,$cuota,$Paciente,$Fecha);
           if($data == "ok"){
               $msg = "si";
           }
           else{
              $msg = "error registrado";
           }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar(int $id){
        $data = $this->model->eliminaregistro($id);
        print_r($data);
    }   

}
?>
