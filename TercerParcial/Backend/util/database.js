const mysql = require('mysql2');

const pool = mysql.createPool({
    host: 'proyectoweb3.mysql.database.azure.com',
    user: 'proyecto@proyectoweb3',
    database: 'examen',
    password: 'admin123.'
});

module.exports = pool;