<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function index()
    {
        $datas = DB::select('select * from barang where deleted_at is null');
        return view('dashboard.barang.index')
            ->with('datas', $datas);
    }
    public function search(Request $request)
    {
        /*$keyword = $request->keyword;
        $datas = DB::table('barang')->where('nama_client', 'LIKE', '%' . $keyword . '%')->orWhere('tgl_barang', 'LIKE', '%' . $keyword . '%')
            ->orWhere('harga_barang', 'LIKE', '%' . $keyword . '%')->orWhere('lokasi_barang', 'LIKE', '%' . $keyword . '%');
        return view('dashboard.barang.index', ['datas' => $datas]);*/
        $keyword = $request->keyword;
        $datas = DB::table('barang')->where('deleted_at', NULL)->where('nama_barang', 'LIKE', '%' . $keyword . '%')->orWhere('jns_barang', 'LIKE', '%' . $keyword . '%')
            ->orWhere('jmlh_barang', 'LIKE', '%' . $keyword . '%')->get();
        return view('dashboard.barang.index')
            ->with('datas', $datas);
    }
    public function create()
    {
        return view('dashboard.barang.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required',
            'nama_barang' => 'required',
            'jns_barang' => 'required',
            'jmlh_barang' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert(
            'INSERT INTO barang(id_barang, nama_barang, jns_barang, jmlh_barang) VALUES (:id_barang, :nama_barang, :jns_barang, :jmlh_barang)',
            [
                'id_barang' => $request->id_barang,
                'nama_barang' => $request->nama_barang,
                'jns_barang' => $request->jns_barang,
                'jmlh_barang' => $request->jmlh_barang,
            ]
        );

        // Menggunakan laravel eloquent
        // barang::create([
        //     'id_barang' => $request->id_barang,
        //     'nama_barang' => $request->nama_barang,
        //     'jns_barang' => $request->jns_barang,
        //     'jmlh_barang' => $request->jmlh_barang,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil disimpan');
    }

    public function edit($id)
    {
        $data = DB::table('barang')->where('id_barang', $id)->first();

        return view('dashboard.barang.edit')->with('data', $data);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'id_barang' => 'required',
            'nama_barang' => 'required',
            'jns_barang' => 'required',
            'jmlh_barang' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::table('barang')->where('id_barang', $request->id)->update([
            'id_barang' => $request->id_barang,
            'nama_barang' => $request->nama_barang,
            'jns_barang' => $request->jns_barang,
            'jmlh_barang' => $request->jmlh_barang,
        ]);

        // Menggunakan laravel eloquent
        // barang::where('id_barang', $id)->update([
        //     'id_barang' => $request->id_barang,
        //     'nama_barang' => $request->nama_barang,
        //     'jns_barang' => $request->jns_barang,
        //     'jmlh_barang' => $request->jmlh_barang,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diubah');
    }

    public function delete($id)
    {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM barang WHERE id_barang = :id_barang', ['id_barang' => $id]);

        // Menggunakan laravel eloquent
        // barang::where('id_barang', $id)->delete();

        return redirect()->route('barang.softindex')->with('success', 'Data barang berhasil dihapus');
    }
    public function softdelete($id)
    {
        DB::update('UPDATE barang SET deleted_at=current_timestamp() WHERE id_barang = :id_barang', ['id_barang' => $id]);

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil dihapus');
    }
    public function search_trash(Request $request)
    {
        $keyword = $request->keyword;
        $datas = DB::table('barang')->where('deleted_at', '<>', '')->where('nama_barang', 'LIKE', '%' . $keyword . '%')->orWhere('jns_barang', 'LIKE', '%' . $keyword . '%')
            ->orWhere('jmlh_barang', 'LIKE', '%' . $keyword . '%')->get();
        return view('dashboard.barang.soft')
            ->with('datas', $datas);
    }
    public function restore($id)
    {
        DB::update('UPDATE barang SET deleted_at=null WHERE id_barang = :id_barang', ['id_barang' => $id]);
        return redirect()->route('barang.index')->with('success', 'Data barang berhasil dipulihkan');
    }
    public function softindex()
    {
        $datas = DB::select('select * from barang where deleted_at is not null');
        return view('dashboard.barang.soft')
            ->with('datas', $datas);
    }
}
