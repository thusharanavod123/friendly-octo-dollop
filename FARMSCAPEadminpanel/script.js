let messages = [];
let currentEditIndex = null;

// Function to display messages
function displayMessages() {
    const messageList = document.getElementById("messageList");
    messageList.innerHTML = ''; // Clear the list before rendering

    messages.forEach((message, index) => {
        const li = document.createElement("li");

        // Message content container
        const messageContent = document.createElement("div");
        messageContent.className = "message-content";
        messageContent.textContent = message;

        // Edit Button
        const editBtn = document.createElement("button");
        editBtn.className = "edit-btn";
        editBtn.textContent = "Edit";
        editBtn.onclick = () => openEditPopup(index);

        // Delete Button
        const deleteBtn = document.createElement("button");
        deleteBtn.className = "delete-btn";
        deleteBtn.textContent = "Delete";
        deleteBtn.onclick = () => deleteMessage(index);

        // Append elements to list item
        li.appendChild(messageContent);
        li.appendChild(editBtn);
        li.appendChild(deleteBtn);

        // Add to the message list
        messageList.appendChild(li);
    });
}

// Send message
document.getElementById("sendMessageBtn").addEventListener("click", function () {
    const message = document.getElementById("messageBox").value;

    if (message) {
        messages.push(message); // Add the new message
        document.getElementById("messageBox").value = ''; // Clear the input box
        displayMessages(); // Display updated message list
    }
});

// Open the edit popup
function openEditPopup(index) {
    currentEditIndex = index; // Store the index of the message being edited
    const editPopup = document.getElementById("editPopup");
    const editMessageBox = document.getElementById("editMessageBox");

    // Set the current message in the edit box
    editMessageBox.value = messages[index];

    // Display the popup
    editPopup.classList.remove("hidden");
    editPopup.style.display = "block";
}

// Close the edit popup
function closeEditPopup() {
    const editPopup = document.getElementById("editPopup");
    editPopup.style.display = "none";
}

// Save edited message
document.getElementById("saveEditBtn").addEventListener("click", function () {
    const newMessage = document.getElementById("editMessageBox").value;

    if (newMessage !== null && newMessage.trim() !== "") {
        messages[currentEditIndex] = newMessage; // Update the message
        displayMessages(); // Refresh the message list
        closeEditPopup(); // Close the popup
    }
});

// Cancel edit
document.getElementById("cancelEditBtn").addEventListener("click", function () {
    closeEditPopup(); // Close the popup without saving
});

// Delete message
function deleteMessage(index) {
    messages.splice(index, 1); // Remove message from array
    displayMessages(); // Refresh the message list
}

// Example search logic (to be replaced by real data fetching)
document.getElementById("searchBtn").addEventListener("click", function () {
    const searchValue = document.getElementById("searchInput").value;
    const searchPopup = document.getElementById("searchPopup");
    const searchResults = document.getElementById("searchResults");

    // Simulated search result
    const mockResults = [
        "Farmer John - Needs help with irrigation",
        "Farmer Jane - Needs help with fertilizer",
        "Farmer Bob - Needs help with crop rotation"
    ];

    // Populate search results
    searchResults.innerHTML = '';
    mockResults.forEach(result => {
        const li = document.createElement("li");
        li.textContent = result;
        searchResults.appendChild(li);
    });

    // Display popup
    searchPopup.classList.remove("hidden");
    searchPopup.style.display = "block";
});

// Close search popup
document.querySelector(".close-popup").addEventListener("click", function () {
    const searchPopup = document.getElementById("searchPopup");
    searchPopup.style.display = "none";
});
