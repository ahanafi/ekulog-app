@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">DASHBOARD</div>
                </div>
                <div class="panel-body">
                    <blockquote>
                        <p>
                            <em>"Berangkatlah kamu baik dalam keadaan rasa ringan maupun berat, dan berjihadlah dengan harta dan jiwamu di jalan Allah. Yang demikian itu lebih baik bagimu jika kamu mengetahui".</em> <strong>(Q.S.At-Taubah : 41)</strong>
                        </p>
                    </blockquote>
                </div>
            </div>
            <div class="panel panel-primary" style="margin-top: 25px;">
                <div class="panel-heading">
                    <div class="panel-title">QUICK SHORTCUT</div>
                </div>
                <div class="panel-body">
                    <div class="widget">
                        <a href="/member"><i class="fa fa-users"></i><span>Member</span></a>
                        <a href="/transaction"><i class="fa fa-retweet"></i><span>Transaksi</span></a>
                        <a href="/deposit"><i class="fa fa-bank"></i><span>Deposit</span></a>
                        <a href="/report"><i class="fa fa-book"></i><span>Laporan</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-info center">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong>{{ strtoupper($nowaday) }}</strong>
                    </div>
                </div>
                <div class="panel-body">
                    <span class="date">
                        {{ date('d') }}
                    </span>
                </div>
                <div class="panel-footer">
                    {{ $month." ".date('Y') }}
                </div>
            </div>
            <div class="panel panel-success center">
                <div class="panel-heading">
                    <div class="panel-title">JAM</div>
                </div>
                <div class="panel-body">
                    <span class="time"></span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function(){
            var Interval = setInterval(function(){
                var now = moment();
                $(".time").html(now.format('hh:mm:ss A'));
            });
        });
    </script>
@endsection