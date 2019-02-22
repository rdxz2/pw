<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>w4j2</title>
    <link rel="stylesheet" href="bs4.css">
    <link rel="stylesheet" href="dt.css">
    <script src="jq.js"></script>
    <script src="dt.js"></script>
    <script src="bs4.js"></script>
    <script src="fa.min.js"></script>
    <script src="swal2.js"></script>

    <style>
        ::-webkit-input-placeholder{
            font-style: italic;
        }
    </style>
</head>
<body>
    <!-- TOPNAV -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-3">
        <div class="container-fluid">
            <div class="navbar-brand">
                <h4>[IF635 Web Programming]</h4>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item navbar-right active">
                    <a href="" class="nav-link">Student</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- CONTENT -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <button id="create" class="btn btn-outline-primary float-right"><i class="fas fa-plus-circle"></i>&nbsp;Student</button>
            </div>
        </div>
        <br>
        <!-- TABLE -->
        <table id="tb" class="table table-striped table-bordered w-100">
            <thead>
                <td class="font-weight-bold">#</td>
                <td class="font-weight-bold">id</td>
                <td class="font-weight-bold">NIM</td>
                <td class="font-weight-bold">First Name</td>
                <td class="font-weight-bold">Last Name</td>
                <td class="font-weight-bold">Action</td>
            </thead>
        </table>
    </div>

    <!-- EDIT MODAL -->
    <div id="mdl" class="modal fade">
        <div class="modal-dialog">
            <div id="mdl_pv" class="modal-content">
                
            </div>
        </div>
    </div>

    <script>
        var mdl = $("#mdl"),
            tb = $("#tb").DataTable({
                ajax:{
                    type: "get",
                    url: "gdata.php",
                    dataSrc: "",
                },
                columns:[
                    {data: null},
                    {data: "id"},
                    {data: "nim"},
                    {data: "fname"},
                    {data: "lname"},
                    {data: null}
                ],
                columnDefs:[
                    {
                        targets: 1,
                        visible: false,
                        searchable: false
                    },
                    {
                        targets: 5, //BUTTON
                        data: null,
                        defaultContent: "<button class='btn btn-warning text-white eb'><i class='fas fa-edit'></i></button>  " + 
                            "<button class='btn btn-danger db'><i class='fas fa-times-circle'></i></button>",
                        width: 80
                    }
                ],
                processing: true
            });
        
        //ROW INDEX DI DALEM TABEL
        tb.on('order.dt search.dt', function () {
            tb.column(0, {search:'applied', order:'applied'}).nodes().each( function(cell, i){
                cell.innerHTML = i+1;
            });
        }).draw();

        //CREATE BUTTON HANDLER
        $("#create").on("click", function(){ location.href = "create.php"; })

        //EDIT BUTTON HANDLER
        $("#tb tbody").on("click", ".eb", function () {
            let data = tb.row($(this).parents("tr")).data();
            $.ajax({
                type: "get",
                url: "edata.php",
                dataType: "json",
                data: {id: data.id},
                beforeSend: function(){
                    swal({
                        title: "Loading..",
                        onBeforeOpen: () => {swal.showLoading();}
                    })
                },
                success: function(r){
                    $("#mdl_pv").load("edit.php", function(){
                        sid.val(r.id);
                        snim.val(r.nim);
                        sfname.val(r.fname);
                        slname.val(r.lname);
                        sdesc.val(r.desc);
                        mdl.modal();
                        swal.close();
                    });
                }
            })
        });

        //DELETE BUTTON HANDLER
        $("#tb tbody").on("click", "td .db", function () {
            let data = tb.row( $(this).parents("tr") ).data();
            
            swal({
                type: "warning",
                html: "Delete data?",
                showCancelButton: true
            })
            .then(function(res){
                if(res.value){
                    $.ajax({
                        type: "post",
                        url: "rdata.php",
                        data: {id: data.id},
                        beforeSend: function(){
                            swal({
                                title: "Loading..",
                                onBeforeOpen: () => {swal.showLoading();}
                            })
                        },
                        success: function(r){
                            if(r == "true"){
                                swal({
                                    type: "success",
                                    title: "Success",
                                    html: "<b>" + data.nim + "</b> has been deleted.",
                                    showCancelButton: false
                                });
                                tb.ajax.reload();
                            }
                            else{
                                swal({
                                    type: "error",
                                    title: "Error.",
                                    showCancelButton: false
                                });
                            }
                        }
                    })
                }
            });
        });
    </script>
</body>
</html>