@extends('admin.base')

@section('css')
    <!--Regular Datatables CSS-->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <!--Responsive Extension Datatables CSS-->
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <style>
        table.dataTable tbody tr {
            height: 40px;
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
                    <div class="flex items-center ">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('pengeluaran') }}" class="ml-1 text-sm font-medium text-gray-700  md:ml-2  ">Pengeluaran
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
                        <a href="#" class="ml-1 text-sm font-medium text-gray-700  md:ml-2  ">Detail</a>
                    </div>
                </li>

            </ol>
        </nav>


        <div class="grid grid-cols-1 gap-4">
            <div class="section relative min-h-[600px]">
                <p class="title ">Detail Keluaran </p>
                <div class="grid grid-cols-3 gap-2 ">

                    <div class="border rounded-md p-3">
                        <p class="text-gray-500">Informasi Keluaran</p>


                        <div class="mb-3 ">
                            <label for="batch_id" class="block mb-2 text-sm font-medium text-gray-700 mt-3">Nomor Batch
                            </label>
                            <input type="text" id="batch_id"
                                   class="bg-gray-200  border  w-full p-1 border-gray-300 text-gray-900 rounded-sm text-sm  block "
                                   readonly name="nomorbatch" value="{{ $data->batch_id }}"/>
                        </div>

                        <div class="mb-3 mt-5">
                            <label for="date" class="block mb-2 text-sm font-medium text-gray-700 mt-3">Tanggal
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
                                <input type="text" readonly
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  "
                                       placeholder="Pilih Tanggal"
                                       value="{{ \Carbon\Carbon::parse($data->date)->format('d F Y') }}"
                                       id="date" name="date">
                            </div>
                        </div>
                        <div class="mb-3 ">
                            <label for="location" class="block mb-2 text-sm font-medium text-gray-700 mt-3">Unit Tujuan
                            </label>
                            <input type="text" id="location"
                                   class="bg-gray-200  border  w-full p-1 border-gray-300 text-gray-900 rounded-sm text-sm  block "
                                   readonly name="total" value="{{ $data->location->name }}"/>
                        </div>
                        <div class="mb-3 mt-5">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-700 mt-3">Catatan
                                Keluaran
                            </label>
                            <textarea type="text" id="description" readonly
                                      class="bg-gray-50 border rounded-md w-full border-gray-300 text-gray-900 text-sm  block  p-2.5 "
                                      rows="4"
                                      placeholder="Catatan Keluaran"
                                      name="description">{{ $data->description }}</textarea>
                        </div>
                    </div>

                    <div class="border rounded-md col-span-2 p-3 relative">
                        <p class="text-gray-500">Barang yang dikeluarkan</p>

                        <div class="mt-5">
                            <table id="tb-daftarbarang" class="table display table-auto stripe hover  "
                                   style="width:100%;">
                                <thead class="bg-gray-50 ">
                                <tr>
                                    <th class="text-right text-xs py-3">No</th>
                                    <th class="text-left text-xs">Nama Barang</th>
                                    <th class="text-center text-xs">Qty</th>
                                    <th class="text-center text-xs">Satuan</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data->medicine_outs as $medicine_out)
                                    <tr>
                                        <td class="text-center text-xs no-sort">{{ $loop->index + 1 }}</td>
                                        <td class="text-left text-xs">{{ $medicine_out->medicine->name }}</td>
                                        <td class="text-center text-xs">{{ $medicine_out->unit->name }}</td>
                                        <td class="text-center text-xs">{{ $medicine_out->qty }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-6 rounded-b border-t border-gray-200 ">
                    <div class="flex">
                        <button type="submit" id="btn-save" form="form-save"
                                class=" flex items-center text-white bg-blue-500 hover:bg-blue-300 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 transition duration-300  focus:outline-none ">
                            <span class="material-symbols-outlined text-white mr-3">
                                edit
                            </span> Ubah
                        </button>

                        <button type="submit" id="btn-save" form="form-save"
                                onclick="confirmDelete(function(){alert('ok')}, function(){alert('cancel')})"
                                class="ml-3 flex items-center text-white bg-red-500 hover:bg-red-300 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 transition duration-300  focus:outline-none ">
                            <span class="material-symbols-outlined text-white mr-3">
                                delete
                            </span> Hapus
                        </button>
                    </div>

                    <a href="{{ route('pengeluaran.cetak', ['id' => $data->id]) }}" id="btn-print" target="_blank"
                       class="ml-5 flex items-center text-white bg-secondary hover:bg-secondary focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 transition duration-300  focus:outline-none ">
                        <span class="material-symbols-outlined text-white mr-3">
                            print
                        </span> Cetak
                    </a>
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


    <script>
        $(document).ready(function () {
            var daftarbarang = $('#tb-daftarbarang').DataTable({
                responsive: true,
                "lengthChange": false,
                dom: 't'
            })
                .columns.adjust()
                .responsive.recalc();
        });
    </script>
@endsection
