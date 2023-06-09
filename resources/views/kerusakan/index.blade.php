@extends('layouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <!-- Button trigger modal -->
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
            <i class="fa fa-plus"></i>Tambah
        </button>

        <table id="example1" class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode Kerusakan</th>
                    <th>Kerusakan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                ?>
                @foreach($kerusakans as $k)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $k->kode_kerusakan }}</td>
                    <td>{{ $k->kerusakan }}</td>
                    <td>
                        <a href="/data-kerusakan/{{ $k->id }}/hapus"><i class="fa fa-trash text-danger"></i></a>
                        <a href="/data-kerusakan/{{ $k->id }}/edit"><i class="fa fa-search text-success"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Kerusakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/data-kerusakan" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Kerusakan</label>
                        <input type="text" name="kode_kerusakan" class="form-control" value="{{ $sku_kode }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Kerusakan Motor</label>
                        <input type="text" name="kerusakan" class="form-control" placeholder="Kerusakan Motor">
                    </div>
                    <div class="form-group">
                        <label>Kesimpulan</label>
                        <textarea name="kesimpulan" class="form-control" placeholder="Kesimpulan"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Solusi</label>
                        <textarea name="solusi" class="form-control" placeholder="Solusi"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection