<?php
 	include('config/connect.php');
 	if(!$_SESSION)
 	{
 		header("location:../doc/register.php");
 	}

 		$user_id= $_SESSION["id"];
 		$check = mysqli_connect("localhost","root","",'doc_db');
 		$query = "SELECT * FROM doc_tb WHERE user_id = '$user_id'";
 		$exe = mysqli_query($check,$query);
 		if($exe)
 		{
 			$no = mysqli_num_rows($exe);
 			$page = $no/5;
 			$page = ceil($page);

 			
 			if(isset($_GET['page']))
 			{
 				$page = $_GET['page'];
	 			if($page == "" || $page=='1')
	 			{
	 				$page1=0;
	 			}
	 			else
	 			{
	 				$page1 = ($page*5)-5;

	 			}
	 			

	 		}
	 		else
	 		{
	 			$page1 = 0;
	 			
	 		}
	 		$query = mysqli_query($check,"SELECT * FROM doc_tb WHERE user_id = '$user_id' limit $page1,5");
 		}
 		
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="jquery-ui-2/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<style type="text/css">
		body {font-family: monospace;}
	</style>
</head>

<body style="background-color: #F4F7F6">

	<nav class="navbar" style="background-color: #fff">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">Doc</a>
	    </div>
	    <ul class="nav navbar-nav navbar-right"style="margin-right:10%">
	      <li class="active"><a href="#">Home</a></li>
	      <li><a href="register">Register</a></li> 
	      <li><a href="document.php">My Portal</a></li> 
	      <li style="margin-top:15px;font-size: 16px;padding:4px">Welcome <?php echo $_SESSION["firstname"]?></li> 
	    </ul>
	  </div>
	</nav>
	<div class="container">
			<div class="row">
				<div style="background-color: #0D739B;color:#fff;padding:10px">
					<h4 align="center">You can enter a new document Here..</h4>
				</div>
				<div>
				<form method="post" action="config/process.php" enctype="multipart/form-data">

					<table class="table table-bordered">
						<tr>
							<th>S/N</th>
							<th>Title</th>
							<th>Description</th>
							<th>File</th>
						</tr>
						<tr>
							<td>1</td>
							<td><input type="text" name="title" required class="form-control" placeholder="Enter Title of Document Here"></td>
							<td><input type="text" name="description" required class="form-control" placeholder="Enter Description Here"></td>
							<td><input type="file" name="file" required></td>
						</tr>
						<tr>
						<td colspan="4"><input type="submit" id="sub" name="sub" class="col-md-2 col-md-offset-4 btn btn-md" style="background-color: #0D739B;color:#fff"></td>
						</tr>
					</table>
				</form>
				</div>
			</div>	
			<hr/>
			<div class="row">
				<div>
				<div style="background-color: #0D739B;color:#fff;padding:10px">
					<h4 align="center">Here are list of your document records</h4>
				</div>
				<form enctype="multipart/form-data" method="post">
						<table class="table table-bordered" id="table">
							<tr>
								<th>S/N</th>
								<th>Title</th>
								<th>Description</th>
								<th>File</th>
								<th></th>
								<th></th>
							</tr>
							<?php
								if(isset($_GET['delete']))
								{
									$file = $_GET['delete'];
									$id = $_GET['id'];
									$delete = unlink('uploads/'.$file);
									if($delete)
									{
										$success = "The file ".$file." has been deleted successfully";
										$query = mysqli_query($check,"DELETE FROM doc_tb WHERE id= '$id'");
										header("location:document.php?success=$success");
									}
								}
								
								$count=1;
							while ($row = mysqli_fetch_array($query))
								{
									$title = $row['title'];
									$description = $row['description'];
									$file = $row['file'];
								?>
									<tr>
										<td><?php echo $count?> </td>
										<td>
											<input type="text" name="title" required class="form-control" placeholder="Enter Title of Document Here" value="<?php echo $title;?>">
										</td>
										<td>
											<input type="text" name="description" required class="form-control" placeholder="Enter Description Here" value="<?php echo $description?>">
										</td>
										<td>
											<input type="text" name="file" value="<?php echo $file;?>"
										       class="form-control">
										</td>
										<td>
										<a href="<?php echo 'uploads/'.$file?>" class="btn btn-primary fa fa-download form-control" role="button"></a>
										 </td>
										 <td>
										 	<a href="?delete=<?php echo $file;?>&id=<?php echo $row['id']; ?>" class="btn btn-danger fa fa-trash form-control" role="button"></a>
										 </td>
									</tr>
									<?php
									$count++;
								}
							?>
						</table>
						<div align="center">
							<ul class="pagination" >

								<?php
									for($count=1;$count<=$page;$count++)
						 			{
						 				?><li><a href="document.php?page=<?php echo $count;?>" style="text-decoration: none;"><?php echo $count;?></a></li><?php
						 			}
								?>
							</ul>
						</div>
					</form>
				</div>
			</div>
	</div>
	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="jquery-ui-2/jquery-ui.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript">
		$(function()
		{
			$('#table input').prop('disabled',true);
			<?php
				if(isset($_GET['success']))
				{
					$success = $_GET['success'];
					?>
						alert("<?php echo $success;?>");
						window.location.assign("document.php");
					<?php

				}
				if(isset($_GET['error']))
				{
					$error = $_GET['error'];
					?>
						alert("<?php echo $error;?>");
						window.location.assign("document.php");
					<?php

				}
			?>
		})
	</script>
</body>
</html>