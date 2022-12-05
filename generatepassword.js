const password_ele = document.getElementById("pwd_txt");
var maj = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
var min = "acdefghijklnopqrstuvwxyz";
var nbr = "0123456789";
const special_chars = "@#$%^&*";
const generate = document.getElementById("generate");
const clipboard = document.getElementById("clipboard");
var pwd_length = document.getElementById("slider");

generate.addEventListener("click", () => {
  let password = "";
  var checkedsc = document.getElementById("checkboxsc").checked;
  var checkeduc = document.getElementById("checkboxuc").checked;
  var checkedlc = document.getElementById("checkboxlc").checked;
  var checkednb = document.getElementById("checkboxnb").checked;
  var final_string = "";
  console.log(checkedsc);
  if (checkedsc) {
    final_string += "@#$%^&*";
  }
  if (checkeduc) {
    final_string += maj;
  }
  if (checkedlc) {
    final_string += min;
  }
  if (checkednb) {
    final_string += nbr;
  }

  for (var i = 0; i < pwd_length.value; i++) {
    let pwd = final_string[Math.floor(Math.random() * final_string.length)];
    password += pwd;
  }
  password_ele.innerText = password;
  final_string = string;
});

clipboard.addEventListener("click", () => {
  navigator.clipboard.writeText(password_ele.innerText);
  alert("The generated password has been copied to your clipboard");
});
