let colors = ['#0D47A1', '#1565C0', '#1976D2', '#1E88E5', '#2196F3'];
$(document).ready(function() {
    $('#like , #dislike').click(function() {
        console.log("out");
        $.ajax({
            url: '/ExerciciLoginRegister/lib/dislike.php',
            data: {
                namePhoto: photoName(),
                type: this.id,
            },
            type: 'post',
            dataType: 'json',
            success: function(data) {
                $('#photo').attr("src", "pujades/" + data["photo"] + ".png");
                descriptionHashtag(data["description"]);
                setLikeDislike(data["likes"], data["dislikes"]);
                setUserPostDate(data['datePost'], data["user"]);

                rating(data["rating"]);
                printLikeDislike(data["next"]);
                colorRandom();
                console.log("in");
            }
        });
    });
});
$(document).ready(function() {
    colorRandom();
})

function printLikeDislike(likeDislike) {
    if (likeDislike == 1) {
        $('.fa-thumbs-up').removeClass('far');
        $('.fa-thumbs-down').removeClass('fas');
        $('.fa-thumbs-down').addClass('far');
        $('.fa-thumbs-up').addClass('fas');
        $('.fa-thumbs-down').css('color', 'black');
        $('.fa-thumbs-up').css('color', 'green');
    } else if (likeDislike == 0) {
        $('.fa-thumbs-up').removeClass('fas');
        $('.fa-thumbs-down').removeClass('far');
        $('.fa-thumbs-down').addClass('fas');
        $('.fa-thumbs-up').addClass('far');
        $('.fa-thumbs-up').css('color', 'black');
        $('.fa-thumbs-down').css('color', 'red');
    } else {
        $('.fa-thumbs-up').removeClass('fas');
        $('.fa-thumbs-down').removeClass('fas');
        $('.fa-thumbs-down').addClass('far');
        $('.fa-thumbs-up').addClass('far');
        $('.fa-thumbs-up').css('color', 'black');
        $('.fa-thumbs-down').css('color', 'black');
    }
}

function colorRandom() {
    let x = Math.floor(Math.random() * 5);
    $('blockquote').css('background-color', colors[x]);
}

function setUserPostDate(datePost, user) {
    $('date').text(datePost);
    $('userPost').text(" by " + user);
}

function setLikeDislike(likes, dislikes) {
    $('#numberL').text(likes);
    $('#numberD').text(dislikes);
}

function photoName() {
    let array = $('#photo').attr("src").split(".");
    let res = array[0].split('/');
    return res[1];
}

function rating(rating) {
    $('#rating').html(" ");
    let i = 1;
    for (i = 1; i <= rating; i++) {
        $('#rating').html($('#rating').html() + '<i class="fas fa-star fa-lg">');
    }
    for (let j = i; j <= 5; j++) {
        $('#rating').html($('#rating').html() + '<i class="far fa-star fa-lg">');
    }
}

function descriptionHashtag(description) {
    $('#post').html("<span class='leftq quotes'>&ldquo;</span>");
    let arr = description.split(' ');
    for (let z = 0; z < arr.length; z++) {
        if (arr[z][0] == '#') $('#post').html($('#post').html() + "<a href='#' style='color:#013156'>" + arr[z] + " </a>");
        else $('#post').html($('#post').html() + arr[z] + " ");
    }
    $('#post').html($('#post').html() + "<span class='rightq quotes'>&bdquo; </span>");
}