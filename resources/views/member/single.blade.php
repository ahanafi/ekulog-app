@extends('layouts.master')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">
						Data
					</div>
				</div>
				<div class="panel-body">
					<table class="table">
						<tr>
							<td>Nama</td>
							<td>:</td>
							<td>{{ $member->nama }}</td>
						</tr>
						<tr>
							<td>Jenis Kelamin</td>
							<td>:</td>
							<td>{{ ($member->jk == 'L') ? 'Laki-laki' : 'Perempuan' }}</td>
						</tr>
						<tr>
							<td>Kwalitas</td>
							<td>:</td>
							<td>{{ $member->kw }}</td>
						</tr>
						<tr>
							<td>Status</td>
							<td>:</td>
							<td>{{ $detail->status }}</td>
						</tr>
						<tr>
							<td>Pekerjaan</td>
							<td>:</td>
							<td>{{ $detail->pekerjaan }}</td>
						</tr>
						<tr>
							<td>Gaji/Pendapatan</td>
							<td>:</td>
							<td>{{ "Rp".number_format($detail->gaji) }}</td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td>:</td>
							<td>{{ ucwords(strtolower($detail->desa.", ".$detail->kecamatan.", ".$detail->kab_kota." ".$detail->provinsi)) }}</td>
						</tr>
					</table>
						<a href="/member/{{ $member->id }}/edit" class="btn btn-success"><i class="fa fa-pencil"></i>  Edit</a>
						<a href="/member" class="btn btn-default"><i class="fa fa-undo"></i>  Kembali</a>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">
						Avatar
					</div>
				</div>
				<div class="panel-body">
					@if ($member->jk == 'L')
						<img src="/images/man.png" alt="" class="img img-responsive">
					@else
						<img src="/images/woman.png" alt="" class="img img-responsive">
					@endif
				</div>
			</div>
		</div>
	</div>
</div>

@endsection