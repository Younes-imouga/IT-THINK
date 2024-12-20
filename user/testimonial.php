<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Testimonial</title>
    <link rel="stylesheet" href="user.css">
    </head>
<body>
    <div class="header">
        <h1>Submit a Testimonial</h1>
    </div>
    <div class="nav">
        <a href="user_home.php">Home</a>
        <a href="create-project.php">Create Project</a>
        <a href="track-projects.php">Track Projects</a>
        <a href="testimonial.php">Submit Testimonial</a>
        <a href="../logout.php">Logout</a>
    </div>
    <div class="container">
        <h2>Your Testimonial</h2>
        <form id="testimonial-form">
            <div class="form-group">
                <label for="testimonial-content">Testimonial</label>
                <textarea id="testimonial-content" name="testimonial-content" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="project-name">Project Name</label>
                <input type="text" id="project-name" name="project-name" required>
            </div>
            <button type="submit">Submit Testimonial</button>
        </form>
    </div>
</body>
</html>