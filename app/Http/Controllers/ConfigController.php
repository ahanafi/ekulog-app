<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Month;
use Illuminate\Http\Request;
use Session;

class ConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
    	$config = Config::join('months', 'config.month_id', '=', 'months.id')->first();

    	$months = Month::all();
    	return view('config.index', [
    		'months' => $months,
    		'config' => $config
    	]);
    }

    public function store(Request $request)
    {
    	
    }

    public function update(Request $request)
    {
    	$id = 1;
    	$config = Config::find($id)->update([
    		'month_id' => $request->month_id
    	]);
    	if($config) {
    		Session::flash('flash_notification', [
    			'level'	=> 'success',
    			'message'	=> 'Konfigurasi berhasil diperbarui!'
    		]);
    		return redirect('/config');
    	}
    }
}
