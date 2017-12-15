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
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-title">
							Data Member
						</div>
					</div>
					<div class="panel-body">
						<table class="table table-bordered table-striped table-responsive" id="data">
							<thead>
								<tr class="info">
									<th class="center">No.</th>
									<th>Nama</th>
									<th class="center">KW</th>
									<th class="center">JK</th>
									<th class="center">Aksi</th>
								</tr>
							</thead>
							<tbody>
								@if (count($member) > 0)
									@foreach ($member as $mbr)
										<tr>
											<td class="center">{{ $no++  }}</td>
											<td>{{ ucwords(strtolower($mbr->nama)) }}</td>
											<td class="center">{{ $mbr['kw'] }}</td>
											<td class="center">{{ $mbr['jk'] }}</td>
											<td class="center">
												<a href="/member/{{ $mbr->id }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
												<a href="/member/{{ $mbr->id }}/edit" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>
												<a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></i></a>
											</td>
										</tr>
									@endforeach
								@else
									<tr>
										<td class="center" colspan="5">
											<a href="" class="btn btn-sm btn-success">Import Member</a>
										</td>
									</tr>
								@endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-title">
							Tambah Data Member
						</div>
					</div>
					<div class="panel-body">
						<form action="/member" method="POST">
							{{ csrf_field() }}
	                        
	                        <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                                <input id="nama" type="text" class="form-control" name="nama" value="{{ old('nama') }}" required placeholder="Nama member">

                                @if ($errors->has('nama'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                @endif
	                        </div>

	                        <div class="form-group{{ $errors->has('jk') ? ' has-error' : '' }}">
                                <select name="jk" class="form-control" required>
                                	<option value="">-- Pilih Jenis Kelamin --</option>
                                	<option value="L">Laki-laki</option>
                                	<option value="P">Perempuan</option>
                                </select>

                                @if ($errors->has('jk'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jk') }}</strong>
                                    </span>
                                @endif
	                        </div>

	                        <div class="form-group{{ $errors->has('kw') ? ' has-error' : '' }}">
                                <select name="kw" class="form-control" required>
                                	<option value="">-- Pilih Kwalitas --</option>
                                	<option value="M1">M1</option>
                                	<option value="M2">M2</option>
                                	<option value="M3">M3</option>
                                </select>

                                @if ($errors->has('kw'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kw') }}</strong>
                                    </span>
                                @endif
	                        </div>

	                        <div class="form-group{{ $errors->has('pekerjaan') ? ' has-error' : '' }}">
                                <select name="pekerjaan" class="form-control" required>
                                	<option value="">-- Pilih Pekerjaan --</option>
                                	<option value="Pelajar">Pelajar</option>
                                	<option value="Mahasiswa">Mahasiswa</option>
                                	<option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                                	<option value="Guru PNS">Guru PNS</option>
                                	<option value="Guru Non PNS">Guru Non PNS</option>
                                	<option value="PNS Non Guru">PNS Non Guru</option>
                                	<option value="Pengusaha">Pengusaha</option>
                                	<option value="Pedagang">Pedagang</option>
                                	<option value="Petani">Petani</option>
                                	<option value="Karyawan/Buruh">Karyawan/Buruh</option>
                                	<option value="Lainnya">Lainnya</option>
                                </select>

                                @if ($errors->has('pekerjaan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pekerjaan') }}</strong>
                                    </span>
                                @endif
	                        </div>

	                        <div class="form-group{{ $errors->has('gaji') ? ' has-error' : '' }}">
								<input type="number" name="gaji" class="form-control" value="{{ old('gaji') }}" placeholder="Gaji" required>

                                @if ($errors->has('gaji'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gaji') }}</strong>
                                    </span>
                                @endif
	                        </div>
				
	                        <div class="form-group{{ $errors->has('jk') ? ' has-error' : '' }}">
								<input type="submit" name="submit" class="btn btn-primary" value="Tambahkan">
	                        </div>


						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection