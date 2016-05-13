<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php
      $welcome = "Hello World";
    ?>
  </head>


  <body>

  <?php

  // define variables and set to empty values
  $companyNameErr = $contactNameErr = $contactEmailErr = "";
  $companyName = $contactName = $contactEmail = $contactNumber = $notes = $jobDescription = $companyWebsite = $knownAssociates = $response = $thankYouEmail = $rejection = $rejectionEmail = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //company name && err handler
      if (empty($_POST["companyName"])) {
        $companyNameErr = "Company name is required";
      } else {
        $companyName = test_input($_POST["companyName"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$companyName)) {
          $companyNameErr = "Only letters and white space allowed";
        }
      }
      //contact name && err handler
    if (empty($_POST["contactName"])) {
      $contactNameErr = "Contact name is required";
    } else {
      $contactName = test_input($_POST["contactName"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$contactName)) {
        $contactNameErr = "Only letters and white space allowed";
      }
    }
    //contact email && err handler
    if (empty($_POST["contactEmail"])) {
      $contactEmailErr = "Contact's Email is required";
    } else {
      $contactEmail = test_input($_POST["contactEmail"]);
      // check if e-mail address is well-formed
      if (!filter_var($contactEmail, FILTER_VALIDATE_EMAIL)) {
        $contactEmailErr = "Invalid email format";
      }
    }
    //contacts phone number
    if (empty($_POST["contactNumber"])) {
      $contactNumber = "";
    } else {
      $contactNumber = test_input($_POST["contactNumber"]);
    }
    //notes to fill out about company, contact, tech used...etc
    if (empty($_POST["notes"])) {
      $notes = "";
    } else {
      $notes = test_input($_POST["notes"]);
    }
    //job description
    if (empty($_POST["jobDescription"])) {
      $jobDescription = "";
    } else {
      $jobDescription = test_input($POST_["jobDescription"]);
    }
    //website url for quick look up
    if (empty($_POST["website"])) {
      $companyWebsite = "";
    } else {
      $companyWebsite = test_input($_POST["companyWebsite"]);
      // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
      if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$companyWebsite)) {
        $companyWebsiteErr = "Invalid URL";
      }
    }
    //known associates at company
    if (empty($_POST["knownAssociates"])) {
      $knownAssociates = "";
    } else {
      $knownAssociates = test_input($_POST["knownAssociates"]);
    }
    //response, Yes or No. have they gotten back to you?
    if (empty($_POST["response"])) {
      $responseErr = "Response is required";
    } else {
      $response = test_input($_POST["response"]);
    }
    //thank you email. Did you send one after you chatted with them?
    if (empty($_POST["thankYouEmail"])) {
      $responseErr = "Response is required";
    } else {
      $response = test_input($_POST["response"]);
    }
    //rejection to your application Yes/No
    if (empty($_POST["rejection"])) {
      $rejectionErr = "Response is required";
    } else {
      $rejection = test_input($_POST["rejection"]);
    }
    //did the user send a rejection email asking for feedback Yes/No
    if (empty($_POST["rejectionEmail"])) {
      $rejectionEmailErr = "Response is required";
    } else {
      $rejectionEmail = test_input($_POST["rejectionEmail"]);
    }
  }



  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>



  <h2>Joblander Contact Card</h2>

  <!-- date at top of card. Hope to say this for users records on when card was created -->
  <?php echo "Card created on " . date("D m, Y") . "<br>";?><br>

  <p><span class="error">* required field.</span></p>

<!-- <form method="post" action="thefileIwant.php"> -->

      <!-- <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> -->
      <form method="post" action="mysqlqueries.php">
        Company Name: <input type="text" name="companyName" value="<?php echo $companyName;?>">
        <span class="error">* <?php echo $companyNameErr;?></span>
        <br><br>
        Contact Name: <input type="text" name="contactName" value="<?php echo $contactName;?>">
        <span class="error">* <?php echo $contactNameErr;?></span>
<!--
        <button id="myBtn">Try it</button>
        <p id="demo"></p>
        <script>
        document.getElementById("myBtn").addEventListener("click", displayDate);

        function displayDate() {
            document.getElementById("demo").innerHTML = Date();
        }
        </script> -->

        <br><br>


        Contact's E-mail: <input type="text" name="email" value="<?php echo $contactEmail;?>">
        <span class="error">* <?php echo $contactEmailErr;?></span>
        <br><br>
        Contact's Phone Number: <input type="text" name="pNumber" value="<?php echo $contactNumber;?>">
        <br><br>
        Notes:
        <br><br>
        <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
        <br><br>
        Job Description:
        <br><br>
        <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
        <br><br>
        Website: <input type="text" name="companyWebsite" value="<?php echo $companyWebsite;?>">
        <br><br>
        Know Associates: <input type="text" name="knownAssociates" value="<?php echo $knownAssociates;?>">
        <br><br>
        Response:
        <input type="radio" name="response" <?php if (isset($response) && $response=="Yes") echo "checked";?> value="Yes">Yes
        <input type="radio" name="response" <?php if (isset($response) && $response=="No") echo "checked";?> value="No">No
        <br><br>
        Thank you Email:
        <input type="radio" name="thankYouEmail" <?php if (isset($response) && $response=="Yes") echo "checked";?> value="Yes">Yes
        <input type="radio" name="thankYouEmail" <?php if (isset($response) && $response=="No") echo "checked";?> value="No">No
        <br><br>
        Rejection:
        <input type="radio" name="Rejection" <?php if (isset($response) && $response=="Yes") echo "checked";?> value="Yes">Yes
        <input type="radio" name="Rejection" <?php if (isset($response) && $response=="No") echo "checked";?> value="No">No
        <br><br>
        Rejection Email:
        <input type="radio" name="thankYouEmail" <?php if (isset($response) && $response=="Yes") echo "checked";?> value="Yes">Yes
        <input type="radio" name="thankYouEmail" <?php if (isset($response) && $response=="No") echo "checked";?> value="No">No
        <br><br>
        <input type="submit" name="submit" value="Submit">
      </form>




  </body>
</html>
