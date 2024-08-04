@extends('layouts.app')

@section('content')

    <div class="container">

        <h2 class="my-3">Edit Blanko</h2>

        <div class="card border-0 shadow-lg rounded-50">
            <div class="card-body">
                <form action="{{ route('blanko.update', $blanko->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ $blanko->nama }}">
                            </div>
                            <div class="mb-3">
                                <label for="tipe" class="form-label">Tipe</label>
                                <select name="tipe" id="tipe" class="form-control">
                                    <option value="VIP" {{ $blanko->tipe == 'VIP' ? 'selected' : '' }}>VIP</option>
                                    <option value="VVIP" {{ $blanko->tipe == 'VVIP' ? 'selected' : '' }}>VVIP</option>
                                    <option value="Normal" {{ $blanko->tipe == 'Normal' ? 'selected' : '' }}>Normal</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="provinsi" class="form-label">Provinsi</label>
                                <select name="provinsi" class="form-control" id="provinsi" data-value="{{ $blanko->provinsi }}"></select>
                            </div>
                            <div class="mb-3">
                                <label for="kabupaten" class="form-label">Kabupaten</label>
                                <select name="kabupaten" class="form-control" id="kabupaten" data-value="{{ $blanko->kabupaten }}" disabled></select>
                            </div>
                            <div class="mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <select name="kecamatan" class="form-control" id="kecamatan" data-value="{{ $blanko->kecamatan }}" disabled></select>
                            </div>
                            <div class="mb-3">
                                <label for="desa" class="form-label">Desa</label>
                                <select name="desa" class="form-control" id="desa" data-value="{{ $blanko->desa }}" disabled></select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="maps" class="form-label">Maps</label>
                                <input type="text" class="form-control" id="maps" name="maps" value="{{ $blanko->maps }}">
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" class="form-control" id="foto" name="foto">
                                @if ($blanko->foto)
                                    <img src="{{ asset('storage/' . $blanko->foto) }}" alt="Current Photo" class="img-thumbnail mt-2" width="150">
                                @endif
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>

                @push('scripts')
                    <script>
                        $(document).ready(function() {
                            function initializeSelect2(selector, url, type, selectedValue) {
                                $(selector).select2({
                                    ajax: {
                                        url: url,
                                        dataType: 'json',
                                        delay: 250,
                                        data: function(params) {
                                            return {
                                                q: params.term,
                                            };
                                        },
                                        processResults: function(data) {
                                            return {
                                                results: data.map(function(item) {
                                                    return {
                                                        id: item.id,
                                                        text: item.name
                                                    }
                                                })
                                            };
                                        }
                                    }
                                });

                                // Fetch the preselected item, and add to the control
                                var studentSelect = $(selector);
                                $.ajax({
                                    type: 'GET',
                                    url: "https://www.emsifa.com/api-wilayah-indonesia/api/" + type + "/" + selectedValue + ".json"
                                }).then(function (data) {
                                    // create the option and append to Select2
                                    var option = new Option(data.name, data.id, true, true);
                                    studentSelect.append(option).trigger('change');

                                    // manually trigger the `select2:select` event
                                    studentSelect.trigger({
                                        type: 'select2:select',
                                        params: {
                                            data: data
                                        }
                                    });
                                });
                            }

                            var provinsiId = $('#provinsi').data('value');
                            var kabupatenId = $('#kabupaten').data('value');
                            var kecamatanId = $('#kecamatan').data('value');
                            var desaId = $('#desa').data('value');

                            console.log(provinsiId, kabupatenId, kecamatanId, desaId);

                            initializeSelect2('#provinsi', 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json' , 'province', provinsiId);

                            $('#provinsi').on('select2:select', function(e) {
                                var data = e.params.data;

                                $('#kabupaten').prop('disabled', false);
                                initializeSelect2('#kabupaten', 'https://www.emsifa.com/api-wilayah-indonesia/api/regencies/' + data.id + '.json', 'regency', kabupatenId);
                            });

                            $('#kabupaten').on('select2:select', function(e) {
                                var data = e.params.data;
                                $('#kecamatan').prop('disabled', false);
                                initializeSelect2('#kecamatan', 'https://www.emsifa.com/api-wilayah-indonesia/api/districts/' + data.id + '.json', 'district', kecamatanId);
                            });

                            $('#kecamatan').on('select2:select', function(e) {
                                var data = e.params.data;
                                $('#desa').prop('disabled', false);
                                initializeSelect2('#desa', 'https://www.emsifa.com/api-wilayah-indonesia/api/villages/' + data.id + '.json','village', desaId);
                            });
                        });
                    </script>
                @endpush
            </div>
        </div>
    </div>

@endsection
