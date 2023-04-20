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
            <th scope="col">Username</th>
            <th scope="col">NIK</th>
            <th scope="col">Nama</th>
            {{-- <th scope="col">Password</th> --}}
            <th scope="col">Gender</th>
            <th scope="col">Tanggal Masuk</th>
            <th scope="col">Status</th>
            <th scope="col">Akses</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($pegawais as $pegawai)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $pegawai->username }}</td>
                <td>{{ $pegawai->nik }}</td>
                <td>{{ $pegawai->name }}</td>
                {{-- <td>{{ $pegawai->password }}</td> --}}
                <td>{{ $pegawai->gender }}</td>
                <td>{{ $pegawai->tanggal_masuk }}</td>
                <td>{{ ($pegawai->status == 1) ? 'Aktif' : 'Non-Aktif' }}</td>
                <td>{{ $pegawai->akses }}</td>
                <td>
                    <div class="d-flex justify-content-evenly">
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahModal"
                            onclick="setData('{{ $pegawai->id }}', '{{ $pegawai->nik }}', '{{ $pegawai->name }}', '{{ $pegawai->username }}', '{{ $pegawai->gender }}', '{{ $pegawai->tanggal_masuk }}', '{{ $pegawai->akses }}')">
                            Ubah
                        </button>
                        <form action="/pegawai" method="post">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="id" value="{{ $pegawai->id }}">
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
          <form action="/pegawai" method="post" id="tambahForm">
            @csrf
            <div class="mb-3">
                <label>NIK</label>
                <input type="text" name="nik" class="form-control">
            </div>
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control">
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="mb-3">
                <label>Gender</label>
                <select name="gender" class="form-control">
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" class="form-control">
            </div>
            <div class="mb-3">
                <label>Hak Akses</label>
                <select name="akses" class="form-control">
                    <option value="admin">Admin</option>
                    <option value="pegawai">Pegawai</option>
                </select>
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
                <label>NIK</label>
                <input type="text" name="nik" class="form-control" id="ubahNIK">
            </div>
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" id="ubahName">
            </div>
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" id="ubahUsername">
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" id="ubahPassword" placeholder="kosongkan jika tidak diubah">
            </div>
            <div class="mb-3">
                <label>Gender</label>
                <select name="gender" class="form-control" id="ubahGender">
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" class="form-control" id="ubahTanggalMasuk">
            </div>
            <div class="mb-3">
                <label>Hak Akses</label>
                <select name="akses" class="form-control" id="ubahAkses">
                    <option value="admin">Admin</option>
                    <option value="pegawai">Pegawai</option>
                </select>
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
    function setData(id, nik, name, username, gender, tanggalMasuk, akses) {
        ubahForm.action = '/pegawai/' + id + '/update';
        ubahNIK.value = nik;
        ubahName.value = name;
        ubahUsername.value = username;
        ubahGender.value = gender;
        ubahTanggalMasuk.value = tanggalMasuk;
        ubahAkses.value = akses;
    }
</script>
@endsection