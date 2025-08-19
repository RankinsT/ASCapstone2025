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
      if (bar) {
        bar.textContent = `${Math.round(
          ((index + 1) / quoteContainers.length) * 100
        )}%`;
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
