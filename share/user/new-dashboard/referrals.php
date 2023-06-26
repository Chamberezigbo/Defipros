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

     .family-tree {
          display: grid;
          grid-template-columns: repeat(4, 1fr);
          grid-gap: 20px;
     }

     .person {
          display: flex;
          align-items: center;
          position: relative;
          padding-left: 40px;
     }

     .person::before {
          content: "";
          position: absolute;
          top: 0;
          left: 20px;
          border-left: 1px solid #ccc;
          height: 100%;
     }

     .person .name {
          background-color: black;
          padding: 10px 20px;
          border-radius: 4px;
          text-align: center;
          white-space: nowrap;
     }

     .person .name::after {
          content: "";
          position: absolute;
          top: calc(50% - 1px);
          left: -10px;
          border-top: 1px solid #ccc;
          width: 10px;
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
                              <div class="mt-5">
                                   <label>Referrals</label>
                                   <?php
                                   $results = $db->SelectAll("SELECT * FROM users WHERE referral = :referral", ['referral' => $username]);
                                   if ($results && count($results)) {
                                        foreach ($results as $i => $result) {
                                   ?>
                                             <div class="family-tree">
                                                  <div class="person">
                                                       <div class="name"><?php echo $result['first_name'] . ' ' . $result['last_name']; ?></div>
                                                  </div>
                                             </div>
                                        <?php
                                        }
                                   } else {
                                        ?>
                                        <label class="text-center">
                                             No data available in table
                                        </label>
                                   <?php }; ?>
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