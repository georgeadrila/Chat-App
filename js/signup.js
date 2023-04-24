const form = document.querySelector(".signup form"),
      continueBtn = form.querySelector(".button input"),
      errorText = form.querySelector(".error-txt");

form.onsubmit = (e) => {
  e.preventDefault(); //preventing form from submitting
}

continueBtn.onclick = () => {
  // lets start with ajax
  let xhr = new XMLHttpRequest(); //creating new xml object
  xhr.open("POST", "php/signup.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (data == "success") {
          location.href = "users.php";
        } else {
          errorText.textContent = data;
          errorText.style.display = "block";
        }
      }
    }
  }

  // sending form data to php thru ajax
  let formData = new FormData(form); //creating new formdate obj
  xhr.send(formData);
};
