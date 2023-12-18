
var filesenerapi = require('./filesenderapi');

const http = require('https'); //used to download the config file
const fs = require('fs'); //used to save the config file
const ini = require('ini') //used to parse the config file

var argv = require('minimist')(process.argv.slice(2));
console.dir(argv);

var expireInDays = 7;
if( argv.expire && argv.expire >= 1 ) {
    if( argv.expire > config.max_transfer_days_valid ) {
        console.log("Error, you need to set the expire days to less than ", config.max_transfer_days_valid );
        return 1;
    }
    expireInDays = argv.expire;
}

// FIXME we should support generating a password if they do not supply anything.
if( !argv.password ) {
    console.log("please use the --password option to supply a password");
    return;
}
var password = argv.password;

