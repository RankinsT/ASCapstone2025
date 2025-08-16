<div id="reviews">
  <div id="review-text1">“I was nervous about moving my 8-foot pool table, but this team made it completely stress-free. They arrived on time, handled everything with care, and had it set up perfectly in my new game room. Highly professional and efficient—definitely recommend them to anyone needing a pool table moved safely!”</div>
  <form action="" id="review-form1" style="display:none;">
    <textarea id="review-editor1">Welcome to TinyMCE!</textarea>
  </form>
  <button id="review-edit-save-btn1" type="button">Edit</button>
</div>

<div id="review2">
  <div id="review-text2">“Great experience overall. The movers were friendly, careful, and worked quickly. My only minor issue was that the setup took a little longer than expected, but the job was done right, and my pool table arrived without a scratch. I would hire them again in a heartbeat.”</div>
  <form action="" id="review-form2" style="display:none;">
    <textarea id="review-editor2">Welcome to TinyMCE!</textarea>
  </form>
  <button id="review-edit-save-btn2" type="button">Edit</button>
</div>

<div id="review3">
  <div id="review-text3">“Exceptional service from start to finish. The crew communicated clearly, protected all corners of my table, and navigated some tricky stairs without a problem. They even gave me tips for maintaining the table after the move. Worth every penny!”</div>
  <form action="" id="review-form3" style="display:none;">
    <textarea id="review-editor3">Welcome to TinyMCE!</textarea>
  </form>
  <button id="review-edit-save-btn3" type="button">Edit</button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function debugInitEditableSection(opts) {
        console.log('Initializing editable section:', opts);
        // Initialize TinyMCE or any other editor here
    }

    // Initialize each review section
    debugInitEditableSection({
        id: 'review-text1',
        formId: 'review-form1',
        editorId: 'review-editor1',
        buttonId: 'review-edit-save-btn1'
    });

    debugInitEditableSection({
        id: 'review-text2',
        formId: 'review-form2',
        editorId: 'review-editor2',
        buttonId: 'review-edit-save-btn2'
    });

    debugInitEditableSection({
        id: 'review-text3',
        formId: 'review-form3',
        editorId: 'review-editor3',
        buttonId: 'review-edit-save-btn3'
    });
});
</script>