<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login Page</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="{{ asset('css/appstyle/genosstailwind.css') }}" type="text/css">

    {{-- <link rel="stylesheet"



    {{-- ICON --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>

<body class="relative bg-slate-100" style="min-height: 100vh" >

    {{-- BACKGROUND --}}
    <div class="absolute bottom-0 w-full z-[-1]">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#1D9FAC" fill-opacity="1"
                d="M0,32L30,32C60,32,120,32,180,69.3C240,107,300,181,360,176C420,171,480,85,540,74.7C600,64,660,128,720,154.7C780,181,840,171,900,160C960,149,1020,139,1080,144C1140,149,1200,171,1260,170.7C1320,171,1380,149,1410,138.7L1440,128L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z">
            </path>
        </svg>
        <div class="h-36" style="background-color: #1D9FAC">

        </div>
    </div>
    <section class="">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen lg:py-0">
            @if (\Illuminate\Support\Facades\Session::has('failed'))
                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                    role="alert">
                    <span class="font-medium">Login Gagal!</span>
                    {{ \Illuminate\Support\Facades\Session::get('failed') }}
                </div>
            @endif

            <div class="w-full bg-white rounded-lg shadow  md:mt-0 sm:max-w-6xl xl:p-0  ">
                <div class="   grid md:grid-cols-2 grid-cols-1">

                    <div class="p-16">
                        <a href="#"
                            class="flex items-center mb-6 text-2xl font-semibold text-gray-900 justify-center ">

                           PUSKESMAS --------
                        </a>

                        <div class="border w-full text-black bg-black"></div>
                        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl mt-5">
                            Login
                        </h1>
                        <p class="text-sm">Masukan Username dan Password</p>
                        <form class="mt-6" method="post">
                            @csrf
                            <div>
                                <label for="text"
                                    class="block mb-2 text-sm font-medium text-gray-900 ">Username</label>
                                <input type="text" name="username" id="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5    "
                                    placeholder="username" required="">
                            </div>

                            <div class="mt-3">
                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-gray-900 ">Password</label>
                                <input type="password" name="password" id="password" placeholder="••••••••"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5   "
                                    required="">
                            </div>

                            <button type="submit"
                                class="w-full mt-6 text-white bg-secondary hover: hover:bg-primarylight transition duration-300 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-5 text-center ">
                                Sign
                                in
                            </button>
                            <p class="text-xs mt-3 text-black/60">Jika terjadi kesalahan sistem mohon hubungi administrator.</p>

                        </form>
                    </div>

                    <div class="mt-0 rounded-r-lg bg-primary hidden md:block" >

                        <img src="{{asset('/local/images/boxmedic.png')}}" class="mx-auto mt-0"/>
                        <p class="text-center pt-4 text-2xl text-white p-0 m-0 font-bold">Aplikasi stock obat</p>
                        <p class="text-center text-sm text-white/80 p-0 m-0">Aplikasi managemen stock obat di puskesmas ---------------</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('/js/flowbite.js') }}"></script>
    <script src="{{ asset('/js/nav.js') }}"></script>

    @yield('morejs')
</body>

</html>
