<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gaji = Gaji::first(); // Get the single record
        $hasData = $gaji !== null;
        
        return view('admin.gaji.index', compact('gaji', 'hasData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check if data already exists
        if (Gaji::exists()) {
            return redirect()->route('admin.gaji.index')
                ->with('message', 'Data gaji sudah ada! Anda hanya dapat mengupdate data yang sudah ada.')
                ->with('alert-info', 'warning');
        }
        
        return view('admin.gaji.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check if data already exists
        if (Gaji::exists()) {
            return redirect()->route('admin.gaji.index')
                ->with('message', 'Data gaji sudah ada! Anda hanya dapat mengupdate data yang sudah ada.')
                ->with('alert-info', 'warning');
        }

        $validator = Validator::make($request->all(), [
            'paket_bawaan' => 'required|numeric|min:0',
            'paket_jemputan' => 'required|numeric|min:0',
            'potongan_bpjs' => 'required|numeric|min:0'
        ], [
            'paket_bawaan.required' => 'Paket bawaan harus diisi',
            'paket_bawaan.numeric' => 'Paket bawaan harus berupa angka',
            'paket_bawaan.min' => 'Paket bawaan tidak boleh negatif',
            'paket_jemputan.required' => 'Paket jemputan harus diisi',
            'paket_jemputan.numeric' => 'Paket jemputan harus berupa angka',
            'paket_jemputan.min' => 'Paket jemputan tidak boleh negatif',
            'potongan_bpjs.required' => 'Potongan BPJS harus diisi',
            'potongan_bpjs.numeric' => 'Potongan BPJS harus berupa angka',
            'potongan_bpjs.min' => 'Potongan BPJS tidak boleh negatif'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            Gaji::create([
                'paket_bawaan' => $request->paket_bawaan,
                'paket_jemputan' => $request->paket_jemputan,
                'potongan_bpjs' => $request->potongan_bpjs
            ]);

            return redirect()->route('admin.gaji.index')
                ->with('message', 'Data gaji berhasil ditambahkan!')
                ->with('alert-info', 'success');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('message', 'Terjadi kesalahan: ' . $e->getMessage())
                ->with('alert-info', 'danger');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Gaji $gaji)
    {
        return view('admin.gaji.show', compact('gaji'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gaji $gaji = null)
    {
        // Get the single record if no specific ID provided
        if (!$gaji) {
            $gaji = Gaji::first();
        }
        
        if (!$gaji) {
            return redirect()->route('admin.gaji.index')
                ->with('message', 'Data gaji tidak ditemukan!')
                ->with('alert-info', 'danger');
        }
        
        return view('admin.gaji.edit', compact('gaji'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gaji $gaji)
    {
        $validator = Validator::make($request->all(), [
            'paket_bawaan' => 'required|numeric|min:0',
            'paket_jemputan' => 'required|numeric|min:0',
            'potongan_bpjs' => 'required|numeric|min:0'
        ], [
            'paket_bawaan.required' => 'Paket bawaan harus diisi',
            'paket_bawaan.numeric' => 'Paket bawaan harus berupa angka',
            'paket_bawaan.min' => 'Paket bawaan tidak boleh negatif',
            'paket_jemputan.required' => 'Paket jemputan harus diisi',
            'paket_jemputan.numeric' => 'Paket jemputan harus berupa angka',
            'paket_jemputan.min' => 'Paket jemputan tidak boleh negatif',
            'potongan_bpjs.required' => 'Potongan BPJS harus diisi',
            'potongan_bpjs.numeric' => 'Potongan BPJS harus berupa angka',
            'potongan_bpjs.min' => 'Potongan BPJS tidak boleh negatif'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $gaji->update([
                'paket_bawaan' => $request->paket_bawaan,
                'paket_jemputan' => $request->paket_jemputan,
                'potongan_bpjs' => $request->potongan_bpjs
            ]);

            return redirect()->route('admin.gaji.index')
                ->with('message', 'Data gaji berhasil diperbarui!')
                ->with('alert-info', 'success');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('message', 'Terjadi kesalahan: ' . $e->getMessage())
                ->with('alert-info', 'danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gaji $gaji)
    {
        try {
            $gaji->delete();

            return redirect()->route('admin.gaji.index')
                ->with('message', 'Data gaji berhasil dihapus! Anda dapat membuat data baru sekarang.')
                ->with('alert-info', 'success');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('message', 'Terjadi kesalahan: ' . $e->getMessage())
                ->with('alert-info', 'danger');
        }
    }
}
