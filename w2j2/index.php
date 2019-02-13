<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="bootstrap.css">
	<link rel="stylesheet" href="datatables.css">
	<script src="jQuery.js"></script>
	<script src="bootstrap.js"></script>
	<script src="datatables.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="#">Navbar</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Features</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Pricing</a>
				</li>
				<li class="nav-item">
					<a class="nav-link disabled" href="#">Disabled</a>
				</li>
			</ul>
		</div>
		<form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
	</nav>
	
	<div class="container">
		<h3>Basic Navbar Example</h3>
		<p>A navigation bar is a navigation header that is placed at the top of the page.</p>
		
		<table id="tb" class="table table-striped table-bordered w-100">
			<thead>
				<td>no</td>
				<td>product name</td>
				<td>qty per unit</td>
				<td>price</td>
				<td>stock</td>
			</thead>
			<tbody>
			<?php
				$dat = [
					["Chai", "10 boxes x 20 bags", 18, 39],
					["Chai2", "10 boxes x 20 bags2", 182, 392]
				];
				$no = 1;
				foreach($dat as $d){
					echo "<tr>";
					echo "<td>" . $no++ . "</td>";
					echo "<td>" . $d[0] . "</td>";
					echo "<td>" . $d[1] . "</td>";
					echo "<td>" . $d[2] . "</td>";
					echo "<td>" . $d[3] . "</td>";
					echo "</tr>";
				}
			?>
			</tbody>
		</table>
	</div>

	<script>
		$(document).ready(function(){
			$('#tb').DataTable();
		})
	</script>
</body>


</html>



