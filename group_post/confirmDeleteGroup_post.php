<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
$thisG_id = $_REQUEST['g_idField']
?>
<?php
$sql = "SELECT   * FROM group_post WHERE g_id = '$thisG_id'";
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
	$thisUserId = MYSQL_RESULT($result,$i,"userId");
	$thisGpostId = MYSQL_RESULT($result,$i,"gpostId");
	$thisTitle = MYSQL_RESULT($result,$i,"title");
	$thisG_post_type = MYSQL_RESULT($result,$i,"g_post_type");
	$thisG_image_path = MYSQL_RESULT($result,$i,"g_image_path");
	$thisText_body = MYSQL_RESULT($result,$i,"text_body");
	$thisDate_created = MYSQL_RESULT($result,$i,"date_created");

}
?>

<h2>Confirm Record Deletion</h2><br><br>

<table>
<tr height="30">
	<td align="right"><b>G_id : </b></td>
	<td><?php echo $thisG_id; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>UserId : </b></td>
	<td><?php echo $thisUserId; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>GpostId : </b></td>
	<td><?php echo $thisGpostId; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Title : </b></td>
	<td><?php echo $thisTitle; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>G_post_type : </b></td>
	<td><?php echo $thisG_post_type; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>G_image_path : </b></td>
	<td><?php echo $thisG_image_path; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Text_body : </b></td>
	<td><?php echo $thisText_body; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Date_created : </b></td>
	<td><?php echo $thisDate_created; ?></td>
</tr>
</table>

<h3>If you are sure you want to delete the above record, please press the delete button below.</h3><br><br>
<form name="group_postEnterForm" method="POST" action="deleteGroup_post.php">
<input type="hidden" name="thisG_idField" value="<?php echo $thisG_id; ?>">
<input type="submit" name="submitConfirmDeleteGroup_postForm" value="Delete  from Group_post">
<input type="button" name="cancel" value="Go Back" onClick="javascript:history.back();">
</form>

<?php
include_once("../common/footer.php");
?>