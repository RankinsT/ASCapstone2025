<div class="col-lg-4">
    <div class="service-outer-div">
        <div class="service-inner-div">
            <div class="service-img">
                <p id="service-img1"></p>
                <form action="" id="service-form1">
                    <textarea name="serviceImage1-editor" id="serviceImage1-editor"></textarea>
                </form>
                <button id="serviceImage1-edit-save-btn">Edit</button>

                <script>
                    let isService1Editing = false;

                    const serviceImage1EditSaveBtn = document.getElementById('serviceImage1-edit-save-btn');
                    const serviceImage1Text = document.getElementById('serviceImage1-text');
                    const serviceImage1Form = document.getElementById('service-form1');
                    const serviceImage1Editor = document.getElementById('serviceImage1-editor');

                    serviceImage1EditSaveBtn.addEventListener('click', function() {
                        if (!isService1Editing) {
                            // Switch to edit mode
                            serviceImage1Editor.value = serviceImage1Text.innerHTML;
                            serviceImage1Text.style.display = 'none';
                            serviceImage1Form.style.display = 'block';
                            serviceImage1EditSaveBtn.textContent = 'Save';

                            tinymce.init({
                                selector: '#reviews-editor',
                                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',

                                //Allow selecting images from local device
                                automatic_uploads: true,
                                file_picker_types: 'image',
                                file_picker_callback: function (cb, value, meta) {
                                    let input = document.createElement('input');
                                    input.setAttribute('type', 'file');
                                    input.setAttribute('accept', 'image/*');
                                    input.onchange = function () {
                                        let file = this.files[0];
                                        let reader = new FileReader();
                                        reader.onload = function () {
                                            cb(reader.result, { alt: file.name });
                                        };
                                        reader.readAsDataURL(file);
                                    };
                                    input.click();
                                },
                                setup: function(editor) {
                                    editor.on('init', function() {
                                        editor.setContent(serviceImage1Text.innerHTML);
                                    });
                                }
                            });
                            isService1Editing = true;
                        } else {
                            // Save changes
                            const content = tinymce.get('serviceImage1-editor').getContent();
                            serviceImage1Text.innerHTML = content;
                            serviceImage1Form.style.display = 'none';
                            serviceImage1Text.style.display = 'block';
                            serviceImage1EditSaveBtn.textContent = 'Edit';
                            tinymce.get('serviceImage1-editor').remove();
                            isService1Editing = false;
                        }
                    });
                </script>
            </div>
            <div class="service-text"></div>
        </div>
    </div>

    <div class="service-outer-div">
        <div class="service-inner-div">
            <div class="service-img"></div>
            <div class="service-text"></div>
        </div>
    </div>

    <div class="service-outer-div">
        <div class="service-inner-div">
            <div class="service-img"></div>
            <div class="service-text"></div>
        </div>
    </div>
</div>

<div class="col-lg-4">
    <div class="service-outer-div">
        <div class="service-inner-div">
            <div class="service-img"></div>
            <div class="service-text"></div>
        </div>
    </div>

    <div class="service-outer-div">
        <div class="service-inner-div">
            <div class="service-img"></div>
            <div class="service-text"></div>
        </div>
    </div>

    <div class="service-outer-div">
        <div class="service-inner-div">
            <div class="service-img"></div>
            <div class="service-text"></div>
        </div>
    </div>
</div>