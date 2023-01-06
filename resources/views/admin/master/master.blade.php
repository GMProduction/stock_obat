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
                            </span>Filter</button>
                        <button  onclick="location.href='{{route('masterother')}}'" class="bg-teal-500 rounded-md flex items-center text-white px-3 py-2 text-sm mr-3"><span
                                class="material-symbols-outlined mr-2 menu-icon text-sm">
                                feed
                            </span>Master Satuan / Asal Obat / Lokasi</button>
                        <button class="bg-blue-500 rounded-md flex items-center text-white px-3 py-2 text-sm"><span
                                class="material-symbols-outlined mr-2 menu-ico text-sm" >
                                add
                            </span>Tambah</button>
                    </div>
                </div>
                <table id="tb-min-stock" class="stripe hover mt-10"
                    style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1" class="text-right text-sm">No</th>
                            <th data-priority="2" class="text-center text-sm">Asal Obat</th>
                            <th data-priority="3" class="text-left text-sm">Satuan</th>
                            <th data-priority="3" class="text-left text-sm">Warning Minimum</th>
                            <th data-priority="4" class="text-center text-sm">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="text-right text-sm">1</td>
                            <td class="text-center text-sm">APBD</td>
                            <td class="text-center text-sm">Tablet</td>
                            <td class="text-center text-sm">3</td>
                            <td class="text-center text-xs font-bold">
                                <button class="bg-secondary rounded-full text-white px-3 py-2">Detail</button>
                            </td>
                        </tr>

                        <tr>
                            <td class="text-right text-sm">2</td>
                            <td class="text-center text-sm">APBD</td>
                            <td class="text-center text-sm">Tablet</td>
                            <td class="text-center text-sm">5</td>
                            <td class="text-center text-xs font-bold"><button
                                    class="bg-secondary rounded-full text-white px-3 py-2">Detail</button></td>
                        </tr>

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

    <script>
        $(document).ready(function() {

            var table = $('#tb-min-stock').DataTable({
                    responsive: true
                })
                .columns.adjust()
                .responsive.recalc();


            var table = $('#tb-expired').DataTable({
                    responsive: true
                })
                .columns.adjust()
                .responsive.recalc();
        });
    </script>

    <script>
        const targetEl = document.getElementById('modalTambah');
        let modal = new Modal(targetEl, {
            placement: 'bottom-right',
            backdrop: 'dynamic',
            onShow: () => {

            },
            onHide: () => {

            }
        });

        function modalHide() {
            modal.hide();
        }

        $(document).ready(function() {
            generateDataTable();
            $('#btn-submit').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Konfirmasi',
                    icon: 'info',
                    text: 'Yakin ingin menambah data informasi?',
                    showCloseButton: true,
                    showCancelButton: true,
                    focusConfirm: false,
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $('#form-save').submit();
                    }
                });
            });

            $('#btn-patch').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Konfirmasi',
                    icon: 'info',
                    text: 'Yakin ingin merubah data informasi?',
                    showCloseButton: true,
                    showCancelButton: true,
                    focusConfirm: false,
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $('#form-patch').submit();
                    }
                });
            });

            $('.btn-edit').on('click', function(e) {
                e.preventDefault();
                let id = this.dataset.id;
                let information = this.dataset.information;
                let type = this.dataset.type;
                let link = this.dataset.link;
                $('#id-edit').val(id);
                $('#e-nama-info').val(information);
                if (type === '0') {
                    $('#e-link-info').val(link);
                    $('#er-file').attr('checked', false);
                    $('#er-link').attr('checked', true);
                    switcheditKonten();
                } else {
                    $('#er-link').attr('checked', false);
                    $('#er-file').attr('checked', true);
                    switcheditKonten();
                }
                modal.show();
            });


        })
    </script>
@endsection
