@extends('layouts.master')

@section('content')
	
	<div class="container">
		<div class="row">
			@if (session()->has('flash_notification.message'))
				<div class="alert alert-{{ session()->get('flash_notification.level') }}">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					{!! session()->get('flash_notification.message') !!}
				</div>
			@endif
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">
						Data Deposit
					</div>
				</div>
				<div class="panel-body">
					<table class="table table-responsive table-bordered table-hover" id="data-deposit">
						<thead>
							<tr class="info">
								<th class="center">No.</th>
								<th class="center">Nominal</th>
								<th class="center">Bulan</th>
								<th class="center">Tahun</th>
								<th class="center">Tanggal deposit</th>
								<th class="center">Penerima</th>
								<th class="center">Aksi</th>
							</tr>
						</thead>
						<tbody>
							@if (count($deposit) > 0)
								@foreach ($deposit as $dep)
									<tr>
										<td class="center">{{ $no++ }}</td>
										<td class="center">{{ "Rp".number_format($dep['nominal']) }}</td>
										<td class="center">{{ $dep->nama }}</td>
										<td class="center">{{ $dep->tahun }}</td>
										<td class="center">{{ $dep->tanggal }}</td>
										<td class="center">{{ $dep->setor_ke }}</td>
										<td class="center">
											<form action="/deposit/{{ $dep->id }}" method="POST">
												<a href="/deposit/{{ $dep->id }}/edit" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>
												{{ csrf_field() }}
												<input type="hidden" name="_method" value="DELETE">
												<button type="submit" name="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
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
	<div class="modal fade" id="addDeposit" tabindex="-1" role="dialog" aria-labelledby="addDepositLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="addDepositLabel">Deposit Baru</h4>
				</div>
				<form action="/deposit" class="form-group" method="post">
				<div class="modal-body">
					<div class="form-group{{ $errors->has('nominal') ? ' has-error' : '' }}">
						<label for="nominal">Nominal</label>
						<input type="number" name="nominal" class="form-control" placeholder="Nominal" required value="{{ old('nominal') }}">

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
						<div class="col-md-6">
							<div class="form-group{{ $errors->has('tanggal') ? ' has-error' : '' }}">
								<label for="tanggal">Tanggal</label>
								<input type="text" name="tanggal" class="form-control datepicker" style="padding: 10px 15px;" placeholder="Tanggal Deposit">

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
							<option value="B">B</option>
							<option value="C">C</option>
						</select>

                        @if ($errors->has('penerima'))
                            <span class="help-block">
                                <strong>{{ $errors->first('penerima') }}</strong>
                            </span>
                        @endif
					</div>

					<div class="form-group{{ $errors->has('keterangan') ? ' has-error' : '' }}">
						<label for="keterangan">Keterangan</label>
						<textarea style="resize: none;" name="keterangan" rows="2" class="form-control">{{ old('keterangan') }}</textarea>

                        @if ($errors->has('keterangan'))
                            <span class="help-block">
                                <strong>{{ $errors->first('keterangan') }}</strong>
                            </span>
                        @endif
					</div>

					{{ csrf_field() }}
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
					<input type="submit" name="submit" class="btn btn-success" value="Simpan">
				</div>
				</form>
			</div>
		</div>
	</div>

@endsection
@section('script')
	
	<script type="text/javascript">
		$(function(){
			var btnAddDeposit = "<a href='#' style='margin-left:10px;' class='btn btn-sm btn-primary' data-toggle='modal' data-target='#addDeposit'>Deposit Baru</a>";
			$("#data-deposit_length").append(btnAddDeposit);
		});
	</script>

@endsection