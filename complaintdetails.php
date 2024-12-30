<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Details</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        .navbar {
            width: 100%;
            background-color: #5c6bc0;
            color: #5c6bc0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 45px;
        }

        .navbar ul {
            display: flex;
            align-items: center;
        }

        .navbar ul li {
            list-style: none;
            margin: 0 20px;
            position: relative;
        }

        .navbar ul li a {
            text-decoration: none;
            color: rgb(221, 212, 212);
            letter-spacing: 1px;
            font-weight: bold;
            font-size: 14px;
            transition: color 0.3s;
        }

        .navbar ul li:hover a {
            color: #fff;
        }

        .logo {
            width: 125px;
            cursor: pointer;
        }

        .container {
            margin: 20px auto;
            max-width: 800px;
            padding: 20px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .container h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .container p {
            margin: 10px 0;
            font-size: 16px;
        }

        .container img {
            width: 200px;
            height: auto;
            margin: 15px 0;
            border-radius: 8px;
        }

        .status-update {
            margin-top: 20px;
        }

        .status-update form {
            display: flex;
            align-items: center;
        }

        .status-update input[type="text"] {
            width: 70%;
            padding: 8px;
            margin-right: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .status-update button {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #008CBA;
            color: white;
        }

        .status-update button:hover {
            background-color: #005f73;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <img src="Assets/logowomen.png" alt="Logo" class="logo">
        <ul>
            <li><a href="officerdashboard.php">HOME</a></li>
            <li><a href="officercomplaintmanagement.php">COMPLAINT MANAGEMENT</a></li>
            <li><a href="logout.php">LOGOUT</a></li>
        </ul>
    </div>

    <div class="container">
        <?php
        $conn = mysqli_connect("localhost", "root", "", "complainreg");
        if (!$conn) {
            die("Database connection failed.");
        }

        if (isset($_GET['complaint_id'])) {
            $id = $_GET['complaint_id'];
            $sql = "SELECT * FROM complaints WHERE complaint_id='$id'";
            $result = mysqli_query($conn, $sql);

            if ($row = mysqli_fetch_assoc($result)) {
                echo "<h1>Complaint Details</h1>";
                echo "<p><strong>Complaint ID:</strong> " . htmlspecialchars($row['complaint_id']) . "</p>";
                echo "<p><strong>Type:</strong> " . htmlspecialchars($row['complaint_type']) . "</p>";
                echo "<p><strong>User Email:</strong> " . htmlspecialchars($row['email']) . "</p>";
                echo "<p><strong>Date:</strong> " . htmlspecialchars($row['date']) . "</p>";
                echo "<p><strong>Details:</strong> " . htmlspecialchars($row['complaint_detail']) . "</p>";
                echo "<p><strong>Suspect Name:</strong> " . htmlspecialchars($row['suspect_name']) . "</p>";
                echo "<p><strong>Status:</strong> " . htmlspecialchars($row['status']) . "</p>";
                echo "<img src='./assets/" . htmlspecialchars($row['photo']) . "' alt='Complaint Photo'>";

                // Update Status Form
                echo "<div class='status-update'>";
                echo "<form method='POST'>";
                echo "<input type='text' name='status' placeholder='Update Status' required>";
                echo "<input type='hidden' name='complaint_id' value='" . htmlspecialchars($row['complaint_id']) . "'>";
                echo "<button type='submit'>Update Status</button>";
                echo "</form>";
                echo "</div>";
            } else {
                echo "<p>No complaint found.</p>";
            }
        } else {
            echo "<p>Invalid request.</p>";
        }

        // Handle status update
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['status'], $_POST['complaint_id'])) {
            $new_status = $_POST['status'];
            $complaint_id = $_POST['complaint_id'];

            $update_sql = "UPDATE complaints SET status='$new_status' WHERE complaint_id='$complaint_id'";
            if (mysqli_query($conn, $update_sql)) {
                echo "<script>alert('Status updated successfully');</script>";
                echo "<script>window.location.href='complaintdetails.php?complaint_id=$complaint_id';</script>";
            } else {
                echo "<p>Error updating status.</p>";
            }
        }

        mysqli_close($conn);
        ?>
    </div>
</body>

</html>
