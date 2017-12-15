<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Config;
use App\Models\Member;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $config = Config::find(1);

        $trx = DB::table('transactions')
                        ->join('members', 'members.id', '=', 'transactions.member_id')
                        ->join('months', 'months.id', '=', 'transactions.bulan_id')
                        ->select('transactions.*', 'members.nama', 'months.nama AS nama_bulan', 'months.tahun')
                        ->where('months.id', $config->month_id)
                        ->get();

        return view('transaction.index', [
            'no'    => 1,
            'transactions'   => $trx
        ]);
    }

    public function create()
    {
        $bulan_id = Config::find(1)->month_id;

        //SELECT members.nama, members.id FROM members
        //WHERE members.id NOT IN (SELECT * FROM transactions WHERE bulan_id = :id)

        $member = DB::table('members')
                    ->select('members.nama', 'members.id')
                    ->whereNotIn('id', function($id) use ($bulan_id){
                        $id->select('member_id')
                           ->from('transactions')
                           ->where('bulan_id', $bulan_id);
                    })
                    //->orderBy('nama', 'asc')
                    ->get();

        return view('transaction.create', [
            'members' => $member
        ]);

    }

    public function store(Request $request)
    {
        //Validation
        $this->validate($request, [
            'member_id'     => 'required',
            'setoran_1'     => 'required|integer|min:5000',
            'tgl_hijriah'   => 'required',
            'nominal'       => 'required'
        ]);

        $config = Config::find(1);

        $trx = Transaction::create([
            'member_id'         => $request->member_id,
            'hasil'             => 'BAYAR',
            'setoran_pertama'   => $request->setoran_1,
            'setoran_kedua'     => self::setoran($request->setoran_2),
            'setoran_ketiga'    => self::setoran($request->setoran_3),
            'ksu'               => self::setoran($request->ksu),
            'tgl_hijriah'       => $request->tgl_hijriah,
            'tgl_masehi'        => date('Y-m-d'),
            'bulan_id'          => $config->month_id,
            'minggu_ke'         => self::minggu_ke($request->tgl_hijriah),
            'kualitas_tg'       => self::kualitas_tg($request->setoran_1),
            'nominal'           => $request->nominal
        ]);

        if ($trx) {
            Session::flash('flash_notification', [
                'level'     => 'success',
                'message'   => 'Data transaksi berhasil disimpan!'
            ]);
            return redirect('/transaction');
        } else {
            abort('404');
        }
    }

    public function edit($id)
    {
        $member = DB::table('members')->select('id', 'nama')->get();

        $trx = Transaction::where('id', $id)->first();

        return view('transaction.edit', [
            'members'   => $member,
            'trx'       => $trx
        ]);
    }

    public function update(Request $request, $id)
    {
        $trx = Transaction::where('id', $id)->update([
            'member_id'         => $request->member_id,
            'setoran_pertama'   => $request->setoran_1,
            'setoran_kedua'     => self::setoran($request->setoran_2),
            'setoran_ketiga'    => self::setoran($request->setoran_3),
            'ksu'               => self::setoran($request->ksu),
            'tgl_hijriah'       => $request->tgl_hijriah,
            'minggu_ke'         => self::minggu_ke($request->tgl_hijriah),
            'kualitas_tg'       => self::kualitas_tg($request->setoran_1),
            'nominal'           => $request->nominal,
        ]);

        if ($trx) {
            Session::flash('flash_notification', [
                'level'     => 'success',
                'message'   => 'Data transaksi berhasil diperbarui!'
            ]);
        } else {
            Session::flash('flash_notification', [
               'level'     => 'error',
                'message'   => 'Data transaksi gagal diperbarui!'
            ]);
        }

        return redirect('/transaction');
    }

    public function destroy($id)
    {
        if(Transaction::find($id)->delete()){
            Session::flash('flash_notification', [
                'level'     => 'success',
                'message'   => 'Data berhasil dihapus!'
            ]);

            return redirect('/transaction');
        } else {
            abort(404);
        }
    }

    public function nominal()
    {
        $bulan_id = Config::find(1)->month_id;

        $trx = DB::table('transactions')
                        ->join('members', 'members.id', '=', 'transactions.member_id')
                        ->join('months', 'months.id', '=', 'transactions.bulan_id')
                        ->select('transactions.*', 'members.nama', 'months.nama AS nama_bulan', 'months.tahun')
                        ->where('nominal', 0)
                        ->where('bulan_id', $bulan_id)
                        //->orderBy('nama')
                        ->get();

        return view('transaction.nominal', [
            'no'    => 1,
            'transactions'   => $trx
        ]);
    }

    protected static function minggu_ke($tanggal)
    {
        $mgg = '';
        if($tanggal <= 7){
            $mgg = 1;
        } elseif($tanggal <= 14){
            $mgg = 2;
        } elseif($tanggal <= 21){
            $mgg = 3;
        } else {
            $mgg = 4;
        }

        return $mgg;
    }

    protected static function kualitas_tg($besaran)
    {
        $kw = '';
        if($besaran <= 10000) {
            $kw = "KURANG";
        } elseif($besaran <= 25000) {
            $kw = "PAS";
        } else {
            $kw = "LEBIH";
        }

        return $kw;
    }

    protected static function setoran($value)
    {
        if(!empty(trim($value)) || $value != ""){
            return $value;
        } else {
            return "0";
        }
    }
}