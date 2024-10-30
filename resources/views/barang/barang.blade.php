<x-app-layout>

    <!-- ini atmin -->
    @if(Auth::user()->role == 'admin')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Barang') }}
        </h2>
    </x-slot>


    <div class=" ml-28 py-12">
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
                    {{ __("Ini Halaman Barang") }}
                </div>
            </div>
        </div>
    </div>
    <div class="w-3/4 ml-80 overflow-x-auto shadow-md sm:rounded-lg p-4">
        <b>
            <h1 class="text-2xl mb-4">Data Barang</h1>
        </b>
        <!-- Tombol Tambah  -->
        <button type="button" class="text-gray-400 bg-gray-800 hover:bg-gray-900 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-4 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"
            id="openAddModal">
            Tambah Data
        </button>

        <!-- Tabel  Barang -->
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Gambar</th>
                    <th scope="col" class="px-6 py-3">Nama Barang</th>
                    <th scope="col" class="px-6 py-3">Deskripsi</th>
                    <th scope="col" class="px-6 py-3">Kategori</th>
                    <th scope="col" class="px-6 py-3">Harga</th>
                    <th scope="col" class="px-6 py-3">Stock</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barang as $data)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $loop->iteration }}
                    </th>
                    <td class="px-6 py-4">
                        @if($data->gambar)
                        <img src="{{ asset('storage/' . $data->gambar) }}" alt="{{ $data->nama }}" class="w-16 h-16 rounded">
                        @else
                        <span>No Image</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">{{ $data->nama }}</td>
                    <td class="px-6 py-4">{{ $data->deskripsi }}</td>
                    <td class="px-6 py-4">{{ optional($data->kategori)->nama ?? 'Kategori Tidak Tersedia' }}</td>
                    <td class="px-6 py-4">{{ number_format($data->harga, 2, ',', '.') }}</td>
                    <td class="px-6 py-4">{{ $data->stok }}</td>
                    <td class="px-6 py-4">
                        <!-- Edit -->
                        <button type="button" class="font-medium text-blue-600 dark:text-blue-500 hover:underline edit-button"
                            data-id="{{ $data->id }}"
                            data-nama="{{ $data->nama }}"
                            data-deskripsi="{{ $data->deskripsi }}"
                            data-kategori_id="{{ $data->kategori_id }}"
                            data-harga="{{ $data->harga }}"
                            data-stok="{{ $data->stok }}">
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


        <!-- Pagination -->
        <div class="mt-4 m-2">
            {{ $barang->links('pagination::tailwind') }}
        </div>
    </div>
    @endif

    <!-- ini user -->
    @if(Auth::user()->role == 'user')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Belanja') }}
        </h2>
    </x-slot>


    <div class="ml-28 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Ini Halaman Belanja") }}
                </div>
            </div>
        </div>
    </div>

    <div class="container  ml-80 px-3 my-12 pb-8 pt-3 w-2/4 h-auto bg-emerald-400 ">
        <h1 class="text-2xl font-bold mb-4 text-left">Produk Kami</h1>
        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
            @foreach($barang as $barang1)
            <div class="bg-white shadow-md rounded-lg p-4">
                <img src="{{ $barang1->gambar }}" alt="Product Image" class="rounded-lg w-full mb-4">
                <h2 class="text-lg font-semibold mb-2">{{ $barang1->nama }}</h2>
                <p class="text-gray-600 mb-2">{{ $barang1->deskripsi }}</p>

                <div class="grid grid-cols-2 items-center gap-7 justify-items-center">
                    <!-- Dropdown Level -->
                    <select id="level-select" class="level-select bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" data-barang-id="{{ $barang1->id }}">
                        <option selected>Pilih level</option>
                        @foreach($kategori as $kat)
                        <option value="{{ $kat->id }}" data-barang-kategori="{{ $kat->nama }}">{{ $kat->nama }}</option>
                        @endforeach
                    </select>
                    <!-- Tombol Tambah -->
                    <button
                        class="h-10 bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded openCartModal"
                        data-barang-id="{{ $barang1->id }}"
                        data-barang-nama="{{ $barang1->nama }}"
                        data-barang-deskripsi="{{ $barang1->deskripsi }}"
                        data-barang-gambar="{{ $barang1->gambar }}"
                        data-barang-harga="{{ $barang1->harga }}">
                        Tambah
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif



    <!-- Modal Tambah Data -->
    <div id="addModal" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-900 bg-opacity-50">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tambah Data</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" id="closeAddModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Barang</label>
                            <input type="text" name="nama" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Nama Barang" required>
                        </div>
                        <div>
                            <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                            <input type="text" name="deskripsi" id="deskripsi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Deskripsi" required>
                        </div>
                        <div>
                            <label for="kategori_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                            <select name="kategori_id" id="kategori_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                                <option value="" selected>Pilih Kategori</option>
                                @foreach($kategori as $kategori1)
                                <option value="{{ $kategori1->id }}">{{ $kategori1->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                            <input type="number" name="harga" id="harga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Harga" required>
                        </div>
                        <div>
                            <label for="stok" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock</label>
                            <input type="number" name="stok" id="stok" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Stock" required>
                        </div>
                        <div>
                            <label for="gambar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload Gambar</label>
                            <input type="file" name="gambar" id="gambar" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" accept="image/*">
                        </div>
                    </div>
                    <button type="submit" class="mt-3 bg-gray-700 text-gray-300 bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Tambah Barang
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Update Data -->
    <div id="updateModal" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-900 bg-opacity-50">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Update Data</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" id="closeUpdateModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form action="" method="POST" id="updateForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="update_nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Barang</label>
                            <input type="text" name="nama" id="update_nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Nama Barang" required>
                        </div>
                        <div>
                            <label for="update_deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                            <input type="text" name="deskripsi" id="update_deskripsi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Deskripsi" required>
                        </div>
                        <div>
                            <label for="update_kategori_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                            <select name="kategori_id" id="update_kategori_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                                <option value="" selected>Pilih Kategori</option>
                                @foreach($kategori as $kategori1)
                                <option value="{{ $kategori1->id }}">{{ $kategori1->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="update_harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                            <input type="number" name="harga" id="update_harga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Harga" required>
                        </div>
                        <div>
                            <label for="update_stok" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock</label>
                            <input type="number" name="stok" id="update_stok" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Stock" required>
                        </div>
                    </div>
                    <div>
                        <label for="update_gambar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar</label>
                        <input type="file" name="gambar" id="update_gambar" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    </div>
                    <button type="submit" class="mt-3 bg-gray-700 text-gray-300 bg-primary-700 hover:bg-primary-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Update Barang
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Hapus Data -->
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
                    <p class="text-sm text-gray-700 dark:text-gray-300">Apakah Anda yakin ingin menghapus <span id="hapus_nama" class="font-semibold"></span>?</p>
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

    <!-- Modal Tambah Keranjang -->
    <div id="addCartModal" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-900 bg-opacity-50">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <div class="relative p-4 bg-white rounded-lg shadow">
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b">
                    <h3 class="text-lg font-semibold text-gray-900">Tambah ke Keranjang</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" id="closeAddCartModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414 1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form action="{{ route('keranjang.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_barang" id="modalIdBarang">
                    <input type="hidden" name="id_kategori" id="modalIdKategori">

                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama Barang</label>
                            <input type="text" name="nama" id="modalNama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5" readonly>
                        </div>
                        <div>
                            <label for="level" class="block mb-2 text-sm font-medium text-gray-900">Level</label>
                            <input type="text" name="level" id="modalLevel" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5" readonly>
                        </div>
                        <div>
                            <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
                            <textarea name="deskripsi" id="modalDeskripsi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5" readonly></textarea>
                        </div>
                        <div>
                            <label for="jumlah" class="block mb-2 text-sm font-medium text-gray-900">Jumlah</label>
                            <input type="number" name="jumlah" id="modalJumlah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5" placeholder="Jumlah" required>
                        </div>
                        <div>
                            <label for="harga" class="block mb-2 text-sm font-medium text-gray-900">Harga Satuan</label>
                            <input type="number" name="harga" id="modalHarga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5" readonly>
                        </div>
                        <div>
                            <label for="total" class="block mb-2 text-sm font-medium text-gray-900">Total Harga</label>
                            <input type="number" name="total" id="modalTotal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5" readonly>
                        </div>
                    </div>
                    <button type="submit" class="mt-3 bg-blue-600 text-white hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Tambah ke Keranjang
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript Modal -->
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


            // Modal Update Data
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

            // Tombol Edit
            document.querySelectorAll('.edit-button').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const nama = this.dataset.nama;
                    const deskripsi = this.dataset.deskripsi;
                    const kategoriId = this.dataset.kategori_id;
                    const harga = this.dataset.harga;
                    const stok = this.dataset.stok;

                    document.getElementById('update_nama').value = nama;
                    document.getElementById('update_deskripsi').value = deskripsi;
                    document.getElementById('update_kategori_id').value = kategoriId;
                    document.getElementById('update_harga').value = harga;
                    document.getElementById('update_stok').value = stok;

                    // Set action form untuk update
                    const form = document.getElementById('updateForm');
                    form.action = `/barang/${id}`; // Ganti dengan route sesuai kebutuhan

                    // Tampilkan modal update
                    document.getElementById('updateModal').classList.remove('hidden');
                });
            });


            // Modal Hapus Data
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
                    hapusForm.action = `/barang/${id}`;

                    // Tampilkan modal
                    hapusModal.classList.remove('hidden');
                });
            });

        });

        //Modal Tambah Keranjang
        document.querySelectorAll('.openCartModal').forEach(button => {
            button.addEventListener('click', function() {
                const barangId = this.getAttribute('data-barang-id');
                const barangNama = this.getAttribute('data-barang-nama');
                const barangDeskripsi = this.getAttribute('data-barang-deskripsi');
                const barangHarga = this.getAttribute('data-barang-harga');

                // Ambil kategori dari dropdown
                const levelSelect = this.parentNode.querySelector('.level-select');
                const kategoriId = levelSelect.value;
                const kategoriNama = levelSelect.options[levelSelect.selectedIndex].text;

                // Isi data di modal
                document.getElementById('modalIdBarang').value = barangId;
                document.getElementById('modalNama').value = barangNama;
                document.getElementById('modalDeskripsi').value = barangDeskripsi;
                document.getElementById('modalHarga').value = barangHarga;
                document.getElementById('modalIdKategori').value = kategoriId;
                document.getElementById('modalLevel').value = kategoriNama;

                // Tampilkan modal
                document.getElementById('addCartModal').classList.remove('hidden');
            });
        });

        document.getElementById('closeAddCartModal').addEventListener('click', function() {
            document.getElementById('addCartModal').classList.add('hidden');
        });

        // Hitung total harga
        document.getElementById('modalJumlah').addEventListener('input', function() {
            const harga = document.getElementById('modalHarga').value;
            const jumlah = this.value;
            const total = harga * jumlah;
            document.getElementById('modalTotal').value = total;
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