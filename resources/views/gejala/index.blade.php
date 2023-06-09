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
                    <th>Kode Gejala</th>
                    <th>Gejala</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                ?>
                @foreach($gejalas as $k)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $k->kode_gejala }}</td>
                    <td>{{ $k->gejala }}</td>
                    <td>
                        <a href="/data-gejala/{{ $k->id }}/hapus"><i class="fa fa-trash text-danger"></i></a>
                        <a href="/data-gejala/{{ $k->id }}/edit"><i class="fa fa-search text-success"></i></a>
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
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah gejala</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/data-gejala" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Gejala</label>
                        <input type="text" name="kode_gejala" class="form-control" value="{{ $sku_kode }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Gejala Motor</label>
                        <input type="text" name="gejala" class="form-control" placeholder="Gejala Motor">
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