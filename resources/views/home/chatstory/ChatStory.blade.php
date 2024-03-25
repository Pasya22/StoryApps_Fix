@extends('layouts.chatStoryLayout')
@section('title', 'Chat Story')
@section('content')
    <div class="chatstory">
        <div class="popup" id="popup">
            <strong> Untuk membaca anda dapat mengklik scroll atau tombol Next Halaman</strong>
        </div>
        <div class="home">
            <a href="{{ route('StoryApps') }}"><svg width="20" height="17" viewBox="0 0 20 17" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M20 16.918C17.5535 13.9315 15.381 12.237 13.482 11.834C11.5835 11.4315 9.776 11.3705 8.059 11.6515V17L0 8.2725L8.059 0V5.0835C11.2335 5.1085 13.932 6.2475 16.155 8.5C18.3775 10.7525 19.6595 13.5585 20 16.918Z"
                        fill="#005AC8" />
                </svg></a>
            <a href="">
                <p>Home</p>
            </a>
            <p>/</p>
            <a href="">
                <p>Chat Story</p>
            </a>
        </div>
        <div class="card">
            <div class="card-header">
                <h4><strong>Judul Cerita - Bagian 1</strong></h4>
            </div>
            <div class="card-body">
                <div class="page">
                    <div class="kiri">
                        <button id="listbagianBtn" type="button" class="buttonpage buttonchapter"
                            onclick="toggleListBagian()">

                            Chapter

                            {{ !empty($chapter) ? $chapter->id_chapter : 'N/A' }}

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-chevron-down" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                            </svg>
                        </button>

                        <div class="listbagian" id="listbagian">
                            <ul>
                                @foreach ($data['chapters'] as $item)
                                    <a href="{{ route('ChatStory', $item->id_chapter) }}">
                                        <li>{{ $item->chapter }}</li>
                                    </a>
                                @endforeach
                            </ul>
                        </div>
                        <div id="listhalamanBtn" class="button2 buttonpage">
                            {{-- {{ $data['datah']->currentPage() }}/{{ $data['datah']->Count() }} --}}
                            {{ $data['datah']->currentPage() }}/{{ $data['datah']->lastPage() }}

                        </div>
                    </div>
                    <div class="kanan">
                        @if ($data['sinopsis']->isNotEmpty() && $data['sinopsis']->items()[0]->id_chapter > 1)
                            <a href="{{ route('ChatStory', ['id' => $data['sinopsis']->items()[0]->id_chapter - 1]) }}">
                                <button id="prefchapter" class="button3 buttonpage" type="submit">Prev Chapter</button>
                            </a>
                        @endif

                        <a
                            href="{{ $data['sinopsis']->isNotEmpty() ? route('ChatStory', ['id' => $data['sinopsis']->items()[0]->id_chapter + 1]) : '#' }}">
                            <button id="nextchapter" type="button" class="buttonpage"
                                {{ $data['sinopsis']->isEmpty() ? 'disabled' : '' }}>
                                Next Chapter
                            </button>
                        </a>

                    </div>
                </div>
                <div class="story container-body" id="infinite-scroll-container">
                    <div class="card tengah" id="cardtengah">
                        @if ($data['sinopsis']->isNotEmpty())
                            {{ $data['sinopsis']->items()[0]->sinopsis }}
                        @else
                            No sinopsis available.
                        @endif
                    </div>

                    @php
                        $items = $data['datah']->items();
                    @endphp

                    @for ($i = 0; $i < count($items); $i += 2)
                        <div class="card kiri" id="cardkiri">
                            <strong>
                                <p>{{ $items[$i]->character }}</p>
                            </strong>
                            {{ $items[$i]->dialog }}
                        </div>

                        @if ($i + 1 < count($items))
                            <div class="card kanan" id="cardkanan">
                                <strong>
                                    <p>{{ $items[$i + 1]->character }}</p>
                                </strong>
                                {{ $items[$i + 1]->dialog }}
                            </div>
                        @endif
                    @endfor


                    <div class="card tengah" id="cardtengahbersambung">
                    </div>

                </div>

                <div id="loadMoreLoader" style="display: none;">
                    Loading...
                </div>
                <div class="halaman" id="infinite-change-page">

                    <a href="{{ $data['datah']->previousPageUrl() ? $data['datah']->previousPageUrl() : '#' }}"
                        id="prevBagianBtn" style="display: {{ $data['datah']->currentPage() == 1 ? 'none' : 'block' }}">
                        <button class="button3 buttonpage" type="submit">Prev Halaman</button>
                    </a>
                    <a href="{{ $data['datah']->nextPageUrl() ? $data['datah']->nextPageUrl() : '#' }}" id="nextBagianBtn"
                        data-current-page="{{ $data['datah']->currentPage() }}">
                        <button class="buttonpage">Next Halaman</button>
                    </a>

                </div>
            </div>
        </div>
    </div>
    {{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil elemen popup
            var popup = document.getElementById('popup');

            // Tampilkan popup
            popup.classList.add("show");

            // Set timeout untuk menghilangkan popup setelah 5 detik
            setTimeout(function() {
                // Sembunyikan popup
                popup.classList.remove("show");

                // Set timeout untuk membuatnya kedip-kedip
                for (let i = 0; i < 8; i++) {
                    setTimeout(function() {
                        // Tampilkan lagi popup
                        popup.classList.toggle("show");
                    }, i * 900); // Waktu antara kedip-kedip (misal, 0.7 detik)
                }

                // Set timeout untuk menghilangkan popup setelah kedip-kedip
                setTimeout(function() {
                    // Sembunyikan popup lagi
                    popup.classList.remove("show");
                }, 3500); // Waktu setelah kelima kali kedip-kedip (misal, 3.5 detik)
            }, 0); // Waktu tampil popup (misal, 0 detik)
        });
        $(document).ready(function() {
            if (!localStorage.getItem('popupShown')) {
                alert(
                    "Welcome! You can scroll down to read the story. Click 'Next Halaman' to navigate to the next page."
                );
                localStorage.setItem('popupShown', true);
            }
        });
        $(document).ready(function() {
            let currentPage = parseInt($('#nextBagianBtn').data('current-page')); // Get the current page
            let currentPage2 = parseInt($('#prevBagianBtn').data('current-page')); // Get the current page
            let pjumlah = {{ $data['datah']->lastPage() }};
            let loading = false;
            let bersambung = 'Bersambung...';

            function isBottom() {
                let storyContainer = $('#infinite-scroll-container');
                return storyContainer.scrollTop() + storyContainer.innerHeight() >= storyContainer[0].scrollHeight;
            }

            function loadNextPage() {
                if (!loading && isBottom()) {
                    loading = true;
                    let nextPage = getCurrentPageFromUrl() + 1; // Increment page by 1
                    loadMoreData(nextPage);
                }
            }

            function updateNextButtonAvailability(data) {
                if (data.length === 0) {
                    $('#nextBagianBtn').prop('disabled', true);
                } else {
                    $('#nextBagianBtn').prop('disabled', false);
                }
            }

            $('#infinite-scroll-container').scroll(loadNextPage);

            function getCurrentPageFromUrl() {
                let urlParams = new URLSearchParams(window.location.search);
                return parseInt(urlParams.get('page')) || 1;
            }


            function displayDialogs(dialogs) {
                for (let i = 0; i < dialogs.length; i += 2) {
                    let leftDialogHtml = `
            <div class="card kiri" id="cardkiri">
                <strong>
                    <p>${dialogs[i].character}</p>
                </strong>
                ${dialogs[i].dialog}
            </div>
        `;
                    $('#infinite-scroll-container').append(leftDialogHtml);

                    if (i + 1 < dialogs.length) {
                        let rightDialogHtml = `
                <div class="card kanan" id="cardkanan">
                    <strong>
                        <p>${dialogs[i + 1].character}</p>
                    </strong>
                    ${dialogs[i + 1].dialog}
                </div>
            `;
                        $('#infinite-scroll-container').append(rightDialogHtml);
                    }
                }
            }

            function loadMoreData(page) {
                $.ajax({
                    url: '/loadMore/' + {{ $data['sinopsis']->items()[0]->id_chapter }} + '?page=' + page,
                    type: 'GET',
                    dataType: 'json', // Specify the data type as JSON
                    success: function(data) {
                        console.log('Received data:', data);
                        if (data.length > 0) {
                            displayDialogs(data);
                            //   updatePaginationButton2(page + 1);
                            history.pushState({
                                page: page
                            }, null, '?page=' + page);


                            if (data.length === 0) {
                                // Tambahkan pesan atau aturan tampilan jika tidak ada data lagi
                                const noMoreDataMessage = 'Besambung.......';
                                $('#infinite-scroll-container').append(noMoreDataMessage);

                                // Nonaktifkan tombol "Next Page"
                                $('#nextBagianBtn').prop('disabled', true);
                            } else {
                                // Aktifkan kembali tombol "Next Page"
                                $('#nextBagianBtn').prop('disabled', false);

                                // Update href atribut tombol "Next Page"
                                $('#prevBagianBtn').attr('href', '/story/chatstory/' +
                                    {{ $data['sinopsis']->isNotEmpty() ? $data['sinopsis']->items()[0]->id_chapter : 'N/A' }} +
                                    '?page=' + (page - 1)
                                );
                                $('#nextBagianBtn').attr('href', '/story/chatstory/' +
                                    {{ $data['sinopsis']->isNotEmpty() ? $data['sinopsis']->items()[0]->id_chapter : 'N/A' }} +
                                    '?page=' + (page + 1)
                                );

                            }
                            $(window).scroll(function() {
                                // Check if the user has reached the bottom of the page
                                if ($(window).scrollTop() + $(window).height() == $(document)
                                    .height()) {

                                    // Load more data when the user reaches the bottom
                                    loadMoreData(currentPage);
                                }
                            });
                            updatePaginationButton(page, pjumlah);


                        } else {
                            // Tambahkan pesan atau aturan tampilan jika tidak ada data lagi

                            const noMoreDataMessage = 'Bersambung..............';
                            $('#infinite-scroll-container').append(noMoreDataMessage);
                            if (data.length === 0 && !isEndOfContent) {
                                // Tambahkan pesan "Bersambung..." hanya sekali
                                const noMoreDataMessage = 'Bersambung..............';
                                $('#infinite-scroll-container').append(noMoreDataMessage);

                                // Atur variabel isEndOfContent menjadi true
                                isEndOfContent = true;

                                // Nonaktifkan tombol "Next Page"
                                $('#nextBagianBtn').prop('disabled', true);
                            } else {
                                // Logika lainnya ...
                            }
                            // Nonaktifkan tombol "Next Page"
                            $('#nextBagianBtn').prop('disabled', true);
                        }
                        loading = false;
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.error(xhr.responseText);
                        loading = false;
                    }
                });
            }
            // function loadMoreData(page) {
            //     $.ajax({
            //         url: '/loadMore/' + {{ $data['datah']->items()[0]->id_chapter }} + '?page=' + page,
            //         type: 'GET',
            //         dataType: 'json', // Specify the data type as JSON
            //         success: function(data) {
            //             console.log('Received data:', data);
            //             if (data.length > 0) {
            //                 displayDialogs(data);
            //                 //   updatePaginationButton2(page + 1);
            //                 history.pushState({
            //                     page: page
            //                 }, null, '?page=' + page);
            //                 currentPage = page; // Update currentPage with the new page number
            //             } else {
            //                 // Tambahkan pesan atau aturan tampilan jika tidak ada data lagi
            //                 const noMoreDataMessage = 'Data tidak ditemukan lagi';
            //                 $('#infinite-scroll-container').append(noMoreDataMessage);

            //                 // Nonaktifkan tombol "Next Page"
            //                 $('#nextBagianBtn').prop('disabled', true);
            //             }

            //             $('#nextBagianBtn').attr('href', '/story/chatstory/' +
            //                 {{ $data['sinopsis']->isNotEmpty() ? $data['sinopsis']->items()[0]->id_chapter : 'N/A' }} +
            //                 '?page=' + (page + 1)
            //             );

            //             // Aktifkan kembali tombol "Previous Page" jika tidak di halaman pertama
            //             if (page > 1) {
            //                 $('#prevBagianBtn').attr('href', '/story/chatstory/' +
            //                     {{ $data['sinopsis']->isNotEmpty() ? $data['sinopsis']->items()[0]->id_chapter : 'N/A' }} +
            //                     '?page=' + (page - 1)
            //                 ).show();
            //             } else {
            //                 $('#prevBagianBtn').hide();
            //             }

            //             $(window).scroll(function() {
            //                 // Check if the user has reached the bottom of the page
            //                 if ($(window).scrollTop() + $(window).height() == $(document)
            //                     .height()) {
            //                     // Load more data when the user reaches the bottom
            //                     loadMoreData(currentPage);
            //                 }
            //             });
            //             updatePaginationButton(page, pjumlah);
            //         },
            //         error: function(xhr, ajaxOptions, thrownError) {
            //             console.error(xhr.responseText);
            //             loading = false;
            //         }
            //     });
            // }

            function updatePaginationButton(currentPage, pjumlah) {
                let buttonText = currentPage + '/' + pjumlah;

                $('#listhalamanBtn').html(buttonText);
            }

            // Event listener for browser back/forward buttons
            window.onpopstate = function(event) {
                if (event.state && event.state.page) {
                    // Load the appropriate page when using back/forward buttons
                    loadMoreData(event.state.page);
                }
            };
        });


        $(document).ready(function() {
            let threshold = 200; // Adjust the threshold value as needed
            let isFixed = false;

            $(window).scroll(function() {
                let scrollPosition = $(window).scrollTop();

                if (scrollPosition > threshold && !isFixed) {
                    if ($(window).width() > 540) {
                        $('.chatstory .card-body .page').css({
                            'position': 'fixed',
                            'top': '0',
                            'padding-top': '30px',
                            'width': '80%',
                            'background-color': '#ffffff',
                            'z-index': '999',
                        });
                    } else {
                        $('.chatstory .card-body .page').css({
                            'position': 'fixed',
                            'top': '0',
                            'padding-top': '30px',
                            'width': '87%', // Adjust the width for 540px
                            'background-color': '#ffffff',
                            'z-index': '999',
                        });
                    }
                    isFixed = true;
                } else if (scrollPosition <= threshold && isFixed) {
                    $('.chatstory .card-body .page').css({
                        'position': 'relative',
                        'padding': '20px 20px',
                        'width': '100%',
                    });
                    isFixed = false;
                }

                // Check if the user has reached the bottom of the page
                if ($(window).scrollTop() + $(window).height() == $(document).height()) {
                    // Assuming you have a function to get the current page from the URL
                    let currentPage = getCurrentPageFromUrl();
                    if (!isNaN(currentPage)) {
                        // Assuming you have a function to load more data
                        loadMoreData(currentPage + 1);
                    }
                }
            });

            // Media query for 540px width
            const mediaQuery = window.matchMedia('(max-width: 540px)');
            mediaQuery.addListener(handleMediaQueryChange);

            function handleMediaQueryChange() {
                if (mediaQuery.matches) {
                    $('.chatstory .card-body .page').css({
                        'width': '100%', // Adjust the width for 540px
                    });
                } else {
                    $('.chatstory .card-body .page').css({
                        'width': '100%',
                    });
                }
            }

            // Initial call to handle media query based on window width
            handleMediaQueryChange();
        });


        $(document).ready(function() {
            let threshold = 200; // Adjust the threshold value as needed
            let isFixed = false;

            $(window).scroll(function() {
                let scrollPosition = $(window).scrollTop();

                if (scrollPosition > threshold && !isFixed) {
                    document.getElementById("footer").style.display = "none";

                    if ($(window).width() > 540) {
                        $('.chatstory .card-body .halaman').css({
                            'position': 'fixed',
                            'bottom': '0',
                            'padding-top': '30px',
                            'width': '85%',
                            'overflow-y': 'hidden', // Fix typo ('overlow-y' to 'overflow-y')
                            'background-color': '#ffffff',
                            'z-index': '999',
                        });
                    } else {
                        $('.chatstory .card-body .halaman').css({
                            'position': 'fixed',
                            'bottom': '0',
                            'padding-top': '30px',
                            'width': '90%', // Adjust the width for 540px
                            'overflow-y': 'hidden',
                            'background-color': '#ffffff',
                            'z-index': '999',
                        });
                    }
                    isFixed = true;
                } else if (scrollPosition <= threshold && isFixed) {
                    $('.chatstory .card-body .halaman').css({
                        'position': 'relative',
                        'padding': '20px 20px',
                        'width': '100%',
                    });
                    isFixed = false;
                }
            });

            // Media query for 540px width
            const mediaQuery = window.matchMedia('(max-width: 540px)');
            mediaQuery.addListener(handleMediaQueryChange);

            function handleMediaQueryChange() {
                if (mediaQuery.matches) {
                    $('.chatstory .card-body .halaman').css({
                        'width': '100%', // Adjust the width for 540px
                    });
                } else {
                    $('.chatstory .card-body .halaman').css({
                        'width': '100%',
                    });
                }
            }

            // Initial call to handle media query based on window width
            handleMediaQueryChange();
        });
    </script>

    <script>
        function myFunction() {
            var x = document.getElementById("cardtengah");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
    <script>
        function toggleListBagian() {
            var listbagian = document.getElementById("listbagian");
            listbagian.classList.toggle("show");
        }
    </script>
@endsection
