@extends('layouts.master')

@section('content')

	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">
						Edit Data Bulan
					</div>
				</div>
				<div class="panel-body">
					<div class="row">
						<form action="/month/{{ $month->id }}" method="post" class="form-group">
						<div class="col-md-6">
							{{ csrf_field() }}
							<label for="nama">Nama Bulan</label>
							<input type="text" name="nama" class="form-control" placeholder="Nama bulan hijriah" required value="{{ $month->nama }}">
							<br>

							<label for="tahun">Tahun</label>
							<input type="number" name="tahun" class="form-control" placeholder="Tahun hijriah" required value="{{ $month->tahun }}">
						</div>
						<div class="col-md-6">
							<label for="keterangan">Keterangan</label>
							<textarea name="keterangan" rows="2" class="form-control">{{ $month->keterangan }}</textarea>
							<br>

							<input type="hidden" name="_method" class="form-control" value="PUT">

							<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
							<a href="/month" class="btn btn-default">Kembali</a>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection