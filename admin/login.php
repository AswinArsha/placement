<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin | Recruitment Management System</title>
 	

<?php include('./header.php'); ?>
<?php include('./db_connect.php'); ?>
<?php 
session_start();
ob_start();
$query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
 foreach ($query as $key => $value) {
  if(!is_numeric($key))
	$_SESSION['setting_'.$key] = $value;
}
ob_end_flush();
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>

</head>


<style>
	body {
		margin: 0;
		padding: 0;
		height: 100vh;
		display: flex;
		align-items: center;
		justify-content: center;
		background-color: #343a40;
	}

	.card {
		width: 400px;
	}

	.logo {
		margin: auto;
		background: white;
		border-radius: 50% 50%;
		color: #000000b3;
		z-index: 10;
		width: 100px;
		height: 100px;
		border: 1px solid;
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.logo > img {
		transform: scale(3.5);
		object-fit: cover;
	}
</style>

<body>
	<main id="main">
		<div class="card">
			<div class="card-body">
				<div class="logo">
					<img src="./assets/img/recruitment-logo.jpg" alt="">
				</div>
				<form id="login-form">
					<div class="form-group">
						<label for="username" class="control-label">Username</label>
						<input type="text" id="username" name="username" class="form-control">
					</div>
					<div class="form-group">
						<label for="password" class="control-label">Password</label>
						<input type="password" id="password" name="password" class="form-control">
					</div>
					<center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button></center>
				</form>
			</div>
		</div>
	</main>
</body>


  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
<script>
	$('#login-form').submit(function(e){
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='index.php?page=home';
				}else if(resp == 2){
					location.href ='voting.php';
				}else{
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>	
</html>