function toggleSidebar() {
    var sidebar = document.querySelector(".sidebar");
    sidebar.classList.toggle("active");
}

// Fungsi untuk menutup sidebar saat pengguna mengklik di luar area sidebar atau konten utama
document.addEventListener("mousedown", function (event) {
    var sidebar = document.querySelector(".sidebar");
    var navBurger = document.querySelector(".nav-burger");
    if (!sidebar.contains(event.target) && event.target !== navBurger) {
        sidebar.classList.remove("active");
    }
});
// -------------------------------------------- fungsi dropdown ----------------------------------------------- //
/* Toggle dropdown */
function toggleDropdown(dropdownId) {
    var dropdown = document.getElementById(dropdownId);
    dropdown.classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function (event) {
    if (!event.target.matches(".dropbtn")) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains("show")) {
                openDropdown.classList.remove("show");
            }
        }
    }
};

// Toggle dropdown notifikasi
function toggleDropdownNotif(dropdownId) {
    var dropdown = document.getElementById(dropdownId);
    dropdown.classList.toggle("show1");
}

// Menutup dropdown notifikasi jika diklik di luar area dropdown
document.addEventListener("mousedown", function (event) {
    var dropdownNotif = document.getElementById("dropdownNotif");
    if (!dropdownNotif.contains(event.target)) {
        dropdownNotif.classList.remove("show");
    }
});

// Menutup dropdown notifikasi jika dropdown akun tidak dibuka
window.addEventListener("click", function (event) {
    if (!event.target.matches(".dropbtn1")) {
        var dropdowns = document.getElementsByClassName("dropdown-content1");
        var i;
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains("show1")) {
                openDropdown.classList.remove("show1");
            }
        }
    }
});

document.addEventListener("DOMContentLoaded", function () {
    // Setelah DOM diinisialisasi, tambahkan gaya ke elemen-elemen HTML
    document.body.style.transition = "background-color 0.5s ease";
    document.querySelector(".tabcontent").style.opacity = 1;
});



// ---------------------------------------------------------- characrters ------------------------------------------------------------------- //
var characterCount = 2;
var maxInputs = 3; // Jumlah maksimal elemen input
var btnAddCharacter = document.getElementById('btnAddCharacter');

function addCharacterInput() {
    var charactersContainer = document.getElementById('characters-container');

    // Create a new container for each character input
    var characterContainer = document.createElement('div');
    characterContainer.className = 'mb-3 cursor-hover d-flex align-items-end form-title';
    var existingInputs = charactersContainer.querySelectorAll('.form-title').length;

    if (existingInputs >= maxInputs) {
        // maka button add character disable
        btnAddCharacter.disabled = true;
        btnAddCharacter.innerText = 'Wait...';

        setTimeout(() => {
            btnAddCharacter.disabled = false;
            btnAddCharacter.innerText = 'Add Character';
            alert('Sorry, maximum number of characters reached.');
        }, 1000);
        return;
    } else {
        // Create label element
        var label = document.createElement('label');
        label.className = 'cursor-hover';
        label.innerHTML = '<br>' + 'Characters ' + characterCount++ + '<br>' + '<br>';

        // Create input element
        var newInput = document.createElement('input');
        newInput.className = 'form-control';
        newInput.name = 'character[]';
        newInput.type = 'text';
        newInput.placeholder = 'Please Input Character Stories....';
        newInput.required = true;

        // Create remove button element
        var removeButton = document.createElement('button');
        removeButton.className = 'btn-submit';
        removeButton.type = 'button';
        removeButton.style.color = 'white';
        removeButton.innerHTML = 'Remove Character';
        removeButton.addEventListener('click', function () {
            charactersContainer.removeChild(characterContainer);
            // Enable the button after removing a character
            btnAddCharacter.disabled = false;
            btnAddCharacter.innerText = 'Add Character';
        });

        // Append label, input, and remove button to the character container
        characterContainer.appendChild(label);
        characterContainer.appendChild(newInput);
        characterContainer.appendChild(removeButton);

        // Append the character container to the characters container
        charactersContainer.appendChild(characterContainer);
    }
}


// ================================================================ Dialog =============================================================================== //
var dialogCount = 1; // Initialize dialog count
var dialogCountLabel = 2; // Initialize dialog count
var characCount = 2; // Initialize dialog count
var maxInputsDialog = 4;

function addDialogInput() {
    var btnAddDialog = document.getElementById('btnAddDialog');
    var dialogsContainer = document.getElementById('dialogs-container');

    // Create a new container for each dialog input
    var dialogContainer = document.createElement('div');
    dialogContainer.className = 'mb-3 cursor-hover form-type';
    dialogContainer.setAttribute('data-character-order', dialogCount);

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
        characterLabel.className = 'text1';
        characterLabel.innerHTML = "<br>Character's " + characCount++ + "<br>";

        // Create select element for Character's
        var characterSelect = document.createElement('select');
        characterSelect.name = 'id_character[]';
        characterSelect.id = 'id_character' + dialogCount;
        characterSelect.innerHTML = '<option value="">-- Choice Character\'s --</option>';

        // Add options for Character's from your PHP data
        fetchCharacterOptions(characterSelect);

        // Create div for Dialog
        var dialogDiv = document.createElement('div');
        dialogDiv.className = 'form-title'; // Add class form-title

        // Create label for Dialog
        var dialogLabel = document.createElement('label');
        dialogLabel.className = 'text1';
        dialogLabel.innerHTML = '<br>' + 'Dialog ' + dialogCountLabel++;

        // Create textarea for Dialog
        var dialogTextarea = document.createElement('textarea');
        dialogTextarea.className = 'sinopsis';
        dialogTextarea.name = 'dialog[]';
        // dialogTextarea.placeholder = 'Please Input Character Stories....';
        dialogTextarea.required = true;

        // Create remove button for Dialog
        var removeButton = document.createElement('button');
        removeButton.className = 'btn-submit';
        removeButton.type = 'button';
        removeButton.style.color = 'white';
        removeButton.innerHTML = 'Remove Dialog';
        removeButton.addEventListener('click', function () {
            dialogsContainer.removeChild(dialogContainer);
        });

        // Append elements to the dialog container
        dialogDiv.appendChild(dialogLabel);
        dialogDiv.appendChild(dialogTextarea);
        dialogDiv.appendChild(removeButton);

        dialogContainer.appendChild(characterLabel);
        dialogContainer.appendChild(characterSelect);
        dialogContainer.appendChild(dialogDiv); // Append dialogDiv instead of dialogLabel and dialogTextarea directly

        // Append the dialog container to the dialogs container
        dialogsContainer.appendChild(dialogContainer);
    }
}




function fetchCharacterOptions(selectElement) {
    // Lakukan permintaan Ajax
    $.ajax({
        url: "/writter/dialogs-characters", // Use the named route
        method: 'get',
        dataType: 'json',
        success: function (charactersData) {
            console.log(charactersData);
            // Bersihkan opsi saat ini
            selectElement.innerHTML = '<option value="">-- Choice Character\'s --</option>' + "<br>";

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

