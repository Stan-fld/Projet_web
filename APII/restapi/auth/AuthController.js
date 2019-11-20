var express = require('express');
var router = express.Router();
var bodyParser = require('body-parser');
const db = require('../db');
var clientt = require('../routes/clientt');
var uniqid = require('uniqid');
var jwt = require('jsonwebtoken');
var bcrypt = require('bcrypt');
var config = require('../config');
router.use(bodyParser.urlencoded({
	extended: false
}));
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
	var sql = "SELECT COUNT(*) as nb FROM client WHERE Mail = '" + mail + "';"
	db.query(sql, function(err, nb) {
		if (nb[0].nb == 0) {
			sql = `INSERT INTO client (Nom, Prenom, Mail, MDP , Ville ,  type) VALUES ("${name}", "${pname}", "${mail}","${hashedPassword}","${campus}","${typeC}")`;
			db.query(sql, function(err, result) {
				if (err == null){
					res.status(200).send({
						succes: true,
						message: "Vous etes bien inscrits! connectez vous"
					});
				}else{
					res.status(200).send({
						succes: false,
						message: "Une erreur technique est survenue, réessayez plus tard ou contactez votre administarteur"
					});
				}
			});
		}else{
			res.status(200).send({
				succes: false,
				message: "mail already used"
			});
		}
	});
});


router.post('/me', function(req, res) {
	var mail = req.body.mail;
	var token = req.body.token;
	console.log(req.body);
	var sql = "SELECT COUNT(*) as nb FROM client WHERE Mail = '" + mail + "' AND token = '" + token + "';"
	console.log(sql);
	db.query(sql, function(err, nb) {
		console.log(nb);
		if (nb[0].nb == 1) {
			sql = "SELECT * FROM client WHERE Mail = '" + mail + "';"
			db.query(sql, function(err, client) {
				delete client[0].MDP;
				res.status(200).send({
					succes: true, 
					client: client[0],
					message: ""
				});
			});
		}else{
			res.status(200).send({
				succes: false, 
				client: "none",
				message: "not auth"
			});
		}
	});
});
// add the middleware function
router.use(function(clientt, req, res, next) {
	res.status(200).send(clientt);
});
router.post('/login', function(req, res) {
	var mail = req.body.mail;
	var mp = req.body.MDP;
	var sql = "SELECT COUNT(*) as nb FROM client WHERE Mail = '" + mail + "';"
	db.query(sql, function(err, nb) {
		//console.log(nb);
		if (nb[0].nb == 1) {
			sql = "SELECT * FROM client WHERE Mail = '" + mail + "';"
			db.query(sql, function(err, client) {
				//console.log(client[0].MDP);
				if (bcrypt.compareSync(String(mp), String(client[0].MDP))) {
					//update token into DB 
					var token = uniqid();
					sql = "UPDATE client SET token = '" + token + "' WHERE Mail = '" + mail + "';"
					db.query(sql, function(err, client) { // TODO getsion erreur update
					})
					client[0].token = token
					delete client[0].MDP;
					res.status(200).send({
						auth: true
						, client: client[0]
					});
				} else {// cas mdp faux 
					res.status(200).send({
						auth: false, 
						client: "none",
						message: "Mail ou mdp faux" 
					});
				}
			});
		}else {// cas mail faux  
			res.status(200).send({
				auth: false, 
				client: "none",
				message: "Mail ou mdp faux" 
			});
		}
	});
});
router.get('/logout', function(clientt, req, res) {
	res.status(200).send({
		auth: false
		, token: null
	});
});
module.exports = router;