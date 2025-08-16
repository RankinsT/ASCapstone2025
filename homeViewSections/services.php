
<div class="row">
    <div class="col-lg-4">
        <div class="service-outer-div">
            <div class="service-inner-div">
                <div class="service-img"></div>
                <div id="service-img-text1" style="margin: 20px;"> Re-covering in a variety of colors, repairing small tears, and tightening rails.</div>
                <form action="" id="service-img-form1" style="display:none;">
                    <textarea name="service-img-editor1" id="service-img-editor1">Welcome to TinyMCE!</textarea>
                </form>
                <button id="service-img-edit-save-btn1" type="button">Edit</button>
            </div>
        </div>
        <div class="service-outer-div">
            <div class="service-inner-div">
                <div class="service-img"></div>
                <div id="service-img-text2" style="margin: 20px;">Shifting your table to a new room or basement without leaving the property.</div>
                <form action="" id="service-img-form2" style="display:none;">
                    <textarea name="service-img-editor2" id="service-img-editor2">Welcome to TinyMCE!</textarea>
                </form>
                <button id="service-img-edit-save-btn2" type="button">Edit</button>
            </div>
        </div>
        <div class="service-outer-div">
            <div class="service-inner-div">
                <div class="service-img"></div>
                <div id="service-img-text3" style="margin: 20px;">Disassembly, transport, and reassembly of all table sizes, including slate tables.</div>
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
                <div id="service-img-text4" style="margin: 20px;">Disassembly, transport, and reassembly of all table sizes, including slate tables.</div>
                <form action="" id="service-img-form4" style="display:none;">
                    <textarea name="service-img-editor4" id="service-img-editor4">Welcome to TinyMCE!</textarea>
                </form>
                <button id="service-img-edit-save-btn4" type="button">Edit</button>
            </div>
        </div>
        <div class="service-outer-div">
            <div class="service-inner-div">
                <div class="service-img"></div>
                <div id="service-img-text5" style="margin: 20px;">Handling cracked or damaged slate </div>
                <form action="" id="service-img-form5" style="display:none;">
                    <textarea name="service-img-editor5" id="service-img-editor5">Welcome to TinyMCE!</textarea>
                </form>
                <button id="service-img-edit-save-btn5" type="button">Edit</button>
            </div>
        </div>
        <div class="service-outer-div">
            <div class="service-inner-div">
                <div class="service-img"></div>
                <div id="service-img-text6" style="margin: 20px;">Disassembly, transport, and reassembly of all table sizes, including slate tables.</div>
                <form action="" id="service-img-form6" style="display:none;">
                    <textarea name="service-img-editor6" id="service-img-editor6">Welcome to TinyMCE!</textarea>
                </form>
                <button id="service-img-edit-save-btn6" type="button">Edit</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    for (let i = 1; i <= 6; i++) {
        initEditableSection({
            editButtonId: `service-img-edit-save-btn${i}`,
            textElementId: `service-img-text${i}`,
            formId: `service-img-form${i}`,
            editorId: `service-img-editor${i}`
        });
    }
});
</script>