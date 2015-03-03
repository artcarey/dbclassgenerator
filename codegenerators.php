<?php
	require_once 'definitions.php';
	
	/**
	 * Invalid option interface implentation. Implements the IDBTableCodeGenerator interface
	 * This interface is returned by the creator factory when an invalid option is passed
	 * for the requested language. It returns an error messge.
	 */
	class InvalidOptionsGenerator implements IDBTableCodeGenerator {
		function generateCode($info) {
			Return "Invalid language option passed to code generator.";
		}
	}

	/**
	 * Class that contains a $codeIndent member with the default value of the DEFAULT_INDENT contstant.
	 */
	class IndentedableCodeGenerator {
		protected $codeIndent = DEFAULT_INDENT;		
	}
	
	/**
	 * Base class for objects that generate code for languages which 
	 * support the standard comment characters.
	 * It contains a string to hold generated code, and a flag to control
	 * whether or not to output javadoc comments.
	 */
	class StandardCommentsCodeGenerator extends IndentedableCodeGenerator{
		/** Flag to toggle javadoc on or off. Default is TRUE*/
		protected $javadoc = TRUE;
		
		/** String to hold generated code. */
		protected $code = "";
		
		
		/**
		 * Appends a comment to the generated code.  
		 * @param String $comment The comment to be appended.  If the parameter contains the \n escape character, a multi line
		 * comment will be appended with \n as the terminator for each line.  If the parmeter does
		 * not contain the \n character a single line comment will be appended. 
		 */
		protected function addComment($comment) {
			$comments = explode("\n", $comment);
	
			if (count($comments) > 1) {
	
				$this->code .= DEFAULT_INDENT."\n";
				$this->code .= DEFAULT_INDENT."/*\n";
	
				foreach ($comments as $line) {
					$this->code .= DEFAULT_INDENT.$line."\n";
				}
	
				$this->code .= DEFAULT_INDENT."*/\n";
				$this->code .= DEFAULT_INDENT."\n";
			} else {
				$this->code .= DEFAULT_INDENT."\n";
				$this->code .= DEFAULT_INDENT."//".$comment."\n";
				$this->code .= DEFAULT_INDENT."\n";
			}
		}
		
		/**
		 * Appends a javadoc entry to the generated code.  
		 * @param String $javadoc The javadoc entry to be appended. 
		 * If the parameter contains the \n escape character, a multi line javadoc
		 * entry will be appended with \n as the terminator for each line.  If the parmeter does
		 * not contain the \n character a single line javadoc entry will be appended. 
		 */
		protected function addJavadoc($entry, $indent="    ") {
			if (!$this->javadoc) return;
	
			$lines = explode("\n", $entry);
	
			if (count($lines) > 1) {
				$this->code .= $indent."\n";
				$this->code .= $indent."/**\n";
	
				foreach ($lines as $line) {
					$this->code .= $indent."* ".$line."\n";
				}
	
				$this->code .= $indent."*/\n";
			} else {
				$this->code .= $indent."/** ".$entry." */\n";
			}
		}
	}
?>