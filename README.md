
This is a branch of FileSender that adds a javascript REST client
proof of concept (PoC). The PoC allows uploading a single file with
encryption from the command line. That transfer can then be seen from
the web interface and downloaded with the same passphrase. The code in
it's current state is a PoC and needs work to be made ready as a PR.

The javascript REST client uses the same javascript code that the
browser does to perform the upload. This includes the encryption of
data performed by crypto_app.js. The REST client uses a nodejs
implementation of WebCrypto to enable this functionality.

Usage:

```
$ cd scripts/client/nodeclient
$ export NODE_TLS_REJECT_UNAUTHORIZED='0'
$ node upload.js 
```

The code here uses code from 
https://github.com/br00k/filesender/commit/5330c2b361a9e8ac3749181bac1cab37707be70e
code from there retains the copyright/license from there and added
code is copyright Ben Martin with the same "BSD 3-Clause License" that
FileSender uses.

The following is a non exhaustive list of updates that are needed
before a pull request is attempted:

* The API call HMAC code is explicitly disabled in the PoC. Thus the
  PoC does not offer any protection for API calls to upload (or
  perform any other action) and is not suitable for anything other
  than PoC usage.

  It is possible in the future that the data that forms the signature
  string handed to the HMAC code might not include the actual data
  sent to the File chunk put chunk, filesender.client.putChunk(), to
  allow the client to not have to read the entire blob to be sent at
  that time. See AuthRemote.class.php "XXXXXXXXXXXXXXX FIXME".

* In order to force remote app authentication I disabled
  isRemoteUser() and isRemote() in Auth. These changes obviously must
  not be present in any PR. In its current form the PoC considers all
  access to be remote. This plays with the above lack of HMAC
  verification so general web use may be considered acceptable as
  remote use with not HMAC verification. Search for
  "XXXXXXXXXXXXXXXXXXX FIXME" in Auth.class.php.

* The sent Chunk size and data size check is disabled in
  RestEndpointFile.class.php.

* TeraSender upload has not been tested. This would be the preferred
  upload method for best performance.

* There is no download path. As upload is working the download code
  calls should be able to be added to the rest client.

* Ensure that upload resume works.

* Better/existent error checking

* It would be nice to have "get a link" mode available from the
  command line. This would also allow desktop widgets to act as
  FileSender drop points offer to upload to FileSender and show the
  user a link to the uploaded file on completion.

* File upload progress on the command line would likely be nice.

* Perhaps the client should read ~/.filesender/filesender.ini and a
  recommendation made to soft link that to filesender.py.ini.

* The PoC is used with self signed certificates so it disables cert
  checking. That should be either removed to made to respect the
  NODE_TLS_REJECT_UNAUTHORIZED environment variable.

------------------------------------------------------------------

# FileSender

[![Build Status](https://travis-ci.org/filesender/filesender.svg?branch=master)](https://travis-ci.org/filesender/filesender)

## Introduction

FileSender is a web based application that allows authenticated users to securely and easily send arbitrarily large files to other users.  Authentication of users is provided through [SimpleSAMLphp](http://simplesamlphp.org/docs/stable/simplesamlphp-idp#section_2), supporting SAML2, LDAP and RADIUS and more.  Users without an account can be sent an upload voucher by an authenticated user.  FileSender is developed to the requirements of the higher education and research community.

The purpose of the software is to send a large file to someone, have that file available for download for a certain number of downloads and/or a certain amount of time, and after that automatically delete the file.  The software is not intended as a permanent file publishing platform.

## Mailing Lists
The FileSender project uses a number of mailinglists to support people deploying FileSender software and to coordinate development. Please go to the [Support and Mailinglists](http://filesender.org) page and subscribe yourself to those lists relevant for you.

## Documentation
Installation and administrator documentation for FileSender 2.0 is provided at [docs.filesender.org](http://docs.filesender.org).

## Developer
Development documentation is provided in the [contribution guide](CONTRIBUTE.md).


