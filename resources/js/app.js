import './bootstrap';

const uploadedDocumentMap = {}
const elId = '#dz';
const el = document.querySelector(elId)

new DZ(elId, {
    url: el.getAttribute('data-url'),
    maxFiles: 5,
    addRemoveLinks: true,
    headers: {
        'X-CSRF-TOKEN': el.getAttribute('data-csrf')
    },
    success: function (file, response) {
        const input = document.createElement('input')
        input.type = 'hidden'
        input.name = 'file[]'
        input.value = response.name
        document.querySelector('#form').append(input)

        uploadedDocumentMap[file.name] = response.name
    },
    removedfile: function (file) {
        file.previewElement.remove()
        let name = ''
        if (typeof file.file_name !== 'undefined') {
            name = file.file_name
        } else {
            name = uploadedDocumentMap[file.name]
        }
        document.querySelector('input[name="file[]"][value="' + name + '"]').remove()
    },
})
