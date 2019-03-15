<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>w6</title>

    <?php include("cssjs.php"); ?>
</head>
<body>
    <!-- NAVBAR -->
    <?php include("navbar.php"); ?>

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
                <td class="font-weight-bold">Act.</td>
            </thead>
        </table>
    </div>

    <!-- LOGIN MODAL -->
    <div id="mdl" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div id="mdl_pv" class="modal-content">
                <div class="modal-header">
                    <h1>Log In
                </div>
                <div class="modal-body">
                    <!-- LOGIN FORM -->
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" id="usn">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="pwd">
                    </div>
                    <!-- REGISTER FORM -->
                    <div id="rgstr_v" class="collapse">
                        <hr>
                        <h1>Register</h1>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" id="usn_r">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" id="pwd_r">
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" id="pwdc_r">
                        </div>
                        <button id="rgstr_s" class="btn btn-outline-primary btn-block mb-2"><i class="fas fa-save"></i>&nbsp;Save</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="rgstr" class="btn btn-light"><i class="fas fa-user-plus"></i>&nbsp;Register</button>
                    <button id="lgin" class="btn btn-primary">Login&nbsp;<i class="fas fa-sign-in-alt"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT -->
    <script>
        var sess_logged = <?php echo (isset($_SESSION["sess"]["logged"])) ? true : "false"; ?>, //logged in php session to js variable
            sess_usn = "<?php echo (isset($_SESSION["sess"]["usn"])) ? $_SESSION["sess"]["usn"] : "username"; ?>",
            tb = $("#tb").DataTable({ //datatable
                ajax:{
                    type: "post",
                    url: "../controller/StudentController.php",
                    dataType: "json",
                    data: {act: "getall"},
                    dataSrc: ""
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
                        targets: 5,
                        data: null,
                        defaultContent: "<button class='btn btn-warning text-white eb'><i class='fas fa-edit'></i></button> " + 
                            "<button class='btn btn-danger db'><i class='fas fa-times-circle'></i></button>",

                    }
                ],
                processing: true
            }),
            usn_t = document.getElementById("usn_t"),
            usn = $("#usn").focusin(function(){rgstr_v.collapse("hide")}), //login form -> username
            pwd = $("#pwd").focusin(function(){rgstr_v.collapse("hide")}), //login form -> password
            usn_r = $("#usn_r"), //register form -> username
            pwd_r = $("#pwd_r"), //register form -> password
            pwdc_r = $("#pwdc_r"), //register form -> confirm passwowrd
            mdl = $("#mdl").modal({ //universal modal
                show: sess_logged == 1 ? false : true,
                backdrop: "static",
                keyboard: false,
            }).on("shown.bs.modal", function(){
                usn.focus();
            }),
            mdl_pv = $("#mdl_pv"); //universal modal content
            rgstr_v = $("#rgstr_v"); //register collapse view

        //INITIATE USERNAME
        usn_t.innerHTML = sess_usn;
        
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
                url: "../controller/UserController.php",
                dataType: "json",
                data: {
                    act: "login",
                    usn: usn.val(),
                    pwd: pwd.val()
                },
                beforeSend: l_swal(),
                success: function(r){
                    if(r.s == true){
                        mdl.modal("hide");
                        usn_t.innerHTML = r.d.usn;
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

        //REGISTER TOGGLER HANDLER
        $("#rgstr").on("click", function(){
            rgstr_v.collapse("toggle");
        })

        //REGISTER BUTTON HANDLER
        $("#rgstr_s").on("click", function(){
            $.ajax({
                type: "post",
                url: "../controller/UserController.php",
                dataType: "json",
                data:{
                    act: "register",
                    usn: usn_r.val(),
                    pwd: pwd_r.val(),
                    pwdc: pwdc_r.val()
                },
                beforeSend: function(){
                    swal({
                        title: "Loading..",
                        onBeforeOpen: () => {swal.showLoading();}
                    })
                },
                success: function(r){
                    if(r.s == true){
                        s_swal(r.t);
                        usn_r.val("");
                        pwd_r.val("");
                        pwdc_r.val("");

                    }
                    else{
                        e_swal(r.t);
                    }
                }
            })
        })

        //LOG OUT BUTTON HANDLER
        $("#lgout").on("click", function(){
            $.ajax({
                type: "post",
                url: "../controller/UserController.php",
                dataType: "json",
                data: {
                    act: "logout"
                },
                beforeSend: l_swal(),
                success: function(r){
                    s_swal("Logged out.", function(){
                        l_swal();
                        location.reload();
                    });
                }
            })
        })

        //CREATE BUTTON HANDLER
        $("#create").on("click", function(){
            $.ajax({
                type: "get",
                url: "../controller/StudentController.php",
                dataType: "json",
                data: {
                    act: "create"
                },
                beforeSend: l_swal(),
                success: function(r){
                    if(r.s == true){
                        mdl_pv.html(r.v);
                        mdl.modal();
                        swal.close();
                    }
                    else{
                        e_swal("");
                    }
                }
            })
        })

        //EDIT BUTTON HANDLER
        $("#tb tbody").on("click", ".eb", function () {
            let data = tb.row($(this).parents("tr")).data();
            $.ajax({
                type: "get",
                url: "../controller/StudentController.php",
                dataType: "json",
                data: {
                    act: "edit",
                    id: data.id
                },
                beforeSend: l_swal(),
                success: function(r){
                    if(r.s == true){
                        mdl_pv.html(r.v);
                        mdl.modal();
                        swal.close();
                    }
                    else{
                        e_swal("");
                    }
                }
            })
        });

        //DELETE BUTTON HANDLER
        $("#tb tbody").on("click", ".db", function () {
            let data = tb.row($(this).parents("tr")).data();
            $.ajax({
                type: "post",
                url: "../controller/StudentController.php",
                dataType: "json",
                data: {
                    act: "delete",
                    id: data.id
                },
                beforeSend: l_swal(),
                success: function(r){
                    if(r.s == true){
                        s_swal(r.t);
                        tb.ajax.reload();
                    }
                    else{
                        e_swal(r.t);
                    }
                }
            })
        });

    </script>
</body>
</html>