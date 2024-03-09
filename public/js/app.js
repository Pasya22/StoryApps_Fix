// import './bootstrap';
// JavaScript to toggle the active class and control the dropdown
document.addEventListener("DOMContentLoaded", function () {
    var sidebarMenu = document.querySelector('.datamaster');

    sidebarMenu.addEventListener('click', function (e) {
        var target = e.target;
        if (target.tagName === 'A') {
            e.preventDefault();
            var li = target.closest('li');
            if (li) {
                li.classList.toggle('active');
            }
        }
    });
});


// cara get data di halaman data user dari  controller dengan ajax jquery agar realtime di laravel untuk di tampil di

// ================================================================ character =============================================================================== //
var characterCount = 2;
var maxInputs = 5; // Jumlah maksimal elemen input
var btnAddCharacter = document.getElementById('btnAddCharacter');

function addCharacterInput() {
    var charactersContainer = document.getElementById('characters-container');

    // Create a new container for each character input
    var characterContainer = document.createElement('div');
    characterContainer.className = 'mb-3 cursor-hover d-flex align-items-end character-input';
    var existingInputs = charactersContainer.querySelectorAll('.character-input').length;

    // // Jika sudah mencapai batas maksimal, keluar dari fungsi
    // if (existingInputs >= maxInputs) {
    //     // alert('Maximum number of inputs reached.');
    //     // maka tombol add character disable, tapi jika tombol remove character klik maka kembali lagi enable tombol add character

    //     return;
    // }
    if (existingInputs >= maxInputs) {
        // maka button add character disable
        btnAddCharacter.disabled = true;
        btnAddCharacter.offsetHeight;

        btnAddCharacter.value = 'Wait...';

        setTimeout(() => {
            btnAddCharacter.disabled = false;
            btnAddCharacter.value = 'Add Another Character';
            alert('Punten, Teu Tiasa Nambihan Deui Character');
        }, 1000);
        return;

    } else {


        // Create label element
        var label = document.createElement('label');
        label.className = 'cursor-hover';
        label.innerHTML = 'Characters' + characterCount++;

        // Create input element
        var newInput = document.createElement('input');
        newInput.className = 'form-control';
        newInput.name = 'character[]';
        newInput.type = 'text';
        newInput.placeholder = 'Please Input Character Stories....';
        newInput.required = true;

        // Create remove button element
        var removeButton = document.createElement('button');
        removeButton.className = 'btn btn-danger ml-2';
        removeButton.type = 'button';
        removeButton.innerHTML = 'Remove Character';
        removeButton.addEventListener('click', function () {
            charactersContainer.removeChild(characterContainer);
            // Enable the button after removing a character
            btnAddCharacter.disabled = false;
            btnAddCharacter.value = 'Add Another Character';
        });



        // Append label, input, and remove button to the character container
        characterContainer.appendChild(label);
        characterContainer.appendChild(newInput);
        characterContainer.appendChild(removeButton);

        // Append the character container to the characters container
        charactersContainer.appendChild(characterContainer);
    }
}

// ================================================================ end Character =============================================================================== //

// ================================================================ Dialog =============================================================================== //
var dialogCount = 1; // Initialize dialog count
var dialogCountLabel = 2; // Initialize dialog count
var characCount = 2; // Initialize dialog count
var maxInputsDialog = 7;

function addDialogInput() {
    var btnAddDialog = document.getElementById('btnAddDialog');
    var dialogsContainer = document.getElementById('dialogs-container');

    // Create a new container for each dialog input
    var dialogContainer = document.createElement('div');
    dialogContainer.className = 'mb-3 cursor-hover';

    // Increment the dialog count
    dialogCount++;

    if (dialogsContainer.children.length >= maxInputsDialog) {
        // maka button add character disable
        btnAddDialog.disabled = true;
        btnAddDialog.value = 'Wait...';

        setTimeout(() => {
            btnAddDialog.disabled = false;
            btnAddDialog.value = 'Add Another Dialog';
            alert('Punten, Teu Tiasa Nambihan Deui Dialog');
        }, 1000);
        return;
    } else {
        // Create label for Character's
        var characterLabel = document.createElement('label');
        characterLabel.className = 'cursor-hover';
        characterLabel.innerHTML = "Character's " + characCount++;

        // Create select element for Character's
        var characterSelect = document.createElement('select');
        characterSelect.name = 'id_character[]';
        characterSelect.id = 'id_character' + dialogCount;
        characterSelect.className = 'form-control cursor-hover';
        characterSelect.innerHTML = '<option value="">-- Choice Character\'s --</option>';

        // Add options for Character's from your PHP data
        fetchCharacterOptions(characterSelect);

        // Create label for Dialog
        var dialogLabel = document.createElement('label');
        dialogLabel.className = 'cursor-hover mt-2';
        dialogLabel.innerHTML = 'Dialog ' + dialogCountLabel++;

        // Create textarea for Dialog
        var dialogTextarea = document.createElement('textarea');
        dialogTextarea.className = 'form-control';
        dialogTextarea.name = 'dialog[]';
        dialogTextarea.placeholder = 'Please Input Character Stories....';
        dialogTextarea.required = true;

        // Create remove button for Dialog
        var removeButton = document.createElement('button');
        removeButton.className = 'btn btn-danger mt-4';
        removeButton.type = 'button';
        removeButton.innerHTML = 'Remove Dialog';
        removeButton.addEventListener('click', function () {
            dialogsContainer.removeChild(dialogContainer);
        });

        // Append elements to the dialog container
        dialogContainer.appendChild(characterLabel);
        dialogContainer.appendChild(characterSelect);
        dialogContainer.appendChild(dialogLabel);
        dialogContainer.appendChild(dialogTextarea);
        dialogContainer.appendChild(removeButton);
        // Simpan informasi urutan karakter pada elemen dialog
        dialogContainer.dataset.characterOrder = dialogCount;

        // Append the dialog container to the dialogs container
        dialogsContainer.appendChild(dialogContainer);
    }
}


function fetchCharacterOptions(selectElement) {
    // Lakukan permintaan Ajax
    $.ajax({
        url: "/get-characters", // Use the named route
        method: 'get',
        dataType: 'json',
        success: function (charactersData) {
            console.log(charactersData);
            // Bersihkan opsi saat ini
            selectElement.innerHTML = '<option value="">-- Choice Character\'s --</option>';

            // Populasi opsi dari data yang diterima
            if (charactersData && Array.isArray(charactersData)) {
                for (var i = 0; i < charactersData.length; i++) {
                    var character = charactersData[i];
                    if (character.character.length > 2) {
                        var option = document.createElement('option');
                        option.value = character.id_character;
                        option.text = character.character + ' chapter' + character.id_chapter;
                        selectElement.appendChild(option);
                    }
                }
            } else {
                console.error('Invalid or missing characters data.');
            }

        },
        error: function (xhr, status, error) {
            console.error('Error fetching characters data:', error);
        }
    });
}

// ================================================================ end Dialog =============================================================================== //


// ================================================================ Infromation User =============================================================================== //
function previewImage(event) {
    var input = event.target;

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#previewImage').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
// ================================================================ end Infromation User =============================================================================== //

// ================================================================  Visibility User Password =============================================================================== //
function togglePasswordVisibility(inputId) {
    var passwordInput = document.getElementById(inputId);
    var icon = passwordInput.nextElementSibling.querySelector('.visibility-icon');

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = "password";
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// alert updated password moving
setTimeout(function () {
    document.getElementById('successMessage').style.display = 'none';
}, 2000);

// ================================================================  end Visibility User Password =============================================================================== //

// ================================================================ Count Rating Stories =============================================================================== //
// Function to handle star ratings in descending order
function updateStars(count) {
    for (let i = 1; i <= 5; i++) {
        const star = document.getElementById(`star-${i}`);
        if (i > count) {
            star.classList.add('checked');
        } else {
            star.classList.remove('checked');
        }
    }
}

// Example of how to use the function
document.addEventListener('DOMContentLoaded', function () {
    // Assuming you have an array of counts in the Blade template
    const counts = [5, 4, 3, 2, 1];

    // Loop through counts and update stars dynamically
    // Loop through counts and update stars dynamically
    counts.forEach((count, index) => {
        updateStars(count, index + 1);
    });
});

// ================================================================ end Count Rating Stories =============================================================================== //
