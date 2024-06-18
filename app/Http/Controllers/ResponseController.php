<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResponseController extends Controller
{
    public function response(Request $request)
    {
        $request->validate([
            'response_content' => 'required',
            'status' => 'required',
        ]);

        DB::beginTransaction();
        try {
            Response::create([
                'complaint_id' => $request->complaint_id,
                'response_content' => $request->response_content,
                'user_id' => $request->user_id,
            ]);

            $pengaduan = Complaint::where('id', $request->complaint_id);
            $pengaduan->update(['status'=>$request->status]);

            DB::commit();
            return redirect()->route('complaint.index')->with('success', 'Pengaduan telah ditanggapi');
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollback();
            return redirect()->route('complaint.index')->with('error', 'Pengaduan gagal ditanggapi');
        }
    }


    public function responseFinish(string $id)
    {
        $pengaduan = Complaint::where('id', $id);

        DB::beginTransaction();
        try {
            $pengaduan->update(['status'=>'selesai']);

            DB::commit();
            return redirect()->route('complaint.index')->with('success', 'Status pengaduan berhasil diubah');
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollback();
            return redirect()->route('complaint.index')->with('error', 'Pengaduan gagal diupdate status');
        }

    }
}
