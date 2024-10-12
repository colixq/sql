<?php
    include('connection.php');
    session_start(); // Start a session to store messages

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $input = trim($_POST['input'] ?? '');

        // Only proceed if input is not empty
        if (!empty($input)) {
            // Execute the raw SQL query
            if ($conn->query($input) === TRUE) {
                $_SESSION['message'] = 'Query executed successfully';
            } else {
                $_SESSION['message'] = 'Error executing query: ' . $conn->error;
            }
        } else {
            $_SESSION['message'] = 'SQL query cannot be empty.';
        }

        // Redirect to the same page to avoid resubmission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit(); // Ensure no further code is executed after the redirect
    }

    // Check if there is a message to display
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']); // Clear the message after displaying it
    }

    // Close the database connection
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div class="header">
        <a href="sql.php" class="menu-item">
            <span class="material-icons">storage</span> 
            <div class="item-text">SQL</div>
        </a>
        <a href="tables.html" class="menu-item">
            <span class="material-icons">table_view</span> 
            <div class="item-text">TABLES</div>
        </a>
        <a href="query.html" class="menu-item">
            <span class="material-icons">search</span> 
            <div class="item-text">QUERY</div>
        </a>
        <a href="structure.html" class="menu-item">
            <span class="material-icons">account_tree</span> 
            <div class="item-text">STRUCTURE</div>
        </a>
        <a href="data.html" class="menu-item">
            <span class="material-icons">dataset</span> 
            <div class="item-text">DATA</div>
        </a>
    </div>


<form method="post">
    
<div class="sql-container">
    <textarea placeholder="some sql..." name="input"></textarea>
    <button class="submit-btn" type="submit">SUBMIT</button>
</div>

</form>

</body>
</html>
