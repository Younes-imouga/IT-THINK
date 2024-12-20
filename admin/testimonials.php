<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITThink - Testimonials</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0 auto;
            padding: 0;
            max-width: 1200px;
        }

        .header {
            background-color: #007BFF;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 15px;
        }
        .nav {
            display: flex;
            justify-content: center;
            background-color: #333;
            margin-bottom: 30px;
            border-radius: 15px;
            box-shadow: 1px 1px 5px black;
        }

        .nav a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
            text-align: center;
        }

        .nav a:hover {
            background-color: #ddd;
            color: black;
        }
        .container {
            padding: 20px;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background-color: #0065d1;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        ul li {
            padding: 10px;
            margin-bottom: 10px;
            background-color: white;
            border: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 4px;
            z-index: 1001;
            width: 300px;
        }
        .popup h2 {
            margin-top: 0;
        }
        .popup textarea, .popup button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .popup button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        .popup button:hover {
            background-color: #0065d1;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Testimonial Management</h1>
    </div>
    <div class="nav">
        <a href="dashboard.php">Home</a>
        <a href="category-management.php">Categories</a>
        <a href="projects.php">Projects</a>
        <a href="user-management.php">Users</a>
        <a href="freelancers.php">Freelancers</a>
        <a href="offers.php">Offers</a>
        <a href="testimonials.php">Testimonials</a>
        <a href="../logout.php">Logout</a>
    </div>
    <div class="container">
        <h2>Testimonials</h2>
        <button onclick="openAddTestimonialPopup()">Add Testimonial</button>
        <ul id="testimonial-list">
            <li>
                "ITThink has revolutionized the way we work!" - John Doe
                <div>
                    <button onclick="openEditPopup('ITThink has revolutionized the way we work!', 'John Doe')">Modify</button>
                    <button class="delete" onclick="deleteTestimonial('ITThink has revolutionized the way we work!')">Delete</button>
                </div>
            </li>
        </ul>
    </div>
    <div class="popup-overlay" id="popup-overlay"></div>
    <div class="popup" id="popup">
        <h2 id="popup-title">Add/Edit Testimonial</h2>
        <form id="popup-form">
            <label for="testimonial-content">Testimonial</label>
            <textarea id="testimonial-content" name="testimonial-content" required></textarea>
            <label for="testimonial-author">Author</label>
            <input type="text" id="testimonial-author" name="testimonial-author" required>
            <button type="submit">Save</button>
        </form>
    </div>
    <script>
        function openAddTestimonialPopup() {
            document.getElementById('popup-title').textContent = "Add Testimonial";
            document.getElementById('popup-form').reset();
            document.getElementById('popup').style.display = 'block';
            document.getElementById('popup-overlay').style.display = 'block';
        }

        function openEditPopup(content, author) {
            document.getElementById('popup-title').textContent = "Edit Testimonial";
            document.getElementById('testimonial-content').value = content;
            document.getElementById('testimonial-author').value = author;
            document.getElementById('popup').style.display = 'block';
            document.getElementById('popup-overlay').style.display = 'block';
        }

        function deleteTestimonial(content) {
            if (confirm(`Are you sure you want to delete this testimonial: "${content}"?`)) {
                alert(`Deleted testimonial: "${content}"`);
            }
        }

        document.getElementById('popup-form').addEventListener('submit', function (event) {
            event.preventDefault();
            const content = document.getElementById('testimonial-content').value;
            const author = document.getElementById('testimonial-author').value;
            alert(`Saved testimonial: "${content}" - ${author}`);
            document.getElementById('popup').style.display = 'none';
            document.getElementById('popup-overlay').style.display = 'none';
        });

        document.getElementById('popup-overlay').addEventListener('click', function () {
            document.getElementById('popup').style.display = 'none';
            document.getElementById('popup-overlay').style.display = 'none';
        });
    </script>
</body>
</html>
