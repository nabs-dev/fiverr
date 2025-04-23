<?php
include 'db.php';
$gigs = $conn->query("SELECT gigs.*, users.username FROM gigs JOIN users ON gigs.seller_id = users.id ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Fiverr Clone - Homepage</title>
    <style>
        body { font-family: Arial; margin: 0; background: #f1f1f1; }
        header { background: #34495e; padding: 20px; color: white; text-align: center; }
        .gigs { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; padding: 30px; }
        .gig { background: white; padding: 15px; border-radius: 10px; box-shadow: 0 0 8px #ccc; }
        .gig h3 { margin: 0 0 10px; }
        .gig p { font-size: 14px; margin-bottom: 5px; }
        .gig span { font-weight: bold; color: #2ecc71; }
        .topbar { text-align: center; margin: 20px; }
        .topbar a { padding: 10px 20px; background: #27ae60; color: white; text-decoration: none; border-radius: 5px; margin: 0 10px; }
        .topbar a:hover { background: #1e8449; }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to Fiverr Clone</h1>
    </header>
    <div class="topbar">
        <a href="signup.php">Sign Up</a>
        <a href="login.php">Login</a>
    </div>
    <div class="gigs">
        <?php while ($row = $gigs->fetch_assoc()): ?>
            <div class="gig">
                <h3><?php echo $row['title']; ?></h3>
                <p><?php echo $row['description']; ?></p>
                <p>By: <span><?php echo $row['username']; ?></span></p>
                <p>Price: <span>$<?php echo $row['price']; ?></span></p>
                <p>Delivery: <?php echo $row['delivery_time']; ?> days</p>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
