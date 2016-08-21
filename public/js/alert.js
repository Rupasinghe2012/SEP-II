$(document).on('click', '#delete-btn', function(e) { e.preventDefault();
    var self = $(this);
    swal({
            title: "Are you sure?",
            text: "All of the images will be deleted also!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
        function(isConfirm){
            if(isConfirm){
                swal("Deleted!","Your Album is Deleted", "success");
                setTimeout(function() {
                    self.parents(".delete_form").submit();
                }, 2000);
            }
            else{
                swal("Cancelled","Your Album is safe", "error");
            }
        });
});

$(document).on('click', '#postdel', function(e) { e.preventDefault();
    var self = $(this);
    swal({
            title: "Are you sure?",
            text: "All of the sub categories will be deleted also!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
        function(isConfirm){
            if(isConfirm){
                swal("Deleted!","Your Album is Deleted", "success");
                setTimeout(function() {
                    self.parents(".delpost").submit();
                }, 2000);
            }
            else{
                swal("Cancelled","Your Album is safe", "error");
            }
        });
});


// $(document).on('click', '#add-btn', function(e) { e.preventDefault();
//     var self = $(this);
//     swal("Succesfull!", "You have created a new Album!!!", "success")
//     setTimeout(function() {
//         self.parents(".form-horizontal").submit();
//     }, 2000);
// });

$(document).on('click', '#profdata', function(e) { e.preventDefault();
    var self = $(this);
    swal("Succesfull!", "You have Updated Details!!!", "success")
    setTimeout(function() {
        self.parents("#pro").submit();
    }, 2000);
});