<?php
include('sidebar.php');
include('functions.php');
// include '../Javascript/scrumDashboard.php'
include('config/dbconn.php');
?>
<?php if (isset($_GET['deleteScrumgroupId'])) :
deleteScrumgroep($conn, $_GET['deleteScrumgroupId']);
endif; ?>

<?php if (isset($_GET['deleteUserId'])) :
deleteUserFromScrumgroup($conn, $_GET['deleteUserId']);
endif; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/Style.css">
    <title>Document</title>
</head>

<body>
    <div class="content">
    <?php if (isset($_GET['addUserId'])) : ?>
        <div class="SearchWrapper" id=ScrumgroupAddUsers>
            <div class="search-input" id=ScrumgroupAddUser>
                <form action="Handlers/AddUserScrumgroup.php?ScrumgroupId=<?= $_GET['addUserId'] ?>" method="post" enctype="multipart/form-data">
                    <a href="" target="_blank" hidden></a>
                    <input type="text" name="AddScrumgroupUser" class="AddScrumgroupUser" placeholder="Leerlingnaam" required><br>
                    <div class="autocom-box">
                    </div>
                    <input type="submit" name="submit" class="AddUserToScrumgroup">
                </form>
            </div>
        </div>

        <script src="Javascript/functions.js"></script>
    <?php endif; ?>
    <div class="popup" onclick="AddScrumgroepPopup()">Scrumgroep toevoegen</div>

    <div class="containerScrumDashboard" id="myPopup">
        <div class="ScrumgroepWijzigPopup">
            <form action="Handlers/ScrumgroepToevoeg.php" method="post" enctype="multipart/form-data">
                <div><input type="text" name="Scrumnaam" class="AddScrumgroupName" placeholder="Scrumgroepnaam" required> </div>
                <div><input type="text" name="ScrumProject" class="AddScrumgroupProject" placeholder="Project" required> </div>
                <div><input type="date" name="StartDate"></div>
                <div><input type="date" name="EndDate"></div>

                <div><input type="submit" name="submit" class="WijzigScrumgroepSubmit"></div>
            </form>

            <div class="WijzigScrumgroepClose" onclick="AddScrumgroepPopup()">Close</div>
        </div>
    </div>
    </div>
    </div>
    <div class="ScrumDashboardLayout">
        <?php
        $scrumgroupQuery = getScrumgroups($conn);
        createScrumgroupObject($scrumgroupQuery, $conn);
        ?>
    </div>
    </div>
</body>
</html>

<script>
    var ScrumgroepUsers = document.getElementById('ScrumgroupAddUsers');
    var add_more_fields = document.getElementById('add_more_fields');
    var remove_fields = document.getElementById('remove_fields');
    let searchWrapper = document.querySelector(".search-input");
    var inputBox = searchWrapper.querySelector("input");
    var suggBox = searchWrapper.querySelector(".autocom-box");
    //let searchWrapperArray = Array.from(searchWrapperArray1);

    let suggestions = [

    ];
    <?php
    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();
    $sql = $stmt->get_result();
    $sql = $sql->fetch_all();
    $stmt->close();

    foreach ($sql as $row) {
    ?>

        suggestions.push("<?php echo "$row[1]"; ?>");

    <?php
    };
    ?>
    // add_more_fields.onclick = function() {
    //     var newDiv = document.createElement('div')
    //     newDiv.setAttribute('class', 'search-input');
    //     newDiv.setAttribute('id', 'ScrumgroupAddUser');
    //     ScrumgroepUsers.appendChild(newDiv);

    //     var newA = document.createElement('a');
    //     newA.href = ""
    //     newA.hidden = true;
    //     newDiv.appendChild(newA);
    //     newA.setAttribute('target', '_blank');
    //     var newUser = document.createElement('input');
    //     newUser.setAttribute('type', 'text');
    //     newUser.setAttribute('name', 'ScrumgroepLeden[]');
    //     newUser.setAttribute('class', 'AddScrumgroupUsers');
    //     newUser.setAttribute('placeholder', 'LeerlingNaam');
    //     newUser.required = true;
    //     newDiv.appendChild(newUser);
    //     var newAutocomDiv = document.createElement('div');
    //     newAutocomDiv.setAttribute('class', 'autocom-box');
    //     newDiv.appendChild(newAutocomDiv);
    //     searchWrapperForEach(searchWrapperArray);
    // }

    // remove_fields.onclick = function() {
    //     var input_tags = ScrumgroepUsers.getElementsByTagName('input');
    //     if (input_tags.length > 1) {
    //         ScrumgroepUsers.removeChild(input_tags[(input_tags.length) - 1]);
    //         var br_tags = ScrumgroepUsers.getElementsByTagName('br');
    //     }
    //     if (br_tags.length > 1) {
    //         ScrumgroepUsers.removeChild(br_tags[(br_tags.length) - 1]);
    //     }
    // }


    function select(element) {
        let selectData = element.textContent;
        const input = element.parentElement.parentElement.querySelector('input');
        input.value = selectData;

        element.parentElement.classList.remove("active");
        const SuggBoxChildren = element.parentElement.children;
        for (let i = 0; i < SuggBoxChildren.length;) {
            SuggBoxChildren[i].remove();
        }
    }

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

    function AddScrumgroepPopup() {
        var popup = document.getElementById("myPopup");
        popup.classList.toggle("show");
    }

    function CloseAddScrumgroepPopup() {
        var popup = document.getElementById("myPopup");
        popup.classList.toggle("show");
    }
</script>
