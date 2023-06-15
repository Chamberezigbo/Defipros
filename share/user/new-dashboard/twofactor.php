<?php
require('app.php');
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

if ($_SERVER['REQUEST_METHOD'] == "POST") {

     $_SESSION['success'] = true;
     $_SESSION['msg'] = "F2F successfully";
     header("Location:./twofactor.php");
     exit();
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
                    <h2 class="page-title">2FA Setting</h2>
               </div>
          </div>
     </div>
</section>
<!-- inner hero end -->
<div class="section-wrapper">
     <div class="cmn-section">
          <div class="container">
               <div class="row justify-content-center gy-4">

                    <div class="col-md-6">
                         <div class="card custom--card">
                              <div class="card-header">
                                   <h5 class="title">Add Your Account</h5>
                              </div>

                              <div class="card-body">
                                   <h6 class="mb-3">
                                        Use the QR code or setup key on your Google Authenticator app to add your account. </h6>

                                   <div class="form-group mx-auto text-center">
                                        <img class="mx-auto" src="https://chart.googleapis.com/chart?chs=200x200&amp;chld=M|0&amp;cht=qr&amp;chl=otpauth%3A%2F%2Ftotp%2Fchamberezigbo%40Creativewealth%3Fsecret%3DNW4VWZCWKGRMNDIZ">
                                   </div>

                                   <div class="form-group">
                                        <label class="form-label">Setup Key</label>
                                        <div class="input-group">
                                             <input type="text" name="key" value="NW4VWZCWKGRMNDIZ" class="form-control form--control referralURL" readonly>
                                             <button type="button" class="input-group-text copytext" id="copyBoard"> <i class="fa fa-copy"></i> </button>
                                        </div>
                                   </div>

                                   <label><i class="fa fa-info-circle"></i> Help</label>
                                   <p>Google Authenticator is a multifactor app for mobile devices. It generates timed codes used during the 2-step verification process. To use Google Authenticator, install the Google Authenticator application on your mobile device. <a class="text--base" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en" target="_blank">Download</a></p>
                              </div>
                         </div>
                    </div>


                    <div class="col-md-6">

                         <div class="card custom--card">
                              <div class="card-header">
                                   <h5 class="title">Enable 2FA Security</h5>
                              </div>
                              <form action="" method="POST">
                                   <div class="card-body">
                                        <input type="hidden" name="_token" value="6urKTqqNHmfFzgjqYenXeTS7RcZeFRNJEGEQxUpu"> <input type="hidden" name="key" value="NW4VWZCWKGRMNDIZ">
                                        <div class="form-group">
                                             <label class="form-label">Google Authenticatior OTP</label>
                                             <input type="text" class="form-control form--control" name="code" required>
                                        </div>
                                        <button type="submit" class="btn--base w-100">Submit</button>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
     </div>

</div>
<?php
require('footer.php');
?>
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