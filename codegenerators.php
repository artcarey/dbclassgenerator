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
		/**Holds the code indent.*/
		protected $codeIndent = "    ";

		/**
		 * Getter for the $codeIndent member.
		 * @return The $codeIndent string.
		 */
		public function getCodeIndent(){
			return $this->codeIndent;
		}
		
		/**
		 * Setter for the $codeIndent member.
		 * @param unknown $value  The value that the $codeIndent will be set to.
		 */
		public function setCodeIndent($value) {
			$this->codeIndent;
		}
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
	
				$this->code .= $this->codeIndent."\n";
				$this->code .= $this->codeIndent."/*\n";
	
				foreach ($comments as $line) {
					$this->code .= $this->codeIndent.$line."\n";
				}
	
				$this->code .= $this->codeIndent."*/\n";
				$this->code .= $this->codeIndent."\n";
			} else {
				$this->code .= $this->codeIndent."\n";
				$this->code .= $this->codeIndent."//".$comment."\n";
				$this->code .= $this->codeIndent."\n";
			}
		}
		
		/**
		 * Appends a javadoc entry to the generated code.  
		 * @param String $javadoc The javadoc entry to be appended. 
		 * If the parameter contains the \n escape character, a multi line javadoc
		 * entry will be appended with \n as the terminator for each line.  If the parmeter does
		 * not contain the \n character a single line javadoc entry will be appended. 
		 */
		protected function addJavadoc($entry, $indent=NIL) {
			if ($indent == NIL) {
				$theIndent = $this->codeIndent;
			} else {
				$theIndent = $indent;
			}
			
			if (!$this->javadoc) return;
	
			$lines = explode("\n", $entry);
	
			if (count($lines) > 1) {
				$this->code .= $theIndent."\n";
				$this->code .= $theIndent."/**\n";
	
				foreach ($lines as $line) {
					$this->code .= $theIndent."* ".$line."\n";
				}
	
				$this->code .= $theIndent."*/\n";
			} else {
				$this->code .= $theIndent."/** ".$entry." */\n";
			}
		}
	}
?>