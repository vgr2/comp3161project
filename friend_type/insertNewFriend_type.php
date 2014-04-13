<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
	// Retreiving Form Elements from Form
	$thisFriend_typeId = addslashes($_REQUEST['thisFriend_typeIdField']);
	$thisType = addslashes($_REQUEST['thisTypeField']);

?>
<?php 
$sqlQuery = "INSERT INTO friend_type (friend_typeId , type ) VALUES ('$thisFriend_typeId' , '$thisType' )";
$result = MYSQL_QUERY($sqlQuery);

?>
A new record has been inserted in the database. Here is the information that has been inserted :- <br><br>

<table>
<tr height="30">
	<td align="right"><b>Friend_typeId : </b></td>
	<td><?php echo $thisFriend_typeId; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Type : </b></td>
	<td><?php echo $thisType; ?></td>
</tr>
</table>

<?php
include_once("../common/footer.php");
?>