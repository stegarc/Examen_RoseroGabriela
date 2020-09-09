const sql = require('../util/database.js');



const Categoria = function (categoria) {
    this.COD_CATEGORIA=categoria.COD_CATEGORIA;
    this.DESCRIPCION= categoria.DESCRIPCION;
}


Categoria.getAll = result => {
  sql.query("SELECT * FROM CATEGORIA", (err, res) => {
    if (err) {
      console.log("error:", err);
      result(null, err);
      return;
    }
    console.log("categorias:", res);
    result(null, res);
  });
};

Categoria.findById = (cod_categoria, result) => {
  sql.query(`SELECT * FROM CATEGORIA WHERE COD_CATEGORIA='${cod_categoria}'`, (err, res) => {
    if (err) {
      console.log("error: ", err);
      result(err, null);
      return;
    }
    if (res.length) {
      console.log("categoria encontrado: ", res[0]);
      result(null, res[0]);
      return;
    }
    result({ kind: "not_found" }, null);
  });
};

module.exports = Categoria;