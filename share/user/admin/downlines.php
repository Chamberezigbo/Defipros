<?php
session_start();

require('../../../wp-content/process/pdo.php');
$db = new DatabaseClass();
$id = (isset($_GET) && isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : exit();

require 'header.php';
?>
<style>

</style>

<div class="content-inner w-100">
     <!-- Page Header-->
     <header class="bg-white shadow-sm px-4 py-3 z-index-20">
          <div class="container-fluid px-0">
               <h2 class="mb-0 p-1">Refer users to Equitrim Capital community</h2>
          </div>
     </header>
     <!-- Breadcrumb-->
     <div class="bg-white">
          <div class="container-fluid">
               <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 py-3">
                         <li class="breadcrumb-item"><a class="fw-light" href="index.php">Home</a></li>
                         <li class="breadcrumb-item active fw-light" aria-current="page">Refer users to Equitrim Capital community</li>
                    </ol>
               </nav>
          </div>
     </div>
     <!-- Forms Section-->
     <section class="forms">
          <div class="container-fluid">
               <div class="row">

                    <div class="mt-4 col-md-12">
                         <h2 class="title1 text-dark text-left">Your Referrals.</h2>
                         <div class="table-responsive">
                              <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                   <div class="row">
                                        <div class="col-sm-12">
                                             <table class="table UserTable table-hover text-dark dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                                  <thead>
                                                       <tr role="row">
                                                            <th class="sorting_desc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 174.359px;" aria-sort="descending" aria-label="Client name: activate to sort column ascending">Client name</th>
                                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 112.297px;" aria-label="Parent: activate to sort column ascending">Email</th>
                                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 182.438px;" aria-label="Client status: activate to sort column ascending">Client status</th>
                                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 182.438px;" aria-label="Client status: activate to sort column ascending">Refered</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       <?php
                                                       $results = $db->SelectAll("SELECT * FROM users WHERE referral = :referral", ['referral' => $id]);
                                                       if ($results && count($results)) {
                                                            foreach ($results as $i => $result) {
                                                       ?>
                                                                 <tr>
                                                                      <td><?php echo $result['fullName']; ?></td>
                                                                      <td><?php echo $result['email']; ?></td>
                                                                      <td><?php ($result['is_activated'] == 'yes' ? print('Active') : print('Inactive')) ?></td>
                                                                      <td><?php echo $result['referral']; ?></td>
                                                                 </tr>
                                                            <?php
                                                            }
                                                       } else {
                                                            ?>
                                                            <tr class="odd">
                                                                 <td valign="top" colspan="3" class="dataTables_empty text-center">No data available in table</td>
                                                            </tr>
                                                       <?php }; ?>
                                                  </tbody>
                                             </table>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </section>
     <!-- Page Footer-->
     <?php require 'footer.php'; ?>
</div>
</div>
</div>