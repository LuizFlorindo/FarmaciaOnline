<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta name="description" content="Looking for an easy and convenient way to get your prescription and over-the-counter medications? Our online pharmacy offers a wide range of medications to meet your healthcare needs. Browse our website from the comfort of your own home and have your medications delivered straight to your doorstep. With fast and discreet shipping and experienced pharmacists on hand to answer any questions you may have, shopping for medications has never been easier. Visit us today and experience the convenience of online pharmacy shopping!">
  <link rel="shortcut icon" href="../media/image/pharmacy_logo.png" type="image/x-icon">

  <title>Online Pharmacy | Login</title>

  <link rel="stylesheet" href="../style.css">
</head>

<body>
  <header id="website_header">
    <img src="../media/image/pharmacy_logo.png" alt="Logo da loja" id="website_logo">

    <nav id="navbar">
      <a href="../index.php" class="itemNavbar">Home</a>
      <a href="./about.html" class="itemNavbar">About</a>

      <a href="./basket.html" class="itemNavbar">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" id="basketIcon" viewBox="0 0 16 16">
          <path d="M5.929 1.757a.5.5 0 1 0-.858-.514L2.217 6H.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h.623l1.844 6.456A.75.75 0 0 0 3.69 15h8.622a.75.75 0 0 0 .722-.544L14.877 8h.623a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1.717L10.93 1.243a.5.5 0 1 0-.858.514L12.617 6H3.383L5.93 1.757zM4 10a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm3 0a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm4-1a1 1 0 0 1 1 1v2a1 1 0 1 1-2 0v-2a1 1 0 0 1 1-1z" />
        </svg>
        <p id="itemBasket">0</p>
      </a>

      <div id="dropDownMenuLogin">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" id="btnIconLoginDropDown" viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
          <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
        </svg>

        <div id="itemMenuLogin">
          <a href="./login.html">Login</a>
          <a href="./register.html">Register</a>
          <a href="../controller/exit.php">Exit</a>
        </div>
      </div>
    </nav>
  </header>

  <main id="container_register">
    <div id="containerRegister_partitions">
      <div id="left_container">
        <img src="../media/image/image_right_singUp.png" alt="imagem qualquer">
      </div>
      <div id="right_container">
        <form action="./register.php" method="post">
          <div id="form_head">
            <img src="../media/image/conecte-se.png" alt="enter image">
            <h2>Welcome</h2>
          </div>
          <div id="form_body">

            <label for="email">E-mail:</label>
            <div class="controller_input">
              <input type="email" name="email" id="email">
            </div>

            <label for="password">Password:</label>
            <div class="controller_input">
              <input type="password" name="password" id="password">
              <div id="icon_view_password" onclick="show_hide('password')"></div>
            </div>

            <span id="alertMessage"></span>
            <div id="btn_create">
              <input type="submit" name="submit" value="Create">
            </div>
            <div id="links">
              <a href="./register.php">Don't have an account?</a>
              <a href="./register.php">Forgot password?git</a>
            </div>
          </div>
        </form>
      </div>
    </div>

  </main>
  <script src="../script.js"></script>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
  if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['confirmPassword'])) {
    echo "<script>alertMessageHTML('error', 'Error: Empty field. Please fill in all fields!')</script>";
  } else {
    include_once("../dao/bdConnection.php");

    echo "<script>alertMessageHTML('sucess', '')</script>";

    /* 
        Segurança para evitar injeção de SQL no banco de dados (códigos maliciosos)
        Security to avoid SQL injection into the database (malicious codes)
      */
    $name = filter_input(INPUT_POST, "name", FILTER_DEFAULT);
    $email = filter_input(INPUT_POST, "email", FILTER_DEFAULT);
    $password = md5(filter_input(INPUT_POST, "password", FILTER_DEFAULT));
    $confirmPassword = md5(filter_input(INPUT_POST, "confirmPassword", FILTER_DEFAULT));

    echo $name, $confirmPassword, $email, $password;
    if ($password == $confirmPassword) {
      $check_if_account_exists = "SELECT * FROM usuarios WHERE email='$email'";
      if (mysqli_query($conn, $check_if_account_exists)) {
        echo "<script>alertMessageHTML('error', 'Error: An account with that email already exists. Try a new email or login with existing email.')</script>";
      } else {
        $query = "INSERT INTO usuarios(nome, email, senha, statusConta) VALUES ('$name', '$email', '$password', 'common')";
        if (mysqli_query($conn, $query)) {
          echo "<script>alertMessageHTML('sucess', 'Account successfully created!')</script>";
          echo "<script>windown.location.href='./singIn.php'</script>";
        } else {
          echo "<script>alertMessageHTML('error', 'Error: Failed to try to create the account. Please try again.')</script>";
        }
      }
    } else {
      echo "<script>alertMessageHTML('error', 'Error: Entered passwords are different. Please try again.')</script>";
    }
  }
}
?>