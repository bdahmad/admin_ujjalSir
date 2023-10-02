<?php
require_once("functions/function.php");
needLogged();
get_header();
get_sidebar();


if (!empty($_POST)) {
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $role = $_POST['role'];
  $password = md5($_POST['password']);
  $confirmPassword = md5($_POST['confirmPassword']);
  $photo = ($_FILES['photo']);
  $slug = uniqid('U');
  $photoName = '';
  if ($photo['name'] != '') {
    $photoName = 'users_' . time() . '_' . rand(100000, 100000000) . '.' . pathinfo($photo['name'], PATHINFO_EXTENSION);
  }

  $select = "SELECT * FROM `users`";
  $query = mysqli_query($con, $select);
  $data = mysqli_fetch_assoc($query);


  $insert = "INSERT INTO `users`( `user_name`, `user_phone`, `user_email`, `user_username`, `user_password`,`role_id`,`user_photo`,`user_slug`) 
  VALUES ('$name','$phone','$email','$username','$password','$role','$photoName','$slug')";


  if (!empty($name)) {
    if (!empty($email)) {
      if (!empty($username)) {
        if ($data['user_email'] === $email) {
          if (!empty($password)) {
            if (!empty($confirmPassword)) {
              if ($password === $confirmPassword) {
                if (!empty($role)) {
                  if (mysqli_query($con, $insert)) {
                    move_uploaded_file($photo['tmp_name'], 'uploads/' . $photoName);
                    echo "registration successful";
                  } else {
                    echo "registration failed";
                  }
                } else {
                  echo "please select your role.";
                }
              } else {
                echo "password not match";
              }
            } else {
              echo "enter your confirm password";
            }
          } else {
            echo "enter your password";
          }
        } else {
          echo "email already exists.";
        }
      } else {
        echo "enter your username";
      }
    } else {
      echo "enter your email";
    }
  } else {
    echo "enter your name";
  }
}

?>

<div class="row">
  <div class="col-md-12 ">
    <form method="post" action="" enctype="multipart/form-data">
      <div class="card mb-3">
        <div class="card-header">
          <div class="row">
            <div class="col-md-8 card_title_part">
              <i class="fab fa-gg-circle"></i>User Registration
            </div>
            <div class="col-md-4 card_button_part">
              <a href="all-user.php" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>All User</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Name<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control form_control" id="" name="name">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Phone:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control form_control" id="" name="phone">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Email<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <input type="email" class="form-control form_control" id="" name="email">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Username<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control form_control" id="" name="username">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Password<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <input type="password" class="form-control form_control" id="" name="password">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Confirm-Password<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <input type="password" class="form-control form_control" id="" name="confirmPassword">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">User Role<span class="req_star">*</span>:</label>
            <div class="col-sm-4">
              <select class="form-control form_control" id="" name="role">
                <option>Select Role</option>
                <?php
                $selectRole = "SELECT * FROM `roles` ORDER BY role_id ASC";
                $queryRole = mysqli_query($con, $selectRole);

                while ($roleData = mysqli_fetch_assoc($queryRole)) {
                ?>
                  <option value="<?= $roleData['role_id']; ?>"><?= $roleData['role_name']; ?></option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Photo:</label>
            <div class="col-sm-4">
              <input type="file" class="form-control form_control" id="" name="photo">
            </div>
          </div>
        </div>
        <div class="card-footer text-center">
          <button type="submit" class="btn btn-sm btn-dark">REGISTRATION</button>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
<?php
get_footer();
?>