<?php
require_once('functions/function.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Admin Panel</title>
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>

<body>
   <div class="login-page bg-light">
      <div class="container">
         <div class="row">
            <div class="col-lg-10 offset-lg-1">
               <h3 class="mb-3">Reset Password</h3>
               <div class="bg-white shadow rounded">
                  <div class="row">
                     <div class="col-md-7 pe-0">
                        <div class="form-left h-100 py-5 px-5">
                           <?php

                           $slug = $_GET['rp'];
                           $select = "SELECT * FROM `users` WHERE user_slug = '$slug'";
                           $query = mysqli_query($con, $select);
                           $data = mysqli_fetch_assoc($query);
                           $id = $data['user_id'];

                           if ($_POST) {
                              $password = md5($_POST['password']);
                              $confirmPassword = md5($_POST['confirmPassword']);

                              $update = "UPDATE `users` SET `user_password`='$password'  WHERE `user_id` = '$id'";

                              if (!empty($_POST['password']) && !empty($_POST['confirmPassword'])) {
                                 if ($password === $confirmPassword) {
                                    if (mysqli_query($con, $update)) {
                                       // echo "password changed successfully.";
                                       header('Location: login.php');
                                    } else {
                                       echo "opps! password change failed.";
                                    }
                                 } else {
                                    echo "confirm password didn't match.";
                                 }
                              } else if (empty($_POST['password'])) {
                                 echo "please enter new password.";
                              } else if (empty($_POST['confirmPassword'])) {
                                 echo "please enter confirm password.";
                              }
                           }



                           ?>
                           <form action="" method="post" class="row g-4">
                              <div class="col-12">
                                 <label>Password<span class="text-danger">*</span></label>
                                 <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                                    <input type="password" name="password" class="form-control" placeholder="Enter new Password">
                                 </div>
                              </div>

                              <div class="col-12">
                                 <label>Confirm Password<span class="text-danger">*</span></label>
                                 <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-lock"></i></div>
                                    <input type="password" name="confirmPassword" class="form-control" placeholder="Enter Confirm Password">
                                 </div>
                              </div>

                              <div class="col-12">
                                 <button type="submit" class="btn btn-primary px-4 float-end mt-4">change</button>
                              </div>
                           </form>
                        </div>
                     </div>
                     <div class="col-md-5 ps-0 d-none d-md-block">
                        <div class="form-right h-100 bg-primary text-white text-center pt-5">
                           <i class="fas fa-user-shield"></i>
                           <h2 class="fs-1">Reset Password!!!</h2>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <script src="js/bootstrap.bundle.min.js"></script>
   <script src="js/custom.js"></script>
</body>

</html>