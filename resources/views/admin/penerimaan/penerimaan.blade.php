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
                        <a href="#" class="ml-1 text-sm font-medium text-gray-700  md:ml-2  ">Pernerimaan Barang</a>
                    </div>
                </li>

            </ol>
        </nav>

        <div class="grid grid-cols-1 gap-4">
            <div class="section relative">
                <p class="title ">Penerimaan Barang </p>
                <div class="absolute right-0 top-0 mt-3 mr-3">
                    <div class="flex">
                        <button class="bg-green-500 rounded-md flex items-center text-white px-3 py-2 text-sm mr-3"><span
                                class="material-symbols-outlined mr-2 menu-icon text-sm">
                                filter_alt
                            </span>Filter</button>

                        <button onclick="location.href='{{ route('tambahbarang') }}'"
                            class="bg-blue-500 rounded-md flex items-center text-white px-3 py-2 text-sm "><span
                                class="material-symbols-outlined mr-2 menu-ico text-sm">
                                add
                            </span>Tambah</button>
                    </div>
                </div>
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
                                    class="bg-secondary rounded-full text-white px-3 py-2 btn-tambahMaster text-xs">Ubah</button>
                                <button class="bg-red-500 rounded-full text-white px-3 py-2 text-xs"
                                    onclick="confirmDelete(function(){alert('ok')}, function(){alert('cancel')})">Hapus</button>
                            </td>
                        </tr>



                    </tbody>
                </table>
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
                    responsive: true
                })
                .columns.adjust()
                .responsive.recalc();


        });
    </script>



    {{-- ACTION --}}
@endsection
