<?php 
	require_once 'dbclassgenerator.php';

	/**
	 * 
	 * @author artcarey
	 *
	 */
    class MYSQLClassGenerator extends DBClassGenerator{
		/** The MYSQLI interface object.*/
    	private  $mysqli;

    	/**
    	 * Converts MYSQLI field datatype value to a MemberInformation.memberType value.
    	 * 
    	 * @param unknown $typeId  The field datatype returned by a call to the Mysqli->fetch_fields() function.
    	 */
    	private function convertDatatype($typeId) {
    		switch ($typeId){
    			case 1:
  					return DT_BOOL;
    			break;
    					
    			case 2:
    			case 3:
    			case 9:
    				return DT_INTEGER;
    			break;
    			
    			case 4:
    			case 5:
    			case 8:
    			case 246:
    				return DT_FLOAT;
				break;
				
    			case 10:
    			case 13:
    				return DT_DATE;
    			break;
    			
    			case 7:
    			case 11:
    				return DT_TIME;
    			break;
    			
    			case 11:
    				return DT_TIME;
    			break;
    			
    			default:
    				return DT_STRING;
    			break;
    		}
    	} 
    	
    	/** 
    	 * From the PHP manual http://php.net/manual/en/mysqli-result.fetch-field-direct.php.
    	 * Posted by: andre at koethur dot de
    	 * 
    	 * Gets the text value for a MYSQLI field datatype. 
    	 * 
    	 * @param unknown $type_id The field datatype returned by a call to the Mysqli->fetch_fields() function.
    	 * 
    	 */
		private function h_type2txt($type_id)
		{
			static $types;
		
			if (!isset($types))
			{
				$types = array();
				$constants = get_defined_constants(true);
				
				foreach ($constants['mysqli'] as $constant => $n) 
					if (preg_match('/^MYSQLI_TYPE_(.*)/', $constant, $m)) $types[$n] = $m[1];
			}
		
			return array_key_exists($type_id, $types)? $types[$type_id] : NULL;
		}
		
		/**
		 * Override of the abstract function DBClassGenerator->loadFieldDefinitions.
		 * Classes overriding this funcion fill the fieldData array with MemberInformation objects.
		 * 
		 * @see DBClassGenerator::loadFieldDefinitions()
		 */
		protected function loadFieldDefinitions(){
			$this->generatorInfo->databaseName = "Foodwiz1";
			$this->generatorInfo->databaseType = "MYSQL";
	   		$this->mysqli = new mysqli($this->serverName, $this->userName, $this->password, $this->databaseName);
	   	
	   		if ($mysqli->connect_errno) {
	   			die("Connect failed: ".$mysqli->connect_error);
	   		}

	   		$sql = 'SELECT * FROM '.$this->tableName.' LIMIT 1';
	   		if ($result = $this->mysqli->query($sql)) {
	   			$fieldArray = $result->fetch_fields();
	   			
	   			foreach ($fieldArray as $value) {
	   				$memberInfo = new MemberInformation();
	   				
	   				$memberInfo->memberName = $value->name;
	   				$memberInfo->databaseDataType = $this->h_type2txt($value->type);
	   				$memberInfo->memberType = $this->convertDatatype($value->type);
	   				
	   				$this->generatorInfo->fieldData[] = $memberInfo;
	   			}
	   		} else {
	   			die("Error getting field definitions.  Check your database name or table name");
	   		}
		}
	}
	
?>
