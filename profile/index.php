<?php
echo $baseURL = '';
$dbName = "socialdb";
$pageName = '';
$tableName = "profile";
$pageTitle = "My Profile";

include '../common/setup.php';
include_once '../common/header.php';
include_once '../common/VCrud.class.php';

//print_r($_SESSION);
$profile = $db->get_row("select * from profile where userId = '".$_SESSION['userId']."'");

$priKeyName = 'profileId';
$priKeyData = $profile->profileId;
$foreignKeyName = "userId";
$foreignKeyData = $profile->userId;


$listColsWanted = "firstname, lastname, status, email, dob, profile_pic";
$post = $_POST;
$get = $_GET;
if (isset($_POST['mode'])){
    $mode = $db->escape($_POST['mode']);
}
if (isset($_POST[$priKeyName])){
    $id = $db->escape($_POST[$priKeyName]);
} else {
    $id = $priKeyName;
}

if (isset($_GET['mode'])){
    $mode = $db->escape($_GET['mode']);
}
if (isset($_GET[$priKeyName])){
    $id = $db->escape($_GET[$priKeyName]);
}

$myProfile = new VCrud($baseURL,$pageName,$dbName,$tableName,$priKeyName,$listColsWanted,$pageTitle,$db,$post,$get,$foreignKeyName,$foreignKeyData,$profile->userId);
if (isset($mode) && $mode == 'edit'){
	echo '<div class="pull-right"><strong>Edit Mode</strong></div>';
	$show = $myProfile->generateEditForm($tableName, $priKeyData,  $foreignKeyName,  $baseURL,  $pageName);

} else {
	$show = $myProfile->viewRow($priKeyData, $foreignKeyName, $tableName);
	echo '<div class="btn"><a href="index.php?mode=edit">Edit Profile</a></div>';
}


?>
<a href="#"><strong><i class="glyphicon glyphicon-th-list"></i> My Profile</strong></a>  
	<div class="row">
        <!-- center left-->	
      	<div class="col-md-7">
      		<?php echo $show; ?>
      		
      	</div>
     </div>

<?php
include_once '../common/footer.php';

?>
