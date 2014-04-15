<?php
$baseURL = '';
$dbName = "socialdb";
$pageName = '';
$tableName = "post";
$pageTitle = "My Posts";

include '../common/setup.php';
include_once '../common/header.php';
include_once '../common/VCrud.class.php';

//print_r($_SESSION);
$post = $db->get_row("select * from post join user on post.userId = user.userId where user.username = '".$_SESSION['login_user']."'");
//dd($post);
$priKeyName = 'postId';
//$priKeyData = $post->postId;
$foreignKeyName = "userId";
$foreignKeyData = $post->userId;


$listColsWanted = "title, date_created";
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

$myPosts = new VCrud($baseURL,$pageName,$dbName,$tableName,$priKeyName,$listColsWanted,$pageTitle,$db,$post,$get,$foreignKeyName,$foreignKeyData,$profile->userId);

$myPosts->selectMode($mode, $id);
if (isset($mode)){
	switch ($mode) {
	  case 'add':
  		echo '<div class="pull-right"><strong>Edit Mode</strong></div>';
  		$show = $myProfile->generateAddForm($tableName, $foreignKeyName, $foreignKeyData, $baseURL, $pageName);
  		break;
	  case 'edit':
  		echo '<div class="pull-right"><strong>Edit Mode</strong></div>';
  		$show = $myProfile->generateEditForm($tableName, $priKeyData,  $foreignKeyName,  $baseURL,  $pageName);
  		break;
	  case 'view':
  		echo '<div class="pull-right"><strong>View Mode</strong></div>';
  		$show = $myProfile->viewRow($priKeyData, $foreignKeyName, $tableName);
  		break;
	  case 'del':
  		echo '<div class="pull-right"><strong>Delete</strong></div>';
  		$show = $myProfile->generateDeleteForm($priKeyData, $tableName, $baseURL, $pageName);
  		break;
	  case '':
      $show = $myProfile->generateList($listColsWanted,  $tableName,  $foreignKeyName,  $baseURL,  $pageName, $get,  $foreignKeyData); 
      break;
	  default:
		  
		  break;
	}
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
