const express = require('express'),
        dotenv = require('dotenv'),
        randomstring = require('randomstring');
        env = dotenv.config(),
        environment = env.parsed,
	status = require('../helpers/status');

var router = express.Router(),
        sleep = require('await-sleep'),
        queries = require('../helpers/queries'),
	/* request = require("request"), 
	
	libraries = require('../helpers/libraries'),*/
        crypto = require('crypto'),
        moment = require('moment');


const generateMoment = () => {
        return moment().format('YYYYMMDDHmmss');
};

const expirationGenerate = (day) => {
        let expiration = moment().add(day, 'days');
        let expiration_date = moment(expiration).format('YYYY-MM-DD HH:mm:ss'); 

        console.log(moment(), expiration_date, day, expiration);
        return expiration_date;
}


const decryptToken = async (req, userinfo) => {
        let algorithm = environment.ALGORITHM;
        let password = environment.CRYPTO_PASS; 

        let mobile_number = (req.mobile_number == undefined) ? userinfo[0].subscriber_mobileno : req.mobile_number;
        let token = req.token;
	let id = req.subscriber_id;
        
        var decipher = crypto.createDecipher(algorithm,password);
        var data = decipher.update(token,'hex','utf8');
       
                data += decipher.final('utf8');
                data = JSON.parse(data);
               
                
                console.log("DECRYPT")
               

            
        let now =moment().format('YYYY-MM-DD HH:mm:ss'); 
        let expdate = moment(data.expiration_date).format('YYYY-MM-DD HH:mm:ss');
         
                console.log(data.expiration_date, userinfo[0].subscriber_expiration, expdate, data.subscriber_id, userinfo[0].subscriber_id, now )

                

               
                if (data.mobile_number == userinfo[0].subscriber_mobileno && data.expiration_date == expdate && data.subscriber_id == userinfo[0].subscriber_id) {

                        console.log("MEEE")
                        if (now <= expdate) {
                                console.log("EE3", mobile_number)
                                req.mobile_number = mobile_number
                                data.token = token;
                               // message = await encryptData(req, userinfo[0].subscriber_id, 'Active');
                                message = await status.returnMessageToken(data, false);
                                return data;
                        }
                        else if (data.mobile_number == userinfo[0].subscriber_mobileno && data.expiration_date < userinfo[0].subscriber_expiration && data.subscriber_id == userinfo[0].subscriber_id) {
                               
                                message = await encryptData(req, userinfo[0].subscriber_id, 'Active');
                                return message;  
                        }
                        else 
                        {
                               //re request access token 
                               message = await encryptData(req, userinfo[0].subscriber_id, 'Active');
            
                               return message;  
                        }
                      
                }

        
};

const encryptData = async (req, subscriber_id, status='Pending', ifRecycle='') => {
        let algorithm = environment.ALGORITHM;
        let password = environment.CRYPTO_PASS; 
        let expiration_date = expirationGenerate(environment.EXPIRATION);
      
        let mobile_number = req.mobile_number;

        let data = {    
                "mobile_number" : mobile_number,
                "expiration_date" : expiration_date,
                "subscriber_id" : subscriber_id
        };

       
        data = JSON.stringify(data);

        var cipher = crypto.createCipher(algorithm,password)
	var token = cipher.update(data, 'utf8', 'hex')
                  token += cipher.final('hex');

                  console.log(expiration_date)
                  console.log(data);
                  console.log(token)
       
        let token_user; // = await queries.updateUser(mobile_number, status, token, expiration_date);
        if (status == 'Active') {
                if (status != 'Recycle')
                        token_user = await queries.updateUserExisting(mobile_number, status, token, expiration_date, subscriber_id);
                else {
                        if (ifRecycle != '')
                                token_user = await queries.updateUserExisting(mobile_number, status, token, expiration_date, subscriber_id, 'Recycle');
                        else 
                        token_user = await queries.updateUserExisting(mobile_number, status, token, expiration_date, subscriber_id);
                }
        }
      
        else {
                token_user = await queries.updateUser(mobile_number, status, token, expiration_date, subscriber_id);
        }
   
        if (token_user.affectedRows > 0) {
               let  message = {
                       "status" : "success",
                       "token" : token,
                       "mobile_number" : mobile_number,
                        "expiration_date" :expiration_date,  
                        "subscriber_id" : subscriber_id	
                };

                return message;
        } else 
        {
                console.log("ASSDAD");
                let  message = {"token" : token,
                        "mobile_number" : mobile_number,
                        "expiration_date" :expiration_date,  
                        "subscriber_id" : subscriber_id	
                };

                return message;
        }
        
        
};

const verificationCode = async () => {
       return  randomstring.generate({
                length: 4,
                charset: 'alphanumeric'
        });
}


module.exports = {
        generateMoment,
        encryptData,
        decryptToken,
        verificationCode
}