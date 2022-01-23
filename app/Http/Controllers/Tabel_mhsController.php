<?php

namespace App\Http\Controllers;

use App\Models\Tabel_mhs;
use Illuminate\Http\Request;

class Tabel_mhsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function index(Request $request)
    {
        // $tabel_mhs = Tabel_mhs::OrderBy("id", "DESC")->paginate(10);
        // $output = [
        //     "message" => "Controller Tabel Mhs",
        //     "results" => $tabel_mhs
        // ];

        $acceptHeader = $request->header('Accept');
        if ($acceptHeader === 'application/json' or $acceptHeader === 'application/xml')
        {
            $tabel_mhs = Tabel_mhs::OrderBy("id", "DESC")->paginate(10);
        //     $output = [
        //     "message" => "Controller Tabel Mhs",
        //     "results" => $tabel_mhs
        // ];

        if ($acceptHeader === 'application/json') {
            return response()->json($tabel_mhs->items('data'), 200);
        }else {
            $xml = new \SimpleXMLElement('<tabel_mhs/>');
            foreach ($tabel_mhs->items('data') as $item) {
                //membuat elemen xml tabel mhs
                $xmlItem = $xml->addChild('tabel_mhs');

                //mengubah setiap field menjadi xml
                $xmlItem = $xml->addChild('id', $item->id);
                $xmlItem = $xml->addChild('nim', $item->nim);
                $xmlItem = $xml->addChild('nama', $item->nama);
                $xmlItem = $xml->addChild('alamat', $item->alamat);
                $xmlItem = $xml->addChild('angkatan', $item->angkatan);
                $xmlItem = $xml->addChild('created_at', $item->created_at);
                $xmlItem = $xml->addChild('update_at', $item->update_at);
            }
            return $xml->asXml();
        }
    }else {
        return response('Not Acceptable!', 406);
    }
    }

    public function store(Request $request)
    {
        $acceptHeader = $request->header('Accept');
        if ($acceptHeader === 'application/json' or $acceptHeader === 'application/xml'){

            $contentTypeHeader = $request->header('Content-Type');

            if ($contentTypeHeader === 'application/json')
            {
             $input = $request->all();
             $tabel_mhs = Tabel_mhs::create($input); 

        return response()->json($tabel_mhs, 200);
    } else {
        return response('Unsupported Media Type', 415);
    }
     }else {
        return response('Not Acceptable!', 406);
    }
    }
    
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $tabel_mhs = Tabel_mhs::find($id);
        if (!$tabel_mhs) {
            abort(404);
        }
        $tabel_mhs->fill($input);
        $tabel_mhs->save();

        return response()->json($tabel_mhs, 200);
    }

    public function delete($id)
    {
        $tabel_mhs = Tabel_mhs::find($id);
        if (!$tabel_mhs) {
            abort(404);
        }
        $tabel_mhs->delete();
        $message = [
            'message' => 'Data Telah Dihapus','id' => $id];

        return response()->json($tabel_mhs, 200);
    }
    //
}
