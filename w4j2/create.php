<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>w4j2</title>
    <link rel="stylesheet" href="bs4.css">
    <script src="jq.js"></script>
    <script src="bs4.js"></script>
    <script src="fa.min.js"></script>
    <script src="swal2.js"></script>
</head>
<body>
    <style>
        ::-webkit-input-placeholder{
            font-style: italic;
        }
    </style>

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
        <h1>Create Student</h1>
        <div class="form-row">
            <div class="form-group col-4">
                <label>NIM</label>
                <input class="form-control" type="text" name="snim" id="snim" placeholder="Student's NIM">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-4">
                <label>First Name</label>
                <input class="form-control" type="text" name="sfname" id="sfname" placeholder="Student's First Name">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-4">
                <label>Last Name</label>
                <input class="form-control" type="text" name="slname" id="slname" placeholder="Students's Last Name">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-4">
                <label>Description</label>
                <textarea class="form-control" type="text" name="sdesc" id="sdesc" placeholder="Student Description"></textarea>
            </div>
        </div>
        <button id="sv" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;Save</button>
        <button id="cb" class="btn btn-light">Cancel</button>
    </div>

    <script>
        //SAVE BUTTON HANDLER
        $("#sv").on("click", function(){
            $.ajax({
                type: "post",
                url: "cdata.php",
                data:{
                    nim: $("#snim").val(),
                    fname: $("#sfname").val(),
                    lname: $("#slname").val(),
                    desc: $("#sdesc").val()
                },
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
                            html: "Data submitted",
                            showCloseButton: false
                        })
                        .then(function (z) {
                            location.href = "index.php";
                        });
                    }
                    else{
                        swal({
                            type: "error",
                            title: "Error.",
                            showCloseButton: false
                        });
                    }
                }
            })
        })

        //CANCEL BUTTON HANDLER
        $("#cb").on("click", function(){location.href="index.php";})
    </script>
</body>
</html>