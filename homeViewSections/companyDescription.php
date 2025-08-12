
<div id="company-description-container">
  <p id="company-description-text">[Your Company Name] is a locally owned and operated small business based in Coventry, Connecticut, specializing in professional pool table moving, setup, and installation. We pride ourselves on delivering reliable, careful, and friendly service to ensure your pool table is transported and reassembled with the utmost care. Whether you’re relocating across town, setting up a new game room, or need expert leveling for the perfect play, we bring the tools, skill, and experience to get the job done right. As a small business, we value personal connections with our customers and go the extra mile to provide top-quality service at fair prices.</p>
  <form id="company-description-form" style="display:none;">
    <textarea id="company-description-editor">Welcome to TinyMCE!</textarea>
  </form>
  <button id="edit-save-btn" type="button">Edit</button>
</div>

<script>
let isEditing = false;
const editSaveBtn = document.getElementById('edit-save-btn');
const descText = document.getElementById('company-description-text');
const descForm = document.getElementById('company-description-form');
const descEditor = document.getElementById('company-description-editor');

editSaveBtn.addEventListener('click', function() {
  if (!isEditing) {
    // Switch to edit mode
    descEditor.value = descText.innerHTML;
    descText.style.display = 'none';
    descForm.style.display = 'block';
    editSaveBtn.textContent = 'Save';
    tinymce.init({
      selector: '#company-description-editor',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
      setup: function(editor) {
        editor.on('init', function() {
          editor.setContent(descText.innerHTML);
        });
      }
    });
    isEditing = true;
  } else {
    // Save changes
    const content = tinymce.get('company-description-editor').getContent();
    descText.innerHTML = content;
    descText.style.display = 'block';
    descForm.style.display = 'none';
    editSaveBtn.textContent = 'Edit';
    tinymce.get('company-description-editor').remove();
    isEditing = false;
    // TODO: Add AJAX here to save to backend if needed
  }
});
</script>