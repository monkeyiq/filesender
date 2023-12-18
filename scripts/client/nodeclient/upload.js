
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

transfer.encryption = true;
transfer.encryption_password = '123123';
transfer.disable_terasender = true;

argv._.forEach((filename) => {

    var displayPath = filename.replace(/^[\.\/]*/, '');
    console.log("Adding file: ", filename );
    var data = fs.readFileSync(filename);
    console.log(data);

    var blob = new Blob([data]);
    var errorHandler;
    transfer.addRecipient(username, undefined);
    transfer.addFile(displayPath, blob, errorHandler);
});

let expiry = (new Date(Date.now() + expireInDays * 24 * 60 * 60 * 1000));
//transfer.expires = expiry.toISOString().split('T')[0];
transfer.expires = Math.floor(expiry.getTime()/1000);
console.log("expireInDays ", expireInDays );
console.log("expire " , expiry.toISOString() );
console.log("transfer.expires ", transfer.expires );

transfer.options.get_a_link = true;


transfer.oncomplete = function(transfer, time) {
    console.log("Your download link: ", global.transfer.download_link );
}


transfer.start();
