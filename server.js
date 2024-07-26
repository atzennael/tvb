const express = require('express');
const bodyParser = require('body-parser');
const connection = require('./db');

const app = express();
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));
app.use(express.static('public'));

app.post('/create-user', (req, res) => {
    const { usuario, pass, email, telefono, identificacion } = req.body;

    console.log(req.body); // Agregar esta línea para verificar los datos recibidos

    const sql = 'INSERT INTO usuario (usuario, pass, email, telefono, identificacion) VALUES (?, ?, ?, ?, ?)';
    connection.query(sql, [usuario, pass, email, telefono, identificacion], (err, results) => {
        if (err) {
            console.error('Error in database operation:', err);
            res.status(500).send('Error in database operation');
            return;
        }
        res.send('Usuario ingresado exitosamente');
    });
});

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});
