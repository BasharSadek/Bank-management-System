<?php include("database.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Make Contact with css file -->

  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/admin.css" />
  <title> Show Data</title>
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
      <span class="caption"><b>Show Data :</b></span>
      <table class="styled-table">
        <thead>
          <tr>
            <th><b>ID</b></th>
            <th><b>First Name</b></th>
            <th><b>Last Name</b></th>
            <th><b>Email</b></th>
            <th><b>Password</b></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $data = getFromData("SELECT client.id_client,client.first_name,client.last_name,account.email,account.passwordA
        FROM account JOIN client
        ON account.id_account=client.id_account");
          foreach ($data as $re) {
            echo '<tr><td>' . $re['id_client'] . '</td><td>' . $re['first_name'] .
              '</td><td>' . $re['last_name'] . '</td><td>' . $re['email']
              . '</td><td>' . $re['passwordA'] . '</td></tr>';
          }
          ?>
        </tbody>
      </table>

    </main>
  </div>
</body>

</html>