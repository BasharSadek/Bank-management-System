<?php include("database.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Make Contact with css file -->
  <link rel="stylesheet" href="css/style.css" />
  <title>login</title>
</head>

<body>
  <!-- Header -->
  <header>
    <div class="left-section">
      <div class="bank-logo">
        <a href="#" class="bank-logo">
          <img class="img-bank" src="images/bank.jpg" alt="">
        </a>
      </div>
      <div class="logo-shield"><b> Bank Management</div>
    </div>
    <div class="right-section">
    </div>
  </header>
  <!-- Navbar -->
  <div class="content-area">
    <aside>
      <nav>
        <form method="post">
          <label for="" class="header-form"> Log in to the site</label>
          <label for="user">E-mail : </label>
          <input required type="email" name="email" id="user" placeholder="E-mail" />
          <img class="img" src="images/user.png" alt="">
          <label for="password">Password :</label>
          <input required type="password" name="password" id="password" placeholder="Password" />
          <img class="img" src="images/password.png" alt="">
          <input class="submit" name="login" type="submit" value="Login" />
        </form>
      </nav>
    </aside>
    <!-- Main -->
    <main class="left-contain">
      <div class="hello-container">
        <span class="hello">
          <b> Bank Management System</b>
        </span>
        <p class="details">
          The site helps customers to add money to their bank accounts
          and also helps them withdraw money and transfer an amount
          of money to another account.
        </p>
        <hr />
      </div>
    </main>
    <main class="right-contain">
      <img src="images/about-us.jpg" alt="" />
    </main>
  </div>
</body>

</html>
<?php
if (isset($_POST['login'])) {
  if ($_POST['email'] == "admin@gmail.com" && $_POST['password'] == 123) {
    header('Location: admin.php');
  }

  $data = getFromData("SELECT client.id_client,account.email,account.passwordA,account.id_account
 FROM client JOIN account
 ON client.id_account=account.id_account");
  foreach ($data as $result) {
    if ($_POST['email'] == $result["email"] && $_POST['password'] == $result["passwordA"]) {
      session_start();
      $_SESSION['id'] = $result["id_client"];
      $_SESSION['email'] = $result["email"];
      $_SESSION['idAcc'] = $result["id_account"];
      header('Location: client.php');
    }
  }
  echo '<script>alert("There is an error in the email or password");</script>';
}
?>