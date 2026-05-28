<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Processing</title>
</head>
<body>
    <?php
        require_once("settings.php");

        //sanatises form input
        function sanitise_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data  );
            return $data;
        }

        //prevents direct access through link
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            header("Location: apply.php");
            exit();
        }
        
        //infromation from form
        $job_ref = sanitise_input($_POST["job-ref"] ?? "");
        $first_name = sanitise_input($_POST["first-name"] ?? "");
        $last_name = sanitise_input($_POST["last-name"] ?? "");
        $dob = sanitise_input($_POST["date-of-birth"] ?? "");
        $gender = sanitise_input($_POST["gender"] ?? "");
        $street = sanitise_input($_POST["street-address"] ?? "");
        $suburb = sanitise_input($_POST["suburb"] ?? "");
        $state = sanitise_input($_POST["state"] ?? "");
        $postcode = sanitise_input($_POST["postcode"] ?? "");
        $email = sanitise_input($_POST["email"] ?? "");
        $phone = sanitise_input($_POST["phone-number"] ?? "");
        $other = sanitise_input($_POST["other"] ?? "");


        $skills = "";

        if (isset($_POST["skill"])) {
            $skills = sanitise_input(implode(", ", $_POST["skill"]) ?? "");
        }
        

        //error checking
        $errors = [];

        
        if (!preg_match("/^[A-Za-z0-9]{5}$/", $job_ref)) {
            $errors[] = "Job reference must be exactly 5 characters.";
        }


        if (!preg_match("/^[A-Za-z]{1,20}$/", $first_name)) {
            $errors[] = "First name must contain only letters and maximum 20 characters.";
        }


        if (!preg_match("/^[A-Za-z]{1,20}$/", $last_name)) {
            $errors[] = "Last name must contain only letters and maximum 20 characters.";
        }


        if (!preg_match("/^\d{1,2}\/\d{1,2}\/\d{4}$/", $dob)) {
            $errors[] = "Date of birth must be in dd/mm/yyyy format.";
        }


        $valid_genders = ["male", "female", "non-binary", "prefer-not-to-say"];

        if (!in_array($gender, $valid_genders)) {
            $errors[] = "Please select a valid gender.";
        }


        if ($street == "" || strlen($street) > 40) {
            $errors[] = "Street address is required and maximum 40 characters.";
        }


        if ($suburb == "" || strlen($suburb) > 40) {
            $errors[] = "Suburb is required and maximum 40 characters.";
        }


        $valid_states = ["act", "nsw", "nt", "sa", "tas", "vic", "wa"];

        if (!in_array($state, $valid_states)) {
            $errors[] = "Please select a valid state.";
        }


        if (!preg_match("/^\d{4}$/", $postcode)) {
            $errors[] = "Postcode must be exactly 4 digits.";
        }


        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Please enter a valid email address.";
        }


        if (!preg_match("/^\d{8,12}$/", $phone)) {
            $errors[] = "Phone number must contain 8 to 12 digits.";
        }

        //display error
        if (!empty($errors)) {

            include 'header.inc';           
            echo "<h1>Application Error</h1>";
            echo "<ul>";

            foreach ($errors as $error) {
                echo "<li>$error</li>";
            }

            echo "</ul>";
            echo '<p><a href="apply.php">Return to Application Form</a></p>';
            

            include 'footer.inc';

            exit();
        }
        


        //insert into database
        $query = "INSERT INTO eoi (job_reference, first_name, last_name, date_of_birth, gender,
        street_address, suburb, state, postcode,email, phone, skills, other_skills, status)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'New')";

        $stmt = $conn->prepare($query);

        $stmt->bind_param(
            "sssssssssssss",
            $job_ref,
            $first_name,
            $last_name,
            $dob,
            $gender,
            $street,
            $suburb,
            $state,
            $postcode,
            $email,
            $phone,
            $skills,
            $other
        );

        if ($stmt->execute()) {

            $eoi_number = $conn->insert_id;

            include 'header.inc';    
            echo "<h1>Application Submitted Successfully</h1>";
            echo "<p>Thank you $first_name $last_name.</p>";
            echo "<p>Your EOI Number is: <strong>$eoi_number</strong></p>";
            include 'footer.inc';

        } else {

            echo "Database error: " . $conn->error;
        }

        mysqli_close($conn);
    ?>





</body>
</html>