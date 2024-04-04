<!doctype html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('/img/default.png') }}" type="image/x-icon" />

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <style>
        body {
            background-image: url("{{ asset('img/bg.png') }}");
            background-repeat: no-repeat;
            background-size: cover;
            font-family: "Poppins", sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            /* Mengatur posisi horizontal ke tengah */
            align-items: center;
            /* Mengatur posisi vertikal ke tengah */
            height: 95vh;
            overflow: hidden;
        }
    </style>
</head>

<body>
    @yield('content')

</body>

</html>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/popper.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script>
    function togglePassword() {
        var passField = document.getElementById("password");
        var showHideBtn = document.getElementById("showHideBtn");

        if (passField.type === "password") {
            passField.type = "text";
            showHideBtn.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
        } else {
            passField.type = "password";
            showHideBtn.innerHTML = '<i class="fa-solid fa-eye"></i>';
        }
    }

    function togglePassword2() {
        var passField2 = document.getElementById("password_confirmation");
        var showHideBtn2 = document.getElementById("showHideBtn-confirmation");

        if (passField2.type === "password") {
            passField2.type = "text";
            showHideBtn2.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
        } else {
            passField2.type = "password";
            showHideBtn2.innerHTML = '<i class="fa-solid fa-eye"></i>';
        }
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to show popup
        function showPopup(message, isSuccess) {
            var popupContent = document.querySelector('.popup-content');
            if (popupContent) {
                popupContent.innerHTML = message;

                var popup = document.getElementById('popup');
                if (popup) {
                    popup.className = 'popup'; // Remove previous classes

                    if (isSuccess) {
                        popup.classList.add('success'); // Add success class
                    } else {
                        popup.classList.add('error'); // Add error class
                    }

                    popup.style.display = 'block';

                    setTimeout(function() {
                        popup.style.display = 'none';
                    }, 6000); // Hide popup after 6 seconds
                } else {
                    console.error('Element with ID "popup" not found.');
                }
            } else {
                console.error('Element with class "popup-content" not found.');
            }
        }

        // Call showPopup with appropriate message and notification type, for example, after form submission
        @if (session('success'))
            showPopup('<div class="success-notification">{{ session('success') }}</div>',
            true); // Success notification
        @elseif (session('error'))
            showPopup('<div class="error-notification">{{ session('error') }}</div>',
            false); // Error notification
        @elseif ($errors->any())
            var errorsHtml = '';
            @foreach ($errors->all() as $error)
                errorsHtml += '<div class="error-notification">{{ $error }}</div>';
            @endforeach
            showPopup(errorsHtml, false); // Display validation errors
        @endif
    });
</script>
