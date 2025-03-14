<?php

require_once dirname(__FILE__).'/../../includes/init.php';


/////////

$config = Config::get('db_*');
$config['dsn'] = Config::get('dsn');


if(ConfigPrivate::havekey('db_username')) {
    $config['username'] = ConfigPrivate::get('db_username');
}
if(ConfigPrivate::havekey('db_password')) {
    $config['password'] = ConfigPrivate::get('db_password');
}

$username = $config['username'];
$password = $config['password'];

//$username = "fdsfsd";

foreach (array('type', 'host', 'database', 'port', 'username', 'password', 'driver_options', 'charset', 'collation') as $p) {
    if (!array_key_exists($p, $config)) {
        $config[$p] = null;
    }
}


if (!$config['type']) {
    $config['type'] = 'pgsql';
}

$params = array();

if (!$config['host']) {
    throw new DBIConnexionMissingParameterException('host');
}
$params[] = 'host='.$config['host'];

if (!$config['database']) {
    throw new DBIConnexionMissingParameterException('database');
}
$params[] = 'dbname='.$config['database'];

if ($config['port']) {
    $params[] = 'port='.$config['port'];
}

$config['dsn'] = $config['type'].':'.implode(';', $params);

echo "dsn " . $config['dsn'] . "\n";



$instance = new PDO(
    $config['dsn'],
    $username,
    $password,
    $config['driver_options']
);




