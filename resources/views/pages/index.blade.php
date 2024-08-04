@extends('layouts.app')

@section('content')
    <div class="container">

        <h2>Blanko</h2>

        <div class="d-flex justify-content-between my-3">
            <form action="{{route('blanko.index') . "?search=" . request()->get('search') }}"  method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari Blanko" name="search" value="{{request()->get('search')}}">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                </div>
            </form>
            <a href="{{route('blanko.create')}}" class="btn btn-sm btn-primary">
                Tambah Blanko
            </a>
        </div>

        <div class="table table-responsive">

            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Tipe</th>
                        <th>Map</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blanko as $blk)
                        <tr>
                            <td>{{$blk->id}}</td>
                            <td>{{$blk->nama}}</td>
                            <td>{{$blk->tipe}}</td>
                            <td>
                                <a href="{{$blk->maps}}" target="_blank" class="btn btn-sm btn-success">
                                    Maps
                                </a>
                            </td>
                            <td>
                                @if($blk->status == 1)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('blanko.show', $blk->id)}}" class="btn btn-sm btn-success">
                                    Detail
                                </a>
                                <a href="{{route('blanko.edit', $blk->id)}}" class="btn btn-sm btn-secondary">
                                    Edit
                                </a>
                                <a href="{{route('blanko.delete', $blk->id)}}" class="btn btn-sm btn-danger">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{$blanko->links()}}
        </div>
    </div>



@endsection
