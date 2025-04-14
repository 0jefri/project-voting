@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
  <h4 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
    Selamat datang, {{ Auth::user()->name }}!
  </h4>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg">

      <div class="p-6 text-center font-extrabold text-2xl text-gray-900 dark:text-gray-100">
      {{ __("SISTEM PENDUKUNG KEPUTUSAN PEMILIHAN KETUA BEM UM BANJARMASIN") }}
      </div>

      <div class="p-6 text-gray-900 dark:text-gray-100 leading-relaxed">
      Universitas Muhammadiyah Banjarmasin (UM BJM) adalah salah satu perguruan tinggi swasta terkemuka di
      Kalimantan Selatan. Kampus ini memiliki berbagai organisasi mahasiswa, salah satunya adalah
      <span class="font-semibold">Badan Eksekutif Mahasiswa (BEM)</span>, yang berperan sebagai badan eksekutif
      tingkat universitas.
      </div>

      <div class="p-6 text-gray-900 dark:text-gray-100 leading-relaxed">
      Setiap tahun, UM BJM menggelar
      <span class="font-semibold">Pemilihan Umum Mahasiswa (Pemilwa)</span> untuk memilih Ketua dan Wakil Ketua BEM.
      Proses ini diatur oleh <span class="font-semibold">Undang-Undang Keluarga Mahasiswa UM BJM Nomor 02 Tahun
        2021</span>,
      dengan asas langsung, umum, bebas, rahasia, jujur, dan adil.
      </div>

      <div class="p-6 text-gray-900 dark:text-gray-100 leading-relaxed">
      Saat ini, sistem pemilihan masih menggunakan platform <span class="font-semibold">Google Form</span> sebagai
      media pemungutan suara.
      Meskipun praktis, pendekatan ini memiliki sejumlah tantangan, seperti:
      <ul class="list-disc pl-6 mt-2">
        <li>Lambatnya pembaruan data pemilih</li>
        <li>Potensi ketidakakuratan informasi</li>
        <li>Mahasiswa yang tidak aktif masih tercantum dalam daftar pemilih</li>
      </ul>
      </div>

      <div class="p-6 text-gray-900 dark:text-gray-100 leading-relaxed">
      Untuk mengatasi kendala tersebut, diperlukan sistem yang lebih efisien dan terintegrasi guna menjamin
      transparansi serta akurasi dalam setiap tahapan Pemilwa.
      Sistem pendukung keputusan berbasis <span class="font-semibold">Profile Matching</span> menjadi solusi inovatif
      untuk memastikan pemilihan yang lebih objektif dan terpercaya.
      </div>

    </div>
    </div>
  </div>
@endsection
@section('footer')
  <div class="container mx-auto px-4">
    <div class="mb-4">
    <img src="{{ asset('images/logo.png') }}" alt="UM Banjarmasin" style="max-height: 40px;">
    </div>

    <p class="text-sm opacity-80 mb-4">Universitas Muhammadiyah Banjarmasin</p>

    <div class="border-t border-white/20 pt-4">
    <p class="text-xs md:text-sm">
      © 2025 Hak Cipta Dilindungi - UM Banjarmasin
    </p>
    </div>
  </div>
@endsection