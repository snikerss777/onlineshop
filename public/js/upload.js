(function() {
    var file_up_names = [];
    var file_up_ids = [];
    var count_of_images = 8 - $('#count_of_images').val() ;

    Dropzone.options.bookImage = {
        paramName           :       "image", // The name that will be used to transfer the file
        maxFilesize         :       2, // MB
        
        accept              :       function(file, done) { done() },
        success             :       uploadSuccess,
        complete            :       uploadCompleted,
        addRemoveLinks      :       true,
        removedfile         :       removeUpload,     
        maxFiles            :       count_of_images,
         sending            :       initProgressBar,
        uploadprogress      :       duringUpload,

        dictDefaultMessage  :       "Upuść zdjęcie tutaj lub kliknij by je dodać.",
        acceptedFiles       :       "image/jpeg,image/png,image/gif",
        dictMaxFilesExceeded:       "Nie możesz dodać więcej plików",
        dictInvalidFileType :       "Nie możesz dodać pliku tego typu",
        dictFileTooBig      :       "Plik jest zbyt duży ({{filesize}}). Maksymalny rozmiar pliku to ({{maxFilesize}})",
        dictCancelUpload    :       "Usuń zdjęcie"
    
    };

    function uploadSuccess(file, response) {
        $('.dz-error-mark').hide();
        $('.dz-success-mark svg').hide();
        $('.dz-size').hide();

        imageId = JSON.parse(response).image_id;
        file_up_names.push(JSON.parse(response).original_name);        
        file_up_ids.push(imageId);
        file.serverId = response.image_id;
            
            var messageContainer    =   $(file.previewTemplate).find('.dz-success-mark'),
            message             =   $('<p></p>', {
                'text' : 'Zdjęcie dodane poprawnie! '
            });
            link =   $('<a id="iconLink'+ imageId +'" class="iconLink" onclick="setAsIcon('+ imageId +')">Ustaw jako miniaturkę</a>');
            icon =   $('<p id="icon'+imageId+'" class="icon"></p>');

            $(file.previewElement).find('img').attr('id', 'imgId'+imageId);

        message.appendTo(messageContainer);
        link.appendTo(messageContainer);
        icon.appendTo(messageContainer);

    }

    function uploadCompleted(data) {
        if(data.status != "success")
        {
            var error_message   =   $('.dz-error-mark').last(),
                message         =   $('<p></p>', {
                    'text' : 'Nie udało się dodać zdjęcia!'
                });

            $('.dz-success-mark').last().hide();
            $('.dz-error-mark svg').hide();

            message.appendTo(error_message);
            error_message.addClass('show');
            return;
        }
    }

    function removeUpload(file){
        for(var i=0;i<file_up_names.length;++i){
          if(file_up_names[i]==file.name) {
            $.get('/removeUpload/' + file_up_ids[i])
              .done(function( data ) {
                 //alert( "Data Loaded: " + data );
              });
            file_up_names.splice(i,1);
            file_up_ids.splice(i,1);
          }
        }

      var _ref;
      return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
  
    }

    function initProgressBar(file){
        var progressContainer    =   $(file.previewTemplate).find('.dz-progress');
        progressbar = $('<div class="progress center-block"> <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:0%">0%</div> </div>');
        progressbar.appendTo(progressContainer);

        var successContainer    =   $(file.previewTemplate).find('svg');

        successContainer.hide();


    }

    function duringUpload(file, progress){
        var messageContainer    =   $(file.previewTemplate).find('.progress-bar');
        messageContainer.css('width', progress+'%');
        messageContainer.text(Math.floor(progress)+'%');

    }

})();



function removeImage(imageId){
    
    $.get('/removeUpload/' +imageId)
        .done(function( data ) {
                $('#img'+imageId).hide();

    });

}


function setAsIcon(imageId){
    
    $.post('/setIconImage', {'imageId' : imageId})
        .done(function(data){
            console.log(data);
                $('img').removeClass('iconImage');
                $('.iconLink').show();
                $('.icon').text('');

                $('#imgId'+imageId).addClass('iconImage');
                $('#iconLink'+imageId).hide();
                $('#icon'+imageId).text('To zdjęcie będzie miniaturką');
        });


}