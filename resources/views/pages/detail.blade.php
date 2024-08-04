@extends('layouts.app')


@section('content')

    <div class="container">

        <h2 class="my-3">Detail Blanko</h2>

        <div class="card border-0 shadow-lg rounded-50">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table" style="border: white">
                            <tr>
                                <td>Nama</td>
                                <td>{{$blanko->nama}}</td>
                            </tr>
                            <tr>
                                <td>Tipe</td>
                                <td>{{$blanko->tipe}}</td>
                            </tr>

                            <tr>
                                <td>Status</td>
                                <td>
                                    @if($blanko->status == 1)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                            </tr>


                            <tr>
                                <td>Alamat</td>
                                <td style="width: 500px;">{{wilayah('province', $blanko->provinsi)}} , {{wilayah('regency', $blanko->kabupaten)}}, {{wilayah('district', $blanko->kecamatan)}}, {{wilayah('village', $blanko->desa)}} </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">

                        <table class="table" style="border: white">
                            <tr>
                                <td>Maps</td>
                                <td>
                                    <a href="{{$blanko->maps}}" target="_blank" class="btn btn-primary">Lihat Maps</a>
                                </td>
                            </tr>
                            <tr class="mt-3">
                                <td class="align-top">Foto Rumah</td>
                                <td>
                                    <img src="{{asset('images/'.$blanko->foto)}}" class="img-fluid" alt="{{$blanko->nama}}">
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
