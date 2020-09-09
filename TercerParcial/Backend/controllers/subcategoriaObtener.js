const Subcategoria = require('../models/subcategoria.js');

exports.create = (req, res) => {
    if (!req.body) {
        res.status(400).send({
            message: "contenido no puede estar vacio!"
        });
    }
    const subcategoria = new Subcategoria({
        COD_CATEGORIA: req.body.COD_CATEGORIA,
        COD_SUB_CATEGORIA: req.body.COD_SUB_CATEGORIA,
        NOMBRE: req.body.NOMBRE,
        DESCRIPCION: req.body.DESCRIPCION, 
        FECHA_CREACION: req.body.FECHA_CREACION
    });
    Subcategoria.create(subcategoria, (err, data) => {
        if (err)
            res.status(500).send({
                message:
                    err.message || "han ocurrido algunos errores creando subcategoria."
            });
        else res.send(data);
    });
};

exports.findAll = (req, res) => {
    Subcategoria.getAll((err, data) => {
        if (err)
            res.status(500).send({
                message:
                    err.message || "Some error occurred while retrieving subcategorias."
            });
        else res.send(data);
    });
};

exports.findOne = (req, res) => {
        Subcategoria.findById(req.params.cod_sub_categoria, (err, data) => {
        if (err) {
            if (err.kind == "not_found") {
                res.status(404).send({
                    message: `not found Subcategoria with id ${req.params.cod_sub_categoria}.`
                });
            } else {
                res.status(500).send({
                    message: "Error al recuperar subcategoria con id" + req.params.cod_sub_categoria
                });
            }
        } else res.send(data);
    });
};

exports.delete = (req, res) => {
    Subcategoria.remove(req.params.cod_sub_categoria, (err, data) => {
        if (err) {
            if (err.kind == "no encontrado") {
                res.status(404).send({
                    message: `Not found SUBCATEGORIA WITH COD ${REQ.PARAMS.cod_sub_categoria}`
                });
            } else {
                res.status(509).send({
                    message: "No se pudo eliminar subcategoria codigo: " + req.params.cod_sub_categoria
                });
            }
        } else res.send({ message: `Subcategoria elimnado satisfactoriamente!` });
    });
};

exports.update = (req, res) => {
    if (!req.body) {
        res.status(400).send({
            message: "Content can not be empty!"
        });
    }

    console.log(req.body);
    Subcategoria.updateById(
        req.params.cod_sub_categoria,
        new Subcategoria(req.body),
        (err, data) => {
            if (err) {
                if (err.kind === "not_found") {
                    res.status(404).send({
                        message: `Not found subcategoria with cod ${req.params.cod_sub_categoria}.`
                    });
                } else {
                    res.status(500).send({
                        message: "Error updating subcategoria with id " + req.params.cod_sub_categoria
                    });
                }
            } else res.send(data);
        }
    );
};


