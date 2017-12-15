<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Month;

use Session;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $deposit = Deposit::join('months', 'months.id', '=', 'deposits.month_id')
                    ->select('deposits.*', 'months.nama', 'months.tahun')
                    ->get();
        $month = Month::all();

        return view('deposit.index', [
            'no'        => 1,
            'deposit'   => $deposit,
            'bulan'     => $month
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nominal'   => 'required|integer|min:1',
            'bulan'     => 'required',
            'penerima'  => 'required'
        ]);

        $setor = Deposit::create([
            'nominal'   => $request->nominal,
            'month_id'  => $request->bulan,
            'tanggal'   => date('Y-m-d'),
            'setor_ke'  => $request->penerima,
            'keterangan'=> $request->keterangan
        ]);

        if ($setor) {
            Session::flash('flash_notification', [
                'level'     => 'success',
                'message'   => 'Data deposit berhasil disimpan!'
            ]);
        } else {
            Session::flash('flash_notification', [
                'level'     => 'error',
                'message'   => 'Data deposit gagal disimpan!'
            ]);
        }

        return redirect('/deposit');

    }

    public function edit($id)
    {
        $deposit = Deposit::find($id);
        $bulan  = Month::all();

        return view('deposit.edit', [
            'bulan' => $bulan,
            'deposit'   => $deposit
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nominal'   => 'required|integer|min:1',
            'bulan'     => 'required',
            'penerima'  => 'required'
        ]);

        $update = Deposit::find($id)->update([
            'nominal'   => $request->nominal,
            'month_id'  => $request->bulan,
            'tanggal'   => $request->tanggal,
            'setor_ke'  => $request->penerima,
            'keterangan'=> $request->keterangan
        ]);

        if ($update) {
            Session::flash('flash_notification', [
                'level'     => 'success',
                'message'   => 'Data deposit berhasil diperbarui!'
            ]);
        } else {
            Session::flash('flash_notification', [
                'level'     => 'error',
                'message'   => 'Data deposit gagal diperbarui!'
            ]);
        }

        return redirect('/deposit');
    }

    public function destroy($id)
    {
        if(Deposit::find($id)->delete()):
            Session::flash('flash_notification', [
                'level'     => 'success',
                'message'   => 'Data deposit berhasil dihapus!'
            ]);
        else:
            Session::flash('flash_notification', [
                'level'     => 'error',
                'message'   => 'Data deposit gagal dihapus!'
            ]);
        endif;

        return redirect('/deposit');
    }
}
