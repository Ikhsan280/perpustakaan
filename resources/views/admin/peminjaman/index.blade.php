@extends('adminlte::page')

@section('title','Peminjaman')

@section('content_header')

<br>
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @include('layouts._flash')
                   <b>Buku Yang Sedang Dipinjam</b>
                    <a href="{{route('peminjaman.create')}}" class="btn btn-sm btn-outline-primary float-right"><i>Tambah Peminjam</i></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="pinjam">
                            <thead>
                            <tr>
                                <th><i>ID Peminjam</i></th>
                                <th><i>Buku</i></th>
                                <th><i>Anggota</i></th>
                                <th><i>Tanggal Pinjam</i></th>
                                <th><i>Tanggal Kembali</i></th>
                                <th><i>Durasi Pinjam</i></th>
                                <th><i>Denda</i></th>
                                <th><i>Action</i></th>


                            </tr>
                            </thead>
                            <tbody>
                            @php $no=1; @endphp
                            @foreach ($pinjam as $data)
                             <tr>
                                 <td>{{$no++}}</td>
                                 <td>{{$data->bukus->judul_buku}}</td>
                                 <td>{{$data->anggotas->nama_anggota}}</td>
                                 <td>{{$data->tanggal_pinjam}}</td>
                                 <td>{{$data->tanggal_kembali}}</td>

                                 <th>
                                        <?php
                                            $datetime2 = strtotime($data->tanggal_kembali) ;
                                            $datenow = strtotime(date("Y-m-d"));
                                            $durasi = ($datetime2 - $datenow) / 86400 ;
                                        ?>
                                        @if ($durasi < 0 )
                                            Durasi Habis / {{ $durasi }} Hari
                                        @else
                                            {{ $durasi }} Hari
                                        @endif
                                    </th>
                                    <th>
                                        @if ($durasi < 0)
                                            <?php $denda = abs($durasi) * 1500 ; ?>
                                            {{ $denda }}
                                        @else
                                            0
                                        @endif
                                    </th>





                                 <td>
                                     <form action="{{route('peminjaman.destroy',$data->id)}}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Apakah anda yakin mengembalikan')">KEMBALIKAN</button>
                                    </form>
                                 </td>
                             </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('DataTables/datatables.min.css')}}">
    
@endsection

@section('js')
<script  type="text/javascript" src="{{asset('DataTables/datatables.min.js')}}"> </script>
<script>
    $(document).ready(function(){
        $('#pinjam').DataTable();
    });
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('js/sweetalert2.js')}}"></script>
<script src="{{asset('js/delete.js')}}"></script>

@endsection

