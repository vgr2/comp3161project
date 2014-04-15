<?php
// $baseURL = baseURL();
$dbName = "socialdb";

$pageName = pageName('dashboard.php');
$tableName = tableName("profile");
$pageTitle = pageTitle("My Profile");

include_once "ezsql/ez_sql_core.php";
include_once "ezsql/ez_sql_mysql.php";

$db = new ezSQL_mysql('root','',$dbName,'localhost');

//include './common/setup.ph9';
include_once 'common/VCrud.class.php';
include_once 'common/header.php';

//print_r($_SESSION);
$user = $db->get_row("select * from user where username = '".$_SESSION['login_user']."'");

// dd($user);
$profile = $db->get_row("select * from profile where userId = '".$user->userId."'");
// dd($profile);
$personalPosts = $db->get_results("select * from post where userId = '".$user->userId."' order by date_created");
//dd($personalPosts);
$usersGroups = $db->get_results("select * from group_table where userId = '".$user->userId."'");
// dd($usersGroups);
$groupsUserIn = $db->get_results("SELECT group_table.group_name FROM group_table JOIN group_members ON group_table.g_id = group_members.g_id WHERE group_members.userID = '".$user->userId."'");
// dd($groupsUserIn);
$allGroups = $db->get_results("select * from group_table");
// dd($allGroups);
//variable  for storing all existing friends
$friends = $db->get_results("select userId,firstname, lastname from profile join friends_of on profile.userId = friends_of.friends_owner where friends_of.friends_owner = '".$user->userId."'");
// dd($friends);

?>
<a href="#"><strong><i class="glyphicon glyphicon-dashboard"></i> My Dashboard</strong></a>  
	<div class="row">
        <!-- center left-->	
      	<div class="col-md-7">
		<?php            
		echo showPanel('My Profile', showProfile($profile));
		echo "<hr>";
		echo showItemsPanel('My Posts', showPersonalPosts($personalPosts), newPostForm($user->userId));
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
function isAdmin($username){
	
}

function showPersonalPosts($personalPosts){
    $p ="<hr>";
    foreach ($personalPosts as $post) {
        $p .= '<span><strong><a href="">'.$post->title.'</a></strong></span>'.' <span class="pull-right">'.$post->date_created.'</span>';
    }
    return $p;
}
?>
