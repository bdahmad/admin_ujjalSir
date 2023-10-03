<?php
require_once("functions/function.php");
needLogged();

   get_header();
   get_sidebar();
   
   $id = $_SESSION['id'];
   
   $select = "SELECT * FROM `users` WHERE user_id = '$id'";
   $query = mysqli_query($con, $select);
   $data = mysqli_fetch_assoc($query);


?>

<div class="row">
  <div class="col-md-12 ">
    <form method="post" action="" enctype="multipart/form-data">
      <div class="card mb-3">
        <div class="card-header">
          <div class="row">
            <div class="col-md-8 card_title_part">
              <i class="fab fa-gg-circle"></i>CHANGE PASSWORD
            </div>
          </div>
        </div>
        <?php
            if($_POST){
               $password = $data['user_password'];
               $oldPassword = md5($_POST['oldPassword']);
               $newPassword = md5($_POST['newPassword']);
               $confirmPassword = md5($_POST['confirmPassword']);

               $update = "UPDATE users SET user_password = '$newPassword'";
               

               if(!empty($_POST['oldPassword'])){
                  if(!empty($_POST['newPassword'])){  
                     if(!empty($_POST['confirmPassword'])){
                        if($newPassword == $confirmPassword){
                           if($password == $oldPassword){
                              if(mysqli_query($con,$update)){
                                 // echo "password changed successfully.";
                                 header('Location: index.php');
                              }else{
                                 echo "opps! password change failed.";
                              }

                           }else{
                              echo "old password didn't match.";
                           }
                        }else{
                           echo "confirm password didn't match.";
                        }
                     }else{
                        echo "please enter confirm password.";
                     }
                  }else{
                     echo "please enter new password.";
                  }
               }
               else{
                  echo "please enter old password.";
               }
            }
        ?>
        <div class="card-body">
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Old Password<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <input type="password" class="form-control form_control" id="" name="oldPassword">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">New Password<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <input type="password" class="form-control form_control" id="" name="newPassword">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Confirm-Password<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <input type="password" class="form-control form_control" id="" name="confirmPassword">
            </div>
          </div>
        </div>
        <div class="card-footer text-center">
          <button type="submit" class="btn btn-sm btn-dark">CHENGE</button>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
<?php
get_footer();
?>