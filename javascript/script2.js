// logo
document.addEventListener("DOMContentLoaded", function () {
  const logo = document.querySelector(".logo-img");
  console.log("Logo element:", logo);
  window.addEventListener("scroll", function () {
    console.log("Scroll event fired, scrollY:", window.scrollY);
    if (window.scrollY > 0) {
      logo.classList.add("hide-on-scroll");
      console.log("Added hide-on-scroll");
    } else {
      logo.classList.remove("hide-on-scroll");
      console.log("Removed hide-on-scroll");
    }
  });
});

// form
document.addEventListener("DOMContentLoaded", function () {
  const quoteContainers = document.querySelectorAll(".quote-container");
  let currentStep = 0;

  function updateProgressBars() {
    // Update all progression bars in visible step
    quoteContainers.forEach((container, index) => {
      const bar = container.querySelector(".progression-bar");
      const fill = bar ? bar.querySelector(".progression-bar-fill") : null;
      if (fill) {
        const percent = Math.round(
          ((index + 1) / quoteContainers.length) * 100
        );
        fill.style.width = percent + "%";
        fill.textContent = percent + "%";
      }
    });
  }

  function showCurrentStep() {
    quoteContainers.forEach((container, index) => {
      container.classList.toggle("quote-show", index === currentStep);
      container.classList.toggle("quote-hide", index !== currentStep);
    });
    updateProgressBars();
  }

  document.querySelectorAll(".form-btns-container button").forEach((button) => {
    button.addEventListener("click", function () {
      if (this.textContent.toLowerCase() === "next") {
        const visibleStep = quoteContainers[currentStep];
        const requiredFields = visibleStep.querySelectorAll(
          'input[required], select[required], textarea[required], select[name="service-requested[]"]'
        );
        let missing = [];
        requiredFields.forEach((field) => {
          if (field.tagName === "SELECT") {
            if (!field.selectedOptions.length) {
              missing.push("Service Requested");
            }
          } else if (!field.value.trim()) {
            missing.push(field.placeholder || field.name);
          }
        });
        if (missing.length > 0) {
          alert("Please fill out all required fields: " + missing.join(", "));
          return;
        }
        if (currentStep < quoteContainers.length - 1) {
          currentStep++;
          showCurrentStep();
        }
      } else if (this.textContent.toLowerCase() === "previous") {
        if (currentStep > 0) {
          currentStep--;
          showCurrentStep();
        }
      }
    });
  });

  showCurrentStep();

  // Only one form per quote section, so use querySelector
  const form = document.querySelector(".form form");
  if (form) {
    form.addEventListener("submit", function (e) {
      // Only validate fields in the currently visible step
      const visibleStep = form.querySelector(".quote-container.quote-show");
      const requiredFields = visibleStep
        ? visibleStep.querySelectorAll(
            'input[required], select[required], textarea[required], select[name="service-requested[]"]'
          )
        : [];
      let missing = [];
      requiredFields.forEach((field) => {
        if (field.tagName === "SELECT") {
          if (!field.selectedOptions.length) {
            missing.push("Service Requested");
          }
        } else if (!field.value.trim()) {
          missing.push(field.placeholder || field.name);
        }
      });
      if (missing.length > 0) {
        e.preventDefault();
        alert("Please fill out all required fields: " + missing.join(", "));
      }
    });
  }
});

$(document).ready(function () {
  $("#service-requested").select2({
    placeholder: "Select services",
    allowClear: true,
  });
});

// description
let isEditing = false;
const editSaveBtn = document.getElementById("edit-save-btn");
const descText = document.getElementById("company-description-text");
const descForm = document.getElementById("company-description-form");
const descEditor = document.getElementById("company-description-editor");

editSaveBtn.addEventListener("click", function () {
  if (!isEditing) {
    // Switch to edit mode
    descEditor.value = descText.innerHTML;
    descText.style.display = "none";
    descForm.style.display = "block";
    editSaveBtn.textContent = "Save";

    tinymce.init({
      selector: "#company-description-editor",
      plugins:
        "anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount",
      toolbar:
        "undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat",

      // Enable image upload from local device
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
          editor.setContent(descText.innerHTML);
        });
      },
    });

    isEditing = true;
  } else {
    // Save changes
    const content = tinymce.get("company-description-editor").getContent();
    descText.innerHTML = content;
    descText.style.display = "block";
    descForm.style.display = "none";
    editSaveBtn.textContent = "Edit";
    tinymce.get("company-description-editor").remove();
    isEditing = false;

    // TODO: Add AJAX here to save to backend if needed
  }
});
