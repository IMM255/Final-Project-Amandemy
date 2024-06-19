<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $pengaduans = Complaint::all();
        $status = $request->input('status');
        if ($status) {
        $pengaduans = Complaint::where('status', Request()->status)->get()->sortDesc();
        } else {
            $pengaduans = Complaint::orderByDesc('created_at')->get();
        }
        return view('pages.admin.pengaduan.index', compact('pengaduans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Complaint $complaint)
    {
        return view('pages.admin.pengaduan.show', compact('complaint'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Complaint $complaint)
    {
        if($complaint->image){
            Storage::disk('public')->delete($complaint->image);
        }
        $complaint->delete();
        return redirect()->back();
    }
}
