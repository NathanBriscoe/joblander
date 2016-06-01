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
  $jobTitle = $_POST['jobTitle'];
  $jobPosting = $_POST['jobPosting'];
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

  //contacts info
  $SQL = "INSERT INTO contacts (name, email, phone_number, LinkedIn) VALUES ('".$contactName."','".$contactEmail."','".$contactNumber."', '".$contactLinkedIn."');";

  //company info
  $SQL1 = "INSERT INTO company (name, job_title, job_posting) VALUES ('".$companyName."', '".$jobTitle."', '".$jobPosting."')";

  //form (jobland table)                      // error on this SQL query
  $SQL2 = "INSERT INTO jobland (notes, description, website, response, thank_you_email, rejection, rejection_email) VALUES
  ('".$notes."', '".$jobDescription."', '".$companyWebsite."', '".$response."', '".$thankYouEmail."', '".$rejection."', '".$rejectionEmail."')";

  //associates
  $SQL3 = "INSERT INTO associates (name, email, phone_number, LinkedIn) VALUES ('".$knownAssociates."','".$associatesEmail."', '".$associatesNumber."', '".$associatesLinkedIn."');";

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
