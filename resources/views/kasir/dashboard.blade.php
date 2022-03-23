@extends('layout.master')

@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Dashboard v1</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-body text-center">
                        <h1>Selamat Datang</h1>
                        <h2>Anda login sebagai kasir</h2>
                        <br>
                        <br>
                        <a href="{{ route('transaksi.baru') }}" class="btn btn-success btn-lg">Transaksi Baru</a>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
