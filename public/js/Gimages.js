/**
 * Created by Iruka Avantha on 11/21/2016.
 */
// Change album

function changeAlbum(album) {
    $("#albumName").text(album);

    refresh(album);
    //refresh();
}

// Refresh

function refresh(album) {
    // album = typeof album !== 'undefined' ? album : 'All';


    $.ajax({
        type: "get",
        url: "/site/album",
        data: "album="+album,
        success : function(data){
            var result='';

            for(var i=0;i<data.length;i++){
            result +='\
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">\
                    <a class="thumbnail" href="/gallery/images/'+data[i].file_name+'" data-lightbox="mygallery">\
                    <img class="img-responsive" src="/gallery/images/thumbs/'+data[i].file_name+'">\
                    </a>\
                    </div>';
            }

            if (result == '') {
                $("#searchResults").html('<div class="alert alert-danger">\
		 								No Images available for this album.\
		 							</div>');
            } else {
                $("#searchResults").html(result);
            }

        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    });
}