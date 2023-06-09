<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use App\Models\Gejala;
use App\Models\Kerusakan;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    public function index()
    {
        $title = 'Rule';
        $rules = Rule::all();
        $kerusakan = Kerusakan::all();
        $gejala = Gejala::all();
        return view('rule.index', compact('title', 'rules', 'kerusakan', 'gejala'));
    }

    public function tambah(Request $request)
    {
        Rule::create($request->all());

        return redirect('/rule')->with('status', 'Rule berhasil ditambahkan');
    }

    public function edit($id)
    {
        $title = 'Edit Rule';
        $kerusakan = Kerusakan::all();
        $gejala = Gejala::all();
        $rule = Rule::where('id', $id)->get();
        return view('rule.edit', compact('rule', 'title', 'kerusakan', 'gejala'));
    }

    public function update(Request $request)
    {
        Rule::where('id', $request->id)->update([
            'gejala_id' => $request->gejala_id,
            'kerusakan_id' => $request->kerusakan_id,
            'nilai' => $request->nilai,
        ]);

        return redirect('/rule')->with('status', 'Rule berhasil diubah');
    }

    public function hapus($id)
    {
        Rule::where('id', $id)->delete();
        return redirect()->back()->with('status', 'Rule berhasil dihapus');
    }
}
