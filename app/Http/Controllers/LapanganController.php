<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LapanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lapangans = Lapangan::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.lapangan', compact('lapangans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lapangan' => 'required|string|max:255|unique:lapangans,nama_lapangan',
            'harga' => 'required|numeric|min:0',
            'keterangan' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama_lapangan.unique' => 'Nama lapangan sudah digunakan. Silakan gunakan nama yang berbeda.',
            'foto.required' => 'Foto lapangan wajib diupload',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format foto harus jpeg, png, jpg, atau gif',
            'foto.max' => 'Ukuran foto maksimal 2MB',
        ]);

        $data = [
            'nama_lapangan' => $request->nama_lapangan,
            'harga_per_jam' => $request->harga,
            'deskripsi' => $request->keterangan,
            'tipe' => 'standard', // default tipe
            'status' => 'tersedia',
        ];

        // Handle file upload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/lapangan'), $filename);
            $data['image'] = 'images/lapangan/' . $filename;
        }

        Lapangan::create($data);

        return redirect()->route('admin.lapangan')->with('success', 'Lapangan berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $lapangan = Lapangan::findOrFail($id);

        $request->validate([
            'nama_lapangan' => 'required|string|max:255|unique:lapangans,nama_lapangan,' . $id,
            'harga' => 'required|numeric|min:0',
            'keterangan' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama_lapangan.unique' => 'Nama lapangan sudah digunakan. Silakan gunakan nama yang berbeda.',
        ]);

        $data = [
            'nama_lapangan' => $request->nama_lapangan,
            'harga_per_jam' => $request->harga,
            'deskripsi' => $request->keterangan,
        ];

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Delete old image if exists and not default image
            if ($lapangan->image && 
                file_exists(public_path($lapangan->image)) && 
                $lapangan->image !== 'images/lapangan1.jpg' &&
                strpos($lapangan->image, 'images/lapangan/') === 0) {
                try {
                    unlink(public_path($lapangan->image));
                } catch (\Exception $e) {
                    // Ignore if file cannot be deleted
                }
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/lapangan'), $filename);
            $data['image'] = 'images/lapangan/' . $filename;
        }

        $lapangan->update($data);

        return redirect()->route('admin.lapangan')->with('success', 'Lapangan berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $lapangan = Lapangan::findOrFail($id);

        // Delete image if exists and not default image
        if ($lapangan->image && 
            file_exists(public_path($lapangan->image)) && 
            $lapangan->image !== 'images/lapangan1.jpg' &&
            strpos($lapangan->image, 'images/lapangan/') === 0) {
            try {
                unlink(public_path($lapangan->image));
            } catch (\Exception $e) {
                // Ignore if file cannot be deleted
            }
        }

        $lapangan->delete();

        return redirect()->route('admin.lapangan')->with('success', 'Lapangan berhasil dihapus!');
    }

    /**
     * Get all lapangan for public view
     */
    public function publicIndex()
    {
        $lapangans = Lapangan::where('status', 'tersedia')->get();
        return view('lapangan', compact('lapangans'));
    }
}
