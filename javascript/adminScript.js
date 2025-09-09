// JavaScript function to collect customer data through browser prompts and submit via form
function showAddCustomerForm() {
  Swal.fire({
    title: "Add Customer",
    html:
      '<input id="swal-firstName" class="swal2-input" placeholder="First Name">' +
      '<input id="swal-lastName" class="swal2-input" placeholder="Last Name">' +
      '<input id="swal-phone" class="swal2-input" placeholder="Phone (e.g. 555-555-5555)">' +
      '<input id="swal-email" class="swal2-input" placeholder="Email">' +
      '<input id="swal-street" class="swal2-input" placeholder="Street Address">' +
      '<input id="swal-apt" class="swal2-input" placeholder="Apt/Unit (optional)">' +
      '<input id="swal-city" class="swal2-input" placeholder="City">' +
      '<input id="swal-state" class="swal2-input" placeholder="State">' +
      '<input id="swal-zip" class="swal2-input" placeholder="Zipcode">' +
      '<input id="swal-serviceRequested" class="swal2-input" placeholder="Service Requested">' +
      '<input id="swal-notes" class="swal2-input" placeholder="Notes (optional)">',
    focusConfirm: false,
    showCancelButton: true,
    preConfirm: () => {
      const firstName = document.getElementById("swal-firstName").value.trim();
      const lastName = document.getElementById("swal-lastName").value.trim();
      const phone = document.getElementById("swal-phone").value.trim();
      const email = document.getElementById("swal-email").value.trim();
      const street = document.getElementById("swal-street").value.trim();
      const apt = document.getElementById("swal-apt").value.trim();
      const city = document.getElementById("swal-city").value.trim();
      const state = document.getElementById("swal-state").value.trim();
      const zip = document.getElementById("swal-zip").value.trim();
      const serviceRequested = document
        .getElementById("swal-serviceRequested")
        .value.trim();
      const notes = document.getElementById("swal-notes").value.trim();
      // Basic validation
      if (
        !firstName ||
        !lastName ||
        !phone ||
        !email ||
        !street ||
        !city ||
        !state ||
        !zip
      ) {
        Swal.showValidationMessage("Please fill out all required fields.");
        return false;
      }
      const phoneRegex = /^\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}$/;
      if (!phoneRegex.test(phone)) {
        Swal.showValidationMessage("Invalid phone number.");
        return false;
      }
      const emailRegex = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
      if (!emailRegex.test(email)) {
        Swal.showValidationMessage("Invalid email address.");
        return false;
      }
      const zipRegex = /^\d{5}$/;
      if (!zipRegex.test(zip)) {
        Swal.showValidationMessage("Invalid zipcode.");
        return false;
      }
      return {
        firstName,
        lastName,
        phoneNumber: phone,
        email,
        street,
        apt,
        city,
        state,
        zipcode: zip,
        serviceRequested,
        notes,
      };
    },
  }).then((result) => {
    if (result.isConfirmed && result.value) {
      // Create and submit a hidden form
      const form = document.createElement("form");
      form.method = "POST";
      form.style.display = "none";
      const fields = { addCustomer: "1", ...result.value };
      Object.entries(fields).forEach(([name, value]) => {
        const input = document.createElement("input");
        input.type = "hidden";
        input.name = name;
        input.value = value;
        form.appendChild(input);
      });
      document.body.appendChild(form);
      form.submit();
    }
  });
  // phoneNumber: phoneNumber,
  // User's entered email address
  // email: email,
  // User's entered street address
  // street: street,
  // Use entered apartment or empty string if null (|| is logical OR operator)
  // apt: apt || "",
  // User's entered city
  // city: city,
  // User's entered state
  // state: state,
  // User's entered zipcode
  // zipcode: zipcode,
  // Use entered notes or empty string if null
  // notes: notes || "",
  // };

  // Loop through each field name and value in the fields object
  // Object.entries() converts object to array of [key, value] pairs
  // Destructuring assignment extracts name and value from each pair
  // for (const [name, value] of Object.entries(fields)) {
  // Create a new hidden input element for each field
  // const input = document.createElement("input");
  // Set input type to hidden (won't be visible to user)
  // input.type = "hidden";
  // Set the name attribute (this becomes the $_POST key in PHP)
  // input.name = name;
  // Set the value attribute (this becomes the $_POST value in PHP)
  // input.value = value;
  // Add this input element as a child of the form
  // form.appendChild(input);
  // }

  // Add the completed form to the document body (makes it part of the page)
  // document.body.appendChild(form);
  // Trigger form submission, which sends all the hidden inputs via POST to the server
  // form.submit();
  // Swal.fire({
  //   title: "Enter First Name:",
  //   input: "text",
  //   inputValue: customer.firstName || "",
  //   showCancelButton: true,
  //   inputValidator: (value) => {
  //     if (!value) {
  //       return "First name is required!";
  //     }
  //   },
  // }).then((firstResult) => {
  //   if (!firstResult.isConfirmed) return;
  //   const firstName = firstResult.value;
  //   Swal.fire({
  //     title: "Enter Last Name:",
  //     input: "text",
  //     inputValue: customer.lastName || "",
  //     showCancelButton: true,
  //     inputValidator: (value) => {
  //       if (!value) {
  //         return "Last name is required!";
  //       }
  //     },
  //   }).then((lastResult) => {
  //     if (!lastResult.isConfirmed) return;
  //     const lastName = lastResult.value;
  //     const phoneRegex = /^\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}$/;
  //     Swal.fire({
  //       title: "Enter Phone Number:",
  //       input: "text",
  //       inputValue: customer.phoneNumber || "",
  //       showCancelButton: true,
  //       inputValidator: (value) => {
  //         if (!value) {
  //           return "Phone number is required!";
  //         }
  //         if (!phoneRegex.test(value)) {
  //           return "Invalid phone number. Please enter a valid US phone number (e.g. 555-555-5555)";
  //         }
  //       },
  //     }).then((phoneResult) => {
  //       if (!phoneResult.isConfirmed) return;
  //       const phoneNumber = phoneResult.value;
  //       const emailRegex = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
  //       Swal.fire({
  //         title: "Enter Email:",
  //         input: "text",
  //         inputValue: customer.email || "",
  //         showCancelButton: true,
  //         inputValidator: (value) => {
  //           if (!value) {
  //             return "Email is required!";
  //           }
  //           if (!emailRegex.test(value)) {
  //             return "Invalid email address. Please enter a valid email.";
  //           }
  //         },
  //       }).then((emailResult) => {
  //         if (!emailResult.isConfirmed) return;
  //         const email = emailResult.value;
  //         // Continue chaining for other fields or proceed with form logic here
  //         // ...existing code...
  //       });
  //     });
  //   });
  // });
}

// JavaScript function to edit existing customer data with pre-filled prompts
// Takes customer object as parameter to pre-populate the form fields
function showEditCustomerForm(customer) {
  if (!customer) {
    Swal.fire("Error: No customer data provided");
    return;
  }
  Swal.fire({
    title: "Edit Customer",
    html:
      `<input id="swal-firstName" class="swal2-input" placeholder="First Name" value="${
        customer.firstName || ""
      }">` +
      `<input id="swal-lastName" class="swal2-input" placeholder="Last Name" value="${
        customer.lastName || ""
      }">` +
      `<input id="swal-phone" class="swal2-input" placeholder="Phone (e.g. 555-555-5555)" value="${
        customer.phoneNumber || ""
      }">` +
      `<input id="swal-email" class="swal2-input" placeholder="Email" value="${
        customer.email || ""
      }">` +
      `<input id="swal-street" class="swal2-input" placeholder="Street Address" value="${
        customer.street || ""
      }">` +
      `<input id="swal-apt" class="swal2-input" placeholder="Apt/Unit (optional)" value="${
        customer.apt || ""
      }">` +
      `<input id="swal-city" class="swal2-input" placeholder="City" value="${
        customer.city || ""
      }">` +
      `<input id="swal-state" class="swal2-input" placeholder="State" value="${
        customer.state || ""
      }">` +
      `<input id="swal-zip" class="swal2-input" placeholder="Zipcode" value="${
        customer.zipcode || ""
      }">` +
      `<input id="swal-serviceRequested" class="swal2-input" placeholder="Service Requested" value="${
        customer.serviceRequested || ""
      }">` +
      `<input id="swal-notes" class="swal2-input" placeholder="Notes (optional)" value="${
        customer.notes || ""
      }">`,
    focusConfirm: false,
    showCancelButton: true,
    preConfirm: () => {
      const firstName = document.getElementById("swal-firstName").value.trim();
      const lastName = document.getElementById("swal-lastName").value.trim();
      const phoneNumber = document.getElementById("swal-phone").value.trim();
      const email = document.getElementById("swal-email").value.trim();
      const street = document.getElementById("swal-street").value.trim();
      const apt = document.getElementById("swal-apt").value.trim();
      const city = document.getElementById("swal-city").value.trim();
      const state = document.getElementById("swal-state").value.trim();
      const zipcode = document.getElementById("swal-zip").value.trim();
      const serviceRequested = document
        .getElementById("swal-serviceRequested")
        .value.trim();
      const notes = document.getElementById("swal-notes").value.trim();
      if (
        !firstName ||
        !lastName ||
        !phoneNumber ||
        !email ||
        !street ||
        !city ||
        !state ||
        !zipcode
      ) {
        Swal.showValidationMessage("Please fill out all required fields.");
        return false;
      }
      const phoneRegex = /^\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}$/;
      if (!phoneRegex.test(phoneNumber)) {
        Swal.showValidationMessage("Invalid phone number.");
        return false;
      }
      const emailRegex = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
      if (!emailRegex.test(email)) {
        Swal.showValidationMessage("Invalid email address.");
        return false;
      }
      const zipRegex = /^\d{5}$/;
      if (!zipRegex.test(zipcode)) {
        Swal.showValidationMessage("Invalid zipcode.");
        return false;
      }
      return {
        editCustomer: "1",
        ID: customer.ID,
        firstName,
        lastName,
        phoneNumber,
        email,
        street,
        apt,
        city,
        state,
        zipcode,
        serviceRequested,
        notes,
      };
    },
  }).then((result) => {
    if (result.isConfirmed && result.value) {
      // Create and submit a hidden form
      const form = document.createElement("form");
      form.method = "POST";
      form.style.display = "none";
      Object.entries(result.value).forEach(([name, value]) => {
        const input = document.createElement("input");
        input.type = "hidden";
        input.name = name;
        input.value = value;
        form.appendChild(input);
      });
      document.body.appendChild(form);
      form.submit();
    }
  });
}

// function confirmDeleteAdmin() {

//     Swal.fire({

//       title: "Delete this admin? ",
//       text: "Warning! This account will be permanently deleted!",
//       icon: "warning",
//       showCancelButton: true,
//       confirmButtonColor: "#3085d6",
//       cancelButtonColor: "#d33",
//       confirmButtonText: "Yes, delete account."

//     })
//     .then((result) => {

//       if (result.isConfirmed) {

//         fetch("/deleteAdminView.php", {
//           method: "POST",
//           headers: { "Content-Type": "application/json" },
//           body: JSON.stringify({ adminID: adminID })
//         })
//         .then(res => {console.log(0); res.json()})
//         .then(data => {
//           if (data.success) {
//             Swal.fire({
//               title: "Deleted!",
//               text: "Account deleted.",
//               icon: "success"

//             });
//           }
//         })
//       }
//     })
// }

// tinymce function
function initEditableSection({
  editButtonId,
  textElementId,
  formId,
  editorId,
}) {
  let isEditing = false;

  const editBtn = document.getElementById(editButtonId);
  const textEl = document.getElementById(textElementId);
  const formEl = document.getElementById(formId);
  const editorEl = document.getElementById(editorId);

  editBtn.addEventListener("click", function () {
    if (!isEditing) {
      // Switch to edit mode
      editorEl.value = textEl.innerHTML;
      textEl.style.display = "none";
      formEl.style.display = "block";
      editBtn.textContent = "Save";

      tinymce.init({
        selector: `#${editorId}`,
        plugins:
          "anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount",
        toolbar:
          "undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat",

        // Allow selecting images from local device
        automatic_uploads: true,
        file_picker_types: "image",
        file_picker_callback: function (cb, value, meta) {
          let input = document.createElement("input");
          input.setAttribute("type", "file");
          input.setAttribute("accept", "image/*");

          input.onchange = function () {
            let file = this.files[0];
            let reader = new FileReader();

            reader.onload = function () {
              cb(reader.result, { title: file.name });
            };
            reader.readAsDataURL(file);
          };

          input.click();
        },

        setup: function (editor) {
          editor.on("init", function () {
            editor.setContent(textEl.innerHTML);
          });
        },
      });

      isEditing = true;
    } else {
      // Save changes
      const content = tinymce.get(editorId).getContent();
      textEl.innerHTML = content;
      textEl.style.display = "block";
      formEl.style.display = "none";
      editBtn.textContent = "Edit";
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
