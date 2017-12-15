@extends('layouts.master')

@section('content')

	<div class="container">
		<div class="row">
			@if (session()->has('flash_notification.message'))
				<div class="alert alert-{{ session()->get('flash_notification.level') }}">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					{!! session()->get('flash_notification.message') !!}
				</div>
			@endif
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">
						Data Bulan Hijriah
					</div>
				</div>
				<div class="panel-body">
					<table class="table table-bordered table-hover table-responsive" id="bulan">
						<thead>
							<tr class="info">
								<th class="center">No.</th>
								<th>Nama Bulan</th>
								<th>tahun</th>
								<th>Keterangan</th>
								<th class="center">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@if (count($months) > 0)
								@foreach ($months as $month)
									<tr>
										<td class="center">{{ $no++ }}</td>
										<td>{{ $month->nama }}</td>
										<td>{{ $month->tahun }}</td>
										<td>{{ $month->keterangan }}</td>
										<td class="center">
											<form action="/month/{{ $month->id }}" method="post">
											<a href="/month/{{ $month->id }}/edit" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>
												{{ csrf_field() }}
												<input type="hidden" name="_method" value="DELETE">
												<button onclick="return ask()" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
											</form>
										</td>
									</tr>
								@endforeach
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="addMonth" tabindex="-1" role="dialog" aria-labelledby="addMonthLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="addMonthLabel">Tambah Bulan Baru</h4>
				</div>
				<form action="/month" class="form-group" method="POST">
				<div class="modal-body">
					{{ csrf_field() }}
					<label for="nama">Nama bulan</label>
					<input type="text" name="nama" class="form-control" required placeholder="Nama bulan hijriah">
					<br>

					<label for="tahun">Tahun</label>
					<input type="number" name="tahun" class="form-control" required placeholder="Tahun">
					<br>

					<label for="keterangan">Keterangan</label>
					<textarea name="keterangan" rows="3" class="form-control" placeholder="Keterangan"></textarea>
				
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
					<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
				</div>
				</form>
			</div>
		</div>
	</div>


@endsection