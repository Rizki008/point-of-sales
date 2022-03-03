<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PembelianDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_pembelian = session('id_pembelian');
        $produk = Produk::orderBy('nama_produk')->get();
        $supplier = Supplier::find(session('id_supplier'));
        $diskon = Pembelian::find($id_pembelian)->diskon ?? 0;

        if (!$supplier) {
            abort(404);
        }
        return view('pembelian_detail.index', compact('id_pembelian', 'produk', 'supplier', 'diskon'));
    }

    public function data($id)
    {
        $detail = PembelianDetail::with('produk')
            ->where('id_pembelian', $id)
            ->get();

        $data = array();
        $total = 0;
        $total_item = 0;

        foreach ($detail as $item) {
            $row = array();
            $row['kode_produk'] = '<span class="badge badge-success">' . $item->produk['kode_produk'] . '<span>';
            $row['nama_produk'] = $item->produk['nama_produk'];
            $row['harga_beli']  = 'Rp. ' . format_uang($item->harga_beli);
            $row['jumlah']      = '<input type="number" class="form-control input-sm quantity" data-id="' . $item->id_pembelian_detail . '" value="' . $item->jumlah . '">';
            $row['subtotal']    = 'Rp. ' . format_uang($item->subtotal);
            $row['aksi']        = '<div class="btn btn-group">
                                    <button type="button" onclick="deleteData(`' . route('pembelian_detail.destroy', $item->id_pembelian_detail) . '`)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                </div>';
            $data[] = $row;

            $total += $item->harga_beli * $item->jumlah;
            $total_item += $item->jumlah;
        }
        //d-none
        $data[] = [
            'kode_produk' => '<div class="total hide">' . $total . '</div>
            <div class="total_item hide">' . $total_item . '</div>',
            'nama_produk' => '',
            'harga_beli' => '',
            'jumlah' => '',
            'subtotal' => '',
            'aksi' => '',
        ];

        return datatables()
            ->of($data)
            // ->of($detail)
            ->addIndexColumn()
            // ->addColumn('nama_produk', function ($detail) {
            //     return $detail->produk['nama_produk'];
            // })
            // ->addColumn('kode_produk', function ($detail) {
            //     return '<span class="badge badge-success">' . $detail->produk['kode_produk'] . '</span>';
            // })
            // ->addColumn('harga_beli', function ($detail) {
            //     return 'Rp. ' . format_uang($detail->harga_beli);
            // })
            // ->addColumn('jumlah', function ($detail) {
            //     return '<input type="number" class="form-control input-sm quantity" data-id="' . $detail->id_pembelian_detail . '" value="' . $detail->jumlah . '">';
            // })
            // ->addColumn('subtotal', function ($detail) {
            //     return 'Rp. ' . format_uang($detail->subtotal);
            // })
            // ->addColumn('aksi', function ($detail) {
            //     return '<div class="btn btn-group">
            //     <button type="button" onclick="deleteData(`' . route('pembelian_detail.destroy', $detail->id_pembelian_detail) . '`)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
            //     </div>';
            // })
            ->rawColumns(['aksi', 'kode_produk', 'jumlah'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produk = Produk::where('id_produk', $request->id_produk)->first();
        if (!$produk) {
            return response()->json('data gagal disimpan', 400);
        }
        $detail = new PembelianDetail();
        $detail->id_pembelian = $request->id_pembelian;
        $detail->id_produk = $produk->id_produk;
        $detail->harga_beli = $produk->harga_beli;
        $detail->jumlah = 1;
        $detail->subtotal = $produk->harga_beli;
        $detail->save();

        return response()->json('data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $detail = PembelianDetail::find($id);
        $detail->jumlah = $request->jumlah;
        $detail->subtotal = $detail->harga_beli * $request->jumlah;
        $detail->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detail = PembelianDetail::find($id);
        $detail->delete();

        return response(null, 204);
    }

    //buat kalkulasi data
    public function loadForm($diskon, $total)
    {
        // dd($diskon, $total); //untuk mengecek data
        $bayar = $total - ($diskon / 100 * $total);
        $data = [
            'totalrp' => format_uang($total),
            'bayar' => $bayar,
            'bayarrp' => format_uang($bayar),
            'terbilang' => ucwords(terbilang($bayar) . ' Rupiah')
        ];

        return response()->json($data);
    }
}
