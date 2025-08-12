<script>
  tinymce.init({
    selector: 'textarea',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
  });
</script>

<?php if (isset($_POST['edit-homepage-button'])): ?>
    <textarea>
    Welcome to TinyMCE!
    </textarea>
    <button type="submit" class="save-changes-button">Save Changes</button>
<?php else: ?>
    <p>Welcome to TinyMCE!</p>
<?php endif; ?>