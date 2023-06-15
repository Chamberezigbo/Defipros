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
                                   header("Location: ./statistics.php");
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
                    <h2 class="page-title">Investment Plan</h2>
               </div>
          </div>
     </div>
</section>
<!-- inner hero end -->
<div class="section-wrapper">
     <section class=" pt-60 pb-60 ">
          <div class="container">
               <div class="row justify-content-center gy-4">
                    <div class="col-md-12">
                         <div class="text-end">
                              <a href="statistics.php" class="btn btn--base">
                                   My Investments </a>
                         </div>
                    </div>
                    <?php
                    $results = $db->SelectAll("SELECT * FROM package", []);
                    if ($results && count($results)) {
                         foreach ($results as $i => $result) {
                    ?>
                              <div class="col-xl-3 col-lg-4 col-md-6">
                                   <div class="package-card text-center bg_img" data-background="https://creativewealth.ltd/share/assets/templates/bit_gold//images/bg/bg-4.png">
                                        <h4 class="package-card__title base--color mb-2"><?= $result['package_name'] ?></h4>

                                        <ul class="package-card__features mt-4">
                                             <li>Return <?php
                                                            ($result['max_return'] == 0 ? print('Unlimited') : print($result['max_return']))
                                                            ?>
                                             </li>

                                             <li>
                                                  <?= $result['duration'] ?>
                                             </li>
                                             <li>For 7 Day
                                             </li>
                                             <li>
                                                  Total 10.5%
                                                  +
                                                  <span class="badge badge--success">Capital</span>
                                             </li>
                                        </ul>
                                        <div class="package-card__range mt-5 base--color">
                                             $ <?php
                                                  ($result['min_deposit'] == 0 ? print('Unlimited') : print($result['min_deposit']))
                                                  ?>- $<?php
                                                       ($result['max_deposit'] == 0 ? print('Unlimited') : print($result['max_deposit']))
                                                       ?>
                                        </div>
                                        <form method="post" id="form_invest">
                                             <div class="mb-3">
                                                  <label for="formGroupExampleInput" class="form-label">Amount to invest: <?= $result['max_deposit'] ?></label>

                                                  <input octvalidate="R,DIGITS" name="amount_invested" type="number" class="form-control" id="inp_amount" placeholder="<?= $result['max_deposit'] ?>" required>
                                             </div>
                                             <div class="d-grid gap-2">
                                                  <input type="hidden" name="action" value="join_plan">
                                                  <input id="inp_id" octavalidate="R" name="id" type="hidden" value="<?= intval($result['id']); ?>">
                                                  <button type="submit" class="btn--base btn-md mt-4 investModal">Invest Now</button>
                                             </div>
                                        </form>
                                   </div><!-- package-card end -->
                              </div>
                    <?php }
                    }
                    ?>



               </div>
          </div>

          <style>
               .btn--base {
                    color: var(--second_color);
                    background-color: white !important;
                    box-shadow: 0px 10px 20px 0px rgb(0 0 0 / 15%);
               }

               .btn--base:hover {
                    color: var(--second_color);
                    background-color: white !important;
                    box-shadow: 0px 10px 20px 0px rgb(0 0 0 / 15%);
               }

               .base--color {
                    color: white !important;
               }

               .package-card {
                    padding: 30px;
                    border: 1px solid white;
                    background-color: var(--second_color);
                    border-radius: 8px;
                    -webkit-border-radius: 8px;
                    -moz-border-radius: 8px;
                    -ms-border-radius: 8px;
                    -o-border-radius: 8px;
                    height: 100%;
                    box-shadow: 0 0 15px hsl(var(--base)/ 0.5);
                    -webkit-transition: all 0.3s;
                    -o-transition: all 0.3s;
                    transition: all 0.3s;
               }
          </style>
     </section>


</div>

<?php
require('footer.php');
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