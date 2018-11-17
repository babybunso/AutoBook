/****
 *	Densetsu Ghem
 */
'use strict';
	const 
		dotenv = require('dotenv'),
		env = dotenv.config(),
		environment = env.parsed,
		express = require('express'),
		bodyParser = require('body-parser'),
		app  = express().use(bodyParser.json()),
		index = require('./routes/index'),
		publicDir = __dirname  + "/images";

	var path = require('path');
		const http = require('http') ;

	app.use(bodyParser.json()); // support json encoded bodies
	app.use(bodyParser.urlencoded({ extended: true })); // support encoded bodies
	app.use('/static', express.static(path.join(__dirname, 'images')));
	app.use('/', index); 

	app.get('*', function(req, res){
		res.status(404).send("Error");
	});

var server = app.listen(environment.PORT, (req,res) => {
	console.log('API listening to port ' + environment.PORT);
	
});



      server.timeout = 10000;

