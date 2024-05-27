//upload profile photo

function previewImage(event) {
    var preview = document.getElementById('preview');
    var uploadInput = document.getElementById('uploadInput');
    preview.style.display = "block";
    preview.src = URL.createObjectURL(event.target.files[0]);
    uploadInput.style.display = "none";
}

function removePhoto() {
    var preview = document.getElementById('preview');
    var uploadInput = document.getElementById('uploadInput');
    
    preview.src = "image/profilePhotoLogo.jpg";
    uploadInput.value = ""; // Clear the selected file
    uploadInput.style.display = "block";
}

// upload name

function updateText() {
    var typedText = document.getElementById('fname').value;
    document.getElementById('displayText').textContent = typedText;
}

function updatText() {
    var typedText = document.getElementById('lname').value;
    document.getElementById('displaText').textContent = typedText;
}


