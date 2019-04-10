<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>w11-12</title>
    <?php echo $cssjs; ?>
</head>
<body>
    <?php echo $header; ?>

    <!-- CONTENTS -->
    <div class="container">
        <!-- button -->
        <div class="row mb-3">
            <div class="col-12">
                <button id="btn_create" class="btn btn-primary float-right"><i class="fas fa-plus-circle"></i>&nbsp;&nbsp;Student</button>
            </div>
        </div>
        <!-- table -->
        <table id="tb" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th> 
                    <th>ID</th>
                    <th>NIM</th>
                    <th>First Name</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- UNIVERSAL MODAL -->
    <div id="mdl" class="modal fade">
        <div class="modal-dialog">
            <div id="mdl_pv" class="modal-content">
                <!-- MODAL CONTENT -->
            </div>
        </div>
    </div>

    <script>
        //init
        var mdl = $("#mdl"),
            mdl_pv = $("#mdl_pv"),
            tb = $("#tb").DataTable({
                ajax:{
                    type: "post",
                    url: "<?php echo base_url("/Home/GetAllData"); ?>",
                    dataSrc: ""
                },
                columns:[
                    {data: null},
                    {data: "id"},
                    {data: "nim"},
                    {data: "fname"},
                    {data: null}
                ],
                columnDefs:[
                    {
                        targets: 1,
                        visible: false,
                        searchable: false
                    },
                    {
                        targets: 4,
                        defaultContent: "<button class='btn btn-primary btndetail'><i class='fas fa-info'></i></button>  " + 
                            "<button class='btn btn-warning text-white btnedit'><i class='fas fa-edit'></i></button>  " + 
                            "<button class='btn btn-danger btndelete'><i class='fas fa-times'></i></button>",
                        width: 120
                    }
                ],
                processing: true
            });

        mdl.on("hidden.bs.modal", function(){
            mdl_pv.html("");
        })

        //ROW INDEX DI DALEM TABEL
        tb.on('order.dt search.dt', function () {
            tb.column(0, {search:'applied', order:'applied'}).nodes().each( function(cell, i){
                cell.innerHTML = i+1;
            });
        }).draw();

        //create button handler
        $("#btn_create").on("click", function(){
            $.ajax({
                type: "get",
                url: "<?php echo base_url("/Home/CreateGet"); ?>",
                beforeSend: function(){l_swal();},
                success: function(r){
                    Swal.close();
                    mdl_pv.html(r);
                    mdl.modal("show");
                }
            })
        })

        //edit button handler
        $("#tb tbody").on("click", "td .btnedit", function (){
            let data = tb.row( $(this).parents("tr") ).data();
            $.ajax({
                type: "get",
                url: "<?php echo base_url("/Home/EditGet"); ?>",
                data: {id: data.id},
                beforeSend: function(){l_swal();},
                success: function(r){
                    Swal.close();
                    mdl_pv.html(r);
                    mdl.modal("show");
                }
            })
        })

        //detail button handler
        $("#tb tbody").on("click", "td .btndetail", function (){
            let data = tb.row( $(this).parents("tr") ).data();
            $.ajax({
                type: "get",
                url: "<?php echo base_url("/Home/DetailGet"); ?>",
                data: {id: data.id},
                beforeSend: function(){l_swal();},
                success: function(r){
                    Swal.close();
                    mdl_pv.html(r);
                    mdl.modal("show");
                }
            })
        })

        //delete button handler
        $("#tb tbody").on("click", "td .btndelete", function (){
            let data = tb.row( $(this).parents("tr") ).data();
            c_swal("<i>" + data.fname + "</i> will be deleted.", function(){
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url("/Home/Delete"); ?>",
                    dataType: "json",
                    data: {id: data.id},
                    beforeSend: function(){l_swal();},
                    success: function(r){
                        if(r.rs){
                            s_swal(r.rt);
                            tb.ajax.reload();
                        }
                        else{
                            e_swal(r.rt);
                        }
                    }
                })
            })
        })
    </script>
</body>
</html>