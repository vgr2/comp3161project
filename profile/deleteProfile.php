<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php
	// Retreiving Form Elements from Form
	$thisUserId = addslashes($_REQUEST['thisUserIdField']);
	$thisProfileId = addslashes($_REQUEST['thisProfileIdField']);
	$thisStatus = addslashes($_REQUEST['thisStatusField']);
	$thisFname = addslashes($_REQUEST['thisFnameField']);
	$thisLname = addslashes($_REQUEST['thisLnameField']);
	$thisEmail = addslashes($_REQUEST['thisEmailField']);
	$thisDob = addslashes($_REQUEST['thisDobField']);
	$thisProfile_pic = addslashes($_REQUEST['thisProfile_picField']);

?>
<?php 
$sql = "DELETE FROM profile WHERE userId = '$thisUserId'";
$result = MYSQL_QUERY($sql);

?>
Record  has been deleted from database. Here is the deleted record :-<br><br>

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

<?php
include_once("../common/footer.php");
?>