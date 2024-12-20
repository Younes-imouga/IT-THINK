<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITThink - dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0 auto;
            padding: 0;
            max-width: 1200px;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            margin-top: 200px;
        }

        header {
            background-color: #007BFF;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 15px;
            > h1 {
                margin: 22px;
            }
        }

        .stats-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 22%;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .stat-card h3 {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }

        .stat-card p {
            font-size: 24px;
            color: #007BFF;
            font-weight: bold;
        }

        .optional-stats h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .graph-placeholder {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            height: 300px;
        }

        .graph-placeholder p {
            font-size: 18px;
            color: #555;
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
    <header>
        <h1>Dashboard - Page d'Accueil</h1>
    </header>
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


        <div class="stats-container">
            <div class="stat-card">
                <h3>Nombre total d'utilisateurs</h3>
                <p id="total-users">
                    <?php 
                        include '../db-conect.php';
                        $users_sql = "SELECT COUNT(*) AS total_users FROM utilisateurs";
                        $users_count = $conn->query($users_sql);

                        if ($users_count->num_rows > 0) {
                            $row = $users_count->fetch_assoc();
                            $total_users = $row['total_users'];
                            echo "Total Users: " . $total_users;
                        } else {
                            echo "No User found.";
                        }
                        
                        $conn->close();
                    ?>
                </p>
            </div>
            <div class="stat-card">
                <h3>Nombre de projets publiés</h3>
                <p id="total-projects">
                    <?php 
                        include '../db-conect.php';
                        $Projects_sql = "SELECT COUNT(*) AS total_projects FROM projet";
                        $Projects_count = $conn->query($Projects_sql);

                        if ($Projects_count->num_rows > 0) {
                            $row = $Projects_count->fetch_assoc();
                            $total_projects = $row['total_projects'];
                            echo "Total projects: " . $total_projects;
                        } else {
                            echo "No project found.";
                        }
                        
                        $conn->close();
                    ?>
                </p>
            </div>
            <div class="stat-card">
                <h3>Nombre de freelances inscrits</h3>
                <p id="total-freelancers">
                    <?php 
                        include '../db-conect.php';
                        $freelances_sql = "SELECT COUNT(*) AS total_freelances FROM freelance";
                        $freelances_count = $conn->query($freelances_sql);

                        if ($freelances_count->num_rows > 0) {
                            $row = $freelances_count->fetch_assoc();
                            $total_freelances = $row['total_freelances'];
                            echo "Total Freelances: " . $total_freelances;
                        } else {
                            echo "No Freelances found.";
                        }
                        
                        $conn->close();
                    ?>
                </p>
            </div>
            <div class="stat-card">
                <h3>Offres en cours</h3>
                <p id="active-offers">
                    <?php 
                        include '../db-conect.php';
                        $offers_sql = "SELECT COUNT(*) AS total_offers FROM projet";
                        $offers_count = $conn->query($offers_sql);

                        if ($offers_count->num_rows > 0) {
                            $row = $offers_count->fetch_assoc();
                            $total_offers = $row['total_offers'];
                            echo "Total Offers: " . $total_offers;
                        } else {
                            echo "No Offers found.";
                        }
                        
                        $conn->close();
                    ?>
                </p>
            </div>
        </div>

    </div>
</body>
</html>
