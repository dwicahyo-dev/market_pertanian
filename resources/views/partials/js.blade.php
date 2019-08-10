<script src="{{ asset('js/app.js') }}"></script>


<!-- General JS Scripts -->
{{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script> --}}


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

<!-- Template JS File -->
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

<!-- JS Libraies -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.33.1/dist/sweetalert2.all.min.js"></script>
<script src="{{ asset('assets/dist/summernote/dist/summernote-bs4.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

<script src="{{ asset('assets/dist/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/dist/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('assets/dist/chart.js/dist/Chart.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/id.js"></script>
<script src="{{ asset('assets/js/jquery.mask.min.js') }}"></script>
<script src="{{ asset('assets/dist/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>
<script src="{{ asset('assets/js/page/bootstrap-modal.js') }}"></script>

{{-- <script src="{{  asset('assets/js/page/modules-chartjs.js') }}"></script> --}}
{{-- <script src="{{  asset('assets/js/page/index-0.js') }}"></script> --}}

<script>
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#img-upload').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $(document).on('change', '.btn-file :file', function() {
    var input = $(this),
    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [label]);
  });

  $('.btn-file :file').on('fileselect', function(event, label) {

    var input = $(this).parents('.input-group').find(':text'),
    log = label;

    if( input.length ) {
      input.val(log);
    } else {
      if( log ) alert(log);
    }

  });

  $("#imgInp").change(function(){
    readURL(this);
  });

  function cancelTransaction(order_id) { 
		let url = $("#btnCancel").attr("url");
        // axios.post(`${url}${order_id}`).then(result => {
        //     console.log(result);
        // });
    }

  function deleteData(id){
		let url = $("#btnDelete").attr("model");

    Swal({
			title: 'Apakah Anda Yakin?',
			text: "Ingin Menghapus Data Ini?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Hapus Saja!'
		}).then( result => {
			if (result.value) {
				axios.delete(`${url}/${id}`)
				.then( response => {
					Swal('Terhapus!', `${response.data.message}`,'success')
					.then(() => {
						location.reload();
					})
				})
				.catch( error => {
					console.log(error);
					Swal({
						type: 'error',
						title: 'Oops...',
						text: 'Gagal Menghapus Data',
					})
				});
			}
		});
  }
</script>