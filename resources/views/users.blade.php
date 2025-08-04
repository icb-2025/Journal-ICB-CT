@extends('layouts.user')

@section('content')
<div class="flex items-center justify-center min-h-[calc(100vh-200px)]">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
        <div class="text-center">
            <span class="inline-block px-4 py-2 text-lg font-semibold rounded-full bg-blue-100 text-blue-800 mb-4">
                Dalam Perbaikan
            </span>
            <p class="text-gray-600 mt-4">
                Halaman ini sedang dalam proses perbaikan. Silakan kembali nanti.
            </p>
            <svg class="w-16 h-16 mx-auto mt-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'info',
            title: 'Halaman Sedang Dalam Perbaikan',
            text: 'Silakan kembali lagi nanti',
            confirmButtonText: 'Oke',
            timer: 4000,
            timerProgressBar: true,
            willClose: () => {
                const previous = document.referrer;
                if (previous && new URL(previous).origin === window.location.origin) {
                    window.location.href = previous;
                } else {
                    window.location.href = @json(route('index'));
                }
            }
        });
    });
</script>
@endsection
