@extends('layouts.main')

@section('container')
<div class="row">
    <div class="col-12">
        Pilihan yang anda berikan :
        <hr>
    </div>
    <div class="col-12">
        @foreach($rows as $key => $v)
        @php
        $gejala = App\Models\Gejala::where('id', $v['id'])->get();
        @endphp
        @foreach($gejala as $g)
        <div class="clearfix">
            <h6 class="float-left">{{$g->gejala}} </h6>
            <div class="float-right">
            </div>
        </div>
        @endforeach
        @endforeach
    </div>
    <div class="col-12">
        <hr>
        Hasil Diagnosis :
        <hr>
        Berdasarkan hasil kerusakan motor analisis pada sistem : <br>
        @foreach($rows as $key => $v)
        @php
        $gesol = App\Models\Rule::whereIn('gejala_id', [$v['id']])->distinct()->get();
        @endphp
        @foreach($gesol as $key => $g)
        @endforeach
        @endforeach
        {{$g->kerusakan->kerusakan}} <br>
        <hr>
        Dengan presetase kemungkinan sebesar : {{number_format($hasil_f['hasil'] * 100)}} %
        <input type="hidden" class="form-control" value="{{$hasil_f['hasil'] * 100}}">
        <hr>
        <!-- <div class="clearfix">
            <button type="submit" class="btn btn-default float-left">SIMPAN</button>
            <button type="submit" class="btn btn-default float-right">CETAK</button>
        </div> -->
        </form>
    </div>
</div>
@endsection