<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Iniciar Sesión</title>
        <link href="http://localhost:8081/Hospital/Assets/css/styles.css" rel="stylesheet" />
        <script src="http://localhost:8081/Hospital/Assets/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-light-1 my-4">Iniciar Sesión</h3></div>
                                    <div class="card-body">
                                        <form id="frmLogin">
                                            <div class="form-group">
                                            <label class="small mb-1" for="usuario"><i class="fas fa-user font-light-1"></i>Usuario</label>
                                                <input class="form-control py-4" id="usuario" name="usuario" type="text font-light-1" placeholder="Ingresa Usuario" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="clave"><i class="fas fa-key"></i>Contraseña</label>
                                                <input class="form-control py-4" id="clave" name="clave" type="password" placeholder="Ingresa Contraseña" />       
                                             </div>
                                            <div class="form-group d-flex align-items-center justify-content-center">
                                                <button class="btn btn-primary" type="submit" onclick="frmLogin(event);">Entrar</button>
                                            </div>
                                        </form>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">© 2023 Derechos Reservados Clínica Familiar Lak Ña Clara A.C.</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="http://localhost:8081/Hospital/Assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="http://localhost:8081/Hospital/Assets/js/scripts.js"></script>
        <script src="http://localhost:8081/Hospital/Assets/js/funciones.js"></script>
    </body>
</html>
