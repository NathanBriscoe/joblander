<?php
require_once 'app/init.php';

$itemsQuery = $db->prepare("
  SELECT id, name, done
  FROM items
  WHERE user = :user
");
// the :user above is a placeholder to prevent SQL injection. We don't have to escape each one manually

$itemsQuery->execute([
  'user' => $_SESSION['user_id']
]);
// turnery opperator? Checking here to see if there is a sufficent row count on items or turn it into an empty array
$items = $itemsQuery->rowCount() ? $itemsQuery->fetchAll() : [];
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <script src="jquery.min.js"></script>
    <title></title>
      <link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet'>
      <link href='https://fonts.googleapis.com/css?family=Arimo|Shadows+Into+Light' rel='stylesheet'>
      <link rel='stylesheet' href='css/main.css'>
      <meta name='viewport' content='width=device-width, inital-scale=1.0'>
  </head>
  <body>
<?php
    //errors
    $companyNameErr = $contactNameErr = $contactEmailErr = "";
    //company
    $companyName = $jobTitle = $jobPosting = "";
    //contacts
    $contactName = $contactEmail = $contactNumber = $contactLinkedIn = "";
    //associates
    $knownAssociates = $associatesName = $associatesEmail = $associatesNumber = $associatesLinkedIn = "";
    //jobland(table)
    $notes = $jobDescription = $companyWebsite = $response = $thankYouEmail = $rejection = $rejectionEmail = "";
    //items
    $itemName = $user = $done = $created = "";
 ?>

    <!-- ToDo today list -->
    <div class="list">
      <h1 class='header'>To do.</h1>
      <?php if(!empty($items)): ?>
      <ul class="items">
        <?php foreach($items as $item): ?>
          <li>
            <span class="item <?php echo $item['done'] ? ' done' : '' ?>"><?php echo $item['name']; ?></span>
            <?php if(!$item['done']): ?>
              <a href="mark.php?as=done&item=<?php echo $item['id'];?>" class="done-button">Mark as done</a>
            <?php endif; ?>
          </li>
      <?php endforeach; ?>
    </ul>
    <?php else: ?>
      <p>You haven't added any items yet.</p>
    <?php endif; ?>

        <form class="item-add" action="add.php" method="post">
          <input type="text" name="name" placeholder="Add a to-do here" class="input" autocomplete="off" required>
          <input type="submit" value="Add" class="submit">
        </form>
    </div>

    <!-- ToDo upcoming tmr list -->
    <div class="list1">
      <h1 class='header'>Upcoming Tomorrow</h1>
      <?php if(!empty($items)): ?>
      <ul class="items">
        <?php foreach($items as $item): ?>
          <li>
            <span class="item <?php echo $item['done'] ? ' done' : '' ?>"><?php echo $item['name']; ?></span>
            <?php if(!$item['done']): ?>
              <a href="#" class="done-button">Mark as done</a>
            <?php endif; ?>
          </li>
      <?php endforeach; ?>
    </ul>
    <?php else: ?>
      <p>You haven't added any items yet.</p>
    <?php endif; ?>

        <form class="item-add" action="add.php" method="post">
          <input type="text" name="itemName" placeholder="Add a to-do here" class="input" autocomplete="off" required>
          <input type="submit" value="Add" class="submit">
        </form>
    </div>

    <!-- ToDo day after tomorrow list -->
    <div class="list2">
      <h1 class='header'>Upcoming, Day After Tomorrow</h1>
      <?php if(!empty($items)): ?>
      <ul class="items">
        <?php foreach($items as $item): ?>
          <li>
            <span class="item <?php echo $item['done'] ? ' done' : '' ?>"><?php echo $item['name']; ?></span>
            <?php if(!$item['done']): ?>
              <a href="#" class="done-button">Mark as done</a>
            <?php endif; ?>
          </li>
      <?php endforeach; ?>
    </ul>
    <?php else: ?>
      <p>You haven't added any items yet.</p>
    <?php endif; ?>

        <form class="item-add" action="add.php" method="post">
          <input type="text" name="itemName" placeholder="Add a to-do here" class="input" autocomplete="off" required>
          <input type="submit" value="Add" class="submit">
        </form>
    </div>
  <?php

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
    // } else {
    //   $contactName = test_input($_POST["contactName"]);
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
      //$rejection - is the variable that contains the users input
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
<!-- This is where the form submition dynamically shows a list of contact cards displayed by company name -->
<div class="inputForContacts">
  <input placeholder="Search">
  <h2 class="contacts">Contacts</h2>
  <ul class="contactList">
    <li>Target</li>
  </ul>
</div>

<div class="joblanderContactCard">
  <h2>Joblander Contact Card</h2>

  <p class="date"><?php echo "Card created on " . date("D m, Y") . "<br>";?></p><br>

  <p><span class="error">* required field.</span></p>

      <form method="post" action="mysqlqueries.php">
        <!-- The Companys information section -->
        <div class="companyInfo">
          Company:
          <br><br>
          <span class="error">* <?php echo $companyNameErr;?></span>
          <input type="text" name="companyName" placeholder="Name" value="<?php echo $companyName;?>">
          <input type="text" name="jobTitle" placeholder="Job Title" value="<?php echo $jobTitle;?>">
          <input type="text" name="jobPosting" placeholder="Job Posting" value="<?php echo $jobPosting;?>">
          <input type="text" name="companyWebsite" placeholder="Website" value="<?php echo $companyWebsite;?>">
          <br><br>
        </div>
        <!-- The Contacts information section -->
        <div class="contactsInfo">
          Contact's info: <button id=button type="button">Add Contact</button>
          <br><br>
          <span class="error">* <?php echo $contactNameErr;?></span>
          <input type="text" name="contactName" placeholder="Name">
          <span class="error">* <?php echo $contactEmailErr;?></span>
          <input type="text" name="email" placeholder="Email" value="<?php echo $contactEmail;?>">
          <input type="text" name="pNumber" placeholder="(___)___-____" value="<?php echo $contactNumber;?>">
          <input type="text" name="LinkedIn" placeholder="LinkedIn URL" value="<?php echo $contactLinkedIn;?>">
          <br><br>
        </div>
        <!-- The Associates information section -->
        <div class="associatesInfo">
          Known Associates Info: <button id=button type="button">Add Associate</button>
          <br><br>
          <input type="text" name="knownAssociates" placeholder="Name" value="<?php echo $knownAssociates;?>">
          <input type="text" name="associatesemail" placeholder="Email" value="<?php echo $associatesEmail;?>">
          <input type="text" name="associatespNumber" placeholder="(___)___-____" value="<?php echo $associatesNumber;?>">
          <input type="text" name="associatesLinkedIn" placeholder="LinkedIn URL" value="<?php echo $associatesLinkedIn;?>">
          <br><br>
        </div>

        Notes:
        <br>
        <textarea name="notes" type="text" rows="5" cols="40"></textarea>
        <br><br>
        Job Description:
        <br><br>
        <textarea name="jobDescription" type="text" rows="5" cols="40"></textarea>
        <br><br>

        Response:
        <br>
        <input type="radio" name="response" <?php if (isset($response) && $response=="Yes") echo "checked";?> value="Yes">Yes
        <input type="radio" name="response" <?php if (isset($response) && $response=="No") echo "checked";?> value="No">No
        <br><br>

        Thank you Email:
        <br>
        <input type="radio" name="thankYouEmail" <?php if (isset($thankYouEmail) && $thankYouEmail=="Yes") echo "checked";?> value="Yes">Yes
        <input type="radio" name="thankYouEmail" <?php if (isset($thankYouEmail) && $thankYouEmail=="No") echo "checked";?> value="No">No
        <br><br>

        Rejection:
        <br>
        <input type="radio" name="Rejection" <?php if (isset($rejection) && $rejection=="Yes") echo "checked";?> value="Yes">Yes
        <input type="radio" name="Rejection" <?php if (isset($rejection) && $rejection=="No") echo "checked";?> value="No">No
        <br><br>

        Rejection Email:
        <br>
        <input type="radio" name="rejectionEmail" <?php if (isset($rejectionEmail) && $rejectionEmail=="Yes") echo "checked";?> value="Yes">Yes
        <input type="radio" name="rejectionEmail" <?php if (isset($rejectionEmail) && $rejectionEmail=="No") echo "checked";?> value="No">No
        <br><br>
        <input type="submit" name="submit" value="Submit">
      </form>
</div>
</body>
</html>
