<?php
include_once("../common/dbConnection.php");
include_once("../common/header.php");
?>
<?php 
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


$sql = "SELECT   * FROM friend_type".$orderByQuery.$limitQuery;
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
			<a href="<?php echo $PHP_SELF; ?>?sortBy=friend_typeId&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>Friend_typeId</B>
			</a>
</TD>
		<TD>
			<a href="<?php echo $PHP_SELF; ?>?sortBy=type&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>Type</B>
			</a>
</TD>
	</TR>
<?php 
	while ($i<$numberOfRows)
	{

		if (($i%2)==0) { $bgColor = "#FFFFFF"; } else { $bgColor = "#C0C0C0"; }

	$thisFriend_typeId = MYSQL_RESULT($result,$i,"friend_typeId");
	$thisType = MYSQL_RESULT($result,$i,"type");

?>
	<TR BGCOLOR="<?php echo $bgColor; ?>">
		<TD><?php echo $thisFriend_typeId; ?></TD>
		<TD><?php echo $thisType; ?></TD>
	<TD><a href="editFriend_type.php?friend_typeIdField=<?php echo $thisFriend_typeId; ?>">Edit</a></TD>
	<TD><a href="confirmDeleteFriend_type.php?friend_typeIdField=<?php echo $thisFriend_typeId; ?>">Delete</a></TD>
	</TR>
<?php 
		$i++;

	} // end while loop
?>
</TABLE>


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