document.addEventListener('DOMContentLoaded', function () {
    const categoryContainer = document.querySelector('.grub-card');
    const scrollAmount = 240; // Sesuaikan dengan jumlah scroll yang diinginkan

    document.querySelector('.scroll-button.left').addEventListener('click', function () {
        categoryContainer.scrollLeft -= scrollAmount;
    });

    document.querySelector('.scroll-button.right').addEventListener('click', function () {
        categoryContainer.scrollLeft += scrollAmount;
    });
});
const fileInput = document.querySelector('.file-input input[type="file"]');
const imgPreview = document.querySelector(".file-input img");

fileInput.addEventListener("change", function () {
    const file = this.files[0];
    console.log(fileInput);
    if (file) {
        const reader = new FileReader();
        reader.onload = function () {
            imgPreview.src = reader.result;
        };
        reader.readAsDataURL(file);
    } else {
        // Jika pengguna memilih untuk tidak mengunggah berkas baru,
        // kita bisa memperbarui gambar pratinjau dengan gambar yang sebelumnya diunggah.
        imgPreview.src = "{{ asset('/upload/' . $data['user']->image_user) }}";

    }
});
document.addEventListener('DOMContentLoaded', function () {
    const tabLinks = document.querySelectorAll('.tab-link');
    const cardsBodies = document.querySelectorAll('.cards-body');
    const cardTitle = document.getElementById('card-title');

    tabLinks.forEach(function (tabLink) {
        tabLink.addEventListener('click', function (event) {
            event.preventDefault();

            const tabId = this.getAttribute('data-tab');

            // Sembunyikan semua konten tab
            cardsBodies.forEach(function (cardsBody) {
                cardsBody.style.display = 'none';
            });

            // Tampilkan konten tab yang dipilih
            document.getElementById(tabId).style.display = 'block';

            // Ubah judul card header sesuai dengan tab yang aktif
            switch (tabId) {
                case 'profile':
                    cardTitle.innerText = 'Profile  User';
                    break;
                case 'change-password':
                    cardTitle.innerText = 'Change-Password';
                    break;
                case 'favorite':
                    cardTitle.innerText = 'Favorit';
                    break;
                case 'log-out':
                    cardTitle.innerText = 'Keluar';
                    break;
                default:
                    cardTitle.innerText = 'Profil Pengguna';
                    break;
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    // Setelah DOM diinisialisasi, tambahkan gaya ke elemen-elemen HTML
    document.body.style.transition = "background-color 0.5s ease";
    document.querySelector(".content").style.opacity = 1;
});



document.addEventListener('DOMContentLoaded', function () {
    const selectElement = document.querySelector('select');
    const cardsBodies = document.querySelectorAll('.cards-body');
    const cardTitle = document.getElementById('card-title');

    // Function untuk menangani perubahan opsi terpilih
    selectElement.addEventListener('change', function () {
        const selectedOption = this.value;

        // Sembunyikan semua konten tab
        cardsBodies.forEach(function (cardsBody) {
            cardsBody.style.display = 'none';
        });

        // Tampilkan konten tab yang dipilih
        document.getElementById(selectedOption).style.display = 'block';

        // Ubah judul card header sesuai dengan tab yang aktif
        switch (selectedOption) {
            case 'profile':
                cardTitle.innerText = 'Profile User';
                break;
            case 'change-password':
                cardTitle.innerText = 'Change-Password';
                break;
            case 'favorite':
                cardTitle.innerText = 'Favorite';
                break;
            case 'log-out':
                cardTitle.innerText = 'Keluar';
                break;
            default:
                cardTitle.innerText = 'Profil Pengguna';
                break;
        }
    });
});


