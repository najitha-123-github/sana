<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
  
    <
    <style>
        * {
    margin: 0;
    padding: 0;
    font-family: 'Roboto', sans-serif;
}

body {
    margin: 0;
    padding: 0;
    color: black;
    background-color: rgba(88, 88, 245, 0.2); /* Optional background color for the body */
}

.navbar {
    width: 100%;
     
    display: flex;
    justify-content: space-between;
    align-items: center; /* Center items vertically */
    padding: 10px 20px; /* Padding for spacing */
   
    height: 70px;
}

.navuladmin {
    display: flex;
    width: 60%;
    justify-content: space-evenly;
    align-items: center;
    list-style: none;
    margin: 0; /* Reset margin for list */
}

.navheading {
    height: 100%;
    display: flex;
    align-items: center;
    padding-left: 20px;
}

.adminheading {
    display: flex;
    justify-content: center;
    margin-top: 50px; /* Adjusted for better positioning */
}

.nava {
    color: rgb(221, 212, 212); /* Light text color */
    padding: 10px 15px; /* Padding for clickable area */
    border-radius: 4px; /* Rounded corners */
    transition: background-color 0.3s; /* Smooth transition for hover effect */
    text-decoration: none;
}



.dropdown {
    position: relative; /* Positioning for dropdown */
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: rgba(255, 255, 255, 0.2); /* Dark background for dropdown */
    min-width: 160px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
}

.dropdown-content a {
    color: rgb(221, 212, 212);
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content a:hover {
    background-color: rgba(119, 119, 179, 0.2); /* Darker hover effect for dropdown items */
}

.dropdown:hover .dropdown-content {
    display: block; /* Show dropdown on hover */
}

.logoo {
    margin-left: 20px; /* Adjusted for better alignment */
    width: 125px;
    cursor: pointer;
}

        .container{
    
    width: 100%;
    height: 100vh;
    background-image: linear-gradient(rgba(0,0,0,0.7),rgba(0,0,0,0.7)),url(Assets/Celebrating\ Women\ empowerment\ and\ equality\ through\ International\ Womens\ Day\ on\ 8\ March\ _\ Premium\ AI-generated\ image.jpg);
    background-position: center;
    background-size: cover;
    box-sizing: border-box;
}
.contain{
    width: 100%;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    text-align: center;
    color: rgb(221, 212, 212);
}
    </style>
</head>
<body>
<div class="container">
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
                            <a href="deleteuser.php">Delete user</a>
                        </div>
                    </li>
                    <!-- <li><a class="nava" href="admin_view_sos.php">View SOS Alerts</a></li> -->
                    <li><a class="nava" href="login.php">Logout</a></li>
                </ul>
         </nav>
         <body>
    
        <div class="contain">
        <h1>ADMIN DASHBOARD</h1>
              
        </div>          
    </div>    
</body>
    <?php
    include("./auth/adminauth.php");
    ?>
</body>
</html>
