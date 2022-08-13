<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bee30-Web Hosting</title>
<link rel="icon" href="<?php echo base_url()?>assets/img/bee30.png">
 <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bulma.min.css">
 <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.min.css">
 <link rel="stylesheet" href="<?php echo base_url()?>assets/css/animate.min.css">
 <link rel="stylesheet" href="<?php echo base_url()?>assets/css/font-awesome.min.css">
 <link rel="stylesheet" href="<?php echo base_url()?>assets/css/style.css">


<script src="<?php echo base_url()?>assets/js/vue.min.js"></script>
<script src="<?php echo base_url()?>assets/js/vue-router.js"></script>
<script src="<?php echo base_url()?>assets/js/axios.min.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery.min.js"></script>

<script src="<?php echo base_url()?>assets/js/numeral.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>


  
</head>
<body class="bg-light">
	
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
			<a class="navbar-brand" href="dashboard"><img src="<?php echo base_url();?>assets/img/bee30.png" width="30" height="30"></a>
			<ul class="navbar-nav mr-auto">		    
				<?php
					
					if ($this->session->userdata('admin')=='1'){
						echo '<li class="nav-item"><a class="nav-link" href="host">Hosting Package</a></li>'; 
					}
					if ($this->session->userdata('admin')=='1'){
						echo '<li class="nav-item"><a class="nav-link" href="client">Client</a></li>'; 
					}
				?>						
			</ul>

			
				<form class="form-inline my-2 my-lg-0"> 					
					<li class="nav-item active"><a href="login" class="nav-link">Logout</a></li>;	
				</form>
			

	  	</nav>
	

	

