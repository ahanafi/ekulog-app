@extends('layouts.master')

@section('content')
	
	<div class="container">
		<div class="row">
			@if (session()->has('flash_notification.message'))
				<div class="col-md-12">
					<div class="alert alert-{{ session()->get('flash_notification.level') }}">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{!! session()->get('flash_notification.message') !!}
					</div>
				</div>
			@endif
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">
						Edit Data Deposit
					</div>
				</div>
				<div class="panel-body">
					<form action="/deposit/{{ $deposit->id }}" class="form-group" method="post">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group{{ $errors->has('nominal') ? ' has-error' : '' }}">
									<label for="nominal">Nominal</label>
									<input type="number" name="nominal" class="form-control" placeholder="Nominal" required value="{{ $deposit->nominal }}">

			                        @if ($errors->has('nominal'))
			                            <span class="help-block">
			                                <strong>{{ $errors->first('nominal') }}</strong>
			                            </span>
			                        @endif
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group{{ $errors->has('bulan') ? ' has-error' : '' }}">
											<label for="bulan">Bulan</label>
											<select name="bulan" class="form-control">
												<option value="">-- Pilih Bulan --</option>
												@if (count($bulan) > 0)
													@foreach ($bulan as $bln)
														@if ($bln->id == $deposit->month_id)
															<option value="{{ $bln->id }}" selected>{{ $bln->nama }}</option>
														@else
															<option value="{{ $bln->id }}">{{ $bln->nama }}</option>
														@endif
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
									<div class="col-md-6">
										<div class="form-group{{ $errors->has('tanggal') ? ' has-error' : '' }}">
											<label for="tanggal">Tanggal</label>
											<input type="text" name="tanggal" class="form-control datepicker" style="padding: 10px 15px;" placeholder="Tanggal Deposit" value="{{ str_replace("-", "/", $deposit->tanggal) }}">

					                        @if ($errors->has('tanggal'))
					                            <span class="help-block">
					                                <strong>{{ $errors->first('tanggal') }}</strong>
					                            </span>
					                        @endif
										</div>
									</div>
								</div>

								<div class="form-group{{ $errors->has('penerima') ? ' has-error' : '' }}">
									<label for="penerima">Penerima</label>
									<select name="penerima" class="form-control">
										<option value="">-- Pilih Penerima --</option>
										@if ($deposit->setor_ke == "B")
											<option value="B" selected>B</option>
											<option value="C">C</option>
										@else
											<option value="B">B</option>
											<option value="C" selected>C</option>
										@endif
									</select>

			                        @if ($errors->has('penerima'))
			                            <span class="help-block">
			                                <strong>{{ $errors->first('penerima') }}</strong>
			                            </span>
			                        @endif
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group{{ $errors->has('keterangan') ? ' has-error' : '' }}">
									<label for="keterangan">Keterangan</label>
									<textarea style="resize: none;" name="keterangan" rows="2" class="form-control">{{ $deposit->keterangan }}</textarea>

			                        @if ($errors->has('keterangan'))
			                            <span class="help-block">
			                                <strong>{{ $errors->first('keterangan') }}</strong>
			                            </span>
			                        @endif
								</div>
		

								<div class="row" style="margin-top: 15px;">
									{{ csrf_field() }}
									<input type="hidden" name="_method" value="PUT">
									<div class="col-md-6"><button type="submit" class="btn btn-primary btn-block">Simpan</a></div>
									<div class="col-md-6"><a href="/deposit" class="btn btn-default btn-block">Kembali</a></div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
@endsection