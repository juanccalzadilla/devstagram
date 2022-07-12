import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

// when document ready javascript vanilla

window.addEventListener('DOMContentLoaded', function () {

    const dropzone = new Dropzone('#dropzone',{
        dictDefaultMessage: 'Drag and drop files here to upload',
        acceptedFiles:".png,.jpg,.jpeg,.gif",
        addRemoveLinks: true,
        dictRemoveFile: 'Remove file',
        maxFiles: 2,
        uploadMultiple: false,
        init:function(){
            if (document.getElementById('imagenUrlId').value.trim()) {
                const imagenPublicada = {};
                imagenPublicada.size = 1234;
                imagenPublicada.name = document.getElementById('imagenUrlId').value;
                this.options.addedfile.call(this,imagenPublicada);
                this.options.thumbnail.call(this,imagenPublicada,`/uploads/${imagenPublicada.name}`);
                imagenPublicada.previewElement.classList.add('dz-success','dz-complete');
            }
        }
    })

    dropzone.on('success',function(file,response){
        document.getElementById('imagenUrlId').value = response.path;
    })

    dropzone.on('removedfile', function(file){
        document.getElementById('imagenUrlId').value = "";
    })

    


})



