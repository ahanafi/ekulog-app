<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $nowaday = self::nowAday(date('D'));
        $month = self::nowAmonth(date('M'));
        return view('home', [
            'nowaday' => $nowaday,
            'month' => $month
        ]);
    }

    public static function nowAday($day)
    {
        if($day == "Sun") {
            $now = "Minggu";
        } else if($day == "Mon") {
            $now = "Senin";
        } else if($day == "Tue") {
            $now = "Selasa";
        } else if($day == "Wed") {
            $now = "Rabu";
        } else if($day == "Thu") {
            $now = "Kamis";
        } else if($day == "Fri") {
            $now = "Jum'at";
        } else {
            $now = "Sabtu";
        }

        return $now;
    }

    public static function nowAmonth($month)
    {
        if($month == "Jan"){
            $month .= "uari";
        } elseif($month == "Feb"){
            $month .= "ruari";
        } elseif ($month == "Mar") {
            $month .= "et";
        } elseif($month == "Apr") {
            $month .= "il";
        } elseif ($month == "May") {
            $month = "Mei";
        } elseif($month == "Jun" || $month == "Jul") {
            $month .= "i";
        } elseif($month == "Aug") {
            $month = "Agustus";
        } elseif ($month == "Sep") {
            $month .= "tember";
        } elseif ($month == "Oct") {
            $month = str_replace("c", "k", $month);
            $month .= "ober";
        } elseif ($month == "Nov") {
            $month .= "ember";
        } elseif($month == "Dec") {
            $month = str_replace("c", "s", $month);
            $month .= "ember";
        }

        return $month;
    }
}
