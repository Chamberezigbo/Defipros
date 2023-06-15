<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require '../../wp-content/process/octaValidate-PHP-main/src/Validate.php';

use Validate\octaValidate;
//set configuration
$options = array(
     "stripTags" => true,
     "strictMode" => true
);
//create new instance
$myForm = new octaValidate('user-data', $options);
//define rules for each form input name
$valRules = array(
     "firstname" => array(
          ["R", "Your OTP is required"],
          ["ALPHA_ONLY", "Only alpha-numeric characters"]
     ),
     "lastname" => array(
          ["R", "Your OTP is required"],
          ["ALPHA_ONLY", "Only alpha-numeric characters"]
     ),
     "address" => array(
          ["R", "Your OTP is required"],
          ["TEXT", "Enter a valid address"]
     ),
     "state" => array(
          ["R", "Your OTP is required"],
          ["ALPHA_ONLY", "Only alpha-numeric characters"]
     ),
     "zip" => array(
          ["R", "Your OTP is required"],
          ["TEXT", "Enter a valid zip code"]
     ),
     "city" => array(
          ["R", "Your OTP is required"],
          ["ALPHA_ONLY", "Only alpha-numeric characters"]
     ),

);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     //begin validation on form fields from $_POST array
     if ($myForm->validateFields($valRules, $_POST)) {
          require '../../wp-content/process/pdo.php';
          $db = new DatabaseClass();
          $user_Id = $_SESSION['user_id'];
          $firstN = $_POST['firstname'];
          $lastN = $_POST['lastname'];
          $address = $_POST['address'];
          $state = $_POST['state'];
          $zip = $_POST['zip'];
          $city = $_POST['city'];



          $result = $db->Update(
               "UPDATE users SET first_name = :firstN, last_name = :lastN, address = :address, state = :state, city = :city, zip_code = :zip WHERE user_id = :user",
               ['firstN' => $firstN, 'lastN' => $lastN, 'address' => $address, 'state' => $address, 'city' => $city, 'zip' => $zip,  'user' => $user_Id]
          );
          if ($result) {
               header("Location:new-dashboard/");
               die();
          } else {
               $errMsg = array(
                    'user-data' => array(
                         'zip' => 'Something went wrong'
                    )
               );
               print('<script>
                    document.addEventListener("DOMContentLoaded", function(){
                         showErrors(' . json_encode($errMsg) . ');
                    });</script>');
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
<section class="inner-hero bg_img" data-background="https://creativewealth.ltd/share/assets/images/frontend/breadcrumb/63c7a2144362f1674027540.png" style="background-image: url(&quot;https://creativewealth.ltd/share/assets/images/frontend/breadcrumb/63c7a2144362f1674027540.png&quot;);">
     <div class="container">
          <div class="row">
               <div class="col-lg-6">
                    <h2 class="page-title">User Data</h2>
               </div>
          </div>
     </div>
</section>
<!-- inner hero end -->
<div class="section-wrapper">
     <div class="pt-120 pb-120">
          <div class="container">
               <div class="row justify-content-center">
                    <div class="col-md-8">
                         <div class="card custom--card">
                              <div class="card-body">
                                   <form method="POST" action="" loadnovalidate id="user-data">
                                        <input type="hidden" name="_token" value="xK8SpdMxKMrFsHYZA2rI8beH8OAlo6gecbqBEBc3">
                                        <div class="row">
                                             <div class="form-group col-sm-6">
                                                  <label class="form-label required" for="firstname">First Name</label>
                                                  <input type="text" class="form-control form--control" name="firstname" value="" required="" id="firstname" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR4nGP6zwAAAgcBApocMXEAAAAASUVORK5CYII=&quot;);">
                                             </div>

                                             <div class="form-group col-sm-6">
                                                  <label class="form-label required" for="lastname">Last Name</label>
                                                  <input type="text" class="form-control form--control" name="lastname" value="" required="" id="lastname">
                                             </div>
                                             <div class="form-group col-sm-6">
                                                  <label class="form-label" for="address">Address</label>
                                                  <input type="text" class="form-control form--control" name="address" value="" id="address" spellcheck="false" data-ms-editor="true">
                                             </div>
                                             <div class="form-group col-sm-6">
                                                  <label class="form-label" for="state">State</label>
                                                  <input type="text" class="form-control form--control" name="state" value="" id="state" spellcheck="false" data-ms-editor="true">
                                             </div>
                                             <div class="form-group col-sm-6">
                                                  <label class="form-label" for="zip">Zip Code</label>
                                                  <input type="text" class="form-control form--control" name="zip" value="" id="zip" spellcheck="false" data-ms-editor="true">
                                             </div>

                                             <div class="form-group col-sm-6">
                                                  <label class="form-label" for="city">City</label>
                                                  <input type="text" class="form-control form--control" name="city" value="" id="city" spellcheck="false" data-ms-editor="true">
                                             </div>
                                        </div>
                                        <div class="form-group">
                                             <button type="submit" class="btn btn--base w-100">
                                                  Submit </button>
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
include('footer.php');
