<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;


class StatusController extends Controller
{
	public function index()
	{
		dd(Status::find(1)->status());
	}
}
