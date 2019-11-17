const express = require('express');
const router = express.Router();
const db = require('../db');
const bodyParser = require('body-parser');
const bcrypt = require('bcrypt');
const saltRounds = 10;

router.use(bodyParser.json()); // for parsing application/json
//router.use(bodyParser.urlencoded({extended: true})); // for parsing application/x-www-form-urlencoded

/* get method for fetch all products. */
router.get('/', function(req, res, next) {
  var sql = "SELECT * FROM client";
  db.query(sql, function(err, rows, fields) {
    if (err) {
      res.status(500).send({ error: 'Something failed!' })
    }
    res.json(rows)
  })
});

/*get method for fetch single product*/
router.get('/:id', function(req, res, next) {
  var id = req.params.id;
  var sql = `SELECT * FROM client WHERE id_Client=${id}`;
  db.query(sql, function(err, row, fields) {
    if(err) {
      res.status(500).send({ error: 'Something failed!' })
    }
    res.json(row[0])
  })
});

/*post method for create product*/
router.post('/create', function(req, res, next) {
  var name = req.body.name;
  var pname = req.body.prenom;
  var mail = req.body.mail;
  var mp = req.body.MDP;
  var campus = req.body.Campus;
  var typeC = req.body.type;


  //Encrypt password (add 100 Varchar size/values on database)
  bcrypt.hash(mp, saltRounds, function(err, hash) {
    var sql = `INSERT INTO client (Nom, Prenom, Mail, MDP , Ville ,  type) VALUES ("${name}", "${pname}", "${mail}","${hash}","${campus}","${typeC}")`;
    db.query(sql, function(err, result) {
      if(err) {
        console.log("Error: " + err);
        res.status(500).send({ error: 'Something failed!' })
      } else {
        res.json({'status': 'success'})
      }
    })

  });
});

/*put method for update product*/
router.put('/update/:id', function(req, res, next) {
  var id = req.params.id;
  var name = req.body.name;
  var pname = req.body.pname;
  var mail = req.body.mail;
  var mp = req.body.mp;
  var campus = req.body.campus;
  var typeC = req.body.typeC;

  var sql = `UPDATE client SET Nom="${name}", Prenom="${pname}", Mail="${mail}",MDP="${mp}",Mail="${mail}",Ville="${campus},type="${typeC}" WHERE id_Client=${id}`;
  db.query(sql, function(err, result) {
    if(err) {
      res.status(500).send({ error: 'Something failed!' })
    }
    res.json({'status': 'success'})
  })
});


/*delete method for delete product*/
router.delete('/delete/:id', function(req, res, next) {
  var id = req.params.id;
  var sql = `DELETE FROM client WHERE id_Client=${id}`;
  db.query(sql, function(err, result) {
    if(err) {
      res.status(500).send({ error: 'Something failed!' })
    }
    res.json({'status': 'success'})
  })
})

module.exports = router;