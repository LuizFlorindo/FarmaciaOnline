/* To view or to hide Password Sing Up */
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
      alertMessage.innerHTML = message;
      alertMessage.classList.remove("success")
      alertMessage.classList.add("error");
      break;

    case "success":
      alertMessage.innerHTML = message;
      alertMessage.classList.remove("error");
      alertMessage.classList.add("success")
  }
}