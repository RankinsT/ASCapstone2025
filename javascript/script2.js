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
    // Update all custom ball progress bars in visible step
    quoteContainers.forEach((container, index) => {
      const barBalls = container.querySelector(".progression-bar-balls");
      if (barBalls) {
        const balls = barBalls.querySelectorAll(".progress-ball");
        const lines = barBalls.querySelectorAll(".progress-bar-line");
        balls.forEach((ball, i) => {
          ball.classList.remove("active", "complete");
          if (i === currentStep) {
            ball.classList.add("active");
          } else if (i < currentStep) {
            ball.classList.add("complete");
          }
        });
        lines.forEach((line, i) => {
          line.classList.remove("complete");
          if (i < currentStep) {
            line.classList.add("complete");
          }
        });
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

  document
    .querySelectorAll(".form-btns-container button, .get-started-btn .next-btn")
    .forEach((button) => {
      button.addEventListener("click", function () {
        const btnText = this.textContent.trim().toLowerCase();
        if (btnText === "next" || btnText === "get started") {
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
        } else if (btnText === "previous") {
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
// Generic edit-save for description
let isEditing = false;
const editSaveBtn = document.getElementById("edit-save-btn");
const descText = document.getElementById("company-description-text");
const descForm = document.getElementById("company-description-form");
const descEditor = document.getElementById("company-description-editor");

if (editSaveBtn) {
  editSaveBtn.addEventListener("click", function () {
    if (!isEditing) {
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
      const content = tinymce.get("company-description-editor").getContent();
      // AJAX to update company description (serviceId=1, type=desc)
      fetch("updateService.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `serviceId=0&type=desc&value=${encodeURIComponent(content)}`,
      })
        .then((res) => res.json())
        .then((data) => {
          console.log("Company description update response:", data);
          if (data.success) {
            descText.innerHTML = content;
            descText.style.display = "block";
            descForm.style.display = "none";
            editSaveBtn.textContent = "Edit";
            tinymce.get("company-description-editor").remove();
            isEditing = false;
          } else {
            alert(
              "Error saving description: " +
                (data.error || "Unknown error") +
                "\nDebug: " +
                JSON.stringify(data.debug)
            );
          }
        })
        .catch((err) => {
          console.error("Network error saving description", err);
          alert("Network error saving description");
        });
    }
  });
}

// Edit-save for service titles and descriptions
for (let i = 1; i <= 6; i++) {
  // Title
  const titleBtn = document.getElementById(`edit-save-title-btn-${i}`);
  const titleSpan = document.getElementById(`service-title-${i}`);
  const titleInput = document.getElementById(`service-title-input-${i}`);
  if (titleBtn && titleSpan && titleInput) {
    let editingTitle = false;
    titleBtn.addEventListener("click", function () {
      if (!editingTitle) {
        titleInput.value = titleSpan.textContent;
        titleSpan.style.display = "none";
        titleInput.style.display = "inline-block";
        titleBtn.textContent = "Save";
        editingTitle = true;
      } else {
        const newTitle = titleInput.value;
        // AJAX to update title
        fetch("updateService.php", {
          method: "POST",
          headers: { "Content-Type": "application/x-www-form-urlencoded" },
          body: `serviceId=${i}&type=title&value=${encodeURIComponent(
            newTitle
          )}`,
        })
          .then((res) => res.json())
          .then((data) => {
            console.log("Title update response:", data);
            if (data.success) {
              titleSpan.textContent = newTitle;
              titleSpan.style.display = "inline-block";
              titleInput.style.display = "none";
              titleBtn.textContent = "Edit";
              editingTitle = false;
            } else {
              alert(
                "Error saving title: " +
                  (data.error || "Unknown error") +
                  "\nDebug: " +
                  JSON.stringify(data.debug)
              );
            }
          })
          .catch((err) => {
            console.error("Network error saving title", err);
            alert("Network error saving title");
          });
      }
    });
  }
  // Description
  const descBtn = document.getElementById(`edit-save-desc-btn-${i}`);
  const descSpan = document.getElementById(`service-desc-${i}`);
  const descForm = document.getElementById(`service-desc-form-${i}`);
  const descEditorId = `service-desc-editor-${i}`;
  if (descBtn && descSpan && descForm) {
    let editingDesc = false;
    descBtn.addEventListener("click", function () {
      if (!editingDesc) {
        document.getElementById(descEditorId).value = descSpan.innerHTML;
        descSpan.style.display = "none";
        descForm.style.display = "block";
        descBtn.textContent = "Save";
        tinymce.init({
          selector: `#${descEditorId}`,
          plugins:
            "anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount",
          toolbar:
            "undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat",
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
              editor.setContent(descSpan.innerHTML);
            });
          },
        });
        editingDesc = true;
      } else {
        const content = tinymce.get(descEditorId).getContent();
        // AJAX to update description
        fetch("updateService.php", {
          method: "POST",
          headers: { "Content-Type": "application/x-www-form-urlencoded" },
          body: `serviceId=${i}&type=desc&value=${encodeURIComponent(content)}`,
        })
          .then((res) => res.json())
          .then((data) => {
            console.log("Desc update response:", data);
            if (data.success) {
              descSpan.innerHTML = content;
              descSpan.style.display = "block";
              descForm.style.display = "none";
              descBtn.textContent = "Edit";
              tinymce.get(descEditorId).remove();
              editingDesc = false;
            } else {
              alert(
                "Error saving description: " +
                  (data.error || "Unknown error") +
                  "\nDebug: " +
                  JSON.stringify(data.debug)
              );
            }
          })
          .catch((err) => {
            console.error("Network error saving description", err);
            alert("Network error saving description");
          });
      }
    });
  }
}
