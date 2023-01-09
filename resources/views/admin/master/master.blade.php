@extends('admin.base')

@section('css')
    <!--Regular Datatables CSS-->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <!--Responsive Extension Datatables CSS-->
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="{{asset('js/select2/select2.min.css')}}" rel="stylesheet"/>
    <style>

        .select2-selection__rendered {
            line-height: 40px !important;
        }

        .select2-container {
            width: 100% !important;
        }

        .select2-container .select2-selection--single {
            height: auto !important;
            width: 100% !important;
        }

        .select2-selection__arrow {
            height: 40px !important;
        }

        .select2-container--default .select2-selection--single {
            border: 1px solid #ddd !important;
        }
    </style>
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
                        <a href="#" class="ml-1 text-sm font-medium text-gray-700  md:ml-2  ">Master Barang</a>
                    </div>
                </li>

            </ol>
        </nav>

        <div class="grid grid-cols-1 gap-4">
            <div class="section relative">
                <p class="title ">Master Barang </p>
                <div class="absolute right-0 top-0 mt-3 mr-3">
                    <div class="flex">
                        <button class="bg-green-500 rounded-md flex items-center text-white px-3 py-2 text-sm mr-3"><span
                                class="material-symbols-outlined mr-2 menu-icon text-sm">
                                filter_alt
                            </span>Filter
                        </button>
                        <button onclick="location.href='{{ route('masterother') }}'"
                                class="bg-teal-500 rounded-md flex items-center text-white px-3 py-2 text-sm mr-3"><span
                                class="material-symbols-outlined mr-2 menu-icon text-sm">
                                feed
                            </span>Master Satuan / Asal Obat / Lokasi
                        </button>
                        <button
                            class="bg-blue-500 rounded-md flex items-center text-white px-3 py-2 text-sm btn-tambahMaster"><span
                                class="material-symbols-outlined mr-2 menu-ico text-sm">
                                add
                            </span>Tambah
                        </button>
                    </div>
                </div>
                <table id="tb-master" class="hover mt-10"
                       style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                    <tr>
                        <th class="text-center text-sm">No</th>
                        <th class="text-center text-sm">Nama Obat</th>
                        <th class="text-center text-sm">Kategori</th>
                        <th class="text-center text-sm">Stok</th>
                        <th class="text-center text-sm">Satuan</th>
                        <th class="text-center text-sm">Qty Minimum Warning</th>
                        <th class="text-center text-sm">Action</th>
                    </tr>
                    </thead>
                    {{--                    <tbody>--}}
                    {{--                        <tr>--}}
                    {{--                            <td class="text-right text-sm">1</td>--}}
                    {{--                            <td class="text-center text-sm">Paracetamol</td>--}}
                    {{--                            <td class="text-center text-sm">APBD</td>--}}
                    {{--                            <td class="text-center text-sm">Tablet</td>--}}
                    {{--                            <td class="text-center text-sm">3</td>--}}
                    {{--                            <td class="text-center text-xs font-bold">--}}
                    {{--                                <button--}}
                    {{--                                    class="bg-secondary rounded-full text-white px-3 py-2 btn-tambahMaster">Ubah</button>--}}
                    {{--                                <button class="bg-red-500 rounded-full text-white px-3 py-2"--}}
                    {{--                                    onclick="confirmDelete(function(){alert('ok')}, function(){alert('cancel')})">Hapus</button>--}}
                    {{--                            </td>--}}
                    {{--                        </tr>--}}

                    {{--                        <tr>--}}
                    {{--                            <td class="text-right text-sm">2</td>--}}
                    {{--                            <td class="text-center text-sm">Obat Mencret</td>--}}
                    {{--                            <td class="text-center text-sm">APBD</td>--}}
                    {{--                            <td class="text-center text-sm">Tablet</td>--}}
                    {{--                            <td class="text-center text-sm">5</td>--}}
                    {{--                            <td class="text-center text-xs font-bold">--}}
                    {{--                                <button--}}
                    {{--                                    class="bg-secondary rounded-full text-white px-3 py-2 btn-tambahMaster">Ubah</button>--}}
                    {{--                                <button class="bg-red-500 rounded-full text-white px-3 py-2"--}}
                    {{--                                    onclick="confirmDelete(function(){alert('ok')}, function(){alert('cancel')})">Hapus</button>--}}
                    {{--                        </tr>--}}

                    {{--                    </tbody>--}}
                </table>
            </div>

        </div>

        <!-- Modal Tambah Master -->
        <div id="modal_tambahMaster" tabindex="-1" aria-hidden="true"
             class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
            <div class="relative p-4 w-full max-w-4xl h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow ">
                    <!-- Modal header -->
                    <div class="flex justify-between items-start p-4 rounded-t border-b ">
                        <h3 class="text-xl font-semibold text-gray-900 ">
                            Tambah Master Obat
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
                    <form onsubmit="return saveMedicine()" id="form-patch">
                        @csrf
                        <input type="hidden" name="id" id="medicineId" value="">
                        <!-- Modal body -->


                        <div class="p-6 ">
                            <div class="mb-3">
                                <label for="nama-barang" class="block mb-2 text-sm font-medium text-gray-700 mt-3">Nama Barang </label>
                                <input type="text" id="medicineName"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  block w-full p-2.5 "
                                       placeholder="Masukan Nama Barang" required name="name">
                            </div>

                            <label for="countries"
                                   class="block mt-3 text-sm font-medium text-gray-900 dark:text-white">Kategori Obat</label>
                            <div class="flex flex-col">
                                 <span id="tooltip-tambahsatuan" class="block mb-2 text-xs font-bold text-gray-900 dark:text-white">
                                    Jika data kategori obat tidak ditemukan, ketik data satuan kemudian tekan "enter"
                                </span>
                                <select id="selectCategory" name="category_id"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </select>

                                {{--                                <button data-tooltip-target="tooltip-tambahsumber" type="button"--}}
                                {{--                                        class="bg-blue-500 ml-3 rounded-md flex items-center justify-center text-white px-3 py-2 text-sm btn-tambahsumber"><span--}}
                                {{--                                        class="material-symbols-outlined menu-ico text-sm">--}}
                                {{--                                        add--}}
                                {{--                                    </span></button>--}}

                            </div>

                            <label for="countries"
                                   class="block  text-sm font-medium text-gray-900 dark:text-white mt-3">Pilih
                                Satuan</label>

                            <div class="flex flex-col">
                                 <span id="tooltip-tambahsatuan" class="block mb-2 text-xs font-bold text-gray-900 dark:text-white">
                                    Jika data satuan obat tidak ditemukan, ketik data satuan kemudian tekan "enter"
                                </span>
                                <select id="selectUnit" name="unit_id"
                                        class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </select>

                                {{--                                <button data-tooltip-target="tooltip-tambahsatuan" type="button"--}}
                                {{--                                        class="bg-blue-500 ml-3 rounded-md flex items-center justify-center text-white px-3 py-2 text-sm btn-tambahsatuan"><span--}}
                                {{--                                        class="material-symbols-outlined menu-ico text-sm">--}}
                                {{--                                        add--}}
                                {{--                                    </span></button>--}}


                            </div>

                            <div class="mb-3">
                                <label for="e-nama-info" class="block mb-2 text-sm font-medium text-gray-700 mt-3">Qty
                                    Minimum Warning </label>
                                <input type="number" id="medicineLimit" min="1"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  block w-full p-2.5 "
                                       placeholder="Qty Minimum Warning" required name="limit">
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
    </div>
@endsection

@section('morejs')
    <!--Datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="{{asset('js/select2/select2.min.js')}}"></script>
    <script src="{{asset('js/component.js')}}"></script>
    <script>
        $(document).ready(function () {

            //     var table = $('#tb-master').DataTable({
            //         responsive: true
            //     })
            //         .columns.adjust()
            //         .responsive.recalc();
            tabel();
            getSelect('selectCategory', '{{route('categoryjson')}}', 'name', null, 'Pilih Kategori Obat', true)
            getSelect('selectUnit', '{{route('unitjson')}}', 'name', null, 'Pilih Satuan Obat', true)
        });
    </script>

    {{-- MODAL MASTER --}}
    <script>
        const modal_tambahMaster = document.getElementById('modal_tambahMaster');

        let modal_tambahm = new Modal(modal_tambahMaster, {
            placement: 'bottom-right',
            backdrop: 'dynamic',
            onShow: () => {

            },
            onHide: () => {

            }
        });

        function modaltambahmHide() {
            modal_tambahm.hide();
        }

        function modaleditmHide() {
            modal_editMaster.hide();
        }

        $('.btn-tambahMaster').on('click', function (e) {
            $('#selectUnit').val('').trigger('change');
            $('#selectCategory').val('').trigger('change');
            $('#medicineName').val('');
            $('#medicineLimit').val('');
            $('#medicineId').val('');
            modal_tambahm.show();
        });

        $(document).on('click', '#editData', function () {
            $('#selectUnit').val($(this).data('unit_id')).trigger('change');
            $('#selectCategory').val($(this).data('category_id')).trigger('change');
            $('#medicineName').val($(this).data('name'));
            $('#medicineLimit').val($(this).data('limit'));
            $('#medicineId').val($(this).data('id'));
            modal_tambahm.show();
        })
    </script>


    {{-- MODAL SUMBER ANGGARAN --}}
    <script>
        const modal_tambahSumber = document.getElementById('modal_tambahSumber');

        let modal_tambahsm = new Modal(modal_tambahSumber, {
            placement: 'bottom-right',
            backdrop: 'dynamic',
            onShow: () => {
                modal_tambahm.hide();
            },
            onHide: () => {
                modal_tambahm.show();
            }
        });

        $('.btn-tambahsumber').on('click', function (e) {

            modal_tambahsm.show();
        });

        function modaltambahsmHide() {
            modal_tambahsm.hide();
        }
    </script>

    {{-- MODAL SATUAN --}}
    <script>
        const modal_tambahSatuan = document.getElementById('modal_tambahSatuan');

        let modal_tambahs = new Modal(modal_tambahSatuan, {
            placement: 'bottom-right',
            backdrop: 'dynamic',
            onShow: () => {
                modal_tambahm.hide();
            },
            onHide: () => {
                modal_tambahm.show();
            }
        });

        function modaltambahsHide() {
            modal_tambahs.hide();
        }

        $('.btn-tambahsatuan').on('click', function (e) {

            modal_tambahs.show();
        });

        function tabel() {
            let colums = [
                {
                    className: "text-center",
                    orderable: false,
                    defaultContent: "",
                    searchable: false
                },
                {data: 'name', name: 'name'},
                {data: 'category.name', name: 'category.name',},
                {
                    data: 'qty', name: 'qty', className: 'text-center'
                },
                {data: 'unit.name', name: 'unit.name', className: 'text-center'},
                {data: 'limit', name: 'limit', className: 'text-center'},
                {
                    className: "text-center",
                    data: 'action', name: 'action', orderable: false, searchable: false
                },
            ];
            let createdRow = function( row, data, dataIndex ) {
                console.log(data)
                if ( data.qty < data.limit ) {
                    $(row).addClass( 'bg-red-100' );
                }
                console.log(row)

            };
            datatable('tb-master', '{{route('masterdatatable')}}', colums, createdRow)
        }

        function saveMedicine() {
            confirmSave('Simpan Data', 'Apa anda yakin ?', 'form-patch', '{{route('masterbarang')}}', responseMedicine)
            return false;
        }

        function responseMedicine() {
            modaltambahmHide();
            $("#tb-master").DataTable().ajax.reload();
            getSelect('selectCategory', '{{route('categoryjson')}}', 'name', null, 'Pilih Kategori Obat', true)
            getSelect('selectUnit', '{{route('unitjson')}}', 'name', null, 'Pilih Satuan Obat', true)
        }
    </script>

    {{-- ACTION --}}
@endsection
