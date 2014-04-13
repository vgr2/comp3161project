<?php
$baseURL = baseURL();
$dbName = "socialdb";

$pageName = pageName('dashboard.php');
$tableName = tableName("profile");
$pageTitle = pageTitle("My Profile");

include_once "ezsql/ez_sql_core.php";
include_once "ezsql/ez_sql_mysql.php";

$db = new ezSQL_mysql('root','crunch',$dbName,'localhost');

//include './common/setup.ph9';
include_once baseURL().'/common/VCrud.class.php';
include_once baseURL().'/common/header.php';

//print_r($_SESSION);

?>
<a href="#"><strong><i class="glyphicon glyphicon-dashboard"></i> My Dashboard</strong></a>  
	<div class="row">
        <!-- center left-->	
      	<div class="col-md-7">
		<?php            
		//one users stuff
		$user = $db->get_row("select * from user where userId = '".$_SESSION['userId']."'");
		//dd($user);
		$profile = $db->get_row("select * from profile where userId = '".$_SESSION['userId']."'");
		// dd($profile);
		$personalPosts = $db->get_results("select * from post where userId = '".$_SESSION['userId']."' order by date_created");
		// dd($personalPosts7;
		$usersGroups = $db->get_results("select * from group_table where userId = '".$_SESSION['userId']."'");
		// dd($usersGroups);
		$groupsUserIn = $db->get_results("SELECT group_table.group_name FROM group_table JOIN group_members ON group_table.g_id = group_members.g_id WHERE group_members.userID = '".$_SESSION['login_user']."'");
		// dd($groupsUserIn);
		$allGroups = $db->get_results("select * from group_table");
		// dd($allGroups);
		//variable  for storing all existing friends
		$friends = $db->get_results("select userId,firstname, lastname from profile join friends_of on profile.userId = friends_of.friends_owner where friends_of.friends_owner = '".$_SESSION['userId']."'");
		// dd($friends);
		echo showPanel('My Profile', showProfile($profile));
		echo "<hr>";
		echo showItemsPanel('My Posts', relatedData($personalPosts), newPostForm());
		echo "<hr>";
		?>
		</div>
		<div class="col-md-5">
		<?php
		echo showItemsPanel('My Groups', relatedData( $usersGroups ));
		echo "<hr>";
		echo showItemsPanel('Joined Groups', relatedData($groupsUserIn));
		echo "<hr>";
		echo showItemsPanel('All Groups', relatedData($allGroups));
		echo "<hr>";
		echo showItemsPanel('My Friends', relatedData($friends));
		echo "<hr>";
		?>	
		</div>
	</div>
            
    <hr>
</div>      

<?php
include_once './common/footer.php';

function dd($var){
	echo "<pre>";print_r($var);echo "</pre>";	
	die();
}
function newPostForm(){
return '
<form name="postEnterForm" method="POST" action="insertNewPost.php">

<div>
		<input type="hidden" name="thisUserIdField" size="20" value="'.$_SESSION['userId'].'">
	<div>Title : <input type="text" name="thisTitleField" size="20" value="" style="width:100%;"">  </div> 
	<div>Text body :</div>
	<div><textarea name="thisText_bodyField" style="width:100%; height:100px;" id="thisText_bodyField"></textarea></div>
	<div> <input type="hidden" name="thisDate_createdField" size="20" value="'.date("Y-m-d").'">  </div> 
	<br>
</div>

<input type="submit" name="submitEnterPostForm" value="Enter Post">
<input type="reset" name="resetForm" value="Clear Form">

</form>';

}
function showPanel($name,$item){
	$v = 	'<div class="panel panel-default">
	            <div class="panel-heading"><h4>'.$name.'</h4></div>
	            <div class="panel-body">';
	$v .= 	        $item;
	$v .= '		</div>
			</div>';
	return $v;
}
function showItemsPanel($name,$item,$newItem=null){
	$v = 	'<div class="panel panel-default">
	            <div class="panel-heading"><h4>'.$name.' <span class="pull-right">+</span></h4></div>
	            <div class="panel-body">';
	            $v .= ($newItem) ? $newItem : "" ;
	$v .= 	        $item;
	$v .= '		</div>
			</div>';
	return $v;
}
function showProfile($profile)
{
	$v = '<div class="col-md-4">';
	$v .= '<p>'.$profile->firstname.' '.$profile->lastname.'</p>';
	$v .= '<p>'.$profile->status.'</p>';
	$v .= '<p>'.$profile->email.'</p>';
	$v .= '<p>'.$profile->dob.'</p>';
	$v .= '</div>';
	$v .= '<span class="pull-right"><img src="'.$profile->profile_pic.'" width="100" height="100" /></span>';
	return $v;
}
function relatedData($data)
{
	if (isset($data))
	{
		$d = '<ul>';
		foreach ($data as $key => $value) {
			$d .= '<li>'.$key.': '.$value.'</li>';
		}
		$d .= '</ul>';
		
		return $d;
	}
}
function baseURL(){
	return '';
}
function pageName($pgName){
	return $pgName;
}
function tableName($tblName){
	return $tblName;
}
function pageTitle($pgTitle){
	return $pgTitle;
}

?>
