<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cetak PDF Laporan Ebook</title>
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
        <p>PEMERINTAH KABUPATEN KOTABARU
            <br>
            DINAS PENDIDIKAN DAN KEBUDAYAAN
            <br>
            SMPN 2 KOTABARU
            <br>
            NSS/NIS/NPSN : 201150901002/200020/30303290
            <br>
            Jl.Perikanan Telp.(0518)21714 KP.72116 Kab.Kotabaru
            <br>
            Email : smpn2_ktb@yahoo.co.id Website : www.smpn2kotabaru.co.id
        </p>
    </div>
    <hr style="border: 0.5px solid black; margin: 10px 5px 10px 5px;">
    <br>
    <table class="table table-bordered" style="width:100%;">
        <thead>
            <tr>

                <th>No</th>
                <th>Id Ebook</th>
                <th>Ebook Id</th>
                <th>Id Kategori Ebook</th>
                <th>Kategori Ebook</th>
                <th>Judul</th>
                <th>Penerbit</th>
                <th>Pengarang</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;

            foreach ($ebook as $isi) {
            ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $isi['id_ebook'] ?></td>
                    <td><?php echo $isi['ebook_id'] ?></td>
                    <td><?php echo $isi['id_kategori_ebook'] ?></td>
                    <td><?php echo $isi['nama_kategori_ebook'] ?></td>
                    <td><?php echo $isi['judul_ebook'] ?></td>
                    <td><?php echo $isi['penerbit_ebook'] ?></td>
                    <td><?php echo $isi['pengarang_ebook'] ?></td>
                </tr>
            <?php $no++;
            } ?>
        </tbody>
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
        <div style="font-size: 18px">Laporan Data Ebook
        </div>
    </div>
</body>

</html>