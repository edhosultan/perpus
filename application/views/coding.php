<div class="row">

    <div class="col-xl-6 col-md-6 mb-4" id="top3">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-danger">
                <h6 class="m-0 font-weight-bold border-0 text-white">Buku yang sering dipinjam</h6>
            </div>
            <div class="card-body">
                <div class="row">

                    <?php foreach ($top3buku as $tp) : ?>

                        <div class="col-lg-2 mb-2">
                            <img src="<?= base_url() ?>assets_style/image/buku/<?= $tp->sampul ?>" alt="" width="100%" style="border-radius: 5px;">
                        </div>
                        <div class="col-lg-10">
                            <h5 class="h5 mb-0 text-gray-800"><b><?= $tp->title ?></b></h5>
                            <h6 class="h6 mb-0 text-gray-800"><?= $tp->penerbit ?></h6>
                        </div>

                        <div class="col-lg-12">
                            <!-- Divider -->
                            <hr class="sidebar-divider">
                        </div>

                    <?php endforeach; ?>

                </div>



            </div>
        </div>
    </div>


    <div class="col-xl-6 col-md-6 mb-4" id="top3anggota">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-success">
                <h6 class="m-0 font-weight-bold border-0 text-white">Anggota yang sering pinjam buku</h6>
            </div>
            <div class="card-body">
                <div class="row">

                    <?php foreach ($top3anggota as $ta) : ?>

                        <div class="col-lg-2 mb-2">
                            <img src="<?= base_url() ?>assets_style/iamge/<?= $ta->foto ?>" alt="" width="100%" style="border-radius: 5px;">
                        </div>
                        <div class="col-lg-10">
                            <h5 class="h5 mb-0 text-gray-800"><b><?= $ta->nama_lengkap ?></b></h5>
                            <h6 class="h6 mb-0 text-gray-800"><?= $ta->total ?> x</h6>
                        </div>

                        <div class="col-lg-12">
                            <!-- Divider -->
                            <hr class="sidebar-divider">
                        </div>

                    <?php endforeach; ?>

                </div>



            </div>
        </div>
    </div>

</div>