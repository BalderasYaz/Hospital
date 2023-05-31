<?php
  require_once('C:\xampp\htdocs\Hospital\lib\dompdf\autoload.inc.php');
  require_once 'C:\xampp\htdocs\Hospital\lib\dompdf\vendor\autoload.php';
  use Dompdf\Dompdf;

class Usuarios extends Controller{ 
    
    public function __construct()
    {
        session_start();
        parent::__construct();
    }
    public function index()
    {
        $data['id'] = $this->model->getId();
        $this->views->getView($this,"index",$data);
    }
    
    public function Cuota($idEstudio)
    {
        $idEstudio = $_POST['idEstudio'];
        $data['cuota'] = $this->model->getCuota($idEstudio);
        echo $data['cuota'];
    }
    public function logout()
{
    session_destroy();
    header("Location: http://localhost:8081/Hospital/");
    exit;
}

    public function validar()
    {
     
       if(empty($_POST['usuario']) || empty($_POST['clave']))
       {
            $msg = "Los campos estan vacios";
       }else{
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $data = $this->model->getUsuario($usuario,$clave);
            if($data){
                if(isset($data['id'])){
                    $_SESSION['id_usuario'] = $data['id'];
                }
                if(isset($data['usuario'])){
                    $_SESSION['usuario'] = $data['usuario'];
                }
                if(isset($data['nombre'])){
                    $_SESSION['nombre'] = $data['nombre'];
                }
                $msg = "ok";
            }else{
                $msg = "usuario o contraseña incorrecta";
            }            
             
       }

       echo json_encode($msg, JSON_UNESCAPED_UNICODE);
       die();
    }
    public function registrar()
{   
    $Nombre = $_POST['Nombre'];
    $Cantidad = intval($_POST['Cantidad']);
    $Cuota = $_POST['Cuota'];
    $Fecha = $_POST['Fecha'];
    $Paciente= $_POST['Paciente'];
    
    if(empty($_POST['Nombre']) || empty($_POST['Cantidad']) || empty($_POST['Cuota']) || empty($_POST['Paciente']) || empty($_POST['Fecha']))
    {
         $msg = "Los campos están vacíos";
    }
    else{
       $data = $this->model->registrarEstudio($Nombre, $Cantidad, $Cuota, $Paciente, $Fecha);
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
    public function filtrarfecha()
    {   
        $Fechain = $_POST['Fechain'];
        $Fechater = $_POST['Fechater'];
        if(empty($Fechain) && empty($Fechater) ){
        $data = $this->model->getEstudio();
        }else
        {
        $data = $this->model->getfiltro($Fechain,$Fechater);
        }
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-danger" type="button" onclick="btneliminar('.$data[$i]['Id_registro'].');">Eliminar</button>
            </div>';
        }
        $response = array(
            "data" => $data
        );
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();
    }

public function Generarpdf()
{   
   
    ob_start();
    require_once 'Views/Usuarios/index.php';
    $html = ob_get_clean();

    // Generar el PDF con Dompdf
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->render();
    $dompdf->stream("archivo.pdf");
    
    
}
}
?>
