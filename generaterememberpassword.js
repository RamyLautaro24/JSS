const password_ele = document.getElementById("pwd_txt");
var maj = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
var min = "acdefghijklnopqrstuvwxyz";
var nbr = "0123456789";
const special_chars = "@#$%^&*+/";
const generate = document.getElementById("generate");
const clipboard = document.getElementById("clipboard");
var word = document.getElementById("WORD");
var uc = document.getElementById("UCnum");
var lc = document.getElementById("LCnum");
var num = document.getElementById("NUMnum");
var symb = document.getElementById("SCnum");
var pwd_length = document.getElementById("slider");

generate.addEventListener("click", () => {
  let password = "";
  var final_string = "";
  if (uc > 0) {
    for (var i; i < uc; i++) {
      final_string += maj;
    }
  }
  if (lc > 0) {
    for (var i; i < lc; i++) {
      final_string += min;
    }
  }
  if (num > 0) {
    for (var i; i < num; i++) {
      final_string += nbr;
    }
  }
  if (word != "") {
    for (var i = 0; i < word.length; i++) {
      word += String.fromCharCode(word.charCodeAt(i) + 1);
    }
    final_string += word;
  }
  console.log(incrementStringLetters(word));

  if (final_string < pwd_length.value) {
    for (var i = 0; i < final_string - pwd_length.value; i++) {
      let pwd = final_string[Math.floor(Math.random() * final_string.length)];
      password += pwd;
    }
  }
  password_ele.innerText = password;
  final_string = string;
});

clipboard.addEventListener("click", () => {
  navigator.clipboard.writeText(password_ele.innerText);
  alert("The generated password has been copied to your clipboard");
});
