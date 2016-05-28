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

if ($link) {
  //contacts info
  $contactName = $_POST['contactName'];
  $contactEmail = $_POST['email'];
  $contactNumber = $_POST['pNumber'];
  $contactLinkedIn = $_POST['LinkedIn'];
  //company info
  $companyName = $_POST['companyName'];
  //form (jobland table)
  $notes = $_POST['notes'];
  $jobDescription = $_POST['jobDescription'];
  $companyWebsite = $_POST['companyWebsite'];
  $response = $_POST['response'];
  $thankYouEmail = $_POST['thankYouEmail'];
  $rejection = $_POST['Rejection']; //error on this
  $rejectionEmail = $_POST['rejectionEmail'];// error on this
  //Associates
  $knownAssociates = $_POST['knownAssociates'];
  $associatesEmail = $_POST['associatesemail'];
  $associatesNumber = $_POST['associatespNumber'];
  $associatesLinkedIn = $_POST['associatesLinkedIn'];
  //items, for this one I'll be following along with the tutorial

  require_once 'app/init.php';

  if(isset($_POST['name'])) {
    $name = trim($_POST['name']);

      if(!empty($name)) {
        $addQuery = $db->prepare("
            INSERT INTO items (name, user, done, created)
            VALUES (:name, :user, 0, NOW())
        ");

        $addQuery->execute([
          'name' => $name,
          'user' => $_SESSION['user_id']
        ]);
      }
  }

  header('Location: index.php');



  //contacts info
  $SQL = "INSERT INTO contacts (name, email, phone_number, LinkedIn) VALUES ('".$contactName."','".$contactEmail."','".$contactNumber."', '".$contactLinkedIn."');";

  //company info
  $SQL1 = "INSERT INTO company (name) VALUES ('".$companyName."')";

  //form (jobland table)                      // error on this SQL query
  $SQL2 = "INSERT INTO jobland (notes, description, website, response, thank_you_email, rejection, rejection_email) VALUES
  ('".$notes."', '".$jobDescription."', '".$companyWebsite."', '".$response."', '".$thankYouEmail."', '".$rejection."', '".$rejectionEmail."')";

  //associates
  $SQL3 = "INSERT INTO associates (name, email, phone_number, LinkedIn) VALUES ('".$knownAssociates."','".$associatesEmail."', '".$associatesNumber."', '".$associatesLinkedIn."');";

  // $SQL4 = "INSERT INTO items (name, user, done, created) VALUES (:name, :user, 0, NOW());";

  //items
  // $SQL4 = "INSERT INTO items (name, user, done, created) VALUES ('".."')"

  $result = mysqli_query($link, $SQL);
  $result = mysqli_query($link, $SQL1);
  $result = mysqli_query($link, $SQL2);
  $result = mysqli_query($link, $SQL3);
  $result = mysqli_query($link, $SQL4);


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
*/
