const burger = document.querySelector(".nav-burger");
const menu = document.querySelector(".nav-menu");
const nav = document.querySelector(".nav");
const toTop = document.getElementById("toTop"); // Jika 'toTop' adalah elemen yang Anda gunakan

burger.addEventListener("click", () => {
    menu.classList.toggle("active");
});

window.addEventListener("scroll", () => {
    nav.classList.toggle("active", window.scrollY > 0);

    if (window.pageYOffset > 300) {
        toTop.classList.add("active");
    } else {
        toTop.classList.remove("active");
    }
});

let prevScrollpos = window.pageYOffset;
window.addEventListener("scroll", function () {
    let currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
        nav.classList.remove("hide");
    } else {
        nav.classList.add("hide");
    }
    prevScrollpos = currentScrollPos;
});

var snippet = [].slice.call(document.querySelectorAll(".hover"));
if (snippet.length) {
    snippet.forEach(function (snippet) {
        snippet.addEventListener("mouseout", function (event) {
            if (event.target.parentNode.tagName === "figure") {
                event.target.parentNode.classList.remove("hover");
            } else {
                event.target.parentNode.classList.remove("hover");
            }
        });
    });
}

// Tambahkan event listener untuk menutup menu jika diklik di luar elemen burger atau elemen menu
document.addEventListener("click", function (event) {
    const isClickInsideBurger = burger.contains(event.target);
    const isClickInsideMenu = menu.contains(event.target);

    if (!isClickInsideBurger && !isClickInsideMenu) {
        // Tutup menu jika diklik di luar elemen burger dan menu
        menu.classList.remove("active");
    }
});
function toggleDropdown() {
    var dropdownContent = document.getElementById("dropdownContent");
    dropdownContent.style.display =
        dropdownContent.style.display === "block" ? "none" : "block";
}

// Sembunyikan dropdown saat lebar layar kurang dari 600px (mobile)
function hideDropdownOnMobile() {
    var dropdownContent = document.getElementById("dropdownContent");
    var screenWidth =
        window.innerWidth ||
        document.documentElement.clientWidth ||
        document.body.clientWidth;

    if (screenWidth < 600) {
        dropdownContent.style.display = "none";
    }
}

// Panggil fungsi hideDropdownOnMobile saat halaman dimuat
window.onload = hideDropdownOnMobile;

// Panggil fungsi hideDropdownOnMobile saat layar diubah ukurannya
window.onresize = hideDropdownOnMobile;

function toggleSearch() {
    var searchBox = document.querySelector(".search-box");
    var searchInput = document.getElementById("searchInput");
    var navBurger = document.querySelector(".nav-burger");
    var brand = document.querySelector(".brand");

    if (!searchBox.classList.contains("open")) {
        // Jika kotak pencarian belum terbuka, buka dan fokus ke input
        searchBox.classList.add("open");
        searchInput.focus();
        navBurger.classList.add("hidden"); // Sembunyikan menu desktop
        brand.classList.add("hidden"); // Sembunyikan menu desktop
    } else {
        // Jika kotak pencarian sudah terbuka, tutup dan tampilkan elemen yang disembunyikan
        searchBox.classList.remove("open");
        searchInput.value = "";
        navBurger.classList.remove("hidden"); // Tampilkan kembali menu desktop
        brand.classList.remove("hidden"); // Tampilkan kembali menu desktop
    }
}

// Tambahkan event listener untuk menangani scroll
window.addEventListener("scroll", function () {
    var searchBox = document.querySelector(".search-box");

    // Tutup kotak pencarian jika terbuka
    if (searchBox.classList.contains("open")) {
        searchBox.classList.remove("open");

        // Tampilkan kembali elemen yang disembunyikan
        var navBurger = document.querySelector(".nav-burger");
        var brand = document.querySelector(".brand");
        navBurger.classList.remove("hidden");
        brand.classList.remove("hidden");
    }
});

// Tambahkan event listener untuk menangani klik di luar kotak pencarian
document.addEventListener("click", function (event) {
    var searchBox = document.querySelector(".search-box");
    var isClickInsideSearchBox = searchBox.contains(event.target);

    // Tutup kotak pencarian jika terbuka dan klik dilakukan di luar kotak pencarian
    if (searchBox.classList.contains("open") && !isClickInsideSearchBox) {
        searchBox.classList.remove("open");

        // Tampilkan kembali elemen yang disembunyikan
        var navBurger = document.querySelector(".nav-burger");
        var brand = document.querySelector(".brand");
        navBurger.classList.remove("hidden");
        brand.classList.remove("hidden");
    }
});


// ------------------------- filter genre --------------------------------- //
function toggleListKategori() {
    const listkategori = document.getElementById('listkategori');
    if (listkategori.classList.contains('show')) {
        listkategori.classList.remove('show');
    } else {
        listkategori.classList.add('show');
    }

    event.stopPropagation();
}
document.addEventListener('click', function (e) {
    const listkategori = document.querySelectorAll('#listkategori');
    listkategori.forEach((item) => {
        item.classList.remove('show');
    });
});

//   ------------------ filter status ------------------------- //
function toggleListStatus() {
    const listkategori = document.getElementById('liststatus');
    if (listkategori.classList.contains('show')) {
        listkategori.classList.remove('show');
    } else {
        listkategori.classList.add('show');
    }

    event.stopPropagation();
}
document.addEventListener('click', function (e) {
    const listkategori = document.querySelectorAll('#liststatus');
    listkategori.forEach((item) => {
        item.classList.remove('show');
    });
});
function toggleListOrder() {
    var listorder = document.getElementById("listorder");

    listorder.classList.add('show');

    event.stopPropagation();
}

document.addEventListener('click', function (e) {
    const listorder = document.querySelectorAll('#listorder');

    listorder.forEach((item) => {
        item.classList.remove('show');
    });
});

document.addEventListener("DOMContentLoaded", function () {
    // Setelah DOM diinisialisasi, tambahkan gaya ke elemen-elemen HTML
    document.body.style.transition = "background-color 0.5s ease";
    document.querySelector(".content").style.opacity = 1;
});


// ----------------------------------------------- filter data favorit berdasarkan genre ----------------------------------- //

const genreButtons = document.querySelectorAll('#listkategori li a');

genreButtons.forEach(button => {
    button.addEventListener('click', () => {
        const selectedGenre = button.textContent;
        const storyCards = document.querySelectorAll('.container-card .card');

        storyCards.forEach(card => {
            const genre = card.querySelector('.text-judul p:nth-child(3)').textContent;

            if (genre.includes(selectedGenre)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
});
// ---------------------- overlay mega dropdown (genre menus) ------------------------- //
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


// ----------------------------------- other mega dropdown --------------------- /
document.addEventListener("DOMContentLoaded", function () {
    // Ambil elemen-elemen dropdown
    var dropdownBtns = document.querySelectorAll('.dropbtn2');
    var megaDropdown = document.querySelector('.mega-dropdown');

    // Tambahkan event listener untuk dropdown
    dropdownBtns.forEach(function (btn) {
        btn.addEventListener('mouseenter', function () {
            this.classList.toggle('active');
            var icon = this.querySelector('.fa-caret-down');
            icon.classList.toggle('fa-caret-up');
        });

        btn.addEventListener('mouseleave', function () {
            this.classList.remove('active');
            var icon = this.querySelector('.fa-caret-down');
            icon.classList.remove('fa-caret-up');
        });
    });

    // Tambahkan event listener untuk mega dropdown
    megaDropdown.addEventListener('mouseenter', function () {
        this.classList.add('show', 'rollDown');
    });

    megaDropdown.addEventListener('mouseleave', function () {
        this.classList.remove('show', 'rollDown');
        this.classList.add('rollUp');
    });
});

// ----------------------  Toggle dropdown ------------------------- //
function toggleDropdown() {
    var contentList = document.getElementById('list-mobile');
    contentList.classList.toggle('show');
}
