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
            toastr.success('Link Telah Di Generate');
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
                    <h5 class="card-header">Tabel Link</h5>
                    <div class="card-body">
                    <div style="width: 100%; text-align: left; margin-bottom: 10px;">
                        <a href="#" data-toggle="modal" data-target="#modal-default">
                            <button type="button" class="btn btn-primary" style="background-color: green">
                                <i class="fas fa-link" style="margin-right: 10px;"></i>
                                Generate Link
                            </button>
                        </a>
                    </div>
                        <h3 style="color: red;">Proses Copy Link Hanya Bisa Dilakukan Satu Kali !</h3>
                        <div class="table-responsive">
                            <table id="table-link" class="table table-striped table-bordered first">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>URL Link</th>
                                        <th>Nama Buyer</th>
                                        <th>Alamat Buyer</th>
                                        <th>No HP Buyer</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $i = 1;
                                    ?>
                                    
                                    <?php foreach($link as $v):?>                         
                                        <tr>
                                            <td><?= $i?></td>   
                                            <td style="padding-left: 30px;"> 
                                                <div class ="row">
                                                    <input type="text" style="width:30%; margin-right:15px;" disabled name="nama_kategori" value="<?= $v->url?>" class="form-control" placeholder="Nama Event">
                                                    <?php if($v->is_copy == 0):?>
                                                    <input type="hidden" id="url_" name="" value="<?= $v->url?>">
                                                    <button data-url="<?= $v->url?>" onclick="myFunction(this)" class="btn btn-primary btn-icon-text">Copy text</button>
                                                    <?php endif?>
                                                </div>
                                            </td>        
                                            <td><?= $v->nama_buyer?></td> 
                                            <td><?= $v->alamat_buyer?></td> 
                                            <td><?= $v->hp_buyer?></td>                            
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
        <div class="modal fade col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12" id="modal-default">
            <div class="card">
                <h5 class="card-header">Generate Link Buyer</h5>
                <div class="card-body">
                    <form id="form" data-parsley-validate="" novalidate="" method="post" action="<?= base_url('/generate')?>">
                        <div class="form-group row">
                            <label for="inputEmail2" class="col-3 col-lg-3 col-form-label text-left">Nama Buyer</label>
                            <div class="col-9 col-lg-9">
                                <input id="inputEmail2" type="email" name="nama_buyer" required="" data-parsley-type="email" placeholder="Nama Buyer" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail2" class="col-3 col-lg-3 col-form-label text-left">Alamat Buyer</label>
                            <div class="col-9 col-lg-9">
                                <input id="inputEmail2" type="email" name="alamat_buyer" required="" data-parsley-type="email" placeholder="Alamat Buyer" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail2" class="col-3 col-lg-3 col-form-label text-left">Nomor HP Buyer</label>
                            <div class="col-9 col-lg-9">
                                <input id="inputEmail2" type="email" name="hp_buyer" required="" data-parsley-type="email" placeholder="No HP Buyer" class="form-control">
                            </div>
                        </div>
                        <div class="row pt-2 pt-sm-5 mt-1">
                            <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                                
                            </div>
                            <div class="col-sm-6 pl-0">
                                <p class="text-right">
                                    <button type="submit" class="btn btn-space btn-primary">Submit</button>
                                    <a href="<?= base_url('/link')?>" class="btn btn-space btn-secondary" style="color: #ffffff">Cancel</a>
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
    function myFunction(btn) {
      /* Get the text field */
        var copyText = $(btn).attr('data-url');
        navigator.clipboard.writeText(copyText).then(() => {
            alert('Text copied to clipboard');
        }).catch(err => {
            alert('Error in copying text: ', err);
        });
        var id = $('#url_').val();
        var urls= "<?php echo base_url('/link');?>";

        // $.ajax({
        //     url:"<?php echo base_url('/update_is_copy');?>",
        //     method:"POST",
        //     data:{id:id},
        //     dataType:"JSON",
        //     success:function(data)
        //     {

        //     }
        // });
        // window.location = urls;
    //   /* Select the text field */
    //   copyText.select();
    //   copyText.setSelectionRange(0, 99999); /* For mobile devices */
    
    //   /* Copy the text inside the text field */
    //   navigator.clipboard.writeText(copyText.value);
    
      /* Alert the copied text */
    //   alert("Copied the text: " + copyText);
    }
    $(document).ready(function(){
        $('.btn-edit').on('click',function(){

            const name = $(this).data('nama_hadiah');
            const id = $(this).data('id');
            $('.id_hadiah').val(id);
            $('.nama_hadiah').val(name);
            // alert ("This is an alert dialog box");  
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