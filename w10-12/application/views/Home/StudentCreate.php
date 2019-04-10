<?php
    if(!isset($nim)) $nim = "";
    if(!isset($fname)) $fname = "";
    if(!isset($lname)) $lname = "";
    if(!isset($desc)) $desc = "";
    if(!isset($addr)) $addr = "";
?>

<div class="modal-header">
    <h2>Create Student</h2>
</div>
<div class="modal-body">
    <!-- nim -->
    <div class="form-row">
        <div class="form-group col-12">
            <label>NIM</label>
            <input class="form-control <?php echo form_error("nim") != null ? "is-invalid" : ""; ?>" type="text" name="nim" id="nim" placeholder="Student's NIM" value="<?php echo $nim; ?>">
            <small class="form-text text-danger"><?php echo form_error("nim")?></small>
        </div>
    </div>
    <!-- fname -->
    <div class="form-row">
        <div class="form-group col-12">
            <label>First Name</label>
            <input class="form-control <?php echo form_error("fname") != null ? "is-invalid" : ""; ?>" type="text" name="fname" id="fname" placeholder="Student's First Name" value="<?php echo $fname; ?>">
            <small class="form-text text-danger"><?php echo form_error("fname")?></small>
        </div>
    </div>
    <!-- lname -->
    <div class="form-row">
        <div class="form-group col-12">
            <label>Last Name</label>
            <input class="form-control <?php echo form_error("lname") != null ? "is-invalid" : ""; ?>" type="text" name="lname" id="lname" placeholder="Student's Last Name" value="<?php echo $lname; ?>">
            <small class="form-text text-danger"><?php echo form_error("lname")?></small>
        </div>
    </div>
    <!-- desc -->
    <div class="form-row">
        <div class="form-group col-12">
            <label>Description</label>
            <input class="form-control <?php echo form_error("desc") != null ? "is-invalid" : ""; ?>" type="text" name="desc" id="desc" placeholder="Student's Description" value="<?php echo $desc; ?>">
            <small class="form-text text-danger"><?php echo form_error("desc")?></small>
        </div>
    </div>
    <!-- addr -->
    <div class="form-row">
        <div class="form-group col-12">
            <label>Address</label>
            <input class="form-control <?php echo form_error("addr") != null ? "is-invalid" : ""; ?>" type="text" name="addr" id="addr" placeholder="Student's Address" value="<?php echo $addr; ?>">
            <small class="form-text text-danger"><?php echo form_error("addr")?></small>
        </div>
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
            url: "<?php echo base_url("Home/Create"); ?>",
            dataType: "json",
            data: {
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