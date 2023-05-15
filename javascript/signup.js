const form = document.querySelector(".signup form"),
continueBtn = form.querySelector(".button input"),
errorText = form.querySelector(".error-text")

form.onsubmit = (e)=>{
    e.preventDefault()
}

continueBtn.onclick = ()=>{
  let xhr = new XMLHttpRequest()
  xhr.open("POST", "php/signup", true)
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
      if(xhr.status === 200){
        let data = xhr.response.trim()
        if(data == "success"){
          location.href = "dashboard"
        }else{
          errorText.style.display = "block"
          errorText.textContent = data
        }
      }
    }
  }
  let formData = new FormData(form)
  xhr.send(formData)
}

const actualBtn = document.getElementById('image-subission-input');
const fileChosen = document.getElementById('file-chosen');

actualBtn.addEventListener('change', function(){
  fileChosen.textContent = 'Profile image: ' + this.files[0].name
})