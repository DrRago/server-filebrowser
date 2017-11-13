$("#login-button").click(function (event) {
    event.preventDefault();
    $.post("scripts/login.php", {
        username: $(".username").val(),
        password: $(".password").val(),
        key: $(".key").val()
    }).done(function (data) {
        if (data === "200") {
            $('form').fadeOut(500);
            $('.wrapper').addClass('form-success');
            window.setTimeout(function() {
                window.location.href = '../browse.php';
            }, 2000);
        } else {
            $('form').effect("shake", {times: 3}, 100);
        }
    });
});