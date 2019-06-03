<?php

?>
<?php
$name = $_POST[name];
$servername = "localhost";
$username = "root";
$password = "i-0842ffbbe1c95b180";
$db_select = "suspo";
$connect = mysqli_connect($servername ,$username ,$password ,$db_select);
echo($name);
echo("<br>");
?>
<?php
$action = "SELECT * FROM `Pass_List` WHERE `studentName` LIKE '徐子修'";
$result = mysqli_query($connect ,$action);
$cert_list = array(
        "金融科技-文字探勘與機器學習 (Fin 7067)"=> "Fintech7067",
        "資料科學程式設計 (CSX 4001)"=> "CSXprogramming4001",
        "進階軟體開發專題 (CSX 5001)" => "BlockChainCsx"
);

/*$ans = mysqli_fetch_assoc($result);
echo($ans['className']);
echo($ans['studentName']);
echo("<br>");*/
while($ans = mysqli_fetch_assoc($result))
{
	echo($ans['className']);
	echo($ans['ipfsIndex']);
	echo("<br>");
	echo "<object data='https://ipfs.io/ipfs/";
	echo($ans['ipfsIndex']);
	echo "' type = 'application/pdf' width='750px' height='750px>
		<embed src='https://ipfs.io/ipfs/";
	echo($ans['ipfsIndex']);
	echo("' type='application/pdf'></embed></object>");
	echo("<br>");
}
/*
$personal = array();
for($i = 0; $i < sizeof($cert_list); $i++)
{
	$action = "SELECT * FROM `$cert[$i]` WHERE `Name` LIKE '李濬志'";
	$result = mysqli_query($connect, $action);
	$ans = mysqli_fetch_assoc($result);
	if($ans)
		echo"Yes");
	unset($ans);
}*/
?>
