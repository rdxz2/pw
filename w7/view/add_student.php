<div class="modal-header">
    <h1>Create Student</h1>
</div>
<div class="modal-body">
    <div class="form-group">
        <label>NIM</label>
        <input class="form-control" type="text" name="snim" id="snim" placeholder="Student's NIM">
    </div>
    <div class="form-group">
        <label>First Name</label>
        <input class="form-control" type="text" name="sfname" id="sfname" placeholder="Student's First Name">
    </div>

    <div class="form-group">
        <label>Last Name</label>
        <input class="form-control" type="text" name="slname" id="slname" placeholder="Students's Last Name">
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea class="form-control" type="text" name="sdesc" id="sdesc" placeholder="Student Description"></textarea>
    </div>

    <div class="form-group">
        <label>Address</label>
        <textarea class="form-control" type="text" name="saddr" id="saddr" placeholder="Student Description"></textarea>
    </div>
</div>
<div class="modal-footer">
    <button id="bck" class="btn w-50">Cancel</button>
    <button id="sv" class="btn btn-primary w-50"><i class="fas fa-save"></i>&nbsp;Save</button>
</div>

<script>
    //BACK BUTTON HANDLER
    $("#bck").on("click", function(){
        mdl.modal("hide");
    })

    //SAVE BUTTON HANDLER
    $("#sv").on("click", function(){
        $.ajax({
            type: "post",
            url: "../controller/StudentController.php",
            dataType: "json",
            data:{
                act: "createsubmit",
                nim: $("#snim").val(),
                fname: $("#sfname").val(),
                lname: $("#slname").val(),
                desc: $("#sdesc").val(),
                addr: $("#saddr").val()
            },
            beforeSend: l_swal(),
            success: function(r){
                if(r.s == true){
                    s_swal(r.t);
                    mdl.modal("hide");
                    tb.ajax.reload();
                }
                else{
                    e_swal(r.t);
                }
            }
        })
    })
</script>