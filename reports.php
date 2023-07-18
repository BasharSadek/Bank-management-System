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
  <title> reports</title>
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
      <span class="caption"><b>Reports :</b></span>
      <form action="" method="post">
        <table class="styled-table">
          <thead>
            <tr>
              <th>client Name</th>
              <th>
                <select value="1" name="person">
                  <?php
                  $data2 = getFromData("SELECT client.id_client,client.first_name,client.last_name FROM client");
                  foreach ($data2 as $result) {
                    echo '<option value=" ' . $result["id_client"] . ' " name="person" >' .
                      $result["first_name"] .  ' ' . $result["last_name"] .  '</option>';
                  }
                  ?>
                </select>
              </th>
          <tbody>
            <tr>
              <td><button type="submit" name="show">Show</button></td>
            </tr>
          </tbody>
          </tr>
          </thead>
        </table>
      </form>
      <?php
      if (isset($_POST['show'])) {
        $person = $_POST['person'];
        $data = getFromData("SELECT client_records.valuemoney,client_records.dateCR,client_records.Hour,process.name
        FROM client_records JOIN process
        ON client_records.id_process=process.id_process
        WHERE client_records.id_client='$person'
        ORDER BY client_records.dateCR,client_records.Hour");

        echo '<table class="styled-table">
      <thead>
        <tr>
          <th><b>amount of money</b></th>
          <th><b>Date</b></th>
          <th><b>Hour</b></th>
          <th><b>process Name</b></th>
        </tr>
      </thead>
      <tbody>';
        foreach ($data as $re) {
          echo '<tr><td>' . $re['valuemoney'] . '</td><td>' . $re['dateCR'] .
            '</td><td>' . $re['Hour'] . '</td><td>' . $re['name']
            . '</td></tr>';
        }
        echo ' </tbody>
      </table>';
      }
      ?>
    </main>
  </div>
</body>

</html>