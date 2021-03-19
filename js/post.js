document.getElementById("exampleInputPassword1").addEventListener("keydown", function(event) {
    document.getElementsByClassName("alert")[0].innerHTML = this.value;
    let x = document.getElementsByTagName("small")[0];
    let res = 150 - document.getElementsByName("desc")[0].value.length;
    if (res > 0) {
        x.innerHTML = 'Max ' + res;
    } else {
        x.innerHTML = 'Max 0';
    }
})

function borrar(e) {
    var elCaracter = e.keyCode;
    alert(elCaracter);
}
document.getElementById("fileToUpload").onchange = function(e) {
    // Creamos el objeto de la clase FileReader
    let reader = new FileReader();

    // Leemos el archivo subido y se lo pasamos a nuestro fileReader
    reader.readAsDataURL(e.target.files[0]);

    // Le decimos que cuando este listo ejecute el código interno
    reader.onload = function() {
        let preview = document.getElementById('imgPost');
        let image = document.getElementById('imgPost')
        image.src = reader.result;
        image.style.position = "relative";
        image.style.maxWidth = "100%";
        image.style.maxHeight = "100%";
        image.style.marginTop = "0px";
        preview.innerHTML = '';
        preview.append(image);
    };
}