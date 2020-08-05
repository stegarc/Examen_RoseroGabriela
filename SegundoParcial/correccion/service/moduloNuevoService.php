<?php

include('conexion.php');

if (isset($_POST['modService'])) {
  $stmt = $conn->prepare("INSERT INTO ROL_MODULO (cod_rol,cod_modulo) VALUES (?,?)");
  $stmt->bind_param('si', $cod_rol,$cod_modulo);  
  $cod_rol = $_POST['nombrerol'];
  $cod_modulo= $_POST['nombreMod'];
  $stmt->execute();
  $stmt->close();
  header('Location: ../modulorol.php');  
} 

?>