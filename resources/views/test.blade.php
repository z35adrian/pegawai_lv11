
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tabel Data Pegawai</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">dashboard</a></li>
              <li class="breadcrumb-item active">data Pegawai</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <a href="{{ url('admin/create') }}" class="btn btn-md btn-primary mb-3">TAMBAH PEGAWAI</a>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Tempat Lahir</th>
                            <th>tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Jabatan</th>
                            <th>Tanggal Masuk</th>
                            <th>Job</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td class="text-center">
                                    <img src="{{ asset('/storage/posts/' . $post->image) }}" class="rounded"
                                        style="width: 90px">
                                </td>
                                <td>{{ $post->nama }}</td>
                                <td>{{ $post->alamat }}</td>
                                <td>{{ $post->tempat_lahir }}</td>
                                <td>{{ $post->tgl_lahir }}</td>
                                <td>{{ $post->kelamin }}</td>
                                <td>{{ $post->jabatan }}</td>
                                <td>{{ $post->tgl_masuk }}</td>
                                <td>{{ $post->jobdesc }}</td>

                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                        action="{{ url('admin/destroy', $post->id) }}" method="POST">
                                        <a href="{{ url('admin/show', $post->id) }}"
                                            class="btn btn-sm btn-warning">SHOW</a>
                                        <a href="{{ url('admin/edit', $post->id) }}"
                                            class="btn btn-sm btn-primary">EDIT</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data Post belum Tersedia.
                            </div>
                        @endforelse
                    </tbody>
                </table>
                {{ $posts->links() }}
            </div>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script>
        //message with toastr
        @if(session()->has('success'))

            toastr.success('{{ session('success') }}', 'BERHASIL!');

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!');

        @endif
    </script>
