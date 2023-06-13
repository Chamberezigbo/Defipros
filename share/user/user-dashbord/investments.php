<?php
require_once('app.php');

$db = new DatabaseClass();

try{
    $investments = $db->SelectAll("SELECT * FROM investments INNER JOIN package ON package.id = investments.package_id WHERE investments.user_id = :uid",
    [
        'uid' => $_SESSION['user_id']
    ]);
}catch(Exception $e){
    error_log($e);
    $_SESSION['success'] = false;
    $_SESSION['msg'] = "A server error has occured";
    header("Location: ./index.php");
    exit();
}

// var_dump($investments);

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


include('header.php');
?>

<div class="content-inner w-100">
    <!-- Page Header-->
    <header class="bg-white shadow-sm px-4 py-3 z-index-20">
        <div class="container-fluid px-0">
            <h2 class="mb-0 p-1">Investments</h2>
        </div>
    </header>
    <!-- Breadcrumb-->
    <div class="bg-white">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 py-3">
                    <li class="breadcrumb-item"><a class="fw-light" href="index.html">Home</a></li>
                    <li class="breadcrumb-item active fw-light" aria-current="page">Investments</li>
                </ol>
            </nav>
        </div>
    </div>
    <section class="tables">
        <div class="container-fluid">
            <?php if (isset($investments) && count($investments)) { ?>
            <div class="table-responsive">
                <table class="table mb-0 table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Package name</th>
                            <th>Amount Invested</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($investments as $i => $investment) { ?>
                        <tr>
                            <th scope="row">
                                <?php echo ++$i; ?>
                            </th>
                            <td>
                                <?php print(stripslashes($investment['package_name'])) ?>
                            </td>
                            <td>
                                <?php print(stripslashes($investment['amount_invested'])) ?>
                            </td>
                            <td>
                                <?php print(date('D d M, Y', $investment['date'])) ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php } else { ?>

            <div class="text-center" style="font-size: 1.2rem;">
                <p><i class="fa-4x fas fa-exclamation-triangle text-warning"></i></p>
                <p>You have not subscribed to any plan. <br /> <a href="./plans.php">Subscribe now?</a></p>
            </div>
            <?php } ?>
        </div>
    </section>
    <!-- Page Footer-->
    <?php require_once('./footer.php'); ?>
    <script>
        <?php
        if (isset($success) && isset($msg)) {
            if ($success && !empty($msg)) {
        ?>
                    toastr.success("<?php echo $msg; ?>")
                    <?php
            } elseif(!$success && !empty($msg)) { ?>
                toastr.error("<?php echo $msg; ?>")
                <?php
            }
        }
        ?>
    </script>
</div>
</div>
</div>