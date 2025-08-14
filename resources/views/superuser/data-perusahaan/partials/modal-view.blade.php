<div id="viewModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        
        <!-- Modal content -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Detail Perusahaan
                        </h3>
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Kode Perusahaan:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-kode"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nama Industri:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-nama"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Bidang Usaha:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-bidang"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Alamat:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-alamat"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">No Telepon:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-telepon"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nama Direktur:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-direktur"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nama Pembimbing:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-pembimbing"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Input By:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-inputby"></p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Input Date:</p>
                                <p class="mt-1 text-sm text-gray-900" id="modal-inputdate"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="hideModal()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function showModal(kode, nama, bidang, alamat, telepon, direktur, pembimbing, inputby, inputdate) {
        document.getElementById('modal-kode').textContent = kode;
        document.getElementById('modal-nama').textContent = nama;
        document.getElementById('modal-bidang').textContent = bidang;
        document.getElementById('modal-alamat').textContent = alamat;
        document.getElementById('modal-telepon').textContent = telepon;
        document.getElementById('modal-direktur').textContent = direktur;
        document.getElementById('modal-pembimbing').textContent = pembimbing;
        document.getElementById('modal-inputby').textContent = inputby;
        document.getElementById('modal-inputdate').textContent = inputdate;
        
        document.getElementById('viewModal').classList.remove('hidden');
    }

    function hideModal() {
        document.getElementById('viewModal').classList.add('hidden');
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('viewModal');
        if (event.target === modal) {
            hideModal();
        }
    }

    // Close modal with ESC key
    document.onkeydown = function(evt) {
        evt = evt || window.event;
        if (evt.keyCode === 27) {
            hideModal();
        }
    };
</script>