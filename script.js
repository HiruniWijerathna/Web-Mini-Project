// script.js

// Function to include the Header content
function includeHeader() {
    // Fetch and insert the Header content
    fetch('header.html')
        .then(response => response.text())
        .then(html => {
            document.getElementById('headerPlaceholder').innerHTML = html;
        })
        .catch(error => console.error('Error fetching header:', error));
}

// Call the includeFooter function when the DOM content is loaded
document.addEventListener('DOMContentLoaded', includeHeader);

// Function to include the footer content
function includeFooter() {
    // Fetch and insert the footer content
    fetch('footer.html')
        .then(response => response.text())
        .then(html => {
            document.getElementById('footerPlaceholder').innerHTML = html;
        })
        .catch(error => console.error('Error fetching footer:', error));
}

// Call the includeHeader function when the DOM content is loaded
document.addEventListener('DOMContentLoaded', includeFooter);


//uplode profile photo

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

// uplode name

function updateText() {
    var typedText = document.getElementById('fname').value;
    document.getElementById('displayText').textContent = typedText;
}

function updatText() {
    var typedText = document.getElementById('lname').value;
    document.getElementById('displaText').textContent = typedText;
}








