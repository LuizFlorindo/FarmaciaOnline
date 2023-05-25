/* Habilita e Desabilita a visualização da senha no formulario de login e registro */
function show_hide(element) {
  const icon_view_password = document.getElementById("icon_view_password");
  const icon_view_confirmPassword = document.getElementById("icon_view_confirm");
  const password = document.querySelector("#password");
  const confirmPassword = document.querySelector("#confirmPassword");

  switch (element) {
    case "password":
      if (password.type === "password") {
        password.setAttribute("type", "text");
        icon_view_password.classList.add("hide");
      } else {
        password.setAttribute("type", "password");
        icon_view_password.classList.remove("hide");
      }
      break;

    case "confirmPassword":
      if (confirmPassword.type === "password") {
        confirmPassword.setAttribute("type", "text");
        icon_view_confirmPassword.classList.add("hide");
      } else {
        confirmPassword.setAttribute("type", "password");
        icon_view_confirmPassword.classList.remove("hide");
      }
      break;
  }
}


/* solicitar preenchimento de todos os dados */
const alertMessage = document.getElementById("alertMessage");
function alertMessageHTML(attribute, message) {
  switch (attribute) {
    case "error":
      alertMessage.innerText = message;
      alertMessage.classList.remove("success")
      alertMessage.classList.add("error");
      break;
    case "success":
      alertMessage.innerText = message;
      alertMessage.classList.remove("error");
      alertMessage.classList.add("success")
      break;
    default:
      alertMessage.innerText = "";
      break;
  }
}

/* 
  Se o usuário estiver logado vai desabilitar os botões de login e register do menu
  Se o usuário for um usuário comum ele vai desabilitar o menu administrador se não ele vai mostrar o menu administrador
*/
const login_button = document.getElementById("login_button");
const register_button = document.getElementById("register_button");
const exist_button = document.getElementById("exit_button");
const novoProduto = document.getElementById("novoProduto_button");
const atualizarProduto = document.getElementById("atualizarProduto_button");
function disable_menu_items(statusLogin, statosContaUser) {
  if (statusLogin == "logado") {
    login_button.style.display = "none";
    register_button.style.display = "none";
    exist_button.style.display = "block";
  } else if (statusLogin == "deslogado") {
    login_button.style.display = "block";
    register_button.style.display = "block";
    exist_button.style.display = "none";
  }

  if (statosContaUser == "comum") {
    novoProduto.style.display = "none";
    atualizarProduto.style.display = "none";
    
  } else if (statosContaUser == "admin") {
    novoProduto.style.display = "block";
    atualizarProduto.style.display = "block";
  }

  if(statusLogin == "logado" && statosContaUser == "admin") {
    register_button.style.display = "block";
  }
}


/* Listar produtos */
function listProducts(prod) {
  //Criação do elemento div
  var produto = document.createElement('div');
  produto.className = 'produto';

  var imageProduto = document.createElement('img');
  imageProduto.src = "media/image/produto/" + prod['image'];

  var nomeHTML = document.createElement("h2");
  nomeHTML.innerHTML = "R$ " + prod['nome'];
  produto.appendChild(nomeHTML);

  var precoHTML = document.createElement("h4");
  precoHTML.innerHTML = "R$ " + prod['preco'];
  produto.appendChild(precoHTML);

  // Adiciona o produto à vitrine
  var vitrineElemento = document.getElementById('vitrine');
  vitrineElemento.appendChild(produto);
}

/* Listar Categorias */
function listCategorias(catego) {
  var list = document.getElementById("lista_categoria")
  var option = document.createElement('option');
  if (catego == 'vazio') {
    option.value = '0';
    option.innerHTML = "Nenhuma categoria";
    
    list.appendChild(option);
  } else {
    option.value = catego['id'];
    option.innerHTML = catego['nome'];
    list.appendChild(option);
  }
}

/* Mostrar imagem selecionada no input file */
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    
    reader.onload = (e) => {
      campoImage = document.getElementById("file_upload");
      campoImage.src = e.target.result;
    }
    reader.readAsDataURL(input.files[0]);
  }

}

function resizeImage(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      var image = new Image();
      image.src = e.target.result;
      
      image.onload = function() {
        var canvas = document.createElement('canvas');
        var context = canvas.getContext('2d');
        
        // Redimensionar para 1:1
        var size = Math.min(image.width, image.height);
        canvas.width = size;
        canvas.height = size;
        
        // Desenhar imagem redimensionada no canvas
        context.drawImage(
          image,
          (image.width - size) / 2,
          (image.height - size) / 2,
          size,
          size,
          0,
          0,
          size,
          size
        );
        
        // Exibir imagem redimensionada na div
        var div = document.getElementById('imagePreview');
        div.innerHTML = '';
        div.appendChild(canvas);
      };
    };
    
    reader.readAsDataURL(input.files[0]);
  }
}
