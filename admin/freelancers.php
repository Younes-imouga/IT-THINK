<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITThink - Freelancers</title>
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
            background-color:rgb(0, 103, 212);
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
        .popup input, .popup button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .popup button {
            background-color: #17a2b8;
            color: white;
            border: none;
            cursor: pointer;
        }
        .popup button:hover {
            background-color: #138496;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Freelancer Management</h1>
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
        <h2>Freelancer List</h2>
        <button onclick="openAddFreelancerPopup()">Add Freelancer</button>
        <ul id="freelancer-list">
            <?php
                include '../db-conect.php';

                $sql = "SELECT * FROM freelance";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        echo "
                            <li>
                                <div>
                                    <h3>Name: {$row["nom_freelance"]}</h3>
                                    <p>Skills: {$row["competence"]}</p>
                                </div>
                                <div>
                                    <button onclick=\"openEditPopup('John Doe')\">Modify</button>
                                    <button class=\"delete\" onclick=\"deleteFreelancer('John Doe')\">Delete</button>
                                </div>
                            </li>
                        ";                        
                    }

                } else {
                    echo "<li> No Freelance found.</li>";
                }

                $conn->close();
            ?>
    </div>
    <div class="popup-overlay" id="popup-overlay"></div>
    <div class="popup" id="popup">
        <h2 id="popup-title">Add/Edit Freelancer</h2>
        <form id="popup-form">
            <label for="freelancer-name">Freelancer Name</label>
            <input type="text" id="freelancer-name" name="freelancer-name" required>
            <button type="submit">Save</button>
        </form>
    </div>
    <script>
        function openAddFreelancerPopup() {
            document.getElementById('popup-title').textContent = "Add Freelancer";
            document.getElementById('popup-form').reset();
            document.getElementById('popup').style.display = 'block';
            document.getElementById('popup-overlay').style.display = 'block';
        }

        function openEditPopup(freelancerName) {
            document.getElementById('popup-title').textContent = "Edit Freelancer";
            document.getElementById('freelancer-name').value = freelancerName;
            document.getElementById('popup').style.display = 'block';
            document.getElementById('popup-overlay').style.display = 'block';
        }

        document.getElementById('popup-form').addEventListener('submit', function (event) {
            event.preventDefault();
            const freelancerName = document.getElementById('freelancer-name').value;
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
