<div class="flex flex-col justify-between mb-6 space-y-4 md:flex-row md:items-center md:space-y-0">
    <h3 class="text-xl font-semibold text-gray-800">Jadwal Libur Nasional</h3>
    <div class="flex flex-col space-y-2 sm:flex-row sm:space-y-0 sm:space-x-2">
        <!-- Month Filter -->
        <select id="month-filter" class="px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <option value="">Semua Bulan</option>
            @for($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>
                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                </option>
            @endfor
        </select>
        
        <!-- Search Input -->
        <div class="relative">
            <input type="text" id="holiday-search" placeholder="Cari libur..." 
                   class="w-full px-4 py-2 text-sm border border-gray-300 rounded-md pl-10 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<div class="overflow-x-auto border border-gray-200 rounded-lg">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Tanggal</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Keterangan</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-right text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody id="national-holidays-body" class="bg-white divide-y divide-gray-200">
            <tr>
                <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                    <div class="flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5 text-indigo-500 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Memuat data...</span>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const monthFilter = document.getElementById('month-filter');
    const holidaySearch = document.getElementById('holiday-search');
    let holidaysData = []; // Store loaded data for filtering
    
    // Function to show loading state
    function showLoading() {
        const tbody = document.getElementById('national-holidays-body');
        tbody.innerHTML = `
            <tr>
                <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                    <div class="flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5 text-indigo-500 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Memuat data...</span>
                    </div>
                </td>
            </tr>
        `;
    }
    
    // Function to load and filter holidays
    function loadHolidays() {
        showLoading();
        
        fetch("{{ url('/api/national-holidays') }}")
            .then(response => response.json())
            .then(data => {
                holidaysData = data;
                filterHolidays();
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('national-holidays-body').innerHTML = `
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-red-500">
                            <div class="flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Gagal memuat data</span>
                            </div>
                        </td>
                    </tr>
                `;
            });
    }
    
    // Rest of your existing filter functions remain the same...
    function filterHolidays() {
        const selectedMonth = monthFilter.value;
        const searchTerm = holidaySearch.value.toLowerCase();
        
        let filteredData = holidaysData;
        
        if (selectedMonth) {
            filteredData = filteredData.filter(item => {
                const date = new Date(item.holiday_date || item.date);
                return (date.getMonth() + 1) == selectedMonth;
            });
        }
        
        if (searchTerm) {
            filteredData = filteredData.filter(item => 
                item.holiday_name.toLowerCase().includes(searchTerm)
            );
        }
        
        updateHolidaysTable(filteredData);
    }
    
    function updateHolidaysTable(data) {
        const tbody = document.getElementById('national-holidays-body');
        
        if (data.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                        <div class="flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Tidak ada data yang cocok</span>
                        </div>
                    </td>
                </tr>
            `;
            return;
        }
        
        tbody.innerHTML = data.map(item => {
            const rawDate = item.holiday_date || item.date;
            const [year, month, day] = rawDate.split('-');
            const formattedDate = new Date(year, month - 1, day).toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
            
            return `
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
        }).join('');
    }
    
    // Event listeners
    monthFilter.addEventListener('change', filterHolidays);
    holidaySearch.addEventListener('input', filterHolidays);
    
    // Initial load
    loadHolidays();
});
</script>