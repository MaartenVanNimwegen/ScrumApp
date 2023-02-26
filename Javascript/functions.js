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
     // convert the NodeList to an array using Array.from()
     searchWrapperArray = Array.from(searchWrapperArray);

     // push the newDiv into the array
     searchWrapperArray.push(newDiv);
     searchWrapperForEach(searchWrapperArray)

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