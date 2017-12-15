@extends('layouts.master')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				@if (session()->has('flash_notification.message'))
					<div class="alert alert-{{ session()->get('flash_notification.level') }}">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{!! session()->get('flash_notification.message') !!}
					</div>
				@endif
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-title">
							Konfigurasi Aplikasi
						</div>
					</div>
					<div class="panel-body">
						<table class="table table-bordered">
							<tr>
								<td>Bulan</td>
								<td>:</td>
								<td>{{ $config->nama }}</td>
							</tr>
							<tr>
								<td>Tahun</td>
								<td>:</td>
								<td>{{ $config->tahun }}</td>
							</tr>
						</table>
						<div class="center">
							<button type="button" data-toggle="modal" data-target="#configForm" class="btn btn-success">Edit Konfigurasi</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="configForm" tabindex="-1" role="dialog" aria-labelledby="configFormLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="configFormLabel">Edit Konfigurasi</h4>
				</div>
				<form action="/config" class="form-group" method="post">
				<div class="modal-body">
					{{ csrf_field() }}
					<label for="nama">Pilih bulan</label>
					<select name="month_id" class="form-control">
						<option value="">-- Pilih Bulan --</option>
						@if (count($months) > 0)
							@foreach ($months as $month)
								@if ($month->id == $config->month_id)
									<option value="{{ $month->id }}" selected>{{ $month->nama }}</option>
								@else
									<option value="{{ $month->id }}">{{ $month->nama }}</option>
								@endif
							@endforeach
						@endif
					</select>
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