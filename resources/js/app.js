import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Subí acá tu imagen',
    acceptedFiles: '.png, .jpg, .jpeg, .gif',
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar archivo',
    maxFiles: 1,
    uploadMultiple: false,

    init: function() {
        if(document.querySelector('[name="imagen"]').value.trim())
        {
            const imagenPublicada = {};
            imagenPublicada.size = 1234;
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call( this, imagenPublicada );
            this.options.thumbnail.call( this, imagenPublicada, `/uploads/${imagenPublicada.name}`);

            imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');

        }
    }

    // init: function() {
    //     if(document.querySelector('[name="imagen"]').value.trim()){
    //         const fileName = document.querySelector('[name="imagen"]').value.trim()
    //         const file = {name: fileName, size: 1234, url:`/uploads/${fileName}`};  
            
    //         let mockfile = {
    //             name: file.name,
    //             size: file.size,
    //         };

    //         this.displayExistingFile(mockfile, file.url);
    //     }
    // }
});

// dropzone.on('sending', function(file, xhr, formData) {
//     console.log(formData);
// });

dropzone.on('success', function(file, response) {
    document.querySelector('[name="imagen"]').value = response.imagen;
});

dropzone.on('removedfile', function(file) {
    document.querySelector('[name="imagen"]').value = '';
});

