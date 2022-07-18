const setPass = function () {
  if (document.getElementById("password")) {
    fillPasswordFromLocalStorage();
  }
};

function makePassword(length) {
  var result = "";
  var characters =
    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+";
  var charactersLength = characters.length;
  for (var i = 0; i < length; i++) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength));
  }
  return result;
}

//TODO: WHEN STYLING UI -  make toggle eye on pass
//https://www.javascripttutorial.net/javascript-dom/javascript-toggle-password-visibility/
function initTogglePasswordButton() {
  const password = document.getElementById("password");
  const togglePassword = document.getElementById("togglePassword");
  togglePassword.addEventListener("click", function () {
    const type =
      password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
  });
}

function fillPasswordFromLocalStorage() {
  const localStoragePass = localStorage.getItem("password");
  if (localStoragePass === null) {
    localStorage.setItem("password", makePassword(8));
  }

  const pass = localStorage.getItem("password");
  document.getElementById("password").value = pass;
}

document.addEventListener("DOMContentLoaded", setPass);
