<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <?php
                        $session = session();
                    ?>
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Welcome, <?= $session->get('nama');?></h3>
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
                        <div class="col-sm-12" style="text-align:right;">
                            <a href="<?= base_url('/slider/add')?>">
                            <button type="button" class="btn btn-primary btn-icon-text col-sm-2">
                                <i class="ti-file btn-icon-prepend"></i>
                                Tambah Data
                            </button>
                            </a>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Table Data Slider</h4>
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Judul</th>
                                        <th>Data Gambar</th>
                                        <th>Link Gambar</th>
                                        <th>Tanggal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <?php 
                                        $i = 1;
                                    ?>  
                                    
                                    <?php foreach($slider as $v):?>                         
                                        <tr>
                                            <td><?= $i?></td>
                                            <td><?= $v['judul']?></td>
                                            <td></td>
                                            <td></td>
                                            <td><?= date("d M Y", strtotime($v['tanggal']))?></td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-rounded btn-icon">
                                                    <i class="ti-pencil-alt"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-rounded btn-icon">
                                                    <i class="ti-trash"></i>
                                                </button>
                                            </td>
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