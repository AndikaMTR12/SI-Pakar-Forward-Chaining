<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use App\Models\Gejala;
use App\Models\Konsultasi;
use Illuminate\Http\Request;

class DiagnosaController extends Controller
{
    public function index()
    {
        $title = 'Diagnosa';
        $gejalas = Gejala::all();
        return view('diagnosa.index', compact('title', 'gejalas'));
    }

    public function perhitungan(Request $request)
    {
        $title = 'Diagnosa';
        $data = $request->all();
        $idv = $data['idv'];
        $bobot = $data['bobot'];
        $rows = [];
        foreach ($bobot as $key => $input) {
            array_push($rows, [
                'bobot' => isset($bobot[$key]) ? $bobot[$key] : '',
                'id' => isset($idv[$key]) ? $idv[$key] : ''
            ]);
        }
        // dd($rows);
        $obj = [];
        foreach ($rows as $key => $v) {
            $gesol = Rule::where('gejala_id', $v['id'])->get()->toArray();
            foreach ($gesol as $key => $g) {
                array_push($obj, [
                    'cf' => $g['nilai'] * $v['bobot']
                ]);
            }
        }
        // Hitung
        $arg = [];
        $cftotal_temp = 0;
        $cf = 0;
        $cflama = 0;
        // dd($obj);
        foreach ($obj as $key => $o) {
            if (($o['cf'] >= 0) && ($o['cf'] * $cflama >= 0)) {
                $cflama = $cflama + ($o['cf'] * (1 - $cflama));
                array_push($arg, [
                    'hasil' => $cflama
                ]);
            }
            if (($o['cf'] < 0) && ($o['cf'] * $cflama >= 0)) {
                $cflama = $cflama + ($o['cf'] * (1 + $cflama));
                array_push($arg, [
                    'hasil' => $cflama
                ]);
            }
        }
        $hasil_f = end($arg);
        foreach ($rows as $key => $v) {
            $gesol = Rule::whereIn('gejala_id', [$v['id']])->distinct()->get();
            foreach ($gesol as $key => $g) {
                $nama = $g->kerusakan->kerusakan;
            }
        }
        $persentase = $hasil_f['hasil'] * 100;

        Konsultasi::create([
            'user_id' => $request->user_id,
            'kerusakan' => $nama,
            'persentase' => $persentase,
        ]);
        return view('diagnosa.perhitungan', compact('title', 'rows', 'obj', 'hasil_f'));
    }
}
