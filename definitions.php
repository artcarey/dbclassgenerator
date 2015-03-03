<?php
	// General
	/** The default indent.*/
	const DEFAULT_INDENT = "    ";

	
	// Language constants.		
	
	/** Language constant for PHP.*/
	const OUTPUT_PHP = 1;
	
	/** Language constant for Java.*/
	const OUTPUT_JAVA = 2;
	
	
	// Database constants.
	
	/** Database constant for MySQL.*/
	const DB_MYSQL = 1;
	
	/** Database constant for Postgress.*/
	const DB_POSTGRESS = 2;
	
	/** Database constant for MSSQL Server.*/
	const DB_MSSQL = 3;
	
	/** Database constant for Oracle.*/
	const DB_ORACLE = 4;	
	
	/** Database constant for DB2.*/
	const DB_DB2 = 5;
	
	
	// Class member data type constants.
	
	/** Integer data type constant. */
	const DT_INTEGER = 1;
	
	/** Float data type constant. */
	const DT_FLOAT = 2;
	
	/** String data type constan. */
	const DT_STRING = 3;
	
	/** Date data type constant. */
	const DT_DATE = 4;
	
	/** DateTime data type constant. */
	const DT_DATETIME = 5;
	
	/** Time data type constant. */
	const DT_TIME = 6;
	
	/** Boolean data type constant. */
	const DT_BOOL = 7;
	
	/** Byte data type constant. */
	const DT_BYTE = 8;
	
	
	/**
	 *  The IDBTableCodeGenerator interface. This interface contains one function getCode($info)
	 *  objects implementing this interface return a string with the generated source code based on
	 *  information passed into the $info parameter.
	 */
	interface IDBTableCodeGenerator {
	
		/**
		 * Interface declaration.
		 * @param $info An array of DBClassGeneratorInfo objects.
		 * This parameter will store information needed by the objects
		 * implementing this interface.		 
		 */
		public function generateCode($info);
	}
	
	/**
	 * Class to hold datasource field information.
	 */
	class MemberInformation {
		/** The name for the class member.*/
		public $memberName = "";
	
		/** The data type for the class member.*/
		public $memberType = "";
		
		/** The data type returned from the RDBMS. */
		public $databaseDataType;
	}
	
	/**
	 * Class to hold field data and other information.
	 */
	class DBClassGeneratorInfo {
		/** Database type.*/
		public $databaseType = DB_MYSQL;
		
		/** Database name.*/
		public $databaseName = "";
	
		/** Server name. */
		public $serverName = "";
	
		/** Table name. */
		public $tableName = "";
		
		/** Array of MemberInformation objects.
		 * Holds the field definition information for objects implementing IBTableClassCreator.
		 */
		public $fieldData;
		
		/**
		 *  Array of key/value pair options used by the object implementing the IDBTableCodeGenerator interface.
		 *  The keys, and values in this array (if any at all) are specific to each diffent object
		 *  implementing IDBTableCodeGenerator.  
		 */
		public $options;
	}
?>