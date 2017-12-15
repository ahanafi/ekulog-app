@extends('layouts.master')

@section('content')

	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">
						Data Transaksi Member (Non Lunas)
					</div>
				</div>
				<div class="panel-body">
					<table class="table table-responsive table-bordered table-hover" id="trx">
						<thead>
							<tr>
								<th class="center">No.</th>
								<th>Nama member</th>
								<th class="center">Setoran 1</th>
								<th class="center">Setoran 2</th>
								<th class="center">KSU</th>
								<th class="center">Tgl (Hjr)</th>
								<th class="center">Minggu</th>
								<th class="center">Status Lunas</th>
								<th class="center">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@if (count($transactions) > 0)
								@foreach ($transactions as $trx)
									<tr>
										<td class="center">{{ $no++ }}</td>
										<td>{{ $trx->nama }}</td>
										<td class="center">{{ number_format($trx->setoran_pertama) }}</td>
										<td class="center">{{ number_format($trx->setoran_kedua) }}</td>
										<td class="center">{{ number_format($trx->ksu) }}</td>
										<td class="center">{{ $trx->tgl_hijriah }}</td>
										<td class="center">{{ $trx->minggu_ke }}</td>
										<td class="center">
											@if ($trx->nominal == 1)
												<i class="glyphicon glyphicon-ok"></i>
											@else
												<i class="glyphicon glyphicon-ban-circle"></i>
											@endif
										</td>
										<td class="center">
											<form action="/transaction/{{ $trx->id }}" method="POST">
												{{ csrf_field() }}
												<a href="/transaction/{{ $trx->id }}/edit" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>
												<input type="hidden" name="_method" value="DELETE">
												<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
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

@endsection

@section('script')
	
	<script type="text/javascript">
		$(function(){
			var btnTrxLunas = "<a href='/transaction' style='margin-left:5px;' class='btn btn-sm btn-success'>Semua Transaksi</a>";
			$("#trx_length").append(btnTrxLunas);
		});
	</script>

@endsection