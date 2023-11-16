 <footer class="footer bg_img" data-background="https://creativewealth.ltd/share/assets/images/frontend/footer/63c7a4d266a4b1674028242.png">
      <div class="footer__top">
           <div class="container">
                <div class="row justify-content-center">
                     <div class="col-lg-12 text-center">
                          <!--<a href="https://creativewealth.ltd/share" class="site-logo"><img src="https://creativewealth.ltd/share/assets/images/logoIcon/logo_bit_gold.png" alt="image"></a>-->
                          <a href="../index.html" class="logo"><img src="../assets/images/logoIcon/logo.png" alt="images"></a>

                          <ul class="footer-short-menu d-flex flex-wrap justify-content-center mt-3">
                          </ul>
                     </div>
                </div>
           </div>
      </div>

      <div class="footer__bottom">
           <div class="container">
                <div class="row">
                     <div class="col-md-6 text-md-left text-center">
                          <p class="copy-right-text">&copy; 2023 <a href="../index.php" class="text--base">DEFI Pros</a>. All Rights Reserved</p>
                     </div>
                     <div class="col-md-6">
                          <ul class="social-link-list d-flex flex-wrap justify-content-md-end justify-content-center">
                               <li><a href="https://facebook.com/" target="_blank"><i class="lab la-facebook-f"></i></a></li>
                               <li><a href="https://twitter.com/" target="_blank"><i class="lab la-twitter"></i></a></li>
                               <li><a href="https://www.pinterest.com/" target="_blank"><i class="fab fa-pinterest-p"></i></a></li>
                               <li><a href="https://www.linkedin.com/" target="_blank"><i class="lab la-linkedin-in"></i></a></li>
                          </ul>
                     </div>
                </div>
           </div>
      </div>

      <style>
           .scroll-to-top {
                height: 60px;
                width: 60px;
                position: fixed;
                bottom: 5%;
                right: 5%;
                display: none;
                z-index: 99999;
                cursor: pointer;
                text-align: center;
                border-radius: 50%;
                background-color: black;
                line-height: 77px;
                box-shadow: 0 5px 15px 0 rgb(0 0 0 / 25%);
           }
      </style>
 </footer>
 </div>





 <script src="../assets/global/js/jquery-3.6.0.min.js"></script>
 <script src="../assets/global/js/bootstrap.bundle.min.js"></script>

 <!-- slick slider js -->
 <script src="../assets/templates/bit_gold/js/vendor/slick.min.js"></script>
 <script src="../assets/templates/bit_gold/js/vendor/wow.min.js"></script>
 <!-- dashboard custom js -->
 <script src="../assets/templates/bit_gold/js/app.js"></script>

 <script src="../assets/global/js/secure_password.js"></script>
 <script>
      "use strict";
      (function($) {
           $(`option[data-code=US]`).attr('selected', '');
           $('select[name=country]').change(function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
           });
           $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
           $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
           $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
           $('.checkUser').on('focusout', function(e) {
                var url = 'check-mail.html';
                var value = $(this).val();
                var token = '3GubJltJUxmk1ZrdHwEyrkW8LoHANf3tvp72UG6Q';
                if ($(this).attr('name') == 'mobile') {
                     var mobile = `${$('.mobile-code').text().substr(1)}${value}`;
                     var data = {
                          mobile: mobile,
                          _token: token
                     }
                }
                if ($(this).attr('name') == 'email') {
                     var data = {
                          email: value,
                          _token: token
                     }
                }
                if ($(this).attr('name') == 'username') {
                     var data = {
                          username: value,
                          _token: token
                     }
                }
                $.post(url, data, function(response) {
                     if (response.data != false && response.type == 'email') {
                          $('#existModalCenter').modal('show');
                     } else if (response.data != false) {
                          $(`.${response.type}Exist`).text(`${response.type} already exist`);
                     } else {
                          $(`.${response.type}Exist`).text('');
                     }
                });
           });
      })(jQuery);
 </script>

 <style>
      .base--color {
           color: white !important;
      }

      .btn--base {
           color: var(--second_color);
           background-color: white;
           box-shadow: 0px 10px 20px 0px rgb(0 0 0 / 15%);
      }


      .btn--base:hover {
           color: var(--second_color);
           background-color: white;
      }
 </style>


 <link rel="stylesheet" href="../assets/global/css/iziToast.min.css">
 <script src="../assets/global/js/iziToast.min.js"></script>

 <script>
      "use strict";

      function notify(status, message) {
           iziToast[status]({
                message: message,
                position: "topRight"
           });
      }
 </script>


 <script>
      (function($) {
           "use strict";
           $(".langSel").on("change", function() {
                window.location.href = "https://creativewealth.ltd/share/change/" + $(this).val();
           });

           $('.policy').on('click', function() {
                $.get('register.php', function(response) {
                     $('.cookies-card').addClass('d-none');
                });
           });

           setTimeout(function() {
                $('.cookies-card').removeClass('hide')
           }, 2000);

           var inputElements = $('[type=text],[type=password],[type=email],[type=number],select,textarea');
           $.each(inputElements, function(index, element) {
                element = $(element);
                element.closest('.form-group').find('label').attr('for', element.attr('name'));
                element.attr('id', element.attr('name'))
           });

           $.each($('input, select, textarea'), function(i, element) {
                var elementType = $(element);
                if (elementType.attr('type') != 'checkbox') {
                     if (element.hasAttribute('required')) {
                          $(element).closest('.form-group').find('label').addClass('required');
                     }
                }
           });


           let headings = $('.table th');
           let rows = $('.table tbody tr');
           let columns
           let dataLabel;
           $.each(rows, function(index, element) {
                columns = element.children;
                if (columns.length == headings.length) {
                     $.each(columns, function(i, td) {
                          dataLabel = headings[i].innerText;
                          $(td).attr('data-label', dataLabel)
                     });
                }
           });

      })(jQuery);
 </script>

 <script src="../../wp-content/process/octaValidate-PHP-main//frontend/helper.js"></script>
 <script src="../../wp-content/process/toastr-master/build/toastr.min.js"></script>

 </body>

 <!-- Mirrored from creativewealth.ltd/share/user/register by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 11 May 2023 11:48:33 GMT -->

 </html>