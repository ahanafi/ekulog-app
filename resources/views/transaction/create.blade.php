@extends('layouts.master')

@section('content')

	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">Tambah Transaksi</div>
				</div>
				<div class="panel-body">
					<form action="/transaction" method="POST" class="form">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group{{ $errors->has('member_id') ? ' has-error' : '' }}">
									<label for="member">Member</label>
									<select name="member_id" class="form-control">
										<option value="">-- Pilih Member --</option>
										@if (count($members) > 0)
											@foreach ($members as $member)
												<option value="{{ $member->id }}">{{ $member->nama }}</option>
											@endforeach
										@endif
									</select>

	                                @if ($errors->has('member_id'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('member_id') }}</strong>
	                                    </span>
	                                @endif
								</div>

								<div class="row">
									<div class="col-md-4">
			                        	<div class="form-group{{ $errors->has('setoran_1') ? ' has-error' : '' }}">
			                            <label for="setoran_1">Setoran 1</label>
		                                <input type="number" class="form-control" name="setoran_1" value="{{ old('setoran_1') }}" required placeholder="Setoran 1">

		                                @if ($errors->has('setoran_1'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('setoran_1') }}</strong>
		                                    </span>
		                                @endif
			                        	</div>
			                        </div>
									<div class="col-md-4">
			                        	<div class="form-group{{ $errors->has('setoran_2') ? ' has-error' : '' }}">
			                            <label for="setoran_2">Setoran 2</label>
		                                <input type="number" class="form-control" name="setoran_2" value="{{ old('setoran_2') }}" placeholder="Setoran 2">

		                                @if ($errors->has('setoran_2'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('setoran_2') }}</strong>
		                                    </span>
		                                @endif
			                        	</div>
			                        </div>
									<div class="col-md-4">
			                        	<div class="form-group{{ $errors->has('setoran_3') ? ' has-error' : '' }}">
			                            <label for="setoran_3">Setoran 3</label>
		                                <input type="number" class="form-control" name="setoran_3" value="{{ old('setoran_3') }}" placeholder="Setoran 3">

		                                @if ($errors->has('setoran_3'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('setoran_3') }}</strong>
		                                    </span>
		                                @endif
			                        	</div>
			                        </div>
			                    </div>

		                        <div class="form-group{{ $errors->has('ksu') ? ' has-error' : '' }}">
		                            <label for="ksu">KSU</label>
	                                <input type="number" class="form-control" name="ksu" value="{{ old('ksu') }}" placeholder="KSU">

	                                @if ($errors->has('ksu'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('ksu') }}</strong>
	                                    </span>
	                                @endif
		                        </div>
							</div> <!-- end of class col-md-6 -->
							<div class="col-md-6">

		                        <div class="form-group{{ $errors->has('tgl_hijriah') ? ' has-error' : '' }}">
		                            <label for="tgl_hijriah">Tanggal</label>
	                                <select name="tgl_hijriah" class="form-control">
	                                	<option value="">-- Pilih Tanggal --</option>
	                                	@for ($i = 1; $i <=30 ; $i++)
	                                		<option value="{{ $i }}">{{ $i }}</option>
	                                	@endfor
	                                </select>

	                                @if ($errors->has('tgl_hijriah'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('tgl_hijriah') }}</strong>
	                                    </span>
	                                @endif
		                        </div>

		                        <div class="form-group{{ $errors->has('nominal') ? ' has-error' : '' }}">
		                            <label for="nominal">Status Pelunasan</label>
	                                <select name="nominal" class="form-control">
	                                	<option value="">-- Pilih Status --</option>
	                                	<option value="1">Ya</option>
	                                	<option value="0">Tidak</option>
	                                </select>

	                                @if ($errors->has('nominal'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('nominal') }}</strong>
	                                    </span>
	                                @endif
		                        </div>

		                        {{ csrf_field() }}

		                        <div class="row" style="margin-top: 40px;">
		                        	<div class="col-md-6">
		                        		<input type="submit" class="btn btn-primary btn-block" name="submit" value="Simpan">
		                        	</div>
		                        	<div class="col-md-6">
		                        		<a href="/transaction" class="btn btn-default btn-block">Kembali</a>
		                        	</div>
		                        </div>
							</div> <!-- end of class col-md-6 -->
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

@endsection