 <script src="<?php echo base_url()?>assets/js/vue.min.js"></script>
<script src="<?php echo base_url()?>assets/js/axios.min.js"></script>

 <link rel="stylesheet" href="<?php echo base_url()?>assets/css/login.css">
 <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.min.css">
 
<div id="userapp"> 
    <div class="sidenav">
         <div class="login-main-text">
            <a class="navbar-brand" href="#"><img src="<?php echo base_url();?>assets/img/bee30.png" width="50" height="50"></a>
            <h3>Web Hosting Management System</h3>                      
            <span class="float-right">Ver 1.1.0 </span>
            <hr> 
                             
         </div>
      </div>

    
      <div class="main">
         <div class="col-md-6 col-sm-12">
            <div class="login-form">
              
                  <div class="form-group">
                     <label>User Name:</label>
                     <input type="text" class="form-control" placeholder="User Name" v-model="user.userName">
                  </div>
                  <div class="form-group">
                     <label>Password:</label>
                     <input type="password" class="form-control" placeholder="Password" v-model="user.password">
                  </div>
                  
                  <button class="btn btn-black" @click="userValidate">Login</button>                  
              
            </div>
         </div>
      </div>
</div>
