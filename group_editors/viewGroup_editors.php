<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
$thisG_id = $_REQUEST['g_idField']
?>
<?php
$sql = "SELECT   * FROM group_editors WHERE g_id = '$thisG_id'";
$result = MYSQL_QUERY($sql);
$numberOfRows = MYSQL_NUMROWS($result);
if ($numberOfRows==0) {  
?>

Sorry. No records found !!

<?php
}
else if ($numberOfRows>0) {

	$i=0;
	$thisG_id = MYSQL_RESULT($result,$i,"g_id");
	$thisUser_added = MYSQL_RESULT($result,$i,"user_added");
	$thisDate_added = MYSQL_RESULT($result,$i,"date_added");

}
?>

View Record<br><br>

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