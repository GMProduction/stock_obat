<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laporan Penerimaan </title>
    <!-- Fonts -->

    <!-- Styles -->
    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="{{ asset('bootsrap/css/bootstrap/bootstrap.css') }}" type="text/css"> --}}


</head>

<body>
<style type="text/css">
    @page {
        margin: 20px;
    }


    body {
        font-family: "Gill Sans Extrabold", sans-serif;
    }
</style>

<style>
    .nogap {
        padding: 0;
        margin: 0;
    }

    footer {
        position: fixed;
        bottom: 0;
        right: 0;
    }

    table {
        /* border: 1px solid #ccc; */
        border-collapse: collapse;
        margin: 0;
        padding: 0px;
        width: 100%;
    }

    .panel {
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .stripe-table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        overflow: hidden;
    }

    .stripe-table th,
    .stripe-table td {
        padding: 08px !important;
    }

    .stripe-table td {
        color: #444
    }

    .stripe-table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .text-center {
        text-align: center !important;
    }

    .text-left {
        text-align: left !important;
    }

    .text-right {
        text-align: right !important;
    }

    .text-ontable {
        font-size: 0.8rem;
    }

    .text-ontable-sm {
        font-size: 0.5rem;
    }

    .text-sm {
        font-size: 0.8rem;
    }

    .page-break {
        page-break-after: always;
    }
</style>

<br>

<div>
    {{-- <img src="{{ public_path('static-image/logo.png') }}" style="width: 120px; float: left;" /> --}}

    <table style="border: none">
        <tr style="border: none">
            <td style="width: 15%">
                <img style="width: 100px"
                     src="<?php echo $_SERVER['DOCUMENT_ROOT'] . './local/images/boxmedic.png'; ?>"/>
            </td>
            <td style="width: 70%">
                <h4 style=" text-align: center;margin-bottom:0px ;margin-top:0; font-size: 18px;">PEMERINTAH KOTA
                    SURAKARTA</h4>
                <h4 style=" text-align: center;margin-bottom:0px ;margin-top:0; font-size: 18px">DINAS KESEHATAN
                </h4>
                <h4 style=" text-align: center;margin-bottom:0px ;margin-top:0; font-size: 18px">UPT PUSKESMAS
                    MANAHAN</h4>
                <h6 style=" text-align: center;margin-bottom:0px ;margin-top:0; font-size: 12px">jl. Sti Gunting VII
                    Manahan
                    Banjarsari
                    (0271) 123873</h6>
                <h6 style=" text-align: center;margin-bottom:0px ;margin-top:0; font-size: 12px">Email:
                    upt.manahan@gmail.com
                </h6>
                <h6 style=" text-align: center;margin-bottom:0px ;margin-top:0; font-size: 12px">SURAKARTA</h6>
                <h6 style=" text-align: center;margin-bottom:10px ;margin-top:0; font-size: 12px">57500</h6>
            </td>
            <td style="width: 15%">
                <img style="width: 100px"
                     src="<?php echo $_SERVER['DOCUMENT_ROOT'] . './local/images/boxmedic.png'; ?>"/>
            </td>
        </tr>
    </table>

    <div style="width: 100%; border-bottom: 2px solid black; margin-bottom: 10px">

    </div>
    <p style="font-weight: bold; font-size: 0.9rem;" class="text-center">Laporan Penerimaan Barang</p>
    <table style="border: 0; ">
        <tr style="border: none">
            <td>
                <div>

                    <table style=" table-layout: auto; border: none; width: 400px">

                        <tr style="border: 0;  ">
                            <td class="text-left" style="width: 100px; margin-bottom: 0; font-size: 11px ">
                                Periode
                            </td>
                            <td class="text-left" style="width: 10px !important; margin-bottom: 0; font-size: 11px">
                                :
                            </td>
                            <td class="text-left" style="margin-bottom: 0; font-size: 11px">
                                {{ \Carbon\Carbon::parse($date_start)->format('d F Y') }} - {{ \Carbon\Carbon::parse($date_end)->format('d F Y') }}
                            </td>
                        </tr>
                        <tr style="border: 0; margin-top: 0;">
                            <td class="text-left" style="font-size: 11px">
                                Sumber Anggaran
                            </td>
                            <td class="text-left" style="width: 10px !important;font-size: 11px">
                                :
                            </td>
                            <td class="text-left" style="font-size: 11px">
                                {{ $budget_source }}
                            </td>

                        </tr>

                    </table>
                </div>
            </td>

        </tr>
    </table>
</div>

<br>

{{-- BARANG DITERIMA --}}
<p style="font-size: 0.9rem">Daftar Penerimaan Barang</p>
<div class="panel">


    <table style="margin-bottom: 10px" class="stripe-table">
        <thead>
        <tr style="border-bottom: 1px solid #ccc">
            <th style="width: 10px !important" class="text-center text-ontable">#</th>
            <th class="text-left text-ontable">Nomor Batch</th>
            <th class="text-center text-ontable " style="width: 200px">Tanggal Datang</th>
            <th class="text-right text-ontable">Sumber Anggaran</th>
            <th class="text-right text-ontable">Total Biaya</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $value)
            <tr style="border-bottom: 1px solid #ccc">
                <td style="width: 10px !important" class="text-center text-ontable">{{ $loop->index + 1 }}</td>
                <td class="text-center text-ontable">{{ $value->batch_id }}</td>
                <td class="text-center text-ontable">{{ \Carbon\Carbon::parse($value->date)->format('d/m/Y') }}</td>
                <td class="text-center text-ontable">{{ $value->budget_source->name }}</td>
                <td class="text-right text-ontable">{{ number_format($value->total, 0, ',', '.') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{{-- CATATAN --}}

<br>
<div style="right:10px;width: 300px;display: inline-block;margin-top:70px">
    <p class="text-center" style="margin-bottom: 50px">Pimpinan</p>
    <p class="text-center">( ........................... )</p>
</div>

<div style="left:10px;width: 300px; margin-left : 100px;display: inline-block">
    <p class="text-center " style="margin-bottom: 50px">Admin</p>
    <p class="text-center">( ........................... )</p>
</div>
<div class="page-break"></div>
<table style="border: 0; ">
    <tr style="border: none">
        <td>
            <div>
                <table style=" table-layout: auto; border: none; width: 400px">
                    <tr style="border: 0;  ">
                        <td class="text-left" style="width: 100px; margin-bottom: 0; font-size: 11px ">
                            Lampiran
                        </td>
                        <td class="text-left" style="width: 10px !important; margin-bottom: 0; font-size: 11px">
                            :
                        </td>
                        <td class="text-left" style="margin-bottom: 0; font-size: 11px">
                            Detail Penerimaan Obat
                        </td>
                    </tr>
                </table>
            </div>
        </td>
    </tr>
</table>

<table style="margin-bottom: 10px" class="stripe-table">
    <thead>
    <tr style="border-bottom: 1px solid #ccc">
        <th style="width: 10px !important" class="text-center text-ontable-sm">#</th>
        <th class="text-center text-ontable-sm">Tanggal</th>
        <th class="text-center text-ontable-sm">Batch ID</th>
        <th class="text-left text-ontable-sm">Nama Obat</th>
        <th class="text-center text-ontable-sm">Satuan</th>
        <th class="text-center text-ontable-sm">Jumlah</th>
        <th class="text-right text-ontable-sm">Harga (Rp.)</th>
        <th class="text-right text-ontable-sm">Total (Rp.)</th>
        <th class="text-center text-ontable-sm">Kadaluarsa</th>
    </tr>
    </thead>
    <tbody>
    @php
        $idx = 1;
    @endphp
    @foreach($data as $value)
        @foreach($value->medicine_ins as $detail)
            <tr style="border-bottom: 1px solid #ccc">
                <td style="width: 10px !important" class="text-center text-ontable-sm">{{ $idx }}</td>
                <td class="text-center text-ontable-sm">{{ \Carbon\Carbon::parse($value->date)->format('d/m/Y') }}</td>
                <td class="text-center text-ontable-sm">{{ $value->batch_id}}</td>
                <td class="text-left text-ontable-sm">{{ $detail->medicine->name }}</td>
                <td class="text-center text-ontable-sm">{{ $detail->unit->name}}</td>
                <td class="text-center text-ontable-sm">{{ $detail->qty}}</td>
                <td class="text-right text-ontable-sm">{{ number_format($detail->price, 0, ',', '.')}}</td>
                <td class="text-right text-ontable-sm">{{ number_format($detail->total, 0, ',', '.')}}</td>
                <td class="text-center text-ontable-sm">{{ \Carbon\Carbon::parse($detail->expired_date)->format('d/m/Y') }}</td>
            </tr>
            @php
                $idx += 1;
            @endphp
        @endforeach
    @endforeach
    </tbody>
</table>

<footer class="footer">
    @php $date = new DateTime("now", new DateTimeZone('Asia/Bangkok') ); @endphp
    <p class="text-right nogap text-sm"> di cetak oleh :
        {{ auth()->user()->username }}
    </p>
    <p class="text-right nogap text-sm"> tgl: {{ $date->format('d F Y, H:i:s') }} </p>
</footer>


</body>

</html>
