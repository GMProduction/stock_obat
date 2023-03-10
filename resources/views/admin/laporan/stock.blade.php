@extends('admin.base')

@section('css')
    <!--Regular Datatables CSS-->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <!--Responsive Extension Datatables CSS-->
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <style>
        .data-limit-center {
            justify-content: center;
        }

        .filter-yellow {
            filter: invert(77%) sepia(51%) saturate(4854%) hue-rotate(5deg) brightness(95%) contrast(101%);
        }

        .bg-orange-300 {
            background-color: rgb(249 115 22) !important;
            color: white;
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
                        <a href="#" class="ml-1 text-sm font-medium text-gray-700  md:ml-2  ">Laporan Stock</a>
                    </div>
                </li>

            </ol>
        </nav>

        <div class="">
            <div class="section relative">
                <p class="title ">Stock Saat Ini </p>
                <div class="absolute right-0 top-0 mt-3 mr-3">
                    <div class="flex gap-1">

                        <a href="#"
                           class="btn-excel bg-green-500 hover:bg-green-300 transition-all duration-300 rounded-md flex items-center text-white px-3 py-2 text-sm mr-3">
                            <img src="{{ asset('local/icons/tutupbuku.svg') }}"
                                 class=" mr-2 menu-icon text-sm w-6 object-scale-down"/>
                            Export To Excel
                        </a>

                        <a href="#" target="_blank" id="btn-print"
                           class=" bg-orange-500 hover:bg-orange-300 transition-all duration-300 rounded-md flex items-center text-white px-3 py-2 text-sm mr-3">
                            <span
                                class="material-symbols-outlined mr-2 menu-icon text-sm">
                                print
                            </span>Print
                        </a>

                    </div>
                </div>

                {{-- FILTER --}}
                <div class="mb-2 hidden">
                    <button class="chip" id="btndropdownkategori">
                        Lokasi: <span id="textsumber">SEMUA</span>
                    </button>
                </div>

                {{-- MENU SUMBER ANGGARAN --}}
                <div id="dropdownkategori"
                     class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 ">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="btndropdownkategori">
                        <li>
                            <a href="#"
                               class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white btn-storage"
                               data-id="all" data-text="SEMUA">SEMUA</a>
                        </li>

                        <li>
                            <a href="#"
                               class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white btn-storage"
                               data-id="main" data-text="GUDANG">GUDANG</a>
                        </li>
                        @foreach ($locations as $location)
                            <li>
                                <a href="#"
                                   class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white btn-storage"
                                   data-id="{{ $location->id }}"
                                   data-text="{{ $location->name }}">{{ $location->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <table id="tb-master" class="stripe hover mt-10"
                       style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                    <tr>
                        <th data-priority="1" class="text-center text-xs">No</th>
                        <th data-priority="2" class="text-center text-xs">Kategori</th>
                        <th data-priority="2" class="text-left text-xs">Nama Barang</th>
                        <th data-priority="2" class="text-center text-xs">Satuan</th>
                        <th data-priority="2" class="text-center text-xs">Jumlah</th>
                        <th data-priority="2" class="text-center text-xs">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
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
        // var _location = 'all';
        var _location = 'main';
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

        $(document).ready(function () {

            table = BasicDatatableGenerator('#tb-master', path, [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                searchable: false,
                orderable: false,
                className: 'text-center text-xs'
            },
                {
                    data: 'category.name',
                    name: 'category.name',
                    className: 'text-center text-xs'
                },
                {
                    data: 'name',
                    name: 'name',
                    className: 'text-left text-xs'
                },
                {
                    data: 'unit.name',
                    name: 'unit.name',
                    className: 'text-center text-xs'
                },
                {
                    data: 'stock',
                    name: 'stock',
                    className: 'text-center text-xs'
                },
                {
                    data: null,
                    className: 'flex text-xs data-limit-center',
                    render: function (data) {
                        let stock = data['stock'];
                        let limit = data['limit'];
                        if (stock <= limit) {
                            return '<img src="/local/icons/warning.svg" class="mr-2 menu-icon text-sm text-center w-6 object-scale-down filter-yellow">';
                        }
                        return '-';
                    }
                },
            ], [], function (d) {
                d.location = _location;
            }, {
                dom: 'ltrip',
                createdRow: function (row, data, dataIndex) {
                    let stock = data['stock'];
                    let extClass = '';
                    if (stock > 0) {
                        let expiration = data['expiration'];
                        if (expiration <= 2) {
                            extClass = '!bg-red-500 text-white';
                        }
                        if (expiration >= 3 && expiration <= 5) {
                            extClass = 'bg-orange-300'
                        }
                        if (expiration >= 6 && expiration <= 12) {
                            extClass = '!bg-green-500 text-white'
                        }
                        $(row).addClass(extClass);
                    }
                }
            });


            $('.btn-storage').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                let text = this.dataset.text;
                _location = id;
                dropdownkategori.hide();
                $('#textsumber').html(text);
                reload();
            });

            $('.btn-excel').on('click', function (e) {
                e.preventDefault();
                let url = '{{ route('laporanstock.excel') }}?location=' + _location;
                window.open(url);
            });

            $('#btn-print').on('click', function (e) {
                e.preventDefault();
                let url = '{{ route('laporanstock.pdf') }}?location=' + _location;
                window.open(url, '_blank');
            });
        });
    </script>



    {{-- DROPDOWN --}}
    <script>
        // set the dropdown menu element
    </script>
@endsection
