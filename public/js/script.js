$(document).ready(function(){
	$("#data").DataTable({'pageLength':5});
	$("#data-deposit").DataTable({'pageLength':5});
	$("#bulan").DataTable({'pageLength':5});
	$("#trx").DataTable({'pageLength':5});
	$(".datepicker").datepicker({format : 'yyyy/mm/dd', orientation : 'bottom'});

	$("#bulan_length").append("<button type='button' id='btn-add-month' style='margin-left:20px;' class='btn btn-sm btn-primary'>Tambah</button>");

	var btnAddTrx = "<a href='/transaction/create' style='margin-left:20px;' class='btn btn-sm btn-primary'>Tambah Transaksi</a>";
	$("#trx_length").append(btnAddTrx);
	$("#btn-add-month").on('click', function(){
		$("#addMonth").modal('show');
	});

});

function ask(){
	conf = confirm('Apakah Anda yakin akan menghapus data ini ?');
	if(conf == true) {
		return true;
	} else {
		return false;
	}

}