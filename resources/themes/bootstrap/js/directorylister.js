$(document).ready(function () {
    $('.delete-form').submit(function (event) {
        if (!confirm("Are you sure that you want to delete the file or directory \"" + $(this).closest('li').attr('data-name') + "\"?")) {
            event.preventDefault();
        }
    });


    $('.file-unzip-button').click(function () {
        $.post({
            url: 'resources/scripts/unzip.php',
            type: 'post',
            data: {'file': $(this).closest('li').attr('data-href')},
            success: function (data) {
                location.reload();
            }
        })
    });

    $('#upload_btn').click(function () {
        $('#file-upload-modal').find('.modal-title').text("Upload a file");

        $('#file-upload-modal').modal('show');
    });

    $('#change-password').submit(function (event) {
        $.post({
            url: '/resources/scripts/update_profile.php',
            type: 'post',
            data: {'redirect': "false", 'password': $('#password').val()},
            success: function (data) {
                if (data === "true") {
                    $('#settings-modal').modal('toggle')
                }
            }
        });
        event.preventDefault();
    });

    $('#settings-link').click(function () {
        $('#settings-modal').find('.modal-title').text("Change password");


        $('#settings-modal').modal('show');
    });

// Hash button on click action
    $('.file-info-button').click(function (event) {

        // Get the file name and path
        var name = $(this).closest('li').attr('data-name');
        var path = $(this).closest('li').attr('data-href');

        // Set modal title value
        $('#file-info-modal .modal-title').text(name);

        $('#file-info').find('.md5-hash').text('Loading...');
        $('#file-info').find('.sha1-hash').text('Loading...');
        $('#file-info').find('.filesize').text('Loading...');

        $.ajax({
            url: '?hash=' + path,
            type: 'get',
            success: function (data) {

                // Parse the JSON data
                var obj = jQuery.parseJSON(data);

                // Set modal pop-up hash values
                $('#file-info').find('.md5-hash').text(obj.md5);
                $('#file-info').find('.sha1-hash').text(obj.sha1);
                $('#file-info').find('.filesize').text(obj.size);

            }
        });

        // Show the modal
        $('#file-info-modal').modal('show');

        // Prevent default link action
        event.preventDefault();
    });

})
;
