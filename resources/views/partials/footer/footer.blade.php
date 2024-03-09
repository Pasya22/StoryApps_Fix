 <div class="footer">

     <footer>
         <div class="footer-col-1">
             <div class="text-1">
                 <h3>Ikuti info terbaru dari kami</h3>
             </div>
             <div class="text-1">
                 <div class="email-box">
                     <input type="text" name="" value="" placeholder="Cari Cerita Favorit Anda">
                     <button type="submit" name="button">
                         <figure>
                             <a href="#">
                                 <img src="{{ asset('/img/konten/send.svg') }}" alt="">
                             </a>
                         </figure>
                     </button>
                 </div>
             </div>
         </div>
         <div class="footer-col-2">
             <div class="text">
                 <a href="#">
                     <div class="text-3">Tentang Kami</div>
                 </a>
                 <a href="#">
                     <div class="text-3">Kebijakan Privasi</div>
                 </a>
                 <a href="#">
                     <div class="text-3">Syarat dan Ketentuan</div>
                 </a>
                 <a href="#">
                     <div class="text-3">FAQ</div>
                 </a>
             </div>
             <div class="social" style="display: flex;">
                 <a href="#"><i class="fa fa-instagram" style=""></i></a>
                 <a href="#"><i class="fa fa-facebook" style=""></i></a>
                 <a href="#"><i class="fa fa-whatsapp" style=""></i></a>
                 <a href="#"><i class="fa fa-linkedin" style=""></i></a>

             </div>
             <hr>
             <div class="text-footer">&copy;2023 CV Javawebster All Rights Reserved</div>
         </div>
     </footer>
     </body>

     </html>




     <!-- header -->
     <script src="{{ asset('js/home.js') }}"></script>
     <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


     <script>
         let lastScrollTop = 0;
         const navbar = document.getElementById("nav");

         window.addEventListener("scroll", function() {
             let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

             if (currentScroll > lastScrollTop) {
                 // Scroll down
                 navbar.classList.add("sticky");
                 document.body.classList.add("sticky-nav");
             } else {
                 // Scroll up
                 navbar.classList.remove("sticky");
                 document.body.classList.remove("sticky-nav");
             }

             lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // For Mobile or negative scrolling
         });
     </script>
     <!--swiper-->
     <script>
         document.addEventListener('DOMContentLoaded', function() {
             $('.heart-checkbox').on('change', function() {
                 var checkbox = $(this);
                 var id = checkbox.attr('data-story-id');
                 var action = checkbox.attr('data-story-action');
                 console.log(checkbox.parent('.favorite-form').serialize());
                 // Update Heart Styles
                 updateHeartStyles(checkbox);

                 // console.log(checkbox.prop('checked') ? '1' : '0');

                 // Set checkbox value based on checked status
                 checkbox.val(checkbox.prop('checked') ? '1' : '0');

                 // console.log('checkbox'. checkbox);

                 // Perform Ajax request
                 $.ajax({
                     type: 'POST',
                     url: action,
                     data: checkbox.parent('.favorite-form').serialize(),
                     dataType: 'json',
                     success: function(response) {
                         console.log(response);
                         if (response.success) {
                             console.log(response.message);
                             alert('Add The Stories To Your Favorite!');
                             window.location.href =
                                 '/';
                             // Add logic here to update UI based on the response (if needed)
                         } else {
                             console.error('Server error:', response.message);
                         }
                     },
                     error: function(error) {
                         confirm('Upami bade masihan love, kudu login hela!');
                         window.location.href =
                             '/Auth'; // Gunakan href untuk mengarahkan ke URL lengkap
                         console.error(error);
                     }
                 });
             });

             function updateHeartStyles(checkbox) {
                 var heart = checkbox.next();
                 var checkboxToHide = checkbox.next().next();

                 if (checkbox.prop('checked')) {
                     heart.addClass('checked');
                     checkboxToHide.hide(); // Hide the checkbox
                 } else {
                     heart.removeClass('checked');
                     checkboxToHide.show(); // Show the checkbox
                 }
             }
         });
     </script>

     <script>
         function list() {
             var litss = document.getElementById('listss');
             var overlay = document.getElementById('overlay');
             var iconnav = document.getElementById('iconnav');
             litss.classList.toggle('show');
             overlay.classList.toggle('show');
             iconnav.classList.toggle('show');
         }

         function hideList() {
             var listss = document.getElementById('listss');
             listss.classList.remove('show');
             var overlay = document.getElementById('overlay');
             overlay.classList.remove('show'); // Pastikan overlay disembunyikan saat daftar juga disembunyikan
         }
     </script>
     <script>
         function toggleDropdown() {
             var contentList = document.getElementById('list-mobile');
             contentList.classList.toggle('show');
         }
     </script>
     <script>
         document.addEventListener("DOMContentLoaded", function() {
             // Ambil elemen-elemen dropdown
             var dropdownBtns = document.querySelectorAll('.dropbtn2');
             var megaDropdown = document.querySelector('.mega-dropdown');

             // Tambahkan event listener untuk dropdown
             dropdownBtns.forEach(function(btn) {
                 btn.addEventListener('mouseenter', function() {
                     this.classList.toggle('active');
                     var icon = this.querySelector('.fa-caret-down');
                     icon.classList.toggle('fa-caret-up');
                 });

                 btn.addEventListener('mouseleave', function() {
                     this.classList.remove('active');
                     var icon = this.querySelector('.fa-caret-down');
                     icon.classList.remove('fa-caret-up');
                 });
             });

             // Tambahkan event listener untuk mega dropdown

         });
     </script>
