const form = document.querySelector(".typing-area"),
  inputField = form.querySelector(".input-field"),
  sendBtn = form.querySelector("button"),
  chatBox = document.querySelector(".chat-box");
    

    form.onsubmit = (e) => {
        e.preventDefault(); //preventing form from submitting
      }

sendBtn.onclick = () => {
    // lets start with ajax
  let xhr = new XMLHttpRequest(); //creating new xml object
  xhr.open("POST", "php/insert-chat.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        inputField.value = ""; // clears input field
        scrollToBottom();
      }
    }
  }

  // sending form data to php thru ajax
  let formData = new FormData(form); //creating new formdate obj
  xhr.send(formData);
}

chatBox.onmouseenter = () => {
  chatBox.classList.add("active");
}
chatBox.onmouseleave = () => {
  chatBox.classList.remove("active");
}

setInterval(() => {
  // lets start with ajax
let xhr = new XMLHttpRequest(); //creating new xml object
xhr.open("POST", "php/get-chat.php", true);
xhr.onload = () => {
  if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
          let data = xhr.response;
        chatBox.innerHTML = data;
        if (!chatBox.classList.contains("active")) { 
          scrollToBottom();
        }
    }
  }   
  }
  // sending form data to php thru ajax
  let formData = new FormData(form); //creating new formdate obj
  xhr.send(formData);
}, 500);  //function will run in intervals 500ms


function scrollToBottom() {
  chatBox.scrollTop = chatBox.scrollHeight;
}