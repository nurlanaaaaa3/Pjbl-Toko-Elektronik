<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-x1 text-black leading-tight">
            DASHBOARD
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-x-7x1 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-black font-bold mb-4 text-black">Selamat Datang, {{ auth()->user()->name }}!</h3>
                <div class="flex gap-4">
                    <a href="{{ route('admin.categories.index') }}"
                       class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                       Kelola Kategori
                    </a>
                    <a href="{{ route('admin.products.index') }}"
                       class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                       Kelola Produk
                    </a>
                    <a href="{{ route('admin.products.create') }}"
                       class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                       + Tambah Produk
                    </a>
                    <a href="{{ route('admin.categories.create') }}"
                       class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                       + Tambah Kategori
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
