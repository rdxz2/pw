<div class="modal-header">
    <h2>Edit Student</h2>
</div>
<div class="modal-body">
    <!-- id -->
    <input id="id" value="<?php echo $id; ?>" disabled hidden>
    <!-- nim -->
    <div class="form-row">
        <div class="form-group col-12">
            <label>NIM</label>
            <input class="form-control <?php echo form_error("nim") != null ? "is-invalid" : ""; ?>" type="text" name="nim" id="nim" placeholder="Student's NIM" value="<?php echo $nim;?>">
        </div>
        <small class="form-text text-danger"><?php echo form_error("nim")?></small>
    </div>
    <!-- fname -->
    <div class="form-row">
        <div class="form-group col-12">
            <label>First Name</label>
            <input class="form-control <?php echo form_error("fname") != null ? "is-invalid" : ""; ?>" type="text" name="fname" id="fname" placeholder="Student's First Name" value="<?php echo $fname;?>">
        </div>
        <small class="form-text text-danger"><?php echo form_error("fname")?></small>
    </div>
    <!-- lname -->
    <div class="form-row">
        <div class="form-group col-12">
            <label>Last Name</label>
            <input class="form-control <?php echo form_error("lname") != null ? "is-invalid" : ""; ?>" type="text" name="lname" id="lname" placeholder="Student's Last Name" value="<?php echo $lname;?>">
        </div>
        <small class="form-text text-danger"><?php echo form_error("lname")?></small>
    </div>
    <!-- desc -->
    <div class="form-row">
        <div class="form-group col-12">
            <label>Description</label>
            <input class="form-control <?php echo form_error("desc") != null ? "is-invalid" : ""; ?>" type="text" name="desc" id="desc" placeholder="Student's Description" value="<?php echo $desc;?>">
        </div>
        <small class="form-text text-danger"><?php echo form_error("desc")?></small>
    </div>
    <!-- addr -->
    <div class="form-row">
        <div class="form-group col-12">
            <label>Address</label>
            <input class="form-control <?php echo form_error("addr") != null ? "is-invalid" : ""; ?>" type="text" name="addr" id="addr" placeholder="Student's Address" value="<?php echo $addr;?>">
        </div>
        <small class="form-text text-danger"><?php echo form_error("addr")?></small>
    </div>
</div>
<div class="modal-footer">
    <div id="btn_cancel" class="btn btn-light w-50">Cancel</div>
    <div id="btn_save" class="btn btn-primary w-50"><i class="fas fa-save"></i>&nbsp;&nbsp;Save</div>
</div>

<script>
    //cancel button handler
    $("#btn_cancel").on("click", function(){
        mdl.modal("hide");
    })

    //save button handler
    $("#btn_save").on("click", function(){
        $.ajax({
            type: "post",
            url: "<?php echo base_url("/Home/Edit"); ?>",
            dataType: "json",
            data:{
                id: $("#id").val(),
                nim: $("#nim").val(),
                fname: $("#fname").val(),
                lname: $("#lname").val(),
                desc: $("#desc").val(),
                addr: $("#addr").val()
            },
            beforeSend: function(){l_swal();},
            success: function(r){
                if(r.rs){
                    s_swal(r.rt);
                    mdl.modal("hide");
                    tb.ajax.reload();
                }
                else{
                    e_swal(r.rt);
                    if(r.rv != undefined) mdl_pv.html(r.rv);
                }
            }
        })
    })
</script>