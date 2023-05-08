const form = document.querySelector(".typing-area"),
incoming_id = form.querySelector(".incoming_id").value,
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box")
chatBoxScrollMode = document.getElementById("chatbox-scroll-mode")

form.onsubmit = (e)=>{
    e.preventDefault()
}

inputField.focus();
inputField.onkeyup = ()=>{
    refreshMessages()
    scrollToBottom()
    if(inputField.value !== ""){
        sendBtn.classList.add("active")
    }else{
        sendBtn.classList.remove("active")
    }
}

inputField.onclick = ()=>{
    refreshMessages()
    if(inputField.value !== ""){
        sendBtn.classList.add("active")
    }else{
        sendBtn.classList.remove("active")
    }
}

sendBtn.onclick = ()=>{
    refreshMessages()
    let xhr = new XMLHttpRequest()
    xhr.open("POST", "php/insert-chat.php", true)
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              inputField.value = ""
              scrollToBottom()
          }
      }
    }
    let formData = new FormData(form)
    xhr.send(formData)
}
chatBox.onmouseenter = ()=>{
    setTimeout(function() {}, 10)
    chatBox.classList.add("active")
    chatBoxScrollMode.innerHTML = 'keep your mouse inside the chat box or touch it to scroll'
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active")
    chatBoxScrollMode.innerHTML = ""
}

const refreshMessages = () =>{
    let xhr = new XMLHttpRequest()
    xhr.open("POST", "php/get-chat.php", true)
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response
            chatBox.innerHTML = data
            if(!chatBox.classList.contains("active")){
                scrollToBottom()
              }
          }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    xhr.send("incoming_id="+incoming_id)
}

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight
    if(inputField.value !== ""){
        sendBtn.classList.add("active")
    }else{
        sendBtn.classList.remove("active")
    }
}

refreshMessages()
scrollToBottom()
setInterval(refreshMessages, 1000)