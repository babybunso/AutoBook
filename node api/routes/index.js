
const express = require('express'),
	dotenv = require('dotenv'),
	env = dotenv.config(),
	environment = env.parsed;
	var router = express.Router(),
	sleep = require('await-sleep'),
	request = require("request"),
	status = require('../helpers/status'),
	queries = require('../helpers/queries');

let header = {   'Content-Type': 'application/json' };
	//randomstring = require('randomstring');


// GET home page
router.get('/', (req, res) => {
	res.sendStatus(200);


});

router.post('/', (req, res) => {
	res.sendStatus(200);

});

/**
 * 	Car List API
 */
router.get('/cars', async(req,res) => {
	
	let list = await queries.displayCars();
	let message = await status.returnStatusMessage("success", false, list);
	res.status(200).send(message);

});

/**
 * 	Car API Search per brand
 */
router.get('/cars/:brand', async(req,res) => {
	let brand = req.params.brand;
	let list = await queries.displayCars(` AND car_brands = '${brand}' `);
	
	console.log(list)

	let message = await status.returnStatusMessage("success", false, list);
	res.status(200).send(message);

});

/*
	Available Car
*/
router.get('/cars_lists', async(req,res) => {
	let list = await queries.displayCarList();

	console.log(list.length)
	
	for (let i = 0; i < list.length; i++) {
		list[i].rates = {
			"base" : 850,
			"rate_4hr" :  850 * 4,
			"rate_8hr" :  850 * 8,
			"rate_12hr" :  10200,
			"rate_16hr" :  13600,
			"rate_20hr" :  17000,
			"rate_24hr" :  20400,
			"rate_1hr_cash_bond" :  850,
			"rate_4hr_cash_bond" :  3350,
			"rate_8hr_cash_bond" :  6725,
			"rate_12hr_cash_bond" :  10100,
			"rate_16hr_cash_bond" :  13475,
			"rate_20hr_cash_bond" :  16850,
			"rate_24hr_cash_bond" :  20225,
		}
		/*
		list[i].rate_1hr_discounted = 850;
		list[i].rate_4hr_discounted = 3350;
		list[i].rate_8hr_discounted = 6725;
		list[i].rate_12hr_discounted = 10100;
		list[i].rate_16hr_discounted = 13475; 
		list[i].rate_20hr_discounted = 16850;
		list[i].rate_24hr_discounted = 20225;
		list[i].rate_1hr_score_rate = 1700;
		list[i].rate_4hr_score_rate = 6700;
		list[i].rate_8hr_score_rate = 13450;
		list[i].rate_12hr_score_rate = 20200;
		list[i].rate_16hr_score_rate = 26950; 
		list[i].rate_20hr_score_rate = 33700;
		list[i].rate_24hr_score_rate = 40450;
		list[i].rate_1hr_cash_bond = 850;
		list[i].rate_4hr_cash_bond = 3350;
		list[i].rate_8hr_cash_bond = 6725;
		list[i].rate_12hr_cash_bond = 10100;
		list[i].rate_16hr_cash_bond = 13475;
		list[i].rate_20hr_cash_bond = 16850;
		list[i].rate_24hr_cash_bond = 20225; */
	}


	let message = await status.returnStatusMessage("success", false, list);

	res.status(200).send(message);
	

});

//export default router;
module.exports = router;
