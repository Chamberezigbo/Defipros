<?php
require '../wp-content/process/pdo.php';
$db = new DatabaseClass();
include('header.php');
?>
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
     <section class=" pt-120 pb-120 ">
          <div class="container">
               <div class="row justify-content-center gy-4">
                    <?php
                    $results = $db->SelectAll("SELECT * FROM package", []);
                    if ($results && count($results)) {
                         foreach ($results as $i => $result) {
                    ?>
                              <div class="col-xl-3 col-lg-4 col-md-6">
                                   <div class="package-card text-center bg_img" data-background="https://creativewealth.ltd/share/assets/templates/bit_gold//images/bg/bg-4.png">
                                        <h4 class="package-card__title base--color mb-2"><?= $result['package_name'] ?></h4>

                                        <ul class="package-card__features mt-4">
                                             <li>Return 1.50%
                                             </li>

                                             <!-- <li>
                                                  Every Day
                                             </li> -->
                                             <li><?= $result['duration'] ?>
                                             </li>
                                             <li>
                                                  Total 10.5%
                                                  +
                                                  <span class="badge badge--success">Capital</span>
                                             </li>
                                        </ul>
                                        <div class="package-card__range mt-5 base--color">
                                             $<?= number_format($result['min_deposit'], 2) ?> -
                                             $<?= number_format($result['max_deposit'], 2) ?>
                                        </div>
                                        <a href="./user/register.php" class="btn--base btn-md mt-4 investModal">Invest Now</a>
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
include("footer.php");
