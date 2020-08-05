<?php

include('conexion.php');

if (isset($_POST['funcionalidadService']) && $_POST['accion'] == "Agregar") {
  $stmt = $conn->prepare("INSERT INTO SEG_FUNCIONALIDAD (cod_modulo,url_principal,nombre, descripcion) VALUES (?,?,?,?)");
  $stmt->bind_param('isss', $cod_modulo,$url_principal,$nombre,$descripcion);  
  $nombre = $_POST['nombre'];
  $cod_modulo = $_POST['cod_modulo'];
  $descripcion = $_POST['descripcion'];
  $url_principal = $_POST['url_principal'];
  $stmt->execute();
  $stmt->close();
  header('Location: ../funcionalidad.php');  
} elseif (isset($_POST['funcionalidadService']) && $_POST['accion'] == "Modificar") {
    echo $_POST['nombre'];
    echo $_POST['descripcion'];
    echo $_POST['url_principal'];
    $stmt = $conn->prepare("UPDATE SEG_FUNCIONALIDAD SET nombre=? , url_principal=?, descripcion=? WHERE COD_FUNCIONALIDAD=" . $_POST['cod_funcionalidad']);
    $stmt->bind_param('sss', $nombre, $url_principal,$descripcion);
    $nombre = $_POST['nombre'];    
  $descripcion = $_POST['descripcion'];
  $url_principal = $_POST['url_principal'];
    $accion = "Agregar";
    $stmt->execute();
    $stmt->close();
    header('Location: ../funcionalidad.php');
  }  elseif (isset($_POST["eliCodigo"])){
    $stmt=$conn->prepare("DELETE FROM SEG_FUNCIONALIDAD WHERE COD_FUNCIONALIDAD=?");
    $stmt->bind_param("i",$cod_funcionalidad);
    $cod_funcionalidad=$_POST["eliCodigo"];
    $stmt->execute();
    $stmt->close();
    $cod_funcionalidad="";
header('Location: ../funcionalidad.php');
    }

?>