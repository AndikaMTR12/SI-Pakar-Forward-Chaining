<?php

namespace App\Http\Controllers;

use App\Models\Kerusakan;
use Illuminate\Http\Request;

class KerusakanController extends Controller
{
    public function index()
    {
        $title = "Data Kerusakan";
        $kerusakans = Kerusakan::all();
        $kerusakan = Kerusakan::all()->last();
        if ($kerusakan == null) {
            $init = 'K';
            $val = '1';
            $sku_kode = $init . $val;
        } else {
            $key = $kerusakan->kode_kerusakan;
            $pattern = "/(\d+)/";
            $array = preg_split($pattern, $key, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
            $inisial = $array[0];
            $code = $array[1] += 1;
            $sku_kode = $inisial . $code;
        }
        return view('kerusakan.index', compact('title', 'kerusakans', 'sku_kode'));
    }

    public function tambah(Request $request)
    {
        Kerusakan::create([
            'kode_kerusakan' => $request->kode_kerusakan,
            'kerusakan' => $request->kerusakan,
            'kesimpulan' => $request->kesimpulan,
            'solusi' => $request->solusi,
        ]);

        return redirect('/data-kerusakan')->with('status', 'Berhasil Di Tambahkan!');
    }

    public function edit($id)
    {
        $title = "Edit Kerusakan";
        $kerusakan = Kerusakan::where('id', $id)->get();
        return view('kerusakan.edit', compact('title', 'kerusakan'));
    }

    public function update(Request $request)
    {
        Kerusakan::where('id', $request->id)->update([
            'kode_kerusakan' => $request->kode_kerusakan,
            'kerusakan' => $request->kerusakan,
            'kesimpulan' => $request->kesimpulan,
            'solusi' => $request->solusi,
        ]);

        return redirect('/data-kerusakan')->with('status', 'Berhasil Di Update!');
    }

    public function hapus($id)
    {
        Kerusakan::where('id', $id)->delete();

        return redirect('/data-kerusakan')->with('status', 'Berhasil Dihapus!');
    }
}
