@extends('layouts.master')

@section('content')

	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">
						Laporan Deposit
					</div>
				</div>
				<div class="panel-body">
					<fieldset>
						<legend>Laporan per bulan</legend>
					</fieldset>
					<form action="/report/deposit/show" method="POST">
						<div class="row">
							<div class="col-md-5">
								<div class="form-group{{ $errors->has('bulan') ? ' has-error' : '' }}">
									<label for="bulan">Bulan</label>
									<select name="bulan" class="form-control">
										<option value="">-- Pilih Bulan --</option>
										@if (count($bulan) > 0)
											@foreach ($bulan as $bln)
												<option value="{{ $bln->id }}">{{ $bln->nama }}</option>
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
							<div class="col-md-5">
								<div class="form-group{{ $errors->has('tahun') ? ' has-error' : '' }}">
									<label for="tahun">Tahun</label>
									<select name="tahun" class="form-control">
										<option value="">-- Pilih Tahun --</option>
										<option value="1438">1438</option>
										<option value="1439">1439</option>
									</select>

	                                @if ($errors->has('tahun'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('tahun') }}</strong>
	                                    </span>
	                                @endif
								</div>
							</div>
							<div class="col-md-2">
								{{ csrf_field() }}
								<label for="submit"> &nbsp; </label>
								<button type="submit" class="btn btn-success btn-block">Tampilkan</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

@endsection