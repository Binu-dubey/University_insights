<?php
// Initialize variables to avoid "undefined variable" errors
$name = $email = $phone = $country = $message = "";
$nameErr = $emailErr = $phoneErr = $countryErr = $messageErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
    }

    // Validate Email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // Validate Phone Number
    if (empty($_POST["phone"])) {
        $phoneErr = "Phone number is required";
    } else {
        $phone = test_input($_POST["phone"]);
        if (!preg_match("/^[0-9]{10}$/", $phone)) {
            $phoneErr = "Invalid phone number (10 digits required)";
        }
    }

    // Validate Country
    if (empty($_POST["country"])) {
        $countryErr = "Preferred country is required";
    } else {
        $country = test_input($_POST["country"]);
    }

    // Validate Message
    if (empty($_POST["message"])) {
        $messageErr = "Message is required";
    } else {
        $message = test_input($_POST["message"]);
    }

    // If no errors, display success message
    if (empty($nameErr) && empty($emailErr) && empty($phoneErr) && empty($countryErr) && empty($messageErr)) {
        echo "<h3>Form Submitted Successfully!</h3>";
        echo "Name: $name<br>";
        echo "Email: $email<br>";
        echo "Phone: $phone<br>";
        echo "Preferred Country: $country<br>";
        echo "Message: $message<br>";
    } else {
        echo "<h3>Form contains errors:</h3>";
        echo "<p>$nameErr</p>";
        echo "<p>$emailErr</p>";
        echo "<p>$phoneErr</p>";
        echo "<p>$countryErr</p>";
        echo "<p>$messageErr</p>";
    }
}

function test_input($data) {
    $data = trim($data); // Removes extra spaces
    $data = stripslashes($data); // Removes backslashes
    $data = htmlspecialchars($data); // Converts special characters
    return $data;
}
?>
