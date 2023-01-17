@extends('admin.base')

@section('css')
    <!--Regular Datatables CSS-->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <!--Responsive Extension Datatables CSS-->
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="panel min-h-screen">

        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-secondary ">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                            </path>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <a href="#" class="ml-1 text-sm font-medium text-gray-700  md:ml-2  ">Laporan Pernerimaan</a>
                    </div>
                </li>

            </ol>
        </nav>

        <div class="grid grid-cols-5 gap-4">
            <div class="section relative col-span-2">
                <p class="title ">Penerimaan Barang </p>

                <table id="tb-master" class="stripe hover mt-10"
                    style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1" class="text-right text-xs">No</th>
                            <th data-priority="2" class="text-center text-xs">Tanggal Datang</th>
                            {{-- <th data-priority="2" class="text-center text-xs">Nama Barang</th>
                            <th data-priority="3" class="text-center text-xs">Satuan</th> --}}
                            <th data-priority="3" class="text-center text-xs">Nomor Batch</th>
                            <th data-priority="3" class="text-center text-xs">Sumber Anggaran</th>
                            {{-- <th data-priority="3" class="text-center text-xs">Harga Satuan</th>
                            <th data-priority="3" class="text-center text-xs">Total Harga</th>  --}}
                            <th data-priority="4" class="text-center text-xs">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="text-right text-xs">1</td>
                            <td class="text-center text-xs">12 Desember 2022</td>
                            {{-- <td class="text-center text-xs">Paracetamol</td>
                            <td class="text-center text-xs">Tablet</td> --}}
                            <td class="text-center text-xs">Btch0122</td>
                            <td class="text-center text-xs">APBN</td>
                            {{-- <td class="text-center text-xs">20 Desember 2024</td>
                            <td class="text-center text-xs">Rp 50.000</td>
                            <td class="text-center text-xs">Rp 80.000</td> --}}
                            <td class="text-center text-xs font-bold flex flex-nowrap gap-1 justify-center">
                                <button
                                    class="bg-blue-500 rounded-full text-white px-3 py-2 btn-tambahMaster text-xs">Detail</button>

                            </td>
                        </tr>



                    </tbody>
                </table>
            </div>

            <div class="section col-span-3 relative">

                <div class="border rounded-md p-3">
                    <div class="grid grid-cols-4 gap-2">
                        <div class="mb-3 ">
                            <label for="total" class="block mb-2 text-sm font-medium text-gray-700 mt-3">Nomor Batch
                            </label>
                            <input type="text" id="total"
                                class="bg-gray-200  border  w-full p-1 border-gray-300 text-gray-900 rounded-sm text-sm  block "
                                readonly name="total" value="Test" />
                        </div>

                        <div class="mb-3 ">
                            <label for="total" class="block mb-2 text-sm font-medium text-gray-700 mt-3">Tanggal Datang
                            </label>
                            <input type="text" id="total"
                                class="bg-gray-200  border  w-full p-1 border-gray-300 text-gray-900 rounded-sm text-sm  block"
                                readonly name="total" />
                        </div>

                        <div class="mb-3 ">
                            <label for="total" class="block mb-2 text-sm font-medium text-gray-700 mt-3">Sumber
                                Anggaran
                            </label>
                            <input type="text" id="total"
                                class="bg-gray-200  border  w-full p-1 border-gray-300 text-gray-900 rounded-sm text-sm  block "
                                readonly name="total" />
                        </div>

                        <div class="mb-3 ">
                            <label for="total" class="block mb-2 text-sm font-medium text-gray-700 mt-3">Total
                                Biaya
                            </label>
                            <input type="text" id="total"
                                class="bg-gray-200  border  w-full p-1 border-gray-300 text-gray-900 rounded-sm text-sm  block "
                                readonly name="total" />
                        </div>
                    </div>



                    <div class="mb-3 ">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-700 mt-3">Catatan
                            Penerimaan
                        </label>
                        <textarea type="text" id="description"
                            class="bg-gray-50 border rounded-md w-full border-gray-300 text-gray-900 text-sm  block  p-2.5 " rows="4"
                            placeholder="Catatan Penerimaan" name="description"></textarea>
                    </div>

                </div>

                <div class="border rounded-md p-3 mt-5 ">
                    <p class="title ">Daftar Barang </p>

                    <table id="tb-daftarbarang" class="stripe hover mt-10"
                        style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th data-priority="1" class="text-right text-xs">No</th>
                                <th data-priority="2" class="text-center text-xs">Nama Barang</th>
                                <th data-priority="3" class="text-center text-xs">Satuan</th>
                                <th data-priority="2" class="text-center text-xs">Tanggal Expired</th>
                                <th data-priority="3" class="text-center text-xs">Harga Satuan</th>
                                <th data-priority="3" class="text-center text-xs">Total Harga</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td class="text-right text-xs">1</td>
                                <td class="text-center text-xs">Paracetamol</td>
                                <td class="text-center text-xs">Tablet</td>
                                <td class="text-center text-xs">20 Desember 2024</td>
                                <td class="text-center text-xs">Rp 50.000</td>
                                <td class="text-center text-xs">Rp 80.000</td>

                            </tr>



                        </tbody>
                    </table>
                </div>
            </div>



        </div>

    </div>
@endsection

@section('morejs')
    <!--Datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

    <script>
        $(document).ready(function() {

            var table = $('#tb-master').DataTable({
                    responsive: true,
                    "lengthChange": false
                })
                .columns.adjust()
                .responsive.recalc();

            var daftarbarang = $('#tb-daftarbarang').DataTable({
                    responsive: true,
                    "lengthChange": false
                })
                .columns.adjust()
                .responsive.recalc();


        });
    </script>



    {{-- ACTION --}}
@endsection
