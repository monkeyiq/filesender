
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

argv._.forEach((transferLink) => {
    console.log("Downloading from transfer ", transferLink);

    var options = { args: {'token': '6e5c6201-ff6e-4120-9779-effca4f2b6ad'}};
//    var options = {};
    window.filesender.client.get('/transfer/fileidsextended',
                                 function(files) {
                                     console.log("callback!");
                                     files.forEach((file) => {
                                         console.log("Downloading file id ", file.id );
                                         console.log("Downloading file  ", file );
                                         
                                     });
                                 },
                                 options);
    
    
});
// signed = "get&sam/filesender/rest.php/transfer/fileids?_=1702893469296&remote_user=testdriver@localhost.localdomain&timestamp=1702893469&"
//             get&sam/filesender/rest.php/transfer/fileids?remote_user=testdriver@localhost.localdomain&timestamp=1702893469
