 var recordar_checkbox = document.getElementById("recordar");
 var emailInput = document.getElementById("email");
 // Verificar si se debe recordar el usuario al cargar la página
 if (localStorage.getItem("recordar_ussuario") === "true") {
     recordar_checkbox.checked = true;
     emailInput.value = localStorage.getItem("savedUser");
 }
 // Escuchar el evento de cambio del checkbox
 recordar_checkbox.addEventListener("change", function() {
     if (this.checked) {
         // Guardar el usuario en el almacenamiento local
         localStorage.setItem("recordar_ussuario", "true");
         localStorage.setItem("savedUser", emailInput.value);
     } else {
         // Eliminar el usuario del almacenamiento local
         localStorage.setItem("recordar_ussuario", "false");
         localStorage.removeItem("savedUser");
     }
 });