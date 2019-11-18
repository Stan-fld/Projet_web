var express = require('express');
var router = express.Router();
var bodyParser = require('body-parser');
const db = require('../db');
var clientt = require('../routes/clientt');

var jwt = require('jsonwebtoken');
var bcrypt = require('bcrypt');
var config = require('../config');


router.use(bodyParser.urlencoded({ extended: false }));
router.use(bodyParser.json());

  router.post('/register', function(req, res, next) {
    var name = req.body.name;
    var pname = req.body.prenom;
    var mail = req.body.mail;
    var campus = req.body.Campus;
    var typeC = req.body.type;
    //Encrypt password (add 100 Varchar size/values on database)
    var hashedPassword = bcrypt.hashSync(req.body.MDP, 10);
  
    //Encrypt password (add 100 Varchar size/values on database)
      var sql = `INSERT INTO client (Nom, Prenom, Mail, MDP , Ville ,  type) VALUES ("${name}", "${pname}", "${mail}","${hashedPassword}","${campus}","${typeC}")`;
      db.query(sql, function(err, result) {
        if(err) return res.status(500).send({ error: 'Something failed!' })

          //res.json({'status': 'success'})
      var sql2 = `SELECT LAST_INSERT_ID()`;
      db.query(sql2, function(err, idClient){
        if(err) return res.status(500).send({ error: 'Something failed2!' })

        // create a token
        var token = jwt.sign({ id: idClient }, config.secret, {
        expiresIn: 86400 
        });
        res.status(200).send({ auth: true, token: token });
        console.log({auth: true, token: token});
        });
    });
  });

  router.get('/me', function(req, res , ) {
    var token = req.headers['x-access-token'];
    if (!token) return res.status(401).send({ auth: false, message: 'No token provided.' });
    
    jwt.verify(token, config.secret, function(err, decoded) {
      if (err) return res.status(500).send({ auth: false, message: 'Failed to authenticate token.' });

    var sql = `SELECT Id_Client, Nom, Prenom, Mail, Ville, type FROM client where Id_Client=LAST_INSERT_ID()`;
    db.query(sql, function (err, clientt) {
        if (err) return res.status(500).send("There was a problem finding the user.");
        if (!clientt) return res.status(404).send("No user found.");
        
        res.status(200).send(clientt);
    });
    });
  });


  router.post('/login', function(req, res) {

    var mail = req.body.mail;
    var mp = req.body.MDP;

    var sql = `SELECT Mail FROM client WHERE Mail=("${mail}")`;
    db.query(sql, function (err, clientt) {
        if (err) return res.status(500).send("There was a problem finding the user.");
        if (!clientt) return res.status(404).send("No user found.");
    

    var sql2 = `SELECT MDP FROM client WHERE MDP=("${mp}")`;
    db.query(sql2, function (err, rows) {
        var passwordIsValid = bcrypt.compareSync(toString(rows),toString(mp));
        if (!passwordIsValid) return res.status(401).send({ auth: false, token: null });
        
        var sql3 = `SELECT Id_Client FROM client WHERE MDP=("${mp}")`

        db.query(sql3, function (err, Id_Client){
            var token = jwt.sign({ id: Id_Client }, config.secret, {
            expiresIn: 86400 // expires in 24 hours
            })
            res.status(200).send({ auth: true, token: token });
            })
        })
    });

});


  module.exports = router;