// includeContent.js

// Function to include the header
function includeHeader() {
    // Fetch the header.html file
    fetch('header.html')
        .then(response => response.text()) // Get the text from the response
        .then(html => {
            // Insert the header HTML into the 'header' div
            document.getElementById('header').innerHTML = html;
        });
}

// Function to include the footer
function includeFooter() {
    // Fetch the footer.html file
    fetch('footer.html')
        .then(response => response.text()) // Get the text from the response
        .then(html => {
            // Insert the footer HTML into the 'footer' div
            document.getElementById('footer').innerHTML = html;
        });
}

// Call the functions to include the header and footer when the page loads
window.addEventListener('DOMContentLoaded', function() {
    includeHeader();
    includeFooter();
});
