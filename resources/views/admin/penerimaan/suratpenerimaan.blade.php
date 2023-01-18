<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Surat Penerimaan Barang</title>
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
            font-family:   "Gill Sans Extrabold", sans-serif;
        }
    </style>

    <style>
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 0;
        }

        table {
            border: 1px solid #ccc;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
            width: 100%;
            table-layout: fixed;
        }




        .text-center {
            text-align: center !important;
        }

        .text-left {
            text-align: left !important;
        }
    </style>

    <br>

    <div>
        {{-- <img src="{{ public_path('static-image/logo.png') }}" style="width: 120px; float: left;" /> --}}

        <table style="border: none">
            <tr style="border: none">
                <td >
                    <img style="width: 100px" src="<?php echo $_SERVER['DOCUMENT_ROOT'] . './local/images/boxmedic.png'; ?>" />
                </td>
                <td style="width: 75%">
                    <h4 style=" text-align: center;margin-bottom:0px ;margin-top:0; font-size: 18px;">PEMERINTAH KOTA SURAKARTA</h4>
                    <h4 style=" text-align: center;margin-bottom:0px ;margin-top:0; font-size: 18px">DINAS KESEHATAN</h4>
                    <h4 style=" text-align: center;margin-bottom:0px ;margin-top:0; font-size: 18px">UPT PUSKESMAS MANAHAN</h4>
                    <h6 style=" text-align: center;margin-bottom:0px ;margin-top:0; font-size: 12px">jl. Sti Gunting VII Manahan
                        Banjarsari
                        (0271) 123873</h6>
                    <h6 style=" text-align: center;margin-bottom:0px ;margin-top:0; font-size: 12px">Email: upt.manahan@gmail.com
                    </h6>
                    <h6 style=" text-align: center;margin-bottom:0px ;margin-top:0; font-size: 12px">SURAKARTA</h6>
                    <h6 style=" text-align: center;margin-bottom:10px ;margin-top:0; font-size: 12px">57500</h6>
                </td>
                <td style="width: 50px">
                    <img style="width: 100px" src="<?php echo $_SERVER['DOCUMENT_ROOT'] . './local/images/boxmedic.png'; ?>" />
                </td>
            </tr>
        </table>

        <div style="width: 100%; border-bottom: 2px solid black; margin-bottom: 10px">

        </div>

        <table style="border: 0; ">
            <tr style="border: 0">
                <td>
                    <div>

                        <table style=" table-layout: auto; border: none; width: 400px">

                            <tr style="border: 0;  ">
                                <td class="text-left" style="width: 100px; margin-bottom: 0; font-size: 11px ">
                                    No. Surat Penerimaan
                                </td>
                                <td class="text-left" style="width: 10px !important; margin-bottom: 0; font-size: 11px">
                                    :
                                </td>
                                <td class="text-left" style="margin-bottom: 0; font-size: 11px">
                                    "Nomor Batch"
                                </td>
                            </tr>
                            <tr style="border: 0; margin-top: 0;">
                                <td class="text-left" style="font-size: 11px">
                                    Tanggal Pesanan
                                </td>
                                <td class="text-left" style="width: 10px !important;font-size: 11px">
                                    :
                                </td>
                                <td class="text-left" style="font-size: 11px">
                                    12 Januari 2022
                                </td>

                            </tr>
                            <tr style="border: 0; ">
                                <td class="text-left " style="font-size: 11px">
                                    Sumber Anggaran
                                </td>
                                <td class="text-left" style="width: 10px !important; font-size: 11px">
                                    :
                                </td>
                                <td class="text-left" style="width: 200px; font-size: 11px">
                                    APBN
                                </td>

                            </tr>
                        </table>
                    </div>
                </td>

            </tr>
        </table>
    </div>

    <br>

    <p style="font-size: 11px">Daftar Barang yang diterima</p>
    <table style="margin-bottom: 10px">
        <thead>
            <tr>
                <th style="width: 10px" class="text-center">#</th>
                <th class="text-center">Nama Barang</th>
                <th class="text-center">Jumlah diminta</th>
                <th class="text-center">Jumlah disetujui</th>
                <th class="text-center">Status</th>
                {{-- <th class="text-center">Total Harga</th> --}}
            </tr>

        </thead>
        <tbody>
            <tr>
                <td>
                    {{-- {{$key + 1}} --}}
                </td>
                <td>
                    {{-- {{$d->barang->nama_barang}} --}}
                </td>
                <td>
                    {{-- {{$d->qty}} --}}
                </td>
                <td>
                    {{-- {{$d->qty_disetujui}} --}}
                </td>
                <td>
                    {{-- {{$d->status == 1 ? 'Diterima' : $d->status == 2 ? 'Ditolak' : 'menunggu'}} --}}
                </td>
            </tr>

        </tbody>
    </table>


    <br>
    <div style="right:10px;width: 300px;display: inline-block;margin-top:70px">
        <p class="text-center mb-5">Pimpinan</p>
        <p class="text-center">( ........................... )</p>
    </div>

    <div style="left:10px;width: 300px; margin-left : 100px;display: inline-block">
        <p class="text-center mb-5">Admin</p>
        <p class="text-center">( ........................... )</p>
    </div>


    <footer class="footer">
        @php $date = new DateTime("now", new DateTimeZone('Asia/Bangkok') ); @endphp
        <p class="text-right small mb-0 mt-0 pt-0 pb-0"> di cetak oleh :
            {{-- {{ auth()->user()->username }} --}}
        </p>
        <p class="text-right small mb-0 mt-0 pt-0 pb-0"> tgl: {{ $date->format('d F Y, H:i:s') }} </p>
    </footer>

    </div>


    <!-- JS -->
    <script src="js/app.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
