

$(function() {
    Dropzone.options.addImages= {
        maxFilesize : 10,
        acceptedFiles:'image/*',
        success:function(file, response){
            if(file.status == 'success'){
                handleDropzoneFileUpload.handleSuccess(response);
                location.reload();
            }else {
                handleDropzoneFileUpload.handleError(response);
            }
        }
    };

    var handleDropzoneFileUpload = {
        handleError:function(response){
            console.log(response);
        },
        handleSuccess:function(response){
            var imageList= $('#gallery-images ul');
            var imageSrc= baseUrl + '/gallery/images/thumbs/' + response.file_name;
            $(imageList).append('<li><div class="panel panel-default"> <div class="panel-body"><a href="' + imageSrc + '"><img src="' + imageSrc + '"></a><a id="delete-btn"><button style="border-radius: 50%;"  type="button" class="btn btn-default" ><i class="fa fa-fw fa-trash" ></i></button></a></div></div></li> ');

        }
    };
});

$(document).ready(function(){
    console.log('Document is REady!!!');
});

