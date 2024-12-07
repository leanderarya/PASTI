@extends('layouts.app')

@section('title', 'IRS Mahasiswa')

@section('content')
<html>
<head>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-image: url('{{ asset('image/bg_PASTI1.png') }}');
      background-size: cover;
      background-repeat: no-repeat;
    }
  </style>
</head>
<!-- Background -->
<body class="min-h-screen bg-gradient-to-r from-teal-600 to-amber-500">
  <div class="max-w-7xl mx-auto p-4 min-h-screen">
  
  <!-- header -->
  <div class="flex w-full mb-4">
    <!-- Back Button -->
    <a href="{{ url()->previous()}}" class="absolute top-15 left-7 bg-teal-800 text-white p-2 rounded-full hover:bg-teal-700">
      <i class="fas fa-arrow-left text-xl"></i>
    </a>
    
    <div class="flex w-full">
        <button class="a flex-1 bg-amber-400 text-teal-800 p-2 rounded-tl-xl rounded-bl-xl shadow-sm hover:bg-orange-400 whitespace-nowrap flex justify-center items-center" data-filter=".IRS">
            <span class="text-white font-semibold italic text-center">IRS</span>
        </button>
        <button class="a flex-1 bg-teal-700 text-teal-800 p-2 rounded-tr-xl rounded-br-xl shadow-sm hover:bg-orange-400 whitespace-nowrap flex justify-center items-center" data-filter=".KHS">
            <span class="text-white font-semibold italic text-center">KHS</span>
        </button>
    </div>
  </div>

  <!-- Main Content Section -->
<div class="grid grid-cols-8 gap-4 w-full">

<!-- Left Section (Profile) -->
<div class="col-span-2 bg-teal-700 text-white p-4 rounded-lg">
  <div class="flex flex-col items-center space-y-2">
    <img alt="Profile Picture" class="rounded-full mb-4" src="{{ asset('image/profil.png') }}" width="100" height="100"/>
    <h2 class="text-center text-lg font-semibold mb-2">Profil</h2>
    <div class="text-left w-full">
      <div class="space-y-2">
        <div class="flex">
          <p class="text-sm align-top w-[120px] font-semibold">NAMA</p>
          <p class="text-sm align-top w-[10px] font-semibold">:</p>
          <p class="text-sm align-middle text-justify w-full">{{ $mahasiswa->nama }}</p>
        </div>
        <div class="flex">
          <p class="text-sm align-top w-[120px] font-semibold">NIM</p>
          <p class="text-sm align-top w-[10px] font-semibold">:</p>
          <p class="text-sm align-middle w-full">{{ $mahasiswa->nim }}</p>
        </div>
        <div class="flex">
          <p class="text-sm align-top w-[120px] font-semibold">Email</p>
          <p class="text-sm align-top w-[10px] font-semibold">:</p>
          <p class="text-sm align-middle w-full">{{ $mahasiswa->email }}</p>
        </div>
        <div class="flex">
          <p class="text-sm align-top w-[120px] font-semibold">Semester</p>
          <p class="text-sm align-top w-[10px] font-semibold">:</p>
          <p class="text-sm align-middle w-full">{{ $mahasiswa->smt }}</p>
        </div>
        <div class="flex">
          <p class="text-sm align-top w-[120px] font-semibold">IP Kumulatif</p>
          <p class="text-sm align-top w-[10px] font-semibold">:</p>
          <p class="text-sm align-middle w-full">{{ $mahasiswa->IPK }}</p>
        </div>
        <div class="flex">
          <p class="text-sm align-top w-[120px] font-semibold">IPS Sebelumnya</p>
          <p class="text-sm align-top w-[10px] font-semibold">:</p>
          <p class="text-sm align-middle w-full">{{ $mahasiswa->IPS_Sebelumnya }}</p>
        </div>
        <div class="flex">
          <p class="text-sm align-top w-[120px] font-semibold">Total SKS</p>
          <p class="text-sm align-top w-[10px] font-semibold">:</p>
          <p class="text-sm align-middle w-full">100</p>
        </div>
        <div class="flex">
          <p class="text-sm align-top w-[120px] font-semibold">Beban SKS Maks</p>
          <p class="text-sm align-top w-[10px] font-semibold">:</p>
          <p class="text-sm align-middle w-full">{{ $sksMax }}</p>
        </div>
        <div class="flex">
          <p class="text-sm align-top w-[120px] font-semibold">SKS Diambil</p>
          <p class="text-sm align-top w-[10px] font-semibold">:</p>
          <p class="text-sm align-middle w-full">{{ $sksTerpilih }}</p>
        </div>
      </div>
    </div>

    <!-- Tombol setujui dan tolak -->
    <div id="approvalButtons" class="grid grid-cols-2 w-full gap-4 mt-4">
      <!-- Tombol Tolak -->
      <form id='rejectForm' action="{{ route('tolakIRS') }}" method="POST" class="w-full">
          @csrf
          <input type="hidden" name="nim" value="{{ $mahasiswa->nim }}">
          <button type="submit" class="bg-white text-amber-400 p-3 rounded-lg flex justify-center items-center w-full">
              <span class="text-base font-semibold italic">TOLAK</span>
          </button>
      </form>

      <!-- Tombol Setujui -->
      <form id="approvalForm" action="{{ route('setujuiIRS') }}" method="POST" class="w-full">
        @csrf
        <input type="hidden" name="nim" value="{{ $mahasiswa->nim }}">
        <button type="button" id="approvalButton" class="bg-amber-400 text-white p-3 rounded-lg flex justify-center items-center w-full">
          <span class="text-base font-semibold italic">SETUJUI</span>
        </button>
      </form>
    </div>
  </div>
</div>

<!-- Right Section IRS or KHS -->
<div class="col-span-6">

  <!-- IRS Content -->
  <div class="IRS">
    <div class="bg-white text-teal-900 p-4 rounded-lg">
      <table class="w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden">
        <thead style="background-color: #FADBA9;">
          <tr class="text-black text-center">
            <th class="font-semibold text-sm uppercase px-6 py-4"> Kode </th>
            <th class="font-semibold text-sm uppercase px-6 py-4"> Mata Kuliah </th>
            <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> Kelas </th>
            <th class="font-semibold text-sm uppercase px-6 py-4"> Jadwal </th>
            <th class="font-semibold text-sm uppercase px-6 py-4 text-center"> SKS </th>
            <th class="font-semibold text-sm uppercase px-6 py-4"> Status </th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @foreach ($irs as $item)
            <tr>
              <td class="px-6 py-4">{{ $item->kodemk ?? 'N/A' }}</td> <!-- Menampilkan Kode Mata Kuliah -->
              <td class="px-6 py-4">{{ $item->namamk ?? 'N/A' }}</td> <!-- Menampilkan Nama Mata Kuliah -->
              <td class="px-6 py-4 text-center">{{ $item->kelas ?? 'N/A' }}</td> <!-- Menampilkan Kelas -->
              <td class="px-6 py-4">{{ $item->hari . ', ' . $item->start . ' - ' . $item->finish ?? 'N/A' }}</td> <!-- Menampilkan Jadwal -->
              <td class="px-6 py-4 text-center">{{ $item->sks ?? 'N/A' }}</td> <!-- Menampilkan SKS -->
              <td class="px-6 py-4">{{ $item->status_verifikasi }}</td> <!-- Menampilkan Status -->
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- KHS Content -->
  <div class="KHS" style="display: none;">
    <div class="bg-white text-teal-900 p-4 rounded-lg">
      <div class="space-y-4">
        <h2 class="text-xl font-bold text-teal-800">Kartu Hasil Studi</h2>
      </div>

      <!-- Tabel -->
      <div class="border rounded-md p-2">
        <div class="table-responsive">
          <table class="table table-striped w-full text-teal-800 font-black flex items-center">
            <tbody>
              <!-- ikon drop -->
              <tr>
                <td class="pb-2 pt-0">
                  <button class="toggle-button btn btn-primary bg-teal-500 text-white w-10 py-2 rounded-lg mr-1">+</button>
                  Semester 1
                </td>
              </tr>

              <tr class="khs-table" id="khs-1" style="display: none;">
                <td colspan="4">
                  <div class="border rounded-md">
                    <div class="table-responsive p-2 table-striped">
                      <table class="table text-teal-800 table-auto w-full text-center rounded-lg border-collapse">
                          <thead>
                              <tr>
                                <th class="font-normal" style="width: 20%;">Mata Kuliah</th>
                                <th class="font-normal" style="width: 20%;">Status</th>
                                <th class="font-normal" style="width: 20%;">SKS</th>
                                <th class="font-normal" style="width: 20%;">Nilai</th>
                                <th class="font-normal" style="width: 20%;">Bobot</th>
                              </tr>
                          </thead>
                          <tbody id="KHSTableBody-1">
                              <tr>
                                  <td>Statistika</td>
                                  <td>Baru</td>
                                  <td>2</td>
                                  <td>A</td>
                                  <td>4</td>
                              </tr>
                          </tbody>
                      </table>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>
  <!-- Pop-up Modal -->
  <div id="popupModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg p-6 w-96 text-center">
      <h2 class="text-lg font-bold mb-4">IRS Berhasil Disetujui</h2>
      <p class="text-gray-700 mb-4">Data IRS mahasiswa telah berhasil disetujui.</p>
      <button id="closePopup" class="bg-amber-400 text-white py-2 px-4 rounded-lg hover:bg-amber-500">Tutup</button>
    </div>
  </div>
</div>


</body>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.a');
    const irsContent = document.querySelector('.IRS');
    const khsContent = document.querySelector('.KHS');

    // Fungsi untuk mengatur tampilan konten
    function toggleContent(filter) {
      if (filter === 'IRS') {
        irsContent.style.display = 'block';
        khsContent.style.display = 'none';
      } else if (filter === 'KHS') {
        irsContent.style.display = 'none';
        khsContent.style.display = 'block';
      }
    }

    buttons.forEach(button => {
      button.addEventListener('click', function() {
        // Menghapus titik dari data-filter
        const filter = this.getAttribute('data-filter').substring(1);
        
        // Mengatur warna background button
        buttons.forEach(btn => {
          btn.classList.remove('bg-amber-400');
          btn.classList.add('bg-teal-700');
        });
        this.classList.remove('bg-teal-700');
        this.classList.add('bg-amber-400');

        // Menampilkan konten yang sesuai
        toggleContent(filter);
      });
    });

    // Set tampilan default (IRS)
    const defaultButton = document.querySelector('.a[data-filter=".IRS"]');
    defaultButton.classList.add('bg-amber-400');
    toggleContent('IRS');
  });

  // Buat tabel dropdown
  document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.toggle-button');

    buttons.forEach((button, index) => {
        button.addEventListener('click', function () {
            // Cari tabel KHS yang terkait dengan tombol berdasarkan urutan tombol
            const khsTable = document.querySelectorAll('.khs-table')[index];

            // Toggle visibility dari tabel
            if (khsTable.style.display === 'none' || khsTable.style.display === '') {
                khsTable.style.display = 'table-row'; // Tampilkan tabel
                this.textContent = '-'; // Ubah tombol menjadi tanda "-"
            } else {
                khsTable.style.display = 'none'; // Sembunyikan tabel
                this.textContent = '+'; // Ubah tombol menjadi tanda "+"
            }
        });
    });
  });

  document.addEventListener('DOMContentLoaded', function () {
    // Simpan elemen awal approvalButtons
    const originalButtonsHTML = document.getElementById('approvalButtons').innerHTML;

    document.getElementById('approvalButton').addEventListener('click', function () {
        // Tampilkan pop-up
        const popupModal = document.getElementById('popupModal');
        popupModal.classList.remove('hidden');

        // Ganti tombol "Tolak" dan "Setujui" dengan "Buka Akses" setelah beberapa detik
        setTimeout(() => {
            const approvalButtons = document.getElementById('approvalButtons');

            // Buat form "Buka Akses"
            const bukaAksesForm = document.createElement('form');
            bukaAksesForm.action = "{{ route('tolakIRS') }}"; // Route ke fungsi tolakIRS
            bukaAksesForm.method = "POST";
            bukaAksesForm.classList.add('w-full');

            // Tambahkan CSRF token
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = "{{ csrf_token() }}";
            bukaAksesForm.appendChild(csrfInput);

            // Tambahkan NIM mahasiswa
            const nimInput = document.createElement('input');
            nimInput.type = 'hidden';
            nimInput.name = 'nim';
            nimInput.value = "{{ $mahasiswa->nim }}"; // Pastikan nim berasal dari data yang valid
            bukaAksesForm.appendChild(nimInput);

            // Buat tombol "Buka Akses"
            const bukaAksesButton = document.createElement('button');
            bukaAksesButton.textContent = 'BUKA AKSES';
            bukaAksesButton.type = 'submit';
            bukaAksesButton.classList.add(
                'bg-teal-600',
                'text-white',
                'p-3',
                'rounded-lg',
                'flex',
                'justify-center',
                'items-center',
                'w-full',
                'font-semibold',
                'italic'
            );
            bukaAksesForm.appendChild(bukaAksesButton);

            // Hapus tombol lama dan tambahkan form baru
            approvalButtons.innerHTML = '';
            approvalButtons.appendChild(bukaAksesForm);

            // Tambahkan event listener ke tombol "Buka Akses"
            bukaAksesButton.addEventListener('click', function () {
                // Kembalikan tampilan awal approvalButtons setelah form di-submit
                setTimeout(() => {
                    approvalButtons.innerHTML = originalButtonsHTML;
                    restoreApprovalListeners(); // Pulihkan event listeners awal
                }, 500);
            });
        }, 2000);
    });

    document.getElementById('closePopup').addEventListener('click', function () {
        // Sembunyikan pop-up
        const popupModal = document.getElementById('popupModal');
        popupModal.classList.add('hidden');
    });

    function restoreApprovalListeners() {
        // Tambahkan kembali event listener untuk tombol "Setujui"
        document.getElementById('approvalButton').addEventListener('click', function () {
            // Logika tombol "Setujui" seperti di awal
            const popupModal = document.getElementById('popupModal');
            popupModal.classList.remove('hidden');
        });
    }
});


</script>

</html>
@endsection