<?php

include('conexion.php');

if (isset($_POST['moduloService']) && $_POST['accion'] == "Agregar") {
  $stmt = $conn->prepare("INSERT INTO SEG_MODULO (nombre, estado) VALUES (?,?)");
  $stmt->bind_param('ss', $nombre,$estado);  
  $nombre = $_POST['nombre'];
  $estado = $_POST['estado'];
  $stmt->execute();
  $stmt->close();
  header('Location: ../index.php');  
} elseif (isset($_POST['moduloService']) && $_POST['accion'] == "Modificar") {
    echo $_POST['nombre'];
    echo $_POST['estado'];
    $stmt = $conn->prepare("UPDATE SEG_MODULO SET nombre=? , estado=? WHERE COD_MODULO=" . $_POST['cod_modulo']);
    $stmt->bind_param('ss', $nombre, $estado);
    $nombre = $_POST['nombre'];    
  $estado = $_POST['estado'];
    $accion = "Agregar";
    $stmt->execute();
    $stmt->close();
    header('Location: ../index.php');
  }  elseif (isset($_POST['eliminarService'])) {  
    echo $_POST['estado'];
  $stmt = $conn->prepare("UPDATE SEG_MODULO SET estado=? WHERE COD_MODULO=" . $_POST['cod_modulo']);
  $stmt->bind_param('s', $estado); 
$estado = "INA";
  $stmt->execute();
  $stmt->close();
  header('Location: ../index.php');
}
?>