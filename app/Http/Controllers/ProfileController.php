<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {

        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        return view('pages.masyarakat.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|max:225',
            'email' => ['required','email',Rule::unique('users','email')->ignore($user->id)],
            'phone' => 'required|numeric|min:12',
            'address' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048',
        ]);


        if($request->password){
            $request->validate([
                'password' => 'required|min:6|confirmed',
            ]);

            $password = $request->password;
        }else{
            $password = $user->password;
        }

        if ($request->file('image')) {
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $image = $request->file('image')->store('user','public');
        }else{
            $image = $user->image;
        }



        DB::beginTransaction();
        try {
            $user->update([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'password' => $password,
                'email' => $request->email,
                'image' => $image,
            ]);

            DB::commit();
            return redirect()->route('profile.index')->with('success', 'Data berhasil diupdate');
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollback();
            return redirect()->route('profile.index')->with('error', 'Data gagal diupdate');
        }
    }
}
