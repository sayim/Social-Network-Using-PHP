<?php
    $get_id=$_GET['post_id'];

	$get_com ="select * from comments where post_id='$get_id' ";
	$run_com=mysqli_query($con,$get_com);

	while($row=mysqli_fetch_array($run_com)){
		$com=$row['comment'];
		$author=$row['comment_author'];
		$date=$row['date'];

		echo "
		<div id='comments'>
		<h3>$author</h3><span><i>Said</i> on $date</span>
		<p>$com</p>
		</div>

		";
	}

	

?>