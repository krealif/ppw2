@extends('layouts.app')
@section('content')
<section class="container-xl my-4">
  <h3>Data Buku</h3>
  @if (Session::has('message'))
  <div class="alert alert-success">{{ Session::get('message') }}</div>
  @endif
  <div class="d-flex flex-row my-3">
    <form class="w-100 me-2" action="{{ route('buku.search') }}" method="GET">
        @csrf
        <div class="input-group">
          <input type="text" class="form-control" name="kata" placeholder="Cari...">
          <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>
    <div>
      <a href="{{ route('buku.create') }}"><button class="btn btn-primary">Tambah</button></a>
    </div>
  </div>
  <table class="table table-hover mt-3">
    <thead>
      <tr class="table-light">
        <th scope="col">ID</th>
        <th scope="col">Judul</th>
        <th scope="col">Penulis</th>
        <th scope="col">Harga</th>
        <th scope="col">Terbit</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($dataBuku as $buku)
      <tr>
        <td>{{ ++$no }}</td>
        <td>{{ $buku->judul }}</td>
        <td>{{ $buku->penulis }}</td>
        <td>{{ "Rp ".number_format($buku->harga, 2, ',', '.') }}</td>
        <td>{{ $buku->tgl_terbit->format('d/m/Y') }}</td>
        <td>
          <div class="d-flex gap-2">
            <a href="{{ route('buku.like', $buku->id) }}" class="btn btn-outline-primary">
              <i class="fa fa-thumbs-up"></i>
              {{ $buku->suka }}
            </a>
            <a href="{{ route('buku.detail', $buku->buku_seo )}}"><button class="btn btn-outline-primary">Detail</button></a>
            <a href="{{ route('buku.edit', $buku->id )}}"><button class="btn btn-outline-primary">Update</button></a>
            <form method="POST" action="{{ route('buku.destroy', $buku->id) }}">
              @csrf
              <button class="btn btn btn-outline-primary" onclick="return confirm('Yakin mau dihapus?')">Hapus</button>
            </form>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div>{{ $dataBuku->links() }}</div>
  <p>Jumlah Buku {{ $jumlahBuku }}</p>
</section>
@endsection