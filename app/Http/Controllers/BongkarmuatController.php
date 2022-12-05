<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BongkarmuatController extends Controller
{
    public function index()
    {
        $datas = DB::select('select * from bongkarmuat where deleted_at is null');
        return view('dashboard.bongkarmuat.index')
            ->with('datas', $datas);
    }
    public function search(Request $request)
    {
        /*$keyword = $request->keyword;
        $datas = DB::table('bongkarmuat')->where('nama_client', 'LIKE', '%' . $keyword . '%')->orWhere('tgl_bongkarmuat', 'LIKE', '%' . $keyword . '%')
            ->orWhere('harga_bongkarmuat', 'LIKE', '%' . $keyword . '%')->orWhere('lokasi_bongkarmuat', 'LIKE', '%' . $keyword . '%');
        return view('dashboard.bongkarmuat.index', ['datas' => $datas]);*/
        $keyword = $request->keyword;
        $datas = DB::table('bongkarmuat')->where('deleted_at', NULL)->where('nama_client', 'LIKE', '%' . $keyword . '%')->orWhere('tgl_bongkarmuat', 'LIKE', '%' . $keyword . '%')
            ->orWhere('harga_bongkarmuat', 'LIKE', '%' . $keyword . '%')->get();
        return view('dashboard.bongkarmuat.index')
            ->with('datas', $datas);
    }
    public function create()
    {
        return view('dashboard.bongkarmuat.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_bongkarmuat' => 'required',
            'id_kapal' => 'required',
            'id_barang' => 'required',
            'nama_client' => 'required',
            'tgl_bongkarmuat' => 'required',
            'harga_bongkarmuat' => 'required',
            'lokasi_bongkarmuat' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert(
            'INSERT INTO bongkarmuat(id_bongkarmuat, id_kapal, id_barang, nama_client, tgl_bongkarmuat, harga_bongkarmuat, lokasi_bongkarmuat) VALUES (:id_bongkarmuat, :id_kapal, :id_barang, :nama_client, :tgl_bongkarmuat, :harga_bongkarmuat, :lokasi_bongkarmuat)',
            [
                'id_bongkarmuat' => $request->id_bongkarmuat,
                'id_kapal' => $request->id_kapal,
                'id_barang' => $request->id_barang,
                'nama_client' => $request->nama_client,
                'tgl_bongkarmuat' => $request->tgl_bongkarmuat,
                'harga_bongkarmuat' => $request->harga_bongkarmuat,
                'lokasi_bongkarmuat' => $request->lokasi_bongkarmuat,
            ]
        );

        // Menggunakan laravel eloquent
        // bongkarmuat::create([
        //     'id_bongkarmuat' => $request->id_bongkarmuat,
        //     'nama_bongkarmuat' => $request->nama_bongkarmuat,
        //     'jns_bongkarmuat' => $request->jns_bongkarmuat,
        //     'jmlh_bongkarmuat' => $request->jmlh_bongkarmuat,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('bongkarmuat.index')->with('success', 'Data bongkar muat berhasil disimpan');
    }

    public function edit($id)
    {
        $data = DB::table('bongkarmuat')->where('id_bongkarmuat', $id)->first();

        return view('dashboard.bongkarmuat.edit')->with('data', $data);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'id_bongkarmuat' => 'required',
            'id_kapal' => 'required',
            'id_barang' => 'required',
            'nama_client' => 'required',
            'tgl_bongkarmuat' => 'required',
            'harga_bongkarmuat' => 'required',
            'lokasi_bongkarmuat' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::table('bongkarmuat')->where('id_bongkarmuat', $request->id)->update([
            'id_bongkarmuat' => $request->id_bongkarmuat,
            'id_kapal' => $request->id_kapal,
            'id_barang' => $request->id_barang,
            'nama_client' => $request->nama_client,
            'tgl_bongkarmuat' => $request->tgl_bongkarmuat,
            'harga_bongkarmuat' => $request->harga_bongkarmuat,
            'lokasi_bongkarmuat' => $request->lokasi_bongkarmuat,
        ]);

        // Menggunakan laravel eloquent
        // bongkarmuat::where('id_bongkarmuat', $id)->update([
        //     'id_bongkarmuat' => $request->id_bongkarmuat,
        //     'nama_bongkarmuat' => $request->nama_bongkarmuat,
        //     'jns_bongkarmuat' => $request->jns_bongkarmuat,
        //     'jmlh_bongkarmuat' => $request->jmlh_bongkarmuat,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('bongkarmuat.index')->with('success', 'Data bongkar muat berhasil diubah');
    }

    public function delete($id)
    {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM bongkarmuat WHERE id_bongkarmuat = :id_bongkarmuat', ['id_bongkarmuat' => $id]);

        // Menggunakan laravel eloquent
        // bongkarmuat::where('id_bongkarmuat', $id)->delete();

        return redirect()->route('bongkarmuat.softindex')->with('success', 'Data bongkar muat berhasil dihapus');
    }
    public function softdelete($id)
    {
        DB::update('UPDATE bongkarmuat SET deleted_at=current_timestamp() WHERE id_bongkarmuat = :id_bongkarmuat', ['id_bongkarmuat' => $id]);

        return redirect()->route('bongkarmuat.index')->with('success', 'Data bongkar muat berhasil dihapus');
    }
    public function search_trash(Request $request)
    {
        $keyword = $request->keyword;
        $datas = DB::table('bongkarmuat')->where('deleted_at', '<>', '')->where('nama_client', 'LIKE', '%' . $keyword . '%')->orWhere('tgl_bongkarmuat', 'LIKE', '%' . $keyword . '%')
            ->orWhere('harga_bongkarmuat', 'LIKE', '%' . $keyword . '%')->get();
        return view('dashboard.bongkarmuat.soft')
            ->with('datas', $datas);
    }
    public function restore($id)
    {
        DB::update('UPDATE bongkarmuat SET deleted_at=null WHERE id_bongkarmuat = :id_bongkarmuat', ['id_bongkarmuat' => $id]);
        return redirect()->route('bongkarmuat.index')->with('success', 'Data bongkar muat berhasil dipulihkan');
    }
    public function softindex()
    {
        $datas = DB::select('select * from bongkarmuat where deleted_at is not null');
        return view('dashboard.bongkarmuat.soft')
            ->with('datas', $datas);
    }
}
