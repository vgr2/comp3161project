<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php 
$thisUserIdFromForm = $_REQUEST['thisUserIdField'];
$thisAction = $_REQUEST['action'];
if ($thisAction=="Update")
{
	// Retreiving Form Elements from Form
	$thisUserId = addslashes($_REQUEST['thisUserIdField']);
	$thisUsername = addslashes($_REQUEST['thisUsernameField']);
	$thisPassword = addslashes($_REQUEST['thisPasswordField']);

	$sqlUpdate = "UPDATE user SET userId = '$thisUserId' , username = '$thisUsername' , password = '$thisPassword'  WHERE userId = '$thisUserId'";
	$resultUpdate = MYSQL_QUERY($sqlUpdate);
	echo "<b>Record with Id ".$thisUserIdFromForm." has been Updated<br></b>";
	$thisUserIdFromForm = "";
}

if ($thisAction=="Insert")
{
	// Retreiving Form Elements from Form
	$thisUserId = addslashes($_REQUEST['thisUserIdField']);
	$thisUsername = addslashes($_REQUEST['thisUsernameField']);
	$thisPassword = addslashes($_REQUEST['thisPasswordField']);

	$sqlInsert = "INSERT INTO user (userId , username , password ) VALUES ('$thisUserId' , '$thisUsername' , '$thisPassword' )";
	$resultInsert = MYSQL_QUERY($sqlInsert);
	echo "<b>Record has been inserted in Database<br></b>";
	$thisUserIdFromForm = "";
}

if ($thisAction=="Delete")
{
	// Retreiving Form Elements from Form
	$thisUserId = addslashes($_REQUEST['thisUserIdField']);
	$thisUsername = addslashes($_REQUEST['thisUsernameField']);
	$thisPassword = addslashes($_REQUEST['thisPasswordField']);

	$sqlDelete = "DELETE FROM user WHERE userId = '$thisUserId'";
	$resultDelete = MYSQL_QUERY($sqlDelete);

	echo "<b>Record with Id ".$thisUserIdFromForm." has been Deleted<br></b>";
	$thisUserIdFromForm = "";
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


$sql = "SELECT   * FROM user".$orderByQuery.$limitQuery;
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
			<a href="<?php echo $PHP_SELF; ?>?sortBy=userId&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>UserId</B>
			</a>
</TD>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=username&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>Username</B>
			</a>
</TD>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=password&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>Password</B>
			</a>
</TD>
	</TR>
<?php 
if ($thisAction=="EnterNew")
{
?>
<FORM NAME="insertForm" METHOD="POST" ACTION="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="action" value="Insert">
<input type="hidden" name="thisUserIdField" value="<?php echo $thisUserId; ?>">
	<TR BGCOLOR="#FF6666">
		<TD><input type"text" name="thisUserIdField" value=""></TD>
		<TD><input type"text" name="thisUsernameField" value=""></TD>
		<TD><input type"text" name="thisPasswordField" value=""></TD>
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

	$thisUserId = MYSQL_RESULT($result,$i,"userId");
	$thisUsername = MYSQL_RESULT($result,$i,"username");
	$thisPassword = MYSQL_RESULT($result,$i,"password");
if ($thisUserIdFromForm == $thisUserId)
{

?>
<FORM NAME="editForm" METHOD="POST" ACTION="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="action" value="Update">
<input type="hidden" name="thisUserIdField" value="<?php echo $thisUserId; ?>">
	<TR BGCOLOR="<?php echo $bgColor; ?>">
		<TD><input type"text" name="thisUserIdField" value="<?php echo $thisUserId; ?>"></TD>
		<TD><input type"text" name="thisUsernameField" value="<?php echo $thisUsername; ?>"></TD>
		<TD><input type"text" name="thisPasswordField" value="<?php echo $thisPassword; ?>"></TD>
	<TD COLSPAN=2><input type="button" name="Save" Value="Save" onClick="this.form.submit();"> </TD>
	</TR>
</FORM>

<?php 
} else { 
?>
	<TR BGCOLOR="<?php echo $bgColor; ?>">
		<TD><?php echo $thisUserId; ?></TD>
		<TD><?php echo $thisUsername; ?></TD>
		<TD><?php echo $thisPassword; ?></TD>
	<TD><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=Edit&thisUserIdField=<?php echo $thisUserId; ?>">Edit</a></TD>
	<TD><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=Delete&thisUserIdField=<?php echo $thisUserId; ?>">Delete</a></TD>
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