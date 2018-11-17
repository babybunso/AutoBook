const mysql = require('mysql');
const dotenv = require('dotenv'),
        env = dotenv.config(),
	environment = env.parsed;


var con = mysql.createConnection({
        host: environment.DB_HOST, 
        user:environment.DB_USER,
        password: environment.DB_PASS,
        database :environment.DB_NAME,
        reconnect: true
});   


con.connect();


function singleTableQuery(table, where, order_by, fields = "*", direction='asc', start=0, limit=100) {
        var queryString = `SELECT ${fields} FROM ${table} WHERE ${where} ORDER BY  ${order_by} ${direction} LIMIT ${start}, ${limit}`;
       console.log(queryString)
        return new Promise((resolve, reject) => {
                con.query(queryString, function (err, rows, fields) {
                        if (err) reject( err)

                       else {
                        resolve(rows)
                       }
                         
                })
        });
}

function singleQuery(queryString) {
     //   var queryString = `SELECT ${fields} FROM ${table} WHERE ${where} ORDER BY  ${order_by} ${direction} LIMIT ${start}, ${limit}`;
        return new Promise((resolve, reject) => {
                con.query(queryString, function (err, rows, fields) {
                        if (err) reject( err)

                       else {
                        resolve(rows)
                       }
                         
                })
        });
}

function displayCars(filter='') {
        let sqlString = ` SELECT car_id, 
                                        car_model, 
                                        car_model_type, 
                                        car_year, 
                                        car_description,
                                     /*    FORMAT(car_idb, 2), */
                                        car_image,
                                        car_brands
                                FROM cars 
                                WHERE car_deleted=0 
                                        AND car_status='Active' ${filter} `;

        return new Promise((resolve, reject) => {
                con.query(sqlString, function (err, rows, fields) {
                        if (err) reject( err)

                       else {
                        resolve(rows)
                       }
                         
                })
        });

}

function displayCarList() {
        let sqlString = `SELECT *, IFNULL(car_mileage_discount, 0) as car_mileage_discount FROM carownerslists
                                where carownerslist_status='Active'
                                AND carownerslist_deleted=0

                        `;

        
        return new Promise((resolve, reject) => {
                con.query(sqlString, function (err, rows, fields) {
                        if (err) reject( err)

                       else {
                        resolve(rows)
                       }
                         
                })
        });
}

module.exports = {
        displayCars,
        displayCarList
}



