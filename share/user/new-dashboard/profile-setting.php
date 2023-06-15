<?php
require_once('app.php');
$user_Id = $_SESSION['user_id'];
//success / failure error
$msg = $success = '';
if (isset($_SESSION['success']) && isset($_SESSION['msg'])) {
     // || checks for boolean values only
     $success = $_SESSION['success'] || false;
     $msg = $_SESSION['msg'];
     //remove the session
     unset($_SESSION['success']);
     unset($_SESSION['msg']);
}
if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "updateProfile") {
     $result = $db->Update(
          "UPDATE users SET first_name = :firstname, last_name = :lastname, city = :city, state = :state, zip_code = :zip ,address = :address  WHERE user_id = :id",
          [
               'firstname' => $_POST['firstname'], 'lastname' => $_POST['lastname'], 'city' => $_POST['city'],
               'state' => $_POST['state'], 'zip' => $_POST['zip'], 'address' => $_POST['address'], 'id' => $user_Id
          ]
     );
     if ($result) {
          # code...
          $_SESSION['success'] = true;
          $_SESSION['msg'] = "Update successfully";
          header("Location:./profile-setting.php");
          exit();
     } else {
          $_SESSION['success'] = true;
          $_SESSION['msg'] = "Update not successfully";
          header("Location:./profile-setting.php");
          exit();
     }
}
require('header.php');
?>

<style>
     .account-menu .icon i {
          width: 47px;
          height: 45px;
          background-color: white;
          color: black;
          display: flex;
          justify-content: center;
          align-items: center;
          border-radius: 5px;
          -webkit-border-radius: 5px;
          -moz-border-radius: 5px;
          -ms-border-radius: 5px;
          -o-border-radius: 5px;
          cursor: pointer;
          font-size: 24px;
     }

     .header .main-menu li .sub-menu {
          position: absolute;

          top: 105%;
          left: -20px;
          z-index: 9999;
          background-color: black;
          padding: 10px 0;
          -webkit-box-shadow: 0px 18px 54px -8px rgb(0 0 0 / 15%);
          box-shadow: 0px 18px 54px -8px rgb(0 0 0 / 15%);
          border-radius: 5px;
          -webkit-border-radius: 5px;
          -moz-border-radius: 5px;
          -ms-border-radius: 5px;
          -o-border-radius: 5px;
          -webkit-transition: all 0.3s;
          -o-transition: all 0.3s;
          transition: all 0.3s;
          opacity: 0;
          visibility: hidden;
          border: 1px solid #e5e5e5;
     }
</style>
</header>
<!-- header-section end  -->
<!-- inner hero start -->
<section class="inner-hero bg_img" data-background="https://creativewealth.ltd/share/assets/images/frontend/breadcrumb/63c7a2144362f1674027540.png">
     <div class="container">
          <div class="row">
               <div class="col-lg-6">
                    <h2 class="page-title">Profile Setting</h2>
               </div>
          </div>
     </div>
</section>
<!-- inner hero end -->
<div class="section-wrapper">
     <div class="cmn-section">
          <div class="container">
               <div class="row">
                    <?php
                    $results = $db->SelectAll("SELECT * FROM users WHERE user_id = :userId", ['userId' => $user_Id]);
                    if ($results && count($results)) {
                         foreach ($results as $i => $result) {
                    ?>
                              <div class="col-lg-4 mb-30">
                                   <div class="card">
                                        <div class="card-body">
                                             <h4 class="mb-2"><?= $result['first_name'] ?></h4>
                                             <ul class="list-group">

                                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                                       <span><i class="las la-user base--color"></i> Username</span> <span class="fw-bold"><?= $result['username'] ?></span>
                                                  </li>

                                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                                       <span><i class="las la-envelope base--color"></i> Email</span> <span class="fw-bold"><?= $result['email'] ?></span>
                                                  </li>

                                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                                       <span><i class="las la-phone base--color"></i> Mobile</span> <span class="fw-bold"><?= $result['phone'] ?></span>
                                                  </li>

                                                  <li class="list-group-item d-flex justify-content-between align-items-center">
                                                       <span><i class="las la-globe base--color"></i> Country</span> <span class="fw-bold"><?= $result['country'] ?></span>
                                                  </li>

                                             </ul>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-lg-8">
                                   <div class="card">
                                        <div class="card-body">
                                             <form action="" method="post">
                                                  <input type="hidden" name="_token" value="6urKTqqNHmfFzgjqYenXeTS7RcZeFRNJEGEQxUpu">
                                                  <input type="hidden" name="action" value="updateProfile">
                                                  <div class="row">
                                                       <div class="form-group col-sm-6">
                                                            <label class="form-label">First Name</label>
                                                            <input type="text" class="form-control form--control" name="firstname" value="<?= $result['first_name'] ?>" required>
                                                       </div>
                                                       <div class="form-group col-sm-6">
                                                            <label class="form-label">Last Name</label>
                                                            <input type="text" class="form-control form--control" name="lastname" value="<?= $result['last_name'] ?>" required>
                                                       </div>
                                                  </div>
                                                  <div class="row">
                                                       <div class="form-group col-sm-6">
                                                            <label class="form-label">Address</label>
                                                            <input type="text" class="form-control form--control" name="address" value="<?= $result['address'] ?>">
                                                       </div>
                                                       <div class="form-group col-sm-6">
                                                            <label class="form-label">State</label>
                                                            <input type="text" class="form-control form--control" name="state" value="<?= $result['state'] ?>">
                                                       </div>
                                                  </div>


                                                  <div class="row">
                                                       <div class="form-group col-sm-6">
                                                            <label class="form-label">Zip Code</label>
                                                            <input type="text" class="form-control form--control" name="zip" value="<?= $result['zip_code'] ?>">
                                                       </div>

                                                       <div class="form-group col-sm-6">
                                                            <label class="form-label">City</label>
                                                            <input type="text" class="form-control form--control" name="city" value="<?= $result['city'] ?>">
                                                       </div>
                                                  </div>

                                                  <div class="form-group">
                                                       <button type="submit" class="btn--base w-100">Submit</button>
                                                  </div>
                                             </form>
                                        </div>
                                   </div>
                              </div>
                    <?php
                         }
                    }
                    ?>
               </div>
          </div>
     </div>
</div>
<?php
require('footer.php')
?>
<script>
     document.addEventListener('DOMContentLoaded', function() {

          const myForm = new octaValidate('form_upd_pass')
          $('#form_upd_pass').on('submit', (e) => {
               e.preventDefault()
               if (myForm.validate()) {
                    e.currentTarget.submit()
               }
          })

          const myProfile = new octaValidate('form_upd_profile_image')
          $('#form_upd_profile_image').on('submit', (e) => {
               e.preventDefault()
               if (myProfile.validate()) {
                    e.currentTarget.submit()
               }
          })
     })
</script>

<script>
     <?php
     if (isset($success) && isset($msg)) {
          if ($success && !empty($msg)) {
     ?>
               toastr.success("<?php echo $msg; ?>")
          <?php
          } elseif (!$success && !empty($msg)) { ?>
               toastr.error("<?php echo $msg; ?>")
     <?php
          }
     }
     ?>
</script>