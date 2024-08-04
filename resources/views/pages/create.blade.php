@extends('layouts.app')

@section('content')

    <div class="container">

        <h2 class="my-3">Tambah Blanko</h2>

        <div class="card border-0 shadow-lg rounded-50">
            <div class="card-body">
                <form action="{{route('blanko.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama">
                            </div>
                            <div class="mb-3">
                                <label for="tipe" class="form-label">Tipe</label>
                                <select name="tipe" id="tipe" class="form-control">
                                    <option value="VIP">VIP</option>
                                    <option value="VVIP">VVIP</option>
                                    <option value="Normal">Normal</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="provinsi" class="form-label">Provinsi</label>
                                <select name="provinsi" class="form-control" id="provinsi"></select>
                            </div>
                            <div class="mb-3">
                                <label for="kabupaten" class="form-label">Kabupaten</label>
                                <select name="kabupaten" class="form-control" id="kabupaten" disabled></select>
                            </div>
                            <div class="mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <select name="kecamatan" class="form-control" id="kecamatan" disabled></select>
                            </div>
                            <div class="mb-3">
                                <label for="desa" class="form-label">Desa</label>
                                <select name="desa" class="form-control" id="desa" disabled></select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="maps" class="form-label">Maps</label>
                                <input type="text" class="form-control" id="maps" name="maps">
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" class="form-control" id="foto" name="foto">
                            </div>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>


                    @push('scripts')
                        <script>
                            $('#provinsi').select2({
                                    ajax: {
                                        url: 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json',
                                        dataType: 'json',
                                        delay: 250,
                                        data: function (params) {
                                            return {
                                                q: params.term, // search term
                                            };
                                        },
                                        processResults: function (data) {
                                            return {
                                                results: data.map(function (item) {
                                                    return {
                                                        id: item.id,
                                                        text: item.name
                                                    }
                                                })
                                            };
                                        },
                                        // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
                                    }
                            });

                            $('#provinsi').on('select2:select', function (e) {
                                var data = e.params.data;
                                $('#kabupaten').prop('disabled', false);
                                $('#kabupaten').select2({
                                    ajax: {
                                        url: 'https://www.emsifa.com/api-wilayah-indonesia/api/regencies/'+data.id+'.json',
                                        dataType: 'json',
                                        delay: 250,
                                        data: function (params) {
                                            return {
                                                q: params.term, // search term
                                            };
                                        },
                                        processResults: function (data) {
                                            return {
                                                results: data.map(function (item) {
                                                    return {
                                                        id: item.id,
                                                        text: item.name
                                                    }
                                                })
                                            };
                                        },
                                        // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
                                    }
                                });
                            });

                            $('#kabupaten').on('select2:select', function (e) {
                                var data = e.params.data;
                                $('#kecamatan').prop('disabled', false);
                                $('#kecamatan').select2({
                                    ajax: {
                                        url: 'https://www.emsifa.com/api-wilayah-indonesia/api/districts/'+data.id+'.json',
                                        dataType: 'json',
                                        delay: 250,
                                        data: function (params) {
                                            return {
                                                q: params.term, // search term
                                            };
                                        },
                                        processResults: function (data) {
                                            return {
                                                results: data.map(function (item) {
                                                    return {
                                                        id: item.id,
                                                        text: item.name
                                                    }
                                                })
                                            };
                                        },
                                        // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
                                    }
                                });
                            });

                            $('#kecamatan').on('select2:select', function (e) {
                                var data = e.params.data;
                                $('#desa').prop('disabled', false);
                                $('#desa').select2({
                                    ajax: {
                                        url: 'https://www.emsifa.com/api-wilayah-indonesia/api/villages/'+data.id+'.json',
                                        dataType: 'json',
                                        delay: 250,
                                        data: function (params) {
                                            return {
                                                q: params.term, // search term
                                            };
                                        },
                                        processResults: function (data) {
                                            return {
                                                results: data.map(function (item) {
                                                    return {
                                                        id: item.id,
                                                        text: item.name
                                                    }
                                                })
                                            };
                                        },
                                        // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
                                    }
                                });
                            });
                        </script>
                    @endpush
@endsection
