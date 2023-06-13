<?php

require_once('app.php');

$msg = $success = '';
if (isset($_SESSION['success']) && isset($_SESSION['msg'])) {
     // || checks for boolean values only
     $success = $_SESSION['success'] || false;
     $msg = $_SESSION['msg'];
     //remove the session
     unset($_SESSION['success']);
     unset($_SESSION['msg']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pay'])) {
     try {
          //You have done some magic here ** CHAMBER **

          // //? file upload code //
          // $target_dir = "uploads/";
          // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
          // $uploadOk = 1;
          // $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
          // // Check if image file is a actual image or fake image
          // $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

          // if ($check === false) {
          //      print('<script>
          //                document.addEventListener("DOMContentLoaded", function() {
          //                toastr.error("Oops! Something went wrong try another payment method. Please try again");
          //                setTimeout(function() {
          //                          toastr.clear()
          //                     }, 5000);
          //                     })
          //           </script>');
          //      $_SESSION['error'] = 1;
          //      $_SESSION['errorMassage'] = "file is not an image";
          //      $uploadOk = 0;
          // }

          // // Check if file already exists
          // if (file_exists($target_file)) {
          //      print('<script>
          //                document.addEventListener("DOMContentLoaded", function() {
          //                toastr.error("Sorry, file already exists.");
          //                setTimeout(function() {
          //                          toastr.clear()
          //                     }, 5000);
          //                     })
          //      </script>');
          //      $uploadOk = 0;
          // }

          // // Check file size
          // if ($_FILES["fileToUpload"]["size"] > 10000000) {
          //      print('<script>
          //                document.addEventListener("DOMContentLoaded", function() {
          //                toastr.error("Sorry, your file is too large.");
          //                setTimeout(function() {
          //                          toastr.clear()
          //                     }, 5000);
          //                     })
          //           </script>');
          //      $uploadOk = 0;
          // }

          // // Allow certain file formats
          // if (
          //      $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
          //      && $imageFileType != "gif"
          // ) {
          //      print('<script>
          //                document.addEventListener("DOMContentLoaded", function() {
          //                toastr.error("Sorry, only JPG, JPEG, PNG & GIF files are allowed");
          //                setTimeout(function() {
          //                          toastr.clear()
          //                     }, 5000);
          //                     })
          //           </script>');
          //      $uploadOk = 0;
          // }
          // // Check if $uploadOk is set to 0 by an error
          // if ($uploadOk == 0) {
          //      print('<script>
          //                document.addEventListener("DOMContentLoaded", function() {
          //                toastr.error("Sorry, some files were not uploaded, try again.");
          //                setTimeout(function() {
          //                          toastr.clear()
          //                     }, 5000);
          //                     })
          //           </script>');
          //      // if everything is ok, try to upload file
          // } else {
          $target_dir = "uploads/";
          $target = $target_dir . basename($_FILES["proof_of_payment"]["name"]);
          $target_file = $_FILES["proof_of_payment"]["name"];
          $amount = $_SESSION['paymentAmount'];
          $paymentMode = $_SESSION['paymentMode'];
          $date = time();
          //check if file was uploaded
          if (!move_uploaded_file($_FILES["proof_of_payment"]["tmp_name"], $target)) {
               $_SESSION['msg'] = "File upload failed";
               $_SESSION['success'] = false;
               header("Location:./payment.php");
               exit();
          } else {
               $query =
                    "INSERT INTO deposit (user_id, amount, payment_mode, prof_image, date)
          VALUES(:user_id, :amount, :payment_mode, :prof_image, :date)";
               $data = [
                    'user_id' => $_SESSION['user_id'],
                    'amount' => $amount,
                    'payment_mode' => $paymentMode,
                    'date' => $date,
                    'prof_image' => $target_file
               ];

               $result = $db->Insert($query, $data);

               if ($result) {
                    print("<script>
                    document.addEventListener('DOMContentLoaded', function() {
                    toastr.success('file uploaded successfully');
                    setTimeout(function() {
                              toastr.clear()
                         }, 5000);
                         window.location.href='index.php';
                         })
               </script>");
               } else {
                    $_SESSION['msg'] = "Deposit not found. Please try again";
                    $_SESSION['success'] = false;
                    header("Location:./deposit.php");
                    exit();
               }
          }
     } catch (Exception $e) {
          error_log($e->getMessage());
          $_SESSION['msg'] = "A server error has occured. Try again later";
          $_SESSION['success'] = false;
          header("Location:./deposit.php");
          exit();
     }
}

include("header.php");
?>
<div class="content-inner w-100">
     <!-- Page Header-->
     <header class="bg-white shadow-sm px-4 py-3 z-index-20">
          <div class="container-fluid px-0">
               <h2 class="mb-0 p-1">Payment</h2>
          </div>
     </header>
     <!-- Breadcrumb-->
     <div class="bg-white">
          <div class="container-fluid">
               <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 py-3">
                         <li class="breadcrumb-item"><a class="fw-light" href="index.php">Home</a></li>
                         <li class="breadcrumb-item active fw-light" aria-current="page">Payment</li>
                    </ol>
               </nav>
          </div>
     </div>
     <!-- Forms Section-->
     <section class="forms">
          <div class="container-fluid">
               <div class="row">
                    <div class="card-body">
                         <div class="row">
                              <div class="col-md-8 mx-auto">
                                   <div class="card bg-light shadow-lg p-2 p-md-4">
                                        <div class="card-body">
                                             <div>
                                                  <p>You are to make payment of <strong>
                                                            <?= $_SESSION['paymentAmount'] ?>
                                                       </strong> using your selected payment method.
                                                       <br /><br />Screenshot and upload the proof of payment
                                                  </p>
                                                  <h4>
                                                       <!-- <img src="https://s2.coinmarketcap.com/static/img/coins/64x64/74.png" alt="" class="w-25"> -->
                                                       <strong class="text-dark">
                                                            <?= $_SESSION['paymentMode'] ?>
                                                       </strong>
                                                  </h4>
                                             </div>

                                             <div class="mt-5">
                                                  <h3 class="text-dark">
                                                       <strong>
                                                            <?= $_SESSION['paymentMode'] ?> Address
                                                       </strong>
                                                  </h3>
                                                  <div class="form-group">
                                                       <div class="mb-1 input-group">
                                                            <input type="text" class="form-control myInput readonly text-dark bg-light" value="<?= $_SESSION["addr"] ?>" id="myInput" readonly="">
                                                            <div class="input-group-append">
                                                                 <button class="btn btn-outline-secondary" onclick="myFunction()" type="button" id="myInput"><i class="fas fa-copy"></i></button>
                                                            </div>

                                                       </div>
                                                       <small class="text-dark"><strong>Network Type:</strong>
                                                            Erc</small>
                                                  </div>

                                             </div>
                                             <div class="mt-4">
                                                  <form method="post" id="form_confirm_payment" enctype="multipart/form-data">
                                                       <input type="hidden" name="_token" value="ZMgLCOo8sn0IbSt2nmwl672ocebXqh07tATgpH7u">
                                                       <!-- <div class="form-group">
                                                            <h5 class="text-dark">Upload Payment proof after payment.</h5>
                                                            <input type="file" name="fileToUpload" class="form-control col-lg-4 bg-light text-dark" required="">
                                                       </div> -->
                                                       <div class="form-group mb-2">
                                                            <label class="form-label">Select proof of payment</label>
                                                            <input id="inp_proof" name="proof_of_payment" type="file" class="form-control" octavalidate="R" accept-mime="image/jpeg, image/png, image/jpg" maxsize="10mb" />
                                                       </div>

                                                       <div class="form-group mt-5">
                                                            <input type="submit" name="pay" class="btn btn-dark" value="Done Paying">
                                                       </div>
                                                  </form>
                                             </div>

                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </section>
     <!-- Page Footer-->
     <?php require "footer.php" ?>
     <script>
          document.addEventListener('DOMContentLoaded', () => {
               $('#form_confirm_payment').on('submit', (e) => {
                    const myForm = new octaValidate(e.target.id, {
                         strictMode: true
                    });
                    if (myForm.validate()) {
                         e.target.submit()
                    } else {
                         e.preventDefault();
                    }
               })
          })
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