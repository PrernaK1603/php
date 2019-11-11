<html>
<head>
	<title></title>
</head>
<body>
<table border="2px;" style="border-collapse: collapse">
	<th>Id</th>
	<th>Username</th>
	<th>Profile Pic</th>
		<?php
		  $con=mysqli_connect("localhost","root");
		  mysqli_select_db($con,"photos");
		 if(isset($_POST["submit"]))
		 {
		  	$user=$_POST['username'];
		  	$images=$_FILES['files'];
		  	print_r($user);
		  	print_r($images);
		  	$file_name=$images['name'];
		  	$file_error=$images['error'];
		  	$file_temp=$images['tmp_name'];

		  	$file_text=explode('.',$file_name);
		  	$file_check=strtolower(end($file_text));
		  	$file_ext_stored=array('png','jpeg','jpg');
            
            if(in_array($file_check,$file_ext_stored))
            {
            	$dest_file='images/'.$file_name;
            	move_uploaded_file($file_temp,$dest_file);

            	$q="INSERT INTO `image_upload`(`user`,`image`)
            	    VALUES('$user','$dest_file')";

            	$query=mysqli_query($con,$q);

            	$displayquery="select * from image_upload";
            	$querydisplay=mysqli_query($con,$displayquery);

//$rows=mysqli_num_rows($querydisplay);

                while($result=mysqli_fetch_array($querydisplay))
                {
                	?>

                	<tr>
                		<td><?php echo $result['id']?></td>
                		<td><?php echo $result['user']?></td>
                		<td><img src="<?php echo $result['image']?>"style="width:100px;
                		height:100px;"></td>
                	</tr>

                	<?php
                }

            }

		  }
		  ?>
</table>
</body>
</html>