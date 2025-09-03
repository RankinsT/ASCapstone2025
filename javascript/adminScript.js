import Swal from 'sweetalert2' //import sweetalert2 library

// JavaScript function to collect customer data through browser prompts and submit via form
function showAddCustomerForm() {
  // Display a prompt dialog asking user to enter first name
  // Returns the entered string or null if user clicks Cancel
  const firstName = prompt("Enter First Name:");
  // Check if user clicked Cancel (returns null), if so exit the function early
  if (firstName === null) return; // User cancelled

  // Display prompt for last name input
  const lastName = prompt("Enter Last Name:");
  // Exit early if user cancels last name entry
  if (lastName === null) return;

  // Display prompt for phone number input
  const phoneNumber = prompt("Enter Phone Number:");
  // Exit early if user cancels phone number entry
  if (phoneNumber === null) return;

  // Display prompt for email address input
  const email = prompt("Enter Email:");
  // Exit early if user cancels email entry
  if (email === null) return;

  // Display prompt for street address input
  const street = prompt("Enter Street Address:");
  // Exit early if user cancels street address entry
  if (street === null) return;

  // Display prompt for apartment/unit (this field is optional)
  // Note: No null check here, so user can skip this field
  const apt = prompt("Enter Apartment/Unit (optional):");

  // Display prompt for city input
  const city = prompt("Enter City:");
  // Exit early if user cancels city entry
  if (city === null) return;

  // Display prompt for state input
  const state = prompt("Enter State:");
  // Exit early if user cancels state entry
  if (state === null) return;

  // Display prompt for zipcode input
  const zipcode = prompt("Enter Zipcode:");
  // Exit early if user cancels zipcode entry
  if (zipcode === null) return;

  // Display prompt for notes (this field is optional)
  // Note: No null check here, so user can skip this field
  const notes = prompt("Enter Notes (optional):");

  // Create a new HTML form element dynamically in memory
  // This form will be used to submit the collected data to the server
  const form = document.createElement("form");
  // Set the form's submission method to POST (required for $_POST in PHP)
  form.method = "POST";
  // Hide the form so it doesn't appear on screen (invisible submission)
  form.style.display = "none";

  // Create an object containing all the form field names and their values
  // This maps form field names to the data collected from prompts
  const fields = {
    // Flag to indicate this is an "add customer" operation
    addCustomer: "1",
    // User's entered first name
    firstName: firstName,
    // User's entered last name
    lastName: lastName,
    // User's entered phone number
    phoneNumber: phoneNumber,
    // User's entered email address
    email: email,
    // User's entered street address
    street: street,
    // Use entered apartment or empty string if null (|| is logical OR operator)
    apt: apt || "",
    // User's entered city
    city: city,
    // User's entered state
    state: state,
    // User's entered zipcode
    zipcode: zipcode,
    // Use entered notes or empty string if null
    notes: notes || "",
  };

  // Loop through each field name and value in the fields object
  // Object.entries() converts object to array of [key, value] pairs
  // Destructuring assignment extracts name and value from each pair
  for (const [name, value] of Object.entries(fields)) {
    // Create a new hidden input element for each field
    const input = document.createElement("input");
    // Set input type to hidden (won't be visible to user)
    input.type = "hidden";
    // Set the name attribute (this becomes the $_POST key in PHP)
    input.name = name;
    // Set the value attribute (this becomes the $_POST value in PHP)
    input.value = value;
    // Add this input element as a child of the form
    form.appendChild(input);
  }

  // Add the completed form to the document body (makes it part of the page)
  document.body.appendChild(form);
  // Trigger form submission, which sends all the hidden inputs via POST to the server
  form.submit();
}

// JavaScript function to edit existing customer data with pre-filled prompts
// Takes customer object as parameter to pre-populate the form fields
function showEditCustomerForm(customer) {
  // Debug: Log the customer object to see what data we're receiving
  console.log("Customer data received:", customer);

  // Check if customer object exists and has data
  if (!customer) {
    alert("Error: No customer data provided");
    return;
  }

  // Display prompt with current first name pre-filled as default value
  // Second parameter of prompt() sets the default text in the input box
  const firstName = prompt("Enter First Name:", customer.firstName || "");
  // Exit early if user clicks Cancel (returns null)
  if (firstName === null) return; // User cancelled

  // Display prompt with current last name pre-filled
  const lastName = prompt("Enter Last Name:", customer.lastName || "");
  // Exit early if user cancels last name entry
  if (lastName === null) return;

  // Display prompt with current phone number pre-filled
  const phoneNumber = prompt("Enter Phone Number:", customer.phoneNumber || "");
  // Exit early if user cancels phone number entry
  if (phoneNumber === null) return;

  // Display prompt with current email pre-filled
  const email = prompt("Enter Email:", customer.email || "");
  // Exit early if user cancels email entry
  if (email === null) return;

  // Display prompt with current street address pre-filled
  const street = prompt("Enter Street Address:", customer.street || "");
  // Exit early if user cancels street address entry
  if (street === null) return;

  // Display prompt with current apartment/unit pre-filled (optional field)
  const apt = prompt("Enter Apartment/Unit (optional):", customer.apt || "");

  // Display prompt with current city pre-filled
  const city = prompt("Enter City:", customer.city || "");
  // Exit early if user cancels city entry
  if (city === null) return;

  // Display prompt with current state pre-filled
  const state = prompt("Enter State:", customer.state || "");
  // Exit early if user cancels state entry
  if (state === null) return;

  // Display prompt with current zipcode pre-filled
  const zipcode = prompt("Enter Zipcode:", customer.zipcode || "");
  // Exit early if user cancels zipcode entry
  if (zipcode === null) return;

  // Display prompt with current notes pre-filled (optional field)
  const notes = prompt("Enter Notes (optional):", customer.notes || "");

  // Create object with all form fields including customer ID for database update
  const fields = {
    editCustomer: "1", // Flag to indicate this is an "edit customer" operation
    customerID: customer.ID, // Include customer ID so PHP knows which record to update
    firstName: firstName,
    lastName: lastName,
    phoneNumber: phoneNumber,
    email: email,
    street: street,
    apt: apt || "", // Use entered apartment or empty string if null
    city: city,
    state: state,
    zipcode: zipcode,
    notes: notes || "", // Use entered notes or empty string if null
  };

  // Create hidden form element for submission
  const form = document.createElement("form");
  // Set form method to POST for server processing
  form.method = "POST";
  // Hide the form from user view (invisible submission)
  form.style.display = "none"; // Hide the form

  // Loop through all field names and values to create hidden inputs
  for (const [name, value] of Object.entries(fields)) {
    // Create a hidden input element for each field
    const input = document.createElement("input");
    // Set input type to hidden (not visible to user)
    input.type = "hidden";
    // Set the name attribute (becomes $_POST key in PHP)
    input.name = name;
    // Set the value attribute (becomes $_POST value in PHP)
    input.value = value;
    // Add this input as child element to the form
    form.appendChild(input);
  }

  // Add the completed form to the document body (makes it part of the page)
  document.body.appendChild(form);
  // Submit the form programmatically (sends data to server)
  form.submit();
}

function confirmDeleteAdmin() {

  document.addEventListener('DOMContentLoaded', function () {
    const delAdminBtn = document.getElementById('delete-admin');
  })

  delAdminBtn.addEventListener('submit', () => {

    Swal.fire({

      title: "Delete '{$username}?' ",
      text: "This account will be permanently deleted!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete account."

    })
    .then((result) => {

      if (result.isConfirmed) {
        
        fetch("/deleteAdminView.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ adminID: adminID })

        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            Swal.fire({
              title: "Deleted!",
              text: "Account deleted.",
              icon: "success"
    
            });
          }
        })
      }
    })
    .catch(error => {
      Swal.fire({
        title: "Error: ",
      })
    })
  })
}

// tinymce function
function initEditableSection({
  editButtonId,
  textElementId,
  formId,
  editorId
}) {
  let isEditing = false;

  const editBtn = document.getElementById(editButtonId);
  const textEl = document.getElementById(textElementId);
  const formEl = document.getElementById(formId);
  const editorEl = document.getElementById(editorId);

  editBtn.addEventListener('click', function() {
    if (!isEditing) {
      // Switch to edit mode
      editorEl.value = textEl.innerHTML;
      textEl.style.display = 'none';
      formEl.style.display = 'block';
      editBtn.textContent = 'Save';

      tinymce.init({
        selector: `#${editorId}`,
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',

        // Allow selecting images from local device
        automatic_uploads: true,
        file_picker_types: 'image',
        file_picker_callback: function(cb, value, meta) {
          let input = document.createElement('input');
          input.setAttribute('type', 'file');
          input.setAttribute('accept', 'image/*');

          input.onchange = function() {
            let file = this.files[0];
            let reader = new FileReader();

            reader.onload = function() {
              cb(reader.result, { title: file.name });
            };
            reader.readAsDataURL(file);
          };

          input.click();
        },

        setup: function(editor) {
          editor.on('init', function() {
            editor.setContent(textEl.innerHTML);
          });
        }
      });

      isEditing = true;
    } else {
      // Save changes
      const content = tinymce.get(editorId).getContent();
      textEl.innerHTML = content;
      textEl.style.display = 'block';
      formEl.style.display = 'none';
      editBtn.textContent = 'Edit';
      tinymce.get(editorId).remove();
      isEditing = false;

      // TODO: Add AJAX save if needed
    }
  });
}
// how to call
// initEditableSection({
//   editButtonId: 'reviews-edit-save-btn',
//   textElementId: 'reviews-text',
//   formId: 'reviews-form',
//   editorId: 'reviews-editor'
// });
