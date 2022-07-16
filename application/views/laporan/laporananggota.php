<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cetak PDF Laporan Anggota</title>
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
        <p>NSS/NIS/NPSN : 201150901002/200020/30303290
            <br>
            Jl.Perikanan Telp.(0518)21714 KP.72116 Kab.Kotabaru
            <br>
            Email : smpn2_ktb@yahoo.co.id Website : www.smpn2kotabaru.co.id
        </p>
    </div>
    <hr style="border: 0.5px solid black; margin: 10px 5px 10px 5px;">
    <?php
    // Koneksi
    $koneksi = mysqli_connect('localhost', 'root', '', 'projek_perpus');
    // Koneksi

    if (!empty($_GET['tahun'])) {

        $tahun = $_GET['tahun'];
        $query = "SELECT * FROM tbl_login WHERE year(tgl_bergabung)='$tahun'";
        $stmt = mysqli_query($koneksi, $query);
        $rows = mysqli_fetch_all($stmt, MYSQLI_ASSOC);
    } else {
        $query = "SELECT * FROM tbl_login";
        $stmt = mysqli_query($koneksi, $query);
        $rows = mysqli_fetch_all($stmt, MYSQLI_ASSOC);
    }
    ?>
    <br>
    <table class="table table-bordered" style="width:100%;">
        <thead>
            <tr>

                <th>No</th>
                <th>Anggota Id</th>
                <th>Nama Anggota</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Email</th>
                <th>tanggal bergabung</th>
                <th>Total Bergabung</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            $jumlahtotal = 0;
            usort($login, function ($item1, $item2) {
                return $item2['jumlah'] <=> $item1['jumlah'];
            });


            foreach ($login as $row) {
            ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $row['anggota_id'] ?></td>
                    <td><?php echo $row['nama'] ?></td>
                    <td><?php echo $row['tempat_lahir'] ?></td>
                    <td><?php echo date("d-m-Y", strtotime($row['tgl_lahir'])) ?></td>
                    <td><?php echo $row['jenkel'] ?></td>
                    <td><?php echo $row['alamat'] ?></td>
                    <td><?php echo $row['telepon'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo date("d-m-Y", strtotime($row['tgl_bergabung'])) ?></td>
                    <th><?php echo $row['jumlah'] ?></th>
                </tr>
            <?php $no++;

                $jumlahtotal += $row['jumlah'];
            } ?>
        </tbody>
        <thead>
            <tr>
                <th colspan="10">Total Bergabung</th>
                <td><?php echo $jumlahtotal; ?></td>
            </tr>
        </thead>
    </table>
    <br>
    <br>
    <br>
    <br>
    <div style="text-align:right">
        <div style="font-size: 12px">Kotabaru, <?php echo date("d-m-y") ?>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div style="font-size: 12px">Jamilah Rosnina S.Si</div>
        </div>
    </div>
    <hr style="border: 0.5px solid black; margin: 10px 5px 10px 5px;">
    <div style="margin-left: 20px">
        <div style="font-size: 18px">Laporan Data Anggota
        </div>
    </div>
</body>

</html>