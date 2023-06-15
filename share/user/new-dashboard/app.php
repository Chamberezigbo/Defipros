<?php
if (session_status() === PHP_SESSION_NONE)
     session_start();
require("../../../wp-content/process/pdo.php");
error_reporting(0);
if (!$_SESSION['auth']) {
     header('location:./logout.php');
     exit();
} else {
     $currentTime = time();
     if ($currentTime > $_SESSION['expire']) {
          session_unset();
          session_destroy();
          header('location:../login.php');
          die();
     } else {
          $db = new DatabaseClass();
          $user_Id = $_SESSION['user_id'];
          $result = $db->SelectOne("SELECT * FROM users WHERE user_id = :userId", ['userId' => $user_Id]);
          if ($result) {
               if ($result['is_activated'] == 'no') {
                    $_SESSION['otp'] = $result['otp'];
                    header('location:../authorization.php');
                    exit();
               } elseif ($result['first_name'] == NULL) {
                    header('location:../user-data.php');
                    exit();
               } else {
                    $email = $result['email'];
                    $fullName = $result['first_name'];
                    $balance = $result['balance'];
                    $username = $result['username'];
                    ($result['referral'] == NULL) ? $ref = "Null" : $ref = $result['referral'];
                    ($result['total_profit'] == NULL) ? $profit = 0 : $profit = $result['total_profit'];
                    ($result['total_inv_plans'] == NULL) ? $totalInvestment = 0 : $totalInvestment = $result['total_inv_plans'];
                    ($result['total_act_plans'] == NULL) ? $totalAccountPlan = 0 : $totalAccountPlan = $result['total_act_plans'];
                    ($result['total_deposit'] == NULL) ? $totalDeposit = 0 : $totalDeposit = $result['total_deposit'];
                    ($result['total_withdraws'] == NULL) ? $totalWithdraws = 0 : $totalWithdraws = $result['total_withdraws'];
               }
          }
          $bonusDB = $db->SelectAll("SELECT * FROM bonus WHERE userId = :uid", [
               'uid' => $user_Id
          ]);
          $bonus = 0;

          if ($bonusDB) {
               # code...
               foreach ($bonusDB as $i => $bonusRow) {
                    # code...
                    $bonus += $bonusRow['amount'];
               }
          }
          // for investment plan and profit //
          $investment = $db->SelectAll("SELECT * FROM investments WHERE user_id = :uid", ['uid' => $user_Id]);
          $numberOfInvestment = 0;
          $totalProfit = 0;

          if ($investment) {
               # code...
               foreach ($investment as $i => $investmentRow) {
                    $i++;
                    $numberOfInvestment += $i;
                    $totalProfit += $investmentRow['profit'];
               }
          }

          //get notices
          $notices = $db->SelectAll("SELECT * FROM notice WHERE user_id = :uid", [
               'uid' => $user_Id
          ]);
          //notices count
          $notices_count = ($notices && count($notices)) ? count($notices) : 0;
     }
}
