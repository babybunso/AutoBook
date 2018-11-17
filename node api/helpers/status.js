const express = require('express'),
	dotenv = require('dotenv'),
        env = dotenv.config(),
	environment = env.parsed;
var router = express.Router(),
	//sleep = require('await-sleep'),
        crypto = require('crypto');


const returnStatusMessage =  (status_id, is_error, data=Array()) => {
        let message;
        let status = {
                success : "Car List"
        };
        
        if (is_error) {
                message = {
                        "status" : "error",
                        "message" : status[status_id],
                        "data" : data,
                        "status_code" : 500	
                };
        } else {
                message = {
                        "status" : "success",
                        "message" : status[status_id],
                        "data" : data,
                        "status_code" : 400	
                };
        }

    
       
        return message;
        //returnStatusMessage(true, "mobile_required")
};


module.exports = {
        returnStatusMessage
};      