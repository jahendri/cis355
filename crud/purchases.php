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
    			<h3>Purchases Grid</h3>
    		</div>
			<div class="row">
				<div class="dropdown">
				  <button onclick="myFunction()" class="dropbtn">Menu</button>
				  <div id="myDropdown" class="dropdown-content">
					<a href="sellers.php">Sellers Grid</a>
					<a href="customers1.php">Customers Grid</a>
					
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

				<!--<p>
					<a href="sellers.php" class="btn">Sellers Grid</a>
				</p>
				<p>
					<a href="customers1.php" class="btn">Customers Grid</a>
				</p>
				 -->
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
		                  <th>Customer Name</th>
						  <th>Customer Purchase Type</th>
		                  <th>Seller Name</th>
		                  <th>Item </th>
		                  
		                </tr>
		              </thead>
		              <tbody>
		              <?php
					   include 'database.php';
					   $pdo = Database::connect();
					   $sql = 'SELECT * FROM customers
							   INNER JOIN sellers ';// ON customers.id = sellers.id ORDER BY customers.id' ;
					   
					   // $sql = 'SELECT seller_name, item FROM sellers';
	 				   foreach ($pdo->query($sql) as $row) {
						   		echo '<tr>';
							   	echo '<td>'. $row['name'] . '</td>';
								echo '<td>'. $row['payment'] . '</td>';
							   	echo '<td>'. $row['seller_name'] . '</td>';
								echo '<td>'. $row['seller_item'] . '</td>';
							   	
							    echo '<td width=250>';
							   	//echo '<a class="btn" href="read.php?id='.$row['id'].'">Read</a>';
							   	//echo '&nbsp;';
							   	//echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Update</a>';
							   	//echo '&nbsp;';
							   	//echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete</a>';
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