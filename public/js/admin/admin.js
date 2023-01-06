function confirmDelete(deleteOK = function(){}, deleteError = function(){}) {
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
