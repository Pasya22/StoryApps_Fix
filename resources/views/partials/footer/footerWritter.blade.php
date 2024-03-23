</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://kit.fontawesome.com/36721e3235.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/writer.js') }}"></script>
<script src="{{ asset('js/profil.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script>
    function changeStatus(storyId, selectElement) {
        var selectedStatus = selectElement.value;
        // Perform AJAX request
        $.ajax({
            type: 'PUT', // Gunakan metode PUT sesuai dengan route Anda
            url: '{{ route('updateStatus', ['id_story' => ':id_story']) }}'.replace(':id_story', storyId),
            data: {
                _token: '{{ csrf_token() }}',
                selectedStatus: selectedStatus
            },
            success: function(response) {
                setTimeout(() => {
                    location.reload('/home/writter/dataStories');
                }, 1000);
                // Update UI jika diperlukan
                console.log(response.message);
            },
            error: function(error) {
                console.error('Error updating status:', error);
            }
        });
    }
</script>
<script>
    // delete stories
    document.addEventListener("DOMContentLoaded", function() {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                const storyId = event.target.dataset.id;

                Swal.fire({
                    title: "Kamu Yakin Mau Hapus?",
                    text: "Jika kamu belum yakin, klik Cancel!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Lakukan request AJAX untuk menghapus data
                        $.ajax({
                            url: "/writter/delete-story/" +
                                storyId, // Sesuaikan dengan URL delete-story Anda
                            type: "get",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                    .attr('content')
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: "Data Terhapus!",
                                    text: response.message,
                                    icon: "success"
                                }).then(() => {
                                    // Redirect atau refresh halaman setelah penghapusan berhasil
                                    window.location.reload();
                                });
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    title: "Oops...",
                                    text: "Terjadi kesalahan saat menghapus data!",
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
            });
        });
    });


    // delete chapters
    document.addEventListener("DOMContentLoaded", function() {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                const chapterId = event.target.dataset.id;

                Swal.fire({
                    title: "Kamu Yakin Mau Hapus?",
                    text: "Jika kamu belum yakin, klik Cancel!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Lakukan request AJAX untuk menghapus data
                        $.ajax({
                            url: "/writter/delete-chapters/" +
                                chapterId, // Sesuaikan dengan URL delete-story Anda
                            type: "get",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                    .attr('content')
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: "Data Terhapus!",
                                    text: response.message,
                                    icon: "success"
                                }).then(() => {
                                    // Redirect atau refresh halaman setelah penghapusan berhasil
                                    window.location.reload();
                                });
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    title: "Oops...",
                                    text: "Terjadi kesalahan saat menghapus data!",
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
            });
        });
    });

    // delete characters
    document.addEventListener("DOMContentLoaded", function() {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                const charactersId = event.target.dataset.id;

                Swal.fire({
                    title: "Kamu Yakin Mau Hapus?",
                    text: "Jika kamu belum yakin, klik Cancel!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Lakukan request AJAX untuk menghapus data
                        $.ajax({
                            url: "/writter/delete-character/" +
                                charactersId, // Sesuaikan dengan URL delete-story Anda
                            type: "get",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                    .attr('content')
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: "Data Terhapus!",
                                    text: response.message,
                                    icon: "success"
                                }).then(() => {
                                    // Redirect atau refresh halaman setelah penghapusan berhasil
                                    window.location.reload();
                                });
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    title: "Oops...",
                                    text: "Terjadi kesalahan saat menghapus data!",
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
            });
        });
    });

    // delete characters
    document.addEventListener("DOMContentLoaded", function() {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                const dialogsId = event.target.dataset.id;

                Swal.fire({
                    title: "Kamu Yakin Mau Hapus?",
                    text: "Jika kamu belum yakin, klik Cancel!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Lakukan request AJAX untuk menghapus data
                        $.ajax({
                            url: "/writter/delete-dialog/" +
                                dialogsId, // Sesuaikan dengan URL delete-story Anda
                            type: "get",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                    .attr('content')
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: "Data Terhapus!",
                                    text: response.message,
                                    icon: "success"
                                }).then(() => {
                                    // Redirect atau refresh halaman setelah penghapusan berhasil
                                    window.location.reload();
                                });
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    title: "Oops...",
                                    text: "Terjadi kesalahan saat menghapus data!",
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
            });
        });
    });
</script>
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


    // Fungsi untuk menutup sidebar saat pengguna mengklik di luar area sidebar atau konten utama
    document.addEventListener("mousedown", function(event) {
        var sidebar = document.querySelector(".sidebar");
        var navBurger = document.querySelector(".nav-burger");
        if (!sidebar.contains(event.target) && event.target !== navBurger) {
            sidebar.classList.remove("active");
        }
    });
</script>
<script>
    $(document).ready(function() {
        function updateBadgeCount(count) {
            $('.badge-counter').text(count);
            if (count > 0) {
                $('.badge-counter').show(); // Tampilkan badge jika ada notifikasi belum dibaca
            } else {
                $('.badge-counter').hide(); // Sembunyikan badge jika tidak ada notifikasi belum dibaca
            }
        }

        // Fungsi untuk mengambil data notifikasi dari server
        function getNotifications() {
            $.ajax({
                url: "{{ route('notifications') }}", // Ganti dengan URL endpoint yang sesuai di server
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Reset container notifikasi
                    $('#dropdownNotif').empty();
                    var unreadCount = 0; // Inisialisasi jumlah notifikasi yang belum dibaca

                    // Loop melalui data notifikasi dan tambahkan ke container
                    response.notifications.forEach(function(notification) {
                        // Tentukan warna dan ikon berdasarkan jenis notifikasi
                        console.log(notification.message);
                        var iconClass = '';
                        var colorClass = '';
                        if (notification.type === 'comment') {
                            iconClass = 'fa fa-comment';
                            colorClass = 'text-primary';
                        } else if (notification.type === 'rate') {
                            iconClass = 'fa fa-star';
                            colorClass = 'text-warning';
                        } else if (notification.type === 'RequestBeWriter') {
                            iconClass = 'fa fa-user';
                            colorClass = 'text-success';
                        } else if (notification.type === 'favorite') {
                            iconClass = 'fa fa-heart';
                            colorClass = 'text-danger';
                        } else if (notification.type === 'user') {
                            iconClass = 'fas fa-user';
                            colorClass = 'text-info';
                        }

                        // Tentukan kelas untuk menandai notifikasi sudah dibaca atau belum
                        var readClass = notification.is_read ? 'text-muted' :
                            'font-weight-bold';

                        // Buat elemen notifikasi dan tambahkan ke container
                        var notificationItem =
                            '<a id="notification_' + notification.id_notification +
                            '" class="dropdown-item d-flex align-items-center" onclick="updateStatusNotifikasi(' +
                            notification.id_notification + ')" style="cursor:pointer;">' +
                            '<div class="mr-3">' +
                            '<div class="icon-circle bg-white">' +
                            '<i class="' + iconClass + ' ' + colorClass + '"></i>' +
                            '</div>' +
                            '</div>' +
                            '<div class="text-notif">' +
                            '<div class="small text-gray-500">' + notification.tgl_dibuat +
                            '</div>' +
                            '<span class="' + readClass + '">' + notification.message;

                        // Check kondisi untuk menampilkan title atau tidak
                        if (notification.entity_id === "entity_id") {
                            notificationItem += ' ' + notification.title;
                        }

                        notificationItem += '</span>' +
                            '</div>' +
                            '</a>';

                        $('#dropdownNotif').append(notificationItem);

                        // Perbarui jumlah notifikasi yang belum dibaca
                        if (!notification.is_read2) {
                            unreadCount++;
                        }
                    });

                    // Perbarui counter notifikasi
                    updateBadgeCount(unreadCount);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching notifications:', error);
                }
            });
        }

        // Panggil fungsi getNotifications saat dokumen siap
        // getNotifications();

        // Tambahkan interval untuk mengambil notifikasi secara berkala
        setInterval(getNotifications, 6000); // Ambil notifikasi setiap 1 menit (60000 milidetik)
    });


    function updateStatusNotifikasi(id) {
        $.ajax({
            url: "{{ route('markNotificationAsReads', ['id' => '__id__']) }}".replace('__id__', id),
            type: 'PUT',
            data: {
                _method: 'PUT',
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    console.log(id);
                    console.log('Status notifikasi berhasil diupdate');
                    alert('Notifikasi telah dibaca');
                    // Hapus notifikasi dari tampilan setelah dibaca
                    $('#notification_' + id).remove();

                    // Kurangi jumlah notifikasi yang belum dibaca
                    var unreadCount = parseInt($('.badge-counter').text());
                    if (unreadCount > 0) {
                        unreadCount--;
                        updateBadgeCount(unreadCount);
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error('Gagal mengupdate status notifikasi:', error);
                alert('Gagal mengupdate status notifikasi');
                // Jika Anda memiliki penanganan kesalahan lainnya, tambahkan di sini
            }
        });
    }
</script>
