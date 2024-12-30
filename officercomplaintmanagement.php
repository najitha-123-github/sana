<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Officer Dashboard</title>

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
            margin-top: 20px;
            padding: 20px;
        }

        .complaint-box {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 10px 0;
            padding: 15px;
            box-shadow: 0 2px 10px 5px rgba(0, 0, 0, 0.1);
            width: 40%;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-left: 30%;
        }

        .complaint-box h3 {
            margin-bottom: 10px;
        }

        .complaint-box p {
            margin: 5px 0;
        }

        .action-buttons button {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #008CBA;
            color: white;
        }

        .action-buttons button:hover {
            background-color: #005f73;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
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

    <h2>Assigned Complaints</h2>

    <div class="container">
        <?php
        include("./auth/staffauth.php");
        $conn = mysqli_connect("localhost", "root", "", "complainreg");
        if (!$conn) {
            echo "DB not connected";
            exit();
        }

        $ofid = $_SESSION['officerid'];
        // Modified query to join `complaints` and `user` tables
        $sql = "SELECT complaints.complaint_id, complaints.complaint_type, users.name AS user_name 
                FROM complaints 
                JOIN users ON complaints.email = users.email 
                WHERE complaints.officerid = '$ofid' 
                ORDER BY complaints.date DESC";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = htmlspecialchars($row['complaint_id']);
                $type = htmlspecialchars($row['complaint_type']);
                $user_name = htmlspecialchars($row['user_name']);

                echo "<div class='complaint-box'>";
                echo "<h3>Complaint ID: $id</h3>";
                echo "<p><strong>Type:</strong> $type</p>";
                echo "<p><strong>User Name:</strong> $user_name</p>";
                echo "<div class='action-buttons'>";
                echo "<form action='complaintdetails.php' method='GET'>";
                echo "<input type='hidden' name='complaint_id' value='$id'>";
                echo "<button type='submit'>View Details</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No records found.</p>";
        }

        mysqli_close($conn);
        ?>
    </div>
</body>

</html>
