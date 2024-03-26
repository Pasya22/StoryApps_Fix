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
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


     <script>
         // Function to filter stories based on search input
         function filterStories(containerId) {
             const container = document.getElementById(containerId);
             const searchInput = document.getElementById('searchInput').value.toLowerCase();
             const stories = container.querySelectorAll('.card');

             stories.forEach(function(story) {
                 const title = story.querySelector('.text-title').textContent.toLowerCase();
                 if (title.includes(searchInput)) {
                     story.style.display = 'block';
                 } else {
                     story.style.display = 'none';
                 }
             });
         }

         // Add event listener to search input
         document.getElementById('searchInput').addEventListener('input', function() {
             filterStories('storyContainer');
             filterStories('popularStoryContainer');
             filterStories('recommendedStoryContainer');
         });
     </script>
     <script>
         document.addEventListener('DOMContentLoaded', function() {
             $('.heart-checkbox').on('change', function() {
                 var checkbox = $(this);
                 var id = checkbox.attr('data-story-id');
                 var action = checkbox.attr('data-story-action');
                 console.log(checkbox.parent('.favorite-form').serialize());

                 updateHeartStyles(checkbox);

                 checkbox.val(checkbox.prop('checked') ? '1' : '0');


                 var currentUrl = window.location
                     .href;

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
                                 currentUrl; // Arahkan kembali ke URL saat ini
                             // Add logic here to update UI based on the response (if needed)
                         } else {
                             console.error('Server error:', response.message);
                         }
                     },
                     error: function(error) {
                         Swal.fire({
                             title: 'Opps, Sabar Dulu',
                             text: 'Kamu Harus Login Dulu, jika ingin memberikan love pada cerita',
                             icon: 'info',
                             confirmButtonText: 'Tutup'
                         })

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
     <!--swiper-->
     <script>
         // ---------------------------------- sticky nav / header ------------------------ //
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
