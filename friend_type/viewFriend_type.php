<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
$thisFriend_typeId = $_REQUEST['friend_typeIdField']
?>
<?php
$sql = "SELECT   * FROM friend_type WHERE friend_typeId = '$thisFriend_typeId'";
$result = MYSQL_QUERY($sql);
$numberOfRows = MYSQL_NUMROWS($result);
if ($numberOfRows==0) {  
?>

Sorry. No records found !!

<?php
}
else if ($numberOfRows>0) {

	$i=0;
	$thisFriend_typeId = MYSQL_RESULT($result,$i,"friend_typeId");
	$thisType = MYSQL_RESULT($result,$i,"type");

}
?>

View Record<br><br>

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