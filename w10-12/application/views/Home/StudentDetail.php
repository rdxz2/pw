<div class="modal-header">
    <h2>Student Detail</h2>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-3">NIM</div>
        <div class="col-9"><?php echo $nim; ?></div>
    </div>
    <hr>
    <div class="row">
        <div class="col-3">First Name</div>
        <div class="col-9"><?php echo $fname; ?></div>
    </div>
    <hr>
    <div class="row">
        <div class="col-3">Last Name</div>
        <div class="col-9"><?php echo $lname; ?></div>
    </div>
    <hr>
    <div class="row">
        <div class="col-3">Description</div>
        <div class="col-9"><?php echo $desc; ?></div>
    </div>
    <hr>
    <div class="row">
        <div class="col-3">Address</div>
        <div class="col-9"><?php echo $addr; ?></div>
    </div>
</div>
<div class="modal-footer">
    <div id="btn_back" class="btn btn-light btn-block">Back</div>
</div>

<script>
    //back button handler
    $("#btn_back").on("click", function(){
        mdl.modal("hide");
    })
</script>