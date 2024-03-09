
document.addEventListener("DOMContentLoaded", function () {
    // Setelah DOM diinisialisasi, tambahkan gaya ke elemen-elemen HTML
    document.body.style.transition = "background-color 0.5s ease";
    document.querySelector(".content").style.opacity = 1;
});


const burger = document.querySelector('.nav-burger');
const menu = document.querySelector('.nav-menu');
// const nav = document.querySelector('.nav');
const toTop = document.getElementById('toTop');

burger.addEventListener('click', () => {
    menu.classList.toggle('active');
});

window.addEventListener('scroll', () => {
    nav.classList.toggle('active', window.scrollY > 0);
    toTop.classList.toggle('active', window.scrollY > 300);
    nav.classList.toggle('hide', window.pageYOffset < prevScrollpos);
    prevScrollpos = window.pageYOffset;
});

const snippets = document.querySelectorAll('.hover');
snippets.forEach(snippet => {
    snippet.addEventListener('mouseout', event => {
        event.target.parentNode.classList.remove('hover');
    });
});

document.addEventListener('click', event => {
    const isClickInsideBurger = burger.contains(event.target);
    const isClickInsideMenu = menu.contains(event.target);

    if (!isClickInsideBurger && !isClickInsideMenu) {
        menu.classList.remove('active');
    }
});

function toggleDropdown() {
    const dropdownContent = document.getElementById('dropdownContent');
    dropdownContent.style.display = (dropdownContent.style.display === 'block') ? 'none' : 'block';
}

function hideDropdownOnMobile() {
    const dropdownContent = document.getElementById('dropdownContent');
    const screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

    if (screenWidth < 600) {
        dropdownContent.style.display = 'none';
    }
}

window.onload = hideDropdownOnMobile;
window.onresize = hideDropdownOnMobile;

function toggleSearch() {
    const searchBox = document.querySelector('.search-box');
    const searchInput = document.getElementById('searchInput');
    const navBurger = document.querySelector('.nav-burger');
    const brand = document.querySelector('.brand');

    if (!searchBox.classList.contains('open')) {
        searchBox.classList.add('open');
        searchInput.focus();
        navBurger.classList.add('hidden');
        brand.classList.add('hidden');
    } else {
        searchBox.classList.remove('open');
        searchInput.value = '';
        navBurger.classList.remove('hidden');
        brand.classList.remove('hidden');
    }
}

window.addEventListener('scroll', () => {
    const searchBox = document.querySelector('.search-box');

    if (searchBox.classList.contains('open')) {
        searchBox.classList.remove('open');

        const brand = document.querySelector('.brand');
        navBurger.classList.remove('hidden');
        brand.classList.remove('hidden');
    }
});

document.addEventListener('click', event => {
    const searchBox = document.querySelector('.search-box');
    const isClickInsideSearchBox = searchBox.contains(event.target);

    if (searchBox.classList.contains('open') && !isClickInsideSearchBox) {
        searchBox.classList.remove('open');
        const navBurger = document.querySelector('.nav-burger');
        const brand = document.querySelector('.brand');
        navBurger.classList.remove('hidden');
        brand.classList.remove('hidden');
    }
});

let prevScrollpos = window.pageYOffset;


window.addEventListener('scroll', function () {
    let currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
        nav.classList.remove('hide')
    } else {
        nav.classList.add('hide')
    }
    prevScrollpos = currentScrollPos;
})

var snippet = [].slice.call(document.querySelectorAll('.hover'));
if (snippet.length) {
    snippet.forEach(function (snippet) {
        snippet.addEventListener('mouseout', function (event) {
            if (event.target.parentNode.tagName === 'figure') {
                event.target.parentNode.classList.remove('hover')
            } else {
                event.target.parentNode.classList.remove('hover')
            }
        });
    });
}

function getDirection() {
    var windowWidth = window.innerWidth;
    var direction = window.innerWidth <= 760 ? 'vertical' : 'horizontal';

    return direction;
}

let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = slides.length }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
}


function toggleLove(element) {
    // Dapatkan elemen input radio
    var radioInput = element.previousElementSibling;

    // Periksa apakah input radio sudah tercentang
    if (radioInput.checked) {
        // Jika sudah tercentang, batalkan cek
        radioInput.checked = false;
    } else {
        // Jika belum tercentang, tandai sebagai tercentang
        radioInput.checked = true;
    }
}

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
document.addEventListener('DOMContentLoaded', function () {
    const container = document.querySelector('.scroll-container1');
    const categoryContainer = document.querySelector('.grub-card1');
    const scrollAmount = 240; // Sesuaikan dengan jumlah scroll yang diinginkan

    document.querySelector('.scroll-button1.left1').addEventListener('click', function () {
        categoryContainer.scrollLeft -= scrollAmount;
    });

    document.querySelector('.scroll-button1.right1').addEventListener('click', function () {
        categoryContainer.scrollLeft += scrollAmount;
    });

});
document.addEventListener('DOMContentLoaded', function () {
    const container = document.querySelector('.scroll-container2');
    const categoryContainer = document.querySelector('.grub-card2');
    const scrollAmount = 240; // Sesuaikan dengan jumlah scroll yang diinginkan

    document.querySelector('.scroll-button2.left2').addEventListener('click', function () {
        categoryContainer.scrollLeft -= scrollAmount;
    });

    document.querySelector('.scroll-button2.right2').addEventListener('click', function () {
        categoryContainer.scrollLeft += scrollAmount;
    });
});

document.addEventListener("DOMContentLoaded", function () {
    // Setelah DOM diinisialisasi, tambahkan gaya ke elemen-elemen HTML
    document.body.style.transition = "background-color 0.5s ease";
    document.querySelector(".container").style.opacity = 1;
});

function toggleHeartColor() {
    var heart = document.getElementById("heart");
    var checkbox = document.getElementById("heart-checkbox");

    if (checkbox.checked) {
        heart.classList.add("checked");
    } else {
        heart.classList.remove("checked");
    }
}
var dropdownBtns = document.querySelectorAll('.dropdown-btn');

dropdownBtns.forEach(function (dropdownBtn) {
    dropdownBtn.addEventListener("click", function () {
        this.classList.toggle("active");
        var dropdownContainer = this.nextElementSibling;
        if (dropdownContainer.style.maxHeight) {
            dropdownContainer.style.maxHeight = null;
        } else {
            dropdownContainer.style.maxHeight = dropdownContainer.scrollHeight + "px";
        }
    });
});


dropdownBtns.addEventListener('click', function () {
    this.classList.toggle('active');

    // Tambah atau hapus kelas untuk mengganti ikon
    var icon = this.querySelector('.fa-caret-down');
    icon.classList.toggle('fa-caret-up');
});

