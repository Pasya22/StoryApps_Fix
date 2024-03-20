
const burger = document.querySelector('.nav-burger');
const menu = document.querySelector('.nav-menu');
// const nav = document.querySelector('.nav');
const toTop = document.getElementById('toTop'); // Jika 'toTop' adalah elemen yang Anda gunakan

burger.addEventListener('click', () => {
    menu.classList.toggle('active');
});

// window.addEventListener('scroll', () => {
//     nav.classList.toggle('active', window.scrollY > 0);

//     if (window.pageYOffset > 300) {
//         toTop.classList.add('active');
//     } else {
//         toTop.classList.remove('active');
//     }
// });

let prevScrollpos = window.pageYOffset;
window.addEventListener('scroll', function () {
    let currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
        nav.classList.remove('hide');
    } else {
        nav.classList.add('hide');
    }
    prevScrollpos = currentScrollPos;
});

var snippet = [].slice.call(document.querySelectorAll('.hover'));
if (snippet.length) {
    snippet.forEach(function (snippet) {
        snippet.addEventListener('mouseout', function (event) {
            if (event.target.parentNode.tagName === 'figure') {
                event.target.parentNode.classList.remove('hover');
            } else {
                event.target.parentNode.classList.remove('hover');
            }
        });
    });
}

// Tambahkan event listener untuk menutup menu jika diklik di luar elemen burger atau elemen menu
document.addEventListener('click', function (event) {
    const isClickInsideBurger = burger.contains(event.target);
    const isClickInsideMenu = menu.contains(event.target);

    if (!isClickInsideBurger && !isClickInsideMenu) {
        // Tutup menu jika diklik di luar elemen burger dan menu
        menu.classList.remove('active');
    }
});
function toggleDropdown() {
    var dropdownContent = document.getElementById('dropdownContent');
    dropdownContent.style.display = (dropdownContent.style.display === 'block') ? 'none' : 'block';
}

// Sembunyikan dropdown saat lebar layar kurang dari 600px (mobile)
function hideDropdownOnMobile() {
    var dropdownContent = document.getElementById('dropdownContent');
    var screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

    if (screenWidth < 600) {
        dropdownContent.style.display = 'none';
    }
}

// Panggil fungsi hideDropdownOnMobile saat halaman dimuat
window.onload = hideDropdownOnMobile;

// Panggil fungsi hideDropdownOnMobile saat layar diubah ukurannya
window.onresize = hideDropdownOnMobile;



// scrool cerirta lainnya
document.addEventListener('DOMContentLoaded', function () {
    const container = document.querySelector('.scroll-container');
    const categoryContainer = document.querySelector('.grub-card');
    const scrollAmount = 240; // Sesuaikan dengan jumlah scroll yang diinginkan

    document.querySelector('.scroll-button.left').addEventListener('click', function () {
        categoryContainer.scrollLeft -= scrollAmount;
    });

    document.querySelector('.scroll-button.right').addEventListener('click', function () {
        categoryContainer.scrollLeft += scrollAmount;
    });
});




// -------------------- coba search

function toggleSearch() {
    var searchBox = document.querySelector('.search-box');
    var searchInput = document.getElementById('searchInput');
    var navBurger = document.querySelector('.nav-burger');
    var brand = document.querySelector('.brand');

    if (!searchBox.classList.contains('open')) {
        // Jika kotak pencarian belum terbuka, buka dan fokus ke input
        searchBox.classList.add('open');
        searchInput.focus();
        navBurger.classList.add('hidden'); // Sembunyikan menu desktop
        brand.classList.add('hidden'); // Sembunyikan menu desktop
    } else {
        // Jika kotak pencarian sudah terbuka, tutup dan tampilkan elemen yang disembunyikan
        searchBox.classList.remove('open');
        searchInput.value = '';
        navBurger.classList.remove('hidden'); // Tampilkan kembali menu desktop
        brand.classList.remove('hidden'); // Tampilkan kembali menu desktop
    }
}

// Tambahkan event listener untuk menangani scroll
window.addEventListener('scroll', function () {
    var searchBox = document.querySelector('.search-box');

    // Tutup kotak pencarian jika terbuka
    if (searchBox.classList.contains('open')) {
        searchBox.classList.remove('open');

        // Tampilkan kembali elemen yang disembunyikan
        var navBurger = document.querySelector('.nav-burger');
        var brand = document.querySelector('.brand');
        navBurger.classList.remove('hidden');
        brand.classList.remove('hidden');
    }
});

// Tambahkan event listener untuk menangani klik di luar kotak pencarian
document.addEventListener('click', function (event) {
    var searchBox = document.querySelector('.search-box');
    var isClickInsideSearchBox = searchBox.contains(event.target);

    // Tutup kotak pencarian jika terbuka dan klik dilakukan di luar kotak pencarian
    if (searchBox.classList.contains('open') && !isClickInsideSearchBox) {
        searchBox.classList.remove('open');

        // Tampilkan kembali elemen yang disembunyikan
        var navBurger = document.querySelector('.nav-burger');
        var brand = document.querySelector('.brand');
        navBurger.classList.remove('hidden');
        brand.classList.remove('hidden');
    }
});




























// ----------------------- share




const toggleBtn = document.querySelector('.bagikan-detail');
const dropDownMenu = document.querySelector('.card-share');

function toggleCard(event) {
    dropDownMenu.classList.toggle('open');
    const isOpen = dropDownMenu.classList.contains('open');

    if (isOpen) {
        document.addEventListener('click', outsideClickListener);
        // Tambah event listener untuk menangani scroll
        window.addEventListener('scroll', scrollListener);
    } else {
        document.removeEventListener('click', outsideClickListener);
        // Hapus event listener scroll ketika elemen .card-share ditutup
        window.removeEventListener('scroll', scrollListener);
    }

    event.stopPropagation();
}

function outsideClickListener(event) {
    if (!dropDownMenu.contains(event.target) && !toggleBtn.contains(event.target)) {
        dropDownMenu.classList.remove('open');
        document.removeEventListener('click', outsideClickListener);
        // Hapus event listener scroll ketika elemen .card-share ditutup
        window.removeEventListener('scroll', scrollListener);
    }
}

function scrollListener() {
    // Handler untuk menutup dropdown ketika halaman di-scroll
    dropDownMenu.classList.remove('open');
    document.removeEventListener('click', outsideClickListener);
    // Hapus event listener scroll ketika elemen .card-share ditutup
    window.removeEventListener('scroll', scrollListener);
}

toggleBtn.onclick = toggleCard;







//   ------------------ javascript  share 2 ---------------------


const toggleBtns = document.querySelectorAll('.dropdown2');
const dropdowns = document.querySelectorAll('.card-share2');

toggleBtns.forEach((toggleBtn, index) => {
    toggleBtn.onclick = (event) => toggleCard2(event, index);
});

function toggleCard2(event, index) {
    // Menutup semua dropdown yang terbuka
    closeAllDropdowns();

    // Membuka dropdown yang sesuai dengan indeks yang diberikan
    dropdowns[index].classList.toggle('open');
    const isOpen = dropdowns[index].classList.contains('open');

    if (isOpen) {
        document.addEventListener('click', outsideClickListener2);
        // Tambah event listener untuk menangani scroll
        window.addEventListener('scroll', scrollListener2);
    } else {
        document.removeEventListener('click', outsideClickListener2);
        // Hapus event listener scroll ketika elemen .card-share ditutup
        window.removeEventListener('scroll', scrollListener2);
    }

    event.stopPropagation();
}

function outsideClickListener2(event) {
    dropdowns.forEach((dropdown, index) => {
        if (!dropdown.contains(event.target) && !toggleBtns[index].contains(event.target)) {
            dropdown.classList.remove('open');
            document.removeEventListener('click', outsideClickListener2);
            // Hapus event listener scroll ketika elemen .card-share ditutup
            window.removeEventListener('scroll', scrollListener2);
        }
    });
}

function scrollListener2() {
    // Handler untuk menutup dropdown ketika halaman di-scroll
    closeAllDropdowns();
}

function closeAllDropdowns() {
    dropdowns.forEach((dropdown) => {
        dropdown.classList.remove('open');
    });
    document.removeEventListener('click', outsideClickListener2);
    // Hapus event listener scroll ketika elemen .card-share ditutup
    window.removeEventListener('scroll', scrollListener2);
}






// ----------------------------------------------- card share 3 - ------------------------------------------

// Fungsi untuk bagian desktop
function handleDesktopDropdowns() {
    const toggleBtns3 = document.querySelectorAll('.dropdown3');
    const dropdowns3 = document.querySelectorAll('.card-share3');
    let openIndex = -1;

    toggleBtns3.forEach((toggleBtn, index) => {
        toggleBtn.onclick = (event) => toggleCard3(event, index);
    });

    function toggleCard3(event, index) {
        const isOpen = index === openIndex;

        if (openIndex !== -1 && !isOpen) {
            dropdowns3[openIndex].classList.remove('open');
        }

        if (!isOpen) {
            dropdowns3[index].classList.add('open');
            openIndex = index;
            document.addEventListener('click', createOutsideClickListener(index));
            document.addEventListener('scroll', createScrollListener(index));
            const scrollContainers = document.querySelectorAll('.scroll-container');
            scrollContainers.forEach((scrollContainer) => {
                scrollContainer.addEventListener('scroll', createScrollListener(index));
                scrollContainer.addEventListener('touchmove', createTouchMoveListener(index));
            });
        } else {
            dropdowns3[index].classList.remove('open');
            openIndex = -1;
            document.removeEventListener('click', createOutsideClickListener(index));
            document.removeEventListener('scroll', createScrollListener(index));
            const scrollContainers = document.querySelectorAll('.scroll-container');
            scrollContainers.forEach((scrollContainer) => {
                scrollContainer.removeEventListener('scroll', createScrollListener(index));
                scrollContainer.removeEventListener('touchmove', createTouchMoveListener(index));
            });
        }

        event.stopPropagation();
    }

    function createOutsideClickListener(index) {
        return function (event) {
            const dropdown = dropdowns3[index];
            if (!dropdown.contains(event.target) && !event.target.classList.contains('dropdown3')) {
                dropdown.classList.remove('open');
                openIndex = -1;
                document.removeEventListener('click', createOutsideClickListener(index));
                document.removeEventListener('scroll', createScrollListener(index));
                const scrollContainers = document.querySelectorAll('.scroll-container');
                scrollContainers.forEach((scrollContainer) => {
                    scrollContainer.removeEventListener('scroll', createScrollListener(index));
                    scrollContainer.removeEventListener('touchmove', createTouchMoveListener(index));
                });
            }
        };
    }

    function createScrollListener(index) {
        return function (event) {
            const dropdown = dropdowns3[index];
            dropdown.classList.remove('open');
            openIndex = -1;
            document.removeEventListener('click', createOutsideClickListener(index));
            document.removeEventListener('scroll', createScrollListener(index));
            const scrollContainers = document.querySelectorAll('.scroll-container');
            scrollContainers.forEach((scrollContainer) => {
                scrollContainer.removeEventListener('scroll', createScrollListener(index));
                scrollContainer.removeEventListener('touchmove', createTouchMoveListener(index));
            });
        };
    }

    function createTouchMoveListener(index) {
        return function () {
            const dropdown = dropdowns3[index];
            dropdown.classList.remove('open');
            openIndex = -1;
        };
    }
}


//  ------------------------------ Fungsi untuk bagian mobile -------------------------------
function handleMobileDropdowns() {
    const toggleMobile = document.querySelectorAll('.dropdown4');
    const dropdownsMobile = document.querySelectorAll('.card-share4');
    let openIndex2 = -1;

    toggleMobile.forEach((toggleBtn, index) => {
        toggleBtn.onclick = (event) => toggleCard4(event, index);
    });

    function toggleCard4(event, index) {
        const isOpen = index === openIndex2;

        if (openIndex2 !== -1 && !isOpen) {
            dropdownsMobile[openIndex2].classList.remove('open');
        }

        if (!isOpen) {
            dropdownsMobile[index].classList.add('open');
            openIndex2 = index;
            document.addEventListener('click', createOutsideClickListener(index));
            document.addEventListener('scroll', createScrollListener(index));
            const scrollContainers = document.querySelectorAll('.scroll-container');
            scrollContainers.forEach((scrollContainer) => {
                scrollContainer.addEventListener('scroll', createScrollListener(index));
                scrollContainer.addEventListener('touchmove', createTouchMoveListener(index));
            });
        } else {
            dropdownsMobile[index].classList.remove('open');
            openIndex2 = -1;
            document.removeEventListener('click', createOutsideClickListener(index));
            document.removeEventListener('scroll', createScrollListener(index));
            const scrollContainers = document.querySelectorAll('.scroll-container');
            scrollContainers.forEach((scrollContainer) => {
                scrollContainer.removeEventListener('scroll', createScrollListener(index));
                scrollContainer.removeEventListener('touchmove', createTouchMoveListener(index));
            });
        }

        event.stopPropagation();
    }

    function createOutsideClickListener(index) {
        return function (event) {
            const dropdown = dropdownsMobile[index];
            if (!dropdown.contains(event.target) && !event.target.classList.contains('dropdown3')) {
                dropdown.classList.remove('open');
                openIndex2 = -1;
                document.removeEventListener('click', createOutsideClickListener(index));
                document.removeEventListener('scroll', createScrollListener(index));
                const scrollContainers = document.querySelectorAll('.scroll-container');
                scrollContainers.forEach((scrollContainer) => {
                    scrollContainer.removeEventListener('scroll', createScrollListener(index));
                    scrollContainer.removeEventListener('touchmove', createTouchMoveListener(index));
                });
            }
        };
    }

    function createScrollListener(index) {
        return function (event) {
            const dropdown = dropdownsMobile[index];
            dropdown.classList.remove('open');
            openIndex2 = -1;
            document.removeEventListener('click', createOutsideClickListener(index));
            document.removeEventListener('scroll', createScrollListener(index));
            const scrollContainers = document.querySelectorAll('.scroll-container');
            scrollContainers.forEach((scrollContainer) => {
                scrollContainer.removeEventListener('scroll', createScrollListener(index));
                scrollContainer.removeEventListener('touchmove', createTouchMoveListener(index));
            });
        };
    }

    function createTouchMoveListener(index) {
        return function () {
            const dropdown = dropdownsMobile[index];
            dropdown.classList.remove('open');
            openIndex2 = -1;
        };
    }
}

// Panggil fungsi untuk masing-masing bagian
handleDesktopDropdowns();
handleMobileDropdowns();















// ---------------tab tab komen
// // Menampilkan tab "Komentar" secara default saat halaman dimuat
//     function showTab(tabId, clickedTab) {
//       // Menampilkan tab yang dipilih dan menyembunyikan yang lainnya
//       const tabs = document.querySelectorAll('.tab-content');
//       tabs.forEach(tab => {
//           tab.style.display = tab.id === tabId ? 'block' : 'none';
//       });

//       // Menghapus class active-tab-btn dari semua tab-btn
//       const tabBtns = document.querySelectorAll('.tab-btn');
//       tabBtns.forEach(tabBtn => {
//           tabBtn.classList.remove('active-tab-btn');
//       });

//       // Menambah class active-tab-btn ke tab-btn yang dipilih
//       clickedTab.classList.add('active-tab-btn');
//   }

//   // Menampilkan tab komentar dan mengatur warna biru saat halaman dimuat pertama kali
//   document.addEventListener('DOMContentLoaded', function () {
//       const commentTab = document.getElementById('commentTab');
//       const commentTabBtn = document.querySelector('.tab-btn');

//       commentTab.style.display = 'block';
//       commentTabBtn.classList.add('active-tab-btn');
//   });




// rives
document.addEventListener("DOMContentLoaded", function () {
    // Setelah DOM diinisialisasi, tambahkan gaya ke elemen-elemen HTML
    document.body.style.transition = "background-color 0.5s ease";
    document.querySelector("body").style.opacity = 1;
});



// lope

function toggleHeartColor() {
    var heart = document.getElementById("heart");
    var checkbox = document.getElementById("heart-checkbox");

    if (checkbox.checked) {
        heart.classList.add("checked");
    } else {
        heart.classList.remove("checked");
    }
}



//   lope 2
function toggleHeartColor2() {
    var heart = document.getElementById("heart2");
    var checkbox = document.getElementById("heart-checkbox2");

    if (checkbox.checked) {
        heart.classList.add("checked2");
    } else {
        heart.classList.remove("checked2");
    }
}



//   lope 3
function toggleHeartColor3() {
    var heart = document.getElementById("heart3");
    var checkbox = document.getElementById("heart-checkbox3");

    if (checkbox.checked) {
        heart.classList.add("checked3");
    } else {
        heart.classList.remove("checked3");
    }
}







// -------------------------------------------- filter drop down ------------------------------ //
function toggleListBagian() {
    var listbagian = document.getElementById("listbagian");
    listbagian.classList.toggle("show");
}
function toggleListBagian2() {
    var listbagian = document.getElementById("listbagian2");
    listbagian.classList.toggle("show");
}
function toggleListBagian3() {
    var listbagian = document.getElementById("listbagian3");
    listbagian.classList.toggle("show");
}


// ---------------------------------------- share ------------------------------------- //
// Get references to the SVG and the share list
const shareIcon = document.getElementById('share-icon');
const shareList = document.querySelector('.cerita-terbaru .textcerita .bagikan-cerita .list-share');

// Add a click event listener to the SVG
shareIcon.addEventListener('click', function () {
    const parentWithClass = shareIcon.closest('.bagikan-cerita');
    console.log(parentWithClass);
    // Toggle the 'show' class on the share list
    shareList.classList.toggle('show');
});

// ------------------------- list ------------------------- //
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

// ---------------- dropddown toogle -------------------//
function toggleDropdown() {
    var contentList = document.getElementById('list-mobile');
    contentList.classList.toggle('show');
}

//  --------------------------------------------------------------------------------
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

// --------------------------- search fitur ------------------------------ //
function toggleSearch() {
    var searchBox = document.querySelector('.search-box');
    var searchInput = document.getElementById('searchInput');
    var navBurger = document.querySelector('.nav-burger');
    var brand = document.querySelector('.brand');

    if (!searchBox.classList.contains('open')) {
        // Jika kotak pencarian belum terbuka, buka dan fokus ke input
        searchBox.classList.add('open');
        searchInput.focus();
        navBurger.classList.add('hidden'); // Sembunyikan menu desktop
        brand.classList.add('hidden'); // Sembunyikan menu desktop
    } else {
        // Jika kotak pencarian sudah terbuka, tutup dan tampilkan elemen yang disembunyikan
        searchBox.classList.remove('open');
        searchInput.value = '';
        navBurger.classList.remove('hidden'); // Tampilkan kembali menu desktop
        brand.classList.remove('hidden'); // Tampilkan kembali menu desktop
    }
}

// Tambahkan event listener untuk menangani scroll
window.addEventListener('scroll', function () {
    var searchBox = document.querySelector('.search-box');

    // Tutup kotak pencarian jika terbuka
    if (searchBox.classList.contains('open')) {
        searchBox.classList.remove('open');

        // Tampilkan kembali elemen yang disembunyikan
        var navBurger = document.querySelector('.nav-burger');
        var brand = document.querySelector('.brand');
        navBurger.classList.remove('hidden');
        brand.classList.remove('hidden');
    }
});

// Tambahkan event listener untuk menangani klik di luar kotak pencarian
document.addEventListener('click', function (event) {
    var searchBox = document.querySelector('.search-box');
    var isClickInsideSearchBox = searchBox.contains(event.target);

    // Tutup kotak pencarian jika terbuka dan klik dilakukan di luar kotak pencarian
    if (searchBox.classList.contains('open') && !isClickInsideSearchBox) {
        searchBox.classList.remove('open');

        // Tampilkan kembali elemen yang disembunyikan
        var navBurger = document.querySelector('.nav-burger');
        var brand = document.querySelector('.brand');
        navBurger.classList.remove('hidden');
        brand.classList.remove('hidden');
    }
});

