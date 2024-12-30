<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="admindashboardd.css">
    <link rel="stylesheet" href="assignofficerss.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .user-container {
            display: flex;
            flex-direction: column; /* Change to column for one box in a row */
            gap: 20px;
            margin-top: 20px;
        }
        .user-card {
            background-color: white; /* White background for cards */
            border: 1px solid rgba(88, 88, 245, 0.5);
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 60%; /* 60% width for each box */
            height: 130px;
            margin: 0 auto; /* Center the boxes */
            display: flex;
            align-items: flex-start;
            flex-direction: column;
            justify-content: space-evenly;
        }
        .user-card h3 {
            margin: 0 0 10px;
            color: rgba(88, 88, 245, 1);
        }
        .user-card p {
            margin: 5px 0;
        }
        .action-button {
            background-color: rgba(88, 245, 88, 0.8);
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
        }
        .action-button:hover {
            background-color: rgba(88, 245, 88, 1);
        }
        .deactivate-button {
            background-color: rgba(245, 88, 88, 0.8);
        }
        .deactivate-button:hover {
            background-color: rgba(245, 88, 88, 1);
        }
        h2 {
            text-align: center;
            margin-top: 20px;
        }
        .complaint-box {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 10px 0; /* Space between boxes */
            padding: 15px;
            box-shadow: 0 2px 10px 5px rgba(0, 0, 0, 0.1);
            width: 40%;
        }
        .cbox {
            width: 100%;
            height: min-content;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <img src="Assets/logowomen.png" alt="" class="logoo">
        <ul class="navuladmin">
            <li><a class="nava" href="admindashboard.php">Home</a></li>
            <li class="dropdown">
                <a href="#" class="nava">Complaint Management</a>
                <div class="dropdown-content">
                    <a href="view_complaints.php">View Complaint</a>
                    <a href="review_requests.php">View Requests</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="#" class="nava">Officer Management</a>
                <div class="dropdown-content">
                    <a href="addofficer.php">Add Officer</a>
                    <a href="updateofficer.php">Update Officer</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="#" class="nava">User Management</a>
                <div class="dropdown-content">
                    <a href="deleteuser.php">Manage Users</a>
                </div>
            </li>
            <li><a class="nava" href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <h2>Manage Users</h2>
    <div class="user-container">
        <?php
        include("./auth/adminauth.php");
        $conn = mysqli_connect("localhost", "root", "", "complainreg");
        if (!$conn) {
            echo "Database not connected";
        }
        $sql = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['usid'];
                $status = $row['status']; // Get the current status

                echo "<div class='cbox'>";
                echo "<div class='complaint-box'>";
                echo "<h3>User ID: ".$row['usid']."</h3>";
                echo "<p><strong>Name:</strong> ".$row['name']."</p>";

                // Check the current status and provide an appropriate button
                if ($status == 'active') {
                    echo "<form method='post'>
                            <button class='action-button deactivate-button' name='deactivate' value='{$id}' type='submit'>Deactivate</button>
                          </form>";
                } else {
                    echo "<form method='post'>
                            <button class='action-button' name='activate' value='{$id}' type='submit'>Activate</button>
                          </form>";
                }
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>Record not found</p>";
        }
        ?>
    </div>
</body>
</html>

<?php
// Handling activate/deactivate action
if (isset($_POST['deactivate'])) {
    $id = $_POST['deactivate'];
    $sql = "UPDATE `users` SET `status` = 'inactive' WHERE `usid` = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('User deactivated successfully'); window.location.href='deleteuser.php';</script>";
    } else {
        echo "<script>alert('Error deactivating user');</script>";
    }
}

if (isset($_POST['activate'])) {
    $id = $_POST['activate'];
    $sql = "UPDATE `users` SET `status` = 'active' WHERE `usid` = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('User activated successfully'); window.location.href='deleteuser.php';</script>";
    } else {
        echo "<script>alert('Error activating user');</script>";
    }
}
?>
