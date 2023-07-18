<?php include("database.php");
session_start();
$id = $_SESSION['id'];
$email = $_SESSION['email'];
$idAcc = $_SESSION['idAcc'];
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
  <title>Client Page</title>
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
        <button class="button-style"><a href="client.php"><b>Home</b></a></button>
        <button class="button-style"><a href="viewdetails.php"><b>View details </b></a></button>
        <button class="button-style"><a href="moneytransferclient.php"><b>Money Transfer</b></a></button>
        <hr />
        <div class="main-account">
          <a href="#">
            <img class="img" src="images/user.png" alt="">
            <div class="account-details">
              <span class="user-name"><b><?php echo $email; ?></b></span>
            </div>

          </a>
        </div>
      </nav>
    </aside>
    <!-- Main -->
    <main>
      <span class="caption"><b>Client data :</b></span>
      <table class="styled-table">
        <thead>
          <tr>
            <th><b>ID</b></th>
            <th><b>First Name</b></th>
            <th><b>Last Name</b></th>
            <th><b>Email</b></th>
            <th><b>Password</b></th>
            <th><b>current balance</b></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php
            $data = getFromData("SELECT client.id_client,client.first_name,client.last_name,account.email,account.passwordA,SUM(client_records.valuemoney) AS 'SUM'
               FROM client JOIN account
               ON client.id_account=account.id_account
               JOIN client_records ON client_records.id_client=client.id_client
               GROUP BY client.id_client
               HAVING client.id_client='$id'");
            foreach ($data as $re) {
              echo '<td>' . $re['id_client'] . '</td><td>' . $re['first_name'] .
                '</td><td>' . $re['last_name'] . '</td><td>' . $re['email']
                . '</td><td>' . $re['passwordA'] . '</td>'
                . '</td><td>' . $re['SUM'] . '</td>';
            }
            ?></tr>
        </tbody>
      </table>
    </main>
  </div>
</body>

</html>