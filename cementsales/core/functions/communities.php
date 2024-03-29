<?php

function community_sub_count($community_name){
	$community_name = sanitize($community_name);
	
	$count = mysql_fetch_assoc(mysql_query("SELECT COUNT(user_id) AS totalsubs FROM subscriptions WHERE community_name = '$community_name'"));
	
	return ($count['totalsubs']);
}

function community_queue_count($community_name){
	$community_name = sanitize($community_name);
	
	$count = mysql_fetch_assoc(mysql_query("SELECT COUNT(id) AS totalqueue FROM posts WHERE site = '$community_name' AND status = 0"));
	
	return ($count['totalqueue']);
}


function create_community($community_data){
		
	array_walk($community_data, 'array_sanitize');

	$fields = '`' . implode('`, `', array_keys($community_data)) . '`';
	$data = '\'' . implode('\', \'', $community_data) . '\'';

	mysql_query("INSERT INTO `communities` ($fields) VALUES ($data)");
	
}
	
function delete_community($community_name){
	
	$community_name = sanitize($community_name);
	
	$success = mysql_query("DELETE FROM communities WHERE community_name = '$community_name'");
	
	return $success;
	
}

function update_community($admin_id, $update_data, $community_name){
	$admin_id = sanitize($admin_id);
	$community_name = sanitize($community_name);
	
	if(check_admin_community($community_name, $admin_id)){	
		
		$update = array();
		array_walk($update_data, 'array_sanitize');
	
		foreach($update_data as $field=>$data) {
			$update[] = '`' . $field . '` = \'' . $data . '\'';
		
		}
	
		return mysql_query("UPDATE `communities` SET " . implode(', ', $update) . " WHERE `name` = '$community_name'") or die(mysql_error());
		
	}else{
		
		return false;
		
	}
}

function admin_post($message, $admin_id, $community_name){
	$message = sanitize($message);
	$admin_id = sanitize($admin_id);
	$community_name = sanitize($community_name);
	
	$time = time();
	
	if(check_admin_community($community_name, $admin_id)){	
		
	$success = mysql_query("INSERT INTO admin_post (message, community, admin_id, second) VALUES ('$message', '$community_name', '$admin_id', '$time')") or die(mysql_error());
		
	return $success;
	
	}else{
		
		return false;
	}

}

function get_admin_post($community_name, $admin_id, $status, $type){
	$status = sanitize($status);
	$community_name = sanitize($community_name);
	$admin_id = sanitize($admin_id);
	
	if($type == 0){
	
		$result = mysql_query("SELECT * FROM admin_post WHERE status = 0 AND admin_id = '$admin_id' AND community = '$community_name' AND status = '$status' ORDER BY ID DESC");
	
	}
	if($type == 1){
		
		$result = mysql_query("SELECT * FROM admin_post WHERE status = 0 AND community = '$community_name' AND status = '$status' ORDER BY ID DESC");
		
	}
	if($type == 2){
		
		$result = mysql_query("SELECT * FROM admin_post WHERE admin_id = '$admin_id' ORDER BY ID DESC");
		
	}
		
	
	$all_posts = array();
	
    while($number = mysql_fetch_assoc($result)) { 
		$all_posts[] = $number;		
   	}
	
	return $all_posts;
}

function delete_admin_post($admin_post_id, $admin_id){
	$admin_post_id = sanitize($admin_post_id);
	$admin_id = sanitize($admin_id);
		
	if(check_admin_power($admin_id) > 0){
		
		$success = mysql_query("UPDATE `admin_post` SET `status` = '1' WHERE `id` = '$admin_post_id'") or die(mysql_error());	
		
	}else{
	
		$success = mysql_query("UPDATE `admin_post` SET `status` = '1' WHERE `id` = '$admin_post_id' AND `admin_id` = '$admin_id'") or die(mysql_error());	
	
	}
	
	return $success;
	
}

?>