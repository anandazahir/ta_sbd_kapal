<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KapalController extends Controller
{
    public function index()
    {
        $datas = DB::select('select * from kapal where deleted_at is null');
        return view('dashboard.kapal.index')
            ->with('datas', $datas);
    }
    public function search(Request $request)
    {
        /*$keyword = $request->keyword;
        $datas = DB::table('kapal')->where('nama_kapal', 'LIKE', '%' . $keyword . '%')->orWhere('tgl_kapal', 'LIKE', '%' . $keyword . '%')
            ->orWhere('tahun_kapal', 'LIKE', '%' . $keyword . '%')->orWhere('lokasi_kapal', 'LIKE', '%' . $keyword . '%');
        return view('dashboard.kapal.index', ['datas' => $datas]);*/
        $keyword = $request->keyword;
        $datas = DB::table('kapal')->where('deleted_at', NULL)->where('nama_kapal', 'LIKE', '%' . $keyword . '%')->orWhere('jns_kapal', 'LIKE', '%' . $keyword . '%')
            ->orWhere('tahun_kapal', 'LIKE', '%' . $keyword . '%')->get();
        return view('dashboard.kapal.index')
            ->with('datas', $datas);
    }
    public function create()
    {
        return view('dashboard.kapal.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kapal' => 'required',
            'nama_kapal' => 'required',
            'jns_kapal' => 'required',
            'tahun_kapal' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert(
            'INSERT INTO kapal(id_kapal, nama_kapal, jns_kapal, tahun_kapal) VALUES (:id_kapal, :nama_kapal, :jns_kapal, :tahun_kapal)',
            [
                'id_kapal' => $request->id_kapal,
                'nama_kapal' => $request->nama_kapal,
                'jns_kapal' => $request->jns_kapal,
                'tahun_kapal' => $request->tahun_kapal,
            ]
        );

        // Menggunakan laravel eloquent
        // kapal::create([
        //     'id_kapal' => $request->id_kapal,
        //     'nama_kapal' => $request->nama_kapal,
        //     'jns_kapal' => $request->jns_kapal,
        //     'tahun_kapal' => $request->tahun_kapal,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('kapal.index')->with('success', 'Data kapal berhasil disimpan');
    }

    public function edit($id)
    {
        $data = DB::table('kapal')->where('id_kapal', $id)->first();

        return view('dashboard.kapal.edit')->with('data', $data);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'id_kapal' => 'required',
            'nama_kapal' => 'required',
            'jns_kapal' => 'required',
            'tahun_kapal' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::table('kapal')->where('id_kapal', $request->id)->update([
            'id_kapal' => $request->id_kapal,
            'nama_kapal' => $request->nama_kapal,
            'jns_kapal' => $request->jns_kapal,
            'tahun_kapal' => $request->tahun_kapal,
        ]);

        // Menggunakan laravel eloquent
        // kapal::where('id_kapal', $id)->update([
        //     'id_kapal' => $request->id_kapal,
        //     'nama_kapal' => $request->nama_kapal,
        //     'jns_kapal' => $request->jns_kapal,
        //     'tahun_kapal' => $request->tahun_kapal,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('kapal.index')->with('success', 'Data kapal berhasil diubah');
    }

    public function delete($id)
    {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM kapal WHERE id_kapal = :id_kapal', ['id_kapal' => $id]);

        // Menggunakan laravel eloquent
        // kapal::where('id_kapal', $id)->delete();

        return redirect()->route('kapal.softindex')->with('success', 'Data kapal berhasil dihapus');
    }
    public function softdelete($id)
    {
        DB::update('UPDATE kapal SET deleted_at=current_timestamp() WHERE id_kapal = :id_kapal', ['id_kapal' => $id]);

        return redirect()->route('kapal.index')->with('success', 'Data kapal berhasil dihapus');
    }
    public function search_trash(Request $request)
    {
        $keyword = $request->keyword;
        $datas = DB::table('kapal')->where('deleted_at', '<>', '')->where('nama_kapal', 'LIKE', '%' . $keyword . '%')->orWhere('jns_kapal', 'LIKE', '%' . $keyword . '%')
            ->orWhere('tahun_kapal', 'LIKE', '%' . $keyword . '%')->get();
        return view('dashboard.kapal.soft')
            ->with('datas', $datas);
    }
    public function restore($id)
    {
        DB::update('UPDATE kapal SET deleted_at=null WHERE id_kapal = :id_kapal', ['id_kapal' => $id]);
        return redirect()->route('kapal.index')->with('success', 'Data kapal berhasil dipulihkan');
    }
    public function softindex()
    {
        $datas = DB::select('select * from kapal where deleted_at is not null');
        return view('dashboard.kapal.soft')
            ->with('datas', $datas);
    }
}
