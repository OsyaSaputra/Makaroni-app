<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kategori') }}
        </h2>
    </x-slot>

    <div class="ml-28 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Popup -->
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif


            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Ini Halaman Kategori") }}
                </div>
            </div>
        </div>
    </div>

    <div class="w-3/4 ml-80 overflow-x-auto shadow-md sm:rounded-lg p-4">
        <b>
            <h1 class="text-2xl mb-4">Data Kategori</h1>
        </b>
        <!-- Tombol Tambah Data -->
        <button type="button" class="text-gray-400 bg-gray-800 hover:bg-gray-900 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-4 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"
            id="openAddModal">
            Tambah Data
        </button>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Nama Kategori</th>
                    <th scope="col" class="px-6 py-3">Keterangan</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategori as $data)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $loop->iteration }}
                    </th>
                    <td class="px-6 py-4">{{ $data->nama }}</td>
                    <td class="px-6 py-4">{{ $data->keterangan }}</td>
                    <td class="px-6 py-4">
                        <!-- Edit -->
                        <button type="button" class="font-medium text-blue-600 dark:text-blue-500 hover:underline edit-button"
                            data-id="{{ $data->id }}"
                            data-nama="{{ $data->nama }}"
                            data-keterangan="{{ $data->keterangan }}">
                            Edit
                        </button>
                        |
                        <!-- Hapus -->
                        <button type="button" class="font-medium text-red-600 dark:text-red-500 hover:underline hapus-button"
                            data-id="{{ $data->id }}"
                            data-nama="{{ $data->nama }}">
                            Hapus
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4 m-2">
            {{ $kategori->links('pagination::tailwind') }}
        </div>
    </div>


    <div id="addModal" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-900 bg-opacity-50">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal Header -->
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tambah Kategori Baru</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" id="closeAddModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal Body -->
                <form action="{{ route('kategori.store') }}" method="POST" id="inputForm">
                    @csrf
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label for="input_nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kategori</label>
                            <input type="text" name="nama" id="input_nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Nama Kategori" required>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="input_keterangan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
                            <input type="text" name="keterangan" id="input_keterangan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Keterangan" required>
                        </div>
                    </div>
                    <button type="submit" class="mt-3 bg-gray-700 text-gray-300 bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Tambah Kategori
                    </button>
                </form>
            </div>
        </div>
    </div>


    <div id="updateModal" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-900 bg-opacity-50">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Update Kategori</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" id="closeUpdateModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form action="" method="POST" id="updateForm">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label for="update_nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kategori</label>
                            <input type="text" name="nama" id="update_nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Nama Kategori" required>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="update_keterangan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
                            <input type="text" name="keterangan" id="update_keterangan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Keterangan" required>
                        </div>
                    </div>
                    <button type="submit" class="mt-3 bg-gray-700 text-gray-300 bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Update Kategori
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div id="hapusModal" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-900 bg-opacity-50">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Konfirmasi Hapus</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" id="closeHapusModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form action="" method="POST" id="hapusForm">
                    @csrf
                    @method('DELETE')
                    <p class="text-sm text-gray-700 dark:text-gray-300">Apakah Anda yakin ingin menghapus kategori <span id="hapus_nama" class="font-semibold"></span>?</p>
                    <div class="mt-4 flex justify-end">
                        <button type="button" class="mr-2 text-gray-500 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-lg text-sm px-4 py-2 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-600" id="cancelHapusModal">Batal</button>
                        <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 rounded-lg text-sm px-4 py-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Modal Tambah Data
            const openAddModalBtn = document.getElementById('openAddModal');
            const closeAddModalBtn = document.getElementById('closeAddModal');
            const addModal = document.getElementById('addModal');

            openAddModalBtn.addEventListener('click', () => {
                addModal.classList.remove('hidden');
            });

            closeAddModalBtn.addEventListener('click', () => {
                addModal.classList.add('hidden');
            });

            window.addEventListener('click', (event) => {
                if (event.target === addModal) {
                    addModal.classList.add('hidden');
                }
            });
        });


        document.addEventListener('DOMContentLoaded', function() {
            // Modal Update 
            const updateModal = document.getElementById('updateModal');
            const closeUpdateModalBtn = document.getElementById('closeUpdateModal');

            closeUpdateModalBtn.addEventListener('click', () => {
                updateModal.classList.add('hidden');
            });

            window.addEventListener('click', (event) => {
                if (event.target === updateModal) {
                    updateModal.classList.add('hidden');
                }
            });

            //  Edit
            const editButtons = document.querySelectorAll('.edit-button');
            editButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const id = button.getAttribute('data-id');
                    const nama = button.getAttribute('data-nama');
                    const keterangan = button.getAttribute('data-keterangan');

                    // Isi data
                    document.getElementById('update_nama').value = nama;
                    document.getElementById('update_keterangan').value = keterangan;

                    // action update
                    const updateForm = document.getElementById('updateForm');
                    updateForm.action = `/kategori/${id}`;

                    // Tampilkan modal 
                    updateModal.classList.remove('hidden');
                });
            });

            // Modal Hapus 
            const hapusModal = document.getElementById('hapusModal');
            const closeHapusModalBtn = document.getElementById('closeHapusModal');
            const cancelHapusModalBtn = document.getElementById('cancelHapusModal');

            closeHapusModalBtn.addEventListener('click', () => {
                hapusModal.classList.add('hidden');
            });

            cancelHapusModalBtn.addEventListener('click', () => {
                hapusModal.classList.add('hidden');
            });

            window.addEventListener('click', (event) => {
                if (event.target === hapusModal) {
                    hapusModal.classList.add('hidden');
                }
            });

            // Tombol Hapus
            const hapusButtons = document.querySelectorAll('.hapus-button');
            hapusButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const id = button.getAttribute('data-id');
                    const nama = button.getAttribute('data-nama');

                    // Isi data modal 
                    document.getElementById('hapus_nama').textContent = nama;

                    // Atur action ID
                    const hapusForm = document.getElementById('hapusForm');
                    hapusForm.action = `/kategori/${id}`;

                    // Tampilkan modal
                    hapusModal.classList.remove('hidden');
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.querySelector('.bg-green-100');
            const errorAlert = document.querySelector('.bg-red-100');

            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.display = 'none';
                }, 5000); // Menghilang setelah 5 detik
            }

            if (errorAlert) {
                setTimeout(() => {
                    errorAlert.style.display = 'none';
                }, 5000); // Menghilang setelah 5 detik
            }
        });
    </script>

</x-app-layout>