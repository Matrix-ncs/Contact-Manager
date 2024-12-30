<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_contact'])) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $conn->query("INSERT INTO contact_info (user_id, name, phone) VALUES ('$user_id', '$name', '$phone')");
    } elseif (isset($_POST['delete_contact'])) {
        $contact_id = $_POST['contact_id'];
        $conn->query("DELETE FROM contact_info WHERE id = '$contact_id' AND user_id = '$user_id'");
    }
}

$result = $conn->query("SELECT * FROM contact_info WHERE user_id = '$user_id'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome to <span style="color:Tomato";>Contact manager</span></h2>
        <a href="logout.php" class="logout-button">Logout</a>
        <h3>Your Contacts</h3>
        <ul>
            <?php while ($contact = $result->fetch_assoc()): ?>
                <li>
                    <?= htmlspecialchars($contact['name']) ?> (<?= htmlspecialchars($contact['phone']) ?>)
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="contact_id" value="<?= $contact['id'] ?>">
                        <button type="submit" name="delete_contact" class="delete-button">Delete</button>
                    </form>
                </li>
            <?php endwhile; ?>
        </ul>
        <h3 >Add Contact</h3>
        <form method="POST">
            <input type="text" name="name" placeholder="Name" required>
            <input type="text" name="phone" placeholder="Phone">
            <button type="submit" name="add_contact" class="add_contact">Add</button>
        </form>
        <p class="copyright">© All Rights Reserved by Nishith</p>
    </div>
</body>
</html>
