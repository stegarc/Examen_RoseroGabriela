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
$cod_rol="";
$cod_modulo="";
$accion="Nuevo";
if(isset($_POST["accion"]) && ($_POST["accion"] == "Nuevo")){
    $stmt=$conn->prepare("INSERT INTO ROL_MODULO(cod_rol,cod_modulo) VALUES(?,?)");
    $stmt->bind_param("ssssd",$cod_rol,$cod_modulo);
    $cod_modulo=$_POST["cod_modulo"];
    $cod_rol=$_POST["cod_rol"];
    $stmt->execute();
    $stmt->close();
    $cod_rol="";
    $cod_modulo="";
}else if (isset($_POST["eliCodigo"])){
    $stmt=$conn->prepare("DELETE FROM ROL_MODULO WHERE COD_ROL=?");
    $stmt->bind_param("i",$codRol);
    $cod_rol=$_POST["eliCodigo"];
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
                                <h6 class="m-0 font-weight-bold text-primary">Gestion modulos por rol</h6>
                            </div>
                            <div class="card-body">
                                <form class="" id="forma" name="forma" method="post" action="index.php">
                                    <div class="card-body border border-top-0 rounded-bottom-sm p-7">
                                    <input type="hidden" name="codEvento" value="<?php echo $codEvento; ?>">
                                        <div class="row">
                                            <div class="form-group form-group-icon col-lg-6 ">
                                                <label for="rol">Rol</label>
                                                <select id="rol" name="rol">
                        <option value="<?php echo $rol; ?>"></option>
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
                                    $result= $conn->query("SELECT * FROM SEG_MODULO");
                                    if ($result->num_rows > 0){
                                        while($row=$result->fetch_assoc()){
                                        ?>
                                            <tr>
                                                <td><a
                                                        href="index.php?update=<?php echo $row ["cod_modulo"];?>"><?php echo $row ["cod_modulo"];?></a>
                                                </td>
                                                <td><input type="radio" name="eliCodigo" value="<?php echo $row["cod_modulo"]; ?>"></td>
                                            </tr>
                                            <?php }
                                }else{
                                    ?>
                                        <tr>
                                            <td colspan="1">No hay datos</td>
                                        </tr>
                                        <?php }?>
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