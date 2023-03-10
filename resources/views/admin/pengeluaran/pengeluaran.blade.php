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
                        <a href="#" class="ml-1 text-sm font-medium text-gray-700  md:ml-2  ">Pengeluaran Barang</a>
                    </div>
                </li>

            </ol>
        </nav>

        <div class="grid grid-cols-1 gap-4">
            <div class="section relative">
                <p class="title ">Pengeluaran Barang </p>
                <div class="absolute right-0 top-0 mt-3 mr-3">
                    <div class="flex">


                        <button onclick="location.href='{{ route('pengeluaranbarang') }}'"
                                class="bg-blue-500 rounded-md flex items-center text-white px-3 py-2 text-sm "><span
                                class="material-symbols-outlined mr-2 menu-ico text-sm">
                                add
                            </span>Tambah
                        </button>
                    </div>
                </div>
                <table id="tb-master" class="stripe hover mt-10" style="width:100%;">
                    <thead>
                    <tr>
                        <th data-priority="1" class="text-right text-xs w-5">No</th>
                        <th data-priority="2" class="text-center text-xs">Tanggal</th>
                        <th data-priority="3" class="text-center text-xs">Nomor Batch</th>
                        <th data-priority="3" class="text-left text-xs">Unit Penerima</th>
                        <th data-priority="4" class="text-center text-xs">Action</th>
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
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script>
        var table;
        var path = '/{{ request()->path() }}';

        $(document).ready(function () {
            table = BasicDatatableGenerator('#tb-master', path, [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                searchable: false,
                orderable: false,
                className: 'text-right text-xs'
            },
                {
                    data: 'date',
                    name: 'date',
                    className: 'text-center text-xs',
                    render: function (data) {
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
                    data: 'location.name',
                    name: 'location.name',
                    className: 'text-left text-xs'
                },
                {
                    className: 'text-center text-xs font-bold flex flex-nowrap gap-1 justify-center',
                    searchable: false,
                    orderable: false,
                    data: null,
                    render: function (data) {
                        let redirect = '/pengeluaran/' + data['id'] + '/detail';
                        return '<a href="' + redirect + '" data-id="' + data['id'] + '" class="bg-secondary rounded-full text-white px-3 py-2 btn-detail text-xs">Detail</a>';
                    }
                },
            ]);
        });
    </script>



    {{-- ACTION --}}
@endsection
