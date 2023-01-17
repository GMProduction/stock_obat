@extends('admin.base')

@section('css')
    <link rel="stylesheet" href="{{ asset('local/vendor/select2/dist/css/select2.min.css') }}" type="text/css">
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
                    <div class="flex items-center ">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <a href="rou" class="ml-1 text-sm font-medium text-gray-700  md:ml-2  ">Pengeluaran Barang</a>
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
                        <a href="#" class="ml-1 text-sm font-medium text-gray-700  md:ml-2  ">Tambah Barang</a>
                    </div>
                </li>

            </ol>
        </nav>




        <div class="grid grid-cols-1 gap-4">
            <div class="section relative min-h-[600px]">
                <p class="title ">Tambah Barang </p>
                <div class="grid grid-cols-3 gap-2 ">


                    <div class="border rounded-md col-span-2 p-3 relative">
                        <p class="text-gray-500">Barang yang dikeluarkan</p>
                        <div class="absolute right-0 top-0 mt-3 mr-3">
                            <div class="flex">


                                <button
                                    class="bg-blue-500 rounded-md flex items-center text-white px-3 py-2 text-sm btn-tambahBarang"><span
                                        class="material-symbols-outlined mr-2 menu-ico text-sm">
                                        add
                                    </span>Tambah</button>
                            </div>
                        </div>
                        <table id="tb-master" class="table table-auto stripe hover mt-10 "
                            style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                            <thead class="bg-gray-50 ">
                                <tr>
                                    <th data-priority="1" class="text-right text-xs py-3">No</th>
                                    <th data-priority="2" class="text-center text-xs">Nama Barang</th>
                                    <th data-priority="2" class="text-center text-xs">Qty</th>
                                    <th data-priority="3" class="text-center text-xs">Satuan</th>
                                    <th data-priority="3" class="text-center text-xs">Kadaluarsa</th>
                                    <th data-priority="4" class="text-center text-xs">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr class="border-b">
                                    <td class="text-right text-xs py-3">1</td>
                                    <td class="text-center text-xs">Paracetamol</td>
                                    <td class="text-center text-xs">2</td>
                                    <td class="text-center text-xs">Tablet</td>
                                    <td class="text-center text-xs">20 Desember 2024</td>

                                    <td class="text-center text-xs font-bold flex flex-nowrap gap-1 justify-center py-3">
                                        <button
                                            class="bg-secondary rounded-full text-white px-3 py-2 btn-tambahMaster text-xs">Ubah</button>
                                        <button class="bg-red-500 rounded-full text-white px-3 py-2 text-xs"
                                            onclick="confirmDelete(function(){alert('ok')}, function(){alert('cancel')})">Hapus</button>
                                    </td>
                                </tr>

                                <tr class="border-b">
                                    <td class="text-right text-xs py-3">1</td>
                                    <td class="text-center text-xs">Paracetamol</td>
                                    <td class="text-center text-xs">2</td>
                                    <td class="text-center text-xs">Tablet</td>
                                    <td class="text-center text-xs">20 Desember 2024</td>

                                    <td class="text-center text-xs font-bold flex flex-nowrap gap-1 justify-center py-3">
                                        <button
                                            class="bg-secondary rounded-full text-white px-3 py-2 btn-tambahMaster text-xs">Ubah</button>
                                        <button class="bg-red-500 rounded-full text-white px-3 py-2 text-xs"
                                            onclick="confirmDelete(function(){alert('ok')}, function(){alert('cancel')})">Hapus</button>
                                    </td>
                                </tr>

                                <tr class="border-b">
                                    <td class="text-right text-xs py-3">1</td>
                                    <td class="text-center text-xs">Paracetamol</td>
                                    <td class="text-center text-xs">2</td>
                                    <td class="text-center text-xs">Tablet</td>
                                    <td class="text-center text-xs">20 Desember 2024</td>

                                    <td class="text-center text-xs font-bold flex flex-nowrap gap-1 justify-center py-3">
                                        <button
                                            class="bg-secondary rounded-full text-white px-3 py-2 btn-tambahMaster text-xs">Ubah</button>
                                        <button class="bg-red-500 rounded-full text-white px-3 py-2 text-xs"
                                            onclick="confirmDelete(function(){alert('ok')}, function(){alert('cancel')})">Hapus</button>
                                    </td>
                                </tr>

                                <tr class="border-b">
                                    <td class="text-right text-xs py-3">1</td>
                                    <td class="text-center text-xs">Paracetamol</td>
                                    <td class="text-center text-xs">2</td>
                                    <td class="text-center text-xs">Tablet</td>
                                    <td class="text-center text-xs">20 Desember 2024</td>

                                    <td class="text-center text-xs font-bold flex flex-nowrap gap-1 justify-center py-3">
                                        <button
                                            class="bg-secondary rounded-full text-white px-3 py-2 btn-tambahMaster text-xs">Ubah</button>
                                        <button class="bg-red-500 rounded-full text-white px-3 py-2 text-xs"
                                            onclick="confirmDelete(function(){alert('ok')}, function(){alert('cancel')})">Hapus</button>
                                    </td>
                                </tr>

                                <tr class="border-b">
                                    <td class="text-right text-xs py-3">1</td>
                                    <td class="text-center text-xs">Paracetamol</td>
                                    <td class="text-center text-xs">2</td>
                                    <td class="text-center text-xs">Tablet</td>
                                    <td class="text-center text-xs">20 Desember 2024</td>

                                    <td class="text-center text-xs font-bold flex flex-nowrap gap-1 justify-center py-3">
                                        <button
                                            class="bg-secondary rounded-full text-white px-3 py-2 btn-tambahMaster text-xs">Ubah</button>
                                        <button class="bg-red-500 rounded-full text-white px-3 py-2 text-xs"
                                            onclick="confirmDelete(function(){alert('ok')}, function(){alert('cancel')})">Hapus</button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>


                    </div>

                    <div class="border rounded-md p-3">
                        <p class="text-gray-500">Informasi pengeluaran</p>



                        <div class="mb-3 mt-5">
                            <label for="nomor-batch" class="block mb-2 text-sm font-medium text-gray-700 mt-3">Tanggal
                                Dikeluarkan
                            </label>
                            <div class="relative">
                                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input datepicker datepicker-autohide datepicker-format="dd MM yyyy" type="text"
                                    required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  "
                                    placeholder="Pilih Tanggal">
                            </div>
                        </div>

                        <div class="mb-3 mt-5">
                            <label for="unit_penerima"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Unit Penerima</label>

                            <div class="flex">
                                <select id="unit_penerima" name="unit_penerima"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Pilih Unit Penerima</option>
                                        <option value="Unit Penerima"></option>
                                </select>

                                <button data-tooltip-target="tooltip-unit_penerima" type="button"
                                    class="bg-blue-500 ml-3 rounded-md flex items-center justify-center text-white px-3 py-2 text-sm btn-unit_penerima"><span
                                        class="material-symbols-outlined menu-ico text-sm">
                                        add
                                    </span></button>

                                <div id="tooltip-unit_penerima" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    Tambah unit penerima "jika belum ada di dalam menu"
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </div>
                        </div>



                        <div class="mb-3 mt-5">
                            <label for="nomor-batch" class="block mb-2 text-sm font-medium text-gray-700 mt-3">Catatan
                                pengeluaran
                            </label>
                            <textarea type="text" id="e-nama-info"
                                class="bg-gray-50 border rounded-md w-full border-gray-300 text-gray-900 text-sm  block  p-2.5 " rows="4"
                                placeholder="Catatan Pengeluaran" name="Catatan Pengeluaran"></textarea>
                        </div>

                    </div>

                </div>

                <div class="flex items-center justify-end pt-6 rounded-b border-t border-gray-200 ">
                    <button type="submit" id="btn-patch"
                        class="ml-auto flex items-center text-white bg-primary hover:bg-primarylight focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 transition duration-300  focus:outline-none ">
                        <span class="material-symbols-outlined text-white mr-3">
                            save
                        </span>Simpan Data
                    </button>

                    <button type="submit" id="btn-patch"
                        class="ml-3 flex items-center text-white bg-secondary hover:bg-orange-300 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 transition duration-300  focus:outline-none ">
                        <span class="material-symbols-outlined text-white mr-3">
                            print
                        </span>Simpan dan Cetak
                    </button>

                </div>
            </div>

        </div>

        <!-- Modal Tambah Master -->
        <div id="modal_tambahBarang" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
            <div class="relative p-4 w-full max-w-4xl h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow ">
                    <!-- Modal header -->
                    <div class="flex justify-between items-start p-4 rounded-t border-b ">
                        <h3 class="text-xl font-semibold text-gray-900 ">
                            Tambah Barang
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
                    <form method="post" enctype="multipart/form-data" action="" id="form-patch">
                        @csrf
                        <input type="hidden" name="id" id="id-edit" value="">
                        <!-- Modal body -->

                        <div class="p-6 ">
                            <label for="namabarang" class="block mb-2 text-sm font-medium text-gray-900 ">Pilih
                                Barang</label>
                            <select
                                class="js-example-basic-single bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                name="anggaran">
                                <option selected>Pilih Barang</option>
                                <option value="US">Paracetamol</option>
                                <option value="CA">Obat Mencret</option>
                            </select>




                            <div class="flex gap-4">
                                <div class="mb-3">
                                    <label for="qty" class="block mb-2 text-sm font-medium text-gray-700 mt-3">Qty
                                    </label>
                                    <input type="number" id="qty" min="1"
                                        class="bg-gray-50 border min-w-[100px] border-gray-300 text-gray-900 text-sm  block w-full p-2.5 "
                                        placeholder="Qty yang dikeluarkan" required name="qty">
                                </div>

                                <div class="mb-3 grow">
                                    <label for="satuan" class="block mb-2 text-sm font-medium text-gray-700 mt-3">Satuan
                                    </label>
                                    <input type="number" id="qty"
                                        class="bg-gray-200  border border-gray-300 text-gray-900 text-sm  block w-full p-2.5 "
                                        placeholder="Satuan" readonly name="satuan">
                                </div>
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


        <!-- Modal Tambah Penerima -->
        <div id="modal_unit_penerima" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow ">
                    <!-- Modal header -->
                    <div class="flex justify-between items-start p-4 rounded-t border-b ">
                        <h3 class="text-xl font-semibold text-gray-900 ">
                            Tambah Unit Penerima
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
                                    Unit Penerima</label>
                                <input type="text" id="e-nama-info"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  block w-full p-2.5 "
                                    placeholder="Masukan Nama Unit Penerima" required name="information-edit">
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
    <script src="{{ asset('js/datepicker.js') }}"></script>
    <script src="{{ asset('local/vendor/select2/dist/js/select2.min.js') }}"></script>


    {{-- MODAL MASTER --}}
    <script>
        const modal_tambahBarang = document.getElementById('modal_tambahBarang');

        let modal_tambahb = new Modal(modal_tambahBarang, {
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


    {{-- MODAL UNIT PENERIMA --}}
    <script>
        const modal_unit_penerima = document.getElementById('modal_unit_penerima');

        let modal_tambahsm = new Modal(modal_unit_penerima, {
            placement: 'bottom-right',
            backdrop: 'dynamic',
            onShow: () => {
                modal_tambahm.hide();
            },
            onHide: () => {
                modal_tambahm.show();
            }
        });

        $('.btn-unit_penerima').on('click', function(e) {

            modal_tambahsm.show();
        });

        function modaltambahsmHide() {
            modal_tambahsm.hide();
        }
    </script>


    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
    {{-- ACTION --}}
@endsection
