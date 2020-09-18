const Categoria = require('../models/categoria.js');

exports.create = (req, res) => {
    if (!req.body) {
        res.status(400).send({
            message: "contenido no puede estar vacio!"
        });
    }
    const categoria = new Categoria({
        COD_CATEGORIA: req.body.COD_CATEGORIA,
        DESCRIPCION: req.body.DESCRIPCION
    });
    categoria.create(categoria, (err, data) => {
        if (err)
            res.status(500).send({
                message:
                    err.message || "han ocurrido algunos errores creando categoria."
            });
        else res.send(data);
    });
};

exports.findAll = (req, res) => {
   Categoria.getAll((err, data) => {
        if (err)
            res.status(500).send({
                message:
                    err.message || "Some error occurred while retrieving categorias."
            });
        else res.send(data);
    });
};


exports.findOne = (req, res) => {
    Categoria.findById(req.params.cod_categoria, (err, data) => {
    if (err) {
        if (err.kind == "not_found") {
            res.status(404).send({
                message: `not found categoria with id ${req.params.cod_categoria}.`
            });
        } else {
            res.status(500).send({
                message: "Error al recuperar categoria con id" + req.params.cod_categoria
            });
        }
    } else res.send(data);
});
};



