<?php
require_once('app.php');
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
                    <h2 class="page-title">Referrals</h2>
               </div>
          </div>
     </div>
</section>
<!-- inner hero end -->
<div class="section-wrapper">
     <div class="cmn-section">
          <div class="container">
               <div class="card">
                    <div class="card-body">
                         <div class="col-md-12 mb-4">
                              <label>Referral Link</label>
                              <div class="input-group">
                                   <input type="text" name="text" class="form-control form--control referralURL" value="https://defiprosolutions.com/share/user/register.php?ref=<?= $username ?>" readonly>
                                   <span class="input-group-text copytext copyBoard" id="copyBoard"> <i class="fa fa-copy"></i> </span>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
<script>
     function copyText() {
          // Get the input element
          var referralURL = document.querySelector('.referralURL');

          // Select the text inside the input element
          referralURL.select();
          referralURL.setSelectionRange(0, 99999); // For mobile devices

          // Copy the selected text
          document.execCommand("copy");

          // Alert the user that the text has been copied
          alert("Copied the referral link: " + referralURL.value);
     }

     // Attach the click event listener to the copyBoard element
     document.querySelector('.copyBoard').addEventListener('click', copyText);
</script>

<?php
require('footer.php');
?>