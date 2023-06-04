<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataGuruController extends Controller
{
    public function storeDataGuru(Request $request)
    {
        // validasi form
        $request->validate([
            'name' => 'required',
            'nip' => 'required|string|max:255',
            'jabatan' => 'required',
            'pangkat' => 'required',
            'satuan_organisasi' => 'required',
            'saldo_cuti' => 'required',
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:user,admin,kepala_sekolah',
            // 'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        //upload image
        // $image = $request->file('foto');
        // $image->storeAs('public/images', $image->hashName());

        // create data guru
        User::create([
            'name' => $request->name,
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
            'pangkat' => $request->pangkat,
            'satuan_organisasi' => $request->satuan_organisasi,
            'saldo_cuti' => $request->saldo_cuti,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            // 'foto' => $image->hashName()
        ]);

        // redirecting
        return redirect()->route('data-guru')->with(['success' => 'Data guru berhasil ditambahkan']);
    }

    public function updateDataGuru(Request $request, Guru $dataGuru)
    {
        // validasi form
        $request->validate([
            'nama' => 'required',
            'nip' => 'required|min:12',
            'jabatan' => 'required',
            'pangkat' => 'required',
            'satuan_organisasi' => 'required',
            'saldo_cuti' => 'required|max:12',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        if ($request->hasFile('foto')) {
            //upload image
            $image = $request->file('foto');
            $image->storeAs('public/images', $image->hashName());

            // delete old image
            Storage::delete('public/images' . $dataGuru->foto);

            // create data guru
            $dataGuru->update([
                'nama' => $request->nama,
                'nip' => $request->nip,
                'jabatan' => $request->jabatan,
                'pangkat' => $request->pangkat,
                'satuan_organisasi' => $request->satuan_organisasi,
                'saldo_cuti' => $request->saldo_cuti,
                'foto' => $image->hashName()
            ]);
        } else {
            // create data guru
            $dataGuru->update([
                'nama' => $request->nama,
                'nip' => $request->nip,
                'jabatan' => $request->jabatan,
                'pangkat' => $request->pangkat,
                'satuan_organisasi' => $request->satuan_organisasi,
                'saldo_cuti' => $request->saldo_cuti,
            ]);
        }
        
        // redirecting
        return redirect()->route('data-guru')->with(['success' => 'Data guru berhasil ditambahkan']);
    }
}
