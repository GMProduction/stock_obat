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
                        <a href="#" class="ml-1 text-sm font-medium text-gray-700  md:ml-2  ">Laporan Stock</a>
                    </div>
                </li>

            </ol>
        </nav>

        <div class="">
            <div class="section relative">
                <p class="title ">Stock Saat Ini </p>
                <div class="absolute right-0 top-0 mt-3 mr-3">
                    <div class="flex">

                        <button onclick="window.open('{{ route('cetakLaporanPenerimaan', ['id' => 1]) }}');"
                            class="bg-green-500 hover:bg-green-300 transition-all duration-300 rounded-md flex items-center text-white px-3 py-2 text-sm mr-3">
                            <img src="{{ asset('local/icons/tutupbuku.svg') }}"
                                class=" mr-2 menu-icon text-sm w-6 object-scale-down" />
                            Tutup Buku
                        </button>

                    </div>
                </div>

                {{-- FILTER --}}
                <div class="mb-2">

                    <button class="chip" id="btndropdownkategori">
                        Kategori: <span id="textsumber"> Semua</span>
                        </a>
                </div>

                {{-- MENU SUMBER ANGGARAN --}}
                <div id="dropdownkategori" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 ">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="btndropdownkategori">
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                onclick="kategoriclose('Semua')">Semua</a>
                        </li>

                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                onclick="kategoriclose('Oral')">Oral</a>
                        </li>

                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                onclick="kategoriclose('Salep')">Salep</a>
                        </li>

                    </ul>
                </div>

                <table id="tb-master" class="stripe hover mt-10"
                    style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1" class="text-right text-xs">No</th>
                            <th data-priority="2" class="text-center text-xs">Nama Barang</th>
                            <th data-priority="2" class="text-center text-xs">Kategori</th>
                            <th data-priority="2" class="text-center text-xs">Stock</th>
                            <th data-priority="2" class="text-center text-xs">Satuan</th>
                            <th data-priority="2" class="text-center text-xs">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="text-right text-xs">1</td>
                            <td class="text-center text-xs">Nama Barang</td>
                            <td class="text-center text-xs">Kategori</td>
                            <td class="text-center text-xs">Stock</td>
                            <td class="text-center text-xs">Satuan</td>
                            <td class="text-center text-xs font-bold flex flex-nowrap gap-1 justify-center">
                                <button onclick="location.href='{{ route('laporandetailstock', ['id' => 1]) }}'"
                                    class="bg-blue-500 flex rounded-full justify-center items-center text-white px-3 py-2 btn-tambahMaster text-xs">Detail
                                </button>

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
    <script src="{{ asset('js/datepicker.js') }}"></script>

    <script>
        $(document).ready(function() {

            var table = $('#tb-master').DataTable({
                    responsive: true,
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



    {{-- DROPDOWN --}}
    <script>
        // set the dropdown menu element
        const $targetEl = document.getElementById('dropdownkategori');

        // set the element that trigger the dropdown menu on click
        const $triggerEl = document.getElementById('btndropdownkategori');

        // options with default values
        const options = {
            placement: 'bottom',
            triggerType: 'click',
            offsetSkidding: 0,
            offsetDistance: 10,
            delay: 300,
            backdrop: 'static',
            onHide: () => {
                console.log('dropdown has been hidden');
            },
            onShow: () => {
                console.log('dropdown has been shown');
            },
            onToggle: () => {
                console.log('dropdown has been toggled');
            }
        };
        const dropdownkategori = new Dropdown($targetEl, $triggerEl, options);

        function kategoriclose(sumber) {
            const $textSumber = document.getElementById('textsumber');
            $textSumber.innerHTML = sumber;
            dropdownkategori.hide();
        }

        function kategorishow() {
            dropdownkategori.toggle();
        }
    </script>
@endsection
