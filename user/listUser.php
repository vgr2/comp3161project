<?php
include_once("../common/dbConnection.php");
include_once '../common/setup.php';
include_once("../common/header.php");
?>
<?php 


$initStartLimit = 0;
$limitPerPage = 10;

if (isset($_REQUEST['startLimit'])){$startLimit = mysql_real_escape_string($_REQUEST['startLimit']);}  else {
    $startLimit = "";
}
if (isset($_REQUEST['rows'])){$numberOfRows = $_REQUEST['rows'];} else {$numberOfRows ="";}
if (isset($_REQUEST['sortBy'])){$sortBy = $_REQUEST['sortBy'];} else {
    $sortBy = "";
}
if (isset($_REQUEST['sortOrder'])){$sortOrder = $_REQUEST['sortOrder'];} else {$sortOrder = "";}

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
} else {
    $orderByQuery = "";
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
if ($startLimit != "")
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
			<a href="<?php echo $PHP_SELF; ?>?sortBy=username&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
				<B>Username</B>
			</a>
</TD>
		
	</TR>
<?php 
	while ($i<$numberOfRows)
	{

		if (($i%2)==0) { $bgColor = "#FFFFFF"; } else { $bgColor = "#C0C0C0"; }

	$thisUserId = MYSQL_RESULT($result,$i,"userId");
	$thisUsername = MYSQL_RESULT($result,$i,"username");
	
?>
	<TR BGCOLOR="<?php echo $bgColor; ?>">
            <TD><a href="viewUser.php?userIdField=<?php echo $thisUserId; ?>"> <?php echo $thisUsername; ?></a></TD>
	<!--<TD><a href="editUser.php?userIdField=<?php echo $thisUserId; ?>">Edit</a></TD>-->
	<TD><a href="confirmDeleteUser.php?userIdField=<?php echo $thisUserId; ?>">Delete</a></TD>
	</TR>
<?php 
		$i++;

	} // end while loop
?>
</TABLE>


<br>
<?php 
if ($startLimit != "")
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