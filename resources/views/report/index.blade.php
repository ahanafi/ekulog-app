@extends('layouts.master')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-title">Laporan berdasarkan Kwalitas Member</div>
					</div>
					<div class="panel-body">
						<table class="table table-hover table-bordered table-responsive">
							<thead>
								<tr class="info">
									<th class="center">Kwalitas</th>
									<th class="center">Laki-Laki</th>
									<th class="center">Perempuan</th>
									<th class="center">Total</th>
								</tr>
							</thead>
							<tbody>
								@if (count($Kw_pr) > 0 && count($Kw_lk) > 0)
									@for ($i = 1; $i <= count($Kw_pr) ; $i++)
										<tr>
											<td class="center">M{{ $i }}</td>
											<td class="center"> {{ $Kw_lk[$i] }}</td>
											<td class="center"> {{ $Kw_pr[$i] }}</td>
											<td class="center">{{ $Kw_pr[$i]+$Kw_lk[$i] }}</td>
										</tr>
									@endfor
								@endif
								<tr class="active">
									<td colspan="3" class="center"><strong>TOTAL</strong></td>
									<td class="center"><strong>{{ $total }}</strong></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-title">Laporan berdasarkan Setoran</div>
					</div>
					<div class="panel-body">
						<table class="table table-bordered table-hover table-responsive">
							<thead>
								<tr class="success">
									<th class="center">No.</th>
									<th class="center">Jenis Setoran</th>
									<th class="center">Jumlah</th>
								</tr>								
							</thead>
							<tbody>
								@for ($i = 1; $i <= 3; $i++)
									<tr>
										<td class="center">{{$i}}</td>
										<td class="center">Setoran {{ $i }}</td>
										<td class="center">{{ "Rp".number_format($setoran[$i]) }}</td>
									</tr>
								@endfor
									<tr class="active">
										<td class="center" colspan="2"><strong>TOTAL</strong></td>
										<td class="center"><strong>{{ "Rp".number_format($total_setoran) }}</strong></td>
									</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-title">Master Laporan</div>
					</div>
					<div class="panel-body">
						<fieldset>
							<legend>Cetak Laporan</legend>
							<form action="/report/print" method="post">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group{{ $errors->has('tanggal_awal') ? ' has-error' : '' }}">
											<label for="tanggal_awal">Tanggal awal</label>
											<select name="tanggal_awal" class="form-control">
												<option value="">-- Pilih Tanggal Awal --</option>
												@for ($i = 1; $i <= 30; $i++)
													<option value="{{ $i }}">{{ $i }}</option>
												@endfor
											</select>

			                                @if ($errors->has('tanggal_awal'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('tanggal_awal') }}</strong>
			                                    </span>
			                                @endif
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group{{ $errors->has('bulan') ? ' has-error' : '' }}">
											<label for="bulan">Bulan</label>
											<select name="bulan" class="form-control">
												<option value="">-- Pilih Bulan --</option>
												@if (count($months) > 0)
													@foreach ($months as $month)
														<option value="{{ $month->id }}">{{ $month->nama }}</option>
													@endforeach
												@endif
											</select>

			                                @if ($errors->has('bulan'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('bulan') }}</strong>
			                                    </span>
			                                @endif
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group{{ $errors->has('tanggal_akhir') ? ' has-error' : '' }}">
											<label for="tanggal_akhir">Tanggal Akhir</label>
											<select name="tanggal_akhir" class="form-control">
												<option value="">-- Pilih Tanggal Akhir --</option>
												@for ($i = 1; $i <= 30; $i++)
													<option value="{{ $i }}">{{ $i }}</option>
												@endfor
											</select>

			                                @if ($errors->has('tanggal_akhir'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('tanggal_akhir') }}</strong>
			                                    </span>
			                                @endif
										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group">
											<label for="submit">  &nbsp; </label>
											{{ csrf_field() }}
											<button type="submit" name="post" class="btn btn-success btn-block"><i class="fa fa-print"></i> Cetak</button>
										</div>
									</div>
								</div>
							</form>
						</fieldset>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection