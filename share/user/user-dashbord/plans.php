<?php
require_once('app.php');

//acc bal is sum of except 
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
     try {
          if (isset($_POST['action']) && !empty($_POST['action'])) {
               if ($_POST['action'] == "join_plan") {
                    $amount = intval($_POST['amount_invested']); //the amount invested
                    $id = intval($_POST['id']); //the package id 
                    $plan = $db->SelectOne("SELECT * FROM package WHERE id = :id", ['id' => $_POST['id']]);
                    if ($plan) {
                         //check if there's money in the person's account
                         if ($balance) {
                              //if the person has sufficient amount in wallet
                              if (intval($balance) > $amount) {
                                   //save investment
                                   $db->Insert("INSERT INTO investments (user_id, package_id, amount_invested, date) VALUES (:uid, :pid, :amt, :date)", [
                                        'uid' => $_SESSION['user_id'],
                                        'pid' => $id,
                                        'amt' => $amount,
                                        'date' => time()
                                   ]);
                                   $newBalance = intval($balance) - intval($amount);
                                   //update user's balance
                                   $db->Update("UPDATE users SET balance = :bal WHERE user_id = :uid", [
                                        'uid' => $_SESSION['user_id'],
                                        'bal' => $newBalance
                                   ]);
                                   $_SESSION['success'] = true;
                                   $_SESSION['msg'] = "Plan subscribed successfully";
                                   header("Location: ./investments.php");
                                   exit();
                              } else {
                                   //redirect to deposit
                                   $_SESSION['success'] = false;
                                   $_SESSION['msg'] = "Your account balance is too low";
                                   header("Location: ./deposit.php");
                                   exit();
                              }
                         } else {
                              //redirect to deposit
                              $_SESSION['success'] = false;
                              $_SESSION['msg'] = "Please fund your wallet";
                              header("Location: ./deposit.php");
                              exit();
                         }
                    }
               }
          }
     } catch (Exception $e) {
          var_dump($e->getMessage());
          error_log($e->getMessage());
          $_SESSION['success'] = false;
          $_SESSION['msg'] = "A server error has occured";
          header('Location: ./plans.php');
          exit();
     }
}

include("header.php");

?>
<style>
     .fs-custom {
          font-size: 13px;
     }
</style>
<div class="content-inner w-100">
     <!-- Page Header-->
     <header class="bg-white shadow-sm px-4 py-3 z-index-20">
          <div class="container-fluid px-0">
               <h2 class="mb-0 p-1">Available packages</h2>
          </div>
     </header>
     <!-- Forms Section-->
     <section class="forms">
          <div class="container-fluid">
               <div class="row">
                    <!-- Horizontal Form-->
                    <?php
                    $results = $db->SelectAll("SELECT * FROM package", []);
                    if ($results && count($results)) {
                         foreach ($results as $i => $result) {
                    ?>
                              <div class="col-lg-4">
                                   <div class="card">
                                        <div class="card-header">
                                             <div class="card-close">
                                                  <div class="dropdown">
                                                       <button class="dropdown-toggle text-sm" type="button" id="closeCard1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                                                       <div class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="closeCard1"><a class="dropdown-item py-1 px-3 remove" href="#">
                                                                 <i class="fas fa-times"></i>Close</a><a class="dropdown-item py-1 px-3 edit" href="#"> <i class="fas fa-cog"></i>Edit</a></div>
                                                  </div>
                                             </div>

                                             <h3 class="h4 mb-0"><?= $result['package_name'] ?></h3>
                                        </div>
                                        <div class="card-body">
                                             <h1 class="text-center">$ <span class="display-3">
                                                       <?php ($result['max_deposit'] == 0 ? print('Unlimited') : print(number_format($result['max_deposit']))) ?></span></h1>
                                             <div class="d-flex">
                                                  <p class="card-text fs-custom">Minimum Possible Deposit:</p>
                                                  <p class="card-text ms-auto fs-custom">$<?= number_format($result['min_deposit']) ?></p>
                                             </div>
                                             <div class="d-flex">
                                                  <p class="card-text fs-custom">Maximum Possible Deposit:</p>
                                                  <p class="card-text ms-auto fs-custom">$
                                                       <?php
                                                       ($result['max_deposit'] == 0 ? print('Unlimited') : print($result['max_deposit']))
                                                       ?>
                                                  </p>
                                             </div>
                                             <div class="d-flex">
                                                  <p class="card-text fs-custom">Minimum Return:</p>
                                                  <p class="card-text ms-auto fs-custom">$<?= number_format($result['min_return']) ?></p>
                                             </div>
                                             <div class="d-flex">
                                                  <p class="card-text fs-custom">Maximum Return:</p>
                                                  <p class="card-text ms-auto fs-custom">$
                                                       <?php
                                                       ($result['max_return'] == 0 ? print('Unlimited') : print($result['max_return']))
                                                       ?>
                                                  </p>
                                             </div>
                                             <div class="d-flex">
                                                  <p class="card-text fs-custom">Gift Bonus:</p>
                                                  <p class="card-text ms-auto fs-custom">$<?= $result['bonus'] ?></p>
                                             </div>
                                             <div class="d-flex">
                                                  <p class="card-text fs-custom">Duration:</p>
                                                  <p class="card-text ms-auto fs-custom"><?= $result['duration'] ?></p>
                                             </div>

                                             <form method="post" id="form_invest">
                                                  <div class="mb-3">
                                                       <label for="formGroupExampleInput" class="form-label">Amount to invest: (<?=
                                                                                                                                  number_format($result['max_deposit']) ?>)</label>
                                                       <input octvalidate="R,DIGITS" name="amount_invested" type="number" class="form-control" id="inp_amount" placeholder="<?= $result['max_deposit'] ?>" required>
                                                  </div>
                                                  <div class="d-grid gap-2">
                                                       <input type="hidden" name="action" value="join_plan">
                                                       <input id="inp_id" octavalidate="R" name="id" type="hidden" value="<?= intval($result['id']); ?>">
                                                       <button class="btn btn-primary" type="submit">Join Plan</button>
                                                  </div>
                                             </form>
                                        </div>


                                   </div>
                              </div>
                    <?php }
                    }
                    ?>

               </div>
          </div>
     </section>
     <!-- Page Footer-->
     <?php
     require 'footer.php'
     ?>

     <script>
          document.addEventListener('DOMContentLoaded', function() {
               const myForm = new octaValidate('form_invest')
               $('#form_invest').on('submit', (e) => {
                    e.preventDefault()
                    if (myForm.validate()) {
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
</div>
</div>
</div>