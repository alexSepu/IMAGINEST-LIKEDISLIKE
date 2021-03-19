$('.fa-thumbs-up').click(function() {
    if (y.classList.contains('far')) {
        y.classList.remove('far');
        y.classList.add('fas');
        y.style.color = 'green';
        $('#numberD').text((parseInt($('#numberL').text()) + 1).toString() + " ")
    }
});
$('.fa-thumbs-down').click(function() {
    if (y.classList.contains('far')) {
        y.classList.remove('far');
        y.classList.add('fas');
        y.style.color = 'red';
        $('#numberL').text((parseInt($('#numberL').text()) - 1).toString() + " ")
    }
});