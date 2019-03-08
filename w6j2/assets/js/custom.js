//LOADING SWAL
function l_swal(){
    swal({
        title: "Loading..",
        allowOutsideClick: false,
        allowEscapeKey: false,
        onBeforeOpen: function(){
            swal.showLoading();
        }
    });
}

//SUCCESS SWAL
function s_swal(text, callback = null){
    swal({
        type: "success",
        title: "Success",
        text: text
    }).then(function(r){
        if(callback != null) callback();
    })
}

//ERROR SWL
function e_swal(text){
    swal({
        type: "error",
        title: "Error",
        text: text
    })
}