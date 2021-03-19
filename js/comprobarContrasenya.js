function controlPassword() {
    let z = document.getElementsByTagName("p")[0];
    let y = document.getElementById("password");
    let x = document.getElementById("verifyPassword");
    if (x.value != y.value) {
        z.style.color = "red";
        z.style.fontSize = "10px";
        z.style.marginTop = "-10px";
        z.innerHTML = "Contrassenya incorrecte";
        y.style.border = " 1px solid red";
        x.style.border = " 1px solid red";
        z.style.float = "left";
        return false;
    } else return true;

}