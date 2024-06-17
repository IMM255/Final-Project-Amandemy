<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index(){
        $pengaduan = Complaint::all();
        return view('pages.guest.home',compact('pengaduan'));
    }
    public function pengaduan(){
        $data = Complaint::all();

        return view('pages.guest.pengaduan',compact('data'));
    }

    public function pengaduanDetail($id){
        $item = Complaint::findOrFail($id);
        return view('pages.guest.detail-pengaduan',compact('item'));
    }

    public function buatPengaduan(){
        $categories = Category::all();
        return view('pages.masyarakat.buat-pengaduan',compact('categories'));
    }

    public function pengaduanKu(){
        $user = auth()->user()->id;

        $pengaduans = Complaint::where('user_id', $user)->get()->sortDesc();
        return view('pages.masyarakat.pengaduanku', compact('pengaduans'));
    }

    public function pengaduanProcess(Request $request){
        $request->validate([
            'kategori' => 'required',
            'title' => 'required',
            'description' => 'required',
            'urgency' => 'required',
            'location' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg|max:5120',
        ]);


        DB::beginTransaction();
        try {
            Complaint::create([
                'user_id' => $request->user_id,
                'category_id' => $request->kategori,
                'title' => $request->title,
                'description' => $request->description,
                'urgency' => $request->urgency,
                'image' => $request->file('image') ? $request->file('image')->store('pengaduan','public') : null,
                'location' => $request->location,
                'status' => 'belum_diproses',
            ]);

            DB::commit();
            return redirect()->route('buat.pengaduan')->with('success', 'Pengaduan berhasil dikirim');
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollback();
            return redirect()->route('buat.pengaduan')->with('error', 'Pengaduan gagal dikirim');
        }
    }
}
