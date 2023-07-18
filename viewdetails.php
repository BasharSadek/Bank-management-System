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
  <title>View details</title>
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
      <span class="caption"><b>View details :</b></span>
      <table class="styled-table">
        <thead>
          <tr>
            <th><b>amount of money</b></th>
            <th><b>Date</b></th>
            <th><b>Hour</b></th>
            <th><b>Process Name</b></th>
          </tr>
        </thead>
        <tbody>
          
            <?php
            $data = getFromData("SELECT client_records.valuemoney,client_records.dateCR,client_records.Hour,process.name
            FROM client_records JOIN process
            ON client_records.id_process=process.id_process
            WHERE client_records.id_client='$id'
            ORDER BY client_records.dateCR,client_records.Hour");
            foreach ($data as $re) {
              echo '<tr><td>' . $re['valuemoney'] . '</td><td>' . $re['dateCR'] .
                '</td><td>' . $re['Hour'] . '</td><td>' . $re['name'].'</tr>';
            }
            ?>
        </tbody>
      </table>
    </main>
  </div>
</body>

</html>