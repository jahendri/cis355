<?php 
	
	require 'database.php';

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
			$seller_nameError = 'Please enter name';
			$valid = false;
		}
		
		if (empty($seller_email)) {
			$seller_emailError = 'Please enter email Address';
			$valid = false;
		} else if ( !filter_var($seller_email,FILTER_VALIDATE_EMAIL) ) {
			$seller_emailError = 'Please enter a valid email Address';
			$valid = false;
		}
		
		if (empty($seller_item)) {
			$seller_itemError = 'Please enter item info';
			$valid = false;
		}
		 
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO sellers (seller_name,seller_email,seller_item) values(?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($seller_name,$seller_email,$seller_item));
			Database::disconnect();
			header("Location: sellers.php");
		}
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
		    			<h3>Create a Seller</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="seller_create.php" method="post">
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
					      	<input name="seller_item" type="text"  placeholder="Item" value="<?php echo !empty($seller_item)?$seller_item:'';?>">
					      	<?php if (!empty($seller_itemError)): ?>
					      		<span class="help-inline"><?php echo $seller_itemError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn" href="sellers.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>