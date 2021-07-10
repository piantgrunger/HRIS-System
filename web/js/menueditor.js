$(function () {
    $('#menu-nestable').nestable({
        group: 1
    });
    $('#menu-nestable').on('change', function () {
        var jsonData = $('#menu-nestable').nestable('serialize');
        $.ajax({
            url: ajaxMenuUrl,
            method: 'post',
            data: {
                jsonData: jsonData
            },
            success: function (data) {
                //console.log(data);
            }
        });
    });

    $("#menu-nestable .editMenuBtn").on("click", function () {
        var info = JSON.parse($(this).attr("info"));

        var url = $("#menu-edit-form").attr("action");
        index = url.lastIndexOf("/");
        url2 = url.substring(0, index + 1) + info.id;
        // console.log(url2);
        $("#menu-edit-form").attr("action", url2);
        $("#EditModal").modal("show");
    });

    $("#tab-modules .addModuleMenu").on("click", function () {
        var module_id = $(this).attr("module_id");
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        $.ajax({
            url: insertMenuUrl,
            method: 'POST',
            data: {
                'type': 'module',
                'module_id': module_id,
                '_csrf-backend': csrfToken
            },
            success: function (data) {
                window.location.reload();
            }
        });
    });
});
