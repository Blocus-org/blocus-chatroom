const searchBar = document.querySelector(".search input"),
searchIcon = document.querySelector(".search button"),
usersList = document.querySelector(".users-list")

searchIcon.onclick = ()=>{
  refreshList()
  searchBar.classList.toggle("show")
  searchIcon.classList.toggle("active")
  searchBar.focus()
  if(searchBar.classList.contains("active")){
    searchBar.value = ""
    searchBar.classList.remove("active")
  }
}

searchBar.onkeyup = ()=>{
  refreshList()
  let searchTerm = searchBar.value
  if(searchTerm != ""){
    searchBar.classList.add("active")
  }else{
    searchBar.classList.remove("active")
  }
  let xhr = new XMLHttpRequest()
  xhr.open("POST", "php/search", true)
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          let data = xhr.response
          usersList.innerHTML = data
        }
    }
  }
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
  xhr.send("searchTerm=" + searchTerm)
}

const refreshList = () =>{
  let xhr = new XMLHttpRequest()
  xhr.open("GET", "php/users", true)
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          let data = xhr.response
          if(!searchBar.classList.contains("active")){
            usersList.innerHTML = data
          }
        }
    }
  }
  xhr.send()
}

refreshList()
setInterval(refreshList, 1000)