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
  $companyName = $contactName = $knownAssociates = $notes = $linkdein = $contactEmail = $contactNumber = $companyWebsite = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

      if (empty($_POST["companyName"])) {
        $companyNameErr = "Company name is required";
      } else {
        $companyName = test_input($_POST["companyName"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$companyName)) {
          $companyNameErr = "Only letters and white space allowed";
        }
      }

    if (empty($_POST["companyName"])) {
      $contactNameErr = "Contact name is required";
    } else {
      $contactName = test_input($_POST["contactName"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$contactName)) {
        $contactNameErr = "Only letters and white space allowed";
      }
    }

    if (empty($_POST["contactEmail"])) {
      $contactEmailErr = "Contact's Email is required";
    } else {
      $contactEmail = test_input($_POST["contactEmail"]);
      // check if e-mail address is well-formed
      if (!filter_var($contactEmail, FILTER_VALIDATE_EMAIL)) {
        $contactEmailErr = "Invalid email format";
      }
    }

    if (empty($_POST["knownAssociates"])) {
      $knownAssociates = "";
    } else {
      $knownAssociates = test_input($_POST["knownAssociates"]);
    }

    if (empty($_POST["notes"])) {
      $notes = "";
    } else {
      $notes = test_input($_POST["notes"]);
    }

    if (empty($_POST["website"])) {
      $website = "";
    } else {
      $website = test_input($_POST["website"]);
      // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
      if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
        $websiteErr = "Invalid URL";
      }
    }

    if (empty($_POST["response"])) {
      $responseErr = "Response is required";
    } else {
      $response = test_input($_POST["response"]);
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
    <p><span class="error">* required field.</span></p>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Company Name: <input type="text" name="companyName" value="<?php echo $companyName;?>">
        <span class="error">* <?php echo $companyNameErr;?></span>
        <br><br>
        Contact Name: <input type="text" name="contactName" value="<?php echo $contactName;?>">
        <span class="error">* <?php echo $contactNameErr;?></span>
        <br><br>
        Contact's E-mail: <input type="text" name="email" value="<?php echo $contactEmail;?>">
        <span class="error">* <?php echo $contactEmailErr;?></span>
        <br><br>
        Known Associates:
        <br><br>
        <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
        <br><br>
        Notes:
        <br><br>
        <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
        <br><br>
        Website: <input type="text" name="companyWebsite" value="<?php echo $companyWebsite;?>">
        <br><br>
        Response:
        <input type="radio" name="response" <?php if (isset($response) && $response=="Yes") echo "checked";?> value="Yes">Yes
        <input type="radio" name="response" <?php if (isset($response) && $response=="No") echo "checked";?> value="No">No
        <br><br>
        Thank you Email:
        <input type="radio" name="thankYouEmail" <?php if (isset($response) && $response=="Yes") echo "checked";?> value="Yes">Yes
        <input type="radio" name="thankYouEmail" <?php if (isset($response) && $response=="No") echo "checked";?> value="No">No
        <br><br>
        <input type="submit" name="submit" value="Submit">
      </form>




  </body>
</html>
