<?php
session_start();
require '../../../wp-content/process/octaValidate-PHP-main/src/Validate.php';
require('../../../wp-content/process/pdo.php');
require('../../../wp-content/process/mail.php');

$id = (isset($_GET) && isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : exit();

$db = new DatabaseClass();

use Validate\octaValidate;

$options = array(
     "stripTags" => true,
     "strictMode" => true
);

$myForm = new octaValidate('bonus', $options);
//define rules for each form input name
$valRules = array(
     "nira" => array(
          ["R", "Your username is required"],
     ),
     "amount" => array(
          ["R", "Your Email Address is required"],
          ["DIGITS", "Phone number must be digits"]
     ),
);
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
try {
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          if ($myForm->validateFields($valRules, $_POST)) {
               $result = $db->Insert(
                    "INSERT INTO bonus (userId, amount, nirration, date) VALUES (:userId, :amount, :nirration, :date)",
                    [
                         "userId" => $id,
                         "amount" => $_POST["amount"],
                         "nirration" => $_POST["nira"],
                         "date" => time()
                    ]
               );
               if ($result) {
                    $users = $db->SelectOne("SELECT * FROM users WHERE user_id = :userId", ["userId" => $id]);
                    if ($users) {
                         $balance = $users['balance'];
                         $balance = $balance + $_POST["amount"];
                         $update = $db->Update("UPDATE users SET balance = :balance WHERE user_id = :userId", ['balance' => $balance, 'userId' => $id]);
                    }
                    $amount = $_POST["amount"];
                    $subject = "Bonus Sent";
                    sendMail($users['email'], $users['username'], $subject, str_replace(["##amount##"], [$amount], file_get_contents("bonusmail.php")));
                    $_SESSION['success'] = true;
                    $_SESSION['msg'] = "Bonus added successfully";
                    //reset post array
                    header("Location: ./add-bonus.php");
                    exit();
               }
          } else {
               print('<script>
               document.addEventListener("DOMContentLoaded", function(){
                    showErrors(' . json_encode($myForm->getErrors()) .
                    ');
          });</script>');
          }
     }
} catch (Exception $e) {
     print($e);
}




require('header.php');
?>

<div class="content-inner w-100">
     <!-- Page Header-->
     <header class="bg-white shadow-sm px-4 py-3 z-index-20">
          <div class="container-fluid px-0">
               <h2 class="mb-0 p-1">Add Bonus</h2>
          </div>
     </header>
     <!-- Breadcrumb-->
     <div class="bg-white">
          <div class="container-fluid">
               <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 py-3">
                         <li class="breadcrumb-item"><a class="fw-light" href="index.html">Home</a></li>
                         <li class="breadcrumb-item active fw-light" aria-current="page">Bonus</li>
                    </ol>
               </nav>
          </div>
     </div>
     <section class="tables">
          <div class="container-fluid">
               <form class="row g-3" id="bonus" method="POST" action="" novalidate>
                    <div class="col-md-6">
                         <label for="inputEmail4" class="form-label">Niration</label>
                         <input type="text" name="nira" class="form-control">
                    </div>
                    <div class="col-md-6">
                         <label for="inputPassword4" class="form-label">amount</label>
                         <input type="number" name="amount" class="form-control">
                    </div>
                    <div class="col-12 px-auto">
                         <button class="btn btn-primary">Update</button>
                    </div>
               </form>

          </div>
     </section>
     <!-- Page Footer-->
     <?php require "footer.php" ?>
</div>
</div>
</div>
<script>
     // ------------------------------------------------------- //
     //   Inject SVG Sprite - 
     //   see more here 
     //   https://css-tricks.com/ajaxing-svg-sprite/
     // ------------------------------------------------------ //
     function injectSvgSprite(path) {

          var ajax = new XMLHttpRequest();
          ajax.open("GET", path, true);
          ajax.send();
          ajax.onload = function(e) {
               var div = document.createElement("div");
               div.className = 'd-none';
               div.innerHTML = ajax.responseText;
               document.body.insertBefore(div, document.body.childNodes[0]);
          }
     }
     // this is set to BootstrapTemple website as you cannot 
     // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
     // while using file:// protocol
     // pls don't forget to change to your domain :)
     injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg');
</script>
<!-- Place this script before the </head> tag -->
<script src="https://unpkg.com/octavalidate@1.2.5/native/validate.js"></script>
<!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<script src="../assets/octaValidate-PHP-main//frontend/helper.js"></script>
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
</body>

</html>