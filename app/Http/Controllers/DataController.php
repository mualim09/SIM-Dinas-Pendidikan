<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;
use DateTime;

class DataController extends Controller
{
    public function index()
    {
        $data = DB::table('data')->where('status', 0)->get();
        // dd($data);
        return view('data.index',['data' => $data]);
    }

    public function level_1()
    {
        $data = DB::table('data')->where('status', 1)->get();
        return view('data.level1',['data' => $data]);
    }

    public function level_2()
    {
        $data = DB::table('data')->where('status', 2)->get();
        return view('data.level1',['data' => $data]);
    }

    public function level_3()
    {
        $data = DB::table('data')->where('status', 3)->get();
        return view('data.level1',['data' => $data]);
    }

    public function simpan(Request $request)
    {
        DB::table('data')->insert([
            'bulan'             => $request->input('bulan'), 
            'tahun'             => $request->input('tahun'),
            'tipe'              => $request->input('tipe'),
            'nama_program'      => $request->input('nama_program'),
            'rekening_kegiatan' => $request->input('rekening_kegiatan'),
            'sub_kegiatan'      => $request->input('sub_kegiatan'),
            'pekerjaan'         => $request->input('pekerjaan'),
            'apbd'              => $request->input('apbd'),
            'nilai'             => $request->input('nilai'),
            'status'            => $request->input('status')
        ]);
        return redirect('data');
    }

    public function update(Request $request, $id)    
    {
        DB::table('data')->where('id_data',$id)->update([
            'status' => 2,
        ]);
        return redirect('data');
    }

    public function CetakCover(Request $request, $id)
    {       
        $data = DB::table('data')->where('id_data',$id)->first();
        // dd($data);
        if ($data->tipe=='GU') {  
            $dateObj = DateTime::createFromFormat('!m', $data->bulan);
            $monthName = $dateObj->format('F');
            $mpdf = new Mpdf(['debug'=>FALSE,'mode' => 'utf-8', 'format' => 'A4-P']);
            $mpdf->WriteHTML('
                <div style="border: 2px solid black; height: 600px">
                    <div style="text-align: center;font-size:30px">
                        SPJ - '.$data->tipe.'<br> BULAN '.strtoupper($monthName).' '.$data->tahun.'
                    </div>
                    <br>
                    <div style="text-align:center;">
                        <img class="" src="./images/logo-gresik.png" alt="" style="width:15%;">
                    </div>
                    <br>
                    <div style="text-align: center;font-size:18px;border: 2px solid black;width: 90%;margin: auto;">
                        NOMOR DPA : <br>
                        <br>
                        PROGRAM : <br>
                        '.$data->nama_program.' <br>
                        KODE REKENING KEGIATAN :<br>
                        '.$data->rekening_kegiatan.'<br>
                        NAMA KEGIATAN : <br>
                        '.$data->rekening_kegiatan.'<br>
                        NAMA SUB KEGIATAN : <br>
                        '.$data->sub_kegiatan.'<br>
                        UNIT : <br>
                        PEKERJAAN : <br>
                        '.$data->pekerjaan.'<br>
                        APBD TAHUN '.$data->apbd.'
                    </div><br>
                    <div style="text-align: center;font-size:18px;border: 2px solid black;width: 90%; margin: auto;-top: 25px;">
                        NILAI AJUAN PENCAIRAN : RP. '.number_format($data->nilai, 0, ".", ".").'
                    </div>
                    <br>
                    <div style="text-align: center;font-size:15px;width: 80%; margin: auto;-top: 25px;">
                        PEMERINTAH KABUPATEN GRESIK <br>
                        DINAS PENDIDIKAN KABUPATEN GRESIK <br>
                        Alamat: Jl. Arif Rahman Hakim No. 02 Gresik
                    </div>
                    
                <hr style="height:2px; color:#000;background-color:#000;">
                    <div style="width:50%;float:left">
                    <table style="width:90%;border: 2px solid SlateBlue;border-collapse: collapse; margin-left:15px;">
                        <tr>
                            <td colspan="3" style="text-align:center;border: 2px solid SlateBlue;
                            border-collapse: collapse; color:SlateBlue;">SUBBAG KEUANGAN</td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align:center;border: 2px solid SlateBlue;
                            border-collapse: collapse; color:SlateBlue;">REGISTER SPJ</td>
                        </tr>
                        <tr>
                            <td style="text-align:center; border: 2px solid SlateBlue;border-collapse: collapse; color:SlateBlue;">GU</td>
                            <td style="text-align:center; border: 2px solid SlateBlue;border-collapse: collapse; color:SlateBlue;">LS</td>
                            <td style="text-align:center; border: 2px solid SlateBlue;border-collapse: collapse; color:SlateBlue;">PPK</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border: 2px solid SlateBlue;border-collapse: collapse; color:SlateBlue;">
                                <br>NO : ......... <br><br>
                                <br>TGL : ......... <br>
                            </td>
                            <td></td>
                        </tr>
                    </table>
                    </div>
                    <div style="width:50%;">
                    <table style="width:95%;border: 2px solid SlateBlue;border-collapse: collapse;">
                        <tr>
                            <td colspan="3" style="text-align:center;border: 2px solid SlateBlue;
                            border-collapse: collapse; color:SlateBlue;">SUBBAG KEUANGAN</td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align:center;border: 2px solid SlateBlue;
                            border-collapse: collapse; color:SlateBlue;">TELAH DI VERIFIKASI</td>
                        </tr>
                        <tr>
                            <td style="text-align:center; border: 2px solid SlateBlue;border-collapse: collapse; color:SlateBlue;">GU</td>
                            <td style="text-align:center; border: 2px solid SlateBlue;border-collapse: collapse; color:SlateBlue;">LS</td>
                            <td style="text-align:center; border: 2px solid SlateBlue;border-collapse: collapse; color:SlateBlue;">PPK</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border: 2px solid SlateBlue;border-collapse: collapse; color:SlateBlue;">
                                <p>NO : ......... </p><br><br>
                                <br><p>TGL : ......... </p><br>
                            </td>
                            <td style="text-align:center; color:SlateBlue;">
                                <hr style="margin-top:80px; height:3px; color:SlateBlue;background-color:SlateBlue;">
                                <br>PEMBANTU PPK<br>
                                <hr style="margin-bottom:80px; height:3px; color:SlateBlue;background-color:SlateBlue;">
                            </td>
                        </tr>
                    </table>              
                    </div>
                </div>
                
            ');    
        }else {
            $dateObj = DateTime::createFromFormat('!m', $data->bulan);
            $monthName = $dateObj->format('F');
            $mpdf = new Mpdf(['debug'=>FALSE,'mode' => 'utf-8', 'format' => 'A4-P']);
            $mpdf->WriteHTML('
                <div style="border: 2px solid black; height: 600px">
                    <div style="text-align: center;font-size:30px">
                        SPJ - '.$data->tipe.'<br> (TERMIN - 2)
                    </div>
                    <div style="text-align: center;font-size:18px;border: 2px solid black;width: 90%;margin: auto;">
                        <br>
                        PEKERJAAN : <br>
                        '.$data->pekerjaan.'<br>
                        NAMA KEGIATAN : <br>
                        '.$data->rekening_kegiatan.'<br>
                        PROGRAM : <br>
                        '.$data->nama_program.' <br>
                        KODE REKENING KEGIATAN :<br>
                        '.$data->rekening_kegiatan.'<br>
                        PENYEDIA : <br>
                        
                        APBD TAHUN '.$data->apbd.'
                    </div><br>
                    <div style="text-align: center;font-size:18px;border: 2px solid black;width: 90%; margin: auto;-top: 25px;">
                        NILAI AJUAN PENCAIRAN : RP. '.number_format($data->nilai, 0, ".", ".").'
                    </div>
                    <br>
                    <div style="text-align: center;font-size:15px;width: 80%; margin: auto;-top: 25px;">
                        <img class="" src="./images/logo-gresik.png" alt="" style="width:15%;">
                        <p>PEMERINTAH KABUPATEN GRESIK <br>
                        DINAS PENDIDIKAN KABUPATEN GRESIK</p> 
                    </div>
                    <hr style="height:2px; color:#000;background-color:#000;">
                    <div style="width:50%;float:left">
                    <table style="width:90%;border: 2px solid SlateBlue;border-collapse: collapse; margin-left:15px;">
                        <tr>
                            <td colspan="3" style="text-align:center;border: 2px solid SlateBlue;
                            border-collapse: collapse; color:SlateBlue;">SUBBAG KEUANGAN</td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align:center;border: 2px solid SlateBlue;
                            border-collapse: collapse; color:SlateBlue;">REGISTER SPJ</td>
                        </tr>
                        <tr>
                            <td style="text-align:center; border: 2px solid SlateBlue;border-collapse: collapse; color:SlateBlue;">GU</td>
                            <td style="text-align:center; border: 2px solid SlateBlue;border-collapse: collapse; color:SlateBlue;">LS</td>
                            <td style="text-align:center; border: 2px solid SlateBlue;border-collapse: collapse; color:SlateBlue;">PPK</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border: 2px solid SlateBlue;border-collapse: collapse; color:SlateBlue;">
                                <br>NO : ......... <br><br>
                                <br>TGL : ......... <br>
                            </td>
                            <td></td>
                        </tr>
                    </table>
                    <br>
                    <table style="width:90%;border: 2px solid SlateBlue;border-collapse: collapse; margin-left:15px;">
                        <tr>
                            <td colspan="3" style="text-align:center;border: 2px solid SlateBlue;
                            border-collapse: collapse; color:SlateBlue;">SPP / SPM</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border: 2px solid SlateBlue;border-collapse: collapse; color:SlateBlue;">
                                <br>NO : ......... <br><br>
                                <br>TGL : ......... <br>
                            </td>
                        </tr>
                    </table>
                    </div>
                    <div style="width:50%;">
                    <table style="width:95%;border: 2px solid SlateBlue;border-collapse: collapse;">
                        <tr>    
                            <td colspan="3" style="text-align:center;border: 2px solid SlateBlue;
                            border-collapse: collapse; color:SlateBlue;">SUBBAG KEUANGAN</td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align:center;border: 2px solid SlateBlue;
                            border-collapse: collapse; color:SlateBlue;">TELAH DI VERIFIKASI</td>
                        </tr>
                        <tr>
                            <td style="text-align:center; border: 2px solid SlateBlue;border-collapse: collapse; color:SlateBlue;">GU</td>
                            <td style="text-align:center; border: 2px solid SlateBlue;border-collapse: collapse; color:SlateBlue;">LS</td>
                            <td style="text-align:center; border: 2px solid SlateBlue;border-collapse: collapse; color:SlateBlue;">PPK</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border: 2px solid SlateBlue;border-collapse: collapse; color:SlateBlue;">
                                <p>NO : ......... </p><br><br>
                                <br><p>TGL : ......... </p><br>
                            </td>
                            <td style="text-align:center; color:SlateBlue;">
                                <hr style="margin-top:80px; height:3px; color:SlateBlue;background-color:SlateBlue;">
                                <br>PEMBANTU PPK<br>
                                <hr style="margin-bottom:80px; height:3px; color:SlateBlue;background-color:SlateBlue;">
                            </td>
                        </tr>
                    </table>              
                    </div>
                </div>
                
            ');
        }
        $mpdf->Output('Jogjatech_Laporan_data_pegawai.pdf','I');
        exit;
    }
}
