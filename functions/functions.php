<?php
//session_start();
$con =mysqli_connect("localhost","root","","social_network") or die("connection was not established");
//getting topics 
function getTopics(){
	global $con;
        $get_topics="select * from topics";
		$run_topics=mysqli_query($con,$get_topics);

		while($row=mysqli_fetch_array($run_topics)){
			$topic_id=$row['topic_id'];
			$topic_title=$row['topic_title'];

			echo "<option value='$topic_id'>$topic_title</option>";
		}
}
//inserting posts
function insertPost(){
	
	if(isset($_POST['submitpost'])){
		global $con;
		global $user_id;
		$title=addslashes($_POST['title']);
		$content=addslashes($_POST['content']);
		$topic=$_POST['topic'];

		if($content==''){
			echo "<h2>Please Enter topic description</h2>";
			exit();
		}
		else {
		$insert="insert into posts (user_id,topic_id,post_title,post_content,post_date) values ('$user_id','$topic','$title','$content',NOW())";

		$run=mysqli_query($con,$insert);
		if($run){
			echo "<script>alert('Posted to the timeline')</script>";
			echo "<script>window.open('home.php','_self')</script>";
			//echo "<h3>Posted to timeline</h3>";
			$update="update users set posts='yes' where user_id='$user_id' ";
			$run_update=mysqli_query($con,$update);
		}
		else echo "Didn't Posted";
	}
}
}

function get_posts(){
	global $con;
	$per_page=5;
	if(isset($_GET['page'])){
		$page=$_GET['page'];
	}
	else {
		$page=1;
	}
	$start_from=($page-1)*$per_page;
	$get_posts ="select * from posts ORDER by 1 DESC LIMIT $start_from, $per_page";
	$run_posts=mysqli_query($con,$get_posts);
	while($row_posts=mysqli_fetch_array($run_posts)){

		 $post_id=$row_posts['post_id'];
		 $user_id=$row_posts['user_id'];
		 $post_title=$row_posts['post_title'];
		 $content=$row_posts['post_content'];
		 $post_date=$row_posts['post_date'];
//getting the user who has posted the thread 
		 $user="select * from users where user_id='$user_id' AND posts='yes' ";
		 $run_user=mysqli_query($con,$user);
		 $row_user=mysqli_fetch_array($run_user);
		 $user_name=$row_user['user_name'];
		 $user_image=$row_user['user_image'];

		 //desplaying

		  echo "<div id='posts'> 
		   <p><img src='user/user_images/$user_image' width='50' height='50'> </p>
		   <h3><a href='user_profile.php?u_id=$user_id'>$user_name</h3></a>
		   <h3>$post_title</h3>
		   <p>$post_date</p>
		   <p>$content</p>
		   <a href='single.php?post_id=$post_id' style='float:right;'><button>See Replies or Relpy to This</button></a>
		   </div><br/>
		    ";
	}
	include("pagination.php");
}


function single_post(){
	if(isset($_GET['post_id'])){
		global $con;
		$get_id=$_GET['post_id'];

		$get_posts ="select * from posts where post_id='$get_id' ORDER by 1 DESC";
	$run_posts=mysqli_query($con,$get_posts);
	$row_posts=mysqli_fetch_array($run_posts);

		 $post_id=$row_posts['post_id'];
		 $user_id=$row_posts['user_id'];
		 $post_title=$row_posts['post_title'];
		 $content=$row_posts['post_content'];
		 $post_date=$row_posts['post_date'];
//getting the user who has posted the thread 
		 $user="select * from users where user_id='$user_id' AND posts='yes' ";
		 $run_user=mysqli_query($con,$user);
		 $row_user=mysqli_fetch_array($run_user);
		 $user_name=$row_user['user_name'];
		 $user_image=$row_user['user_image'];

		 //desplaying

		  echo "<div id='posts'> 
		   <p><img src='user/user_images/$user_image' width='50' height='50'> </p>
		   <h3><a href='user_profile.php?user_id=$user_id'>$user_name</h3></a>
		   <h3>$post_title</h3>
		   <p>$post_date</p>
		   <p>$content</p>
		   </div>
		   ";
		   include("comments.php");

		   echo "<form action='' method='post' id='reply'>
		   <textarea cols='50' rows='5' name='comment' placeholder='Write a reply'></textarea><br>
		   <input type='submit' name='reply' value='Relpy to this'/>
		   </form>

		    ";
		    $currentUser_email=$_SESSION['user_email'];
		    $get_curr_user="select * from users where user_email='$currentUser_email' ";
		    $run_curr_user=mysqli_query($con,$get_curr_user);
		    $curr_user_row=mysqli_fetch_array($run_curr_user);
		    $curr_user_name=$curr_user_row['user_name'];
		    if(isset($_POST['reply'])){
		    	$comment=$_POST['comment'];
		    	$insert="insert into comments(post_id,user_id,comment,comment_author,date) values('$post_id','$user_id','$comment','$curr_user_name',NOW())";
		    	$run=mysqli_query($con,$insert);
		    	if($run){
		    		echo "<script>alert('Your Reply was added')</script>";
		    		//echo "<script>window.open('home.php','_self?post_id='$post_id')</script>";
		    	}
		    	//echo "Your Reply was added ";

		    }
	}
}

function get_Cats(){
	global $con;
	$per_page=5;
	if(isset($_GET['page'])){
		$page=$_GET['page'];
	}
	else {
		$page=1;
	}
	$start_from=($page-1)*$per_page;
	if(isset($_GET['topic'])){
		$topic_id=$_GET['topic'];
	}


	$get_posts ="select * from posts where topic_id='$topic_id' ORDER by 1 DESC LIMIT $start_from, $per_page";
	$run_posts=mysqli_query($con,$get_posts);
	while($row_posts=mysqli_fetch_array($run_posts)){

		 $post_id=$row_posts['post_id'];
		 $user_id=$row_posts['user_id'];
		 $post_title=$row_posts['post_title'];
		 $content=$row_posts['post_content'];
		 $post_date=$row_posts['post_date'];
//getting the user who has posted the thread 
		 $user="select * from users where user_id='$user_id' AND posts='yes' ";
		 $run_user=mysqli_query($con,$user);
		 $row_user=mysqli_fetch_array($run_user);
		 $user_name=$row_user['user_name'];
		 $user_image=$row_user['user_image'];

		 //desplaying

		  echo "<div id='posts'> 
		   <p><img src='user/user_images/$user_image' width='50' height='50'> </p>
		   <h3><a href='user_profile.php?u_id=$user_id'>$user_name</h3></a>
		   <h3>$post_title</h3>
		   <p>$post_date</p>
		   <p>$content</p>
		   <a href='single.php?post_id=$post_id' style='float:right;'><button>See Replies or Relpy to This</button></a>
		   </div><br/>
		    ";
	}
	include("pagination.php");
}

//function for getting search results
function get_results(){
	global $con;
	if(isset($_GET['search'])){
		$search_term=$_GET['user_query'];
	}


	$get_posts ="select * from posts where post_title LIKE '%$search_term%' or post_content LIKE '%$search_term%' ORDER by 1 DESC LIMIT 5";
	$run_posts=mysqli_query($con,$get_posts);
	while($row_posts=mysqli_fetch_array($run_posts)){

		 $post_id=$row_posts['post_id'];
		 $user_id=$row_posts['user_id'];
		 $post_title=$row_posts['post_title'];
		 $content=$row_posts['post_content'];
		 $post_date=$row_posts['post_date'];
//getting the user who has posted the thread 
		 $user="select * from users where user_id='$user_id' AND posts='yes' ";
		 $run_user=mysqli_query($con,$user);
		 $row_user=mysqli_fetch_array($run_user);
		 $user_name=$row_user['user_name'];
		 $user_image=$row_user['user_image'];

		 //desplaying

		  echo "<div id='posts'> 
		   <p><img src='user/user_images/$user_image' width='50' height='50'> </p>
		   <h3><a href='user_profile.php?u_id=$user_id'>$user_name</h3></a>
		   <h3>$post_title</h3>
		   <p>$post_date</p>
		   <p>$content</p>
		   <a href='single.php?post_id=$post_id' style='float:right;'><button>See Replies or Relpy to This</button></a>
		   </div><br/>
		    ";
	}
}




function user_posts(){
	global $con;
	if(isset($_GET['u_id'])){
		$u_id=$_GET['u_id'];
	}
	$get_posts ="select * from posts where user_id='$u_id' ORDER by 1 DESC LIMIT 5";
	$run_posts=mysqli_query($con,$get_posts);
	while($row_posts=mysqli_fetch_array($run_posts)){

		 $post_id=$row_posts['post_id'];
		 $user_id=$row_posts['user_id'];
		 $post_title=$row_posts['post_title'];
		 $content=$row_posts['post_content'];
		 $post_date=$row_posts['post_date'];
//getting the user who has posted the thread 
		 $user="select * from users where user_id='$user_id' AND posts='yes' ";
		 $run_user=mysqli_query($con,$user);
		 $row_user=mysqli_fetch_array($run_user);
		 $user_name=$row_user['user_name'];
		 $user_image=$row_user['user_image'];

		 //desplaying

		  echo "<div id='posts'> 
		   <p><img src='user/user_images/$user_image' width='50' height='50'> </p>
		   <h3><a href='user_profile.php?user_id=$user_id'>$user_name</h3></a>
		   <h3>$post_title</h3>
		   <p>$post_date</p>
		   <p>$content</p>
		   <a href='single.php?post_id=$post_id' style='float:right;'><button>View</button></a>
		   <a href='edit_post.php?post_id=$post_id' style='float:right;'><button>Edit</button></a>
		   <a href='functions/delete_post.php?post_id=$post_id' style='float:right;'><button>Delete</button></a>
		   </div><br/>
		    ";
		    include("delete_post.php");
	}
}

function user_profile(){
	if(isset($_GET['u_id'])){
		global $con;
		$user_id=$_GET['u_id'];
		$select="select * from users where user_id='$user_id' ";
		$run=mysqli_query($con,$select);
		$row=mysqli_fetch_array($run);

		$id=$row['user_id'];
		$image=$row['user_image'];
		$name=$row['user_name'];
		$country=$row['user_country'];
		$gender=$row['user_gender'];
		$last_login=$row['last_login'];
		$register_date=$row['register_date'];

		if($gender=='Male'){
			$msg="Send him a message";
		}
		else {
			$msg="Send her a message";
		}

		echo "<div id='user_profile'>
		<img src='user/user_images/$image' width='150' height='150' /><br>
		<p><strong>Name :</strong>$name</p><br>
		<p><strong>Gender :</strong>$gender</p><br>
		<p><strong>Country :</strong>$country</p><br>
		<p><strong>Last Login :</strong>$last_login</p><br>
		<p><strong>Member Since :</strong>$register_date</p><br>
		<a href='messages.php?u_id=$id'><button>$msg</button></a><br>
		";

	}
	new_members();
	echo "</div>";
}

function new_members(){
	global $con;
	//select new memebers
	$user="select * from users LIMIT 0,20";
	$run_user=mysqli_query($con,$user);
	echo "<br><h2>New members on this site: </h2><br>";
	while($row_user=mysqli_fetch_array($run_user)){
		$user_id=$row_user['user_id'];
		$user_name=$row_user['user_name'];
		$user_image=$row_user['user_image'];

		echo "<span><a href='user_profile.php?u_id=$user_id'>
		<img src='user/user_images/$user_image' width='50px' height='50px' title='$user_name' alt='Profile Pic' style='float:left;' /></a></span>";

	}
}

?>