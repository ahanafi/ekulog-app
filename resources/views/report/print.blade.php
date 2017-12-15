<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link href="/css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/dataTables.bootstrap.min.css">

    <!-- Shortcut icon -->
    <link rel="shortcut icon" href="/images/icons.png">
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body style="background: #1E4E7E !important;">
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">Rekap berdasarkan Kwalitas</div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered table-responsive">
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
                                            <td class="center"> {{ "M".$i }}</td>
                                            <td class="center">{{ $Kw_lk[$i] }}</td>
                                            <td class="center">{{ $Kw_pr[$i] }}</td>
                                            <td class="center">{{ $Kw_pr[$i]+$Kw_lk[$i] }}</td>
                                        </tr>
                                    @endfor
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
                            <div class="panel-title">
                                Daftar Transaksi Member
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Member</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Kw</th>
                                        <th>Setoran 1</th>
                                        <th>Setoran 2</th>
                                        <th>Setoran 3</th>
                                        <th>KSU</th>
                                        <th>Tgl. Hijr.</th>
                                        <th>Tgl. Msh.</th>
                                        <th>Mgg ke.</th>
                                        <th>Kw. tg</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($transactions) > 0)
                                        @foreach ($transactions as $trx)
                                            <tr>
                                                <td class="center">{{ $no++ }}</td>
                                                <td>{{ ucwords(strtolower($trx->nama)) }}</td>
                                                <td class="center">{{ $trx->jk }}</td>
                                                <td class="center">{{ $trx->kw }}</td>
                                                <td class="center">{{ "Rp".number_format($trx->setoran_pertama) }}</td>
                                                <td class="center">{{ "Rp".number_format($trx->setoran_kedua) }}</td>
                                                <td class="center">{{ "Rp".number_format($trx->setoran_ketiga) }}</td>
                                                <td class="center">{{ "Rp".number_format($trx->ksu) }}</td>
                                                <td class="center">{{ $trx->tgl_hijriah }}</td>
                                                <td class="center">{{ $trx->tgl_masehi }}</td>
                                                <td class="center">{{ $trx->minggu_ke }}</td>
                                                <td class="center">{{ $trx->kualitas_tg }}</td>
                                                <td class="center">{{ ($trx->nominal == 1) ? "Lunas" : "Blm. lunas" }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/app.js"></script>
    <script src="/js/jquery.dataTables.min.js"></script>
    <script src="/js/dataTables.bootstrap.min.js"></script>
</body>
</html>