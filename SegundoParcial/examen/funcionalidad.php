<?php
$conn = mysqli_connect("127.0.0.1", "root", "admin123","test1");

// Check connection
if (!$conn) {
    echo"<p>Error: No se pudo conectar a MySQL.". PHP_EOL;
    echo"Error de depuracion.". mysqli_connect_errno();
    echo"Error de depuracion.". mysqli_connect_error();
    echo"</p>";
  exit;
}
$nombre="";
$url_principal="";
$descripcion="";
$cod_modulo="";
$cod_funcionalidad="";
$accion="Agregar";
if(isset($_POST["accion"]) && ($_POST["accion"] == "Agregar")){
    $stmt=$conn->prepare("INSERT INTO SEG_FUNCIONALIDAD(cod_funcionalidad,url_principal,nombre,descripcion) VALUES(?,?,?,?,?)");
    $stmt->bind_param("ssss",$cod_funcionalidad,$url_principal,$nombre,$descripcion);
    $cod_funcionalidad=$_POST["cod_funcionalidad"];
    $nombre=$_POST["nombre"];
    $descripcion=$_POST["descripcion"];
    $url_principal=$_POST["url_principal"];
    $stmt->execute();
    $stmt->close();
    $nombre="";
    $url_principal="";
    $descripcion="";
    $cod_modulo="";
    $cod_funcionalidad="";
} else if (isset($_POST["accion"]) && ($_POST["accion"] == "Modificar")){
    $stmt=$conn->prepare("UPDATE SEG_FUNCIONALIDAD set  url_principal=?,nombre=?,descripcion=? WHERE cod_funcionalidad ");
    $stmt->bind_param("ssssid",$nombre,$evento,$direccion,$fecha_evento,$entrada,$codEvento);
    $cod_funcionalidad=$_POST["cod_funcionalidad"];
    $nombre=$_POST["nombre"];
    $descripcion=$_POST["descripcion"];
    $cod_modulo=$_POST["cod_modulo"];
    $url_principal=$_POST["url_principal"];
    $stmt->execute();
    $stmt->close();
    $nombre="";
    $url_principal="";
    $descripcion="";
    $cod_modulo="";
    $cod_funcionalidad="";
}
else if (isset($_GET["update"])){
    $result=$conn->query("SELECT * FROM evento WHERE cod_evento=".$_GET["update"]);
    if($result->num_rows > 0){
    $row1 = $result->fetch_assoc();
    $codEvento= $row1["cod_evento"];
    $evento= $row1["evento"];
    $nombre= $row1["nombre"];
    $direccion= $row1["direccion"];
    $entrada= $row1["entrada"];
    $fecha_evento= $row1["fecha_evento"];
    $accion= "Modificar";
    }
}else if (isset($_POST["eliCodigo"])){
    $stmt=$conn->prepare("DELETE FROM evento WHERE cod_evento=?");
    $stmt->bind_param("i",$codEvento);
    $codEvento=$_POST["eliCodigo"];
    $stmt->execute();
    $stmt->close();
    $codEvento="";
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
        <span>NUEVO MODULO POR ROL</span></a>
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
                            <!-- Card Body -->
                            <div class="card-body">
                                <form class="" id="forma" name="forma" method="post" action="index.php">
                                    <div class="card-body border border-top-0 rounded-bottom-sm p-7">
                                    <input type="hidden" name="codEvento" value="<?php echo $codEvento; ?>">
                                        <div class="row">
                                            <div class="form-group form-group-icon col-lg-6 ">
                                                <label for="modulo">Modulo</label>
                                                <select id="modulo" name="modulo">
    <option value="<?php echo $modulo; ?>"></option>
  </select>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            
                                        <div class="row ">
                                            <div class="form-group form-group-icon col-lg-6 ">
                                                <input type="submit" class="btn btn-danger text-white text-uppercase"
                                                    name="accion" value="<?php echo $accion; ?>">
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
                                <input type="button" class="btn btn-danger text-white text-uppercase" name="eliminar"
                                    value="Eliminar" onclick="eliminarForma();">
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                            <th>COD</th>
                                                <th>Nombre</th>
                                                <th>URL Principal</th>
                                                <th>Descripcion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                   <?php
                                    
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><a href="index.php?update=<?php echo $row["cod_funcionalidad"]; ?>" ><?php echo $row["cod_funcionalidad"]; ?></a></td>
                                                <td><?php echo $row ["nombre"];?></td>
                                                <td><?php echo $row ["url_principal"];?></td>
                                                <td><?php echo $row ["descripcion"];?></td>
                                                <td><input type="radio" name="eliCodigo" value="<?php echo $row["cod_funcionalidad"]; ?>"></td>
                                            </tr>
                                        <?php }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="4">No hay datos</td>
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

    </div>
    <!-- End of Content Wrapper -->

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


