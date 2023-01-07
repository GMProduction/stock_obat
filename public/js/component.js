
function getDataSelect(url, select1, awal = 'Pilih Data',semua = null, a,parent) {
    var select = $('#' + select1);
    select.empty();
    $.get(url, function (data) {
        select.empty();
        if (data['status'] === 200) {
            select.append('<option value="" selected="selected" disabled>' + awal + '</option>');
            if (semua){
                select.append('<option value="all" selected="">'+semua+'</option>');
            }
            $.each(data['payload'], function (key, value) {
                if (a && a === value['id']) {
                    select.append('<option value="' + value['id'] + '" selected>' + value['name'] + '</option>')
                } else {
                    select.append('<option value="' + value['id'] + '">' + value['name'] + '</option>')
                }
            });
        }
        $('#' + select1).select2({
            dropdownParent: parent
        });

    })
}

function getDataSelectTags(url, select1, awal = 'Pilih Data',semua = null, a, parent) {
    var select = $('#' + select1);
    select.empty();
    $.get(url, function (data) {
        select.empty();
        if (data['status'] === 200) {
            select.append('<option value="" selected="selected" disabled>' + awal + '</option>');
            if (semua){
                select.append('<option value="all" selected="">'+semua+'</option>');
            }
            $.each(data['payload'], function (key, value) {
                if (a && a === value['id']) {
                    select.append('<option value="' + value['id'] + '" selected>' + value['name'] + '</option>')
                } else {
                    select.append('<option value="' + value['id'] + '">' + value['name'] + '</option>')
                }
            });
        }
        $('#' + select1).select2({
            tags: true,
            dropdownParent: parent
        });

    })
}

function saveData(title,text, form, url, resposeSuccess) {
    console.log(form)
    var form_data = new FormData($('#' + form)[0]);

    alertify.confirm(title, text, function () {
            $.ajax({
                type: "POST",
                data: form_data,
                url: url ?? window.location.pathname,
                async: true,
                processData: false,
                contentType: false,
                headers: {
                    'Accept': "application/json"
                },
                success: function (data, textStatus, xhr) {
                    console.log(data);

                    if (xhr.status === 200) {
                        if (resposeSuccess) {
                            alertify.notify('Berhasi',
                                'success', 5,
                                function () {
                                });
                            resposeSuccess()
                        } else {
                            window.location.reload()
                        }
                    } else {
                        alertify.notify('Gagal',
                            'danger', 5,
                            function () {
                            });
                    }
                },
                complete: function (xhr, textStatus) {
                    console.log(xhr.status);
                    console.log(textStatus);
                },
                error: function (error, xhr, textStatus) {
                    // console.log("LOG ERROR", error.responseJSON.errors);
                    // console.log("LOG ERROR", error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0]);
                    console.log(xhr.status);
                    console.log(textStatus);
                    console.log(error.responseJSON.errors);
                    alertify.notify(error.responseJSON.errors ? error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0] : error.responseJSON['message'], 'warning')
                }
            })
        },
        function () {

        })
}


function deleteData(text, form, url, resposeSuccess) {


    alertify.confirm('Delete Data', text, function () {
            $.ajax({
                type: "POST",
                data: form,
                url: url,
                async: true,
                // processData: false,
                // contentType: false,
                headers: {
                    'Accept': "application/json",
                    // 'Content-Type': "application/json"
                },
                success: function (data, textStatus, xhr) {
                    console.log(data);
                    if (xhr.status === 200) {
                        if (resposeSuccess) {
                            alertify.notify('Berhasi',
                                'success', 5,
                                function () {
                                });
                            resposeSuccess()
                        } else {
                            window.location.reload()
                        }
                    } else {
                        alertify.notify('Gagal',
                            'danger', 5,
                            function () {
                            });
                    }
                },
                complete: function (xhr, textStatus) {
                    console.log(xhr.status);
                    console.log(textStatus);
                },
                error: function (error, xhr, textStatus) {
                    // console.log("LOG ERROR", error.responseJSON.errors);
                    // console.log("LOG ERROR", error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0]);
                    console.log(xhr.status);
                    console.log(textStatus);
                    console.log(error.responseJSON);
                    alertify.notify(error.responseJSON.errors ? error.responseJSON.errors[Object.keys(error.responseJSON.errors)[0]][0] : error.responseJSON['message'], 'warning')
                }
            })
        },
        function () {

        })
}
