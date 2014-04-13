<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php 
$thisFriendIdFromForm = $_REQUEST['thisFriendIdField'];
$thisAction = $_REQUEST['action'];
if ($thisAction=="Update")
{
	// Retreiving Form Elements from Form
	$thisFriendId = addslashes($_REQUEST['thisFriendIdField']);
	$thisFriends_owner = addslashes($_REQUEST['thisFriends_ownerField']);
	$thisFriend = addslashes($_REQUEST['thisFriendField']);

	$sqlUpdate = "UPDATE friends_of SET friendId = '$thisFriendId' , friends_owner = '$thisFriends_owner' , friend = '$thisFriend'  WHERE friendId = '$thisFriendId'";
	$resultUpdate = MYSQL_QUERY($sqlUpdate);
	echo "<b>Record with Id ".$thisFriendIdFromForm." has been Updated<br></b>";
	$thisFriendIdFromForm = "";
}

if ($thisAction=="Insert")
{
	// Retreiving Form Elements from Form
	$thisFriendId = addslashes($_REQUEST['thisFriendIdField']);
	$thisFriends_owner = addslashes($_REQUEST['thisFriends_ownerField']);
	$thisFriend = addslashes($_REQUEST['thisFriendField']);

	$sqlInsert = "INSERT INTO friends_of (friendId , friends_owner , friend ) VALUES ('$thisFriendId' , '$thisFriends_owner' , '$thisFriend' )";
	$resultInsert = MYSQL_QUERY($sqlInsert);
	echo "<b>Record has been inserted in Database<br></b>";
	$thisFriendIdFromForm = "";
}

if ($thisAction=="Delete")
{
	// Retreiving Form Elements from Form
	$thisFriendId = addslashes($_REQUEST['thisFriendIdField']);
	$thisFriends_owner = addslashes($_REQUEST['thisFriends_ownerField']);
	$thisFriend = addslashes($_REQUEST['thisFriendField']);

	$sqlDelete = "DELETE FROM friends_of WHERE friendId = '$thisFriendId'";
	$resultDelete = MYSQL_QUERY($sqlDelete);

	echo "<b>Record with Id ".$thisFriendIdFromForm." has been Deleted<br></b>";
	$thisFriendIdFromForm = "";
}

$initStartLimit = 0;
$limitPerPage = 10;

$startLimit = $_REQUEST['startLimit'];
$numberOfRows = $_REQUEST['rows'];
$sortBy = $_REQUEST['sortBy'];
$sortOrder = $_REQUEST['sortOrder'];

if ($startLimit=="")
{
		$startLimit = $initStartLimit;
}

if ($numberOfRows=="")
{
		$numberOfRows = $limitPerPage;
}

if ($sortOrder=="")
{
		$sortOrder  = "DESC";
}
if ($sortOrder == "DESC") { $newSortOrder = "ASC"; } else  { $newSortOrder = "DESC"; }
$limitQuery = " LIMIT ".$startLimit.",".$numberOfRows;
$nextStartLimit = $startLimit + $limitPerPage;
$previousStartLimit = $startLimit - $limitPerPage;

if ($sortBy!="")
{
		$orderByQuery = " ORDER BY ".$sortBy." ".$sortOrder;
}


$sql = "SELECT   * FROM friends_of".$orderByQuery.$limitQuery;
$result = MYSQL_QUERY($sql);
$numberOfRows = MYSQL_NUM_ROWS($result);


?>
<?php 
if ($numberOfRows==0) {  
?>

Sorry. No records found !!

<?php 
}
else if ($numberOfRows>0) {

	$i=0;
?>


<br>
<?php 
if ($_REQUEST['startLimit'] != "")
{
?>

<a href="<?php echo  $_SERVER['PHP_SELF']; ?>?startLimit=<?php echo $previousStartLimit; ?>&limitPerPage=<?php echo $limitPerPage; ?>&sortBy=<?php echo $sortBy; ?>&sortOrder=<?php echo $sortOrder; ?>">Previous <?php echo $limitPerPage; ?> Results</a>....
<?php } ?>
<?php 
if ($numberOfRows == $limitPerPage)
{
?>
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?startLimit=<?php echo $nextStartLimit; ?>&limitPerPage=<?php echo $limitPerPage; ?>&sortBy=<?php echo $sortBy; ?>&sortOrder=<?php echo $sortOrder; ?>">Next <?php echo $limitPerPage; ?> Results</a>
<?php } ?>

<br><br>
<TABLE CELLSPACING="0" CELLPADDING="3" BORDER="0" WIDTH="100%">
	<TR>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=friendId&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>FriendId</B>
			</a>
</TD>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=friends_owner&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>Friends_owner</B>
			</a>
</TD>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=friend&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>Friend</B>
			</a>
</TD>
	</TR>
<?php 
if ($thisAction=="EnterNew")
{
?>
<FORM NAME="insertForm" METHOD="POST" ACTION="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="action" value="Insert">
<input type="hidden" name="thisFriendIdField" value="<?php echo $thisFriendId; ?>">
	<TR BGCOLOR="#FF6666">
		<TD><input type"text" name="thisFriendIdField" value=""></TD>
		<TD><input type"text" name="thisFriends_ownerField" value=""></TD>
		<TD><input type"text" name="thisFriendField" value=""></TD>
	<TD COLSPAN=2><input type="submit" name="Insert" Value="Insert Record"> </TD>
	</TR>
</FORM>

<?php 
 } 
?>
<?php 
	while ($i<$numberOfRows)
	{

		if (($i%2)==0) { $bgColor = "#FFFFFF"; } else { $bgColor = "#C0C0C0"; }

	$thisFriendId = MYSQL_RESULT($result,$i,"friendId");
	$thisFriends_owner = MYSQL_RESULT($result,$i,"friends_owner");
	$thisFriend = MYSQL_RESULT($result,$i,"friend");
if ($thisFriendIdFromForm == $thisFriendId)
{

?>
<FORM NAME="editForm" METHOD="POST" ACTION="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="action" value="Update">
<input type="hidden" name="thisFriendIdField" value="<?php echo $thisFriendId; ?>">
	<TR BGCOLOR="<?php echo $bgColor; ?>">
		<TD><input type"text" name="thisFriendIdField" value="<?php echo $thisFriendId; ?>"></TD>
		<TD><input type"text" name="thisFriends_ownerField" value="<?php echo $thisFriends_owner; ?>"></TD>
		<TD><input type"text" name="thisFriendField" value="<?php echo $thisFriend; ?>"></TD>
	<TD COLSPAN=2><input type="button" name="Save" Value="Save" onClick="this.form.submit();"> </TD>
	</TR>
</FORM>

<?php 
} else { 
?>
	<TR BGCOLOR="<?php echo $bgColor; ?>">
		<TD><?php echo $thisFriendId; ?></TD>
		<TD><?php echo $thisFriends_owner; ?></TD>
		<TD><?php echo $thisFriend; ?></TD>
	<TD><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=Edit&thisFriendIdField=<?php echo $thisFriendId; ?>">Edit</a></TD>
	<TD><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=Delete&thisFriendIdField=<?php echo $thisFriendId; ?>">Delete</a></TD>
	</TR>

<?php 
}
?>
<?php 
		$i++;

	} // end while loop
?>
</TABLE>
<FORM NAME="insertForm" METHOD="POST" ACTION="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="action" value="EnterNew">
<input type="Submit" name="submit" value="Insert New Record">
</FORM>


<br>
<?php 
if ($_REQUEST['startLimit'] != "")
{
?>

<a href="<?php echo  $_SERVER['PHP_SELF']; ?>?startLimit=<?php echo $previousStartLimit; ?>&limitPerPage=<?php echo $limitPerPage; ?>&sortBy=<?php echo $sortBy; ?>&sortOrder=<?php echo $sortOrder; ?>">Previous <?php echo $limitPerPage; ?> Results</a>....
<?php } ?>
<?php 
if ($numberOfRows == $limitPerPage)
{
?>
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?startLimit=<?php echo $nextStartLimit; ?>&limitPerPage=<?php echo $limitPerPage; ?>&sortBy=<?php echo $sortBy; ?>&sortOrder=<?php echo $sortOrder; ?>">Next <?php echo $limitPerPage; ?> Results</a>
<?php } ?>

<br><br>
<?php 
} // end of if numberOfRows > 0 
 ?>

<?php
include_once("../common/footer.php");
?>