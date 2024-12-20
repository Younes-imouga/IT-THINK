<?php
include '../db-conect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_id = $_POST['category_id'];  
    $new_category_name = $_POST['new_category_name'];  

    if ($category_id) {
        
        $update_sql = "UPDATE categories SET nom_categorie = ? WHERE id_categorie = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("si", $new_category_name, $category_id);

        if ($update_stmt->execute()) {
            echo "Category updated successfully.";
        } else {
            echo "Error updating category: " . $conn->error;
        }

        $update_stmt->close();
    } else {
        
        $add_sql = "INSERT INTO categories (nom_categorie) VALUES (?)";
        $add_stmt = $conn->prepare($add_sql);
        $add_stmt->bind_param("s", $new_category_name);

        if ($add_stmt->execute()) {
            echo "Category added successfully.";
        } else {
            echo "Error adding category: " . $conn->error;
        }

        $add_stmt->close();
    }

    $conn->close();

    
    header("Location: category-management.php");
    exit();
}
?>
