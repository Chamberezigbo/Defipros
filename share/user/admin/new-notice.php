<?php
session_start();

require('../../../wp-content/process/pdo.php');

$db = new DatabaseClass();

$users = $db->SelectAll("SELECT * FROM users", []);

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
          if (isset($_POST['message']) && !empty($_POST['message']) && isset($_POST['users']) && !empty($_POST['users'])) {
               //$_POST['users'];
               //loop through the users selected
               foreach ($_POST['users'] as $i => $user_id) {
                    //save notice to database
                    $db->Insert("INSERT INTO notice (user_id, notice) VALUES (:uid, :msg)", [
                         'uid' => $user_id,
                         'msg' => $_POST['message']
                    ]);
               }

               $_SESSION['success'] = true;
               $_SESSION['msg'] = "Notice has been created";
               //reset post array
               header("Location: ./new-notice.php");
               exit();
          }
     } catch (Exception $e) {
          error_log($e);
          $_SESSION['success'] = false;
          $_SESSION['msg'] = "A server error has occured";
          //reset post array
          header("Location: ./newsletter.php");
          exit();
     }
}


require "header.php";
?>

<div class="content-inner w-100">
     <!-- Page Header-->
     <header class="bg-white shadow-sm px-4 py-3 z-index-20">
          <div class="container-fluid px-0">
               <h2 class="mb-0 p-1">New Notice</h2>
          </div>
     </header>
     <!-- Breadcrumb-->
     <div class="bg-white">
          <div class="container-fluid">
               <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 py-3">
                         <li class="breadcrumb-item"><a class="fw-light" href="index.html">Home</a></li>
                         <li class="breadcrumb-item active fw-light" aria-current="page">Create Notice</li>
                    </ol>
               </nav>
          </div>
     </div>
     <section class="container">
          <div style="max-width: 500px; margin:auto;">
               <form method="post" id="form_new_notice">
                    <div class="mb-3">
                         <label class="form-label">Select User(s)</label>
                         <select name="users[]" class="form-control" id="inp_user" multiple>
                              <?php if ($users) : ?>
                                   <?php foreach ($users as $i => $user) {
                                   ?>
                                        <option value="<?php echo $user['user_id']; ?>"><?php echo $user['fullName']; ?></option>
                                   <?php } ?>
                              <?php else : ?>
                                   <option value="">No users found</option>
                              <?php endif; ?>
                         </select>

                    </div>
                    <div class="mb-3">
                         <label class="form-label">Type in the message</label>
                         <textarea octavalidate="R,TEXT" id="inp_msg" name="message" class="form-control" placeholder="Today is ..."></textarea>
                    </div>
                    <div class="mb-2">
                         <button class="btn btn-success">Send Notice</button>
                    </div>
               </form>
          </div>
     </section>
     <!-- Page Footer-->
     <?php require 'footer.php' ?>
</div>
</div>
</div>
<!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<script>
     document.addEventListener('DOMContentLoaded', function() {
          const myForm = new octaValidate('form_new_notice')
          $('#form_new_notice').on('submit', (e) => {
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
</body>

</html>