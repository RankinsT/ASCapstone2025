<div class="col-lg-4">
    <div class="service-outer-div">
        <div class="service-inner-div">
            <div class="service-img">
                    <div id="service-img-text1" style="margin: 20px;">[Service Description 1]</div>
                    <form action="" id="service-img-form1" style="display:none;">
                        <textarea name="service-img-editor1" id="service-img-editor1">Welcome to TinyMCE!</textarea>
                    </form>
                    <button id="service-img-edit-save-btn1" type="button">Edit</button>
            </div>
        </div>
    </div>

    <div class="service-outer-div">
        <div class="service-inner-div">
            <div id="service-img-text2" style="margin: 20px;">[Service Description 2]</div>
            <form action="" id="service-img-form2" style="display:none;">
                <textarea name="service-img-editor2" id="service-img-editor2">Welcome to TinyMCE!</textarea>
            </form>
            <button id="service-img-edit-save-btn2" type="button">Edit</button>
        </div>
    </div>

    <div class="service-outer-div">
        <div class="service-inner-div">
            <div id="service-img-text3" style="margin: 20px;">[Service Description 3]</div>
            <form action="" id="service-img-form3" style="display:none;">
                <textarea name="service-img-editor3" id="service-img-editor3">Welcome to TinyMCE!</textarea>
            </form>
            <button id="service-img-edit-save-btn3" type="button">Edit</button>

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
            <div class="service-text"></div>
        </div>
    </div>

    <div class="service-outer-div">
        <div class="service-inner-div">
            <div class="service-text"></div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function debugInitEditableSection(opts) {
        console.log('Initializing editable section:', opts);
        const editBtn = document.getElementById(opts.editButtonId);
        const textEl = document.getElementById(opts.textElementId);
        const formEl = document.getElementById(opts.formId);
        const editorEl = document.getElementById(opts.editorId);
        if (!editBtn) console.error('Edit button not found:', opts.editButtonId);
        if (!textEl) console.error('Text element not found:', opts.textElementId);
        if (!formEl) console.error('Form element not found:', opts.formId);
        if (!editorEl) console.error('Editor element not found:', opts.editorId);
        initEditableSection(opts);
    }
    debugInitEditableSection({
        editButtonId: 'service-img-edit-save-btn1',
        textElementId: 'service-img-text1',
        formId: 'service-img-form1',
        editorId: 'service-img-editor1'
    });
    debugInitEditableSection({
        editButtonId: 'service-img-edit-save-btn2',
        textElementId: 'service-img-text2',
        formId: 'service-img-form2',
        editorId: 'service-img-editor2'
    });
    debugInitEditableSection({
        editButtonId: 'service-img-edit-save-btn3',
        textElementId: 'service-img-text3',
        formId: 'service-img-form3',
        editorId: 'service-img-editor3'
    });
});
</script>