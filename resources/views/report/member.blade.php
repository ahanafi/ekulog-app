@extends('layouts.master')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-title">
							Rekap Data Member
						</div>
					</div>
					<div class="panel-body">
						<table class="table table-bordered">
							<thead>
								<tr class="info">
									<th class="center">Kwalitas</th>
									<th class="center">Laki-laki</th>
									<th class="center">Perempuan</th>
									<th class="center">Total</th>
								</tr>
							</thead>
							<tbody>
								@for ($i = 1; $i <= 3; $i++)
									<tr>
										<td class="center">{{ 'M'.$i }}</td>
										<td class="center">{{ $L[$i] }}</td>
										<td class="center">{{ $P[$i] }}</td>
										<td class="center">{{ $L[$i]+$P[$i] }}</td>
									</tr>
								@endfor
									<tr class="active">
										<td class="center" colspan="1"><strong>TOTAL</strong></td>
										<td class="center"><strong>{{ $total_L }}</strong></td>
										<td class="center"><strong>{{ $total_P }}</strong></td>
										<td class="center"><strong>{{ $total_L+$total_P }}</strong></td>
									</tr>
							</tbody>
						</table>
						<div class="row"></div>
						<a href="" class="btn btn-info">Daftar Member</a>
						<a href="" class="btn btn-success">Tambah Member</a>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection