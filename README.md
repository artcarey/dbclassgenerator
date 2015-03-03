# dbclassgenerator

Usage:

1) Create an instance of the MYSQLClassGenerator object.
2) Set the Server Name, User Name, DB Name, Password, and Table Name.
3) Set the desired language output.
4) Call getCode().

See main.php

A very basic user interface is included as an example - dbcodegenform.php


Extending:

To add support for a DB other than MYSQL:

1)Create a class that extends the DBClassGenerator object.
2)Override the abstract function loadFieldDefinitions().
3)Follow the instructions under Usage: above using your new class.

See dbclassgenerator.php, mysqlclassgenerator.php, main.php


To add support for a different language.

1) Create an object that Implements the IDBTableCodeGenerator interface.
2) Implement the generateCode function. 
3) Add a language constant for the language you wish to support.
4) Modify generatorfactory.php so that it returns the object created in step 1
5) Follow the instructions under Usage: User the language constant created in step 3

See definitions.php, generatorfactory.php, codegenerators.php, phpcodegenerator.php, main.php
