<?php
include '../db-conect.php';

$sql = "SELECT * FROM categories";
$result = $conn->query($sql);

$subcategories = [];
if (isset($_GET['category'])) {
    $selectedCategory = intval($_GET['category']);
    $subSql = "SELECT * FROM sous_categories WHERE id_categorie = $selectedCategory";
    $subResult = $conn->query($subSql);

    if ($subResult->num_rows > 0) {
        while ($subRow = $subResult->fetch_assoc()) {
            $subcategories[] = $subRow;
        }
    }
}
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITThink - category-management</title>
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

        .categories-container {
            margin: 20px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .category-list, .subcategory-list {
            list-style: none;
            padding: 0;
        }

        .category-list li {
            padding: 10px;
            border: 1px solid #ddd;
            margin: 10px 0;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .category-list li p {
            cursor: pointer;
        }

        .subcategory-list {
            margin: 10px 0 0 20px;
        }

        .subcategory-list li {
            padding: 8px;
            border: 1px solid #ddd;
            margin: 5px 0;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        button {
            height: 40px;
            font-size: 1em;
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        button.delete, .delete-cat {
            background-color: #DC3545;
        }

        button:hover {
            opacity: 0.9;
        }

        /* Popup styling */
        .popup, .popup2 {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 10;
        }

        .popup-overlay, .popup-overlay2 {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 5;
        }

        .popup form, .popup2 form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .popup form input, .popup form button, .popup2 form input, .popup2 form button {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .popup form button, .popup2 form button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
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
        #sub-cat-title{
            display: none;
        }
        .title-container{
            display: flex; 
            justify-content:space-between;
            > button {
                width: 100px;
                height: 50px;
                font-size: 2em;
                margin: auto 0;
            }
        }
        .category-name{
            text-decoration: none;
            color: black;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Gestion des Catégories</h1>
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

    <div class="categories-container">
        <div class="title-container">
            <h2>Liste des Catégories</h2>
            <button onclick="addCategory()">Add</button>
        </div>
        <ul class="category-list" id="category-list">
            <?php
                include '../db-conect.php';

                $sql = "SELECT * FROM categories";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        echo "
                            <li>
                            <a class=\"category-name\" href=\"?category={$row['id_categorie']}\">
                                <p>{$row['nom_categorie']}</p>
                            </a>
                            <div>
                                    <button class=\"modify-cat\" onclick=\"modifyCategory('{$row['id_categorie']}', '{$row['nom_categorie']}')\">Modify</button>
                                    <button class=\"delete-cat\" onclick=\"DeleteCategory('{$row['id_categorie']}', '{$row['nom_categorie']}')\">Delete</button>
                                </div>
                            </li>
                        ";                        
                    }

                } else {
                    echo "<li> No Category found.</li>";
                }

                $conn->close();
            ?>
        </ul>

        
        <div id="sub-cat-title" class="subcategory-container" <?php if (empty($subcategories)) echo 'style="display: none;"'; ?>>
            <h2>Sous-Catégories</h2>
            <ul class="subcategory-list" id="subcategory-list">
                <?php
                if (!empty($subcategories)) {
                    foreach ($subcategories as $subcategory) {
                        echo "
                            <li>
                                <p>{$subcategory['nom_sous_categorie']}</p>
                                <div>
                                    <button class=\"modify-subcat\" onclick=\"modifySubCategory('{$subcategory['id_sous_categorie']}', '{$subcategory['nom_sous_categorie']}')\">Modify</button>
                                    <button class=\"delete-subcat\" onclick=\"DeleteSubCategory('{$subcategory['id_sous_categorie']}', '{$subcategory['nom_sous_categorie']}')\">Delete</button>
                                </div>
                            </li>
                        ";
                    }
                } else {
                    echo "<li>No subcategories found for this category.</li>";
                }
                ?>
            </ul>
        </div>

    </div>
    
        <div class="popup-overlay" id="popup-overlay"></div>
        <div class="popup" id="popup">
            <h2>Modifier la Sous-Catégorie</h2>
            <form id="edit-subcategory-form">
                <label for="edit-subcategory-name">Nom de la sous-catégorie</label>
                <input type="text" id="edit-subcategory-name" name="edit-subcategory-name" required>

                <button type="submit">Enregistrer</button>
            </form>
        </div>

        
        <div class="popup-overlay2" id="popup-overlay2"></div>
        <div class="popup2" id="popup2">
            <h2>Add Category</h2>
            <form id="modify-category-form" method="POST" action="modify_category.php">
                <input type="hidden" id="category-id" name="category_id"> 
                <label for="new_category_name">Category Name:</label>
                <input type="text" id="new_category_name" name="new_category_name" required>
                <button type="submit">Save Changes</button>
            </form>
        </div>

    <script>
        
        function modifyCategory(id, name) {
            if (id) {
                document.getElementById('category-id').value = id; 
                document.getElementById('new_category_name').value = name; 
                document.getElementById('popup2').querySelector('h2').textContent = 'Modify Category'; 
            } else {
                document.getElementById('category-id').value = ''; 
                document.getElementById('new_category_name').value = ''; 
                document.getElementById('popup2').querySelector('h2').textContent = 'Add Category'; 
            }

            document.getElementById('popup2').style.display = 'block'; 
            document.getElementById('popup-overlay2').style.display = 'block'; 
        }
    
        function addCategory() {
            modifyCategory(null, ''); 
        }

        document.getElementById('popup-overlay2').addEventListener('click', function() {
            document.getElementById('popup2').style.display = 'none';
            document.getElementById('popup-overlay2').style.display = 'none';
        });

        function DeleteCategory(id, name) {
            const confirmation = confirm(`Are you sure you want to delete the category "${name}"?`);
            if (confirmation) {
                
                window.location.href = `delete_category.php?id=${id}`;
            }
        }

    </script>
</body>
</html>
