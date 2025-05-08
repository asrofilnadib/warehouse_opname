<?php

namespace App\Http\Controllers;

use App\Mail\MailManager;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Satuan;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ReportController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $barang = Barang::all();
    return view('report.index', compact('barang'));
  }

  public function filter(Request $request)
  {
    $from = $request->from;
    $id_barang = $request->id_barang;
    $filter = $request->filter;
    $to = $request->to;
    $manager = User::where("role", 'manager')->first();
//    dd($manager);
    $no_manager = $manager->no_telp;
    $email_manager = $manager->email;

    if ($from > $to) {
      return redirect()->route('report')->with('error', "Tanggal Awal tidak boleh lebih dari tanggal akhir");
    }

    $query = Barang::select(
      'barang.id as barang_id',
      'barang.jenis_barang',
      'satuan.name as name_satuan',
      'barang.nama_barang',
      'transaksi_barang.jenis',
      DB::raw('SUM(transaksi_barang.qty) as jumlah')
    )
      ->leftJoin('transaksi_barang', 'barang.id', '=', 'transaksi_barang.id_barang')
      ->leftJoin('satuan', 'barang.id_satuan', '=', 'satuan.id')
      ->where('barang.id', $id_barang);

    if ($filter == "barang_masuk") {
      $query->where('transaksi_barang.jenis', 'masuk');
    } else if ($filter == "barang_keluar") {
      $query->where('transaksi_barang.jenis', 'keluar');
    }

    $query->whereBetween('transaksi_barang.tanggal_transaksi', [$from, $to])
      ->groupBy('transaksi_barang.jenis', 'barang.id', 'barang.nama_barang', 'barang.jenis_barang', 'satuan.name');
    $data = $query->get();

    $query2 = Barang::select(
      'barang.id as barang_id',
      'barang.jenis_barang',
      'satuan.name as name_satuan',
      'transaksi_barang.tanggal_transaksi',
      'barang.nama_barang',
      'transaksi_barang.jenis'
    )
      ->leftJoin('transaksi_barang', 'barang.id', '=', 'transaksi_barang.id_barang')
      ->leftJoin('satuan', 'barang.id_satuan', '=', 'satuan.id')
      ->where('barang.id', $id_barang);

    if ($filter == "barang_masuk") {
      $query2->where('transaksi_barang.jenis', 'masuk');
    } else if ($filter == "barang_keluar") {
      $query2->where('transaksi_barang.jenis', 'keluar');
    }

    $query2->whereBetween('transaksi_barang.tanggal_transaksi', [$from, $to]);
    $data2 = $query2->get();
    $periode = $from . " - " . $to;

    return view('report.report_data', compact('data', 'data2', 'periode', 'no_manager', 'email_manager'));
  }

  public function mail(Request $request)
  {
    $subject = $request->input('subject');
    $body = $request->input('body');

    Mail::to('opname.manager@gmail.com')
      ->send(new MailManager($subject, $body));
//    dd($respon);
    return redirect(route('report'))->with('success', 'Email has been sent');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $data = new Barang();
    $data->nama_barang = $request->nama_barang;
    $data->jenis_barang = $request->jenis_barang;
    if ($file = $request->file('foto')) {

      $nama_file = md5_file($file->getRealPath()) . "_" . $file->getClientOriginalName();
      $path = 'file/barang';
      $file->move($path, $nama_file);
      $data->foto = $nama_file;
    }
    $data->stock = $request->stock;
    $data->id_satuan = $request->id_satuan;
    $data->save();
    return redirect()->route('barang')->with('success', "Data Barang Berhasil Ditambahkan !");
  }

  public function detail(Request $request)
  {
    $data = Barang::where('id', $request->id)->with('satuan')->first();
    return response()->json([
      'data' => $data,
    ]);
  }


  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request)
  {
    $data = Barang::find($request->id);
    $data->nama_barang = $request->nama_barang;
    $data->jenis_barang = $request->jenis_barang;
    if ($file = $request->file('foto')) {

      $nama_file = md5_file($file->getRealPath()) . "_" . $file->getClientOriginalName();
      $path = 'file/barang';
      $file->move($path, $nama_file);
      $data->foto = $nama_file;
    }
    $data->stock = $request->stock;
    $data->id_satuan = $request->id_satuan;
    $data->save();
    return redirect()->route('barang')->with('success', "Data Barang Berhasil Diupdate !");
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    try {
      $barang = Barang::findOrFail($id);
      // unlink("file/barang/" . $barang->foto);
      $barang->delete();
      return redirect()->route('barang')->with('success', "Data barang Berhasil Di Hapus !");
    } catch (\Throwable $e) {
      return redirect()->route('barang')->with('error', $e);
    }
  }
}
