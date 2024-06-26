<?php
session_start(); // Start session at the very beginning of the file

// Store the current page in the session
$_SESSION['previous_page'] = 'readpost.php';

// Ensure session variables are set
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Posts | BeastBuddy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/readspost.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .comment-section {
            position: relative;
            z-index: 10;
        }
    </style>
</head>
<body style="background-color:rgb(173, 220, 241);">

<!-- Header -->
<div class="container-fluid px-4 border-bottom shadow-bottom" style="background-color: #080433">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom ">
        <div class="col-md-3 mb-2 mb-md-0">
            <a href="home.php" class="d-inline-flex link-body-emphasis text-decoration-none">
                <img src="image/logo.png" alt="Your Logo" class="logo">
            </a>
        </div>
        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="registerUserHomePage.php" class="nav-link px-2">Home</a></li>
            <li><a href="registerUserHomePage.php#ReService" class="nav-link px-2">Services</a></li>
            <li><a href="about.php" class="nav-link px-2 ">About</a></li>
            <li><a href="help.php" class="nav-link px-2">Help</a></li>
        </ul>
        <div class="col-md-3 text-end">
            <p id="hh" style="color:White; font-size: 18px">👋 Hi, <?php echo htmlspecialchars($username); ?></p>
        </div>
    </header>
</div>
<!-- Carousel Section -->
<div style="background-color:rgb(173, 220, 241);">
   <div id="myCarousel" class="carousel slide mb-6 pointer-event" data-bs-ride="carousel" style="margin-top: -0.1rem">
       <div class="carousel-inner">
         <div class="carousel-item active hover-item" >
           <img src="image/ReadPostMainImage.jpg" class="d-block w-100" alt="Image 2">
           <div class="container">
             <div class="carousel-caption text-start">
               <h1 style="color: black">Read Post🧾📚</h1>
               <p class="opacity-75" style="color:black">Come read, wander the animal world🚀</p>
             </div>
           </div>
         </div>
       </div>
   </div>
</div>
<!-- Content Section -->
<div class="container mt-5">
    <div class="row">
        <?php
        // Establish database connection
        $servername = "localhost";
        $db_username = "root";
        $db_password = "";
        $dbname = "beastbuddy";

        // Create connection
        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch posts from the database
        $sql = "SELECT posts.post_id, posts.user_id, posts.title, posts.content, posts.location, posts.image, users.username 
                FROM posts 
                INNER JOIN users ON posts.user_id = users.user_id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $post_id = $row['post_id'];
                echo "<div class='col-md-6 mb-4'>
                        <div class='card'>
                            <p class='card-text'><small class='text-muted'><img src='image/location.png' class='location_img' alt='location Image'> " . htmlspecialchars($row["location"]) . "</small></p>
                            <img src='uploads/" . htmlspecialchars($row['image']) . "' class='card-img-top' alt='Post Image'>
                            <div class='card-body'>
                                <h5 class='card-title'>" . htmlspecialchars($row["title"]) . "</h5>
                                <p class='card-text'>" . htmlspecialchars($row["content"]) . "</p>
                                <p class='card-text'><small class='text-muted'>Posted by: " . htmlspecialchars($row["username"]) . "</small></p>";
                if ($row["user_id"] == $user_id) {
                    echo "<a href='edit_post.php?post_id=" . $row['post_id'] . "' class='btn btn-primary'>Edit</a>
                          <a href='delete_post.php?post_id=" . $row['post_id'] . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this post?\");'>Delete</a>";
                }

                   // Display comments
                echo "<button class='btn btn-secondary ' data-bs-toggle='collapse' data-bs-target='#comments$post_id'> Comments </button>
                      <div id='comments$post_id' class='collapse mt-2 comment-section'>
                          <div class='card card-body' style='background-color:  #d0d0d0;'>
                              <h6 style='color:black;'>Comments:</h6>";
                // Fetch comments for this post
                $sql_comments = "SELECT comments.comment, users.username AS comment_username, comments.guest_name 
                                 FROM comments 
                                 LEFT JOIN users ON comments.user_id = users.user_id 
                                 WHERE comments.post_id = $post_id";
                $result_comments = $conn->query($sql_comments);
                if ($result_comments->num_rows > 0) {
                    while ($comment_row = $result_comments->fetch_assoc()) {
                        $comment_username = $comment_row['comment_username'] ? $comment_row['comment_username'] : $comment_row['guest_name'];
                        echo "<p style='color:black;'><strong>" . htmlspecialchars($comment_username) . ":</strong> " . htmlspecialchars($comment_row['comment']) . "</p>";
                    }
                } else {
                    echo "<p style='color:black;' >No comments yet.</p>";
                }

                // Comment form
                echo "<div class='mt-4'>
                        <form  method='POST' action='add_comment.php'>
                            <!-- Your comment form goes here -->
                            <input type='hidden' name='post_id' value='" . $post_id . "'>";
                if ($user_id) {
                    echo "<div class='mb-3'>
                            <textarea class='form-control' name='comment' placeholder='Add a comment...' required></textarea>
                          </div>";
                } else {
                    echo "<div class='mb-3'>
                            <input type='text' class='form-control' name='guest_name' placeholder='Your name' required>
                          </div>
                          <div class='mb-3'>
                            <textarea class='form-control' name='comment' placeholder='Add a comment...' required></textarea>
                          </div>";
                }
                echo "<button type='submit' class='btn btn-primary'>Post Comment</button>
                        </form>
                      </div>
                      </div>
                      </div>";

                echo "</div></div></div>";
            }
        } else {
            echo "<div class='col-md-12'><p>No  posts found.</p></div>";
        }

        $conn->close();
        ?>
    </div>
</div>

<!-- Footer -->
<div class="container-fluid px-4" style="background-color: #080433">
    <footer class="py-1">
        <div class="row flex-lg-row-align-items-center g-5" style="background-color: #080433">
            <div class="col-md-4 offset-md-1 mb-5">
                <div class="text-white">
                    <h5>BeastBuddy</h5>
                    <p class="descrip">Dedicated to saving lives, one paw at a time. Our passionate team connects animals with loving homes, making a difference in the world of animal rescue.</p>
                </div>
            </div>
            <div class="col-6 col-md-3 mb-5">
                <h5 class="text-white">Follow Us On</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="https://www.facebook.com/profile.php?id=61579515877382" class="nav-link p-0 text-body-secondary">Facebook</a></li>
                    <li class="nav-item mb-2"><a href="https://www.instagram.com/__beastbuddy__?igsh=MTZtbGp3bmhzNGk3eA==" class="nav-link p-0 text-body-secondary">Instagram</a></li>
                    <li class="nav-item mb-2"><a href="https://youtube.com/@beastbuddy-2024?si=P8ZBuQ0NL2N8WTv6" class="nav-link p-0 text-body-secondary">Youtube</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-2 mb-5">
                <h5 class="text-white">Quick Links</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="home.php#myCarousel" class="nav-link p-0 text-body-secondary">Home</a></li>
                    <li class="nav-item mb-2"><a href="home.php#services" class="nav-link p-0 text-body-secondary">Service</a></li>
                    <li class="nav-item mb-2"><a href="home.php#about" class="nav-link p-0 text-body-secondary">About</a></li>
                    <li class="nav-item mb-2"><a href="home.php#help" class="nav-link p-0 text-body-secondary">Help</a></li>
                </ul>
            </div>
            <div class="d-flex flex-column flex-sm-row justify-content-center border-top">
                <p class="descrip">© 2024 BeastBuddy, Inc. All rights reserved.</p>
            </div>
        </div>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Include jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    // AJAX function to submit comment form
    $(document).on('submit', 'form.comment-form', function(e) {
        e.preventDefault(); // Prevent default form submission

        // Get form data
        var formData = $(this).serialize();

        // Submit form data asynchronously using AJAX
        $.ajax({
            type: 'POST',
            url: 'add_comment.php',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // If comment submission is successful, append the new comment to the comments section
                    var comment = response.comment;
                    var commentHtml = '<p><strong>' + comment.username + ':</strong> ' + comment.comment + '</p>';
                    $(commentHtml).appendTo('#comments' + comment.post_id + ' .comment-body');
                } else {
                    // If comment submission fails, display an error message
                    alert('Failed to submit comment.');
                }
            },
            error: function() {
                // If there's an error with the AJAX request, display an error message
                alert('Error submitting comment. Please try again.');
            }
        });
    });
</script>

<!--.post color change. -->
<script>
    function changePostColors() {
  const posts = document.querySelectorAll('.card');

  // Choose a logic for color changes (replace with your desired logic)
  // Here, we use a repeating value based on current time (every 5 seconds)
  const currentTime = Math.floor(Date.now() / 1000) % 3; // Repeating value between 0, 1, and 2 every 3 seconds

  for (const post of posts) {
    // Remove existing color classes (optional, ensures only one color is applied)
    post.classList.remove('card-red', 'card-blue', 'card-green');

    // Apply new color class based on chosen logic
    if (currentTime === 0) {
      post.classList.add('card-red');
    } else if (currentTime === 1) {
      post.classList.add('card-blue');
    } else {
      post.classList.add('card-green');
    }
  }
}

// Call the function initially to set initial colors (if not set by PHP)
changePostColors();

// Set an interval to call the function repeatedly (adjust the interval as needed)
setInterval(changePostColors, 5000); // Change color every 5 seconds
</script>
<!--.post color change end -->



</body>
</html>
