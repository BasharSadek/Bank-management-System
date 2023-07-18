<?php include("database.php");
session_start();
$id = $_SESSION['id'];
$email = $_SESSION['email'];
$idAcc = $_SESSION['idAcc'];
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
  <title>Money Transfer</title>
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
      <span class="caption"><b>Money Transfer :</b></span>
      <form action="" method="post">
        <table class="styled-table">
          <thead>
            <tr>
              <th><b>amount of money</b></th>
              <th><b>Process Name</b></th>
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
              <td> <select value="1" name="person">
                  <?php
                  $data2 = getFromData("SELECT client.id_client,client.first_name,client.last_name FROM client 
                WHERE client.id_client != '$id'");
                  foreach ($data2 as $result) {
                    echo '<option value=" ' . $result["id_client"] . ' " name="person" >' .
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
  $person = $_POST['person'];
  $data = getFromData("SELECT SUM(client_records.valuemoney)  AS 'sum' FROM client_records 
  WHERE client_records.id_client='$id'");
  foreach ($data as $re) {
    $current_balance = $re['sum'];
  }
  switch ($num) {
    case 2:
      connToData("INSERT INTO Client_records VALUES (NULL,'$money','$date','$day','$num','$id');");
      echo '<script>alert("Money has been added to your account");</script>';
      break;
    case 3:
      if ($current_balance < $money) {
        echo '<script>alert("Sorry you do not have that amount of money");</script>';
        break;
      }
      $money = $money * -1;
      connToData("INSERT INTO Client_records VALUES (NULL,'$money','$date','$day','$num','$id');");
      echo '<script>alert("Done Saved");</script>';
      break;
    case 4:
      if ($current_balance < $money) {
        echo '<script>alert("Sorry you do not have that amount of money");</script>';
        break;
      }
      $money = $money * -1;
      connToData("INSERT INTO Client_records VALUES (NULL,'$money','$date','$day',3,'$id');");
      $money = $money * -1;
      connToData("INSERT INTO Client_records VALUES (NULL,'$money','$date','$day',2,'$person');");
      echo '<script>alert("The money has been transferred");</script>';
      break;
    default:
      # code...
      break;
  }
  header('Location: moneytransferclient.php', true);







  // if ($num == 2) {
  //   connToData("INSERT INTO Client_records VALUES (NULL,'$money','$date','$day','$num','$id');");
  //   echo '<script>alert("Money has been added to your account");</script>';
  // } elseif ($current_balance < $money) {
  //   echo '<script>alert("Sorry you do not have that amount of money");</script>';
  // } else {
  //   if ($num == 3) {
  //     $money = $money * -1;
  //     connToData("INSERT INTO Client_records VALUES (NULL,'$money','$date','$day','$num','$id');");
  //   }
  //   if ($num == 4)
  //     $money = $money * -1;
  //   connToData("INSERT INTO Client_records VALUES (NULL,'$money','$date','$day',3,'$id');");
  //   $money = $money * -1;
  //   connToData("INSERT INTO Client_records VALUES (NULL,'$money','$date','$day',2,'$id');");
  //}

}
?>