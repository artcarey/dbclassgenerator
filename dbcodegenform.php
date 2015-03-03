<html>
<body>
<div class="data_input">
    <form action="http://localhost/dbcodegen/main.php" method="post">
    	Host: <input type="text" name="servername" value="The Serve Name" size="50"/><br>
    	User Name: <input type="text" name="username" value="The Database User Name" size="50"/><br>
    	Password: <input type="password" name="password" value="The Database Password" size="50"/><br>
    	Database Name:<input type="text" name="dbname" value="The Database Name" size="50"/><br>
    	Table Name<input type="text" name="tablename" value="The Table Name" size="50"/><br>
    	Javadoc<input type="radio" name="javadoc" value="yes"/>Yes.<input type="radio" name="javadoc" value="no"/>No.<br>
    	Language<input type="radio" name="language" value="php"/>PHP.<input type="radio" name="language" value="java"/>Java.<br>    	
    	
    	<input type="submit"/>
    </form>
</div>

</body>
</html>
