<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CLT Toolbox</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-[#F8FAFC] font-sans antialiased">

    {{-- TOP NAVIGATION --}}
    @include('layouts.navigation')

    {{-- MAIN CONTENT --}}
    <main class="w-full min-h-screen">

        {{ $slot }}

    </main>

    {{-- SWEET ALERT --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- SUCCESS TOAST --}}
    @if(session('success'))

    <script>

        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true
        });

    </script>

    @endif

    {{-- ERROR TOAST --}}
    @if(session('error'))

    <script>

        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });

    </script>

    @endif

    {{-- DELETE CONFIRM --}}
    <script>

        function confirmDelete(button)
        {
            Swal.fire({
                title: 'Delete Data?',
                text: "This data cannot be restored.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'Cancel'
            }).then((result) => {

                if (result.isConfirmed) {

                    button.closest('form').submit();

                }

            });
        }

    </script>

</body>

</html>