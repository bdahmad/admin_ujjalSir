<?php
require_once("functions/function.php");
get_header();
get_sidebar();

$id = $_GET['e'];

$select = "SELECT * FROM `users` WHERE user_id = '$id'";
$query = mysqli_query($con, $select);
$data = mysqli_fetch_assoc($query);

if (!empty($_POST)) {
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $photo = ($_FILES['photo']);




  $update = "UPDATE `users` SET `user_name`='$name',`user_phone`='$phone',
  `user_email`='$email'  WHERE user_id = '$id'";


  if (!empty($name)) {
    if (!empty($email)) {
      if (mysqli_query($con, $update)) {
        if ($photo['name'] != '') {
          $photoName = 'users_' . time() . '_' . rand(100000, 100000000) . '.' . pathinfo($photo['name'], PATHINFO_EXTENSION);
          $uploadImg = "UPDATE users SET user_photo = '$photoName' WHERE user_id = '$id'";
          if (mysqli_query($con, $uploadImg)) {
            move_uploaded_file($photo['tmp_name'], 'uploads/' . $photoName);
            header("Location: view-user.php?v=" . $id);
          } else {
            echo "image upload failed.";
          }
        }
      } else {
        echo "Opps! update failed";
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
              <i class="fab fa-gg-circle"></i>Update User Information
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
              <input type="text" class="form-control form_control" id="" value="<?= $data['user_name']; ?>" name="name">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Phone:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control form_control" id="" name="phone" value="<?= $data['user_phone']; ?>">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Email<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <input type="email" class="form-control form_control" value="<?= $data['user_email']; ?>" id="" name="email">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Username<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control form_control" value="<?= $data['user_username']; ?>" id="" name="" disabled>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">User Role<span class="req_star">*</span>:</label>
            <div class="col-sm-4">
              <select class="form-control form_control" id="" name="role" disabled>
                <option>Select Role</option>
                <?php
                $selectRole = "SELECT * FROM `roles` ORDER BY role_id ASC";
                $queryRole = mysqli_query($con, $selectRole);

                while ($roleData = mysqli_fetch_assoc($queryRole)) {
                ?>
                  <option value="<?= $roleData['role_id']; ?>" <?php if ($roleData['role_id'] == $data['role_id']) {
                                                                  echo 'selected';
                                                                } ?>><?= $roleData['role_name']; ?></option>
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
            <div class="col-sm-2">
              <img class="img200" src="uploads/<?= $data['user_photo']; ?>" alt="">
            </div>
          </div>

        </div>
        <div class="card-footer text-center">
          <button type="submit" class="btn btn-sm btn-dark">UPDATE</button>
        </div>
      </div>
    </form>
  </div>
</div>
</div>

<?php
get_footer();
?>