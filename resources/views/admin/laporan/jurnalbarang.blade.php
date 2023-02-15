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
                        <a href="#" class="ml-1 text-sm font-medium text-gray-700  md:ml-2  ">Jurnal Barang</a>
                    </div>
                </li>

            </ol>
        </nav>

        <div class="">
            <div class="section relative">
                <p class="title ">Jurnal Barang </p>
                <div class="absolute right-0 top-0 mt-3 mr-3">
                    <div class="flex">

                        <button onclick="window.open('{{ route('cetakLaporanPenerimaan', ['id' => 1]) }}');"
                            class="bg-green-500 hover:bg-green-300 transition-all duration-300 rounded-md flex items-center text-white px-3 py-2 text-sm mr-3">
                            <img src="{{ asset('local/icons/tutupbuku.svg') }}"
                                class=" mr-2 menu-icon text-sm w-6 object-scale-down" />
                            Export to Excel
                        </button>

                    </div>
                </div>

                {{-- FILTER --}}
                <div class="mb-2">
                    <a class="chip mr-3 btn-tambahBarang">
                        Tanggal: <span>Semua</span>
                    </a>

                    <button class="chip" id="btndropdownkategori">
                        Jenis Jurnal: <span id="textsumber"> Semua</span>
                    </button>
                </div>

                {{-- MENU  PERIODE --}}
                <div id="modal_periode" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
                    <div class="relative w-full max-w-lg h-full md:h-auto">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow p-4 ">
                            <!-- Modal header -->
                            <div class="flex justify-between items-start p-4 rounded-t border-b ">
                                <h3 class="text-xl font-semibold text-gray-900 ">
                                    Pilih Periode
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center "
                                    onclick="modaltambahmHide()">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>

                            {{-- MODAL ISI --}}
                            <div date-rangepicker class="flex items-center mt-3 mb-3">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <input name="start" type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Tanggal Awal">
                                </div>
                                <span class="mx-4 text-gray-500">sampai</span>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <input name="end" type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Tanggal Akhir">
                                </div>
                                <button type="button" id="btn-add-cart"
                                    class="w-6 flex ml-3 justify-center items-center text-white bg-red-500 hover:bg-red-300 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-300  focus:outline-none ">
                                    <span class="material-symbols-outlined text-white ">
                                        delete
                                    </span>
                                </button>
                            </div>

                            {{-- MODAL FOOTER --}}
                            <div class="block items-center justify-end   rounded-b  border-gray-200 ">
                                <button type="button" id="btn-add-cart"
                                    class="w-full flex justify-center items-center text-white bg-primary hover:bg-primarylight focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-300  focus:outline-none ">
                                    <span class="material-symbols-outlined text-white mr-3">
                                        save
                                    </span>Terapkan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- MENU JENIS JURNAL --}}
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
                                onclick="kategoriclose('Masuk')">Masuk</a>
                        </li>

                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                onclick="kategoriclose('Keluar')">Keluar</a>
                        </li>

                    </ul>
                </div>

                <table id="tb-master" class="stripe hover mt-10"
                    style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1" class="text-right text-xs">No</th>
                            <th data-priority="2" class="text-center text-xs">Tanggal</th>
                            <th data-priority="2" class="text-center text-xs">Masuk / Keluar</th>
                            <th data-priority="2" class="text-center text-xs">Nama Obat</th>
                            <th data-priority="2" class="text-center text-xs">Batch Masuk</th>
                            <th data-priority="2" class="text-center text-xs">Batch Keluar</th>
                            <th data-priority="2" class="text-center text-xs">Jumlah</th>
                            <th data-priority="3" class="text-center text-xs">Keterangan</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="text-right text-xs">1</td>
                            <td class="text-center text-xs">2023-01-16</td>
                            <td class="text-center text-xs">Masuk</td>
                            <td class="text-center text-xs">Acetylsistein kapsul 200 mg</td>
                            <td class="text-center text-xs">TI-20230116133756</td>
                            <td class="text-center text-xs">TI-20230116133756</td>
                            <td class="text-center text-xs">4</td>
                            <td class="text-left text-xs">ini keterangan yang panjang ini keterangan yang panjang ini
                                keterangan yang panjang ini keterangan yang panjang ini keterangan yang panjang ini
                                keterangan yang panjang ini keterangan yang panjang </td>

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


    {{-- MODAL PERIODE --}}
    <script>
        const modal_periode = document.getElementById('modal_periode');

        let modal_tambahb = new Modal(modal_periode, {
            placement: 'bottom-right',
            backdrop: 'dynamic',

            onShow: () => {

            },
            onHide: () => {

            }
        });


        function modaltambahmHide() {
            modal_tambahb.hide();
        }

        function modaleditmHide() {
            modal_tambahb.hide();
        }

        $('.btn-tambahBarang').on('click', function(e) {

            modal_tambahb.show();
        });
    </script>
@endsection
