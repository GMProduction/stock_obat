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
                       class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900  ">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                            </path>
                        </svg>
                        Dashboard
                    </a>
                </li>
                {{-- <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('customize.aplikasi.online') }}"
                            class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2  ">Customize
                            Aplikasi Online</a>
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
                        <span class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2  ">Form</span>
                    </div>
                </li> --}}
            </ol>
        </nav>

        <div class="grid grid-cols-2 gap-4">
            <div class="section">
                <p class="title ">Stock Barang yang akan habis</p>
                <table id="tb-min-stock" class="stripe hover mt-10"
                       style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                    <tr>
                        <th data-priority="1" class="text-center text-sm">No</th>
                        <th data-priority="3" class="text-center text-sm">Nama Barang</th>
                        <th data-priority="4" class="text-center text-sm">Qty</th>
                        <th data-priority="4" class="text-center text-sm">Action</th>
                    </tr>
                    </thead>

                </table>
            </div>

            <div class="section">
                <p class="title">Stock Barang yang akan expired</p>
                <table id="tb-expired" class="stripe hover mt-10"
                       style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                    <tr>
                        <th data-priority="1" class="text-center text-sm">No</th>
                        <th data-priority="3" class="text-center text-sm">Nama Barang</th>
                        <th data-priority="4" class="text-center text-sm">Qty</th>
                        <th data-priority="4" class="text-center text-sm">Tanggal Kadaluarsa</th>
                        <th data-priority="4" class="text-center text-sm">Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>


    </div>
@endsection

@section('morejs')
    <!--Datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="{{asset('js/moment.min.js')}}"></script>

    <script>
        $(document).ready(function () {

            // var table = $('#tb-min-stock').DataTable({
            //         responsive: true
            //     })
            //     .columns.adjust()
            //     .responsive.recalc();
            moment.locale('id');

            datatableStok();
            datatableExpired();
            // var table = $('#tb-expired').DataTable({
            //     responsive: true
            // })
            //     .columns.adjust()
            //     .responsive.recalc();
        });

        function datatableStok() {
            let colums = [
                {
                    className: "text-center",
                    orderable: false,
                    defaultContent: "",
                    searchable: false
                },
                {data: 'name', name: 'name'},
                {
                    data: 'qty', name: 'qty', className: 'text-center'
                },
                {
                    className: "text-center",
                    data: 'action', name: 'action', orderable: false, searchable: false
                },
            ];
            datatable('tb-min-stock', '{{route('dashboardstock')}}', colums, null, [[2,'asc']])

        }

        function datatableExpired() {
            let colums = [
                {
                    className: "text-center",
                    orderable: false,
                    defaultContent: "",
                    searchable: false
                },
                {data: 'name', name: 'name'},
                {
                    data: 'qty', name: 'qty', className: 'text-center'
                },
                {
                    data: 'medicine_ins_expired.expired_date', name: 'medicine_ins_expired.expired_date', className: 'text-center', render: function (data) {
                        return data ? moment(data).locale('id').format('LL') : '-'
                    }
                },
                {
                    className: "text-center",
                    data: 'action', name: 'action', orderable: false, searchable: false
                },
            ];
            datatable('tb-expired', '{{route('dashboardexpired')}}', colums, null)

        }
    </script>
@endsection
