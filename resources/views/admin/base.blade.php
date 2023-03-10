<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Stock Obat || Admin Page</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="{{ asset('css/appstyle/genosstailwind.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('local/vendor/swal2/dist/sweetalert2.min.css') }}" type="text/css">

    {{-- <link rel="stylesheet"



    {{-- ICON --}}
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('local/vendor/swal2/dist/sweetalert2.all.min.js') }}"></script>
    @yield('css')
</head>

<body class="relative min-h-screen">

    <nav class="h-[70px] bg-white  top-0 w-full shadow-sm z-20 fixed">
        <div class="px-[24px] relative h-full flex items-center z-20 justify-between">

            <div class=" h-full flex items-center">
                <a onclick="openNav()"><span
                        class="material-symbols-outlined cursor-pointer rounded-full p-2 hover:bg-black/10 transition duration-300">
                        menu
                    </span></a>

                {{-- <img src="{{ asset('/assets/local/logosurakarta.png') }}" class="logo   h-10   " alt="Surakarta Logo"> --}}

                <p class="text-xl font-bold ml-4">Puskesmas </p>
            </div>

            <div class=" h-full flex items-center">
                <button type="button" id="dropdownDefault" data-dropdown-toggle="dropdown"
                    class="block w-[35px] h-[35px] rounded-full bg-black/10 cursor-pointer overflow-hidden">
                    <img src="{{ asset('local/images/account.png') }}" class="logo   h-full w-full   "
                        alt="Surakarta Logo">
                </button>


                <!-- Dropdown menu -->
                <div id="dropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow ">
                    <ul class="py-1 text-sm text-gray-700 " aria-labelledby="dropdownDefault">

                        <a class="block py-2 px-4 text-xs   text-black/30 ">Username</a>
                        <div class="divide-y-2"></div>
                        <li>
                            <a class="block py-2 px-4 hover:bg-gray-100  text-red-600 cursor-pointer">Sign
                                out</a>
                        </li>
                    </ul>
                </div>

            </div>

        </div>
    </nav>

    <div class="flex h-full">
        <div id="sidebar" class="bg-white shadow-sm h-full fixed top-0 left-0 sidebar">
            <div class="min-h-[70px]"></div>
            <div class="p-3 py-5">

                {{-- <a class="menu nav-link" onclick="dropdown()">
                <span class="material-symbols-outlined mr-2 menu-icon">
                    settings
                </span>
                <div class="flex justify-between w-full">
                    <p class="title-menu block menu-text">Customize</p>
                    <span id="arrow" class="material-symbols-outlined mr-2 menu-icon">
                        expand_more

                    </span>
                </div>

            </a>

            <div id="submenu" class="transition">
                <a class="menu  nav-link ">
                    <span class="material-symbols-outlined mr-2 menu-icon">
                        fiber_manual_record
                    </span>
                    <p class="title-menu block nav-link menu-text text-sm">Slider </p>
                </a>
                <a class="menu  nav-link ">
                    <span class="material-symbols-outlined mr-2 menu-icon">
                        fiber_manual_record
                    </span>
                    <p class="title-menu block nav-link menu-text text-sm">Sejarah </p>
                </a>
                <a class="menu nav-link">

                    <span class="material-symbols-outlined mr-2 menu-icon">
                        fiber_manual_record
                    </span>
                    <p class="title-menu block nav-link menu-text ext-sm">Profil </p>
                </a>
                <a class="menu">

                    <span class="material-symbols-outlined mr-2 menu-icon">
                        fiber_manual_record
                    </span>
                    <p class="title-menu block nav-link menu-text ext-sm">Bidang </p>
                </a>
                <a class="menu">

                    <span class="material-symbols-outlined mr-2 menu-icon">
                        fiber_manual_record
                    </span>
                    <p class="title-menu block nav-link menu-text ext-sm">Aplikasi Online</p>
                </a>
                <a class="menu">

                    <span class="material-symbols-outlined mr-2 menu-icon">
                        fiber_manual_record
                    </span>
                    <p class="title-menu block nav-link menu-text ext-sm">Kontak Profil</p>
                </a>
                <a class="menu">

                    <span class="material-symbols-outlined mr-2 menu-icon">
                        fiber_manual_record
                    </span>
                    <p class="title-menu block nav-link menu-text ext-sm">Video Yotube</p>
                </a>
            </div> --}}

                <a class="menu {{ request()->is('/') ? 'bg-primarylight' : '' }}  nav-link"
                    href="{{ route('dashboard') }}">

                    <img src="{{ asset('local/icons/dashboard.svg') }}"
                        class=" mr-2 menu-icon text-sm w-6 object-scale-down">
                    <p class="title-menu block menu-text">Dashboard</p>
                </a>

                <a class="menu  {{ request()->is('master*') ? 'bg-primarylight' : '' }} nav-link" onclick="dropdown()">
                    <img src="{{ asset('local/icons/assignment.svg') }}"
                        class=" mr-2 menu-icon text-sm w-6 object-scale-down">
                    <div class="flex justify-between w-full">
                        <p class="title-menu block menu-text">Master</p>
                        <img id="arrow" src="{{ asset('local/icons/arrowup.svg') }}"
                            class=" mr-2 menu-icon text-xs w-6 object-scale-down" />
                    </div>

                </a>

                <div id="submenu" class="transition">
                    <a class="menu {{ request()->is('master') ? 'bg-primarylight2' : '' }} nav-link"
                        href="{{ route('masterbarang') }}">
                        <img src="{{ asset('local/icons/fiber_manual_record.svg') }}"
                            class=" mr-2 menu-icon text-sm w-6 object-scale-down" />
                        <p class="title-menu block nav-link menu-text text-sm">Master Barang </p>
                    </a>

                    <a class="menu nav-link {{ request()->is('master/lokasi') ? 'bg-primarylight2' : '' }}"
                        href="{{ route('masterlokasi') }}">
                        <img src="{{ asset('local/icons/fiber_manual_record.svg') }}"
                            class=" mr-2 menu-icon text-sm w-6 object-scale-down">
                        <p class="title-menu block nav-link menu-text text-sm">Master Lokasi </p>
                    </a>

                </div>

                <a class="menu  nav-link {{ request()->is('penerimaan') ? 'bg-primarylight' : '' }}"
                    href="{{ route('penerimaanbarang') }}">
                    <img src="{{ asset('local/icons/in.svg') }}" class=" mr-2 menu-icon text-sm w-6 object-scale-down">
                    <p class="title-menu block menu-text">Penerimaan Barang</p>
                </a>

                <a class="menu nav-link {{ request()->is('pengeluaran') ? 'bg-primarylight' : '' }}"
                    href="{{ route('pengeluaran') }}">
                    <img src="{{ asset('local/icons/out.svg') }}"
                        class=" mr-2 menu-icon text-sm w-6 object-scale-down">
                    <p class="title-menu block menu-text">Pengeluaran Barang</p>
                </a>

                <a class="menu nav-link {{ request()->is('penyesuaian*') ? 'bg-primarylight' : '' }}"
                    href="{{ route('penyesuaian') }}">
                    <img src="{{ asset('local/icons/sync.svg') }}"
                        class=" mr-2 menu-icon text-sm w-6 object-scale-down">
                    <p class="title-menu block menu-text">Penyesuaian Stock</p>
                </a>


                <a class="menu  nav-link {{ request()->is('laporan*') ? 'bg-primarylight' : '' }}"
                    onclick="dropdownlaporan()">
                    <img src="{{ asset('local/icons/assignment.svg') }}"
                        class=" mr-2 menu-icon text-sm w-6 object-scale-down">
                    <div class="flex justify-between w-full">
                        <p class="title-menu block menu-text">Laporan</p>
                        <img id="arrowlaporan" src="{{ asset('local/icons/arrowup.svg') }}"
                            class=" mr-2 menu-icon text-xs w-6 object-scale-down" />

                    </div>

                </a>

                <div id="submenulaporan" class="transition">

                    <a class="menu nav-link {{ request()->is('laporan/stock') ? 'bg-primarylight2' : '' }}"
                        href="{{ route('laporanstock') }}">
                        <img src="{{ asset('local/icons/fiber_manual_record.svg') }}"
                            class=" mr-2 menu-icon text-sm w-6 object-scale-down" />
                        <p class="title-menu block menu-text text-xs">Laporan Stock</p>
                    </a>

                    <a class="menu nav-link {{ request()->is('laporan/penerimaan') ? 'bg-primarylight2' : '' }}"
                        href="{{ route('laporanpenerimaan') }}">
                        <img src="{{ asset('local/icons/fiber_manual_record.svg') }}"
                            class=" mr-2 menu-icon text-xs w-6 object-scale-down" />
                        <p class="title-menu block menu-text text-xs">Laporan Penerimaan Barang</p>
                    </a>

                    <a class="menu nav-link {{ request()->is('laporan/barangkeluar') ? 'bg-primarylight2' : '' }}"
                        href="{{ route('laporanbarangkeluar') }}">
                        <img src="{{ asset('local/icons/fiber_manual_record.svg') }}"
                            class=" mr-2 menu-icon text-xs w-6 object-scale-down" />
                        <p class="title-menu block menu-text text-xs">Laporan Barang Keluar</p>
                    </a>


                    <a class="menu nav-link {{ request()->is('laporan/jurnal') ? 'bg-primarylight2' : '' }}"
                        href="{{ route('jurnal') }}">
                        <img src="{{ asset('local/icons/fiber_manual_record.svg') }}"
                            class=" mr-2 menu-icon text-xs w-6 object-scale-down" />
                        <p class="title-menu block menu-text text-xs">Laporan Jurnal</p>
                    </a>
                    <a class="menu nav-link {{ request()->is('laporan/penyesuaian') ? 'bg-primarylight2' : '' }}"
                        href="{{ route('adjustment') }}">
                        <img src="{{ asset('local/icons/fiber_manual_record.svg') }}"
                            class=" mr-2 menu-icon text-xs w-6 object-scale-down" />
                        <p class="title-menu block menu-text text-xs">Laporan Penyesuaian</p>
                    </a>
                </div>
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="w-full">
            <div class="h-[70px]">

            </div>

            <div class="flex " style="min-height: calc(100vh - 70px)">
                <div class="side">

                </div>
                <div class="flex-1">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>


    <script>
        $(document).ready(function() {
            var first = $(location).attr('pathname');

            first.indexOf(1);

            first.toLowerCase();

            first = first.split("/")[1];

            if (first == "master") {
                dropdown();
            } else if (first == "laporan") {
                dropdownlaporan();
            }

        });
    </script>

    <script type="text/javascript">
        function dropdown() {
            document.querySelector("#submenu").classList.toggle("hidden");
            document.querySelector("#arrow").classList.toggle("rotate-180");
        }

        dropdown();
    </script>

    <script type="text/javascript">
        function dropdownlaporan() {
            document.querySelector("#submenulaporan").classList.toggle("hidden");
            document.querySelector("#arrowlaporan").classList.toggle("rotate-180");
        }

        dropdownlaporan();
    </script>

    <script src="{{ asset('/js/flowbite.js') }}"></script>

    <script src="{{ asset('/js/admin/nav.js') }}"></script>
    <script src="{{ asset('js/admin/admin.js') }}"></script>
    {{-- <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script> --}}
    <script src="{{ asset('js/datatable.js') }}"></script>

    @yield('morejs')

    <script>
        jQuery.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": oSettings._iDisplayLength === -1 ?
                    0 : Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": oSettings._iDisplayLength === -1 ?
                    0 : Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };
    </script>
</body>

</html>
