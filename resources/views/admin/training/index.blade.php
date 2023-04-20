@extends('layout.masterAdmin')
@section('content')
<h1 class="text-center my-4">{{ $title }}</h1>
<div class="border border-1 shadow shadow-lg rounded p-4 table-responsive">
    <button type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#tambahModal">
        Tambah
    </button>
    <table class="table" id="dt">
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Deskripsi</th>
            <th scope="col">Periode</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($trainings as $training)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $training->nama }}</td>
                <td>{{ $training->deskripsi }}</td>
                <td>{{ $training->periode }}</td>
                <td>
                    <div class="d-flex justify-content-evenly">
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahModal"
                            onclick="setData('{{ $training->id }}', '{{ $training->nama }}', '{{ $training->deskripsi }}', '{{ $training->periode }}')">
                            Ubah
                        </button>
                        <form action="/training" method="post">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="id" value="{{ $training->id }}">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
  
  <!-- Modal -->
  <div class="modal fade" id="tambahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="tambahModalLabel">Tambah</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/training" method="post" id="tambahForm">
            @csrf
            <div class="mb-3">
              <label>Nama</label>
              <input type="text" name="nama" class="form-control">
            </div>
            <div class="mb-3">
              <label>Deskripsi</label>
              <textarea name="deskripsi" class="form-control"></textarea>
            </div>
            <div class="mb-3">
              <label>Periode</label>
              <input type="date" name="periode" class="form-control">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" form="tambahForm">Submit</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="ubahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ubahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="ubahModalLabel">Ubah</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" id="ubahForm">
            @csrf
            @method('put')
            <div class="mb-3">
              <label>Nama</label>
              <input type="text" name="nama" class="form-control" id="ubahNama">
            </div>
            <div class="mb-3">
              <label>Deskripsi</label>
              <textarea name="deskripsi" class="form-control" id="ubahDeskripsi"></textarea>
            </div>
            <div class="mb-3">
              <label>Periode</label>
              <input type="date" name="periode" class="form-control" id="ubahPeriode">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" form="ubahForm">Submit</button>
        </div>
      </div>
    </div>
  </div>

<script>
    function setData(id, nama, deskripsi, periode) {
        ubahForm.action = '/training/' + id + '/update';
        ubahNama.value = nama;
        ubahDeskripsi.value = deskripsi;
        ubahPeriode.value = periode;
    }
</script>
@endsection