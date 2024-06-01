<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="title" content="Klinik OPT Tebu" />
    <meta name="description" content="Klinik OPT Tebu adalah tools untuk opt" />
    <meta name="keywords" content="klinik opt client, tryoutkedinasan, stan, stis, ipdn, sttd" />
    <meta name="author" content="IT Klinik OPT Tebu" />
    <meta property="og:title" content="Klinik OPT Tebu" />
    <meta property="og:description" content="Klinik OPT Tebu adalah tools untuk opt" />
    <title>{{ env('APP_NAME') }}</title>
    <link rel="shortcut icon" href="/assets/images/p3gi-logo-3.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js"
        integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <section class="h-full gradient-form bg-gray-200 md:h-screen md:w-screen flex justify-center items-center">
        <div class="container py-12 px-6 h-full">
            <div class="flex justify-center items-center flex-wrap h-full g-6 text-gray-800">
                <div class="xl:w-10/12">
                    <div class="block bg-white shadow-lg rounded-lg">
                        <div class="lg:flex lg:flex-wrap g-0">
                            <div class="lg:w-6/12 px-4 md:px-0">
                                <div class="md:p-12 md:mx-6">
                                    <div class="text-center">
                                        <img class="mx-auto w-24" src="/assets/images/p3gi-logo-3.png" alt="logo" />
                                        <h4 class="text-xl font-semibold mt-4 mb-12 pb-1">Selamat Datang!</h4>
                                    </div>
                                    @if ($message = Session::get('message'))
                                        <div class="w-full rounded-xl shadow-md  text-white text-center p-1 my-1 "
                                            style="
                            background: linear-gradient(
                              to right,
                              #FE6722,
                              #fa3e3e
                            );
                          ">
                                            {{ $message }}
                                        </div>
                                    @endif
                                    <form action="/login" method="POST">
                                        @csrf
                                        <p class="mb-4">Silahkan login untuk menggunakan <span
                                                class="font-bold text-[#007aff]">Klinik OPT Panel</span></p>
                                        <div class="mb-4">
                                            <input type="email"
                                                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                placeholder="email" value="{{ old('email') }}" required
                                                name="email" />
                                            @error('email')
                                                <p class=" text-red-500 "> {{ $message }} </p>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <input type="password"
                                                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                placeholder="password" value="{{ old('password') }}" required
                                                name="password" />
                                            @error('password')
                                                <p class=" text-red-500 "> {{ $message }} </p>
                                            @enderror
                                        </div>

                                        <div class="text-center pt-1 mb-12 pb-1">
                                            <button
                                                class="inline-block px-6 py-2.5 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out w-full mb-3"
                                                type="submit" data-mdb-ripple="true" data-mdb-ripple-color="light"
                                                style="
                              background: linear-gradient(
                                to right,
                                #0CB0E2,
                                #007AFF,
                                #34AADC,
                                #0CB0E2
                              );
                            ">
                                                Log in
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="lg:w-6/12 flex items-center lg:rounded-r-lg rounded-b-lg lg:rounded-bl-none"
                                style="
                      background: linear-gradient(to right,
                      #0CB0E2,
                      #007AFF,
                      #34AADC);
                    ">
                                <div class="text-white px-4 py-6 md:p-12 md:mx-6">
                                    <h4 class="text-xl font-semibold mb-6 text-center">Klinik OPT Management Tools</h4>
                                    <p class="text-sm text-justify">
                                        Selamat datang di Klinik OPT Management.
                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus, facere. 
                                        Eum quasi dolorem provident deserunt deleniti eaque doloremque, suscipit repellendus quam quibusdam omnis beatae, aspernatur hic, autem atque maiores quas.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        @if ($message = Session::get('success'))
            Toast.fire({
                icon: 'success',
                title: '{{ $message }}'
            })
        @endif
        @if ($errors = Session::get('error'))
            @if (is_array($errors) && count($errors) > 0)
                @foreach ($errors as $fieldErrors)
                    @foreach ($fieldErrors as $error)
                        Toast.fire({
                            icon: 'error',
                            title: '{{ $error }}'
                        });
                    @endforeach
                @endforeach
            @else
                Toast.fire({
                    icon: 'error',
                    title: '{{ $errors }}'
                });
            @endif
        @endif
        @if ($message = Session::get('warning'))
            Toast.fire({
                icon: 'warning',
                title: '{{ $message }}'
            })
        @endif
        @if ($message = Session::get('info'))
            Toast.fire({
                icon: 'info',
                title: '{{ $message }}'
            })
        @endif
        @if ($message = Session::get('message'))
            Toast.fire({
                icon: 'info',
                title: '{{ $message }}'
            })
        @endif
    </script>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
</body>

</html>
