
The directory www/lib contains some third party libraries

The installation in that directory is kept to only the files
that might need to be served in order for FileSender to run.

This directory contains a package.json file that can be used 
with npm to install the libraries and specific versions and
the www/lib can then be updated from the directory tree
generated by npm. 

The procedure is that you update package.json as desired
```
   npm install newpackage --save
```

And maybe edit which versions are desired and run
```
   npm update
```

then compare the output from following commands to see what the existing
(www/lib) versions are and what the new (node_modules) versions will be.

php show-existing-versions.php
php show-new-versions.php

to update your www/lib versions from specific minimal files from
node_modules use the script

php update-library-versions-from-node_modules.php

then git commit that and push it up to github.
