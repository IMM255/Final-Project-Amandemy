<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(){
    $users = User::all();
    return view('pages.admin.user.index', compact('users'));
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        DB::beginTransaction();
        try {
            $user->delete();
            DB::commit();
            if($user->image){
                Storage::disk('public')->delete($user->image);
            }
            return redirect()->route('user.index')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->route('user.index')->with('error', 'Data gagal dihapus');
        }
    }
}
