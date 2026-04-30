<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Agenda Sekolah</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 14px; margin: 0; padding: 20px; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 24px; text-transform: uppercase; }
        .header p { margin: 5px 0 0; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; }
        .footer { text-align: right; margin-top: 40px; }
        @media print {
            .no-print { display: none; }
            body { padding: 0; }
        }
        .btn-print { padding: 10px 20px; background: #000; color: #fff; border: none; cursor: pointer; border-radius: 5px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="no-print" style="margin-bottom: 20px; text-align: right;">
        <button onclick="window.print()" class="btn-print">Cetak Dokumen (Ctrl+P)</button>
        <button onclick="window.history.back()" class="btn-print" style="background: #666; margin-left: 10px;">Kembali</button>
    </div>

    <div class="header">
        <h1>Sistem Informasi Agenda Sekolah</h1>
        <p>Laporan Kegiatan dan Agenda Resmi</p>
        <p>SMK Negeri 1 Cimahi</p>
    </div>

    <p>Tanggal Cetak: {{ now()->translatedFormat('l, d F Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 25%">Nama Agenda</th>
                <th style="width: 15%">Kategori</th>
                <th style="width: 20%">Waktu Pelaksanaan</th>
                <th style="width: 20%">Lokasi</th>
                <th style="width: 15%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($agendas as $index => $agenda)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><strong>{{ $agenda->title }}</strong></td>
                <td>{{ $agenda->category->name ?? 'Tanpa Kategori' }}</td>
                <td>
                    {{ \Carbon\Carbon::parse($agenda->start_date)->translatedFormat('d M Y, H:i') }}
                    <br><small>s/d</small><br>
                    {{ \Carbon\Carbon::parse($agenda->end_date)->translatedFormat('d M Y, H:i') }}
                </td>
                <td>{{ $agenda->location }}</td>
                <td>{{ ucfirst($agenda->status) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center;">Tidak ada data agenda yang ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Cimahi, {{ now()->translatedFormat('d F Y') }}</p>
        <br><br><br>
        <p><strong>Administrator</strong></p>
    </div>
</body>
</html>
