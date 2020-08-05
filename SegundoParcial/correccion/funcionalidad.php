<?php
include("./service/conexion.php"); 
  $cod_modulo = '';
  $nombre = '';
  $estado = '';
  $descripcion = '';
  $url_principal = '';
  $accion = "Agregar";
  $nombre1 = '';
      $direccion1 = '';
      $url_principal1 = '';
      $cod_funcionalidad1= '';
      $descripcion1= '';

  if (isset($_GET['cod_funcionalidad'])) {
    $result_g = $conn->query("SELECT * FROM SEG_FUNCIONALIDAD WHERE COD_FUNCIONALIDAD=" . $_GET['cod_funcionalidad']);
    if(mysqli_num_rows($result_g) > 0){
      $row = mysqli_fetch_array($result_g);
      $nombre1 = $row['NOMBRE'];
      $direccion1 = $row['DIRECCION'];
      $url_principal1 = $row['URL_PRINCIPAL'];
      $cod_funcionalidad1 = $row['COD_FUNCIONALIDAD'];
      $accion = "Modificar";
    }
}
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
                    <span>MODULO POR ROL</span></a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

        </ul>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">
                <nav class="navbar-expand navbar-light bg-white topbar mb-4 shadow">
                    <h2 style="text-align: center; padding-top: 0.5em;">Gabriela Rosero</h2>

                </nav>
                <div class="row">
                    <div class="col-xl-11 col-lg-7">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Funcionalidades:</h6>
                            </div>
                            <div class="card-body">
                                <form class="" id="forma" name="forma" method="post" action="funcionalidad.php">
                                    <div class="card-body border border-top-0 rounded-bottom-sm p-7">
                                        <div class="row">
                                            <div class="form-group form-group-icon col-lg-6">
                                                <label for="sedeoption">Modulo</label>
                                                <?php
                                            $query = 'SELECT * FROM SEG_MODULO WHERE ESTADO="ACT"';
                                            $result = $conn->query($query);
                                            ?>
                                                <select name="orden" class="form-control border-warning rounded-sm"
                                                    id="selector">
                                                    <?php
                                                while ($row = $result->fetch_array()) {
                                                ?>
                                                    <option value=" <?php echo $row['COD_MODULO'] ?> ">
                                                        <?php echo $row['NOMBRE']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <input type="hidden" name="cod_funcionalidad" class="form-control"
                                                value="<?php echo $cod_funcionalidad; ?>">
                                            <div class="form-group form-group-icon col-lg-6 ">
                                                <input type="submit" class="btn btn-danger text-white text-uppercase"
                                                    name="submit" value="Aceptar">

                                            

                                        </div>
                                    </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-11 col-lg-7">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Listado:</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Código Funcionalidad</th>
                                            <th>Nombre</th>
                                            <th>URL Principal</th>
                                            <th>Descripcion</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php 
                                   error_reporting(E_ALL ^ E_NOTICE);
                                    $result_g= $conn->query("SELECT * FROM SEG_FUNCIONALIDAD WHERE COD_MODULO=".$_POST['orden']);
                                    if(isset($_POST['submit']) && mysqli_num_rows($result_g) > 0){                                     
                                    while($row = mysqli_fetch_assoc($result_g)){
                                            ?>
                                        <tr>
                                            <td><a href="funcionalidad.php?cod_funcionalidad=<?php echo $row["COD_FUNCIONALIDAD"]; ?>"
                                                    data-toggle="modal"
                                                    data-target="#logoutModal"><?php echo "FU".$row["COD_FUNCIONALIDAD"]; ?></a>
                                            </td>
                                            <td><?php echo $row ["NOMBRE"];?></td>
                                            <td><?php echo $row ["URL_PRINCIPAL"];?></td>
                                            <td><?php echo $row ["DESCRIPCION"];?></td>
                                            <td><a
                                                    href="funcionalidad.php?cod_funcionalidad=<?php echo $row ['COD_FUNCIONALIDAD'];?>">
                                                    <input type="radio" class="border-warning rounded-sm"
                                                        name="eliCodigo"
                                                        value="<?php echo $row ['COD_FUNCIONALIDAD']; ?>">
                                            </td>
                                        </tr>
                                        <?php }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="4">No hay registros</td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>

                                </table>
                            </div>
                            <a class="btn btn-danger text-white text-uppercase" href="#" data-toggle="modal"
                                data-target="#logoutModal">Nuevo
                            </a>
                            <input type="button" class="btn btn-danger text-white text-uppercase" name="eliminar"
                                value="Eliminar" onclick="eliminarForma();">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>
    </div>
    <a class="scroll-to-top rounded " href="#page-top ">
        <i class="fas fa-angle-up "></i>
    </a>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Funcionalidad</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="" id="forma" name="forma" method="post" action="./service/funcionalidadService.php">
                    <div class="card-body border border-top-0 rounded-bottom-sm p-7">
                        <div class="row">
                            <div class="form-group form-group-icon col-lg-6">
                                <label for="niveloption">Nombre</label>
                                <input type="text" class="form-control border-warning rounded-sm" name="nombre"
                                    value="<?php echo $nombre1 ?>" required>

                            </div>
                            <div class="form-group form-group-icon col-lg-6">
                                <label for="zip-code">URL Principal</label>
                                <input type="text" class="form-control border-warning rounded-sm" name="url_principal"
                                    value="<?php echo $url_principal1 ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group form-group-icon col-lg-6">
                                <label for="direccion">Descripción</label>
                                <input type="text" class="form-control border-warning rounded-sm" name="descripcion"
                                    value="<?php echo $descripcion1 ?>" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                            <input type="hidden" name="cod_funcionalidad" class="form-control"
                                value="<?php echo $cod_funcionalidad1; ?>">
                            <input type="hidden" name="cod_modulo" class="form-control"
                                value="<?php echo $_POST['orden'] ?>">
                            <input type="hidden" name="accion" class="form-control" value="<?php echo $accion; ?>">
                            <input type="submit" class="btn btn-danger text-white text-uppercase" name="accion"
                                value="<?php echo $accion; ?>">

                        </div>
                </form>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="js/sb-admin-2.min.js"></script>
</body>
<script>
function eliminarForma() {
    document.getElementById('cod_fun').submit();
}
</script>

</html>