
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
console.log("AAAAA password ", password );

global.alert = function(msg) { console.log(msg); }
if( !filesender.terasender ) {
    filesender.terasender = {};
}
filesender.terasender.stop = function() { console.log("EEEEE terasender.stop");}


argv._.forEach((transferLink) => {
    console.log("Downloading from transfer ", transferLink);

    var token = '069373a6-b237-44f0-bec4-4f19b7cf04da';
    var options = { args: {'token': token}};
//    var options = {};
    window.filesender.client.get('/transfer/fileidsextended',
                                 function(files) {
                                     console.log("callback!");
                                     files.forEach((dl) => {
                                         console.log("Downloading dl id ", dl.id );
                                         console.log("Downloading dl  ", dl );

                                         var crypto_app = window.filesender.crypto_app();

                                         window.filesender.ui.prompt = function() { return password; }
                                         // var progress = function() { };
                                         var progress = null;
                                         window.filesender.crypto_encrypted_archive_download = false;


                                         // FIXME: move to decryptDownloadToBlobSink() to avoid UI code.                                         

                                         var filesize = dl.size;
                                         var mime = dl.mime;
                                         var name = "output.txt";

                                         fs.writeFileSync(name, Buffer.from(''),
                                         {
                                             encoding: "utf8",
                                             flag: "w",
                                             mode: 0o660
                                         });                                                 
                                                   
                                         var blobSinkLegacy = {
                                             blobArray: [],
                                             // keep a tally of bytes processed to make sure we get everything.
                                             bytesProcessed: 0,
                                             expected_size: filesize,
//                                             callbackError: callbackError,
                                             name: function() { return "legacy"; },
                                             error: function(error) {
                                             },
                                             visit: function(chunkid,decryptedData) {
                                                 window.filesender.log("SINK blobSinkLegacy visiting chunkid " + chunkid + "  data.len " + decryptedData.length );
                                                 console.log("decryptedData " , decryptedData);
                                                 this.blobArray.push(decryptedData);
                                                 this.bytesProcessed += decryptedData.length;
                                                 var buffer = Buffer.from(decryptedData);
                                                 console.log("buffer " , buffer);
                                                 fs.writeFileSync(name, buffer,
                                                                  {
                                                                      encoding: "utf8",
                                                                      flag: "a+",
                                                                      mode: 0o660
                                                                  });                                                 
                                                 
                                             },
                                             done: function() {
                                                 window.filesender.log("SINK blobSinkLegacy.done()");
                                                 window.filesender.log("SINK blobSinkLegacy.done()      expected size " + filesize );
                                                 window.filesender.log("SINK blobSinkLegacy.done() decryped data size " + this.bytesProcessed );
                                                 window.filesender.log("SINK blobSinkLegacy.done()     blobarray size " + this.blobArray.length );

                                                 if( this.expected_size != this.bytesProcessed ) {
                                                     window.filesender.log("blobSinkLegacy.done() size mismatch");
//                                                     this.callbackError('decrypted data size and expected data size do not match');
                                                     return;
                                                 }
                                             }
                                         };
                                         
                                         var blobSink = blobSinkLegacy;
                                         var blobSinkStreamed = blobSinkLegacy;
                                         var link = config.site_url
                                             + 'download.php?token=' + token
                                             + '&files_ids=' + dl.id;

                                         console.log("config ", config );
                                         console.log("download link ", link );
                                         console.log("pass ", password );
                                         console.log("tid  ", dl.transferid );
                                         console.log("mime ", dl.mime );
                                         console.log("fname ", dl.name );
                                         console.log("size  ", dl.size );
                                         console.log("esize ", dl.encrypted_size );
                                         console.log("kver ", dl.key_version );
                                         console.log("salt ", dl.key_salt );
                                         console.log("pver ", dl.password_version );
                                         console.log("penc ", dl.password_encoding );
                                         console.log("hasiters ", dl.password_hash_iterations );
                                         console.log("cliente  ", dl.client_entropy );
                                         console.log("aead     ", dl.fileaead );
                                         
                                         crypto_app.decryptDownloadToBlobSink( blobSink, password,
                                                                               dl.transferid, link,
                                                                               dl.mime, dl.name, dl.size, dl.encrypted_size,
                                                                               dl.key_version, dl.key_salt,
                                                                               dl.password_version, dl.password_encoding,
                                                                               dl.password_hash_iterations,
                                                                               dl.client_entropy,
                                                                               window.filesender.crypto_app().decodeCryptoFileIV(dl.fileiv,dl.key_version),
                                                                               dl.fileaead,
                                                                               progress );


                                         
                                         
                                     });
                                 },
                                 options);
    
    
});
// signed = "get&sam/filesender/rest.php/transfer/fileids?_=1702893469296&remote_user=testdriver@localhost.localdomain&timestamp=1702893469&"
//             get&sam/filesender/rest.php/transfer/fileids?remote_user=testdriver@localhost.localdomain&timestamp=1702893469
