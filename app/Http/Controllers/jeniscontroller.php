<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JenisMobil;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

class jeniscontroller extends Controller
{
    public function store(Request $req){
        if (Auth::user()->level=='petugas') {
            $validator=Validator::make($req->all(),[
                'jenis_mobil' => 'required',
            ]);
            if($validator->fails()){
                return response()->json($validator->errors());
            }
    
            $simpan=JenisMobil::create([
                'jenis_mobil' => $req->jenis_mobil,
            ]);
            if($simpan){
                $data['status']="Berhasil";
                $data['message']="Data berhasil disimpan!";
                return Response()->json($data);
            }else{
                $data['status']="Gagal";
                $data['message']="Data gagal disimpan!";
                return Response()->json($data);
            }
        } else {
            $data['status']="Gagal";
            $data['Message']="Anda bukan Petugas!";
            return Response()->json($data);
        }
    }

    public function update($id, Request $req){
        if (Auth::user()->level=='admin') {
            $validator=Validator::make($req->all(),[
                'jenis_mobil' => 'required',
            ]);
    
            if($validator->fails()){
                return response()->json($validator->errors());
            }
            $ubah=JenisMobil::where('id', $id)->update([
                'jenis_mobil' => $req->jenis_mobil,
            ]);
            if($ubah){
                $data['status']="Berhasil";
                $data['message']="Data berhasil diubah!";
                return Response()->json($data);
            }else{
                $data['status']="Gagal";
                $data['message']="Data gagal diubah!";
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
            $hapus=JenisMobil::where('id', $id)->delete();
            if($hapus){
                $data['status']="Berhasil";
                $data['message']="Data berhasil dihapus!";
                return Response()->json($data);
            }else{
                $data['status']="Gagal";
                $data['message']="Data gagal dihapus!";
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
            $data_mobil=JenisMobil::get();
            $data['Jenis Mobil']=$data_mobil;
            return response()->json($data);
        } else {
            $data['status']="Gagal";
            $data['Message']="Anda bukan Admin!";
            return Response()->json($data);
        }
    }
}
