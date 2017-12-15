<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Transaction;
use App\Models\Month;
use App\Models\Deposit;
use App\Models\Config;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $config = Config::find(1);

        for ($i=1; $i <= 3; $i++) { 
            $L[$i] = self::getKwalitas('M'.$i, 'L', $config->month_id);
            $P[$i] = self::getKwalitas('M'.$i, 'P', $config->month_id);

            $setoran[$i] = self::getSetoran($i, $config->month_id);
        }

        $months = Month::all();

        return view('report.index', [
            'months'        => $months,
            'Kw_lk'         => $L,
            'Kw_pr'         => $P,
            'total'         => self::getTotal($config->month_id),
            'setoran'       => $setoran,
            'ksu'           => self::getSetoran('ksu', $config->month_id),
            'total_setoran' => self::getSetoran('total', $config->month_id)
        ]);
    }

    public function deposit()
    {
        $month = Month::all();
        return view('report.deposit', [
            'bulan' => $month
        ]);
    }

    public function deposit_show(Request $request)
    {
        $this->validate($request, [
            'bulan' => 'required',
            'tahun' => 'required'
        ]);

        $bulan = Month::where('id', $request->bulan)->first();
        $tahun = $request->tahun;

        $deposit = Deposit::where('month_id', $request->bulan)->get();
        $total = Deposit::where('month_id', $request->bulan)->sum('nominal');

        return view('report.show_deposit', [
            'no'    => 1,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'deposit' => $deposit,
            'total' => $total
        ]);
    }

    public function print(Request $request)
    {
        $this->validate($request, [
            'tanggal_awal'  => 'required|integer|min:1|max:30',
            'bulan'        => 'required|integer|min:1',
            'tanggal_akhir' => 'required|integer|min:1|max:30'
        ]);

        for ($i=1; $i <= 3; $i++) { 
            $L[$i] = self::getKwalitas('M'.$i, 'L');
            $P[$i] = self::getKwalitas('M'.$i, 'P');

            $setoran[$i] = self::getSetoran($i);
        }

        $conditions = array($request->tanggal_awal, $request->tanggal_akhir);

        $trx = Transaction::join('members', 'members.id', '=', 'transactions.member_id')
                ->join('months', 'months.id', '=', 'transactions.bulan_id')
                ->select('transactions.*', 'members.*', 'months.nama AS nama_bulan', 'months.tahun')
                ->where('bulan_id', $request->bulan)
                ->whereBetween('tgl_hijriah', $conditions)
                ->get();

                //dd($trx);

        return view('report.print', [
            'Kw_lk'         => $L,
            'Kw_pr'         => $P,
            'total'         => self::getTotal(),
            'setoran'       => $setoran,
            'ksu'           => self::getSetoran('ksu'),
            'total_setoran' => self::getSetoran('total'),
            'transactions'  => $trx,
            'no'            => 1
        ]);
    }

    public function member()
    {
        for ($i=1; $i <= 3; $i++) { 
            $L[$i] = self::getMember('M'.$i, 'L');
            $P[$i] = self::getMember('M'.$i, 'P');
        }
        $total_L = count(Member::where('jk', 'L')->get());
        $total_P = count(Member::where('jk', 'P')->get());

        return view('report.member', [
            'L' => $L,
            'P' => $P,
            'total_L'   => $total_L,
            'total_P'   => $total_P,
        ]);
    }

    protected static function getMember($kw, $jk)
    {
        $member = Member::where('jk', $jk)
                  ->where('kw', $kw)
                  ->get();

        return count($member);
    }

    protected static function getKwalitas($kw, $jk, $bln_id)
    {
        $member = Member::join('transactions', 'members.id', '=', 'transactions.member_id')
        ->where('members.kw', $kw)
        ->where('members.jk', $jk)
        ->where('bulan_id', $bln_id)
        ->get();

        return count($member);
    }

    protected static function getTotal($bln_id)
    {
        $member = Member::join('transactions', 'members.id', '=', 'transactions.member_id')
            ->where('bulan_id', $bln_id)
            ->get();

        return count($member);
    }

    protected static function getSetoran($account, $bln_id)
    {
        if($account == 1){
            $setoran = Transaction::where('bulan_id', $bln_id)->sum('setoran_pertama');
        } elseif ($account == 2) {
            $setoran = Transaction::where('bulan_id', $bln_id)->sum('setoran_kedua');
        } elseif($account == 3) {
            $setoran = Transaction::where('bulan_id', $bln_id)->sum('setoran_ketiga');
        } else if($account == "total") {
            $setoran_1 = Transaction::where('bulan_id', $bln_id)->sum('setoran_pertama');
            $setoran_2 = Transaction::where('bulan_id', $bln_id)->sum('setoran_kedua');
            $setoran_3 = Transaction::where('bulan_id', $bln_id)->sum('setoran_ketiga');
            $setoran = $setoran_1+$setoran_2+$setoran_3;
        } else {
            $ksu = Transaction::where('bulan_id', $bln_id)->sum('ksu');
            $setoran = $ksu;
        }

        return $setoran;
    }

    protected static function totalSetoran()
    {
        $allSetoran = self::getSetoran('total') + self::getSetoran('ksu');

        return $allSetoran;
    }
}