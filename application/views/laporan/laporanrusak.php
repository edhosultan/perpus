<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cetak PDF Laporan Rusak</title>
    <style>
        h3 {
            font-size: 20px;
            font-family: 'Times New Roman', Times, serif;
            color: #000000;
            text-align: center;
            line-height: 0.4;
        }

        h4 {
            font-size: 20px;
            font-family: 'Times New Roman', Times, serif;
            color: #000000;
            text-align: center;
        }

        table,
        th,
        td {
            font-family: Arial, Helvetica, sans-serif;
            color: #666;
            text-shadow: 1px 1px 0px #fff;
            font-size: 12px;
            border: #ccc 1px solid;
            border-collapse: collapse;
            padding: 7px;
            text-align: center;
        }

        table th {
            background: #ededed;
        }

        table td {
            background: #fafafa;
            background: -webkit-gradient(linear, left top, left bottom, from(#fbfbfb), to(#fafafa));
            background: -moz-linear-gradient(top, #fbfbfb, #fafafa);
        }

        table tr:hover td {
            background: #f2f2f2;
            background: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#f0f0f0));
            background: -moz-linear-gradient(top, #f2f2f2, #f0f0f0);
        }
    </style>
</head>

<body>
    <img src="assets_style/image/logonih.jpg" style="float: left;height: 80px">
    <div style="font-size: 15px;text-align:center">
        <h2>PEMERINTAH KABUPATEN KOTABARU
            <br>
            DINAS PENDIDIKAN DAN KEBUDAYAAN
            <br>
            SMPN 2 KOTABARU
            <br>
        </h2>
        <p>
            NSS/NIS/NPSN : 201150901002/200020/30303290
            <br>
            Jl.Perikanan Telp.(0518)21714 KP.72116 Kab.Kotabaru
            <br>
            Email : smpn2_ktb@yahoo.co.id Website : www.smpn2kotabaru.co.id
        </p>
    </div>
    <hr style="border: 0.5px solid black; margin: 10px 5px 10px 5px;height:8px;">
    <?php
    // Koneksi
    $koneksi = mysqli_connect('localhost', 'root', '', 'projek_perpus');
    // Koneksi

    if (!empty($_GET['tahun'])) {

        $tahun = $_GET['tahun'];
        $query = "SELECT * FROM tbl_buku_rusak WHERE year(tgl_masuk)='$tahun'";
        $stmt = mysqli_query($koneksi, $query);
        $rows = mysqli_fetch_all($stmt, MYSQLI_ASSOC);
    } else {
        $query = "SELECT * FROM tbl_buku_rusak";
        $stmt = mysqli_query($koneksi, $query);
        $rows = mysqli_fetch_all($stmt, MYSQLI_ASSOC);
    }
    ?>
    <br>
    <div style="font-size: 18px;text-align:center;"><u>Laporan Data Buku Rusak</u>
        <br>
        <br>
    </div>
    <table class="table table-bordered" style="width:100%;">
        <thead>
            <tr>

                <th>No</th>
                <th>Buku Rusak Id</th>
                <th>Kategori</th>
                <th>Rak</th>
                <th>ISBN</th>
                <th>Judul</th>
                <th>Penerbit</th>
                <th>Pengarang</th>
                <th>Tahun Buku</th>
                <th>Tanggal Masuk</th>
                <th>Jumlah Rusak</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;

            $jumlahtotal = 0;
            usort($rusak, function ($item1, $item2) {
                return $item2['jumlah'] <=> $item1['jumlah'];
            });
            foreach ($rusak as $isi) {
            ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $isi['buku_rusak_id'] ?></td>
                    <td><?php echo $isi['nama_kategori'] ?></td>
                    <td><?php echo $isi['nama_rak'] ?></td>
                    <td><?php echo $isi['isbn'] ?></td>
                    <td><?php echo $isi['title'] ?></td>
                    <td><?php echo $isi['penerbit'] ?></td>
                    <td><?php echo $isi['pengarang'] ?></td>
                    <td><?php echo date("d-m-Y", strtotime($isi['thn_buku'])) ?></td>
                    <td><?php echo date("d-m-Y", strtotime($isi['tgl_masuk'])) ?></td>
                    <td><?php echo $isi['jml_rusak'] ?></td>
                </tr>
            <?php $no++;

                $jumlahtotal += $isi['jumlah'];
            } ?>

            <tr>
                <th colspan="10">Jumlah Total</th>
                <td><?php echo $jumlahtotal; ?></td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <br>
    <br>
    <div style="margin-left: 500px">
        <div style="font-size: 12px;">Kotabaru, <?php echo date("d-m-y") ?>
            <div style="font-Size: 12px">Kepala Perpustakaan</div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div style="font-size: 12px">Jamilah Rosnina S.Si</div>
            <div style="font-size: 12px">NIP. 19840825 200903 2011</div>
        </div>
    </div>
    <hr style="border: 0.5px solid black; margin: 10px 5px 10px 5px;height:8px;">
    <div style="margin-left: 20px">
        <div style="font-size: 18px">Laporan Data Buku Rusak
        </div>
    </div>
</body>

</html>