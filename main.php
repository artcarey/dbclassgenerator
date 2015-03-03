<?php
	require_once 'mysqlclassgenerator.php';
	require_once 'definitions.php';
    		
	$dbName = $_REQUEST['dbname'];
	$serverName = $_REQUEST['servername'];
	
	if ($_REQUEST['language'] == "java") {
		$language = OUTPUT_JAVA;
	} else {
		$language = OUTPUT_PHP;
	}

	$userName = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	$tableName = $_REQUEST['tablename'];
	$javadoc = $_REQUEST['javadoc'];
	
	$object = new MYSQLClassGenerator();
    
    $object->setDatabaseName($dbName);
    $object->setLanguage($language);
    $object->setServerName($serverName);
    $object->setUserName($userName);
    $object->setPassword($password);
    $object->setTableName($tableName);
    $object->addOption("javadoc", $javadoc);
     
    echo '<textarea cols="80"" rows="70">'.$object->getCode().'</textarea>';
?>
 