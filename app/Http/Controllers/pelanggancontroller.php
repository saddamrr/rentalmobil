<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pelanggan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

class pelanggancontroller extends Controller
{
    public function store(Request $req){
        if(Auth::user()->level=='petugas') {
            $validator=Validator::make($req->all(),[
                'nama_pelanggan' => 'required',
                'no_ktp' => 'required',
                'alamat' => 'required',
                'no_telp' => 'required',
                'foto' => 'required',
              ]);
              if($validator->fails()){
                return Response()->json($validator->errors());
              }
        
              $simpan=Pelanggan::create([
                  'nama_pelanggan' => $req->nama_pelanggan,
                  'no_ktp' => $req->no_ktp,
                  'alamat' => $req->alamat,
                  'no_telp' => $req->no_telp,
                  'foto' => $req->foto,
              ]);
              if($simpan){
                  $data['status']="Berhasil";
                  $data['message']="Data Pelanggan berhasil disimpan!";
                  return Response()->json($data);
              }else{
                  $data['status']="Gagal";
                  $data['message']="Data Pelanggan gagal disimpan!";
                  return Response()->json($data);
            }
    } else {
            $data['status']="Gagal";
            $data['Message']="Anda bukan Petugas!";
            return Response()->json($data);
        }
    }
  
    public function update($id,Request $req)
    {
        if (Auth::user()->level=='admin') {
            $validator=Validator::make($req->all(),
            [
                'nama_pelanggan' => 'required',
                'no_ktp' => 'required',
                'alamat' => 'required',
                'no_telp' => 'required',
                'foto' => 'required',
            ]);
    
            if($validator->fails()){
                return Response()->json($validator->errors());
            }
            $ubah=Pelanggan::where('id', $id)->update([
                  'nama_pelanggan' => $req->nama_pelanggan,
                  'no_ktp' => $req->no_ktp,
                  'alamat' => $req->alamat,
                  'no_telp' => $req->no_telp,
                  'foto' => $req->foto,
            ]);
            if($ubah){
                $data['status']="Berhasil";
                $data['message']="Data Pelanggan berhasil diubah!";
                return Response()->json($data);
            }else{
                $data['status']="Gagal";
                $data['message']="Data Pelanggan gagal diubah!";
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
            $hapus=Pelanggan::where('id',$id)->delete();
            if($hapus){
                $data['status']="Berhasil";
                $data['message']="Data Pelanggan berhasil dihapus!";
                return Response()->json($data);
            }else{
                $data['status']="Gagal";
                $data['message']="Data Pelanggan gagal dihapus!";
                return Response()->json($data);
            }
        } else {
            $data['status']="Gagal";
            $data['Message']="Anda bukan Admin!";
            return Response()->json($data);
        }
    }
      public function show(){
        if(Auth::user()->level=='admin'){
            $data_pelanggan=Pelanggan::get();
            return Response()->json($data_pelanggan);
        } else {
            $data['status']="Gagal";
            $data="Anda bukan Admin!";
            return Response()->json($data);
        }
      }
}
