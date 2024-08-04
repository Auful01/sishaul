<?php

namespace App\Http\Controllers;

use App\Models\Blanko;
use Illuminate\Http\Request;

class BlankoController extends Controller
{
    public function index(Request $request){
        $filter = ['nama'];
        $blanko = Blanko::where(function($query) use ($request, $filter) {
            foreach ($filter as $f) {
                if ($request->search != null) {
                    $query->orWhereRaw("LOWER($f) LIKE ?", ['%' . strtolower($request->search) . '%']);
                }
            }
        })->paginate(10);

        return view('pages.index', compact('blanko'));
    }

    public function show($id){
        $blanko = Blanko::find($id);
        return view('pages.detail', compact('blanko'));
    }
    public function edit($id){
        $blanko = Blanko::find($id);
        return view('pages.edit', compact('blanko'));
    }

    public function create(){
        return view('pages.create');
    }


    public static function getWilayah($tipe, $id){
        $base_url_ac = 'https://www.emsifa.com/api-wilayah-indonesia/api/';
        $client = new \GuzzleHttp\Client();
        $id = trim($id);
        $response = $client->request('GET', $base_url_ac.$tipe.'/'.$id . '.json');
        $data = json_decode($response->getBody()->getContents(), true);
        return $data['name'];
    }

    public function store(Request $request){

        // $request['provinsi'] = self::getWilayah('province', $request->provinsi);
        // $request['kabupaten'] = self::getWilayah('regency', $request->kabupaten);
        // $request['kecamatan'] = self::getWilayah('district', $request->kecamatan);
        // $request['desa'] = self::getWilayah('village', $request->desa);

        if ($request->hasFile('foto')) {
            $request->validate([
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageName = time().'.'.$request->foto->extension();
            $request->foto->move(public_path('images'), $imageName);
            $request['foto'] = $imageName;
        }


       Blanko::create($request->all());

        return redirect()->route('blanko.index');
    }


    public function delete($id){
        $blanko = Blanko::find($id);
        $blanko->delete();
        return redirect()->route('blanko.index');
    }

    public function update(Request $request, $id){
        $blanko = Blanko::find($id);

        // $request['provinsi'] = self::getWilayah('province', $request->provinsi);
        // $request['kabupaten'] = self::getWilayah('regency', $request->kabupaten);
        // $request['kecamatan'] = self::getWilayah('district', $request->kecamatan);
        // $request['desa'] = self::getWilayah('village', $request->desa);

        if ($request->hasFile('foto')) {
            $request->validate([
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageName = time().'.'.$request->foto->extension();
            $request->foto->move(public_path('images'), $imageName);
            $request['foto'] = $imageName;
        }

        $blanko->update($request->all());

        return redirect()->route('blanko.index');
    }


}
