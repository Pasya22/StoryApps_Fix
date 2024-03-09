<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/coba.css') }}"> 

</head>
<body>

    <div class="nav">
        <div class="atas">
            <div class="nav-logo">
                
            </div>

            <div class="nav-serch">
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Cari..." id="Search....">
                    <button class="search-btn"><iconify-icon icon="ic:round-search" class="search"></iconify-icon></button>
                </div>
            </div>

            <div class="div-menu">
                <div class="grub-menu">  
                    <div class="user">
                        <iconify-icon icon="mdi:user" class="icon"></iconify-icon>
                    </div>
                    <div class="keranjang">
                        <iconify-icon icon="mdi:shopping-cart" class="icon"></iconify-icon>
                    </div>
                    <div class="toggle-btn">
                        <iconify-icon icon="pixelarticons:menu" class="icon"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>    
    </div>

    <div class="menu">
        <ul class="link">
            <li><a href="">beranda</a></li>
        </ul>
        <ul class="link">
            <li><a href="">beranda</a></li>
        </ul>
        <ul class="link">
            <li><a href="">beranda</a></li>
        </ul>
        <ul class="link">
            <li><a href="">beranda</a></li>
        </ul>
    </div>

    <!-- ------------- Menu Resvonssif ---------------- -->
    <div class="nav-resvonsif">
        <div class="home">
            <iconify-icon icon="material-symbols:home" class="icon"></iconify-icon>
        </div>
        <div class="chat">
            <iconify-icon icon="humbleicons:chat" class="icon"></iconify-icon>
        </div>
        <div class="notif">
            <iconify-icon icon="iconamoon:notification-bold" class="icon"></iconify-icon>
        </div>
        <div class="setting">
            <iconify-icon icon="uil:setting" class="icon"></iconify-icon>
        </div>
        <div class="profil">
            <iconify-icon icon="mdi:user" class="icon"></iconify-icon>
        </div>
    </div>


<script>
        const toggleBtn = document.querySelector('.toggle-btn')
        const dropDownMenu = document.querySelector('.menu')

        toggleBtn.onclick = function () {
            dropDownMenu.classList.toggle('open')
            const isOpen = dropDownMenu.classList.contains('open')
        }
</script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</body>
</html>