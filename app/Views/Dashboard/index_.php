<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <?php
                        $session = session();
                    ?>
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Absesnsi Pegawai</h3>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="mdi mdi-calendar"></i> Today (<?= date("d M Y");?>)
                                </button>                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 grid-margin stretch-card" style="margin-top: 20px;">
                    <div class="card" style="padding-top:15px;">
                        <!-- <div class="col-sm-12" style="text-align:right;">
                            <a href="<?= base_url('/artikel/add')?>">
                            <button type="button" class="btn btn-primary btn-icon-text col-sm-2">
                                <i class="ti-file btn-icon-prepend"></i>
                                Tambah Data
                            </button>
                            </a>
                        </div>
                        <div class="col-sm-12" style="text-align:right;">
                            <a href="<?= base_url('/artikel/add')?>">
                            <button type="button" class="btn btn-primary btn-icon-text col-sm-2">
                                <i class="ti-file btn-icon-prepend"></i>
                                Tambah Data
                            </button>
                            </a>
                        </div> -->
                        <div class="card-body">
                            <div class="" style="width: 100%;">
                                <span>Selamat datang, <b><?= $session->get('nama')?></b></span>
                            </div>
                            <div class="" style="width: 200px; background-color: #FFB30D; padding: 15px; border-radius: 10px;">
                                <div class="">
                                    <?php 
                                        $session = session();
                                        if($absen && !is_null($absen[0]->jam_masuk)){
                                            $ket = 'Hadir';
                                        } else if ($absen && is_null($absen[0]->jam_masuk) && $absen[0]->kode_range <> '00'){
                                            $ket = 'Belum Hadir';
                                        } else if ($absen && is_null($absen[0]->jam_masuk) && $absen[0]->kode_range == '00'){
                                            $ket = 'Libur';
                                        } else {
                                            $ket = 'Belum Hadir';
                                        }
                                    ?>
                                    <h3><?= $ket?></h3>
                                    <p>Tanggal : <?= date("d-m-Y")?></p>
                                    <?php if($ket == 'Hadir'):?>
                                        <p>Jam Masuk : <?= date("H:i", strtotime($absen[0]->jam_masuk))?></p>
                                        <p>Jam Keluar: <?= date("H:i", strtotime($absen[0]->jam_keluar))?></p>
                                    <?php else :?>
                                        <p> </p>
                                        <p> </p>
                                    <?php endif?>
                                </div>
                            <div class="icon">
                                <i class="fas fa-calendar-alt"></i>
                                <!-- <i class="ion ion-bag"></i> -->
                            </div>
                            <?php if($absen && !is_null($absen[0]->jam_masuk)):?>
                                <a href="<?= base_url('/update_absen')?>">
                                    <button type="button" class="btn btn-primary btn-icon-text" style="background-color: #BD2A2E">
                                        <i class="ti-file btn-icon-prepend"></i>
                                        Akhiri Kerja
                                    </button>
                                </a>
                            <?php else:?>
                                <a href="<?= base_url('/store_absen')?>">
                                    <button type="button" class="btn btn-primary btn-icon-text" style="background-color: green">
                                        <i class="ti-file btn-icon-prepend"></i>
                                        Mulai Kerja
                                    </button>
                                </a>
                            <?php endif?>                             
                        </div>
                            <div style="width: 100%; margin-top: 50px; overflow: scroll;">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Nama</th>
                                            <th>Jam Masuk</th>
                                            <th>Jam Pulang</th>
                                        </tr>
                                    </thead>
                                    <tbody>      
                                        <?php 
                                            $i = 1;
                                        ?>  
                                        
                                        <?php foreach($absenhist as $v):?>                         
                                            <tr>
                                                <td><?= $i?></td>
                                                <td><?= $v->tgl_masuk?></td>
                                                <td><?= $session->get('nama')?></td>
                                                <td><?= date("H:i", strtotime($v->jam_masuk))?></td>
                                                <td><?= date("H:i", strtotime($v->jam_keluar))?></td>
                                            </tr>
                                            <?php
                                                $i = $i + 1;
                                            ?>
                                        <?php endforeach?>            
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>