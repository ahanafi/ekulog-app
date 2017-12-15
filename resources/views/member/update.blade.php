@extends('layouts.master')

@section('content')
	
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">Edit Data Member</div>
				</div>
				<div class="panel-body">
					<form action="/member/{{ $member->id }}" method="POST">
						<div class="row">
							<div class="col-md-6">

								<div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
			                        <label for="email">Nama</label>

		                            <input type="text" class="form-control" name="nama" value="{{ $member->nama }}" required>

	                                @if ($errors->has('nama'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('nama') }}</strong>
	                                    </span>
	                                @endif
			                    </div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group{{ $errors->has('jk') ? ' has-error' : '' }}">
					                        <label for="jk">Jeni Kelamin</label>

				                            <select name="jk" class="form-control">
				                            	<option value="">-- Pilih Jenis Kelamin --</option>
				                            	@if ($member->jk == 'L')
				                            		<option value="L" selected>Laki-Laki</option>
				                            		<option value="P">Perempuan</option>
				                            	@else
				                            		<option value="L">Laki-Laki</option>
				                            		<option value="P" selected>Perempuan</option>
				                            	@endif
				                            </select>

			                                @if ($errors->has('jk'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('jk') }}</strong>
			                                    </span>
			                                @endif
					                    </div>
									</div>

									<div class="col-md-6">
										<div class="form-group{{ $errors->has('kw') ? ' has-error' : '' }}">
					                        <label for="email">Kwalitas</label>

				                            <select name="kw" class="form-control">
				                            	<option value="">-- Pilih Kwalitas</option>
				                            	@if ($member->kw == "M1")
				                            		<option value="M1" selected>M1</option>
				                            		<option value="M2">M2</option>
				                            		<option value="M3">M3</option>
				                            	@elseif($member->kw == "M2")
				                            		<option value="M1">M1</option>
				                            		<option value="M2" selected>M2</option>
				                            		<option value="M3">M3</option>
				                            	@else
				                            		<option value="M1">M1</option>
				                            		<option value="M2">M2</option>
				                            		<option value="M3" selected>M3</option>
				                            	@endif
				                            </select>

			                                @if ($errors->has('email'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('email') }}</strong>
			                                    </span>
			                                @endif
					                    </div>
									</div>
								</div>

								<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
			                        <label for="status">Status</label>

		                            <select name="status" class="form-control">
		                            	<option value="">-- Pilih Status</option>
										@foreach ($status as $sts)
											@if ($sts->id == $member->status_id)
												<option value="{{ $sts->id }}" selected>{{ $sts->nama }}</option>
											@else
												<option value="{{ $sts->id }}">{{ $sts->nama }}</option>
											@endif
										@endforeach
		                            </select>

	                                @if ($errors->has('status'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('status') }}</strong>
	                                    </span>
	                                @endif
			                    </div>

								<div class="form-group{{ $errors->has('pekerjaan') ? ' has-error' : '' }}">
			                        <label for="pekerjaan">Pekerjaan</label>

		                            <select name="pekerjaan" class="form-control">
		                            	<option value="">-- Pilih Pekerjaan</option>
										@foreach ($jobs as $job)
											@if ($job->id == $member->jobs_id)
												<option value="{{ $job->id }}" selected>{{ $job->nama }}</option>
											@else
												<option value="{{ $job->id }}">{{ $job->nama }}</option>
											@endif
										@endforeach
		                            </select>

	                                @if ($errors->has('pekerjaan'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('pekerjaan') }}</strong>
	                                    </span>
	                                @endif
			                    </div>

								<div class="form-group{{ $errors->has('gaji') ? ' has-error' : '' }}">
			                        <label for="gaji">Pendapatan</label>
			                        <input type="number" name="gaji" class="form-control" value="{{ $member->gaji }}">

	                                @if ($errors->has('gaji'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('gaji') }}</strong>
	                                    </span>
	                                @endif
			                    </div>
							</div>
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group{{ $errors->has('desa') ? ' has-error' : '' }}">
					                        <label for="desa">Desa</label>
											<input type="text" name="desa" class="form-control" value="{{ $member->desa }}">

			                                @if ($errors->has('desa'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('desa') }}</strong>
			                                    </span>
			                                @endif
					                    </div>
									</div>
									<div class="col-md-6">
										<div class="form-group{{ $errors->has('kecamatan') ? ' has-error' : '' }}">
					                        <label for="kecamatan">Kecamatan</label>
											<input type="text" name="kecamatan" class="form-control" value="{{ $member->kecamatan }}">

			                                @if ($errors->has('kecamatan'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('kecamatan') }}</strong>
			                                    </span>
			                                @endif
					                    </div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group{{ $errors->has('kab_kota') ? ' has-error' : '' }}">
					                        <label for="kab_kota">Kabupate/Kota</label>
											<input type="text" name="kab_kota" class="form-control" value="{{ $member->kab_kota }}">

			                                @if ($errors->has('kab_kota'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('kab_kota') }}</strong>
			                                    </span>
			                                @endif
					                    </div>
									</div>
									<div class="col-md-6">
										<div class="form-group{{ $errors->has('provinsi') ? ' has-error' : '' }}">
					                        <label for="provinsi">Provinsi</label>
											<input type="text" name="provinsi" class="form-control" value="{{ $member->provinsi }}">

			                                @if ($errors->has('provinsi'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('provinsi') }}</strong>
			                                    </span>
			                                @endif
					                    </div>
									</div>
								</div>

								<div class="form-group{{ $errors->has('sales') ? ' has-error' : '' }}">
			                        <label for="sales">Sales</label>
									<input type="text" name="sales" class="form-control" value="{{ $member->sales }}" placeholder="Nama sales">

	                                @if ($errors->has('sales'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('sales') }}</strong>
	                                    </span>
	                                @endif
			                    </div>

								<div class="form-group{{ $errors->has('catatan') ? ' has-error' : '' }}">
			                        <label for="catatan">Catatan Lainnya</label>
									<textarea name="catatan" rows="3" class="form-control" style="resize: none;">{{ $member->catatan }}</textarea>

	                                @if ($errors->has('catatan'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('catatan') }}</strong>
	                                    </span>
	                                @endif
			                    </div>

			                    <div class="row">
			                    	{{ csrf_field() }}
			                    	<input type="hidden" name="_method" value="PUT">
			                    	<div class="col-md-6">
			                    		<input type="submit" name="submit" class="btn btn-primary btn-block" value="Simpan">
			                    	</div>
			                    	<div class="col-md-6">
			                    		<a href="/member" class="btn btn-default btn-block">Kembali</a>
			                    	</div>
			                    </div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

@endsection