<?php
require_once("functions/function.php");
needLogged();
// if($_SESSION['role']==1){
get_header();
get_sidebar();

$id = $_SESSION['id'];

$select = "SELECT * FROM `users` NATURAL JOIN roles WHERE user_id = '$id'";
$query = mysqli_query($con,$select);
$data = mysqli_fetch_assoc($query);

?>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-3">
      <div class="card-header">
        <div class="row">
          <div class="col-md-8 card_title_part">
            <i class="fab fa-gg-circle"></i>MY PROFILE INFORMAITON
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <table class="table table-bordered table-striped table-hover custom_view_table">
              <tr>
                <td>Name</td>
                <td>:</td>
                <td><?= $data['user_name'];?></td>
              </tr>
              <tr>
                <td>Phone</td>
                <td>:</td>
                <td><?= $data['user_phone'];?></td>
              </tr>
              <tr>
                <td>Email</td>
                <td>:</td>
                <td><?= $data['user_email'];?></td>
              </tr>
              <tr>
                <td>Username</td>
                <td>:</td>
                <td><?= $data['user_username'];?></td>
              </tr>
              <tr>
                <td>Role</td>
                <td>:</td>
                <td><?= $data['role_name'];?></td>
              </tr>
              <tr>
                <td>Photo</td>
                <td>:</td>
                <td>
                <?php 
                if( $data['user_photo'] != ''){  
                  ?>
                  <img class="img200" src="uploads/<?= $data['user_photo']; ?>" alt="user">
                  <?php 
                }else{
                  ?>
                  <img class="img200" nsrc="images/avatar.jpg" alt="" />
                  <?php
                }
                ?>
                </td>
              </tr>
            </table>
          </div>
          <div class="col-md-2"></div>
        </div>
      </div>
      <div class="card-footer">
        <div class="btn-group" role="group" aria-label="Button group">
          <button type="button" class="btn btn-sm btn-dark">Print</button>
          <button type="button" class="btn btn-sm btn-secondary">PDF</button>
          <button type="button" class="btn btn-sm btn-dark">Excel</button>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php
get_footer();
// }else{
//   header('Location: index.php');
// }
?>