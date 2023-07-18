<?php include("database.php");
$date = date("Y-m-d");
$day = date("h:i:s");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Make Contact with css file -->
  <style>

  </style>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/admin.css" />
  <title> Add Client</title>
</head>

<body>
  <!-- Header -->
  <header>
    <div class="left-section">
      <a href="#" class="bank-logo">
        <img class="img-bank" src="images/bank.jpg" alt="">
      </a>
      <a href="#" class="logo-shield"> <b> Bank Management</b></a>
    </div>
    <div class="right-section">

      <a href="index.php">
        <button class="btn-logout">log out</button>
      </a>
    </div>
  </header>
  <!-- Navbar -->
  <div class="content-area-home">
    <aside>
      <nav>
        <button class="button-style"><a href="admin.php"><b>Home</b></a></button>
        <button class="button-style"><a href="showdata.php"><b>Show Data</b></a></button>
        <button class="button-style"><a href="addclient.php"><b>Add Client</b></a></button>
        <button class="button-style"><a href="moneytransfer.php"><b>Money Transfer</b></a></button>
        <button class="button-style"><a href="reports.php"><b>Reports</b></a></button>
        <hr />
        <div class="main-account">
          <a href="#">
            <img class="img" src="images/user.png" alt="">
            <div class="account-details">
              <span class="user-name"><b>admin@gmail.com</b></span>
            </div>

          </a>
        </div>
      </nav>
    </aside>
    <!-- Main -->
    <main>
      <span class="caption"><b>Add Client :</b></span>
      <form method="post">
        <table class="styled-table">
          <thead>
            <tr>
              <th><b>First Name</b></th>
              <th><b>Last Name</b></th>
              <th><b>Email</b></th>
              <th><b>Password</b></th>
            </tr>
          </thead>
          <tr>
            <td><input required type="text" name="first"></td>
            <td> <input required type="text" name="last"></td>
            <td> <input required type="email" name="email"></td>
            <td> <input required type="password" name="pass"></td>
          </tr>
          <tr>
            <td><button type="submit" name="save">Save</button></td>
          </tr>
        </table>

      </form>
    </main>
  </div>
</body>

</html>
<?php
if (isset($_POST['save'])) {
  $first = $_POST['first'];
  $last = $_POST['last'];
  $email = $_POST['email'];
  $pass = $_POST['pass'];


  connToData("INSERT INTO account VALUES(NULL,'$email','$pass');");
  $data = getFromData("SELECT account.id_account FROM account
  ORDER BY  account.id_account DESC LIMIT 1");
  foreach ($data as $re) {
    $num = $re['id_account'];
  }
  connToData("INSERT INTO client VALUES(NULL,'$first','$last','$num');");
  connToData("INSERT INTO Client_records VALUES (NULL,0,'$date','$day',1,'$num');");
  echo '<script>alert("Done Saved");</script>';
  header('Location: addclient.php');
  
}

?>