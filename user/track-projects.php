<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Projects</title>
    <link rel="stylesheet" href="user.css">
</head>
<body>
    <div class="header">
        <h1>Track Your Projects</h1>
    </div>
    <div class="nav">
        <a href="user_home.php">Home</a>
        <a href="create-project.php">Create Project</a>
        <a href="track-projects.php">Track Projects</a>
        <a href="testimonial.php">Submit Testimonial</a>
        <a href="../logout.php">Logout</a>
    </div>
    <div class="container">
        <h2>Ongoing Projects</h2>
        <ul id="project-list">
            <li>
                Project: Website Development
                <div>
                    <button onclick="viewDetails('Website Development')">View Details</button>
                </div>
            </li>
        </ul>
    </div>
</body>
</html>