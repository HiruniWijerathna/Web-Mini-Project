// Array of country names
var countries = [
    "Ahangama", "Akkaraipattu","Aluthgama","Ambalantota","Ambalangoda","Ampara","Ampitiya","Angoda" ,
    "Anuradhapura","Athurugiriya","Avissawella","Balangoda","Bandarawela","Battaramulla","Beliatta","Beruwala",
    "Boralesgamuwa","Chavakachcheri","Chilaw","Dehiwala-Mount Lavinia","Deniyaya","Dikwella","Diyatalawa","Embilipitiya",
    "Eravur",
    "Galle",
    "Gampaha",
    "Hanwella-Ihala",
    "Hambantota",
    "Haputhale",
    "Hatton",
    "Homagama",
    "Horana",
    "Ja-Ela",
    "Kadugannawa",
    "Kaduwela",
    "Kalmunai",
    "Kalutara",
    "Kandana",
    "Kattankudy",
    "Kegalle",
    "Kelaniya",
    "Kesbewa",
    "Kolonnawa",
    "Kotte",
    "Kuliyapitiya",
    "Kurunegala",
    "Mahara",
    "Maharagama",
    "Mannar",
    "Matale",
    "Matara",
    "Matugama",
    "Minuwangoda",
    "Mirigama",
    "Monaragala",
    "Moratuwa",
    "Mullaitivu",
    "Nattandiya",
    "Nawalapitiya",
    "Negombo",
    "Nugegoda",
    "Nuwara Eliya",
    "Padiyathalawa",
    "Panadura",
    "Pannala",
    "Peliyagoda",
    "Polonnaruwa",
    "Puttalam",
    "Ragama",
    "Ratnapura",
    "Seeduwa",
    "Sigiriya",
    "Talawakele",
    "Tangalle",
    "Thalawathugoda",
    "Trincomalee",
    "Vavuniya",
    "Wadduwa",
    "Warakapola",
    "Weligama",
    "Wellawaya",
    "Wennappuwa",
    "Weweldeniya",
    "Yakkala",
    "Bangkok",
    "Beijing",
    "Buenos Aires",
    "Cairo",
    "Dubai",
    "Istanbul",
    "Johannesburg",
    "London",
    "Los Angeles",
    "Mexico City",
    "Moscow",
    "Mumbai",
    "Nairobi",
    "New York City",
    "Osaka",
    "Paris",
    "Rome",
    "São Paulo",
    "Shanghai",
    "Sydney",
    "Tokyo",
    "Toronto"
    

    
    
    // Add more countries as needed
];

// Function to populate the dropdown with a list of countries
function populateCountries() {
    var selectElement = document.getElementById("countrySelect");
    for (var i = 0; i < countries.length; i++) {
        var option = document.createElement("option");
        option.text = countries[i];
        option.value = countries[i];
        selectElement.add(option);
    }
}

// Call the populateCountries function when the page loads
window.onload = populateCountries;

// Function to preview uploaded image
function previewImage(event) {
    var preview = document.getElementById('preview');
    var uploadInput = document.getElementById('uploadInput');
    preview.style.display = "block";
    preview.src = URL.createObjectURL(event.target.files[0]);
    uploadInput.style.display = "none";
}

// Function to remove uploaded photo
function removePhoto() {
    var preview = document.getElementById('preview');
    var uploadInput = document.getElementById('uploadInput');
    preview.src = "image/addphotoLogo.jpg";
    uploadInput.value = ""; // Clear the selected file
    uploadInput.style.display = "block";
}

// Function to validate form before submission
function validateForm() {
    var title = document.getElementById('title').value;
    var description = document.getElementById('about').value;
    if (title.trim() === '' || description.trim() === '') {
        alert('Title and Description cannot be empty');
        return false;
    }
    return true;
}
