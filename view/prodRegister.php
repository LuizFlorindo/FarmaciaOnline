<?php 
  include_once("../dao/bdConnection.php");
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

  <title>Farmácia Online | Novo Produto</title>

  <link rel="stylesheet" href="../style.css">

</head>
<body>
<header id="website_header">
    <img src="../media/image/pharmacy_logo.png" alt="Logo da loja" id="website_logo">

    <nav id="navbar">
      <a href="./index.php" class="itemNavbar">Home</a>
      <a href="./about.html" class="itemNavbar">Sobre</a>
      <a href="./prodRegister.php" class="itemNavbar" id="novoProduto_button">Novo Product</a>
      <a href="./updateProduct.php" class="itemNavbar" id="atualizarProduto_button">Update Product</a>
      <a href="./basket.html" class="itemNavbar">
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
          <a href="./login.php" id="login_button">Login</a>
          <a href="./register.php" id="register_button">Register</a>
          <a href="../controller/exit.php" id="exit_button">Exit</a>
        </div>
      </div>
    </nav>
  </header>

  <main id="container_addProduct">

    <h2>Novo Produto</h2>

    <form action="./prodRegister.php" method="POST" id="formProdRegister">
      <div id="form_left">
        <div class="container_input_registerProd">
          <label for="nomeProduto">Nome:</label>
          <input type="text" name="nome" id="nomeProduto">
        </div>
        <div class="container_input_registerProd">
          <label for="marcaProduto">Marca:</label>
          <input type="text" name="marca" id="marcaProduto"><br>
        </div>
        <div div class="container_input_registerProd">
          <label for="quantidadeProduto">Quantidade:</label>
          <input type="number" name="quantidade" id="quantidadeProduto">
        </div>
        <div class="container_input_registerProd">
          <label for="precoProduto">Preço:</label>
          <input type="text" name="preco" id="precoProduto"><br>
        </div>
        <div class="container_input_registerProd">
          <label for="descricaoProduto">Descrição:</label>
          <textarea name="descricao" id="descricaoProduto"></textarea>
        </div>

        <input type="submit" name="submit" value="Adicionar ao Estoque">
      </div>

      <div id="form_right">
        <div>
          <img class="upload_img" id="file_upload" name="image">
          <div class="upload-btn">
            <label for="inputUpFile" id="btn_image">Selecionar Imagem</label>
            <input type="file" name="image_produto" id="inputUpFile" onchange="readURL(this);">
          </div>
        </div>

        <div id="container_list_categorias">
          <select name="categoria" id="lista_categoria"></select>
        </div>
      </div>
    </form>
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
        if(isset($_POST["submit"])){
          $nome_produto = filter_input(INPUT_POST, "nome", FILTER_DEFAULT);
          $descricao_produto = filter_input(INPUT_POST, "descricao", FILTER_DEFAULT);
          $marca_produto = filter_input(INPUT_POST, "marca", FILTER_DEFAULT);
          $quantidade_produto = filter_input(INPUT_POST, "quantidade", FILTER_DEFAULT);
          $preco_produto = filter_input(INPUT_POST, "preco", FILTER_DEFAULT);
          $categoria_produto = filter_input(INPUT_POST, "categoria", FILTER_DEFAULT);
          var_dump($imagem_produto);
        }else{
          echo "<script>console.log('Estou aqui')</script>";
        }
      }
    } 
  } else {
    echo "<script>disable_menu_items('deslogado', 'comum')</script>";
  }

  $query = "SELECT * FROM categoria";
  $categorias = mysqli_query($conn, $query);

  if(mysqli_num_rows($categorias) > 0){
    while($catego = mysqli_fetch_assoc($categorias)){
      $catego = json_encode($catego);
      echo "<script>listCategorias($catego)</script>";
    }
  }else{
    echo "<script>listCategorias('vazio')</script>";
  }

  if(isset($_POST['submit'])){

    $nome = $_POST['name_produto'];
    $dataValidade = $_POST['dataValidade'];
  
    $arrayData = explode("-", $dataValidade);
    $dataValidade = $arrayData[2] . "/" . $arrayData[1] . "/" . $arrayData[0];
  
    $quantidade = $_POST['quant_produto'];
    $valor = $_POST['valor_produto'];
    $marca = $_POST['marca_produto'];
    $descricao = $_POST['descricao_produto'];
    $categoria = $_POST['categoria'];
  
  
    //upload da imagem
    $uploadDir = '../media/image/imagens_produtos/';
    $fileName = $_FILES['image_produto']['name'];
    $tempName = $_FILES['image_produto']['tmp_name'];
    $filePath = $uploadDir . $fileName;
    $imagem = $fileName;
  
    $uploadImage = move_uploaded_file($tempName, $filePath);
  
    if ($uploadImage) {
      $query = "INSERT INTO produto (nome_produto, DataValidade_produto, marca_produto, quant_produto, image_produto, valor_produto, descricao_produto, categoria_produto) VALUES ('$nome','$dataValidade', '$marca', '$quantidade','$imagem','$valor', '$descricao', '$categoria')";
      $result = mysqli_query($conn, $query);
      if ($result) {
        echo "<script>document.getElementById('infor').innerText='Dados adicionado com sucesso'</script>";
      } else {
        echo "<script>document.getElementById('infor').innerText='Erro ao cadastrar os dados'</script>";
      }
    } else {
      echo "<script>document.getElementById('infor').innerText = Erro: cadastro não foi possivel pois a imagem não carregou</script>";
    }
  }
?>