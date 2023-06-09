@extends('layouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <form action="/diagnosa" method="post">
            @csrf
            <div class="text-center">
                <h3>Data Gejala</h3>
            </div>
            <hr>
            @foreach($gejalas as $key => $g)
            <div class="form-group row">
                <div class="col-sm-8">
                    <input type="checkbox" name="idv[]" value="{{$g->id}}" readonly>
                    <label for="staticEmail" class="col-form-label"><b>{{$g->gejala}}</b> ?</label>
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                </div>
                <div class="col-sm-4">
                    <select id="inputState" name="bobot[]" class="form-control" style="padding: 0rem 1rem !important;" required="true">
                        <option selected disabled>Pilihan</option>
                        <option value="1">1 - Pasti</option>
                        <option value="0.8">0.8 - Hampir Pasti</option>
                        <option value="0.6">0.6 - Kemungkinan Besar</option>
                        <option value="0.4">0.4 - Mungkin</option>
                        <option value="0">0 - Tidak Tahu</option>
                    </select>
                </div>
            </div>
            @endforeach
            <hr class="pt-3">
            <button type="submit" class="btn btn-sm btn-block btn-primary">Diagnosis</button>
        </form>
    </div>
</div>
@endsection