<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Country</title>
    <link rel="stylesheet" href="css/createPost.css">
    <script src="js/createPost.js"></script>
</head>
<body style ="background-color: rgb(173, 220, 241);">
    
    
    <div id="all">
        <div>
            <h1 >Create Post</h1>
        </div>

<div>
    <div>

    <div>
          <select id="countrySelect" ><option selected>Select Category</option>
        <!-- Options will be dynamically added here -->
    </select>
    </div>

    <div>
       <input type="ctext" id="city" name="City" placeholder="City name">
    </div>   

    <div>
        <select class="form-select" id="floatingCategory" >
            <option selected>Select Category</option>
            <option value="category1">Normal User</option>
            <option value="category2">veterinarian</option>
            <option value="category3">Snake Catcher</option>
            <option value="category3">animal Organization</option>
            <!-- Add more options as needed -->
        </select>
    </div>


    </div>

    </div>


    <form action="/action">
        <div class="detailpart">
        <input type="text" id="litle" name="title" placeholder="Title" >
        <br>
        <div id="descriptionPart">
            <input type="file" id="uploadInput" accept="image/*" onchange="previewImage(event)">
            <button onclick="removePhoto()"></button>
            <br>
            <img id="preview" src="image/addphotoLogo.jpg" alt="Preview Image">
    
        </div>
        <br>
        <textarea id="about" name="about" placeholder="Discription" rows="10"></textarea>
        <br>
        <input type="submit" value="Save">
    </div>
       
        
    </form>
  
</div>



</body>
</html>
