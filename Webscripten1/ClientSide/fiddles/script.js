$(document).ready(function () {
    $('#button').click(function () {
        var string = $('#string').val();

        $.get('file.php', { input: string }, function (data) {
            $('#feedback').text(data);
        });
    });
});