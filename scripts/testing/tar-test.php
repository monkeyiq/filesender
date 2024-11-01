<?php

//
// Note that this is a quick and dirty test script
// Use it with a directory of files you want addded
// and a path to an output tar file to make/overwrite
//
// For example:
//
//
//  mkdir -p /tmp/tar/input
//  date > /tmp/tar/input/df.txt
//
//  php tar-test.php  /tmp/tar/test.tar /tmp/tar/input
//
//  tar tvf /tmp/tar/test.tar
//  -rwxrwxrwx 0/0              33 2024-11-02 09:00 df.txt
//
require_once dirname(__FILE__).'/../../includes/init.php';



if( $argc != 3 ) {
    echo "Usage: test.php output.tar input-directory\n";
    exit(1);
}


$archivepath = $argv[1];
$srcpath     = $argv[2];

$output_stream = fopen($archivepath, 'w');


// create new zip stream object
$zip = new \Barracuda\ArchiveStream\TarArchive(
    $archivepath,
    array(
	'comment' => 'this is a zip file comment.  hello?'
    ),
    null,
    $output_stream
);



$files = scandir($srcpath);
foreach( $files as $f ) {
    if( $f != '.' && $f != '..' ) {
        $zip->add_file_from_path($f,"$srcpath/" . $f);
    }
}
$zip->finish();

fflush($output_stream);
fclose($output_stream);


