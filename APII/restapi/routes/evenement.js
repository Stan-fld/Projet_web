const express = require('express');
const router = express.Router();
const db = require('../db');
const bodyParser = require('body-parser');

router.use(bodyParser.json()); // for parsing application/json
router.use(bodyParser.urlencoded({extended: true})); // for parsing application/x-www-form-urlencoded


/* get method for fetch all images. */
router.get('/image', function(req, res, next) {
  var sql = "SELECT URL FROM image";

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
  var sql = "SELECT * FROM evenement";

  db.query(sql, function(err, rows, fields) {
    if (err) {
      res.status(500).send({ error: 'Something failed!' })
    }
    else {
      res.json(rows)
    }
  })
});

/* get method for fetch all article types.**/ 
router.get('/evenementtype', function(req, res, next) {
  var sql = `SELECT type FROM type WHERE famille_type="client"`;

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
  var sql = `SELECT * FROM evenement WHERE ID_evenement=${id}`;
  db.query(sql, function(err, row, fields) {
    if(err) {
      res.status(500).send({ error: 'Something failed!' })
    }
    res.json(row[0])
  })
});


/*methode POST pour créer un article*/
router.post('/create', function(req, res, next) {
  var name = req.body.name;
  var date = req.body.date;
  var URL = req.body.URL;
  var VILLE = req.body.VILLE;


  var sql = `INSERT INTO evenement (ID_evenement, nom, date, URL, Ville) VALUES (NULL, "${name}", "${date}", "${URL}","${VILLE}")`;
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
    var name = req.body.name;
    var date = req.body.date;
    var URL = req.body.URL;
    var VILLE = req.body.ville;

  var sql = `UPDATE client SET nom="${name}",date"${date}",URL="${URL}",Ville="${VILLE}") `;
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
  var sql = `DELETE FROM evenement WHERE ID_evenement=${id}`;
  db.query(sql, function(err, result) {
    if(err) {
      res.status(500).send({ error: 'Something failed!' })
    }
    res.json({'status': 'success'})
  })
})

module.exports = router;