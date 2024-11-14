<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <h1>contoh pegawai</h1>
    <div class="container">
        <a href="/tambahpegawai" type="button" class="btn btn-success">Tambah</a>
        {{-- form dibawah digunakan untuk search data, digabung dengan controller index --}}
        <div class="row g-3 mt-2">
            <div class="col-auto">
                <a href="/exportpdf" type="button"  class="btn btn-info">PDF</a>
              </div>        
              <div class="col-auto">
                <a href="/exportexcel" type="button"  class="btn btn-success">excel</a>
              </div>
        </div>
        <form class="row g-3 mt-2" action="/pegawai" method="GET">
            @csrf
            <div class="col-auto">
              <input type="search" name="search" class="form-control" id="inputPassword2" placeholder="Masukan kata kunci">
            </div>
            <div class="col-auto">
              <button type="submit" class="btn btn-primary mb-3">Cari</button>
            </div>
        </form>

        <div class="row">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">No telpon</th>
                    <th scope="col">Dibuat </th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    {{--dibawah untuk penomoran yang urut dan digabugnkan dengan pagnation " $index => "--}}
                    @foreach ($data as $index => $item)
                    <tr>
                        {{--dibawah untuk pengulangan penomran yang dimasukan ke dalam th "{{ $index +$data->firstItem() }}"--}}
                        <th scope="row">{{ $index +$data->firstItem() }}</th>
                        <td>{{ $item->nama }}</td>
                        {{-- dibawah adalah untuk menampilkan file gambar dengan img src --}}
                        <td>
                            <img src="{{ asset('fotopegawai/'.$item->foto)}}" style="width: 40px;" alt="">
                        </td>
                        <td>{{ $item->jeniskelamin }}</td>
                        <td>0{{ $item->telpon }}</td>
                        <td>{{ $item->created_at->format('D M Y') }}</td>
                        <td>
                            <a href="/tampildata/{{ $item->id }}"  class="btn btn-warning">Update</a>
                            {{-- dibawah adalah contoh delete yang menggunakan animasi jquery --}}
                            <a href="#" class="btn btn-danger delete" data-id="{{ $item->id }}" data-nama="{{ $item->nama }}" >Delete</a>
                        </td>
                      </tr>
                    @endforeach
                  
                </tbody>
              </table>
              {{-- kode dibawah juga digunakan untuk paginate , dan digabungkan dengan app servis provider yang berada di folder app provider --}}
              {{ $data->links() }}
            
        </div>
    </div>

    {{-- dibawah cdn untuk boostrap  --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    {{-- dibawah cdn untuk jquery konfirmasi delete, sweet alert  --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
       {{-- dibawah cdn toastr notifikasi semua success  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
<script>
    //dibawah adlah scripct jquery diguanakan animasi delete , dipanggil dengan class delete dan variabel nama dan id
    $('.delete').click(function(){
        var pegawaiid = $(this).attr('data-id');
        var pegawainama = $(this).attr('data-nama');
        swal({
            title: "Apa kamu yakin ?",
            text: "Data yang akan dihapus adalah "+pegawainama+"",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            //dibawah merupakan untuk memanggil fungsi menghapus dari route web.php
                window.location = "/delete/"+pegawaiid+""
                swal("BERHASIL, Data mu berhasil dihapus", {
                icon: "success",
        });
        } else {
                swal("Data mu tidak jadi dihapus");
        }
        });
    });
</script>
<script>
    @if(Session::has('success'))
    toastr.success("{{ Session::get('success') }}")
    @endif
</script>
</html>
