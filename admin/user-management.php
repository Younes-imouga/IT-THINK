<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITThink - Users Management</title>
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

        .table-container {
            margin: 20px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        button {
            background-color: #007BFF;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
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

    </style>
</head>
<body>
    <div class="header">
        <h1>Gestion des Utilisateurs</h1>
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

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include '../db-conect.php';

                    $sql = "SELECT * FROM utilisateurs";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {

                        while ($row = $result->fetch_assoc()) {
                            if ($row["id_utilisateur"] == 1) {
                                echo "
                                <tr>
                                    <td>{$row["id_utilisateur"]}</td>
                                    <td>{$row["nom_utilisateur"]}</td>
                                    <td>{$row["email"]}</td>
                                    <td>Admin</td>
                                    <td>
                                        <button>Supprimer</button>
                                    </td>
                                </tr>
                            ";   
                            } else {
                                echo "
                                    <tr>
                                        <td>{$row["id_utilisateur"]}</td>
                                        <td>{$row["nom_utilisateur"]}</td>
                                        <td>{$row["email"]}</td>
                                        <td>Utilisateur</td>
                                        <td>
                                            <button>Supprimer</button>
                                        </td>
                                    </tr>
                                "; 
                            }                       
                        }

                    } else {
                        echo "<li> No Projects found.</li>";
                    }

                    $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
