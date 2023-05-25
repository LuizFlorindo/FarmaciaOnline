<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Looking for an easy and convenient way to get your prescription and over-the-counter medications? Our online pharmacy offers a wide range of medications to meet your healthcare needs. Browse our website from the comfort of your own home and have your medications delivered straight to your doorstep. With fast and discreet shipping and experienced pharmacists on hand to answer any questions you may have, shopping for medications has never been easier. Visit us today and experience the convenience of online pharmacy shopping!">
  <link rel="shortcut icon" href="./media/image/pharmacy_logo.png" type="image/x-icon">

  <title>Online Pharmacy | Home</title>

  <link rel="stylesheet" href="./style.css">

</head>

<body>
  <header id="website_header">
    <img src="./media/image/pharmacy_logo.png" alt="Logo da loja" id="website_logo">

    <nav id="navbar">
      <a href="./index.php" class="itemNavbar">Home</a>
      <a href="./view/about.html" class="itemNavbar">Sobre</a>
      <a href="./view/prodRegister.php" class="itemNavbar" id="novoProduto_button">Novo Product</a>
      <a href="./view/updateProduct.php" class="itemNavbar" id="atualizarProduto_button">Update Product</a>
      <a href="./view/basket.html" class="itemNavbar">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" id="basketIcon" viewBox="0 0 16 16">
          <path
            d="M5.929 1.757a.5.5 0 1 0-.858-.514L2.217 6H.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h.623l1.844 6.456A.75.75 0 0 0 3.69 15h8.622a.75.75 0 0 0 .722-.544L14.877 8h.623a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1.717L10.93 1.243a.5.5 0 1 0-.858.514L12.617 6H3.383L5.93 1.757zM4 10a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm3 0a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm4-1a1 1 0 0 1 1 1v2a1 1 0 1 1-2 0v-2a1 1 0 0 1 1-1z" />
        </svg>
        <p id="itemBasket">0</p>
      </a>

      <div id="dropDownMenuLogin">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" id="btnIconLoginDropDown" viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
          <path fill-rule="evenodd"
            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
        </svg>

        <div id="itemMenuLogin">
          <a href="./view/login.php" id="login_button">Login</a>
          <a href="./view/register.php" id="register_button">Register</a>
          <a href="./controller/exit.php" id="exit_button">Exit</a>
        </div>
      </div>
    </nav>
  </header>

  <main id="vitrine">

  </main>

  <script src="./script.js"></script>
</body>

</html>

<?php
session_start();
include_once("./dao/bdConnection.php");

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

//Listar produtos
$query = "SELECT * FROM produto";
$res = mysqli_query($conn, $query);

if (mysqli_num_rows($res) != 0) {
  while ($prod = mysqli_fetch_assoc($res)) {
    $prod = json_encode($prod);
    echo "<script>listProducts($prod)</script>";
  }
}
?>