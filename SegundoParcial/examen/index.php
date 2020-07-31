<?php
  include './service/moduloService.php';
  $cod_modulo = "";
  $nombre = "";
  $estado = "";
  $cod_modulo = "";
  $accion = "Agregar";
  $moduloService = new ModuloService();
  
  if (isset($_POST["accion"]) && ($_POST["accion"] == 'Agregar')) {
    $moduloService->insert($_POST["cod_modulo"],$_POST["nombre"], $_POST["estado"]);
  } else if (isset($_POST["accion"]) && ($_POST["accion"] == "Modificar")) {
    $moduloService->update($_POST["nombre"], $_POST["estado"], $_POST["cod_modulo"]);
  } else if (isset($_GET["update"])) {
    $modulo = $moduloService->findByState($_GET["update"]); 
    if ($modulo!=null) {
        $cod_modulo = $modulo["cod_modulo"]; 
        $nombre = $modulo["nombre"];
        $estado = $modulo["estado"];
        $accion = "Modificar";
    }
  } else if (isset($_POST["eliCodigo"])) {
    $moduloService->delete($_POST["eliCodigo"]);
  }
  $result = $moduloService->findAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Deberes">
    <meta name="author" content="Gabriela Rosero">

    <title>EXAMEN</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">EXAMEN</div>
</a>

<hr class="sidebar-divider my-0">

<li class="nav-item ">
    <a class="nav-link" href="index.php">
        <i class="fas fa-fw"></i>
        <span>MODULO</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="funcionalidad.php">
        <i class="fas fa-fw"></i>
        <span>FUNCIONALIDAD</span></a>
</li>

<li class="nav-item">
    <a class="nav-link" href="modulorol.php">
        <i class="fas fa-fw"></i>
        <span>NUEVO MODULO POR ROL</span></a>
</li>

<hr class="sidebar-divider d-none d-md-block">

</ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar-expand navbar-light bg-white topbar mb-4 shadow">
                    <h2 style="text-align: center; padding-top: 0.5em;">Examen: Gabriela Rosero</h2>

                </nav>
                <div class="row">
                    <div class="col-xl-11 col-lg-7">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Módulo:</h6>
                            </div>
                            <div class="card-body">
                            <form id="forma" name="forma" method="post" action="index.php">
                                    <div class="card-body border border-top-0 rounded-bottom-sm p-7">
                                    <input type="hidden" name="cod_modulo" value="<?php echo $cod_modulo; ?>">
                                        <div class="row">
                                          <div class="form-group form-group-icon col-lg-6 ">
                                                <label for="cod ">Cod</label>
                                                <input type="text" class="form-control border-warning rounded-sm " name="cod" value="<?php echo $cod_modulo; ?>"> 
                                            </div>
                                            <div class="form-group form-group-icon col-lg-6 ">
                                                <label for="nombre ">Nombre</label>
                                                <input type="text" class="form-control border-warning rounded-sm " name="nombre" value="<?php echo $nombre; ?>"> 
                                            </div>
                                        </div>
                                            <div class="row">
                                            <div class="form-group form-group-icon col-lg-6">
                                                <label for="nombre">Estado</label>
                                                <div class="container">
                                                    <input type="radio" id="activo" name="estado" value="<?php echo ($estado=='ACT')?'checked':'' ?>" >
                                                    Activo<br>
                                                    <input type="radio" id="inactivo" name="estado"
                                                        value="INA" <?php echo ($estado=='INA')?'checked':'' ?>>
                                                    Inactivo<br>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-danger text-white text-uppercase" value="<?php echo $accion; ?>"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-xl-11 col-lg-7">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Listado:</h6>
                                <input type="button" class="btn btn-danger text-white text-uppercase" name="eliminar"
                                    value="Eliminar" onclick="eliminarForma();">
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>                                                
                                            <th>Estado</th>
                                                <th>Nombre</th>
                                                <th>Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                   <?php
                                    
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><a href="index.php?update=<?php echo $row["estado"]; ?>" ><?php echo $row["estado"]; ?></a></td>
                                                <td><?php echo $row["nombre"]; ?></td>
                                                <td><input type="radio" name="eliCodigo" value="<?php echo $row["estado"]; ?>"></td>
                                            </tr>
                                        <?php }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="3">No hay datos</td>
                                        </tr>
<?php } ?>
                                </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="sticky-footer bg-white ">
        <div class="container my-auto ">
            <div class="copyright text-center my-auto ">
                <span>Copyright &copy; Gabriela Rosero 2020</span>
            </div>
        </div>
    </footer>
    </div>
    </div>
    <a class="scroll-to-top rounded " href="#page-top ">
        <i class="fas fa-angle-up "></i>
    </a>

</body>
<script>
function eliminarForma() {
    document.getElementById('forma').submit();
}
</script>
</html>