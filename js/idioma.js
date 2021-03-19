$(document).ready(function() {
    $("input[name='lang']").click(function() {
        console.log("out");
        $.ajax({
            url: '/../ExerciciLoginRegister/lib/idioma.php',
            data: {
                lang: this.value,
            },
            type: 'post',
            dataType: 'json',
            success: function(data) {
                location.reload();
            }
        });
    });
});
/*function changeIdioma() {
    console.log("idioma");
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            myFunction(this);
        }
    };
    xhttp.open("POST", "../../ExerciciLoginRegister/xml/lang-ca.xml", true);
    xhttp.send();
}

function myFunction(xml) {
    var xmlDoc = xml.responseXML;
    var x = xmlDoc.getElementsByTagName("lang");
    var i;
    for (i = 0; i < x.length; i++) {
        document.getElementsByClassName("myposts")[0].innerHTML = x[i].getElementsByTagName("post")[0].childNodes[0].nodeValue;
        //console.log(x[i].getElementsByTagName("photo")[0].childNodes[0].nodeValue);
    }
}*/