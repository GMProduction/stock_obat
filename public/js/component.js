
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

async function getSelect(id, url, nameValue = 'name', idValue, text = null, tags= false, count = null, parent) {
    var select = $('#' + id);
    select.empty();
    if (text) {
        select.append('<option value="" selected>' + text + '</option>')
    } else {
        select.append('<option value="" disabled selected>Pilih Data</option>')
    }
    await $.get(url, function (data) {
        if (count){
            $(count).html(data.length)
        }
        $.each(data, function (key, value) {
            let val = value['value'] ?? '';
            if (idValue == value['id']) {
                select.append('<option value="' + value['id'] + '" data-value="' + val.toString() + '" selected>' + value[nameValue] + '</option>')
            } else {
                select.append('<option value="' + value['id'] + '" data-value="' + val.toString() + '">' + value[nameValue] + '</option>')
            }
        })
    })
    select.select2({
        tags : tags,
        dropdownParent: parent
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
