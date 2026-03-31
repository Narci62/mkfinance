<script src="https://cdn.tiny.cloud/1/k57rl9koj6clu2md3k5uue4fgjty0oltoq71dmvzfxd0vyqu/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
    plugins: ['code', 'table', 'lists', 'image'],
    toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | image',
    file_picker_types : "image",
    //images_upload_url : "{{ route('file.upload') }}",
    automatic_uploads: true,
    
    // Ajout du token CSRF dans chaque requête d'upload
    images_upload_handler: function (blobInfo, success, failure) {
        let xhr = new XMLHttpRequest();
        let formData = new FormData();
        xhr.withCredentials = false ;
        xhr.open('POST', "{{ route('file.upload') }}");
        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

        xhr.onload = function() {
            var json;
            if (xhr.status === 200) {
                 json = JSON.parse(xhr.responseText);
                
                if (json && json.location) {
                    console.log(json);
                    success(json.location);
                } else {
                    failure('Erreur lors de l\'upload de l\'image.');
                    return
                }
            } else {
                failure('Erreur lors de l\'upload de l\'image : ' + xhr.status);
                return;
            }
        };

        formData.append('file', blobInfo.blob(), blobInfo.filename());
        xhr.send(formData);
    }
  });
</script>