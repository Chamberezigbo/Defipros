<?php
session_start();


//if action is null, render the form to create a new package
$userId = (isset($_GET) && isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : null;


require('../../../wp-content/process/pdo.php');

$db = new DatabaseClass();

$msg = $success = $packages = '';
if (isset($_SESSION['success']) && isset($_SESSION['msg'])) {
     // || checks for boolean values only
     $success = $_SESSION['success'] || false;
     $msg = $_SESSION['msg'];
     //remove the session
     unset($_SESSION['success']);
     unset($_SESSION['msg']);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     try {
          $db->Insert("INSERT INTO investments (user_id, package_id, amount_invested	, date) VALUES (:userId, :packId,:amount,:date)", [
               'userId' => $userId,
               'packId' => $_POST['investmentId'],
               'amount' => $_POST['amount'],
               'date' => strtotime($_POST['date'])
          ]);

          $_SESSION['success'] = true;
          $_SESSION['msg'] = "Investment has been created";
          //reset post array
          header("Location: investment.php?id=" . $userId);
          exit();
     } catch (Exception $e) {
          var_dump($e);
          error_log($e);
          $_SESSION['success'] = false;
          $_SESSION['msg'] = "A server error has occured";
          //reset post array
          header("Location:./investment.php?id=" . $$userId);
          exit();
     }
}

require "header.php";
?>

<div class="content-inner w-100">
     <!-- Page Header-->
     <header class="bg-white shadow-sm px-4 py-3 z-index-20">
          <div class="container-fluid px-0">
               <h2 class="mb-0 p-1">Update Packages</h2>
          </div>
     </header>
     <!-- Breadcrumb-->
     <div class="bg-white">
          <div class="container-fluid">
               <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 py-3">
                         <li class="breadcrumb-item"><a class="fw-light" href="index.html">Home</a></li>
                         <li class="breadcrumb-item active fw-light" aria-current="page">Update Packages</li>
                    </ol>
               </nav>
          </div>
     </div>
     <section class="container-fluid p-3">

          <div style="max-width: 500px; margin:auto;">
               <form method="post" id="form_new_package" novalidate>
                    <div class="mb-3">
                         <label class="form-label">Investment Name</label>
                         <select class="form-select" name="investmentId" id="floatingSelect" aria-label="Floating label select example">
                              <option value="">Select One</option>
                              <?php
                              $methods = $db->SelectAll("SELECT * FROM package ", []);

                              if ($methods && count($methods)) {
                                   foreach ($methods as $i => $method) {
                              ?>
                                        <option value="<?php print($method['id']); ?>">
                                             <?php print($method['package_name']); ?>
                                        </option>
                              <?php
                                   }
                              }
                              ?>
                         </select>
                    </div>
                    <div class="mb-3">
                         <label class="form-label">Investment Amount</label>
                         <input class="form-control" type="number" name="amount" id="inp_min_deposit" octavalidate="R,DIGITS">
                    </div>
                    <div class="mb-3">
                         <label class="form-label">date</label>
                         <input class="form-control" type="date" name="date" id="inp_min_return" octavalidate="R">
                    </div>
                    <div class="mb-2">
                         <button class="btn btn-success saveInvestment">Save Package</button>
                    </div>
               </form>
          </div>
     </section>
     <!-- Page Footer-->
     <?php require 'footer.php' ?>

     <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

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