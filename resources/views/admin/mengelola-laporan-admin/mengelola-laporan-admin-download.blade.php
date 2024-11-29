<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Kasus Bullying</title>

    <link href="{{ public_path('css/laporan.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
  <div class="header">
      <img src="{{ public_path('image/image-home/logo1.png') }}" class="left-logo" alt="left-logo">
      <img src="{{ public_path('image/image-home/logo2.png') }}" class="right-logo" alt="right-logo">
      <h3>PEMERINTAH PROVINSI SUMATERA BARAT</h3>
      <h3>DINAS PENDIDIKAN</h3>
      <h3>SMA NEGERI 1 BUKITTINGGI</h3>
      <p><i>Jln. Syekh M. Jamil Jambek No. 36 Bukittinggi Telp. (0752) 22549 Fax 626202</i></p>
      <p><i> www.sman1bukittinggi.sch.id e-mail: smansa_landbouw@yahoo.co.id</i></p>
      <hr>
  </div>
  <div class="content">
    <p class="text-center"><b> Laporan Kasus Bullying <u>{{ $jenis_kasus ?? '' }}</u></b></p>
    <p class="text-center">
      <b>SMAN 1 Bukittinggi pada
        @php
            use Carbon\Carbon;
        @endphp
        {{ $tanggal_mulai ? Carbon::parse($tanggal_mulai)->translatedFormat('d F Y') : '' }} 
        sampai 
        {{ $tanggal_selesai ? Carbon::parse($tanggal_selesai)->translatedFormat('d F Y') : '' }}
      </b>
    </p>
    <table>
      <thead>
          <tr class="text-center">
            <th>No</th>
            <th>Nama Pelapor</th>
            <th>No Hp</th>
            <th>Tanggal Kejadian</th>
            <th>Tempat Kejadian</th>
            <th>Deskripsi Kejadian</th>
            <th>Bukti</th>
            <th>Nama Korban</th>
            <th>Nama Pelaku</th>
            <th>Nama Saksi</th>
            <th>Jenis Kasus</th>
            <th>Tindak Kasus</th>
            <th>Status Kasus</th>
        </tr>
      </thead>
      <tbody>
        @forelse($kasuses as $no => $kasus)
          <tr>
            <td class="nomor">{{ $no + 1 }} </td>
            <td>{{ $kasus->nama_pelapor }} dari akun {{ $kasus->name }}</td>
            <td>{{ $kasus->no_hp }}</td>
            <td>{{ \Carbon\Carbon::parse($kasus->tanggal_kejadian)->translatedFormat('d F Y') }}</td>
            <td>{{ $kasus->tempat_kejadian }}</td>
            <td>{{ $kasus->deskripsi_kejadian }}</td>
            <td>
              @php
                  $buktiPaths = json_decode($kasus->bukti);
              @endphp

              @if($buktiPaths)
                  @foreach($buktiPaths as $bukti)
                      <img src="{{ public_path($bukti) }}" alt="Bukti" style="width: 100px; height: auto; border: 2px solid #26355D; margin: 3px">
                  @endforeach
              @else
                  Tidak ada bukti
              @endif
            </td>
            <td>{{ $kasus->nama_korban }}</td>
            <td>{{ $kasus->nama_pelaku }}</td>
            <td>{{ $kasus->nama_saksi }}</td>
            <td>{{ $kasus->jenis_kasus }}</td>
            <td>{{ $kasus->tindak_lanjut }}</td>
            <td>{{ $kasus->status_kasus }}</td>
          </tr>
          @empty
          <tr class="text-center">
            <td colspan="13" class="alert alert-danger">Tidak ada pelaporan.</td>
          </tr>
          @endforelse
      </tbody>
    </table>
  </div>
  <div class="footer">
    <div class="ttd-kiri">
      <p class="left">Mengetahui</p>
      <p class="left">Kepala SMAN 1 Bukittinggi</p>
      <br></br>
      <br></br>
      <p class="left"><u>Dra. Silfa Dusun, M.Pd</u></p>
      <p class="left">NIP. 196511111989032001</p>
    </div>
    <div class="ttd-tengah">
      <p class="left1">Mengetahui</p>
      <p class="left1">Koordinator</p>
      <br></br>
      <br></br>
      <p class="left1"><u>Al Razafirman, S.PdI, Gr.Kons</u></p>
      <p class="left1">NIP. 198902282022211005</p>
    </div>
    <div class="ttd-kanan">
      <p class="left2">Bukittinggi,............................</p>
      <br></br>
      <br></br>
      <br></br>
      <p class="left2">________________________</p>
      <p class="left2">NIP. </p>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>