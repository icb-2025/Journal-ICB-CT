@extends('layouts.super')

@section('title', 'Data Liburan')

@section('content')
<div class="space-y-6">
    <!-- Filter Buttons -->
    <div class="flex p-4 bg-white rounded-lg shadow">
        <button id="company-holiday-btn" class="px-4 py-2 mr-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            Libur Perusahaan
        </button>
        <button id="national-holiday-btn" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
            Libur Nasional
        </button>
    </div>

    <!-- Company Holidays Section (Initially visible) -->
    <div id="company-holidays-section" class="p-6 bg-white rounded-lg shadow">
        @include('superuser.jadwal-hari-libur.partials.company-holidays')
    </div>

    <!-- National Holidays Section (Initially hidden) -->
    <div id="national-holidays-section" class="hidden p-6 bg-white rounded-lg shadow">
        @include('superuser.jadwal-hari-libur.partials.national-holidays')
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const companyBtn = document.getElementById('company-holiday-btn');
    const nationalBtn = document.getElementById('national-holiday-btn');
    const companySection = document.getElementById('company-holidays-section');
    const nationalSection = document.getElementById('national-holidays-section');

    // Switch to company holidays
    companyBtn.addEventListener('click', function() {
        companySection.classList.remove('hidden');
        nationalSection.classList.add('hidden');
        companyBtn.classList.remove('bg-gray-200', 'text-gray-700');
        companyBtn.classList.add('bg-indigo-600', 'text-white');
        nationalBtn.classList.remove('bg-indigo-600', 'text-white');
        nationalBtn.classList.add('bg-gray-200', 'text-gray-700');
    });

    // Switch to national holidays
    nationalBtn.addEventListener('click', function() {
        companySection.classList.add('hidden');
        nationalSection.classList.remove('hidden');
        nationalBtn.classList.remove('bg-gray-200', 'text-gray-700');
        nationalBtn.classList.add('bg-indigo-600', 'text-white');
        companyBtn.classList.remove('bg-indigo-600', 'text-white');
        companyBtn.classList.add('bg-gray-200', 'text-gray-700');
    });

    // Load national holidays data when national section is shown
    nationalBtn.addEventListener('click', function() {
        if (!window.nationalHolidaysLoaded) {
            fetch("{{ url('/api/national-holidays') }}")
                .then(response => response.json())
                .then(data => {
                    let tbody = document.getElementById('national-holidays-body');
                    tbody.innerHTML = '';

                    data.forEach(item => {
                        let rawDate = item.holiday_date || item.date;
                        let [year, month, day] = rawDate.split('-');

                        let formattedDate = new Date(year, month - 1, day).toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric'
                        });

                        let row = `
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">${formattedDate}</td>
                                <td class="px-6 py-4">${item.holiday_name}</td>
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <button onclick="openEditNationalModal()" class="p-1 text-green-600 hover:text-green-900">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="confirmDelete('national')" class="p-1 ml-2 text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                        tbody.innerHTML += row;
                    });
                    window.nationalHolidaysLoaded = true;
                })
                .catch(error => {
                    console.error('Error fetching national holidays:', error);
                    document.getElementById('national-holidays-body').innerHTML = `
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-red-500">Gagal memuat data</td>
                        </tr>
                    `;
                });
        }
    });
});
</script>
@endsection