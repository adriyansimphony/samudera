<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A3</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
    <style>@page { size: A3 Landscape }

        .kopsurat{
            font-size: 18px;
            font-weight: bold;
        }
        .tabeldatakaryawan{
            margin-top: 10px;

        }
        
        .tabeldatakaryawan td{
            padding: 5px;
        }

        .tabelpresensi{
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            font-size: 10px;
        }

        .tabelpresensi tr th {
            border: 1px solid black;
            padding: 8px;
            background-color: antiquewhite
        }
        .tabelpresensi tr td {
            text-align: center;
            border: 1px solid black;
            padding: 5px;
        }

        .foto{
            width: 40px;
            height: 40px;
        }
    </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A3 landscape">

    <?php
        function selisih($jam_masuk, $jam_keluar)
        {
            list($h, $m, $s) = explode(":", $jam_masuk);
            $dtAwal = mktime($h, $m, $s, "1", "1", "1");
            list($h, $m, $s) = explode(":", $jam_keluar);
            $dtAkhir = mktime($h, $m, $s, "1", "1", "1");
            $dtSelisih = $dtAkhir - $dtAwal;
            $totalmenit = $dtSelisih / 60;
            $jam = explode(".", $totalmenit / 60);
            $sisamenit = ($totalmenit / 60) - $jam[0];
            $sisamenit2 = $sisamenit * 60;
            $jml_jam = $jam[0];
            return $jml_jam . ":" . round($sisamenit2);
        }
    ?>
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

    <table style="width:100%">
        <tr>
            <td style="width: 45px">
                <img src="{{ asset('assets/img/logocetak.png') }}" alt="">
            </td>
            <td>
                <span class="kopsurat">
                    REKAP PRESENSI KARYAWAN <br>
                    PERIODE {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }}<br>
                    CV. SAMUDERA CIPTA SOLUSI <br>
                </span>
                <span><i>Jalan Cempaka Raya No.1, Nusa Jaya, Kec. Karawaci, Kota Tangerang, Banten 15116</i></span>
            </td>
        </tr>
    </table>

    <table class="tabelpresensi">
        <tr>
            <th rowspan="2">NIK</th>
            <th rowspan="2">Nama Karyawan</th>
            <th colspan="31">Tanggal</th>
            <th rowspan="2">TH</th>
            <th rowspan="2">TT</th>
        </tr>
        <tr>
            <?php
            for($i=1; $i<=31; $i++){
                ?>
                <th>{{ $i }}</th>
                <?php
            }
            ?>
        </tr>
        
        @foreach ($rekap as $d)
        <tr>
            <td>{{ $d->nik }}</td>
            <td>{{ $d->nama_lengkap }}</td>
            {{-- <td>{{ $d->tgl_1 }}</td> --}}
            <?php
            $totalhadir = 0;
            $totalterlambat = 0;
            for($i=1; $i<=31; $i++){
                $tgl = "tgl_".$i;
                
                if (empty($d->$tgl)) {
                    $hadir = ['',''];
                    $totalhadir += 0;
                }else{
                    $hadir = explode("-",$d->$tgl);
                    $totalhadir += 1;
                    if ($hadir[0] > "08:15:00") {
                        $totalterlambat += 1;
                    }
                }
                
                ?>
                <td>
                    <span style="color: {{ $hadir[0] > "08:15:00" ? "red" : "" }}">{{ $hadir[0] }}</span> <br>
                    <span style="color: {{ $hadir[1] < "17:00:00" ? "red" : "" }}">{{ $hadir[1] }}</span>
                </td>
                <?php
                }
                ?>
                <td>{{ $totalhadir }}</td>
                <td>{{ $totalterlambat }}</td>
            </tr>
            
            @endforeach

    </table>
    

    <table width="100%" style="margin-top: 100px">
        <tr>
            <td></td>
            <td style="text-align:center">Tangerang, {{ date('d-m-Y') }}</td>
        </tr>
        <tr>
            <td style="text-align: center; vertical-align: bottom" height="100px">
                <u>Syukran Fadhilah</u><br>
                <i><b>CEO</b></i>
            </td>
            <td style="text-align: center; vertical-align: bottom">
                <u>Adea Sapta</u><br>
                <i><b>Direktur</b></i>
            </td>
        </tr>

    </table>
  </section>

</body>

</html>