<div class="modal-header">
    <h1>Edit Student</h1>
</div>
<div class="modal-body">
    <input class="form-control" type="text" name="sid" id="sid" disabled hidden>
    <div class="form-row">
        <div class="form-group col-12">
            <label>NIM</label>
            <input class="form-control" type="text" name="snim" id="snim" placeholder="Student's NIM" disabled>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-12">
            <label>First Name</label>
            <input class="form-control" type="text" name="sfname" id="sfname" placeholder="Student's First Name">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-12">
            <label>Last Name</label>
            <input class="form-control" type="text" name="slname" id="slname" placeholder="Students's Last Name">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-12">
            <label>Description</label>
            <textarea class="form-control" type="text" name="sdesc" id="sdesc" placeholder="Student Description"></textarea>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button id="bck" class="btn w-50">Back</button>
    <button id="sv" class="btn btn-primary w-50"><i class="fas fa-save"></i>&nbsp;Save</button>
</div>

<script>
    var sid = $("#sid"),
        snim = $("#snim"),
        sfname = $("#sfname"),
        slname = $("#slname"),
        sdesc = $("#sdesc");

    //BACK BUTTON HANDLER
    $("#bck").on("click", function(){
        mdl.modal("hide");
    })

    //SAVE BUTTON HANDLER
    $("#sv").on("click", function(){
        $.ajax({
            type: "post",
            url: "sdata.php",
            data: {
                id: sid.val(),
                fname: sfname.val(),
                lname: slname.val(),
                desc: sdesc.val()
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
                        title: "Success.",
                        html: "<b>" + snim.val() + "</b> has been edited.",
                        showCancelButton: false
                    });
                    mdl.modal("hide");
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
    })
</script>