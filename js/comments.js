function open_comments(post_id, span){
	
	var tooltip = "";
	
	if(logged_in == true){
		
		tooltip = 'data-toggle="tooltip" title="Your username will appear next to your comment"  data-placement="bottom"';
		
	}
				
    $.post("core/functions/ajax.php",{function: "get_comments", post_id: post_id},function(data){
			
		$("#hole-comments-section").fadeIn();
		$("#actual-comments").html('<div id = "actual-comments"><span class = "col-xs-12 no-padding"><span onclick = "close_comments(1, null)" class = "glyphicon pull-left glyphicon-remove comment-x"></span></span><textarea rows = "3" placeholder = "Write a comment..." class = "form-control" name ="comment" id = "commenttoget"></textarea><button '+tooltip+' class = "btn btn-info btn-block comment_submit" onclick = "submit_comment(' + post_id + ', this, 1)">COMMENT</button><span id = "comments">' + data + '</span></div>');
		
		$('[data-toggle="tooltip"]').tooltip();
		
		
		
	});
			
			
	
	
}


function show_comments(post_id, span){
	
	var tooltip = "";
	
	if(logged_in == true){
		
		
		tooltip = 'data-toggle="tooltip" title="Your username will appear next to your comment"  data-placement="bottom"';
		
	}

    $.post("core/functions/ajax.php",{function: "get_comments", post_id: post_id},function(data){
		
		htmlIn = '<div class = "col-xs-12" id = "actual-comments"><span class = "no-padding"><span onclick = "close_comments(2, '+post_id+')" class = "glyphicon pull-left glyphicon-remove comment-x"></span></span>';
		
		if(logged_in == true){
		
			htmlIn += '<textarea rows = "2" placeholder = "Write a comment..." class = "form-control" name ="comment" id = "commenttoget'+post_id+'"></textarea><button  '+tooltip+' class = "btn btn-info pull-right comment_submit" onclick = "submit_comment(' + post_id + ', this, 2)">COMMENT</button><br><br>';
		
		}else{
			
			htmlIn += "<br><p style = 'color:#888; padding:5px;'>You need to be <a href = 'login.php'>logged in</a> to comment</p>"
			
		}
		
		htmlIn += '<span id = "comments'+post_id+'">' + data + '</span></div>';
		
		$("#post"+post_id+"-bottom").html(htmlIn);
		
		$('[data-toggle="tooltip"]').tooltip();
		
		$("#post"+post_id+"-bottom").show();	
		
	});
	
	
}


function open_comments_share(post_id, span){
	
	var tooltip = "";
	
	if(logged_in == true){
		
		
		tooltip = 'data-toggle="tooltip" title="Your username will appear next to your comment"  data-placement="bottom"';
		
	}
	
    $.post("core/functions/ajax.php",{function: "get_comments", post_id: post_id},function(data){
			
		$("#post"+post_id+"-bottom-share").html('<div class = "col-xs-12" id = "actual-comments"><span class = "no-padding"><span onclick = "close_comments(2, '+post_id+')" class = "glyphicon pull-right glyphicon-remove comment-x"></span></span><textarea rows = "2" placeholder = "Write a comment..." class = "form-control" name ="comment" id = "commenttoget'+post_id+'"></textarea><button  '+tooltip+' class = "btn btn-info pull-right comment_submit" onclick = "submit_comment(' + post_id + ', this, 2)">COMMENT</button><br><br><span id = "comments'+post_id+'">' + data + '</span></div>');
		$('[data-toggle="tooltip"]').tooltip();
		
		$("#post"+post_id+"-bottom-share").show();
		
	});
	
	
	
	

}


function close_comments(type, post_id){
	
	if(type == 1){
		
		$("#hole-comments-section").fadeOut();
		$(".commenting-on").fadeOut();
		
		
	}
	if(type == 2){
		
		$("#post"+post_id+"-bottom").html('');
		$("#post"+post_id+"-bottom").hide();
		
	}
	
	
}


function submit_comment(post_id, span, type){
	
	var comment = "";
	
	if(type == 1){
		
		comment = $('#commenttoget').val();
		
	}
	if(type == 2){
		
		comment = $('#commenttoget' + post_id).val();
		
	}
	
	
	
	if(comment == ""){
		
		$('#topalert').html('<span class="alert alert-danger" role="alert"><span class = "glyphicon"></span>Your comment cannot be blank...lets pull it together here</span>');
   
		$('#topalert').fadeIn("slow", function() { $(this).delay(3000).fadeOut("slow"); });
				
	}else{
	
	
    $.post("core/functions/ajax.php",{function: "submit_comment", post_id: post_id, comment: comment},function(data){
                				
		$('#topalert').html('<span class="alert alert-success" role="alert"><span class = "glyphicon"></span>Commented! I hope you said something nice</span>');
   
		$('#topalert').fadeIn("slow", function() { $(this).delay(3000).fadeOut("slow");
		
		
			if(type == 1){
		
				$('#commenttoget').val('');
			
				$('#comments').prepend('<span class = "col-xs-12 a-comment"><span class = "atext no-padding col-xs-12"><br>' + comment + '</span><span class = "comment-widgets">Me</span></span>');
		
			}
			if(type == 2){
				
		
				$('#commenttoget' + post_id).val('');
			
				$('#comments' + post_id).prepend('<span class = "col-xs-12 a-comment"><span class = "atext no-padding col-xs-12"><br>' + comment + '</span><span class = "comment-widgets">Me</span></span>');
	
			
			}
			
			
		 });
    
	 });
	 
 	}
	
	
}

