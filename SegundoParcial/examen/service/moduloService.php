<?php
 include 'mainService.php';

  class ModuloService extends MainService{

    private $entityName = "SEG_MODULO";

    function insert($nombre, $estado) {
        $stmt = $conex->prepare("INSERT INTO SEG_MODULO(cod_modulo,nombre, estado) VALUES (?,?, ?)");
        $stmt->bind_param('ss', $cod_modulo,$nombre, $estado);
        $stmt->execute();
        $stmt->close();
        $conex->close();
    }

    function findAll() {
        return $this->findAll1($this->entityName);
    }

    function findByState($estado) {
        $result = $this->conex->query("SELECT * FROM SEG_MODULO WHERE estado=".$estado);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }


    function update($nombre, $estado, $cod_modulo) {
        $stmt = $this->conex->prepare("UPDATE SEG_MODULO set cedula = ?, nombre=?, fecha_nacimiento = ? WHERE cod_modulo = ?");
        $stmt->bind_param('sssi', $nombre, $estado, $cod_modulo);
        $stmt->execute();
        $stmt->close();
    }

    function delete($cod_modulo) {
        $stmt = $this->conex->prepare("UPDATE SEG_MODULO set estado=?  WHERE $cod_modulo = ?");
        $stmt->bind_param('i', $cod_modulo);
        $stmt->execute();
        $stmt->close();
    }
}

?>