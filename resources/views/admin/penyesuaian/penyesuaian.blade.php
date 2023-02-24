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
                        <a href="#" class="ml-1 text-sm font-medium text-gray-700  md:ml-2  ">Penyesuaian Stock</a>
                    </div>
                </li>

            </ol>
        </nav>

        <div class="">
            <div class="section relative">
                <p class="title ">Penyesuain Stock </p>
                <div class="absolute right-0 top-0 mt-3 mr-3">
                    <div class="flex gap-1">

                        <a href="#" onclick="modalBarangShow()"
                            class="btn-excel bg-green-500 hover:bg-green-300 transition-all duration-300 rounded-md flex items-center text-white px-3 py-2 text-sm mr-3">

                            Tambah Penyesuaian
                        </a>

                    </div>
                </div>

                {{-- FILTER --}}
                <input id="NoIconDemo" type="text" />
                <div class="mb-2">
                    <button class="chip btn-modalperiode">
                        Bulan: <span id="textsumber">Januari 2023</span>
                    </button>
                </div>

                {{-- MENU  BULAN --}}
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
                                    onclick="modalPeriodeHide()">
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
                            <div date-rangepicker datepicker-format="dd MM yyyy" datepicker-autohide
                                class="flex items-center mt-3 mb-3" id="date-range-element">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 " fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <input name="date_start" type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                                        placeholder="Tanggal Awal" id="date_start"
                                        value="{{ \Carbon\Carbon::now()->startOfMonth()->format('d F Y') }}">
                                </div>
                                <span class="mx-4 text-gray-500">sampai</span>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 " fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <input name="date_end" type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  "
                                        placeholder="Tanggal Akhir" id="date_end"
                                        value="{{ \Carbon\Carbon::now()->format('d F Y') }}">
                                </div>
                            </div>

                            {{-- MODAL FOOTER --}}
                            <div class="block items-center justify-end   rounded-b  border-gray-200 ">
                                <button type="button" id="btn-submit-date-range"
                                    class="w-full flex justify-center items-center text-white bg-primary hover:bg-primarylight focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-300  focus:outline-none ">
                                    <span class="material-symbols-outlined text-white mr-3">
                                        save
                                    </span>Terapkan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>



                {{-- MENU  PENYESUAIAN --}}
                <div id="modal_penyesuaian" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
                    <div class="relative w-full max-w-4xl h-full md:h-auto">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow p-4 ">
                            <!-- Modal header -->
                            <div class="flex justify-between items-start p-4 rounded-t border-b ">
                                <h3 class="text-xl font-semibold text-gray-900 ">
                                    Detail Penyesuaian
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center "
                                    onclick="modalPenyesuaianHide()">
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
                            <div class="mt-10">
                                <div class="grid grid-cols-3 gap-3">
                                    <div>
                                        <label for="nomor_penyesuaian"
                                            class="block mb-2 text-sm font-medium text-gray-900">Nomor
                                            Penyesuaian</label>
                                        <input type="text" id="nomor_penyesuaian"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                            readonly>
                                    </div>

                                    <div>
                                        <label for="nama_obat" class="block mb-2 text-sm font-medium text-gray-900">Nama
                                            Obat (Satuan)</label>
                                        <input type="text" id="nama_obat"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                            readonly>
                                    </div>
                                    <div>
                                        <label for="tanggal_penyesuaian"
                                            class="block mb-2 text-sm font-medium text-gray-900">Tanggal</label>
                                        <input type="text" id="tanggal_penyesuaian"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                            readonly>
                                    </div>
                                </div>


                                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-10">
                                    <table class="w-full text-sm text-left text-gray-500 ">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-center">
                                                    Tanggal Kadaluarsa
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-center">
                                                    Lokasi
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-right">
                                                    Qty Sistem
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-right">
                                                    Qty Sebenarnya
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-right">
                                                    Selisih
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-right">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="bg-white border-b ">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                                                    02 Maret 2023
                                                </th>
                                                <td class="px-6 py-4 text-center">
                                                    Gudang
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                    50
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                    10
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                    40
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="#"
                                                        class="font-medium text-blue-600  hover:underline">Edit</a>
                                                </td>
                                            </tr>

                                            <tr class="bg-white border-b ">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                                                    20 Maret 2023
                                                </th>
                                                <td class="px-6 py-4 text-center">
                                                    Toko
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                    50
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                    10
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                    40
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="#"
                                                        class="font-medium text-blue-600  hover:underline">Edit</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <label for="keterangan"
                                    class="block mb-2 mt-10 text-sm font-medium text-gray-900 ">Keterangan</label>
                                <textarea id="keterangan" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Gak tau hilang kemana hehe"></textarea>

                            </div>


                        </div>
                    </div>
                </div>



                {{-- MODAL TAMPIL BARANG --}}
                <div id="modal_barang" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
                    <div class="relative w-full max-w-4xl h-full md:h-auto">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow p-4 ">
                            <!-- Modal header -->
                            <div class="flex justify-between items-start p-4 rounded-t border-b ">
                                <h3 class="text-xl font-semibold text-gray-900 ">
                                    Pilih Barang untuk disesuaikan
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center "
                                    onclick="modalBaranganHide()">
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
                            <div class="mt-10 w-full">

                                <table id="tabel-barang" class=" w-full text-sm text-left text-gray-500 ">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                        <tr>
                                            <th class="px-6 py-3 text-center">
                                                Nama Barang (Satuan)
                                            </th>

                                            <th class="px-6 py-3 text-right">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="bg-white border-b ">
                                            <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                                                Obat Kuat (tablet)
                                            </th>

                                            <td class="px-6 py-4">
                                                <a href="{{ route('tambahpenyesuaian') }}"
                                                    class="font-medium text-blue-600  hover:underline">Sesuaikan</a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <table id="tb-penyesuaian" class="stripe hover mt-10"
                    style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1" class="text-center text-xs">No</th>
                            <th data-priority="2" class="text-center text-xs">Nomor Penyesuaian</th>
                            <th data-priority="2" class="text-center text-xs">Nama Barang (Satuan)</th>
                            <th data-priority="2" class="text-center text-xs">Tanggal</th>
                            <th data-priority="2" class="text-right text-xs">Qty Sistem</th>
                            <th data-priority="2" class="text-right text-xs">Qty Sebenarnya</th>
                            <th data-priority="2" class="text-center text-xs">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-priority="1" class="text-center text-xs">1</td>
                            <td data-priority="2" class="text-center text-xs">pny000123</td>
                            <td data-priority="2" class="text-center text-xs">Panadol (plek)</td>
                            <td data-priority="2" class="text-center text-xs">12 Desember 2023</td>
                            <td data-priority="2" class="text-right text-xs">20</td>
                            <td data-priority="2" class="text-right text-xs">100</td>

                            <td class="text-center">
                                <a href="#" onclick="modalPenyesuaianShow()"
                                    class=" bg-blue-500 hover:bg-blue-300 transition-all duration-300 rounded-md   text-white px-3 py-2 text-sm ">

                                    Detail
                                </a>
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
        var table = $('#tb-penyesuaian').DataTable({
                responsive: true,
                paging: false,
                ordering: false,
                info: false,
            })
            .columns.adjust()
            .responsive.recalc();

        var tb_brg = $('#tabel-barang').DataTable({
                responsive: true,
                paging: false,
                ordering: false,
                info: false,
            })
            .columns.adjust()
            .responsive.recalc();
    </script>

    <script>
        //    MODAL BULAN
        const modal_periode = document.getElementById('modal_periode');

        let modal_period = new Modal(modal_periode, {
            placement: 'bottom-right',
            backdrop: 'dynamic',

            onShow: () => {

            },
            onHide: () => {

            }
        });


        function modalPeriodeHide() {
            modal_period.hide();
        }

        function modaleditmHide() {
            modal_period.hide();
        }

        $('.btn-modalperiode').on('click', function(e) {

            modal_period.show();
        });



        //    MODAL DETAIL PENYESUAIAN
        const modal_penyesuaian = document.getElementById('modal_penyesuaian');

        let modal_penyesuai = new Modal(modal_penyesuaian, {
            placement: 'bottom-right',
            backdrop: 'dynamic',

            onShow: () => {

            },
            onHide: () => {

            }
        });


        function modalPenyesuaianShow() {
            modal_penyesuai.show();
        }

        function modalPenyesuaianHide() {
            modal_penyesuai.hide();
        }



        //    PILIH OBAT UNTUK DISESUAIKAN
        const modal_barang = document.getElementById('modal_barang');

        let modal_brg = new Modal(modal_barang, {
            placement: 'bottom-right',
            backdrop: 'dynamic',

            onShow: () => {

            },
            onHide: () => {

            }
        });


        function modalBarangShow() {
            modal_brg.show();
        }

        function modalBaranganHide() {
            modal_brg.hide();
        }
    </script>
@endsection
