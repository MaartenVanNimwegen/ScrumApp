<?php
include('sidebar.php');
include('Classes/scrumGroepClass.php');
include('Classes/user.php');
include('Handlers/Services.php');
include('Handlers/functions.php');
// include '../Javascript/scrumDashboard.php'
include('config/dbconn.php');

$groupService = new GroepServices($conn);

?>
<?php if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
    if ($filter == 'Active') {
        $Archived = 0;
    } elseif ($filter == 'Archived') {
        $Archived = 1;
    } else {
        $Archived = -1;
    }
} else {
    header('Location: scrumDashboard.php?filter=Alle');
}
?>
<?php if (isset($_GET['deleteScrumgroupId'])) :
    $groupService->DeleteScrumgroep($_GET['deleteScrumgroupId']);
endif; ?>

<?php if (isset($_GET['deleteUserId'])) :
    $groupService->DeleteUserFromScrumgroup($_GET['deleteUserId']);
endif; ?>

<?php if (isset($_GET['ScrummaserUserId']) && isset($_GET['ScrumgroupId'])) :
    $groupService->SelectScrummaster($_GET['ScrummaserUserId'], $_GET['ScrumgroupId']);
endif; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/Style.css">
    <style>
        html,
body,
.intro {
  height: 100%;
}

table td,
table th {
  text-overflow: ellipsis;
  white-space: nowrap;
  overflow: hidden;
}

thead th {
  color: #fff;
}

.card {
  border-radius: .5rem;
}

.table-scroll {
  border-radius: .5rem;
}

.table-scroll table thead th {
  font-size: 1.25rem;
}
thead {
  top: 0;
  position: sticky;
}
    </style>
    <title>Document</title>
</head>

<body>
    <div class="content">
        <select class="" onchange="location = this.value; value=' <?php $filter ?>'">
            <?php
                $groupService->ArchivedScrumgroupFilter($Archived);
            ?>
        </select>
        <?php if (isset($_GET['addUserId'])) : ?>
            <div class="SearchWrapper" id=ScrumgroupAddUsers>
                <div class="search-input" id=ScrumgroupAddUser>
                    <form autocomplete="off" action="Handlers/AddUserScrumgroup.php?ScrumgroupId=<?= $_GET['addUserId'] ?>" method="post" enctype="multipart/form-data">
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
        <div class="ScrumDashboardLayout">
            <?php
            $groupService->GetAllScrumgroups($Archived);
            ?>
        </div>
    </div>
    </div>
    <section class="intro">
  <div class="bg-image h-100" style="background-color: #f5f7fa;">
    <div class="mask d-flex align-items-center h-100">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card">
              <div class="card-body p-0">
                <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true">
                  <table class="table table-striped mb-0">
                    <thead style="background-color: #002d72;">
                      <tr>
                        <th scope="col">Scrumgroep</th>
                        <th scope="col">Project</th>
                        <th scope="col">Scrummaster</th>
                        <th scope="col">Startdatum</th>
                        <th scope="col">Einddatum</th>
                        <th scope="col">Leden</th>
                        <th scope="col">Einddatum</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Like a butterfly</td>
                        <td>Boxing</td>
                        <td>9:00 AM - 11:00 AM</td>
                        <td>Aaron Chapman</td>
                        <td>10</td>
                      </tr>
                      <tr>
                        <td>Mind &amp; Body</td>
                        <td>Yoga</td>
                        <td>8:00 AM - 9:00 AM</td>
                        <td>Adam Stewart</td>
                        <td>15</td>
                      </tr>
                      <tr>
                        <td>Crit Cardio</td>
                        <td>Gym</td>
                        <td>9:00 AM - 10:00 AM</td>
                        <td>Aaron Chapman</td>
                        <td>10</td>
                      </tr> 
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
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

    foreach ($sql as $row) : ?>

        suggestions.push("<?php echo "$row[1]"; ?>");

    <?php endforeach ?>


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