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
    const form = document.createElement('form');
    // Set the form's submission method to POST (required for $_POST in PHP)
    form.method = 'POST';
    // Hide the form so it doesn't appear on screen (invisible submission)
    form.style.display = 'none';
    
    // Create an object containing all the form field names and their values
    // This maps form field names to the data collected from prompts
    const fields = {
        // Flag to indicate this is an "add customer" operation
        'addCustomer': '1',
        // User's entered first name
        'firstName': firstName,
        // User's entered last name
        'lastName': lastName,
        // User's entered phone number
        'phoneNumber': phoneNumber,
        // User's entered email address
        'email': email,
        // User's entered street address
        'street': street,
        // Use entered apartment or empty string if null (|| is logical OR operator)
        'apt': apt || '',
        // User's entered city
        'city': city,
        // User's entered state
        'state': state,
        // User's entered zipcode
        'zipcode': zipcode,
        // Use entered notes or empty string if null
        'notes': notes || ''
    };
    
    // Loop through each field name and value in the fields object
    // Object.entries() converts object to array of [key, value] pairs
    // Destructuring assignment extracts name and value from each pair
    for (const [name, value] of Object.entries(fields)) {
        // Create a new hidden input element for each field
        const input = document.createElement('input');
        // Set input type to hidden (won't be visible to user)
        input.type = 'hidden';
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