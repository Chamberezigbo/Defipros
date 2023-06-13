<footer class="footer bg_img" data-background="https://creativewealth.ltd/share/assets/images/frontend/footer/63c7a4d266a4b1674028242.png">
     <div class="footer__top">
          <div class="container">
               <div class="row justify-content-center">
                    <div class="col-lg-12 text-center">
                         <!--<a href="https://creativewealth.ltd/share" class="site-logo"><img src="https://creativewealth.ltd/share/assets/images/logoIcon/logo_bit_gold.png" alt="image"></a>-->
                         <a href="index.php" class="logo"><img src="assets/images/logoIcon/logo.png" alt="images"></a>

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
                         <p class="copy-right-text">&copy; 2023 <a href="index.php" class="text--base">DEFI Pros</a>. All Rights Reserved</p>
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





<script src="assets/global/js/jquery-3.6.0.min.js"></script>
<script src="assets/global/js/bootstrap.bundle.min.js"></script>

<!-- slick slider js -->
<script src="assets/templates/bit_gold/js/vendor/slick.min.js"></script>
<script src="assets/templates/bit_gold/js/vendor/wow.min.js"></script>
<!-- dashboard custom js -->
<script src="assets/templates/bit_gold/js/app.js"></script>

<script>
     (function($) {
          "use strict"
          $('.investModal').click(function() {
               var symbol = '$';
               var currency = 'USD';
               $('.gateway-info').addClass('d-none');
               var modal = $('#investModal');
               var plan = $(this).data('plan');

               modal.find('.planName').text(plan.name)
               modal.find('[name=plan_id]').val(plan.id);
               let fixedAmount = parseFloat(plan.fixed_amount).toFixed(2);
               let minimumAmount = parseFloat(plan.minimum).toFixed(2);
               let maximumAmount = parseFloat(plan.maximum).toFixed(2);
               let interestAmount = parseFloat(plan.interest);

               if (plan.fixed_amount > 0) {
                    modal.find('.investAmountRange').text(`Invest: ${symbol}${fixedAmount}`);
                    modal.find('[name=amount]').val(fixedAmount);
                    modal.find('[name=amount]').attr('readonly', true);
               } else {
                    modal.find('.investAmountRange').text(`Invest: ${symbol}${minimumAmount} - ${symbol}${maximumAmount}`);
                    modal.find('[name=amount]').val('');
                    modal.find('[name=amount]').removeAttr('readonly');
               }

               if (plan.interest_type == '1') {
                    modal.find('.interestDetails').html(`<strong> Interest: ${interestAmount}% </strong>`);
               } else {
                    modal.find('.interestDetails').html(`<strong> Interest: ${interestAmount} ${currency}  </strong>`);
               }
               if (plan.lifetime_status == '0') {
                    modal.find('.interestValidity').html(`<strong>  Per ${plan.time} hours ,  ${plan.repeat_time} times</strong>`);
               } else {
                    modal.find('.interestValidity').html(`<strong>  Per ${plan.time} hours,  life time </strong>`);
               }

          });

          $('[name=amount]').on('input', function() {
               $('[name=wallet_type]').trigger('change');
          })

          $('[name=wallet_type]').change(function() {
               var amount = $('[name=amount]').val();
               if ($(this).val() != 'deposit_wallet' && $(this).val() != 'interest_wallet' && amount) {
                    var resource = $('select[name=wallet_type] option:selected').data('gateway');
                    var fixed_charge = parseFloat(resource.fixed_charge);
                    var percent_charge = parseFloat(resource.percent_charge);
                    var charge = parseFloat(fixed_charge + (amount * percent_charge / 100)).toFixed(2);
                    $('.charge').text(charge);
                    $('.rate').text(parseFloat(resource.rate));
                    $('.gateway-info').removeClass('d-none');
                    if (resource.currency == 'USD') {
                         $('.rate-info').addClass('d-none');
                    } else {
                         $('.rate-info').removeClass('d-none');
                    }
                    $('.method_currency').text(resource.currency);
                    $('.total').text(parseFloat(charge) + parseFloat(amount));
               } else {
                    $('.gateway-info').addClass('d-none');
               }
          });
     })(jQuery);
</script>


<link rel="stylesheet" href="assets/global/css/iziToast.min.css">
<script src="assets/global/js/iziToast.min.js"></script>

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
               $.get('plan.html', function(response) {
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

</body>

<!-- Mirrored from creativewealth.ltd/share/plan by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 11 May 2023 11:52:19 GMT -->

</html>