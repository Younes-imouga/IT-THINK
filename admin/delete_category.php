<?php
include '../db-conect.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $category_id = $_GET['id'];

    $delete_sql = "DELETE FROM categories WHERE id_categorie = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $category_id);

    if ($delete_stmt->execute()) {
        echo "Category deleted successfully.";
    } else {
        echo "Error deleting category: " . $conn->error;
    }

    $delete_stmt->close();
    $conn->close();

    header("Location: category-management.php");
    exit();
} else {
    echo "Invalid category ID.";
}
?>
