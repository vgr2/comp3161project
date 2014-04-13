<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
	// Retreiving Form Elements from Form
	$thisG_id = addslashes($_REQUEST['thisG_idField']);
	$thisUser_added = addslashes($_REQUEST['thisUser_addedField']);
	$thisDate_added = addslashes($_REQUEST['thisDate_addedField']);

?>
<?php 
$sqlQuery = "INSERT INTO group_editors (g_id , user_added , date_added ) VALUES ('$thisG_id' , '$thisUser_added' , '$thisDate_added' )";
$result = MYSQL_QUERY($sqlQuery);

?>
A new record has been inserted in the database. Here is the information that has been inserted :- <br><br>

<table>
<tr height="30">
	<td align="right"><b>G_id : </b></td>
	<td><?php echo $thisG_id; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>User_added : </b></td>
	<td><?php echo $thisUser_added; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Date_added : </b></td>
	<td><?php echo $thisDate_added; ?></td>
</tr>
</table>

<?php
include_once("../common/footer.php");
?>