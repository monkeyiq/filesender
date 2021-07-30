<?php

/*
 * FileSender www.filesender.org
 *
 * Copyright (c) 2009-2012, AARNet, Belnet, HEAnet, SURFnet, UNINETT
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * *    Redistributions of source code must retain the above copyright
 *  notice, this list of conditions and the following disclaimer.
 * *    Redistributions in binary form must reproduce the above copyright
 *  notice, this list of conditions and the following disclaimer in the
 *  documentation and/or other materials provided with the distribution.
 * *    Neither the name of AARNet, Belnet, HEAnet, SURFnet and UNINETT nor the
 *  names of its contributors may be used to endorse or promote products
 *  derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
 * FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
 * OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

try
{

    require_once('../includes/init.php');

    Logger::setProcess(ProcessTypes::GUI);

    $config = Config::get('db_*');
    $config['dsn'] = Config::get('dsn');
    foreach (array('type', 'host', 'database', 'port', 'username', 'password', 'driver_options', 'charset', 'collation') as $p) {
        if (!array_key_exists($p, $config)) {
            $config[$p] = null;
        }
    }

    // Build dsn from individual components if not defined
    if (!$config['dsn']) {
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
    }
    
    $username = $config['username'];
    $password = $config['password'];
    
    // Connect
    $instance = new PDO(
        $config['dsn'],
        $username,
        $password,
        $config['driver_options']
    );

    echo "<h1>Database attributes</h1>\n";
    $attributes = array(
        "AUTOCOMMIT", "ERRMODE", "CASE", "CLIENT_VERSION", "CONNECTION_STATUS",
        "ORACLE_NULLS", "PERSISTENT", "PREFETCH", "SERVER_INFO", "SERVER_VERSION",
        "TIMEOUT"
    );

    foreach ($attributes as $val) {
        try {
            echo "PDO::ATTR_$val: ";
            echo $instance->getAttribute(constant("PDO::ATTR_$val")) . "";
        } catch(Exception $e) {
            echo "exception...";
        }
        echo "<br/>\n";
    }    

    echo "<h1>trying to access database</h1>\n";
    
    $id = 1;
    $statement = $instance->prepare('SELECT * FROM '.Transfer::getDBTable().' order by id desc limit 1');
    $statement->execute(array());
    $records = $statement->fetchAll();
    foreach ($records as $r) {
        echo 'found id ' . $r['id'] . "\n";
    }
    echo "<br/>done\n";

} catch(Exception $e) {
    // If all exceptions are catched as expected we should not get there
    die('An exception happened : '.$e->getMessage());
}
