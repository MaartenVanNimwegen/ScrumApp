var survey_options = document.getElementById('ScrumgrooupAddUsers');
var add_more_fields = document.getElementById('add_more_fields');
var remove_fields = document.getElementById('remove_fields');

add_more_fields.onclick = function(){
  var newField = document.createElement('input');
  newField.setAttribute('type','text');
  newField.setAttribute('name','ScrumgroepLeden[]');
  newField.setAttribute('class','survey_options');
  newField.setAttribute('siz',50);
  newField.setAttribute('placeholder','LeerlingNaam');
  survey_options.appendChild(newField);
  var newField = document.createElement('br');
  survey_options.appendChild(newField);
}

remove_fields.onclick = function(){
  var input_tags = survey_options.getElementsByTagName('input');
  if(input_tags.length > 1) {
    survey_options.removeChild(input_tags[(input_tags.length) - 1]);
    var br_tags = survey_options.getElementsByTagName('br');
  }
  if(br_tags.length > 1) {
    survey_options.removeChild(br_tags[(br_tags.length) - 1]);
  }
}

function AddScrumgroepPopup() {
    var popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
}

function CloseAddScrumgroepPopup() {
    var popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
}

const searchWrapper = document.querySelector(".search-input");
const inputBox = searchWrapper.querySelector("input");
const suggBox = searchWrapper.querySelector(".autocom-box");
let linkTag = searchWrapper.querySelector("a");
let webLink;
inputBox.onkeyup = (e)=>{
    let userData = e.target.value; 
    let emptyArray = [];
    if(userData){
        emptyArray = suggestions.filter((data)=>{
            //filtering array value and user characters to lowercase and return only those words which are start with user enetered chars
            return data.toLocaleLowerCase().startsWith(userData.toLocaleLowerCase());
        });
        emptyArray = emptyArray.map((data)=>{
            // passing return data inside li tag
            return data = `<li>${data}</li>`;
        });
        searchWrapper.classList.add("active"); //show autocomplete box
        showSuggestions(emptyArray);
        let allList = suggBox.querySelectorAll("li");
        for (let i = 0; i < allList.length; i++) {
            //adding onclick attribute in all li tag
            allList[i].setAttribute("onclick", "select(this)");
        }
    }else{
        searchWrapper.classList.remove("active"); //hide autocomplete box
    }
}


let suggestions = [
    "Maarten",
    "Martijn",
    "CodingNepal",
    "YouTube",
    "YouTuber",
    "YouTube Channel",
    "Blogger",
    "Bollywood",
    "Vlogger",
    "Vechiles",
    "Facebook",
    "Freelancer",
    "Facebook Page",
    "Designer",
    "Developer",
    "Web Designer",
    "Web Developer",
    "Login Form in HTML & CSS",
    "How to learn HTML & CSS",
    "How to learn JavaScript",
    "How to became Freelancer",
    "How to became Web Designer",
    "How to start Gaming Channel",
    "How to start YouTube Channel",
    "What does HTML stands for?",
    "What does CSS stands for?",
];