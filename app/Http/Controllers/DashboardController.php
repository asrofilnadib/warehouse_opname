<?php

namespace App\Http\Controllers;

use App\Models\TransaksiBarang;
use Illuminate\Http\Request;
use App\Models\Barang;
use Akaunting\Apexcharts\Chart;

class DashboardController extends Controller
{
  /**
   * Display a listing of the resource.
   */

  public function __construct()
  {

  }

  public function index(Request $request)
  {
    $from = $request->input('from') ?? TransaksiBarang::min('tanggal_transaksi');
    $to = $request->input('to') ?? TransaksiBarang::max('tanggal_transaksi');

    $transaksi = TransaksiBarang::whereBetween('tanggal_transaksi', [$from, $to])->get();

    $barangMasuk = $transaksi->where('jenis', 'Masuk')->count();
    $barangKeluar = $transaksi->where('jenis', 'Keluar')->count();

    $barang = Barang::all();
    return view('dashboard', [
      'barang' => $barang,
      'transaksi' => $transaksi,
      'barangKeluarMasuk' => json_encode([
        'label' => ['Barang Masuk', 'Barang Keluar'],
        'data' => [$barangMasuk, $barangKeluar]
      ]),
    ]);
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
    $data = new Mobil();
    $data->merk = $request->merk;
    $data->model = $request->model;
    $data->plat_no = $request->plat_no;
    if ($file = $request->file('foto')) {

      $nama_file = md5_file($file->getRealPath()) . "_" . $file->getClientOriginalName();
      $path = 'file/barang';
      $file->move($path, $nama_file);
      $data->foto = $nama_file;
    }
    $data->tahun = $request->tahun;
    $data->bbm = $request->bbm;
    $data->transmisi = $request->transmisi;
    $data->harga_sewa = $request->harga_sewa;
    $data->status = 0;
    $data->save();
    return redirect()->route('mobil')->with('success', "Data Mobil Berhasil Ditambahkan !");
  }

  public function detail(Request $request)
  {
    $data = Barang::find($request->id);
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
    $data->merk = $request->merk;
    $data->model = $request->model;
    $data->plat_no = $request->plat_no;
    if ($file = $request->file('foto')) {

      $nama_file = md5_file($file->getRealPath()) . "_" . $file->getClientOriginalName();
      $path = 'file/barang';
      $file->move($path, $nama_file);
      $data->foto = $nama_file;
    }
    $data->tahun = $request->tahun;
    $data->bbm = $request->bbm;
    $data->transmisi = $request->transmisi;
    $data->harga_sewa = $request->harga_sewa;
    $data->status = 0;
    $data->save();
    return redirect()->route('mobil')->with('success', "Data Mobil Berhasil Diupdate !");
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    try {
      $barang = Barang::findOrFail($id);
      unlink("file/barang/" . $barang->foto);
      $barang->delete();
      return redirect()->route('mobil')->with('success', "Data mobil Berhasil Di Hapus !");
    } catch (\Throwable) {
      return redirect()->route('mobil')->with('error', $e);
    }
  }
}
