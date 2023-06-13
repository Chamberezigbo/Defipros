<?php
include('header.php');
?>
<main id="main" class="site-main clr" role="main">



     <div id="content-wrap" class="container clr">


          <div id="primary" class="content-area clr">


               <div id="content" class="clr site-content">


                    <article class="entry clr">


                         <div class="error404-content clr">

                              <h2 class="error-title">This page could not be found!</h2>
                              <p class="error-text">We are sorry. But the page you are looking for is not available.<br />Perhaps you can try a new search.</p>

                              <form role="search" method="get" class="searchform" action="">
                                   <label for="ocean-search-form-1">
                                        <span class="screen-reader-text">Search this website</span>
                                        <input type="search" id="ocean-search-form-1" class="field" autocomplete="off" placeholder="Search" name="s">
                                   </label>
                              </form>
                              <a class="error-btn button" href="../index.php">Back To Homepage</a>

                         </div><!-- .error404-content -->


                    </article><!-- .entry -->


               </div><!-- #content -->


          </div><!-- #primary -->


     </div><!-- #content-wrap -->



</main><!-- #main -->


<?php
include('footer.php');
