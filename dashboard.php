<?php
session_start();
include 'db.php';
if (!isset($_SESSION['userid'])) {
    echo "<script>window.location.href='login.php';</script>";
    exit;
}
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];

// Query to fetch all gigs
$gigs = $conn->query("SELECT * FROM gigs ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background: #ecf0f1; margin: 0; padding: 0; }
        header { background: #2ecc71; color: white; padding: 20px; text-align: center; }
        .topbar { display: flex; justify-content: space-between; align-items: center; padding: 10px 30px; background: #27ae60; }
        .topbar a { color: white; text-decoration: none; margin-left: 20px; font-weight: bold; }
        .gigs { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; padding: 30px; }
        .gig { background: white; padding: 15px; border-radius: 10px; box-shadow: 0 0 8px #ccc; }
        .gig img { width: 100%; height: 160px; object-fit: cover; border-radius: 8px; margin-bottom: 15px; }
        .gig h3 { margin: 0 0 10px 0; font-size: 18px; }
        .gig p { font-size: 14px; color: #555; }
        .gig span { font-weight: bold; color: #27ae60; }
        .gig button { background: #3498db; border: none; padding: 10px; color: white; border-radius: 5px; cursor: pointer; }
        .gig button:hover { background: #2980b9; }
    </style>
</head>
<body>
    <header>
        <h1>Welcome, <?php echo $username; ?> 👋</h1>
    </header>
    <div class="topbar">
        <div><strong>Dashboard</strong></div>
        <div>
            <a href="create_gig.php">Create New Gig</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <div class="gigs">
        <?php while ($row = $gigs->fetch_assoc()): ?>
            <div class="gig">
                <!-- Show Gig Image -->
                <?php if (!empty($row['gig_image']) && file_exists('uploads/' . $row['gig_image'])): ?>
                    <img src="uploads/<?php echo $row['gig_image']; ?>" alt="Gig Image">
                <?php else: ?>
                    <img src="https://via.placeholder.com/250x160.png?text=No+Image" alt="No Image">
                <?php endif; ?>

                <!-- Gig Details -->
                <h3><?php echo $row['title']; ?></h3>
                <p><?php echo $row['description']; ?></p>
                <p>Delivery: <?php echo $row['delivery_time']; ?> days</p>
                <p>Price: <span>$<?php echo $row['price']; ?></span></p>

                <!-- Booking Button -->
                <form method="post" action="book_gig.php">
                    <input type="hidden" name="gig_id" value="<?php echo $row['id']; ?>">
                    <button type="submit">Book Now</button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
