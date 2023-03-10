{/* <script> */}
var ScrumgroepUsers = document.getElementById('ScrumgroupAddUsers');
var add_more_fields = document.getElementById('add_more_fields');
var remove_fields = document.getElementById('remove_fields');
let searchWrapperArray = document.querySelectorAll(".search-input");
//let searchWrapperArray = Array.from(searchWrapperArray1);

add_more_fields.onclick = function () {
    var newDiv = document.createElement('div')
    newDiv.setAttribute('class', 'search-input');
    newDiv.setAttribute('id', 'ScrumgroupAddUser');
    ScrumgroepUsers.appendChild(newDiv);

    var newUser = document.createElement('input');
    newUser.setAttribute('type', 'text');
    newUser.setAttribute('name', 'ScrumgroepLeden[]');
    newUser.setAttribute('class', 'AddScrumgroupUsers');
    newUser.setAttribute('placeholder', 'LeerlingNaam');
    newDiv.appendChild(newUser);
    var newAutocomDiv = document.createElement('div');
    newAutocomDiv.setAttribute('class', 'autocom-box');
    newDiv.appendChild(newAutocomDiv);
}

remove_fields.onclick = function () {
    var input_tags = ScrumgroepUsers.getElementsByTagName('input');
    if (input_tags.length > 1) {
        ScrumgroepUsers.removeChild(input_tags[(input_tags.length) - 1]);
        var br_tags = ScrumgroepUsers.getElementsByTagName('br');
    }
    if (br_tags.length > 1) {
        ScrumgroepUsers.removeChild(br_tags[(br_tags.length) - 1]);
    }
}


function select(element) {
    let selectData = element.textContent;
    const collection = element.parentElement.parentElement.children;
    for (let i = 0; i < collection.length; i++) {
      const input = collection[i].querySelector('input');
      if (input === element.parentElement.previousElementSibling) {
        input.value = selectData;
      }
    }
    element.parentElement.classList.remove("active");
    const SuggBoxChildren = element.parentElement.children;
    for (let i = 0; i < SuggBoxChildren.length;) {
      SuggBoxChildren[i].remove();
    }
  }
function searchWrapperForEach(searchWrapperArray) {
    searchWrapperArray.forEach(searchWrapper => {
        var inputBox = searchWrapper.querySelector("input");
        var suggBox = searchWrapper.querySelector(".autocom-box");

        function showSuggestions(list, suggBox) {
            let listData;
            if (!list.length) {
                userValue = inputBox.value;
                listData = `<li>${userValue}</li>`;
            } else {
                listData = list.join('');
            }
            suggBox.innerHTML = listData;
        }

        inputBox.onkeyup = (e) => {
            let userData = e.target.value;
            console.log(suggBox, inputBox);
            let emptyArray = [];
            if (userData) {
                emptyArray = suggestions.filter((data) => {
                    //filtering array value and user characters to lowercase and return only those words which are start with user enetered chars
                    return data.toLocaleLowerCase().startsWith(userData.toLocaleLowerCase());
                });
                emptyArray = emptyArray.map((data) => {
                    // passing return data inside li tag
                    return data = `<li>${data}</li>`;
                });
                searchWrapper.classList.add("active"); //show autocomplete box
                showSuggestions(emptyArray, suggBox);
                let allList = suggBox.querySelectorAll("li");
                for (let i = 0; i < allList.length; i++) {
                    //adding onclick attribute in all li tag
                    allList[i].setAttribute("onclick", "select(this)");
                }
            } else {
                searchWrapper.classList.remove("active"); //hide autocomplete box
            }
        }

    });
}
//searchWrapper = searchWrapperArray[0];
let suggestions = [
    // <?php 
    //     $stmt = $conn->prepare("SELECT * FROM users");
    //     $stmt->execute();
    //     $sql = $stmt->get_result();
    //     $sql = $sql->fetch_all();
    //     $stmt->close();

    //     foreach ($sql as $row)
    // {
    //     ?>
    //     "<?php $row['1'] ?> "
    //     <?php
    // }
    // ?>,
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

function AddScrumgroepPopup() {
    var popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
}

function CloseAddScrumgroepPopup() {
    var popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
}

searchWrapperForEach(searchWrapperArray);

// </script>