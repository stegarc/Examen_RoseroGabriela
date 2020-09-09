const sql = require('../util/database.js');



const Subcategoria = function (subcategoria) {
    this.COD_CATEGORIA=subcategoria.COD_CATEGORIA;
    this.COD_SUB_CATEGORIA= subcategoria.COD_SUB_CATEGORIA;
    this.NOMBRE= subcategoria.NOMBRE;
    this.DESCRIPCION= subcategoria.DESCRIPCION; 
    this.FECHA_CREACION= subcategoria.FECHA_CREACION;
}

Subcategoria.create = (newSubcategoria, result) => {
  sql.query("INSERT INTO SUB_CATEGORIA SET ?", newSubcategoria, (err, res) => {
    if (err) {
      console.log("error:", err);
      result(err, null);
      return;
    }
    console.log("subcategoria Creado: ", { cod_sub_categoria: res.insertcod_sub_categoria, ...newSubcategoria });
    result(null, { cod_sub_categoria: res.insertcod_sub_categoria, ...newSubcategoria });
  });
};

Subcategoria.getAll = result => {
  sql.query("SELECT * FROM SUB_CATEGORIA", (err, res) => {
    if (err) {
      console.log("error:", err);
      result(null, err);
      return;
    }
    console.log("subcategorias:", res);
    result(null, res);
  });
};

Subcategoria.findById = (cod_sub_categoria, result) => {
  sql.query(`SELECT * FROM SUB_CATEGORIA WHERE COD_SUB_CATEGORIA='${cod_sub_categoria}'`, (err, res) => {
    if (err) {
      console.log("error: ", err);
      result(err, null);
      return;
    }
    if (res.length) {
      console.log("subcategoria encontrado: ", res[0]);
      result(null, res[0]);
      return;
    }
    result({ kind: "not_found" }, null);
  });
};

Subcategoria.remove = (id, result) => {
  sql.query("DELETE FROM SUB_CATEGORIA WHERE COD_SUB_CATEGORIA = ?", id, (err, res) => {
    if (err) {
      console.log("error: ", err);
      result(null, err);
      return;
    }
    if (res.affectedRows == 0) {
      result({ kind: "not_found" }, null);
      return;
    }
    console.log("deleted subcategoria with id: ", id);
    result(null, res);
  });
};

module.exports = Subcategoria;