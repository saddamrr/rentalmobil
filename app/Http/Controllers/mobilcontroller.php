<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mobil;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

class mobilcontroller extends Controller
{
    public function store(Request $req){
        if(Auth::user()->level=='petugas'){
            $validator=Validator::make($req->all(),[
                'id_jenis_mobil' => 'required',
                'plat_mobil' => 'required',
                'biaya_sewa' => 'required',
                'tahun_pembuatan' => 'required',
            ]);
            if($validator->fails()){
                return response()->json($validator->errors());
            }

            $simpan=Mobil::create([
                'id_jenis_mobil' => $req->id_jenis_mobil,
                'plat_mobil' => $req->plat_mobil,
                'biaya_sewa' => $req->biaya_sewa,
                'tahun_pembuatan' => $req->tahun_pembuatan,
            ]);
            if($simpan){
                $data['status']="Berhasil";
                $data['message']="Data Mobil berhasil disimpan!";
                return Response()->json($data);
            }else{
                $data['status']="Gagal";
                $data['message']="Data Mobil gagal disimpan!";
                return Response()->json($data);
            }
        } else {
            $data['status']="Gagal";
            $data['Message']="Anda bukan Petugas!";
            return Response()->json($data);
        }
    }
    
    public function update($id, Request $req){
        if(Auth::user()->level=='admin'){
            $validator=Validator::make($req->all(),[
                'id_jenis_mobil' => 'required',
                'plat_mobil' => 'required',
                'biaya_sewa' => 'required',
                'tahun_pembuatan' => 'required',
            ]);

            if($validator->fails()){
                return response()->json($validator->errors());
            }

            $ubah=Mobil::where('id', $id)->update([
                'id_jenis_mobil' => $req->id_jenis_mobil,
                'plat_mobil' => $req->plat_mobil,
                'biaya_sewa' => $req->biaya_sewa,
                'tahun_pembuatan' => $req->tahun_pembuatan,
            ]);
            if($ubah){
                $data['status']="Berhasil";
                $data['message']="Data Mobil berhasil diubah!";
                return Response()->json($data);
            }else{
                $data['status']="Gagal";
                $data['message']="Data Mobil gagal diubah!";
                return Response()->json($data);
            }
        } else {
            $data['status']="Gagal";
            $data['Message']="Anda bukan Admin!";
            return Response()->json($data);
        }
    }

    public function destroy($id){
        if (Auth::user()->level=='admin') {
            $hapus=Mobil::where('id', $id)->delete();
            if($hapus){
                $data['status']="Berhasil";
                $data['message']="Data Mobil berhasil dihapus!";
                return Response()->json($data);
            }else{
                $data['status']="Gagal";
                $data['message']="Data Mobil gagal dihapus!";
                return Response()->json($data);
            }
        }  else {
            $data['status']="Gagal";
            $data['Message']="Anda bukan Admin!";
            return Response()->json($data);
        }
    }

    public function show(){
        if (Auth::user()->level=='admin') {
            $data_mobil=Mobil::get();
            $data['Data Mobil']=$data_mobil;
            return response()->json($data);
        } else {
            $data['status']="Gagal";
            $data['Message']="Anda bukan Admin!";
            return Response()->json($data);
        }
    } 
}
