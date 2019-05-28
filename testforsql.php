<?php
$servername = "localhost";
$username = "root";
$password = "i-0842ffbbe1c95b180";
$db_selection = "suspo";
$con = mysqli_connect($servername ,$username ,$password ,$db_selection);

if(!$con)
	echo('Nope');
else
	echo('Yes');

$action = "SELECT Name FROM `Blockchain_course`";
$result = mysqli_query($con,$action);
$ans = mysqli_fetch_array($result);
printf("%s\n", $ans["Name"]);
$ans = mysqli_fetch_assoc($result);
printf("%s\n", $ans["Name"]);
?>
<form action='form1.php' method='post' >
	<input type="submit" value='logo'/>
</form>
<input type="button" onclick="javascript:location.herf='http://www.suspo.online/form1.php'" value="fuck"></input>
