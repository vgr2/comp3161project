<?php
include_once("../common/dbConnection.php");
include_once '../common/setup.php';
include_once("../common/header.php");
?>
<?php 
function highlightSearchTerms($fullText, $searchTerm, $bgcolor="#FFFF99")
{
	if (empty($searchTerm))
	{
		return $fullText;
	}
	else
	{
		$start_tag = "<span style=\"background-color: $bgcolor\">";
		$end_tag = "</span>";
		$highlighted_results = $start_tag . $searchTerm . $end_tag;
		return eregi_replace($searchTerm, $highlighted_results, $fullText);
	}
}

?>
<?php
$thisKeyword = mysql_real_escape_string($_REQUEST['keyword']);
?>
<?php 
$sqlQuery = "SELECT profile.userId, firstname, lastname, email, profile_pic  FROM profile join user on profile.userId = user.userId WHERE username like '%$thisKeyword%'  OR status like '%$thisKeyword%'  OR firstname like '%$thisKeyword%'  OR lastname like '%$thisKeyword%'  OR email like '%$thisKeyword%'  OR dob like '%$thisKeyword%'  OR profile_pic like '%$thisKeyword%' AND profile.userId != '".$_SESSION['userId']."'";
$results = $db->get_results($sqlQuery);
//$result = MYSQL_QUERY($sqlQuery);
//dd($results);
if (isset($results)){
    $numberOfRows = count($results);

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
        <TABLE CELLSPACING="0" CELLPADDING="3" BORDER="0" WIDTH="100%">
                <TR>
                        <TD>
                                <a href="<?php echo $PHP_SELF; ?>?sortBy=fname&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
                                        <B>First name</B>
                                </a>
        </TD>
                        <TD>
                                <a href="<?php echo $PHP_SELF; ?>?sortBy=lname&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
                                        <B>Last name</B>
                                </a>
        </TD>
                        <TD>
                                <a href="<?php echo $PHP_SELF; ?>?sortBy=email&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
                                        <B>Email</B>
                                </a>
        </TD>
                        <TD>
                                <a href="<?php echo $PHP_SELF; ?>?sortBy=profile_pic&sortOrder=<?php echo $newSortOrder; ?>&startLimit=<?php echo $startLimit; ?>&rows=<?php echo $limitPerPage; ?>">
                                        <B>Profile_pic</B>
                                </a>
        </TD>
                </TR>
        <?php 
        $highlightColor = "#FFFF99"; 
        
                foreach ($results as $result)//while ($i<$numberOfRows)
                {

                if (($i%2)==0) { $bgColor = "#FFFFFF"; } else { $bgColor = "#C0C0C0"; }
                $thisFriendId = $result->userId;
                $thisFname = $result->firstname;
                $thisLname = $result->lastname;
                $thisEmail = $result->email;
                $thisProfile_pic = $result->profile_pic;
                $thisFname = highlightSearchTerms($thisFname, $thisKeyword, $highlightColor); 
                $thisLname = highlightSearchTerms($thisLname, $thisKeyword, $highlightColor); 
                $thisEmail = highlightSearchTerms($thisEmail, $thisKeyword, $highlightColor); 
                $thisProfile_pic = highlightSearchTerms($thisProfile_pic, $thisKeyword, $highlightColor); 

        ?>
                <TR BGCOLOR="<?php echo $bgColor; ?>">
                        <TD><?php echo $thisFname; ?></TD>
                        <TD><?php echo $thisLname; ?></TD>
                        <TD><?php echo $thisEmail; ?></TD>
                        <TD><img src="<?php echo $thisProfile_pic; ?>" /></TD>
                        <TD><a href="../friends_of/insertNewFriends_of.php?thisFriends_ownerField=<?php echo $_SESSION['userId']; ?>&thisFriendField=<?php echo $thisFriendId ?>">Add Friend</a></TD>
<!--                <TD><a href="editProfile.php?userIdField=<?php echo $thisUserId; ?>">Edit</a></TD>
                <TD><a href="confirmDeleteProfile.php?userIdField=<?php echo $thisUserId; ?>">Delete</a></TD>-->
                </TR>
        <?php 
                        $i++;

                } // end while loop
        ?>
        </TABLE>
        <?php 
        } // end of if numberOfRows > 0 
    
} ?>

<?php
include_once("../common/footer.php");
?>