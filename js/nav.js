function myfunction() {
    var x = document.getElementsByClassName("navbar")[0];
    if (screen.width <= 768) {
        var y = document.getElementsByTagName("a");
        y[0].innerHTML = `<i class="fas fa-plus-square fa-2x"></i>`;
        y[1].innerHTML = `<i class="fas fa-home fa-2x"></i>`;
        //y[2].innerHTML = `<i class="fas fa-sign-out-alt fa-2x"></i>`;
        y[0].style.textAlign = 'center';
        y[1].style.textAlign = 'center';
        y[2].style.textAlign = 'center';
    } else {
        var y = document.getElementsByTagName("a");
        y[0].innerHTML = /*'<i class="fas fa-plus-square fa-2x"></i>*/ '<?php echo $idiomes["POST"]; ?>';
        y[1].innerHTML = /*'<i class="fas fa-home fa-2x"></i>&nbsp; */ '<?php echo $idiomes["HOME"]; ?>';
        // y[2].innerHTML = `<i class="fas fa-sign-out-alt fa-2x"></i>&nbsp; Logout`;
        y[0].style.textAlign = 'center';
        y[1].style.textAlign = 'center';
        y[2].style.textAlign = 'center';

    }
}