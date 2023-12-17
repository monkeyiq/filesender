const { subtle } = require('crypto').webcrypto;
const { Blob } = require('buffer');
//const Blob = require('node-blob');
const { LocalStorage } = require("node-localstorage");
const { randombytes } = require('node-get-random-values');
var FileReader = require('filereader');
global.FileReader = FileReader;

const http = require('https'); //used to download the config file
const fs = require('fs'); //used to save the config file
const ini = require('ini') //used to parse the config file

var requireFromUrl = require('require-from-url/sync');
const XRegExp = require('xregexp');
global.XRegExp = XRegExp;

var XMLHttpRequest = require('xhr2');
global.XMLHttpRequest = XMLHttpRequest;

//get the users home directory
const home = process.env.HOME || process.env.USERPROFILE;
const user_config_file = fs.readFileSync(home + '/.filesender/filesender.py.ini', 'utf8');
const user_config = ini.parse(user_config_file);
const base_url = user_config['system']['base_url'].split('/').slice(0, -1).join('/');
const default_transfer_days_valid = user_config['system']['default_transfer_days_valid'];
const username = user_config['user']['username'];
const apikey = user_config['user']['apikey'];

const { JSDOM } = require( "jsdom" );
const { window } = new JSDOM( "", {url: base_url + "/?s=upload"} );
global.$ = global.jQuery = require( "jquery" )( window );
global.window = window;
var config = requireFromUrl("https://sam/filesender/filesender-config.js.php");

var enc = new TextEncoder();


require('../../../www/js/client.js');
require('../../../www/js/filesender.js');
require('../../../www/js/transfer.js');
require('../../../www/js/crypter/crypto_common.js');
require('../../../www/js/crypter/crypto_app.js');
require('../../../www/js/crypter/crypto_blob_reader.js');

//add some required functions
global.window.filesender.ui = {};
global.window.filesender.ui.error = function(error,callback) {
    console.log('[error] ' + error.message);
    console.log(error);
}
global.window.filesender.ui.rawError = function(text) {
    console.log('[raw error] ' + text);
}
global.window.filesender.ui.log = function(message) {
    console.log('[log] ' + message);
}
global.window.filesender.ui.validators = {};
global.window.filesender.ui.validators.email = /^[a-z0-9!#$%&'*+\/=?^_\`\{|\}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_\`\{|\}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+(?:[a-z]{2,})$/i

//global.window.location = {}
global.window.location.href = base_url + "/?s=upload";

global.localStorage = new LocalStorage('/tmp/localstorage',1000000);
global.window.localStorage = global.localStorage;

global.filesender = window.filesender;
global.subtle = subtle;
global.crypto.subtle = subtle;

crypto.getRandomValues(new Uint8Array(32));

//subtle.digest( {name: 'SHA-256'}, enc.encode('passwordBuffer') ).then( function (key) {
//});



//create a new transfer
var transfer = new global.window.filesender.transfer()
global.window.filesender.client.from = username;
global.window.filesender.client.remote_user = username;
transfer.from = username;

//Turn on reader support for API transfers
global.window.filesender.supports.reader = true;
global.window.filesender.client.api_key = apikey;



console.log('hi there 2');
//console.log(config);
//console.log(window.filesender);
//console.log(window.filesender.config);



/*
async function generateAesKey(length = 256) {
  const key = await subtle.generateKey({
    name: 'AES-CBC',
    length,
  }, true, ['encrypt', 'decrypt']);

  return key;
}
*/

/*
key = generateAesKey(256).then( function( key )  {
    console.log("key ", key );
});
*/

transfer.encryption = true;
transfer.encryption_password = '123123';
transfer.disable_terasender = true;

//var x = new File([],'test.txt');
var data = fs.readFileSync('test.txt');
console.log(data);

var blob = new Blob([data]);
var errorHandler;
transfer.addRecipient(username, undefined);
transfer.addFile('test.txt', blob, errorHandler);
let expiry = (new Date(Date.now() + 7 * 24 * 60 * 60 * 1000));
transfer.expires = expiry.toISOString().split('T')[0];

transfer.start();



