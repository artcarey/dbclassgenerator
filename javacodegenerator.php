<?php
require_once 'codegenerators.php';

/**
 * Extends the StandardCommentsCodeGenerator and implements the IDBTableCodeGenerator interface.
 * This object creates a Java language class representing table and field information passed in to the
 * generateCode method.
 */
class JavaCodeGenerator extends StandardCommentsCodeGenerator implements IDBTableCodeGenerator {

	/**
	 * Implementation of the IDBTableCodeGenerator generateCode() method.  Creates a Java class
	 * based on the information passed to it's parameters.  This method will create a private member with
	 * getter and setter methods for each item in the $fieldDefs array. It will optionally add javadoc information for the
	 * generated class and the data source used to create it.
	 *
	 * @param DataSourceInformation $dbInfo A DBClassGeneratorInfo object containing basic information regarding the
	 * data source used to generate the Java class.
	 *
	 * @param info A DBClassGeneratorInfo object containing basic information regarding the
	 * data source, table, and fields used to generate the Java class.
	 *
	 * @return Returns the generated Java class.
	 */
	public function generateCode($info) {
		return "Java implementation comming soon!!";
	}

}
?>