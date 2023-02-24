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
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <a href="#" class="ml-1 text-sm font-medium text-gray-700  md:ml-2  ">Tambah Penyesuaian</a>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="">
            <div class="section relative">
                <p class="title ">Penyesuaian Stock </p>


                {{-- FILTER --}}
                <div class="mb-2">
                    <button class="chip" id="btndropdownkategori">
                        Lokasi: <span id="textsumber">GUDANG</span>
                    </button>
                </div>

                {{-- MENU SUMBER ANGGARAN --}}
                <div id="dropdownkategori" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 ">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="btndropdownkategori">

                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white btn-storage"
                                data-id="main" data-text="GUDANG">GUDANG</a>
                        </li>

                        {{-- @foreach ($locations as $location)
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white btn-storage"
                                    data-id="{{ $location->id }}"
                                    data-text="{{ $location->name }}">{{ $location->name }}</a>
                            </li>
                        @endforeach --}}
                    </ul>
                </div>

                <table id="tb-master" class="stripe hover mt-10"
                    style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1" class="text-center text-xs">No</th>
                            <th data-priority="2" class="text-center text-xs">Kategori</th>
                            <th data-priority="2" class="text-left text-xs">Nama Barang (Satuan)</th>
                            <th data-priority="2" class="text-center text-xs">Lokasi</th>
                            <th data-priority="2" class="text-center text-xs">Tanggal Kadaluarsa</th>
                            <th data-priority="2" class="text-center text-xs">Stock</th>
                            <th data-priority="2" class="text-center text-xs">Stock Sebenarnya</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-priority="1" class="text-center text-xs">No</td>
                            <td data-priority="2" class="text-center text-xs">Kategori</td>
                            <td data-priority="2" class="text-left text-xs">Obat tidur (tablet)</td>
                            <td data-priority="2" class="text-center text-xs">Gudang</td>
                            <td data-priority="2" class="text-center text-xs">28 Februari 2023</td>
                            <td data-priority="2" class="text-center text-xs">12</td>
                            <td data-priority="2" class="text-center text-xs">
                                <input type="text" id="first_name" type="number"
                                    class="bg-gray-50 border w-32 border-gray-300 text-gray-900 text-sm rounded-lg "
                                    required>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <label for="keterangan" class="block mb-2 mt-10 text-sm font-medium text-gray-900 ">Keterangan</label>
                <textarea id="keterangan" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Masukan Keterangan"></textarea>

                <div class="mt-5 mb-5 flex justify-end">
                    <a href="#"
                        class="inline-block bg-blue-500 hover:bg-blue-300 transition-all duration-300 rounded-md   text-white px-7 py-4 text-md ">
                        Simpan
                    </a>
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

    <script>
        var _location = 'all';
        var table;
        var path = '/{{ request()->path() }}';
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

        function reload() {
            table.ajax.reload();
        }

        $(document).ready(function() {

            var table = $('#tb-master').DataTable({
                    responsive: true,
                    paging: false,
                    ordering: false,
                    info: false,
                })
                .columns.adjust()
                .responsive.recalc();

            $('.btn-storage').on('click', function(e) {
                e.preventDefault();
                let id = this.dataset.id;
                let text = this.dataset.text;
                _location = id;
                dropdownkategori.hide();
                $('#textsumber').html(text);
                reload();
            });

            $('.btn-excel').on('click', function(e) {
                e.preventDefault();
                let url = '{{ route('laporanstock.excel') }}?location=' + _location;
                window.open(url);
            });
        });
    </script>




    {{-- DROPDOWN --}}
    <script>
        // set the dropdown menu element
    </script>
@endsection
