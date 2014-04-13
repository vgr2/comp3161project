<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
$thisUserId = $_REQUEST['userIdField']
?>
<?php
$sql = "SELECT   * FROM profile WHERE userId = '$thisUserId'";
$result = MYSQL_QUERY($sql);
$numberOfRows = MYSQL_NUMROWS($result);
if ($numberOfRows==0) {  
?>

Sorry. No records found !!

<?php
}
else if ($numberOfRows>0) {

	$i=0;
	$thisUserId = MYSQL_RESULT($result,$i,"userId");
	$thisProfileId = MYSQL_RESULT($result,$i,"profileId");
	$thisStatus = MYSQL_RESULT($result,$i,"status");
	$thisFname = MYSQL_RESULT($result,$i,"fname");
	$thisLname = MYSQL_RESULT($result,$i,"lname");
	$thisEmail = MYSQL_RESULT($result,$i,"email");
	$thisDob = MYSQL_RESULT($result,$i,"dob");
	$thisProfile_pic = MYSQL_RESULT($result,$i,"profile_pic");

}
?>

<h2>Confirm Record Deletion</h2><br><br>

<table>
<tr height="30">
	<td align="right"><b>UserId : </b></td>
	<td><?php echo $thisUserId; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>ProfileId : </b></td>
	<td><?php echo $thisProfileId; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Status : </b></td>
	<td><?php echo $thisStatus; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Fname : </b></td>
	<td><?php echo $thisFname; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Lname : </b></td>
	<td><?php echo $thisLname; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Email : </b></td>
	<td><?php echo $thisEmail; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Dob : </b></td>
	<td><?php echo $thisDob; ?></td>
</tr>
<tr height="30">
	<td align="right"><b>Profile_pic : </b></td>
	<td><?php echo $thisProfile_pic; ?></td>
</tr>
</table>

<h3>If you are sure you want to delete the above record, please press the delete button below.</h3><br><br>
<form name="profileEnterForm" method="POST" action="deleteProfile.php">
<input type="hidden" name="thisUserIdField" value="<?php echo $thisUserId; ?>">
<input type="submit" name="submitConfirmDeleteProfileForm" value="Delete  from Profile">
<input type="button" name="cancel" value="Go Back" onClick="javascript:history.back();">
</form>

<?php
include_once("../common/footer.php");
?>