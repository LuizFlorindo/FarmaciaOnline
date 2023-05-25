<?php 
  session_start();
?>

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
      <a href="./about.html" class="itemNavbar">Sobre</a>
      <a href="./prodRegister.php" class="itemNavbar" id="novoProduto_button">Novo Product</a>
      <a href="./view/updateProduct.php" class="itemNavbar" id="atualizarProduto_button">Update Product</a>
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
          <a href="./login.php" id="login_button">Login</a>
          <a href="./register.php" id="register_button">Register</a>
          <a href="../controller/exit.php" id="exit_button">Exit</a>
        </div>
      </div>
    </nav>
  </header>


  <main id="container_login">
    <div id="particao_containerLogin">
      <div id="left_container_login">
        <form action="./login.php" method="post">
          <div id="form_head">
            <img src="../media/image/login.png" alt="Representação de uma porta aberta e uma seta apontando para dentro">
            <h2>Login de Usuário</h2>
          </div>

          <div id="form_body">
            <label for="email">E-mail:</label>
            <div class="controller_input">
              <input type="email" name="email" id="email" placeholder="Digite seu email de login">
            </div>

            <label for="password">Senha:</label>
            <div class="controller_input">
              <input type="password" name="password" id="password" placeholder="Digite sua senha de login">
              <div id="icon_view_password" onclick="show_hide('password')"></div>
            </div>

            <span id="alertMessage"></span>
            <div id="btn_create">
              <input type="submit" name="submit" value="Login">
            </div>
            <div id="links">
              <p>Não possue conta?<a href="./register.php">cadastrar-se</a></p>
              <p>Esqueceu a senha? <a href="./forgotPassword.html">Modificar senha</a></p>
            </div>
          </div>
        </form>

      </div>
      <div id="right_container_login"></div>
    </div>
  </main>
  <script src="../script.js"></script>
</body>

</html>

<?php
if (isset($_SESSION['login_user'])) {
  $user_id = $_SESSION['login_user'];
  $query = "SELECT * FROM usuarios WHERE id='$user_id'";
  $user = mysqli_query($conn, $query);
  if (mysqli_num_rows($user) == 1) {
    $user_dados = mysqli_fetch_assoc($user);

    /* Esconde o menu administrador do usuário comum */
    if ($user_dados['statusConta'] == "comum") {
      echo "<script>disable_menu_items('logado', 'comum')</script>";
    } else {
      echo "<script>disable_menu_items('logado', 'admin')</script>";
    }
  } 
} else {
  echo "<script>disable_menu_items('deslogado', 'comum')</script>";
}

if (isset($_POST['submit'])) {
  if (empty($_POST['email']) || empty($_POST['password'])) {
    echo "<script>alertMessageHTML('error', 'Erro: Empty field. Please fill in all fields!')</script>";
  } else {
    include_once("../dao/bdConnection.php");

    echo "<script>alertMessageHTML('success', '')</script>";

    /* 
        Segurança para evitar injeção de SQL no banco de dados (códigos maliciosos)
        Security to avoid SQL injection into the database (malicious codes)
      */
    $email = filter_input(INPUT_POST, "email", FILTER_DEFAULT);
    $password = md5(filter_input(INPUT_POST, "password", FILTER_DEFAULT));

    $check_if_account_exists = "SELECT * FROM usuarios WHERE email='$email' AND senha='$password'";
    $res = mysqli_query($conn, $check_if_account_exists);
    if (mysqli_num_rows($res) == 1) {
      $user = mysqli_fetch_assoc($res);
      session_start();
      if (isset($_SESSION['login_user'])) {
        session_destroy();
      }
      $_SESSION['login_user'] = $user['id'];

      echo "
      <script>
        alertMessageHTML('success', 'Logado com sucesso!');
        setInterval(()=>window.location.href='../index.php', 1000);
      </script>
      ";
    } else {
      echo "<script>alertMessageHTML('error', 'Erro: Falha ao tentar logar. Por favor tente novamente.')</script>";
    }
  }
}
?>