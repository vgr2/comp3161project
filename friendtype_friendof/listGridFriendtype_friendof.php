<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php 
$thisFriendtype_friendofIdFromForm = $_REQUEST['thisFriendtype_friendofIdField'];
$thisAction = $_REQUEST['action'];
if ($thisAction=="Update")
{
	// Retreiving Form Elements from Form
	$thisFriendtype_friendofId = addslashes($_REQUEST['thisFriendtype_friendofIdField']);
	$thisFriendId = addslashes($_REQUEST['thisFriendIdField']);
	$thisFriend_typeId = addslashes($_REQUEST['thisFriend_typeIdField']);

	$sqlUpdate = "UPDATE friendtype_friendof SET friendtype_friendofId = '$thisFriendtype_friendofId' , friendId = '$thisFriendId' , friend_typeId = '$thisFriend_typeId'  WHERE friendtype_friendofId = '$thisFriendtype_friendofId'";
	$resultUpdate = MYSQL_QUERY($sqlUpdate);
	echo "<b>Record with Id ".$thisFriendtype_friendofIdFromForm." has been Updated<br></b>";
	$thisFriendtype_friendofIdFromForm = "";
}

if ($thisAction=="Insert")
{
	// Retreiving Form Elements from Form
	$thisFriendtype_friendofId = addslashes($_REQUEST['thisFriendtype_friendofIdField']);
	$thisFriendId = addslashes($_REQUEST['thisFriendIdField']);
	$thisFriend_typeId = addslashes($_REQUEST['thisFriend_typeIdField']);

	$sqlInsert = "INSERT INTO friendtype_friendof (friendtype_friendofId , friendId , friend_typeId ) VALUES ('$thisFriendtype_friendofId' , '$thisFriendId' , '$thisFriend_typeId' )";
	$resultInsert = MYSQL_QUERY($sqlInsert);
	echo "<b>Record has been inserted in Database<br></b>";
	$thisFriendtype_friendofIdFromForm = "";
}

if ($thisAction=="Delete")
{
	// Retreiving Form Elements from Form
	$thisFriendtype_friendofId = addslashes($_REQUEST['thisFriendtype_friendofIdField']);
	$thisFriendId = addslashes($_REQUEST['thisFriendIdField']);
	$thisFriend_typeId = addslashes($_REQUEST['thisFriend_typeIdField']);

	$sqlDelete = "DELETE FROM friendtype_friendof WHERE friendtype_friendofId = '$thisFriendtype_friendofId'";
	$resultDelete = MYSQL_QUERY($sqlDelete);

	echo "<b>Record with Id ".$thisFriendtype_friendofIdFromForm." has been Deleted<br></b>";
	$thisFriendtype_friendofIdFromForm = "";
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


$sql = "SELECT   * FROM friendtype_friendof".$orderByQuery.$limitQuery;
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
			<a href="<?php echo $PHP_SELF; ?>?sortBy=friendtype_friendofId&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>Friendtype_friendofId</B>
			</a>
</TD>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=friendId&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>FriendId</B>
			</a>
</TD>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=friend_typeId&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>Friend_typeId</B>
			</a>
</TD>
	</TR>
<?php 
if ($thisAction=="EnterNew")
{
?>
<FORM NAME="insertForm" METHOD="POST" ACTION="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="action" value="Insert">
<input type="hidden" name="thisFriendtype_friendofIdField" value="<?php echo $thisFriendtype_friendofId; ?>">
	<TR BGCOLOR="#FF6666">
		<TD><input type"text" name="thisFriendtype_friendofIdField" value=""></TD>
		<TD><input type"text" name="thisFriendIdField" value=""></TD>
		<TD><input type"text" name="thisFriend_typeIdField" value=""></TD>
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

	$thisFriendtype_friendofId = MYSQL_RESULT($result,$i,"friendtype_friendofId");
	$thisFriendId = MYSQL_RESULT($result,$i,"friendId");
	$thisFriend_typeId = MYSQL_RESULT($result,$i,"friend_typeId");
if ($thisFriendtype_friendofIdFromForm == $thisFriendtype_friendofId)
{

?>
<FORM NAME="editForm" METHOD="POST" ACTION="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="action" value="Update">
<input type="hidden" name="thisFriendtype_friendofIdField" value="<?php echo $thisFriendtype_friendofId; ?>">
	<TR BGCOLOR="<?php echo $bgColor; ?>">
		<TD><input type"text" name="thisFriendtype_friendofIdField" value="<?php echo $thisFriendtype_friendofId; ?>"></TD>
		<TD><input type"text" name="thisFriendIdField" value="<?php echo $thisFriendId; ?>"></TD>
		<TD><input type"text" name="thisFriend_typeIdField" value="<?php echo $thisFriend_typeId; ?>"></TD>
	<TD COLSPAN=2><input type="button" name="Save" Value="Save" onClick="this.form.submit();"> </TD>
	</TR>
</FORM>

<?php 
} else { 
?>
	<TR BGCOLOR="<?php echo $bgColor; ?>">
		<TD><?php echo $thisFriendtype_friendofId; ?></TD>
		<TD><?php echo $thisFriendId; ?></TD>
		<TD><?php echo $thisFriend_typeId; ?></TD>
	<TD><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=Edit&thisFriendtype_friendofIdField=<?php echo $thisFriendtype_friendofId; ?>">Edit</a></TD>
	<TD><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=Delete&thisFriendtype_friendofIdField=<?php echo $thisFriendtype_friendofId; ?>">Delete</a></TD>
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