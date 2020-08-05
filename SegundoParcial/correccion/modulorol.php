<?php
include("./service/conexion.php"); 
  $cod_modulo = '';
  $nombre = '';
  $cod_rol = '';
  $orden = '';
  $accion = "Agregar";

  if (isset($_GET['cod_funcionalidad'])) {
    $result_g = $conn->query("SELECT * FROM SEG_FUNCIONALIDAD WHERE COD_FUNCIONALIDAD=" . $_GET['cod_funcionalidad']);
    if(mysqli_num_rows($result_g) > 0){
      $row = mysqli_fetch_array($result_g);
      $nombre = $row['NOMBRE'];
      $direccion = $row['DIRECCION'];
      $url_principal = $row['URL_PRINCIPAL'];
      $accion = "Modificar";
    }} 
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
                                <h6 class="m-0 font-weight-bold text-primary">Modulos por rol</h6>
                            </div>
                            <div class="card-body">
                                <form id="forma" name="forma" method="post" action="modulorol.php">
                                    <div class="card-body border border-top-0 rounded-bottom-sm p-7">                                        

                                    <div class="row">
                                            <input type="hidden" name="cod_rol" class="form-control"
                                                value="<?php echo $cod_rol; ?>">
                                            <div class="form-group form-group-icon col-lg-6 ">
                                                <label for="rol">Rol</label>
                                                <?php
                                            $query = 'SELECT * FROM SEG_ROL';
                                            $result = $conn->query($query);
                                            ?>
                                                <select name="orden" class="form-control border-warning rounded-sm"
                                                    id="selector">
                                                    <?php
                                                while ($row = $result->fetch_array()) {
                                                ?>
                                                    <option value="<?php echo $row['COD_ROL']?>">
                                                        <?php echo $row['NOMBRE']; ?>
                                                    </option>

                                                    <?php }
                                        ?>
                                                </select> </div>
                                            <div class="row">
                                            <div class="form-group form-group-icon col-lg-6 ">  </br>
                                                <input type="submit" class="btn btn-danger text-white text-uppercase"
                                                    name="submit" value="Aceptar">
                                            </div>

                                </form>

                                <form id="forma2" name="forma2" method="post" action="modulonuevo.php">
                                    <input type="hidden" name="orden" class="form-control"
                                        value="<?php echo $_POST['orden']; ?>">
                                    <div class="form-group form-group-icon col-lg-6 "></br>
                                        <input type="submit" class="btn btn-danger text-white text-uppercase"
                                            name="submit" value="Nuevo"></div></div>
                                </form>

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
                        <h6 class="m-0 font-weight-bold text-primary">Modulos</h6>
                        <input type="button" class="btn btn-danger text-white text-uppercase" name="eliminar"
                            value="Eliminar" onclick="eliminarForma();">
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Modulos</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                   error_reporting(E_ALL ^ E_NOTICE);                 
                                   $result_g= $conn->query("SELECT *, seg_modulo.nombre as modName 
                                        FROM seg_modulo
                                        INNER JOIN rol_modulo
                                        ON seg_modulo.COD_MODULO = rol_modulo.COD_MODULO WHERE COD_ROL='".$_POST['orden']."'");                    
                                    if(isset($_POST['submit'])){                                                                            
                                    while($row = $result_g->fetch_array()){
                                            ?>
                                    <tr>
                                        <td><?php echo $row ["modName"];?></a>
                                        </td>
                                        <td><a
                                                href="funcionalidad.php?cod_funcionalidad=<?php echo $row ['COD_FUNCIONALIDAD'];?>">
                                                <input type="radio" class="border-warning rounded-sm" name="eliCodigo"
                                                    value="<?php echo $row ['COD_FUNCIONALIDAD']; ?>">
                                        </td>
                                    </tr>
                                    <?php }}
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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

</body>
<script>
function eliminarForma() {
    document.getElementById('forma').submit();
}
</script>

</html>