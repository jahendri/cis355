<?php 
	
	require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	 
	if ( null==$id ) {
		header("Location: sellers.php");
	}
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$seller_nameError = null;
		$seller_emailError = null;
		$seller_itemError = null;
		
		// keep track post values
		$seller_name = $_POST['seller_name'];
		$seller_email = $_POST['seller_email'];
		$seller_item = $_POST['seller_item'];
		
		// validate input
		$valid = true;
		if (empty($seller_name)) {
			$nameError = 'Please enter Name';
			$valid = false;
		}
		
		if (empty($seller_email)) {
			$seller_emailError = 'Please enter Email Address';
			$valid = false;
		} else if ( !filter_var($seller_email,FILTER_VALIDATE_EMAIL) ) {
			$seller_emailError = 'Please enter a valid Email Address';
			$valid = false;
		}
		
		if (empty($seller_item)) {
			$seller_itemError = 'Please enter seller_item Info';
			$valid = false;
		}
		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE sellers  set seller_name = ?, seller_email = ?, seller_item =? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($seller_name,$seller_email,$seller_item,$id));
			Database::disconnect();
			header("Location: sellers.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM sellers where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$seller_name = $data['seller_name'];
		$seller_email = $data['seller_email'];
		$seller_item = $data['seller_item'];
		Database::disconnect();
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Update a Customer</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="seller_update.php?id=<?php echo $id?>" method="post">
					  <div class="control-group <?php echo !empty($seller_nameError)?'error':'';?>">
					    <label class="control-label">Name</label>
					    <div class="controls">
					      	<input name="seller_name" type="text"  placeholder="Name" value="<?php echo !empty($seller_name)?$seller_name:'';?>">
					      	<?php if (!empty($seller_nameError)): ?>
					      		<span class="help-inline"><?php echo $seller_nameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($seller_emailError)?'error':'';?>">
					    <label class="control-label">Email Address</label>
					    <div class="controls">
					      	<input name="seller_email" type="text" placeholder="Email Address" value="<?php echo !empty($seller_email)?$seller_email:'';?>">
					      	<?php if (!empty($seller_emailError)): ?>
					      		<span class="help-inline"><?php echo $seller_emailError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($seller_itemError)?'error':'';?>">
					    <label class="control-label">Item Info</label>
					    <div class="controls">
					      	<input name="seller_item" type="text"  placeholder="seller_item" value="<?php echo !empty($seller_item)?$seller_item:'';?>">
					      	<?php if (!empty($seller_itemError)): ?>
					      		<span class="help-inline"><?php echo $seller_itemError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Update</button>
						  <a class="btn" href="customers.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>