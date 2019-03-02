<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>w5</title>
    <link rel="stylesheet" href="css/bs4.css">
    <link rel="stylesheet" href="css/dt.css">
    <script src="js/jq.js"></script>
    <script src="js/dt.js"></script>
    <script src="js/bs4.js"></script>
    <script src="js/fa.min.js"></script>
    <script src="js/swal2.js"></script>

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
            </thead>
        </table>
    </div>

    <!-- EDIT MODAL -->
    <div id="mdl" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Log In
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" class="form-control" id="nim">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="pwd">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="lgin" class="btn btn-primary">Login</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var tb = $("#tb").DataTable({
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
                ],
                columnDefs:[
                    {
                        targets: 1,
                        visible: false,
                        searchable: false
                    }
                ],
                processing: true
            }),
            nim = $("#nim"),
            pwd = $("#pwd"),
            mdl = $("#mdl").modal({
                backdrop: "static",
                keyboard: false,
            }).on("shown.bs.modal", function(){
                nim.focus();
            });
        
        //ROW INDEX DI DALEM TABEL
        tb.on('order.dt search.dt', function () {
            tb.column(0, {search:'applied', order:'applied'}).nodes().each( function(cell, i){
                cell.innerHTML = i+1;
            });
        }).draw();
        
        //LOGIN BUTTON HANDLER
        $("#lgin").on("click", function(){
            $.ajax({
                method: "post",
                url: "login.php",
                dataType: "json",
                data: {
                    nim: nim.val(),
                    pwd: pwd.val()
                },
                beforeSend: function(){
                    swal({
                        title: "Logging in...",
                        onBeforeOpen: () => {swal.showLoading();} 
                    })
                },
                success: function(r){
                    console.log(r);
                    if(r.s == true){
                        mdl.modal("hide"),
                        swal({
                            type: "success",
                            title: "Logged in",
                            text: r.t
                        })
                    }
                    else{
                        swal({
                            type: "error",
                            title: "Error",
                            text: r.t
                        })
                    }
                }
            })
        })
    </script>
</body>
</html>