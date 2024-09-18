<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inline Editing</title>
<style>
    #user_profile input[type="text"] {
        width: 150px;
    }
</style>
</head>
<body>

<div id="user_profile">
    <span id="firstname">John</span>
    <span id="lastname">Doe</span>
    <button onclick="enableEditing()">Edit</button>
</div>

<script>
function enableEditing() {
    var firstNameSpan = document.getElementById('firstname');
    var lastNameSpan = document.getElementById('lastname');
    
    // Create input fields
    var firstNameInput = document.createElement('input');
    firstNameInput.type = 'text';
    firstNameInput.value = firstNameSpan.innerText;
    
    var lastNameInput = document.createElement('input');
    lastNameInput.type = 'text';
    lastNameInput.value = lastNameSpan.innerText;
    
    // Replace spans with input fields
    firstNameSpan.parentNode.replaceChild(firstNameInput, firstNameSpan);
    lastNameSpan.parentNode.replaceChild(lastNameInput, lastNameSpan);
    
    // Change button text and functionality
    var editButton = document.querySelector('button');
    editButton.innerText = 'Save';
    editButton.onclick = saveChanges;
}

function saveChanges() {
    var firstNameInput = document.querySelector('#user_profile input[type="text"]:nth-child(1)');
    var lastNameInput = document.querySelector('#user_profile input[type="text"]:nth-child(2)');
    
    var newFirstName = firstNameInput.value;
    var newLastName = lastNameInput.value;
    
    // For demonstration, we'll just log the new names
    console.log('New First Name:', newFirstName);
    console.log('New Last Name:', newLastName);
    
    // Replace input fields with spans
    var firstNameSpan = document.createElement('span');
    firstNameSpan.id = 'firstname';
    firstNameSpan.innerText = newFirstName;
    
    var lastNameSpan = document.createElement('span');
    lastNameSpan.id = 'lastname';
    lastNameSpan.innerText = newLastName;
    
    firstNameInput.parentNode.replaceChild(firstNameSpan, firstNameInput);
    lastNameInput.parentNode.replaceChild(lastNameSpan, lastNameInput);
    
    // Change button text and functionality back to edit
    var editButton = document.querySelector('button');
    editButton.innerText = 'Edit';
    editButton.onclick = enableEditing;
}
</script>

</body>
</html>
