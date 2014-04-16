<?php
$pageTitle ="Add New Group";
include_once("../common/dbConnection.php");
include_once('../common/setup.php');
include_once("../common/header.php");
//$db->vardump($user);
?>
<h2><?php echo $pageTitle; ?></h2>
<form name="group_tableEnterForm" method="POST" action="insertNewGroup_table.php">    
    

<input type="hidden" name="thisUserIdField" size="40" value="<?php echo $user->userId ?>">  </td> 
<div style="display: inline;"><b> Group name :  </b></div><input class="form-control" type="text" name="thisGroup_nameField" length="20" value="" style="width: 400px; display: inline;">
<input type="hidden" name="thisDate_createdField" size="20" value="<?php echo date("Y-m-d"); ?>">
<div style="clear: both;"><p></p></div>
<input type="submit" name="submitEnterGroup_tableForm" value="Add New Group">
<input type="reset" name="resetForm" value="Clear Form">

</form>

<?php
include_once("../common/footer.php");
?>