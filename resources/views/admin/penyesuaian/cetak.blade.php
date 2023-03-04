<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Surat Penerimaan || (Nomor Batch)</title>
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

    .text-sm {
        font-size: 0.8rem;
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
    <p style="font-weight: bold; font-size: 0.9rem;" class="text-center">Surat Penyesuaian Barang</p>
    <table style="border: 0; ">
        <tr style="border: none">
            <td>
                <div>

                    <table style=" table-layout: auto; border: none; width: 400px">

                        <tr style="border: 0;  ">
                            <td class="text-left" style="width: 100px; margin-bottom: 0; font-size: 11px ">
                                No. Surat Penyesuaian
                            </td>
                            <td class="text-left" style="width: 10px !important; margin-bottom: 0; font-size: 11px">
                                :
                            </td>
                            <td class="text-left" style="margin-bottom: 0; font-size: 11px">
                                {{ $data->batch_id }}
                            </td>
                        </tr>
                        <tr style="border: 0; margin-top: 0;">
                            <td class="text-left" style="font-size: 11px">
                                Tanggal Penyesuaian
                            </td>
                            <td class="text-left" style="width: 10px !important;font-size: 11px">
                                :
                            </td>
                            <td class="text-left" style="font-size: 11px">
                                {{ \Carbon\Carbon::parse($data->date)->format('d F Y') }}
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
<p style="font-size: 0.9rem">Daftar Barang yang disesuaikan</p>
<div class="panel">


    <table style="margin-bottom: 10px" class="stripe-table">
        <thead>
        <tr style="border-bottom: 1px solid #ccc">
            <th style="width: 10px !important" class="text-center text-ontable">#</th>
            <th class="text-left text-ontable">Nama Barang</th>
            <th class="text-center text-ontable">Satuan</th>
            <th class="text-center text-ontable " style="width: 200px">Kadaluarsa</th>
            <th class="text-center text-ontable" style="width: 20px">Jumlah Sistem</th>
            <th class="text-center text-ontable" style="width: 20px">Jumlah Sebenarnya</th>
            <th class="text-center text-ontable" style="width: 20px">Selisih</th>
        </tr>

        </thead>
        <tbody>
        @foreach($data->details as $detail)
            <tr>
                <td style="width: 10px !important" class="text-center text-ontable">
                    {{ $loop->index + 1 }}
                </td>
                <td class="text-left text-ontable">
                    {{ $detail->medicine->name }}
                </td>
                <td class="text-center text-ontable">
                    {{ $detail->medicine->unit->name }}
                </td>
                <td class="text-center text-ontable" style="width: 200px">
                    {{ \Carbon\Carbon::parse($detail->expired_date)->format('d F Y') }}
                </td>
                <td class="text-center text-ontable" style="width: 20px">
                    {{ $detail->current_qty }}
                </td>
                <td class="text-center text-ontable" style="width: 20px">
                    {{ $detail->real_qty }}
                </td>
                <td class="text-center text-ontable" style="width: 20px">
                    {{ ($detail->real_qty - $detail->current_qty) }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{{-- CATATAN --}}
<div class="panel" style="margin-top: 10px; padding: 8px">
    <p style="margin: 0; padding: 0; font-weight: bold;" class="text-sm">Catatan:</p>
    <p style="margin: 0; margin-top: 8px; padding: 0; color: #444" class="text-sm">{{ $data->description }}</p>
</div>
<br>
<div style="right:10px;width: 300px;display: inline-block;margin-top:70px">
    <p class="text-center" style="margin-bottom: 50px">Pimpinan</p>
    <p class="text-center">( ........................... )</p>
</div>

<div style="left:10px;width: 300px; margin-left : 100px;display: inline-block">
    <p class="text-center " style="margin-bottom: 50px">Admin</p>
    <p class="text-center">( ........................... )</p>
</div>


<footer class="footer">
    @php $date = new DateTime("now", new DateTimeZone('Asia/Bangkok') ); @endphp
    <p class="text-right nogap text-sm"> di cetak oleh :
        {{-- {{ auth()->user()->username }} --}} Admin
    </p>
    <p class="text-right nogap text-sm"> tgl: {{ $date->format('d F Y, H:i:s') }} </p>
</footer>


</body>

</html>
