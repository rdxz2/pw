<div class="modal-header">
    <h1>Edit Student</h1>
</div>
<div class="modal-body">
    <input class="form-control" type="text" name="sid" id="sid" disabled hidden value="<?php echo $id;?>">
    <div class="form-row">
        <div class="form-group col-12">
            <label>NIM</label>
            <input class="form-control" type="text" name="snim" id="snim" placeholder="Student's NIM" disabled value="<?php echo $nim;?>">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-12">
            <label>First Name</label>
            <input class="form-control" type="text" name="sfname" id="sfname" placeholder="Student's First Name" value="<?php echo $fname;?>">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-12">
            <label>Last Name</label>
            <input class="form-control" type="text" name="slname" id="slname" placeholder="Students's Last Name" value="<?php echo $lname;?>">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-12">
            <label>Description</label>
            <textarea class="form-control" type="text" name="sdesc" id="sdesc" placeholder="Student Description"><?php echo $desc;?></textarea>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-12">
            <label>Address</label>
            <textarea class="form-control" type="text" name="saddr" id="saddr" placeholder="Student Address"><?php echo $addr;?></textarea>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button id="bck" class="btn w-50">Back</button>
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
            data: {
                act: "editsubmit",
                id: $("#sid").val(),
                fname: $("#sfname").val(),
                lname: $("#slname").val(),
                desc: $("#sdesc").val(),
                addr: $("#saddr").val()
            },
            beforeSend: l_swal(),
            success: function(r){
                if(r.s == true){
                    s_swal(r.t)
                    tb.ajax.reload();
                    mdl.modal("hide");
                }
                else{
                    e_swal(r.t);
                }
            }
        })
    })
</script>