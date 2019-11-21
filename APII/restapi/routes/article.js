const express = require('express');
const router = express.Router();
const db = require('../db');
const bodyParser = require('body-parser');

router.use(bodyParser.json()); // for parsing application/json
router.use(bodyParser.urlencoded({extended: true})); // for parsing application/x-www-form-urlencoded


/* get method for fetch all images. */
router.get('/image', function(req, res, next) {
  var sql = "SELECT * FROM image";

  db.query(sql, function(err, rows, fields) {
    if (err) {
      res.status(500).send({ error: 'Something failed!' })
    }
    else {
      res.json(rows)
    }
  })
});

/* get method for fetch all images. */
router.get('/', function(req, res, next) {
  var sql = "SELECT * FROM article";

  db.query(sql, function(err, rows, fields) {
    if (err) {
      res.status(500).send({ error: 'Something failed!' })
    }
    else {
      res.json(rows)
    }
  })
});

/* get method for fetch all article types. */
router.get('/articletype', function(req, res, next) {
  var sql = `SELECT type FROM type WHERE famille_type="article"`;

  db.query(sql, function(err, rows, fields) {
    if (err) {
      res.status(500).send({ error: 'Something failed!' })
    }
    else {
      res.json(rows)
    }
  })
});


// GETS A SINGLE USER FROM THE DATABASE
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


/*methode POST pour créer un article*/
router.post('/create', function(req, res, next) {
  var taille = req.body.taille;
  var NOM = req.body.NOM;
  var PRIX = req.body.PRIX;
  var DESCRIPTION = req.body.DESCRIPTION;
  var VILLE = req.body.Ville;
  var URL = req.body.URL;
  var type = req.body.type;

  var sql = `INSERT INTO article (ID_article, taille, NOM, PRIX, DESCRIPTION, Ville, URL, type) VALUES (NULL, "${taille}", "${NOM}", "${PRIX}","${DESCRIPTION}","${VILLE}","${URL}","${type}")`;
  db.query(sql, function(err, result) {
    if(err) {
      res.status(500).send({ error: 'Something failed!' })
    }
    else {
      res.json({'status': 'success'})
      
    }
  })
});

// UPDATES A SINGLE USER IN THE DATABASE
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


// DELETE A SINGLE USER IN THE DATABASE
/*delete method for delete product*/
router.delete('/delete/:id', function(req, res, next) {
  var id = req.params.id;
  var sql = `DELETE FROM article WHERE ID_article=${id}`;
  db.query(sql, function(err, result) {
    if(err) {
      res.status(500).send({ error: 'Something failed!' })
    }
    res.json({'status': 'success'})
  })
})

module.exports = router;