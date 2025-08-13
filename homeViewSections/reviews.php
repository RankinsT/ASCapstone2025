<div id="reviews-container">
  <p id="reviews-text">
    "I can’t say enough good things about [Your Company Name]! From start to finish, the team was professional, punctual, and incredibly careful with my pool table. They handled every step of the move with precision—disassembly, transport, and reassembly—making sure it was perfectly leveled and ready to play. You can tell they really care about their work and their customers. It’s rare to find a small business that’s this reliable, friendly, and affordable. If you need a pool table moved anywhere in Connecticut, these are the people to call!"
  </p>

  <form action="" id="reviews-form" style="display:none;">
    <textarea id="reviews-editor">Welcome to TinyMCE!</textarea>
  </form>
  <button id="reviews-edit-save-btn" type="button">Edit</button>
</div>

<script>
let isReviewsEditing = false;

const reviewsEditSaveBtn = document.getElementById('reviews-edit-save-btn');
const reviewsText = document.getElementById('reviews-text');
const reviewsForm = document.getElementById('reviews-form');
const reviewsEditor = document.getElementById('reviews-editor');

reviewsEditSaveBtn.addEventListener('click', function() {
  if (!isReviewsEditing) {
    // Switch to edit mode
    reviewsEditor.value = reviewsText.innerHTML;
    reviewsText.style.display = 'none';
    reviewsForm.style.display = 'block';
    reviewsEditSaveBtn.textContent = 'Save';

    tinymce.init({
      selector: '#reviews-editor',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',

      // Allow selecting images from local device
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
            // Insert as base64 string
            cb(reader.result, { title: file.name });
          };
          reader.readAsDataURL(file);
        };

        input.click();
      },

      setup: function(editor) {
        editor.on('init', function() {
          editor.setContent(reviewsText.innerHTML);
        });
      }
    });

    isReviewsEditing = true;
  } else {
    // Save changes
    const content = tinymce.get('reviews-editor').getContent();
    reviewsText.innerHTML = content;
    reviewsText.style.display = 'block';
    reviewsForm.style.display = 'none';
    reviewsEditSaveBtn.textContent = 'Edit';
    tinymce.get('reviews-editor').remove();
    isReviewsEditing = false;

    // TODO: Add AJAX here to save to backend if needed
  }
});
</script>
