<?php
//check if session is started already
if (session_status() === PHP_SESSION_NONE)
     session_start();
require '../../wp-content/process/octaValidate-PHP-main/src/Validate.php';

use Validate\octaValidate;
//set configuration
$options = array(
     "stripTags" => true,
     "strictMode" => true
);
//create new instance
$myForm = new octaValidate('login', $options);
//define rules for each form input name
$valRules = array(
     "username" => array(
          ["R", "Your username is required"],
     ),
     "password" => array(
          ["R", "Your password is required"],
     ),
);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     //begin validation on form fields from $_POST array
     if ($myForm->validateFields($valRules, $_POST)) {
          //Selecting a single row!//
          require '../../wp-content/process/pdo.php';
          $db = new DatabaseClass();
          $email = trim($_POST['username']);
          $password = $_POST['password'];

          if ($email == "admin@mail.com" && $password == "admin1234$") {
               $_SESSION['auth'] = true;
               $_SESSION['start'] = time();
               $_SESSION['expire'] = $_SESSION['start'] + (40 * 60);
               //? need to change the rediraction // 
               header("Location:admin/");
               exit();
          } else {
               $result = $db->SelectOne("SELECT * FROM users WHERE email = :email OR username = :email", ['email' => $email]);
               if ($result) {
                    if ($password == $result['password']) {
                         $_SESSION['auth'] = true;
                         $_SESSION['start'] = time();
                         $_SESSION['expire'] = $_SESSION['start'] + (40 * 60);
                         $_SESSION["user_id"] = $result['user_id'];
                         header("Location:new-dashboard/");
                         exit();
                    } else {
                         $errMsg = array(
                              'login' => array(
                                   'username' => 'username or password incorrect'
                              )
                         );
                         print('<script>
                    document.addEventListener("DOMContentLoaded", function(){
                         showErrors(' . json_encode($errMsg) . ');
                    });</script>');
                    }
               } else {
                    $errMsg = array(
                         'login' => array(
                              'username' => 'username or password incorrect'
                         )
                    );
                    print('<script>
                    document.addEventListener("DOMContentLoaded", function(){
                         showErrors(' . json_encode($errMsg) . ');
                    });</script>');
               }
          }
     } else {
          //return errors
          print('<script>
               document.addEventListener("DOMContentLoaded", function(){
                    showErrors(' . json_encode($myForm->getErrors()) . ');
          });</script>');
     }
}
include('header.php');
?>
<!-- inner hero start -->
<section class="inner-hero bg_img" data-background="https://creativewealth.ltd/share/assets/images/frontend/breadcrumb/63c7a2144362f1674027540.png">
     <div class="container">
          <div class="row">
               <div class="col-lg-6">
                    <h2 class="page-title">Login</h2>
               </div>
          </div>
     </div>
</section>
<!-- inner hero end -->
<div class="section-wrapper">

     <!-- account section start -->
     <div class="account-section bg_img" data-background="https://creativewealth.ltd/share/assets/images/frontend/login/63c7a50ebcf451674028302.png">
          <div class="container">
               <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-7">
                         <div class="account-card">
                              <div class="account-card__header bg_img overlay--one" data-background="https://creativewealth.ltd/share/assets/images/frontend/login/63c7a50ef15c31674028302.png">
                                   <h2 class="section-title">Welcome To <span class="base--color">DEFI Pros</span></h2>
                                   <p>Please enter your details below to log in to your account</p>
                              </div>
                              <div class="account-card__body">
                                   <form method="POST" action="" id="login" loadnovalidate class="verify-gcaptcha">
                                        <div class="form-group">
                                             <label for="username" class="form-label">Username or Email</label>
                                             <input type="text" name="username" value="<?php (isset($_POST) && isset($_POST['username'])) ? print($_POST['username']) : '' ?>" class="form-control form--control" required>
                                        </div>

                                        <div class="form-group">
                                             <div class="d-flex flex-wrap justify-content-between mb-2">
                                                  <label for="password" class="form-label mb-0">Password</label>
                                                  <a class="fw-bold forgot-pass" href="password/reset.php">
                                                       Forgot your password? </a>
                                             </div>
                                             <input id="password" type="password" class="form-control form--control" name="password" required>
                                        </div>


                                        <div class="form-group form--check">
                                             <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                             <label class="form-check-label" for="remember">
                                                  Remember Me </label>
                                        </div>

                                        <div class="form-group">
                                             <button type="submit" id="recaptcha" class="btn--base w-100">
                                                  Login </button>
                                        </div>
                                        <p class="mb-0">Don't have any account? <a href="register.php">Register</a></p>
                                   </form>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <style>
          .base--color {
               color: white;
          }

          .btn--base {
               color: var(--second_color);
               background-color: white;
               box-shadow: 0px 10px 20px 0px rgb(0 0 0 / 15%);
          }


          .btn--base:hover {
               color: var(--second_color);
               background-color: white;
          }
     </style>
     <!-- account section end -->
</div>
<?php
include('footer.php');
?>