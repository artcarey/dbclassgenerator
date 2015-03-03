<?php
	require_once 'definitions.php';
	require_once 'generatorfactory.php';
	
/**
 * @author Art Carey
 * The abstract base class for class creation. Derived classes override the abstract function loadFieldDefinitions() to populate the
 * generatorInfo with field definitions, server, database, and table information.
 */
abstract class DBClassGenerator {
	/**The output language.*/
	protected $language = OUTPUT_PHP;
	
	/**The database type.*/
	protected $databaseType = "";
	
	/**The server name.*/
	protected $serverName = "";
	
	/**The database name.*/
	protected $databaseName = "";
	
	/**The table name.*/
	protected $tableName = "";
	
	/**The DB user name.*/
	protected $userName = "";
	
	/**The DB password.*/
	protected $password = "";
	
	/**
	 *Holds field definition and other data that is subsquently passed to objects
	 *implementing the IDBTableCodeGenerator interface when getCode() is called.
	 *
	 * @var DBClassGeneratorInfo
	 */
	protected $generatorInfo;
	
	/**
	 * Abstract function.  This function is called at the very begining of getCode().  Derived classes override this function and populate the
	 * $generatorInfo member.  $generatorInfo is then passed to an object implementing the IDBTableCodeGenerator interface.
	 */
	abstract protected function loadFieldDefinitions();

	/**
	 * Constructor.
	 */
	public function DBClassGenerator() {
		$this->generatorInfo = new DBClassGeneratorInfo();
	}
	
	/**
	 * Adds a key value pair to the $generatorInfo->options array.
	 * @param  key The key to add to the array.
	 * @param  value The value to add to the array.
	 */
	public function addOption($key, $value) {
		$this->generatorInfo->options[$key]=$value;
	}
	
	/**
	 * Generates the  source code containing the class repesenting the DB Table specified by $tableName.
	 * @return Returns the source code generated in the programming language specified by $language.
	 */
	public function getCode(){
		$this->loadFieldDefinitions();			
		$codeCreator = GeneratorFactory::getCodeGenerator($this->language);
		return $codeCreator->generateCode($this->generatorInfo);
    }

    // ************************************* Getters ********************************************.
    
    
    /**
     * Getter for the $language member.
     * @return Returns the value of the $language member
     */
    function getLanguage() {
    	return $this->language;
    }
    
	/**
	 * Getter for the $databaseType member.
	 * @return Returns the value of the $databaseType member
	 */
	function getDatabaseType() {
		return $this->databaseType;
	}	
	
	/**
	 * Getter for the $serverName member.
	 * @return Returns the value of the $serverName member
	 */
	function getServerName() {
		return $this->serverName;
	}	
	
	/**
	 * Getter for the $databaseName member.
	 * @return Returns the value of the $databaseName member
	 */
	function getDatabaseName() {
		return $this->databaseName;
	}	
	
	/**
	 * Getter for the $tableName member.
	 * @return Returns the value of the $tableName member
	 */
	function getTableName() {
		return $this->tableName;
	}	
	
	/**
	 * Getter for the $userName member.
	 * @return Returns the value of the $userName member
	 */
	function getUserName() {
		return $this->userName;
	}	
	
	/**
	 * Getter for the $password member.
	 * @return Returns the value of the $password member
	 */
	function getPassword() {
		return $this->password;
	}
	
	// ************************************* Setters ********************************************.
	
	/**
	 * Setter for the $language member.
	 * @param $value  The value to set the $language to.
	 */
	function setLanguage($value) {
		$this->language = $value;
	}
	
	/**
	 * Setter for the $databaseType member.
	 * @param $value  The value to set the $databaseType to.
	 */
	function setDatabaseType($value) {
		$this->databaseType = $value;
		$this->generatorInfo->databaseType = $value;
	}
	
	/**
	 * Setter for the $serverName member.
	 * @param $value  The value to set the $serverName to.
	 */
	function setServerName($value) {
		$this->serverName = $value;
		$this->generatorInfo->serverName = $value;
	}
	
	/**
	 * Setter for the $databaseName member.
	 * @param $value  The value to set the $databaseName to.
	 */
	function setDatabaseName($value) {
		$this->databaseName = $value;
		$this->generatorInfo->databaseName = $value;
	}
		
	/**
	 * Setter for the $tableName member.
	 * @param $value  The value to set the $tableName to.
	 */
	function setTableName($value) {
		$this->tableName = $value;
		$this->generatorInfo->tableName = $value;
	}
	
	/**
	 * Setter for the $userName member.
	 * @param $value  The value to set the $userName to.
	 */
	function setUserName($value) {
		$this->userName = $value;
	}
	
	/**
	 * Setter for the $password member.
	 * @param $value  The value to set the $password to.
	 */
	function setPassword($value) {
		$this->password = $value;
	}
}


?>