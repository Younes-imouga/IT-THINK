<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITThink - Offers</title>
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
            background-color:#0065d1;
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
        .popup input, .popup textarea, .popup button {
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
        <h1>Offer Management</h1>
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
        <h2>Offer List</h2>
        <button onclick="openAddOfferPopup()">Add Offer</button>
        <ul id="offer-list">
            <?php
                include '../db-conect.php';

                $sql = "SELECT * FROM offre";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        echo "
                            <li style=\"display: flex; justify-content: space-between;\">
                                <div style=\"font-size:1.1em;\">
                                    - Offer ID: {$row["id_offre"]}  --- Project ID: {$row["id_projet"]} <br> <br> Freelance ID: {$row["id_freelance"]}<br> Price: {$row["montant"]}\$ <br> Delai: {$row["delai"]}
                                </div>
                                <div>
                                    <button onclick=\"openEditPopup('Web Development Offer', '500')\">Modify</button>
                                    <button class=\"delete\" onclick=\"deleteOffer('Web Development Offer')\">Delete</button>
                                </div>
                            </li>
                        ";                        
                    }

                } else {
                    echo "<li> No Offer found.</li>";
                }

                $conn->close();
            ?>
        </ul>
    </div>
    <div class="popup-overlay" id="popup-overlay"></div>
    <div class="popup" id="popup">
        <h2 id="popup-title">Add/Edit Offer</h2>
        <form id="popup-form">
            <label for="offer-name">Offer Name</label>
            <input type="text" id="offer-name" name="offer-name" required>
            <label for="offer-price">Offer Price ($)</label>
            <input type="number" id="offer-price" name="offer-price" required>
            <button type="submit">Save</button>
        </form>
    </div>
    <script>
        function openAddOfferPopup() {
            document.getElementById('popup-title').textContent = "Add Offer";
            document.getElementById('popup-form').reset();
            document.getElementById('popup').style.display = 'block';
            document.getElementById('popup-overlay').style.display = 'block';
        }

        function openEditPopup(offerName, offerPrice) {
            document.getElementById('popup-title').textContent = "Edit Offer";
            document.getElementById('offer-name').value = offerName;
            document.getElementById('offer-price').value = offerPrice;
            document.getElementById('popup').style.display = 'block';
            document.getElementById('popup-overlay').style.display = 'block';
        }

        function deleteOffer(offerName) {
            if (confirm(`Are you sure you want to delete "${offerName}"?`)) {
                alert(`Deleted "${offerName}"`);
            }
        }

        document.getElementById('popup-form').addEventListener('submit', function (event) {
            event.preventDefault();
            const offerName = document.getElementById('offer-name').value;
            const offerPrice = document.getElementById('offer-price').value;
            alert(`Saved: ${offerName} - $${offerPrice}`);
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
