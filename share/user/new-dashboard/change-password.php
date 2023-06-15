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

if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "updatePass") {
     $result = $db->Update(
          "UPDATE users SET password = :password WHERE user_id = :id",
          ['password' => $_POST['pass'], 'id' => $user_Id]
     );
     if ($result) {
          # code...
          $_SESSION['success'] = true;
          $_SESSION['msg'] = "Paassword Updated successfully";
          header("Location:./change-password.php");
          exit();
     } else {
          $_SESSION['success'] = true;
          $_SESSION['msg'] = "Update not successfully";
          header("Location:./change-password.php");
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
                    <h2 class="page-title">Change Password</h2>
               </div>
          </div>
     </div>
</section>
<!-- inner hero end -->
<div class="section-wrapper">
     <div class="cmn-section">
          <div class="container">
               <div class="row justify-content-center mt-4">
                    <div class="col-md-8">

                         <div class="card">
                              <div class="card-body">

                                   <form action="" method="post">
                                        <input type="hidden" name="_token" value="6urKTqqNHmfFzgjqYenXeTS7RcZeFRNJEGEQxUpu">
                                        <div class="form-group">
                                             <label class="form-label">Password</label>
                                             <input type="password" class="form-control form--control" name="pass" required autocomplete="current-password" octavalidate="R">
                                        </div>
                                        <div class="form-group">
                                             <label class="form-label">Confirm Password</label>
                                             <input type="password" class="form-control form--control" name="password_confirmation" required autocomplete="current-password" equalto="inp_pass" octavalidate="R" ov-equalto:msg="Both passwords do not match">
                                        </div>
                                        <input type="hidden" name="action" value="updatePass">
                                        <div class="form-group">
                                             <button type="submit" class="btn--base w-100">Submit</button>
                                        </div>
                                   </form>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<?php
require("footer.php");
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