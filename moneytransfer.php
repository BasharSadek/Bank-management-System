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

  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/admin.css" />
  <title> Money Transfer</title>
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
      <span class="caption"><b>Money Transfer :</b></span>
      <form action="" method="post">
        <table class="styled-table">
          <thead>
            <tr>
              <th><b>amount of money</b></th>
              <th><b>Process Name</b></th>
              <th><b>From :</b></th>
              <th><b>To :</b></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input type="number" required name="money" id=""></td>
              <td> <select value="1" name="num" required>
                  <?php
                  $data = getFromData("SELECT process.id_process, process.name FROM process WHERE process.id_process > 1");
                  foreach ($data as $result) {
                    echo '<option value=" ' . $result["id_process"] . ' " name="num" >' .
                      $result["name"] .   '</option>';
                  }
                  ?>
                </select></td>
              <td> <select value="1" name="person1">
                  <?php
                  $data2 = getFromData("SELECT client.id_client,client.first_name,client.last_name FROM client");
                  foreach ($data2 as $result) {
                    echo '<option value=" ' . $result["id_client"] . ' " name="person1" >' .
                      $result["first_name"] .  ' ' . $result["last_name"] .  '</option>';
                  }
                  ?>
                </select></td>
              <td> <select value="1" name="person2">
                  <?php
                  $data2 = getFromData("SELECT client.id_client,client.first_name,client.last_name FROM client");
                  foreach ($data2 as $result) {
                    echo '<option value=" ' . $result["id_client"] . ' " name="person2" >' .
                      $result["first_name"] .  ' ' . $result["last_name"] .  '</option>';
                  }
                  ?>
                </select></td>
            </tr>
            <tr>
              <td><button type="submit" name="save">Save</button></td>
            </tr>
          </tbody>
        </table>
      </form>
    </main>
  </div>
</body>

</html>
<?php
if (isset($_POST['save'])) {
  $money = $_POST['money'];
  $num = $_POST['num'];
  $person1 = $_POST['person1'];
  $person2 = $_POST['person2'];

  $data = getFromData("SELECT SUM(client_records.valuemoney)  AS 'sum' FROM client_records 
  WHERE client_records.id_client='$person1'");
  foreach ($data as $re) {
    $current_balance = $re['sum'];
  }

  switch ($num) {
    case 2:
      connToData("INSERT INTO Client_records VALUES (NULL,'$money','$date','$day',2,'$person2');");
      echo '<script>alert("Money has been added to account");</script>';
      break;
    case 3:
      if ($current_balance < $money) {
        echo '<script>alert("Sorry you do not have that amount of money");</script>';
        break;
      }
      $money = $money * -1;
      connToData("INSERT INTO Client_records VALUES (NULL,'$money','$date','$day',3,'$person1');");
      echo '<script>alert("Done Saved");</script>';
      break;
    case 4:
      if ($current_balance < $money) {
        echo '<script>alert("Sorry you do not have that amount of money");</script>';
        break;
      }
      $money = $money * -1;
      connToData("INSERT INTO Client_records VALUES (NULL,'$money','$date','$day',3,'$person1');");
      $money = $money * -1;
      connToData("INSERT INTO Client_records VALUES (NULL,'$money','$date','$day',2,'$person2');");
      echo '<script>alert("The money has been transferred");</script>';
      break;
    default:
      # code...
      break;
  }
  header('Location: moneytransfer.php', true);
}
?>