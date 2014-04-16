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
$otherGroups = $db->get_results("select * from group_table");
// dd($allGroups);
//variable  for storing all existing friends
$friends = $db->get_results("select userId, firstname, lastname from profile join friends_of on profile.userId = friends_of.friend where friends_of.friend = (select friend from friends_of where friends_owner = '".$user->userId."')");
//$db->vardump();
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
		echo showItemsPanel('My Groups', showMyGroups($usersGroups));
		echo "<hr>";
		echo showItemsPanel('Joined Groups', groupsUserIn($groupsUserIn));
		echo "<hr>";
		echo showItemsPanel('Other Groups', allGroups($otherGroups));
		echo "<hr>";
		echo showItemsPanel('My Friends', friends($friends));
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
	            <div class="panel-heading"><h4>'.$name.'</h4></div>
	            <div class="panel-body" style="max-height:150px; overflow:auto;">';
	            $v .= ($newItem) ? $newItem."<hr>" : "" ;
//                    $v .= "<hr>";
	$v .= 	        $item;
	$v .= '     </div>
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
//		dd($data);
                $d = '<ul>';
		foreach ($data as $key => $value) {
//			$d .= '<div>'.$key.': '.$value.'</div>';
		}
		$d .= '</ul>';
		
		return $d;
	}
}



function showPersonalPosts($personalPosts){
    $p = '<div class="pull-right">+</div>';
    if (isset($personalPosts)){
        foreach ($personalPosts as $post) {
            $p .= '<div style="width:94%;"><span><strong><a href="">'.$post->title.'</a></strong></span>'.' <span class="pull-right">'.$post->date_created.'</span></div>';
        }
    } else {
        $p.= "<div>No posts, yet...</div>";
    }
    return $p;
}

function showMyGroups($myGroups){
    $p = '<div class="pull-right"><a href="group_table/enterNewGroup_table.php">+</a></div>';
    if (isset($myGroups)){
        foreach ($myGroups as $group) {
            $p .= '<div style="width:94%;"><span>'.$group->group_name.'</span><span class="pull-right"> '.$group->date_created.' </span></div>';
        }
    } else {
        $p.= "No groups, yet...";
    }
    return $p;
}
function groupsUserIn($param) {
    $p = '<div class="pull-right">+</div>';
    if (isset($param)){
        foreach ($param as $group) {
            $p .= '<div style="width:95%;"><span>'.$group->group_name.'</span><span class="pull-right"> '.$group->date_created.' </span></div>';
        }
    } else {
        $p .= "Haven't joined any groups, yet..";
    }
    return $p;
}
function allGroups($param) {
    global $user;
    $p = "";//'<span class="pull-right">[ <a href="group_table/enterNewGroup_table.php">+</a> ]</span>';
    if (isset($param)){
        foreach ($param as $group) {
            $p .= '<div style="width:94%;"><span>'.$group->group_name.'</span><span class="pull-right"> <a href="group_members/insertNewGroup_members.php?thisUserIdField='.$user->userId.'&thisDate_addedField='.  date("Y-m-d").'">Join</a> </span></div>';
        }
    } else {
        $p .= "Haven't joined any groups, yet..";
    }
    return $p;
}
function friends($param) {
    $p = '<div class="pull-right"><a href="profile/searchProfileForm.php">+</a></div>';
    if (isset($param)){
        foreach ($param as $friend) {
            $p .= '<div style="width:95%;"><span><a href="">'.$friend->firstname.' '.$friend->lastname.'</a></span><span class="pull-right"></span></div>';
        }
    } else {
        $p .= "Haven't added any friends, yet..";
    }
    return $p;
}

?>
