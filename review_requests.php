<?php
include("./auth/adminauth.php");

// Database connection
$conn = new mysqli("localhost", "root", "", "complainreg");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch requests from the database
$sql = "SELECT * FROM request"; // Adjust table name as necessary
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Requests</title>
    <link rel="stylesheet" href="admindashboardd.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgba(88, 88, 245, 0.2); /* Blue background */
            margin: 0;
            display: flex;
            flex-direction: column; /* Ensure the navbar is at the top */
            align-items: center; /* Center items horizontally */
        }
        
        .request-container {
            display: flex;
            flex-direction: column; /* Stack boxes vertically */
            gap: 20px;
            width: 100%; /* Full width for responsiveness */
            max-width: 800px; /* Optional max width */
        }
        .request-card {
            background-color: white; /* White background for cards */
            
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 60%; /* 60% width for each box */
            height: 290px;
            margin: 0 auto; /* Center the boxes */
            display: flex;
            align-items: flex-start;
            flex-direction: column;
            justify-content: space-evenly;
        }
        .complaint-box h3 {
            margin: 0 0 10px;
            color: rgba(88, 88, 245, 1);
        }
        .request-card p {
            margin: 5px 0;
        }
        .update-button {
            background-color: rgba(88, 245, 88, 0.8);
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
        }
        .update-button:hover {
            background-color: rgba(88, 245, 88, 1);
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
        .cbox{
            width:100%;
            height:min-content;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
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
                <a href="admin_view_officer_reviews.php">View Review</a>
            </div>
        </li>
        <li class="dropdown">
            <a href="#" class="nava">User Management</a>
            <div class="dropdown-content">
                <a href="deleteuser.php">Delete User</a>
            </div>
        </li>
        <li><a class="nava" href="login.php">Logout</a></li>
    </ul>
</nav>

<div class="adminheading">
    <h2>Review Requests</h2>
</div>
<div class='cbox'>


    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
        
            <div class='complaint-box'>
            
                <h3>Request ID: <?php echo $row['id']; ?></h3>
                <p><strong>Complaint ID:</strong> <?php echo $row['complaint_id']; ?></p>
                <p><strong>User ID:</strong> <?php echo $row['user_id']; ?></p>
                <p><strong>Officer ID:</strong> <?php echo $row['officer_id']; ?></p>
                <p><strong>Details:</strong> <?php echo $row['reason']; ?></p>
                <p><strong>Request Date:</strong> <?php echo $row['request_date']; ?></p>
                <p><strong>Status:</strong> <?php echo $row['status']; ?></p>
                <div>
                    <?php if ($row['status'] !== 'successful'): ?>
                        <form action="update_officer.php" method="POST">
                            <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                            <select name="new_officer" required>
                                <option value="">Select Officer</option>
                                <?php
                                // Fetch officers from the database
                                $officers = $conn->query("SELECT * FROM officer");
                                while ($officer = $officers->fetch_assoc()):
                                ?>
                                    <option value="<?php echo $officer['officerid']; ?>"><?php echo $officer['name']; ?></option>
                                <?php endwhile; ?>
                            </select>
                            <button type="submit" class="update-button">Update Officer</button>
                        </form>
                    <?php else: ?>
                        <span>Officer assignment is final.</span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No requests found.</p>
    <?php endif; ?>
</div>

<?php $conn->close(); ?>
</body>
</html>
