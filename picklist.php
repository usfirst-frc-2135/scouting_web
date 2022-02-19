<title>Pick List</title>
<?php include("header.php") ?>
<div class="container row-offcanvas row-offcanvas-left">
    <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
    <div class="row pt-3 pb-3 mb-3">
      <div class="card col-md-12">
        <div class="card-header">
            Settings
          </div>
          <div class="card-body">
          <div class="row justify-content-md-center">
              <div class="col-md-4 mt-1 mb-1">
                <select class="form-select" aria-label="Picklist Select" id="picklistSelect">
                </select>
              </div>
              <div class="col-md-2 mt-1 mb-1">
                <button type="button" id="openNewPicklistButton" class="btn btn-primary" data-bs-target="#newPicklistModal">New Picklist</button>
              </div>
              <div class="col-md-2 mt-1 mb-1">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" role="switch" id="editPicklist">
                  <label class="form-check-label" for="editPicklist">Edit Picklist</label>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
      <div class="row pt-3 pb-3 mb-3">
        <div class="card col-md-12">
          <div class="card-header">
            Pick List
          </div>
          <div class="card-body">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th scope="col">Picked</th>
                  <th scope="col">#</th>
                  <th scope="col">Team</th>
                  <th scope="col">Data</th>
                </tr>
              </thead>
              <tbody id="picklistDiv">
              </tbody>
            </table>
          </div>
        </div>
      </div>
      
      <div class="row pt-3 pb-3 mb-3">
        <div class="card col-md-12">
          <div class="card-header">
            Not Sorted
          </div>
          <div class="card-body">
            <table class="table table-striped table-hover sortable">
              <thead>
                <tr>
                  <th scope="col">Picked</th>
                  <th scope="col">#</th>
                  <th scope="col">Team</th>
                  <th scope="col">Data</th>
                </tr>
              </thead>
              <tbody id="unsortedDiv">
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
      
      <div class="row pt-3 pb-3 mb-3">
        <div class="card col-md-12">
          <div class="card-header">
            Do Not Pick
          </div>
          <div class="card-body">
            <table class="table table-striped table-hover sortable">
              <thead>
                <tr>
                  <th scope="col">Picked</th>
                  <th scope="col">#</th>
                  <th scope="col">Team</th>
                  <th scope="col">Data</th>
                </tr>
              </thead>
              <tbody id="doNotPickDiv">
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>


<div class="modal" tabindex="-1" id="newPicklistModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Picklist</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-3">
          <input type="text" id="newPicklistName" class="form-control" placeholder="Picklist Name">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="addPicklistButton">Add Picklist</button>
      </div>
    </div>
  </div>
</div>


<?php include("footer.php") ?>

<script>
  
    var firebaseApp, tbaApp;
   
    var sortedListKeys = ["sorted", "unsorted", "dnp"];
    var sortedLists = {"sorted" : [], "unsorted" : [], "dnp" : []};
    var localPickedTeamLookup = [];
    
    var pickListSortable, notSortedSortable, dnpSortable;
    
    var lockListEdit = false;
    
    var currPicklistName = null;
    
    function setSortable(state){
      pickListSortable.sort = state;
      notSortedSortable.sort = state;
      dnpSortable.sort = state;
    }
    
    /*
      Firebase Table Format
      data = {picklist: {eventCode: {picklists: {picklistName : {unsorted : [], sorted : [], dnp : []}}, pickedTeams : []}}}
    */
    
    function createNewPicklist(picklistName){
      if(picklistName == ""){
        return false;
      }
      
      tbaApp.getTeamList(tbaApp.eventcode, function(teamList){
        var dataFormat = {"unsorted" : teamList, "sorted" : [], "dnp" : []};
        firebaseApp.set("picklist/"+tbaApp.eventcode+"/picklists/"+picklistName, dataFormat);
        loadPicklist(picklistName);
        loadPicklistNames();
      });
      return true;
    }
    
    function loadPicklist(picklistName){
      console.log(picklistName);
      if (currPicklistName != null){
        firebaseApp.removeAllListeners("picklist/"+tbaApp.eventcode+"/picklists/"+currPicklistName);
      }
      currPicklistName = picklistName;
      var reqURI = "picklist/"+tbaApp.eventcode+"/picklists/"+picklistName;
      var needUpdate = false;
      firebaseApp.attachListener(reqURI, function(data){
        lockListEdit = true;
        var dval = data.val();
        for(var i = 0; i != sortedListKeys.length; i++){
           var newList = (sortedListKeys[i] in dval) ? dval[sortedListKeys[i]] : [];
           if (!arraysEqual(newList, sortedLists[sortedListKeys[i]])){
             sortedLists[sortedListKeys[i]] = [...newList];
             needUpdate = true;
           }
        }
        if (needUpdate){
          addTeamsToLists();
        }
        else {
          lockListEdit = false;
        }
        
        // Bind all checkboxes to select function
        $(".pick-check").change(function(){
          modPickedTeams(this.checked, $(this).parent().parent().attr('data-team'));
          addPickedTeamsToFirebase();
        });
      });
      saveDefaultPicklist();
    }
    
    function modPickedTeams(isChecked, teamNumber){
      /* Modified localPickedTeamLookup depending on if team was picked or not.
      Args:
        isChecked: If true, team was picked. If false team was not picked.
        teamNumber: Team number.
      */
      if (isChecked){
        localPickedTeamLookup[teamNumber] = true;
      }
      else {
        delete localPickedTeamLookup[teamNumber];
      }
      showPickedTeams();
    }
    
    function addPickedTeamsToFirebase(){
      /* Send new localPickedTeamLookup to firebase
      */
      pickedTeamList = [];
      for(let teamNumber in localPickedTeamLookup){
        pickedTeamList.push(teamNumber);
      }
      firebaseApp.set("picklist/"+tbaApp.eventcode+"/pickedTeams", pickedTeamList);
    }
    
    function bindPickedTeamsFromFirebase(){
      /* On firebase change, get picked teams from there and update highlighted rows.
      */
      var reqURI = "picklist/"+tbaApp.eventcode+"/pickedTeams";
      firebaseApp.attachListener(reqURI, function(data){
        var dval = data.val();
        // Checks if checked teams changed, only update if it did change
        if (! setEquals(new Set(Object.keys(localPickedTeamLookup)), new Set(dval))){
          localPickedTeamLookup = {};
          for (let i in dval){
            localPickedTeamLookup[dval[i]] = true;
          }
          showPickedTeams();
        }
      });
    }
    
    function showPickedTeams(){
      /* Show all picked teams
      */
      $('.pick-check').each(function() {
        if ($(this).parent().parent().attr('data-team') in localPickedTeamLookup){
          $(this).prop('checked', true);
          $(this).parent().parent().addClass('table-dark');
        }
        else {
          $(this).prop('checked', false);
          $(this).parent().parent().removeClass('table-dark');
        }
      });
    }
    
    
    function setEquals(a, b){
      /* Returns true if both sets have equal values
      */
      if (a.size != b.size){
        return false;
      }
      for (let item of a){
        if (! b.has(item)){
          return false;
        }
      }
      return true;
    }
    
    function addTeamsToLists(picks, notsorted, dnp){
      var ids = ["picklistDiv", "unsortedDiv", "doNotPickDiv"];
      for(var i = 0; i != sortedListKeys.length; i++){
        $("#"+ids[i]).html("");
        for(var j = 0; j != sortedLists[sortedListKeys[i]].length; j++){
          $("#"+ids[i]).append(createNewRow(j+1, sortedLists[sortedListKeys[i]][j]));
        }
      }
      lockListEdit = false;
    }
    
    function createNewRow(index, team){
      out = "";
      if (team in localPickedTeamLookup){
        out += "<tr data-team='"+team+"' class='table-dark'>";
        out += "  <td scope='col'> <input class='form-check-input pick-check' type='checkbox' role='switch' checked></td>";
      }
      else {
        out += "<tr data-team='"+team+"'>";
        out += "  <td scope='col'> <input class='form-check-input pick-check' type='checkbox' role='switch'></td>";
      }
      out += "  <td scope='col'>"+index+"</td>";
      out += "  <td scope='col'><b>"+team+"</b></td>";
      out += "  <td scope='col'>"+"AAA"+"</td>";
      out += "</tr>";
      return out;
    }
    
    // function showPickedTeams(pickedTeamLookup){
      // /*
      // Args:
        // pickedTeamLookup: Dictionary where key is team that is picked and value doesn't matter
      // */
      // var ids = ["picklistDiv", "unsortedDiv", "doNotPickDiv"];
      // for (var i = 0; i < ids.length; i++){
        // for (let tr of $("#"+ids[i]+" tr")) {
          // console.log(pickedTeamLookup);
          // console.log(Number($(tr).attr("data-team")));
          // if (pickedTeamLookup[Number($(tr).attr("data-team"))]){
            // $(tr).addClass("table-dark");
          // }
          // else {
            // $(tr).removeClass("table-dark");
          // }
        // }
      // }
    // }
    
    function tableToList(){
      var lol_new = {"sorted" : [], "unsorted" : [], "dnp" : []};
      var ids = ["picklistDiv", "unsortedDiv", "doNotPickDiv"];
      for (var i = 0; i < sortedListKeys.length; i++){
        for (let tr of $("#"+ids[i]+" tr")) {
           lol_new[sortedListKeys[i]].push(Number($(tr).attr("data-team")));
        }
      }
      return lol_new;
    }
    
    function tableManualChange(){
      var lol_new = tableToList();
      var needUpdate = false;
      for (var i = 0; i < sortedListKeys.length; ++i){
        if (!arraysEqual(lol_new[sortedListKeys[i]], sortedLists[sortedListKeys[i]])){
          sortedLists[sortedListKeys[i]] = [...lol_new[sortedListKeys[i]]]; // Copy the array by value, not reference
          needUpdate = true;
        }
      }
      if (needUpdate && !lockListEdit){ 
        firebaseApp.set("picklist/"+tbaApp.eventcode+"/picklists/"+currPicklistName, sortedLists);
      }
    }
    
    function arraysEqual(a, b) {
      if (a.length !== b.length) return false;
      for (var i = 0; i < a.length; ++i) {
        if (a[i] !== b[i]) return false;
      }
      return true;
    }
    
    
    function loadPicklistNames(){
      var firstName = null;
      var itemSelected = false;
      $("#picklistSelect").html("");
      firebaseApp.get("picklist/"+tbaApp.eventcode+"/picklists/", function(data){
        var dval = data.val();
        if (dval != null){
          for (var key in dval){
            if (firstName == null){
              firstName = key;
            }
            if (currPicklistName == key){
              $("#picklistSelect").append("<option value='"+key+"' selected>"+key+"</option>");
              itemSelected = true;
            }
            else{
              $("#picklistSelect").append("<option value='"+key+"'>"+key+"</option>");
            }
          }
        }
        // If item not selected
        if (itemSelected){
          loadPicklist(currPicklistName);
        }
        else if(firstName != null){
          loadPicklist(firstName);
        }
        else {
          currPicklistName = null;
        }
      });
    }
    
    function readDefaultPicklist(){
      if (localStorage.getItem("defaultPicklist") != null){
        currPicklistName = localStorage.getItem("defaultPicklist");
      }
    }
    
    function saveDefaultPicklist(){
      localStorage.setItem("defaultPicklist", currPicklistName); 
    }
    
    $(document).ready(function() {
        // $("#picklistDiv").sortable();
        // $("#unsortedDiv").sortable();
        
        // Initialize Firebase
        firebaseApp = new firebaseWrapper();
        tbaApp = new tbaAPI();
        
        readDefaultPicklist();
        
        pickListSortable = new Sortable(document.getElementById('picklistDiv'), {
          group: 'shared',
          animation: 150,
          sort: true,
          onEnd: tableManualChange
        });
        
        notSortedSortable = new Sortable(document.getElementById('unsortedDiv'), {
          group: 'shared',
          animation: 150,
          sort: true,
          onEnd: tableManualChange
        });
        
        dnpSortable = new Sortable(document.getElementById('doNotPickDiv'), {
          group: 'shared',
          animation: 150,
          sort: true,
          onEnd: tableManualChange
        });
        
        $("#editPicklist").change(function(){
          setSortable(this.checked);
        });
        
        var newPicklistModal = new bootstrap.Modal(document.getElementById('newPicklistModal'))
        
        $("#openNewPicklistButton").click(function(){
          newPicklistModal.show();
        });
        
        $("#addPicklistButton").click(function(){
          if (! createNewPicklist($("#newPicklistName").val())){
            alert("Picklist name not valid!");
          }
          else{
            newPicklistModal.hide();
          }
        });
        
        
        loadPicklistNames();
        
        $('#picklistSelect').change(function() {
            loadPicklist($(this).val());
        });
        
        bindPickedTeamsFromFirebase();
      
    });
     
</script>

<script type="text/javascript" src="./scripts/firebaseWrapper.js"></script>
<script type="text/javascript" src="./scripts/tbaAPI.js"></script>
    
    
    
