@extends('layouts.master')

@section('content')

	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">
						Laporan Deposit per bulan <strong> {{ $bulan->nama." ".$tahun }} </strong>
					</div>
				</div>
				<div class="panel-body">
					<table class="table table-bordered table-hover table-striped table-responsive">
						<thead>
							<tr class="info">
								<th class="center">No.</th>
								<th>Bulan</th>
								<th class="center">Tanggal setor</th>
								<th class="center">Penerima</th>
								<th class="center">Keterangan</th>
								<th class="center">Nominal</th>
							</tr>
						</thead>
						<tbody>
							@if (count($deposit) > 0)
								@foreach ($deposit as $dep)
									<tr>
										<td class="center">{{ $no++ }}</td>
										<td>{{ $bulan->nama }}</td>
										<td class="center">{{ $dep->tanggal }}</td>
										<td class="center">{{ $dep->setor_ke }}</td>
										<td class="center">{{ $dep->keterangan }}</td>
										<td class="center">{{ "Rp.".number_format($dep->nominal) }}</td>
									</tr>
								@endforeach
									<tr class="active">
										<td class="center" colspan="5"><strong>TOTAL</strong></td>
										<td class="center"><strong>{{ "Rp".number_format($total) }}</strong></td>
									</tr>
							@else
								<tr>
									<td class="center" colspan="6">
										<strong>Belum ada setoran di bulan {{ $bulan->nama }}</strong>
									</td>
								</tr>
							@endif
						</tbody>
					</table>
					<div class="row"></div>
					<a href="/report/deposit" class="btn btn-primary">Kembali</a>
					<a href="/deposit/create" class="btn btn-success">Tambah Deposit</a>
				</div>
			</div>
		</div>
	</div>

@endsection