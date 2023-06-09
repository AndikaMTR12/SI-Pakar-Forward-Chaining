<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use Illuminate\Http\Request;

class GejalaController extends Controller
{
    public function index()
    {
        $title = "Data Gejala";
        $gejalas = Gejala::all();
        $gejala = Gejala::all()->last();
        if ($gejala == null) {
            $init = 'G';
            $val = '1';
            $sku_kode = $init . $val;
        } else {
            $key = $gejala->kode_gejala;
            $pattern = "/(\d+)/";
            $array = preg_split($pattern, $key, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
            $inisial = $array[0];
            $code = $array[1] += 1;
            $sku_kode = $inisial . $code;
        }
        return view('gejala.index', compact('title', 'gejalas', 'sku_kode'));
    }

    public function tambah(Request $request)
    {
        gejala::create([
            'kode_gejala' => $request->kode_gejala,
            'gejala' => $request->gejala,
        ]);

        return redirect('/data-gejala')->with('status', 'Berhasil Di Tambahkan!');
    }

    public function edit($id)
    {
        $title = "Edit gejala";
        $gejala = gejala::where('id', $id)->get();
        return view('gejala.edit', compact('title', 'gejala'));
    }

    public function update(Request $request)
    {
        gejala::where('id', $request->id)->update([
            'kode_gejala' => $request->kode_gejala,
            'gejala' => $request->gejala,
        ]);

        return redirect('/data-gejala')->with('status', 'Berhasil Di Update!');
    }

    public function hapus($id)
    {
        gejala::where('id', $id)->delete();

        return redirect('/data-gejala')->with('status', 'Berhasil Dihapus!');
    }
}
