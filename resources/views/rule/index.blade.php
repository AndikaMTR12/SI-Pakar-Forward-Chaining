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
          <th>Kode Gejala</th>
          <th>Nilai</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        ?>
        @foreach($rules as $k)
        <tr>
          <td>{{ $no++ }}</td>
          <td>{{ $k->kerusakan->kode_kerusakan }}<br>{{ $k->kerusakan->kerusakan }}</td>
          <td>{{ $k->gejala->kode_gejala }}<br>{{ $k->gejala->gejala }}</td>
          <td>{{ $k->nilai }}</td>
          <td>
            <a href="/rule/{{ $k->id }}/hapus"><i class="fa fa-trash text-danger"></i></a>
            <a href="/rule/{{ $k->id }}/edit"><i class="fa fa-search text-success"></i></a>
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
      <form action="/rule" method="post">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label>Gejala</label>
            <select name="gejala_id" class="form-control" style="padding: 0rem 1rem !important;">
              <option selected disabled>Pilihan</option>
              @foreach($gejala as $g)
              <option value="{{$g->id}}">{{$g->gejala}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Kerusakan</label>
            <select name="kerusakan_id" class="form-control" style="padding: 0rem 1rem !important;">
              <option selected disabled>Pilihan</option>
              @foreach($kerusakan as $n)
              <option value="{{$n->id}}">{{$n->kerusakan}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Nilai</label>
            <input type="text" class="form-control" name="nilai" placeholder="Enter nilai">
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