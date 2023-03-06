@extends('admin.base')

@section('css')
    <!--Regular Datatables CSS-->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <!--Responsive Extension Datatables CSS-->
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('local/vendor/select2/dist/css/select2.min.css') }}" type="text/css">
    <style>
        .backdrop-loader {
            position: fixed;
            display: none;
            width: 100%;
            height: 100vh;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            cursor: pointer;
        }

        .backdrop-content {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: progress;
        }

        .dataTables_empty {
            text-align: center !important;
        }
    </style>
@endsection
@section('content')
    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire("Berhasil!", '{{ \Illuminate\Support\Facades\Session::get('success') }}', "success")
        </script>
    @endif

    @if (\Illuminate\Support\Facades\Session::has('failed'))
        <script>
            Swal.fire("Gagal", '{{ \Illuminate\Support\Facades\Session::get('failed') }}', "error")
        </script>
    @endif
    <div class="backdrop-loader">
        <div class="backdrop-content">
            <div class="section">
                <div class="text-center">
                    <img src="{{ asset('/local/images/loading.gif') }}" height="250">
                    <p style="color: gray; font-weight: bold;">Sedang menyimpan data...</p>
                </div>
            </div>
        </div>
    </div>
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
                        <a href="{{ route('penerimaanbarang') }}"
                            class="ml-1 text-sm font-medium text-gray-700  hover:text-secondary md:ml-2  ">Penerimaan
                            Barang</a>
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
                        <p class="text-gray-500">Barang yang diterima</p>
                        <div class="absolute right-0 top-0 mt-3 mr-3" style="margin-bottom: 10px;">
                            <div class="flex">


                                <button
                                    class="bg-blue-500 rounded-md flex items-center text-white px-3 py-2 text-sm btn-tambahBarang"><span
                                        class="material-symbols-outlined mr-2 menu-ico text-sm">
                                        add
                                    </span>Tambah
                                </button>
                            </div>
                        </div>
                        <div class="mt-5">
                            <table id="tb-master" class="table display table-auto stripe hover  " style="width:100%;">
                                <thead class="bg-gray-50 ">
                                    <th class="text-right text-xs py-3">No</th>
                                    <th class="text-left text-xs">Nama Barang</th>
                                    <th class="text-center text-xs">Qty</th>
                                    <th class="text-center text-xs">Satuan</th>
                                    <th class="text-center text-xs">Kadaluarsa</th>
                                    <th class="text-right text-xs">Harga Satuan</th>
                                    <th class="text-right text-xs">Total Harga</th>
                                    <th class="text-center text-xs">Action</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>


                    </div>

                    <div class="border rounded-md p-3">
                        <p class="text-gray-500">Informasi penerimaan</p>

                        <form method="post" id="form-save">
                            @csrf
                            <input type="hidden" id="print-type" value="0">
                            <div class="mb-3 mt-5">
                                <label for="nomor-batch" class="block mb-2 text-sm font-medium text-gray-700 mt-3">Tanggal
                                    Diterima
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
                                        placeholder="Pilih Tanggal" value="{{ \Carbon\Carbon::now()->format('d F Y') }}"
                                        id="date" name="date">
                                </div>
                            </div>

                            <div class="mb-3 mt-5">
                                <label for="budget_source"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Sumber
                                    Anggaran</label>

                                <div class="flex">
                                    <select id="budget_source" name="budget_source"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected>Pilih Sumber Anggaran</option>
                                        @foreach ($budget_sources as $budget_source)
                                            <option value="{{ $budget_source->id }}">{{ $budget_source->name }}</option>
                                        @endforeach
                                    </select>

                                    <button data-tooltip-target="tooltip-tambahsumber" type="button"
                                        class="bg-blue-500 ml-3 rounded-md flex items-center justify-center text-white px-3 py-2 text-sm btn-tambahsumber"><span
                                            class="material-symbols-outlined menu-ico text-sm">
                                            add
                                        </span></button>

                                    <div id="tooltip-tambahsumber" role="tooltip"
                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                        Tambah sumber anggaran "jika belum ada di dalam menu"
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 mt-5">
                                <label for="summary" class="block mb-2 text-sm font-medium text-gray-700 mt-3">
                                    Total Keseluruhan
                                </label>
                                <input type="text" id="summary"
                                    class="bg-gray-200 border text-right w-full border-gray-300 text-gray-900 text-sm block
                                p-2.5 rounded-md"
                                    placeholder="Total Keseluruhan" readonly name="total-keseluruhan"
                                    value="Rp. {{ number_format($total, 0, ',', '.') }}">
                            </div>

                            <div class="mb-3 mt-5">
                                <label for="description" class="block mb-2 text-sm font-medium text-gray-700 mt-3">Catatan
                                    Penerimaan
                                </label>
                                <textarea type="text" id="description"
                                    class="bg-gray-50 border rounded-md w-full border-gray-300 text-gray-900 text-sm  block  p-2.5 " rows="4"
                                    placeholder="Catatan Penerimaan" name="description"></textarea>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="flex items-center justify-end pt-6 rounded-b border-t border-gray-200 ">
                    <button type="submit" id="btn-save" form="form-save"
                        class="ml-auto flex items-center text-white bg-primary hover:bg-primarylight focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 transition duration-300  focus:outline-none ">
                        <span class="material-symbols-outlined text-white mr-3">
                            save
                        </span>Simpan
                    </button>


                    <button type="button" id="btn-save-print" {{-- onclick="location.href={{ route('penerimaanbarang.cetak', ['id' => $data->id]) }}" --}}
                        class="ml-5 flex items-center text-white bg-secondary hover:bg-secondary focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 transition duration-300  focus:outline-none ">
                        <span class="material-symbols-outlined text-white mr-3">
                            print
                        </span>Simpan & Cetak
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
                    <form method="post">
                        <div class="p-6 ">
                            <label for="medicine" class="block mb-2 text-sm font-medium text-gray-900 ">Pilih
                                Barang</label>
                            <select
                                class="js-example-basic-single bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                name="medicine" id="medicine">
                                <option selected>Pilih Barang</option>
                                @foreach ($medicines as $medicine)
                                    <option value="{{ $medicine->id }}">{{ $medicine->name }}
                                        ({{ $medicine->unit->name }})
                                    </option>
                                @endforeach
                            </select>


                            <div class="mb-3 mt-5">
                                <label for="expired_date"
                                    class="block mb-2 text-sm font-medium text-gray-700 mt-3">Tanggal
                                    Kadaluarsa
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
                                        name="expired_date" required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  "
                                        placeholder="Pilih Tanggal" id="expired_date"
                                        value="{{ \Carbon\Carbon::now()->format('d F Y') }}">
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="mb-3">
                                    <label for="qty" class="block mb-2 text-sm font-medium text-gray-700 mt-3">Qty
                                    </label>
                                    <input type="text" id="qty" min="1"
                                        class="bg-gray-50 border min-w-[100px] border-gray-300 text-gray-900 text-sm  block w-full p-2.5 "
                                        placeholder="Qty yang diterima" required name="qty" value="0"
                                        onkeyup="format(this)" onclick="this.select()">
                                </div>


                                <div class="mb-3">
                                    <label for="price" class="block mb-2 text-sm font-medium text-gray-700 mt-3">Harga
                                        Satuan
                                    </label>
                                    <input type="text" id="price" min="0" onclick="this.select()"
                                        onkeyup="format(this)"
                                        class="bg-gray-50 border min-w-[100px] border-gray-300 text-gray-900 text-sm  block w-full p-2.5 "
                                        placeholder="harga Satuan" required name="price" value="0">
                                </div>

                                <div class="mb-3 grow">
                                    <label for="total" class="block mb-2 text-sm font-medium text-gray-700 mt-3">Total
                                    </label>
                                    <input type="text" id="total"
                                        class="bg-gray-200  border border-gray-300 text-gray-900 text-sm  block w-full p-2.5 "
                                        placeholder="price" readonly name="total" value="0">
                                </div>
                            </div>


                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center justify-end p-6 space-x-2 rounded-b border-t border-gray-200 ">
                            <button type="button" id="btn-add-cart"
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

    </div>
@endsection

@section('morejs')
    <!--Datatables -->
    <script src="{{ asset('js/datepicker.js') }}"></script>
    <script src="{{ asset('local/vendor/select2/dist/js/select2.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('js/datatable.js') }}"></script>

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

        $('.btn-tambahsumber').on('click', function(e) {

            modal_tambahsm.show();
        });

        function modaltambahsmHide() {
            modal_tambahsm.hide();
        }
    </script>


    <script>
        var table;
        var path = '/{{ request()->path() }}';

        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        function reload() {
            table.ajax.reload();
        }

        function clear() {
            $('#qty').val(0);
            $('#medicine').val('');
            $('#price').val(0);
            let now = '{{ \Carbon\Carbon::now()->format('d F Y') }}';
            $('#expired_date').val(now);
        }

        async function storeCart() {
            try {
                $('.backdrop-loader').css('display', 'block');
                let url = '{{ route('tambahbarang.cart') }}';
                let data = {
                    medicine: $('#medicine').val(),
                    qty: $('#qty').val().replace(/[, ]+/g, "").trim(),
                    price: $('#price').val().replace(/[, ]+/g, "").trim(),
                    expired_date: $('#expired_date').val(),
                };
                let response = await $.post(url, data);
                if (response['status'] === 200) {
                    reload();
                    Swal.fire("Berhasil!", "Berhasil menambah data..", "success").then(function() {
                        modaltambahmHide();
                        clear();
                    });
                }
            } catch (e) {
                let error_message = JSON.parse(e.responseText);
                Swal.fire("Error!", error_message.message, "error");
            } finally {
                $('.backdrop-loader').css('display', 'none');
            }
        }

        async function destroy(id) {
            try {
                $('.backdrop-loader').css('display', 'block');
                let url = '{{ route('tambahbarang.cart.destroy') }}';
                let response = await $.post(url, {
                    id
                });
                if (response['status'] === 200) {
                    reload();
                    Swal.fire("Berhasil!", "Berhasil menghapus data..", "success");
                }
            } catch (e) {
                let error_message = JSON.parse(e.responseText);
                Swal.fire("Error!", error_message.message, "error");
            } finally {
                $('.backdrop-loader').css('display', 'none');
            }
        }

        function calculateTotal() {
            let qty = isNaN(parseInt($('#qty').val())) ? 0 : parseInt($('#qty').val().replace(/[, ]+/g, "").trim());
            let price = isNaN(parseInt($('#price').val())) ? 0 : parseInt($('#price').val().replace(/[, ]+/g, "").trim());
            let total = qty * price;
            var totals = formattotal(total);
            $('#total').val(totals);
        }

        function clear() {
            $('#expired_date').val();
            $('#qty').val(0);
            $('#price').val(0);
            $('#total').val(0);
        }

        function storeCartHandler() {
            $('#btn-add-cart').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "Konfirmasi!",
                    text: "Apakah anda yakin menambah data?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.value) {
                        storeCart();
                    }
                });
            });
        }

        function destroyHandler() {
            $('.btn-delete').on('click', function(e) {
                e.preventDefault();
                let id = this.dataset.id;
                Swal.fire({
                    title: "Konfirmasi!",
                    text: "Apakah anda yakin menghapus data?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.value) {
                        destroy(id);
                    }
                });
            });
        }

        $(document).ready(function() {
            $('.js-example-basic-single').select2();
            table = BasicDatatableGenerator('#tb-master', path, [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable: false,
                    className: 'text-center text-xs'
                },
                {
                    data: 'medicine.name',
                    name: 'medicine.name',
                    className: 'text-left text-xs'
                },
                {
                    data: 'qty',
                    name: 'qty',
                    className: 'text-center text-xs'
                },
                {
                    data: 'unit.name',
                    name: 'unit.name',
                    className: 'text-center text-xs'
                },
                {
                    data: 'expired_date',
                    name: 'expired_date',
                    className: 'text-center text-xs',
                    render: function(data) {
                        let date = new Date(data);
                        return date.toLocaleString('id-ID', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric'
                        });
                    }
                },

                {
                    data: 'price',
                    name: 'price',
                    className: 'text-right text-xs',
                    render: function(data) {
                        return 'Rp. ' + data.toLocaleString('id-ID');
                    }
                },
                {
                    data: 'total',
                    name: 'total',
                    className: 'text-right text-xs',
                    render: function(data) {
                        return 'Rp. ' + data.toLocaleString('id-ID');
                    }
                },
                {
                    className: 'text-center text-xs font-bold ',
                    searchable: false,
                    orderable: false,
                    data: null,
                    render: function(data) {
                        return '<button data-id="' + data['id'] +
                            '" class="btn-delete bg-secondary rounded-full text-white px-3 py-2 btn-detail text-xs my-1">Hapus</button>';
                    }
                },
            ], [], function(d) {

            }, {
                "fnDrawCallback": function(setting) {
                    let data = this.fnGetData();
                    let total = data.map(item => item['total']).reduce((prev, next) => prev + next, 0);
                    $('#summary').val('Rp. ' + total.toLocaleString('id-ID'));
                    destroyHandler();
                },
                dom: 't'
            });

            $('#qty').on('input', function() {
                calculateTotal();
            });

            $('#price').on('input', function() {
                calculateTotal();
            });
            storeCartHandler();
            destroyHandler();
            $('#btn-save').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "Konfirmasi!",
                    text: "Apakah anda yakin menyimpan data?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.value) {
                        $('#form-save').submit();
                    }
                });
            });

            // $('#btn-save-print').on('click', function (e) {
            //     e.preventDefault();
            //     Swal.fire({
            //         title: "Konfirmasi!",
            //         text: "Apakah anda yakin menyimpan data?",
            //         icon: 'question',
            //         showCancelButton: true,
            //         confirmButtonColor: '#3085d6',
            //         cancelButtonColor: '#d33',
            //         confirmButtonText: 'Ya',
            //         cancelButtonText: 'Batal',
            //     }).then((result) => {
            //         if (result.value) {
            //             postNPrint();
            //             // $('#form-save').submit();
            //         }
            //     });
            // });

        });
    </script>


    {{-- ACTION --}}
@endsection
