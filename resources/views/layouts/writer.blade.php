<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ asset('css/writer.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lora&family=Poppins:wght@100;200;400;600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>@yield('title')</title>
</head>

<body>

    <div id="page" class="tabcontent">
        @include('partials.headerWriter.header')
        @include('partials.sidebarWriter.sidebar')
        @yield('content')

    </div>


    <script>
        function openPage(pageName, elmnt, color) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("active");
            }
            document.getElementById(pageName).style.display = "block";
            elmnt.classList.add("active");
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
        // Fungsi untuk membuka dan menutup sidebar
        function toggleSidebar() {
            var sidebar = document.querySelector(".sidebar");
            sidebar.classList.toggle("active");
        }

        // Fungsi untuk menutup sidebar saat pengguna mengklik di luar area sidebar atau konten utama
        document.addEventListener("mousedown", function(event) {
            var sidebar = document.querySelector(".sidebar");
            var navBurger = document.querySelector(".nav-burger");
            if (!sidebar.contains(event.target) && event.target !== navBurger) {
                sidebar.classList.remove("active");
            }
        });
        /* Toggle dropdown */
        function toggleDropdown(dropdownId) {
            var dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>

</html>
