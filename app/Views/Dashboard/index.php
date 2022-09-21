<style type="text/css">
    .modal {
  position: absolute;
  top: 40%;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>
<div class="dashboard-wrapper">
    <?php if(session()->getFlashdata('add')):?>
        <script type="text/javascript">
            toastr.success('Data Telah Ditambahkan');
            // $(document).ready(function(){
            //     swal("Tidak Dapat Menambahkan Data Karena Sudah ada data inputan sebelumnya", {icon: "warning",});     
            // });
        </script>
    <?php endif?>
    <?php if(session()->getFlashdata('edit')):?>
        <script type="text/javascript">
            toastr.success('Data Telah Diupdate');
            // $(document).ready(function(){
            //     swal("Tidak Dapat Menambahkan Data Karena Sudah ada data inputan sebelumnya", {icon: "warning",});     
            // });
        </script>
    <?php endif?>
    <?php if(session()->getFlashdata('delete')):?>
        <script type="text/javascript">
            toastr.success('Data Telah Dihapus');
            // $(document).ready(function(){
            //     swal("Tidak Dapat Menambahkan Data Karena Sudah ada data inputan sebelumnya", {icon: "warning",});     
            // });
        </script>
    <?php endif?>
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <?php
                $session = session();
            ?>
            <!-- ============================================================== -->
            <!-- pageheader  -->
            <!-- ============================================================== -->
            
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="">
                <div class="card">
                    <!-- <h2 class="card-header">Selamat Datang, <?= $session->get('nama')?></h2> -->
                    <h5 class="card-header">Tabel Hadiah</h5>
                    <div class="card-body">
                    <div style="width: 100%; text-align: left; margin-bottom: 10px;">
                        <a href="#" data-toggle="modal" data-target="#modal-default" class="btn btn-primary" style="color: #ffffff">Tambah Data</a>
                    </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered first">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Hadiah</th>
                                        <th>Valuable Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $i = 1;
                                    ?>  
                                    
                                    <?php foreach($hadiah as $v):?>                         
                                        <tr>
                                            <td><?= $i?></td>
                                            <td><?= $v->nama_hadiah?></td>
                                            <td>
                                                <input id="inputEmail2" disabled="" type="checkbox" name="is_valuable" <?php if($v->is_valuable == 1):?>checked="checked"<?php endif?> required="" style="width: 18px; height: 18px;" data-parsley-type="email" placeholder="Nama Hadiah" class="form-control">
                                            </td>
                                            <td>
                                                <a href="#" class="btn-edit" data-id="<?= $v->id;?>" data-nama_hadiah="<?= $v->nama_hadiah;?>" data-valuable="<?= $v->is_valuable;?>"><i class="fas fa-pencil-alt mr-2"></i></a>
                                                <a href="#" class="btn-delete" data-id="<?= $v->id;?>" ><i class="fas fa-trash mr-2"></i></a>
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
            <!-- ============================================================== -->
            <!-- end pageheader  -->
            <!-- ============================================================== -->
            <div class="ecommerce-widget">
            </div>
        </div>
        <div class="modal fade col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12" id="modal-default">
            <div class="card">
                <h5 class="card-header">Tambah Data Hadiah</h5>
                <div class="card-body">
                    <form id="form" data-parsley-validate="" novalidate="" method="post" action="<?= base_url('/store_hadiah')?>">
                        <div class="form-group row">
                            <label for="inputEmail2" class="col-3 col-lg-3 col-form-label text-left">Nama Hadiah</label>
                            <div class="col-9 col-lg-9">
                                <input id="inputEmail2" type="email" name="nama_hadiah" required="" data-parsley-type="email" placeholder="Nama Hadiah" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail2" class="col-3 col-lg-3 col-form-label text-left">Valuable Price</label>
                            <div class="" style="place-content: left; padding-top: 9px; padding-left: 10px;">
                                <input id="inputEmail2" type="checkbox" name="is_valuable" required="" style="width: 18px; height: 18px;" data-parsley-type="email" placeholder="Nama Hadiah" class="form-control">
                            </div>
                        </div>
                        <div class="row pt-2 pt-sm-5 mt-1">
                            <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                                
                            </div>
                            <div class="col-sm-6 pl-0">
                                <p class="text-right">
                                    <button type="submit" class="btn btn-space btn-primary">Submit</button>
                                    <a href="<?= base_url('/dashboard')?>" class="btn btn-space btn-secondary" style="color: #ffffff">Cancel</a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal fade col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12" id="modal-edit">
            <div class="card">
                <h5 class="card-header">Edit Data Hadiah</h5>
                <div class="card-body">
                    <form id="form" data-parsley-validate="" novalidate="" method="post" action="<?= base_url('/update_hadiah')?>">
                        <div class="form-group row">
                            <label for="inputEmail2" class="col-3 col-lg-3 col-form-label text-left">Nama Hadiah</label>
                            <div class="col-9 col-lg-9">
                                <input id="inputEmail2" type="email" name="nama_hadiah" required="" data-parsley-type="email" placeholder="Nama Hadiah" class="form-control nama_hadiah">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail2" class="col-3 col-lg-3 col-form-label text-left">Valuable Price</label>
                            <div id="cb_value" class="" style="place-content: left; padding-top: 9px; padding-left: 10px;">
                                <input id="inputEmail2" type="checkbox" name="is_valuable" required="" style="width: 18px; height: 18px;" data-parsley-type="email" placeholder="Nama Hadiah" class="form-control">
                            </div>
                        </div>
                        <input type="hidden" name="id" class="id_hadiah">
                        <div class="row pt-2 pt-sm-5 mt-1">
                            <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                                
                            </div>
                            <div class="col-sm-6 pl-0">
                                <p class="text-right">
                                    <button type="submit" class="btn btn-space btn-primary">Submit</button>
                                    <a href="<?= base_url('/dashboard')?>" class="btn btn-space btn-secondary" style="color: #ffffff">Cancel</a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal fade col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12" id="modal-del">
            <div class="card">
                <h5 class="card-header">Delete Data Hadiah</h5>
                <div class="card-body">
                    <form id="form" data-parsley-validate="" novalidate="" method="post" action="<?= base_url('/delete_hadiah')?>">
                        <h3>Apakah Anda Ingin Menghapus Data Ini?</h3>
                        <input type="hidden" name="id" class="id_hadiah">
                        <div class="row pt-2 pt-sm-5 mt-1">
                            <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                                
                            </div>
                            <div class="col-sm-6 pl-0">
                                <p class="text-right">
                                    <button type="submit" class="btn btn-space btn-primary">Ya</button>
                                    <a href="<?= base_url('/dashboard')?>" class="btn btn-space btn-secondary" style="color: #ffffff">Tidak</a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.btn-edit').on('click',function(){
            var html = '';
            const name = $(this).data('nama_hadiah');
            const valuable = $(this).data('valuable');
            const id = $(this).data('id');
            $('.id_hadiah').val(id);
            $('.nama_hadiah').val(name);
            // alert ("This is an alert dialog box");  
            if(valuable == 1){
                html += '<input id="inputEmail2" type="checkbox" name="is_valuable" checked="checked" required="" style="width: 18px; height: 18px;" data-parsley-type="email" placeholder="Nama Hadiah" class="form-control">';
            } else {
                html += '<input id="inputEmail2" type="checkbox" name="is_valuable" required="" style="width: 18px; height: 18px;" data-parsley-type="email" placeholder="Nama Hadiah" class="form-control">';
            }
            $('#cb_value').html(html);
            $('#modal-edit').modal('show');
        });

        $('.btn-delete').on('click',function(){
            const id = $(this).data('id');
            $('.id_hadiah').val(id);
            // alert ("This is an alert dialog box");  
            $('#modal-del').modal('show');
        });
    });
</script>