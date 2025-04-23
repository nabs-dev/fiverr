<?php
session_start();
include 'db.php';
if (!isset($_SESSION['userid'])) {
    echo "<script>window.location.href='login.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $delivery = $_POST['delivery_time'];
    $seller_id = $_SESSION['userid'];

    // Handle Image Upload
    $imageName = '';
    if (!empty($_FILES['gig_image']['name'])) {
        $imageName = time() . '_' . basename($_FILES['gig_image']['name']);
        $target = "uploads/" . $imageName;
        move_uploaded_file($_FILES['gig_image']['tmp_name'], $target);
    }

    $conn->query("INSERT INTO gigs (title, description, price, delivery_time, seller_id, gig_image) 
                  VALUES ('$title', '$desc', '$price', '$delivery', '$seller_id', '$imageName')");
    echo "<script>window.location.href='dashboard.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Gig</title>
    <style>
        body { font-family: Arial; background: #f9f9f9; display: flex; justify-content: center; align-items: center; height: 100vh; }
        form { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px #ccc; width: 400px; }
        input, textarea { width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 5px; border: 1px solid #ddd; }
        input[type=submit] { background: #e67e22; color: white; border: none; cursor: pointer; }
        input[type=submit]:hover { background: #d35400; }
    </style>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <h2>Create Your Gig</h2>
        <input type="text" name="title" placeholder="Gig Title" required />
        <textarea name="description" placeholder="Gig Description" rows="4" required></textarea>
        <input type="number" name="price" placeholder="Price in $" required />
        <input type="number" name="delivery_time" placeholder="Delivery Time (days)" required />
        <input type="file" name="gig_image" accept="image/*" />
        <input type="submit" value="Create Gig" />
    </form>
</body>
</html>
