const success = $('.flash-data-success').data('flashdata');
const error = $('.flash-data-error').data('flashdata');

if (success) {
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: success,
        showConfirmButton: false,
        timer: 1500
      })
}

if (error) {
    Swal.fire({
        icon: 'error',
        title: error,
        text: '',
      })
}

$('.btn-delete').on('click', function (e){

    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Data ini akan terhapus dan tidak dapat dikembalikan lagi",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin',
        cancelButtonText: 'Tidak'
      }).then((result) => {
        if (result.isConfirmed) {
          document.location.href = href;
        }
      })


})