module.exports=app=>{
    const subcategoria = require("../controllers/subcategoriaObtener.js");
      app.get("/subcategorias",subcategoria.findAll);  
      app.get("/Subcategorias/:cod_sub_categoria", subcategoria.findOne);
      app.post("/Subcategorias", subcategoria.create);
      app.delete("/Subcategorias/:cod_sub_categoria",subcategoria.delete);
      const categoria = require("../controllers/categoriaObtener.js");
      app.get("/categorias",categoria.findAll);  
      app.get("/Categorias/:cod_categoria", categoria.findOne);

    }