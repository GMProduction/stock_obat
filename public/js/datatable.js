function datatable(tb, url, columns, createdRow = null, order = null) {
    $('#' + tb).DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        ajax: url,
        fnRowCallback: function (
            nRow,
            aData,
            iDisplayIndex,
            iDisplayIndexFull
        ) {
            // debugger;
            var numStart = this.fnPagingInfo().iStart;
            var index = numStart + iDisplayIndexFull + 1;
            // var index = iDisplayIndexFull + 1;
            $("td:first", nRow).html(index);
            return nRow;
        },
        order: order,
        createdRow: createdRow,
        columns: columns
    }).columns.adjust()
        .responsive.recalc();
}
