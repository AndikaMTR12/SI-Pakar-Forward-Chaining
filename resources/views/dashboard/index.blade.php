@extends('layouts.main')

@section('container')
<div class="text-center mt-5">
    <h1>SELAMAT DATANG {{ auth()->user()->username }}</h1>
    <h3>SISTEM PAKAR DIAGNOSA KERUSAKAN MOTOR MENGGUNAKAN METODE CERTAINLY FACTORY</h3>
</div>
@endsection