var pass = document.getElementById("passwordStrength");
var rePass = document.getElementById("repassStrength");
var msg = document.getElementById("messageStrength");
var str = document.getElementById("spanStrength");
var showPassword = document.getElementById("showBtn-p");
var showRePassword = document.getElementById("showBtn-Re-p");

pass.addEventListener("input", () => {
  if (pass.value.length > 0) {
    msg.style.display = "block";
  } else {
    msg.style.display = "none";
  }

  if (pass.value.length < 4) {
    str.innerHTML = "ضعيف";
    msg.style.color = "red";
  } else if (pass.value.length >= 4 && pass.value.length < 8) {
    str.innerHTML = "متوسطه";
    msg.style.color = "orange";
  } else if (pass.value.length >= 8) {
    str.innerHTML = "قويه";
    msg.style.color = "green";
  }
});

showPassword.onclick = function (e) {
  "use strict";
  e.preventDefault();
  if (this.textContent === "show") {
    pass.setAttribute("type", "text");
    this.textContent = "hide";
  } else if (this.textContent === "hide") {
    pass.setAttribute("type", "password");
    this.textContent = "show";
  }
};

showRePassword.onclick = function (e) {
  "use strict";
  e.preventDefault();
  if (this.textContent === "show") {
    rePass.setAttribute("type", "text");
    this.textContent = "hide";
  } else if (this.textContent === "hide") {
    rePass.setAttribute("type", "password");
    this.textContent = "show";
  }
};
