<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Month;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $month = Month::all();

        return view('month.index', [
            'months' => $month,
            'no' => 1
        ]);
    }

    public function create()
    {
        return view('month.create');
    }

    public function store(Request $request)
    {
        $month = Month::create([
            'nama'          => $request->nama,
            'tahun'         => $request->tahun,
            'keterangan'    => $request->keterangan
        ]);

        if($month){
             Session::flash('flash_notification', [
                'level'     => 'success',
                'message'   => 'Berhasil menambahkan data!'
            ]);

            return redirect('/month');
        }

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //$month = Month::find($id)->first();
        $month = DB::table('months')->where('id', $id)->first();
        if(!$month){
            abort(404);
        }

        return view('month.edit', [
            'month' => $month
        ]);
    }

    public function update(Request $request, $id)
    {
        $month = Month::find($id)->update([
            'nama'        => $request->nama,
            'tahun'       => $request->tahun,
            'keterangan'  => $request->keterangan
        ]);
        if($month):
            Session::flash('flash_notification', [
                'level'     => 'success',
                'message'   => 'Berhasil menyimpan data!'
            ]);
            return redirect('/month');
        else:
            abort(404);
        endif;

    }

    public function destroy($id)
    {
        Month::find($id)->delete();
        return redirect('/month');
    }
}
