<?php
echo 'hello world';

  $servername = "localhost";
  $username = "root";
  $password = "root";
  $databasename = "joblanderDB";

// step 1, connecting to the database using mysqli_connect()
// mysqli_connect() needs the host name, database username and password as a minimum to create a connection and a 4th parameter of the database name
  $link = mysqli_connect($servername, $username, $password, $databasename);
// now lets handle errors
  function db_quote($value) {
    return "'" . mysqli_real_escape_string($link,$value) . "'";
}

if ($link) {

  $SQL = "INSERT INTO contacts (name, email, phone_number, LinkedIn) VALUES ('contactName','email,'pNumber','LinkedIn');";

  // $SQL1 = "INSERT INTO company (name)
  //         VALUES ('companyName')";
  //
  // $SQL2 = "INSERT INTO jobland (date, notes, description, website, response, thank_you_email, rejection, rejection_email)
  //         VALUES ('contactName','email','pNumber','LinkedIn')";

  $result = mysqli_query($link, $SQL);
  // $result = mysqli_query($link, $SQL1);
  // $result = mysqli_query($link, $SQL2);


  mysqli_close($link);

  print "Records added to the database";
}
  else {
  print "Database NOT Found ";
  mysqli_close($link);
}

?>
<div>
  <?php
      //echo $_POST['companyName'] . "<br>";//company
      echo $_POST['contactName'] . "<br>";//contacts
      echo $_POST['email'] . "<br>";//contacts
      echo $_POST['pNumber'] . "<br>";//contacts
      //echo $_POST['notes'] . "<br>";//jobland
      //echo $_POST['jobDescription'] . "<br>";//jobland
      //echo $_POST['companyWebsite'] . "<br>";//jobland
      //echo $_POST['knownAssociates'] . "<br>";
      // echo $_POST['response'] . "<br>";//jobland
      // echo $_POST['thankYouEmail'] . "<br>";//jobland
      // echo $_POST['Rejection'] . "<br>";//jobland
      // echo $_POST['thankYouEmail'] . "<br>";//jobland
      echo $_POST['LinkedIn'] . "<br>";//contacts
  ?>
</div>
