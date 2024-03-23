<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>
    <style>
        .disable {
            border-radius: 10%;
            color: #60616257;
            line-height: 2.4;
            display: inline-block;
            width: 86px;
            text-align: center;
            vertical-align: middle;
            background-color: #afafaf75;
            pointer-events: none;
        }

        .container-box {
            display: flex;
            justify-content: space-between;
            align-items: center;

        }

        /* Gaya CSS untuk notifikasi */
        .notification {
            background-color: #f1f1f1;
            padding: 20px;
            margin: 10px;
            border: 1px solid #d4d4d4;
            border-radius: 5px;
        }

        .text-muted {
            color: #6c757d;
            /* You can adjust the color as needed */
        }

        .notification-link.read {
            font-weight: normal;
            /* Set the font weight to normal for read notifications */
            color: #888888;
            /* Set a different color for read notifications */
        }
    </style>
    <link rel="icon" href="{{ asset('/img/default.png') }}" type="image/x-icon" />

    <link rel="stylesheet" href="{{ asset('css/custome.css') }}">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/fontawesome.min.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

</head>

<body id="page-top">
    <div id="wrapper">

        @include('partials.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">
                @include('partials.header')

                <div class="container-fluid">
                    @yield('content')

                </div>

            </div>



            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>


    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <!-- Custom scripts for all pages-->


    <script src="{{ asset('js/app.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            // Event handler saat tombol "Save" diklik
            $('#submitForm').on('click', function() {
                // Mengirimkan formulir menggunakan AJAX
                $.ajax({
                    url: "{{ route('PostFavorite') }}", // URL endpoint untuk mengirimkan formulir
                    type: 'POST', // Metode HTTP
                    data: $('#favoriteForm').serialize(), // Data formulir yang akan dikirim
                    success: function(response) {
                        // Penanganan jika permintaan berhasil
                        if (response === true || response ===
                            "true") { // Periksa respons untuk menentukan keberhasilan
                            alert("Berhasil menambahkan ke favorite");
                            window.location = "/admin/story/favorite/DataFavorite";
                        } else {
                            alert("Gagal menambahkan ke favorite");
                        }
                    },
                    error: function(xhr, status, error) {
                        // Penanganan jika permintaan gagal
                        console.error(error); // Tampilkan pesan kesalahan ke konsol
                        // Anda dapat menambahkan penanganan lainnya di sini
                    }
                });
            });

            // Event handler saat label hati diklik
            $('#heart').on('click', function() {
                var checkbox = $('#heart-checkbox');
                var heartLabel = $('#heart');

                // Memeriksa status checkbox
                if (!checkbox.prop('checked')) {
                    // Jika belum dicentang, centang checkbox dan tambahkan kelas 'checked' pada label hati
                    checkbox.prop('checked', true);
                    heartLabel.addClass('checked');
                } else {
                    // Jika sudah dicentang, lepaskan centang dari checkbox dan hapus kelas 'checked' dari label hati
                    checkbox.prop('checked', false);
                    heartLabel.removeClass('checked');
                }

            });
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
                    url: "{{ route('notification') }}", // Ganti dengan URL endpoint yang sesuai di server
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Reset container notifikasi
                        $('#notificationContainer').empty();
                        var unreadCount = 0; // Inisialisasi jumlah notifikasi yang belum dibaca

                        // Loop melalui data notifikasi dan tambahkan ke container
                        response.notifications.forEach(function(notification) {
                            // Tentukan warna dan ikon berdasarkan jenis notifikasi
                            console.log(notification);
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
                                '<div>' +
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

                            $('#notificationContainer').append(notificationItem);

                            // Perbarui jumlah notifikasi yang belum dibaca
                            if (!notification.is_read) {
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
                url: "{{ route('markNotificationAsRead', ['id' => '__id__']) }}".replace('__id__', id),
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

    <script>
        function changeStatus(storyId, selectElement) {
            var selectedStatus = selectElement.value;
            // Perform AJAX request
            $.ajax({
                type: 'PUT', // Gunakan metode PUT sesuai dengan route Anda
                url: '{{ route('UbahStatus', ['id_story' => ':id_story']) }}'.replace(':id_story', storyId),
                data: {
                    _token: '{{ csrf_token() }}',
                    selectedStatus: selectedStatus
                },
                success: function(response) {
                    setTimeout(() => {
                        location.reload('/admin/story/story/DataStory');
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
        function rateStory(storyId, rate) {

            $.ajax({

                method: 'PUT',
                url: '/admin/story/rate/rateStory/' + storyId,
                data: {
                    _token: '{{ csrf_token() }}',
                    rate: rate,
                },
                success: function(response) {
                    if (response.success == true) {
                        // alert("Rating Success");
                        location.reload();
                    } else {
                        alert("Failed to Rate!");
                    }
                },
                error: function(error) {
                    console.error('erorr');
                    // Handle error if needed
                }
            });
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const notificationContainer = document.getElementById('notificationContainer');

            function showNotification(message, type) {
                notificationContainer.innerHTML = message;
                notificationContainer.className = `notification-container ${type}`;
                notificationContainer.style.display = 'block';

                setTimeout(function() {
                    notificationContainer.style.display = 'none';
                }, 2000); // Hide after 3 seconds (adjust as needed)
            }

            // Check if a notification is present in the session
            const addCompanyNotification = '{{ session('success') }}';
            const errorNotification = '{{ session('error') }}';

            if (addCompanyNotification) {
                showNotification(addCompanyNotification, 'notification-success');
            }

            if (errorNotification) {
                showNotification(errorNotification, 'notification-error');
            }
        });
    </script>
