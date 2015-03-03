<?php
require_once 'codegenerators.php';
require_once 'definitions.php';

/**
 * Extends the StandardCommentsCodeGenerator and implements the IDBTableCodeGenerator interface.
 * This object creates a PHP language class representing table and field information passed in to the
 * generateCode method.
 */
class PHPCodeGenerator extends StandardCommentsCodeGenerator implements IDBTableCodeGenerator {

	/**
	 * Implementation of the IDBTableCodeGenerator generateCode() method.  Creates a PHP class
	 * based on the information passed to it's parameters.  This method will create a PHP class with a private member,
	 * getter, and setter methods for each item in the $dbInfo array. It will optionally add javadoc information for the
	 * generated class and the data source used to create it.
	 *
	 * @param info A DBClassGeneratorInfo object containing basic information regarding the
	 * data source, table, and fields used to generate the PHP class.
	 *
	 * @return Returns the generated PHP class.
	 */
	public function generateCode($info) {
		$this->javadoc = ($info->options["javadoc"] == "yes");

		if (array_key_exists ("indent", $info->options)) {
			$this->codeIndent = $info->options["indent"];
		} else {
			$this->codeIndent = DEFAULT_INDENT;	
		}
		
		// header.
		$this->code .= "<?php \n";
			
		$jd = "PHP Class for ".$info->databaseType." table ".$info->tableName."\nDatabase - ".$info->databaseName."\nServer Name - ".$info->serverName;
		$this->addJavadoc($jd, "");
		$this->code .="class ".$info->tableName."_Record {\n";

		// private members.
		foreach ($info->fieldData as $fld) {
			$jd = "Member for DB field ".$fld->memberName." ".$info->type." Type: ".$fld->databaseDataType.".";
			$this->addJavadoc($jd);
			$this->code .= DEFAULT_INDENT."private $".strtolower($fld->memberName.";\n");
			if($this->javadoc) {
				$this->code.="\n";
			}
		}
		$this->code .= "    \n";

		// getters.
		$this->addComment("Getters.");

		foreach ($info->fieldData as $fld) {
			$jd = "Getter for the \$".strtolower($fld->memberName)." member.\n@return Returns the value of the \$".strtolower($fld->memberName)." member";
			$this->addJavadoc("Getter for the \$".strtolower($fld->memberName)." member.\n@return Returns the value of the \$".strtolower($fld->memberName)." member.");

			$this->code .= DEFAULT_INDENT."function get".ucfirst(strtolower($fld->memberName)."() {\n".DEFAULT_INDENT.DEFAULT_INDENT."return \$this->".strtolower($fld->memberName).";\n".DEFAULT_INDENT."}\n\n");
		}

		$this->code .= "    \n";

		//setters.
		$this->addComment("Setters.");

		foreach ($info->fieldData as $fld) {
			$jd = "Setter for the \$".strtolower($fld->memberName)." member.\n@param \$value The value that the \$".strtolower($fld->memberName)." member will be set  to.";
			$this->addJavadoc($jd);

			$this->code .= DEFAULT_INDENT."function set".ucfirst(strtolower($fld->memberName)."(\$value) {\n".DEFAULT_INDENT.DEFAULT_INDENT."\$this->".strtolower($fld->memberName)." = \$value;\n".DEFAULT_INDENT."}\n\n");
		}

		// footer.
		$this->code .="}\n";
		$this->code .= "?>";
		return $this->code;
	}
}
?>