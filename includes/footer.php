<?php error_reporting(false)?>
<form class="form-signin" action="index.php" method="post">
			<?php 
// 			if(!isset($_GET['check'])){
// 				$counter=0;
// 			}
			
// 			if($_GET['check']=='1'){
// 				$counter++;
// 			}
			
// 			if($counter>2){?>
<!-- 				<img src="captcha.php" />	 -->
<!-- 		        <br><br> -->
<!-- 			      Enter Image Text -->
<!-- 			      <input type="text" name="captcha" id="captcha" class="form-control" placeholder="Enter Captcha"> -->
	      	<?php //}?>
	      	
	      	<?php 
      $servername = "localhost";
      $username = "root";
      $password = "secret";
      $dbname = "iicssched";
     
      $conn = new mysqli($servername, $username, $password, $dbname);
      
      $sql = "SELECT * FROM loginattempt";
      
      $result = $conn->query($sql);
      $num_rows= mysqli_num_rows($result);
      
      
      if($num_rows>=3){?>
	    <!--  <form class="form-signin" action="validate.php" method="post">-->
	        <img src="captcha.php" />	
		        <br><br>
			      <input type="text" name="captcha" id="captcha" class="form-control" placeholder="Enter Captcha">
      <?php }?>
            <label for="inputUser" class="sr-only">Username</label>
            <input type="text" name="username" id="inputUser" class="form-control" placeholder="Username" required>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me"> Remember me
              </label>
            </div>
<button class="btn btn btn-lg btn-default btn-block" type="submit">Sign in</button>
            
      </form>
      <br>
      
      
      <br>
      
          </div>
          

          <div class="mastfoot">
          
            <div class="inner">
               
            </div>
          </div>

        </div>
			
      </div>
		
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>