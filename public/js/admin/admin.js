function confirmDelete(
  deleteOK = function () {},
  deleteError = function () {}
) {
  Swal.fire({
    title: "Kamu Yakin?",
    text: "Menghapus data ini tidak bisa dikembalikan lagi!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ya, Hapus",
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire("Data Dihapus!", "Data Telah Terhapus.", "success");
      deleteOK();
    } else {
      deleteError();
    }
  });
}

function confirmSave(title, text, form, url, resposeSuccess) {
  var form_data = new FormData($("#" + form)[0]);

  Swal.fire({
    title: title,
    text: text,
    icon: "info",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ya",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        data: form_data,
        url: url ?? window.location.pathname,
        async: true,
        processData: false,
        contentType: false,
        headers: {
          Accept: "application/json",
        },
        success: function (data, textStatus, xhr) {
          console.log(data);

          if (xhr.status === 200) {
            if (resposeSuccess) {
              Swal.fire({
                icon: "success",
                title: "Data berhasil disimpan",
                showConfirmButton: false,
                timer: 1500,
              });
              resposeSuccess();
            } else {
              window.location.reload();
            }
          } else {
            alertify.notify("Gagal", "danger", 5, function () {});
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
          console.log(
            "warning",
            error.responseJSON.errors
              ? error.responseJSON.errors[
                  Object.keys(error.responseJSON.errors)[0]
                ][0]
              : error.responseJSON["message"],
            "warning"
          );
          Swal.fire(
            "warning",
            error.responseJSON.errors
              ? error.responseJSON.errors[
                  Object.keys(error.responseJSON.errors)[0]
                ][0]
              : error.responseJSON["message"],
            "warning"
          );
        },
      });
    } else {
      deleteError();
    }
  });
}

function format(input) {
  var nStr = input.value + "";
  nStr = nStr.replace(/\,/g, "");
  x = nStr.split(".");
  x1 = x[0];
  x2 = x.length > 1 ? "." + x[1] : "";
  var rgx = /(\d+)(\d{3})/;
  while (rgx.test(x1)) {
    x1 = x1.replace(rgx, "$1" + "," + "$2");
  }
  input.value = x1 + x2;
}

function formattotal(input) {
  var nStr = input + "";
  nStr = nStr.replace(/\,/g, "");

  x = nStr.split(".");
  x1 = x[0];
  x2 = x.length > 1 ? "." + x[1] : "";
  var rgx = /(\d+)(\d{3})/;
  while (rgx.test(x1)) {
    x1 = x1.replace(rgx, "$1" + "," + "$2");
  }
  input = x1 + x2;
  return input;
}
