<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HitungGradeController extends Controller
{
    public function hitung(Request $request){
        $rules = [
            'quiz' => 'required|numeric|min:0|max:100',
            'tugas' => 'required|numeric|min:0|max:100',
            'absensi' => 'required|numeric|min:0|max:100',
            'praktek' => 'required|numeric|min:0|max:100',
            'uas' => 'required|numeric|min:0|max:100',
        ];

        $text = [
            'quiz.required' => 'Nilai quiz harus diisi!',
            'quiz.min' => 'Nilai minimal 0, maksimal 100!',
            'quiz.max' => 'Nilai minimal 0, maksimal 100!',
            'tugas.required' => 'Nilai tugas harus diisi!',
            'tugas.min' => 'Nilai minimal 0, maksimal 100!',
            'tugas.max' => 'Nilai minimal 0, maksimal 100!',
            'absensi.required' => 'Nilai absensi harus diisi!',
            'absensi.min' => 'Nilai minimal 0, maksimal 100!',
            'absensi.max' => 'Nilai minimal 0, maksimal 100!',
            'praktek.required' => 'Nilai praktek harus diisi!',
            'praktek.min' => 'Nilai minimal 0, maksimal 100!',
            'praktek.max' => 'Nilai minimal 0, maksimal 100!',
            'uas.required' => 'Nilai UAS harus diisi!',
            'uas.min' => 'Nilai minimal 0, maksimal 100!',
            'uas.max' => 'Nilai minimal 0, maksimal 100!',
        ];
        
        $validate = Validator::make($request->all(), $rules, $text);

        if ($validate->fails()){
            return response()->json(['success'=> 0, 'errors' => $validate->errors()], 422);
        }

        $quiz = $request->quiz;
        $tugas = $request->tugas;
        $absensi = $request->absensi;
        $praktek = $request->praktek;
        $uas = $request->uas;

        $nilai = ($quiz + $tugas + $absensi + $praktek + $uas)/5;

        if($nilai <= 65){
            $grade = 'D';
        }elseif($nilai <=75){
            $grade = 'C';
        }elseif($nilai <=85){
            $grade = 'B';
        }elseif($nilai <=100){
            $grade = 'A';
        }

        if($grade != NULL){
            return response()->json(['grade' => $grade]);
        }else{
            return response()->json(['text' => 'Periksa Kembali Nilai Yang Dimasukkan'], 400);
        }
    }
}
