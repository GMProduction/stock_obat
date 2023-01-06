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
                        <a href="{{ route('masterbarang') }}"
                           class="ml-1 text-sm font-medium text-gray-700  md:ml-2  ">Master Barang</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        <a href="#" class="ml-1 text-sm font-medium text-gray-700  md:ml-2  ">Master Satuan / Asal
                            Obat / Lokasi</a>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="section relative">
                <p class="title ">Master Satuan</p>
                <div class="absolute right-0 top-0 mt-3 mr-3">
                    <div class="flex">

                        <button
                            class="bg-blue-500 rounded-md flex items-center text-white px-3 py-2 text-sm btn-tambahsatuan"><span
                                class="material-symbols-outlined mr-2 menu-ico text-sm">
                                add
                            </span>Tambah
                        </button>
                    </div>
                </div>
                <table id="tb-satuan" class="stripe hover mt-10"
                       style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                    <tr>
                        <th data-priority="1" class="text-center text-sm">No</th>
                        <th data-priority="3" class="text-center text-sm">Nama Satuan</th>
                        <th data-priority="4" class="text-center text-sm">Action</th>
                    </tr>
                    </thead>
                    {{--                    <tbody>--}}
                    {{--                        <tr>--}}
                    {{--                            <td class="text-right text-sm">1</td>--}}
                    {{--                            <td class="text-left text-sm">Tablet</td>--}}
                    {{--                            <td class="text-center text-xs font-bold"><button--}}
                    {{--                                    class="bg-secondary rounded-full text-white px-3 py-2 btn-editsatuan">Edit</button></td>--}}
                    {{--                        </tr>--}}

                    {{--                        <!-- Rest of your data (refer to https://datatables.net/examples/server_side/ for server side processing)-->--}}

                    {{--                        <tr>--}}
                    {{--                            <td class="text-right text-sm">2</td>--}}
                    {{--                            <td class="text-left text-sm">Sacet</td>--}}
                    {{--                            <td class="text-center text-xs font-bold"><button--}}
                    {{--                                    class="bg-secondary rounded-full text-white px-3 py-2 btn-editsatuan">Edit</button></td>--}}
                    {{--                        </tr>--}}
                    {{--                    </tbody>--}}
                </table>
            </div>

            <div class="section relative">
                <p class="title">Master Sumber Anggaran</p>
                <div class="absolute right-0 top-0 mt-3 mr-3">
                    <div class="flex">

                        <button
                            class="bg-blue-500 rounded-md flex items-center text-white px-3 py-2 text-sm btn-tambahsumber"><span
                                class="material-symbols-outlined mr-2 menu-ico text-sm">
                                add
                            </span>Tambah
                        </button>
                    </div>
                </div>
                <table id="tb-asalobat" class="stripe hover mt-10"
                       style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                    <tr>
                        <th data-priority="1" class="text-right text-sm">No</th>
                        <th data-priority="3" class="text-left text-sm">Nama Sumber Anggaran</th>
                        <th data-priority="4" class="text-center text-sm">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-right text-sm">1</td>
                        <td class="text-left text-sm">APBN</td>
                        <td class="text-center text-xs font-bold">
                            <button
                                class="bg-secondary rounded-full text-white px-3 py-2 btn-editsumber">Edit
                            </button>
                        </td>
                    </tr>

                    <!-- Rest of your data (refer to https://datatables.net/examples/server_side/ for server side processing)-->

                    <tr>
                        <td class="text-right text-sm">2</td>
                        <td class="text-left text-sm">APBD</td>
                        <td class="text-center text-xs font-bold">
                            <button
                                class="bg-secondary rounded-full text-white px-3 py-2 btn-editsumber">Edit
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            {{-- <div class="section relative">
                <p class="title">Master Lokasi</p>
                <div class="absolute right-0 top-0 mt-3 mr-3">
                    <div class="flex">

                        <button class="bg-blue-500 rounded-md flex items-center text-white px-3 py-2 text-sm"><span
                                class="material-symbols-outlined mr-2 menu-ico text-sm">
                                add
                            </span>Tambah</button>
                    </div>
                </div>
                <table id="tb-lokasi" class="stripe hover mt-10"
                    style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1" class="text-right text-sm">No</th>
                            <th data-priority="3" class="text-left text-sm">Nama Lokasi</th>
                            <th data-priority="4" class="text-center text-sm">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-right text-sm">1</td>
                            <td class="text-left text-sm">Gudang</td>
                            <td class="text-center text-xs font-bold"><button
                                    onclick="location.href='/admin/stock/kodebarang'"
                                    class="bg-secondary rounded-full text-white px-3 py-2">Edit</button></td>
                        </tr>

                        <!-- Rest of your data (refer to https://datatables.net/examples/server_side/ for server side processing)-->

                        <tr>
                            <td class="text-right text-sm">2</td>
                            <td class="text-left text-sm">Puskesmas</td>
                            <td class="text-center text-xs font-bold"><button
                                    onclick="location.href='/admin/stock/kodebarang'"
                                    class="bg-secondary rounded-full text-white px-3 py-2">Edit</button></td>
                        </tr>
                    </tbody>
                </table>
            </div> --}}
        </div>


        <!-- Modal Tambah Satuan -->
        <div id="modal_tambahSatuan" tabindex="-1" aria-hidden="true"
             class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow ">
                    <!-- Modal header -->
                    <div class="flex justify-between items-start p-4 rounded-t border-b ">
                        <h3 class="text-xl font-semibold text-gray-900 ">
                            Tambah Satuan
                        </h3>
                        <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center "
                                onclick="modaltambahsHide()">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                      clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    {{-- FORM --}}
                    <form method="post" enctype="multipart/form-data" action="" id="form-patch">
                        @csrf
                        <input  name="id" id="id" value="">
                        <!-- Modal body -->
                        <div class="p-6 ">
                            <div class="mb-3">
                                <label for="e-nama-info" class="block mb-2 text-sm font-medium text-gray-700 ">Nama
                                    Satuan</label>
                                <input type="text" id="e-nama-info"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  block w-full p-2.5 "
                                       placeholder="Masukan Nama Satuan" required name="information-edit">
                            </div>


                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center justify-end p-6 space-x-2 rounded-b border-t border-gray-200 ">
                            <button type="submit" id="btn-patch"
                                    class="ml-auto flex items-center text-white bg-primary hover:bg-primarylight focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-300  focus:outline-none ">
                                <span class="material-symbols-outlined text-white mr-3">
                                    save
                                </span>Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit Satuan -->
        <div id="modal_editSatuan" tabindex="-1" aria-hidden="true"
             class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow ">
                    <!-- Modal header -->
                    <div class="flex justify-between items-start p-4 rounded-t border-b ">
                        <h3 class="text-xl font-semibold text-gray-900 ">
                            Edit Satuan
                        </h3>
                        <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center "
                                onclick="modaleditsHide()">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                      clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <form method="post" enctype="multipart/form-data" action="" id="form-patch">
                        @csrf
                        <input type="hidden" name="id" id="id-edit" value="">
                        <!-- Modal body -->
                        <div class="p-6 ">
                            <div class="mb-3">
                                <label for="e-nama-info" class="block mb-2 text-sm font-medium text-gray-700 ">Nama
                                    Satuan</label>
                                <input type="text" id="e-nama-info"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  block w-full p-2.5 "
                                       placeholder="Masukan Nama Satuan" required name="information-edit">
                            </div>


                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center justify-between p-6 space-x-2 rounded-b border-t border-gray-200 ">
                            <button type="submit" id="btn-patch"
                                    class=" flex items-center text-white bg-red-500 hover:bg-red-300 focus:ring-4  font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-300  focus:outline-none ">
                                <span class="material-symbols-outlined text-white mr-3">
                                    delete
                                </span>Hapus
                            </button>

                            <button type="submit" id="btn-patch"
                                    class="flex items-center text-white bg-primary hover:bg-primarylight focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-300  focus:outline-none ">
                                <span class="material-symbols-outlined text-white mr-3">
                                    save
                                </span>Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Sumber -->
        <div id="modal_tambahSumber" tabindex="-1" aria-hidden="true"
             class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow ">
                    <!-- Modal header -->
                    <div class="flex justify-between items-start p-4 rounded-t border-b ">
                        <h3 class="text-xl font-semibold text-gray-900 ">
                            Tambah Sumber Anggaran
                        </h3>
                        <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center "
                                onclick="modaltambahsmHide()">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                      clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <form method="post" enctype="multipart/form-data" action="" id="form-patch">
                        @csrf
                        <input type="hidden" name="id" id="id-edit" value="">
                        <!-- Modal body -->
                        <div class="p-6 ">
                            <div class="mb-3">
                                <label for="e-nama-info" class="block mb-2 text-sm font-medium text-gray-700 ">Nama
                                    Sumber Anggaran</label>
                                <input type="text" id="e-nama-info"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  block w-full p-2.5 "
                                       placeholder="Masukan Nama Sumber Anggaran" required name="information-edit">
                            </div>


                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center justify-end p-6 space-x-2 rounded-b border-t border-gray-200 ">
                            <button type="submit" id="btn-patch"
                                    class="ml-auto flex items-center text-white bg-primary hover:bg-primarylight focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-300  focus:outline-none ">
                                <span class="material-symbols-outlined text-white mr-3">
                                    save
                                </span>Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Modal Edit Sumber -->
        <div id="modal_editSumber" tabindex="-1" aria-hidden="true"
             class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow ">
                    <!-- Modal header -->
                    <div class="flex justify-between items-start p-4 rounded-t border-b ">
                        <h3 class="text-xl font-semibold text-gray-900 ">
                            Edit Sumber
                        </h3>
                        <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center "
                                onclick="modaleditsmHide()">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                      clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <form method="post" enctype="multipart/form-data" action="" id="form-patch">
                        @csrf
                        <input type="hidden" name="id" id="id-edit" value="">
                        <!-- Modal body -->
                        <div class="p-6 ">
                            <div class="mb-3">
                                <label for="e-nama-info" class="block mb-2 text-sm font-medium text-gray-700 ">Nama Sumber
                                    Anggaran</label>
                                <input type="text" id="e-nama-info"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  block w-full p-2.5 "
                                       placeholder="Masukan Sumber Anggaran" required name="information-edit">
                            </div>


                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center justify-between p-6 space-x-2 rounded-b border-t border-gray-200 ">
                            <button id="btn-patch" onclick="confirmDelete()"
                                    class=" flex items-center text-white bg-red-500 hover:bg-red-300 focus:ring-4  font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-300  focus:outline-none ">
                                <span class="material-symbols-outlined text-white mr-3">
                                    delete
                                </span>Hapus
                            </button>

                            <button type="submit" id="btn-patch"
                                    class="flex items-center text-white bg-primary hover:bg-primarylight focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 transition duration-300  focus:outline-none ">
                                <span class="material-symbols-outlined text-white mr-3">
                                    save
                                </span>Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('morejs')
    <!--Datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="{{asset('js/datatable.js')}}"></script>

    <script>
        $(document).ready(function () {

            // INITIAL DATA TABLES

            //
            // var table = $('#tb-satuan').DataTable({
            //         responsive: true
            //     })
            //     .columns.adjust()
            //     .responsive.recalc();

            var table = $('#tb-asalobat').DataTable({
                responsive: true
            })
                .columns.adjust()
                .responsive.recalc();

            var table = $('#tb-lokasi').DataTable({
                responsive: true
            })
                .columns.adjust()
                .responsive.recalc();

            // Modal Function

        });
    </script>

    {{-- MODAL SATUAN --}}
    <script>
        const modal_tambahSatuan = document.getElementById('modal_tambahSatuan');
        const modal_editSatuan = document.getElementById('modal_editSatuan');

        let modal_tambahs = new Modal(modal_tambahSatuan, {
            placement: 'bottom-right',
            backdrop: 'dynamic',
            onShow: () => {

            },
            onHide: () => {

            }
        });

        let modal_edits = new Modal(modal_editSatuan, {
            placement: 'bottom-right',
            backdrop: 'dynamic',
            onShow: () => {

            },
            onHide: () => {

            }
        });

        function modaltambahsHide() {
            modal_tambahs.hide();
        }

        function modaleditsHide() {
            modal_edits.hide();
        }

        $('.btn-tambahsatuan').on('click', function (e) {

            modal_tambahs.show();
        });

        $('.btn-editsatuan').on('click', function (e) {

            modal_edits.show();
        });

        $(document).on('click', '#editData', function () {
            modal_tambahs.show();
        })
    </script>

    {{-- MODAL SUMBER ANGGARAN --}}

    <script>
        const modal_tambahSumber = document.getElementById('modal_tambahSumber');
        const modal_editSumber = document.getElementById('modal_editSumber');

        let modal_tambahsm = new Modal(modal_tambahSumber, {
            placement: 'bottom-right',
            backdrop: 'dynamic',
            onShow: () => {

            },
            onHide: () => {

            }
        });

        let modal_editsm = new Modal(modal_editSumber, {
            placement: 'bottom-right',
            backdrop: 'dynamic',
            onShow: () => {

            },
            onHide: () => {

            }
        });

        $('.btn-tambahsumber').on('click', function (e) {

            modal_tambahsm.show();
        });

        $('.btn-editsumber').on('click', function (e) {

            modal_editsm.show();
        });

        function modaltambahsmHide() {
            modal_tambahsm.hide();
        }

        function modaleditsmHide() {
            modal_editsm.hide();
        }
    </script>


    {{-- FUNCTION --}}
    <script>
        function confirmDelete() {
            Swal.fire({
                title: 'Kamu Yakin?',
                text: "Menghapus data ini tidak bisa dikembalikan lagi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Data Dihapus!',
                        'Data TElah TErhapus.',
                        'success'
                    )
                }
            })
        }

        $(document).ready(function () {
            datatableUnit('tb-satuan', '{{route('datatableUnit')}}')
        })

        function datatableUnit(tb, url) {
            let columns = [
                {
                    className: "text-center",
                    orderable: false,
                    defaultContent: "",
                    searchable: false
                },
                {data: 'name', name: 'name'},
                {
                    className: "text-center",
                    data: 'action', name: 'action', orderable: false, searchable: false
                },
            ]
            datatable(tb, url, columns)
        }

    </script>
@endsection
