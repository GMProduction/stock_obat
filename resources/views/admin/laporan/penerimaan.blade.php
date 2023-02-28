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
            <div class="section relative col-span-5">
                <p class="title ">Penerimaan Barang </p>
                <div class="absolute right-0 top-0 mt-3 mr-3">
                    <div class="flex gap-1">
                        <button id="btn-export-excel"
                            class="bg-green-500 hover:bg-green-300 transition-all duration-300 rounded-md flex items-center text-white px-3 py-2 text-sm mr-3">
                            <img src="{{ asset('local/icons/tutupbuku.svg') }}"
                                class=" mr-2 menu-icon text-sm w-6 object-scale-down" />
                            Export to Excel
                        </button>
                        <button onclick="window.open('{{ route('cetakLaporanPenerimaan', ['id' => 1]) }}');"
                            class="bg-orange-500 hover:bg-orange-300 transition-all duration-300 rounded-md flex items-center text-white px-3 py-2 text-sm mr-3"><span
                                class="material-symbols-outlined mr-2 menu-icon text-sm">
                                print
                            </span>Print
                        </button>

                    </div>
                </div>

                {{-- FILTER --}}
                <div class="mb-2">
                    <a class="chip mr-3 btn-tambahBarang">
                        Periode: <span id="date-range-value">{{ \Carbon\Carbon::now()->startOfMonth()->format('d F Y') }} -
                            {{ \Carbon\Carbon::now()->format('d F Y') }}</span>
                    </a>
                    <a class="chip" id="btndropdownsumberanggaran">
                        Sumber Anggaran: <span id="textsumber"> Semua</span>
                    </a>
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
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <input name="date_start" type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Tanggal Awal" id="date_start"
                                        value="{{ \Carbon\Carbon::now()->startOfMonth()->format('d F Y') }}">
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
                                    <input name="date_end" type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
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

                {{-- MENU SUMBER ANGGARAN --}}
                <div id="dropdownsumberanggaran"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 ">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="btndropdownsumberanggaran">
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white pop-budget-sources"
                                data-id="">Semua</a>
                        </li>
                        @foreach ($budget_sources as $budget_source)
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white pop-budget-sources"
                                    data-id="{{ $budget_source->id }}">{{ $budget_source->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <table id="tb-master" class="stripe hover mt-10"
                    style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1" class="text-right text-xs">No</th>
                            <th data-priority="2" class="text-center text-xs">Tanggal Datang</th>
                            <th data-priority="3" class="text-center text-xs">Nomor Batch</th>
                            <th data-priority="3" class="text-center text-xs">Sumber Anggaran</th>
                            <th data-priority="3" class="text-center text-xs">Total</th>
                            <th data-priority="4" class="text-center text-xs">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>




        </div>

    </div>

    <div id="modalDetail" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
        <div class="relative w-full max-w-6xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow p-4 ">
                <!-- Modal header -->
                <div class="flex justify-between items-start p-4 rounded-t border-b ">
                    <h3 class="text-xl font-semibold text-gray-900 ">
                        "NAMA BARANG"
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center "
                        onclick="modalDetailHide()">
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
                <div class="section col-span-3 relative">

                    <div class="border rounded-md p-3">
                        <button
                            class="bg-orange-500 hover:bg-orange-300 ml-auto transition-all duration-300 rounded-md flex items-center text-white px-3 py-2 text-sm mr-3"><span
                                class="material-symbols-outlined mr-2 menu-icon text-sm">
                                print
                            </span>Cetak Penerimaan
                        </button>

                        <div class="grid grid-cols-4 gap-2">
                            <div class="mb-3 ">
                                <label for="total" class="block mb-2 text-sm font-medium text-gray-700 mt-3">Nomor
                                    Batch
                                </label>
                                <input type="text" id="total"
                                    class="bg-gray-200  border  w-full p-1 border-gray-300 text-gray-900 rounded-sm text-sm  block "
                                    readonly name="total" value="Test" />
                            </div>

                            <div class="mb-3 ">
                                <label for="total" class="block mb-2 text-sm font-medium text-gray-700 mt-3">Tanggal
                                    Datang
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

                        <div class="mt-5">
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
        </div>
    </div>
@endsection

@section('morejs')
    <!--Datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('js/datepicker.js') }}"></script>
    <script src="{{ asset('js/datatable.js') }}"></script>





    {{-- DROPDOWN --}}
    <script></script>


    {{-- MODAL MASTER --}}
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


        function modalPeriodeHide() {
            modal_tambahb.hide();
        }

        function modaleditmHide() {
            modal_tambahb.hide();
        }

        $('.btn-tambahBarang').on('click', function(e) {

            modal_tambahb.show();
        });
    </script>

    <script>
        var table;
        var _bs = '';
        var path = '/{{ request()->path() }}';

        // set the dropdown menu element
        const $targetEl = document.getElementById('dropdownsumberanggaran');

        // set the element that trigger the dropdown menu on click
        const $triggerEl = document.getElementById('btndropdownsumberanggaran');

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
        const dropdownsumberanggaran = new Dropdown($targetEl, $triggerEl, options);

        function sumberanggaranclose(sumber) {
            const $textSumber = document.getElementById('textsumber');
            $textSumber.innerHTML = sumber;
            dropdownsumberanggaran.hide();
            reload();
        }

        function sumberanggaranshow() {
            dropdownsumberanggaran.toggle();
        }

        // MODAL DETAIL
        const $modalDetailElement = document.getElementById('modalDetail');
        const optionsDetail = {
            placement: 'bottom-right',
            backdrop: 'dynamic',
            backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
            closable: true,
            onHide: () => {
                console.log('modal is hidden');
            },
            onShow: () => {
                console.log('modal is shown');
            },
            onToggle: () => {
                console.log('modal has been toggled');
            }
        };
        let modalDetail = new Modal($modalDetailElement, optionsDetail);

        function modalDetailHide() {
            modalDetail.hide();
        }

        $('.btn-detail').on('click', function(e) {
            e.preventDefault();
            modalDetail.show();
        });

        function dateChangeHandler() {
            let date_start = $('#date_start').val();
            let date_end = $('#date_end').val();
            let text = date_start + ' - ' + date_end;
            $('#date-range-value').html(text);
            reload();
        }

        function reload() {
            table.ajax.reload();
        }

        $(document).ready(function() {

            table = BasicDatatableGenerator('#tb-master', path, [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable: false,
                    className: 'text-center text-xs'
                },
                {
                    data: 'date',
                    name: 'date',
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
                    data: 'batch_id',
                    name: 'batch_id',
                    className: 'text-center text-xs'
                },
                {
                    data: 'budget_source.name',
                    name: 'budget_source.name',
                    className: 'text-center text-xs'
                },
                {
                    data: 'total',
                    className: 'text-right text-xs',
                    render: function(data) {
                        return 'Rp. ' + data.toLocaleString('id-ID');
                    }
                },
                {
                    className: 'text-center text-xs font-bold justify-center',
                    searchable: false,
                    orderable: false,
                    data: null,
                    render: function(data) {
                        let redirect = '#';
                        return '<a href="' + redirect + '" data-id="' + data['id'] +
                            '" class="bg-secondary rounded-full text-white px-3 py-2 btn-detail text-xs">Detail</a>';
                    }
                },
            ], [], function(d) {
                d.date_start = $('#date_start').val();
                d.date_end = $('#date_end').val();
                d.budget_source = _bs;
            }, {
                responsive: true,
                "fnDrawCallback": function(settings) {
                    $('.btn-detail').on('click', function(e) {
                        e.preventDefault();
                        modalDetail.show();
                    });
                }
            });


            var daftarbarang = $('#tb-daftarbarang').DataTable({
                    responsive: true,
                    "lengthChange": false
                })
                .columns.adjust()
                .responsive.recalc();

            $('.pop-budget-sources').on('click', function(e) {
                e.preventDefault();
                let id = this.dataset.id;
                _bs = id;
                let text = this.innerHTML;
                sumberanggaranclose(text);
                console.log(id);
            });

            $('#date_start').on('changeDate', function(e) {
                dateChangeHandler();
            });
            $('#date_end').on('changeDate', function(e) {
                dateChangeHandler();
            });
            $('#btn-submit-date-range').on('click', function(e) {
                e.preventDefault();
                dateChangeHandler();
                modalPeriodeHide();
            });

            $('#btn-export-excel').on('click', function(e) {
                e.preventDefault();
                let date_start = $('#date_start').val();
                let date_end = $('#date_end').val();
                let url = '{{ route('laporanpenerimaan.excel') }}?budget_source=' + _bs + '&date_start=' +
                    date_start + '&date_end=' + date_end;
                window.open(url);
            });
        });
    </script>
@endsection
