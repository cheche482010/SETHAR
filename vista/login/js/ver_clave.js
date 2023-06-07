 function ver_clave() {
     var passwordInput = document.getElementById("password");
     var passwordIcon = document.getElementById("togglePasswordIcon");
     if (passwordInput.type === "password") {
         passwordInput.type = "text";
         passwordIcon.classList.remove("fa-eye");
         passwordIcon.classList.add("fa-eye-slash");
     } else {
         passwordInput.type = "password";
         passwordIcon.classList.remove("fa-eye-slash");
         passwordIcon.classList.add("fa-eye");
     }
 } 