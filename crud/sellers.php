<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
	 <link   href="css/dropdown.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
    		<div class="row">
    			<h3>Sellers Grid</h3>
    		</div>
			<div class="row">
				<p> 
					<a href="seller_create.php" class="btn btn-success">Create Seller</a>
				</p>
				
				<div class="dropdown">
				  <button onclick="myFunction()" class="dropbtn">Menu</button>
				  <div id="myDropdown" class="dropdown-content">
					<a href="customers1.php">Customers Grid</a>
					<a href="purchases.php">Purchases Grid</a>
					
				  </div>
				</div>
				<script>
				function myFunction() {
					document.getElementById("myDropdown").classList.toggle("show");
				}

				// Close the dropdown menu if the user clicks outside of it
				window.onclick = function(event) {
				  if (!event.target.matches('.dropbtn')) {

					var dropdowns = document.getElementsByClassName("dropdown-content");
					var i;
					for (i = 0; i < dropdowns.length; i++) {
					  var openDropdown = dropdowns[i];
					  if (openDropdown.classList.contains('show')) {
						openDropdown.classList.remove('show');
					  }
					}
				  }
				}
				</script>
				
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
		                  <th>Name</th>
		                  <th>Email Address</th>
		                  <th>Item Selling</th>
		                  <th>Action</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
					   include 'database.php';
					   $pdo = Database::connect();
					   $sql = 'SELECT * FROM sellers ORDER BY id DESC';
	 				   foreach ($pdo->query($sql) as $row) {
						   		echo '<tr>';
							   	echo '<td>'. $row['seller_name'] . '</td>';
							   	echo '<td>'. $row['seller_email'] . '</td>';
							   	echo '<td>'. $row['seller_item'] . '</td>';
							   	echo '<td width=250>';
							   	echo '<a class="btn" href="seller_read.php?id='.$row['id'].'">Read</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-success" href="seller_update.php?id='.$row['id'].'">Update</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-danger" href="seller_delete.php?id='.$row['id'].'">Delete</a>';
							   	echo '</td>';
							   	echo '</tr>';
					   }
					   Database::disconnect();
					  ?>
				      </tbody>
	            </table>
    	</div>
    </div> <!-- /container -->
  </body>
</html>