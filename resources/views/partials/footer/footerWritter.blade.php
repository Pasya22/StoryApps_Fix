</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://kit.fontawesome.com/36721e3235.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/writer.js') }}"></script>
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
</script>
