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
            <th scope="col">Nama Training</th>
            <th scope="col">Nama Kelompok</th>
            <th scope="col">Deskripsi</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($kelompoks as $kelompok)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $kelompok->training->nama }}</td>
                <td>{{ $kelompok->nama }}</td>
                <td>{{ $kelompok->deskripsi }}</td>
                <td>
                    <div class="d-flex justify-content-evenly">
                        <a href="/kelompok/{{ $kelompok->id }}/materi" class="btn btn-success">Materi</a>
                        <a href="/kelompok/{{ $kelompok->id }}/kuis" class="btn btn-success">Kuis</a>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahModal"
                            onclick="setData('{{ $kelompok->id }}', '{{ $kelompok->training_id }}', '{{ $kelompok->nama }}', '{{ $kelompok->deskripsi }}')">
                            Ubah
                        </button>
                        <form action="/kelompok" method="post">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="id" value="{{ $kelompok->id }}">
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
          <form action="/kelompok" method="post" id="tambahForm">
            @csrf
            <div class="mb-3">
              <select name="training_id" class="form-control">
                @foreach ($trainings as $training)
                    <option value="{{ $training->id }}">{{ $training->nama }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label>Nama</label>
              <input type="text" name="nama" class="form-control">
            </div>
            <div class="mb-3">
              <label>Deskripsi</label>
              <textarea name="deskripsi" class="form-control"></textarea>
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
              <select name="training_id" class="form-control" id="ubahTrainingID">
                @foreach ($trainings as $training)
                    <option value="{{ $training->id }}">{{ $training->nama }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label>Nama</label>
              <input type="text" name="nama" class="form-control" id="ubahNama">
            </div>
            <div class="mb-3">
              <label>Deskripsi</label>
              <textarea name="deskripsi" class="form-control" id="ubahDeskripsi"></textarea>
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
    function setData(id, trainingID, nama, deskripsi) {
        ubahForm.action = '/kelompok/' + id + '/update';
        ubahTrainingID.value = trainingID;
        ubahNama.value = nama;
        ubahDeskripsi.value = deskripsi;
    }
</script>
@endsection