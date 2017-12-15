<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Models\Member;
use App\Models\Member_details;
use App\Models\Jobs;
use App\Models\Status;

use Illuminate\Http\Request;
use Session;

class MemberController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $member = Member::orderBy('nama', 'asc')->get();
        return view('member.index', [
            'no'    => 1,
            'member' => $member
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $member = Member::create([
            'nama'      => strtoupper($request->nama),
            'jk'        => $request->jk,
            'kw'        => $request->kw,
            'status'    => self::status($request->kw),
            'keterangan'=> ' '
        ]);

        $details = Member_details::create([
            'member_id' => $member->id,
            'pekerjaan' => $request->pekerjaan,
            'gaji'      => $request->gaji,
            'desa'      => ' ',
            'kecamatan' => ' ',
            'kab_kota'  => ' ',
            'provinsi'  => ' ',
            'sales'     => ' ',
            'catatan'   => ' '
        ]);

        if($member && $details) {
            Session::flash('flash_notification', [
                'level'     => 'success',
                'message'   => 'Data member berhasil disimpan!'
            ]);

            return redirect('/member');
        } else {
            Session::flash('flash_notification', [
                'level'     => 'error',
                'message'   => 'Data member gagal disimpan!'
            ]);

            return redirect('/member');
        }
    }

    public function show($id)
    {
        $member = Member::find($id);
        $detail = DB::table('members')
                    ->join('member_details', 'members.id', '=', 'member_details.member_id')
                    ->join('jobs', 'jobs.id', '=', 'member_details.jobs_id')
                    ->join('status', 'status.id', '=', 'members.status_id')
                    ->select('members.*', 'member_details.*', 'jobs.nama as pekerjaan', 'status.nama as status')
                    ->where('members.id', $id)
                    ->first();

        if(!$member || !$detail) {
            abort(404);
        } else {
            return view('member.single', [
                'member' => $member,
                'detail' => $detail
            ]);
            
        }
    }

    public function edit($id)
    {
        $jobs   = Jobs::all();
        $status = Status::all();
        $member = DB::table('members')
            ->join('member_details', 'members.id', '=', 'member_details.member_id')
            ->join('jobs', 'jobs.id', '=', 'member_details.jobs_id')
            ->join('status', 'status.id', '=', 'members.status_id')
            ->select('members.*', 'member_details.*', 'jobs.nama as pekerjaan', 'status.nama as status')
            ->where('members.id', $id)
            ->first();

        if (!$member) {
            abort(404);
        } else {
            return view('member.update', [
                'member'=> $member,
                'jobs'  => $jobs,
                'status'=> $status
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $member = Member::find($id)->update([
            'nama'  => strtoupper($request->nama),
            'jk'    => $request->jk,
            'status_id' => $request->status
        ]);
        $detail = Member_details::where('member_id', $id)->first();
        $detail->update([
            'jobs_id'   => $request->pekerjaan,
            'gaji'      => $request->gaji,
            'desa'      => $request->desa,
            'kecamatan' => $request->kecamatan,
            'kab_kota'  => $request->kab_kota,
            'provinsi'  => $request->provinsi,
            'sales'     => $request->sales,
            'catatan'   => $request->catatan
        ]);

        if($member && $detail){
            Session::flash('flash_notification', [
                'level'     => 'success',
                'message'   => 'Data member berhasil diperbarui!'
            ]);
        } else {
            Session::flash('flash_notification', [
                'level'     => 'error',
                'message'   => 'Data member gagal diperbarui!'
            ]);
        }
        return redirect('/member');

    }

    public function destroy($id)
    {
        //
    }

    protected static function status($jk)
    {
        $status = ($jk == 'L') ? 'LAJANG' : 'GADIS';

        return $status;
    }
}
