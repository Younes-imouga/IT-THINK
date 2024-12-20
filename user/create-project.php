<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project</title>
    <link rel="stylesheet" href="user.css">
</head>
<body>
    <div class="header">
        <h1>Create a New Project</h1>
    </div>
    <div class="nav">
        <a href="user_home.php">Home</a>
        <a href="create-project.php">Create Project</a>
        <a href="track-projects.php">Track Projects</a>
        <a href="testimonial.php">Submit Testimonial</a>
        <a href="../log_in.php">Logout</a>
    </div>
    <div class="container">
        <h2>Project Form</h2>
        <form id="create-project-form">
            <div class="form-group">
                <label for="project-title">Project Title</label>
                <input type="text" id="project-title" name="project-title" required>
            </div>
            <div class="form-group">
                <label for="project-description">Description</label>
                <textarea id="project-description" name="project-description" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="freelancer-request">Request a Freelancer</label>
                <input type="text" id="freelancer-request" name="freelancer-request" placeholder="Enter freelancer name" required>
            </div>
            <button type="submit">Submit Project</button>
        </form>
    </div>
</body>
</html>