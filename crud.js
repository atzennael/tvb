const express = require('express');
const bodyParser = require('body-parser');
const session = require('express-session');
const connection = require('./db');

const app = express();
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));
app.use(session({
    secret: 'your_secret_key',
    resave: false,
    saveUninitialized: true
}));

app.post('/crud', (req, res) => {
    const action = req.body.action;
    switch (action) {
        case 'buscar':
            const usuario = req.body.usuario;
            connection.query('SELECT * FROM usuario WHERE usuario = ?', [usuario], (err, results) => {
                if (err) {
                    res.status(500).send('Error in database operation');
                    return;
                }

                if (results.length > 0) {
                    res.json(results[0]);
                } else {
                    res.status(404).send('Usuario no encontrado');
                }
            });
            break;

        case 'actualizar':
            const { pass, email, telefono, identificacion } = req.body;
            connection.query('UPDATE usuario SET pass = ?, email = ?, telefono = ?, identificacion = ? WHERE usuario = ?', [pass, email, telefono, identificacion, usuario], (err, results) => {
                if (err) {
                    res.status(500).send('Error in database operation');
                    return;
                }
                res.send('Información actualizada correctamente');
            });
            break;

        case 'eliminar':
            connection.query('DELETE FROM usuario WHERE usuario = ?', [usuario], (err, results) => {
                if (err) {
                    res.status(500).send('Error in database operation');
                    return;
                }
                res.send('Cuenta eliminada correctamente');
            });
            break;

        default:
            res.status(400).send('Operación no válida');
            break;
    }
});

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});