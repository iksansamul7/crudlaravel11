<?php

namespace App\Http\Controllers;

use App\Exports\contohExport;
use App\Models\contoh;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ContohController extends Controller
{
// tampilan utama
    public function index(Request $request){
        //perulangan if dibawah digunakan untuk search
        if ($request->has('search')) {
            $data = contoh::where('nama', 'LIKE', '%' .$request->search. '%')->paginate(2);
        } else {
    //paginate digunakan untuk membatasi data yang ditampilkan sebanyak 2 
            $data = contoh::paginate(2);
        }
        return view('pegawai',compact('data'));
    }
//insert data
    public function tambahpegawai(){
        return view('tambahdata');
    }

    public function insertdata (Request $request){
        $data = contoh::create($request->all());
        //dibawah ini script untuk input file berupa gambar, dengan data diatas dimasukan kedalam array , lalu ditampilkan di blade dengan img src
        if($request->hasfile('foto')){
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        //script gambar sampai sini 
        return redirect()->route('pegawai')->with('success' ,'Data berhasil ditambahkan');
    }

//update data

    public function tampildata($id){
        $data = contoh::find($id);
        return view('tampildata',compact('data'));
    }

    public function updatedata (Request $request, $id){
        $data = contoh::find($id);
        $data->update($request->all());
        return redirect()->route('pegawai')->with('success' ,'Data berhasil diupdate');
    }

//delete

public function delete ($id){
    $data = contoh::find($id);
    $data->delete();
    return redirect()->route('pegawai')->with('success' ,'Data berhasil dihapus');

}
//dibawah untuk melakukan download pdf  , dengan menggnakan plugin Barryvdh facadepdf
public function exportpdf()
{
    $data = contoh::all();
    view()->share('data', $data);
    $pdf = FacadePdf::loadView('pegawai_pdf');
    return $pdf->download('your_file.pdf');
}
//dibawah adalah untuk melakukan download excel 
public function exportexcel(){
    return Excel::download(new contohExport, 'datapegawai.xlsx');
}



}