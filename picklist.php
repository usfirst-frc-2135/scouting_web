<title>Pick List</title>
<?php include("header.php") ?>
<div class="container row-offcanvas row-offcanvas-left">
    <div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
      <div class="row pt-3 pb-3 mb-3">
        <div class="card col-md-12">
          <div class="card-body">
            <h2 id="pickListName">Pick List:</h2>
          </div>
        </div>
      </div>
      
      
      <div class="row pt-3 pb-3 mb-3">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              Pick List
            </div>
            <div class="card-body overflow-auto">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">#</th>
                    <th scope="col">Team</th>
                    <th scope="col">Avg Total Pts</th>
                    <th scope="col">Max Total Pts</th>
                    <th scope="col">Avg Auto Pts</th>
                    <th scope="col">Avg Teleop Pts</th>
                    <th scope="col">Avg Endgame Pts</th>
                    <th scope="col">Total Died</th>
                  <th scope="col">Notes</th>
                  </tr>
                </thead>
                <tbody id="picklistDiv">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      
      <div class="row pt-3 pb-3 mb-3">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              Not Sorted
            </div>
            <div class="card-body overflow-auto">
              <table id="unsortedTable" class="table table-striped table-hover sortable">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">#</th>
                    <th scope="col">Team</th>
                    <th scope="col">Avg Total Pts</th>
                    <th scope="col">Max Total Pts</th>
                    <th scope="col">Avg Auto Pts</th>
                    <th scope="col">Avg Teleop Pts</th>
                    <th scope="col">Avg Endgame Pts</th>
                    <th scope="col">Total Died</th>
                    <th scope="col">Notes</th>
                  </tr>
                </thead>
                <tbody id="unsortedDiv">
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      
      <div class="row pt-3 pb-3 mb-3">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              Do Not Pick
            </div>
            <div class="card-body overflow-auto">
              <table class="table table-striped table-hover sortable">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">#</th>
                    <th scope="col">Team</th>
                    <th scope="col">Avg Total Pts</th>
                    <th scope="col">Max Total Pts</th>
                    <th scope="col">Avg Auto Pts</th>
                    <th scope="col">Avg Teleop Pts</th>
                    <th scope="col">Avg Endgame Pts</th>
                    <th scope="col">Total Died</th>
                    <th scope="col">Notes</th>
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
    <div class="row pt-3 pb-3 mb-3">
    <div class="col-md-12">
      <div class="card">
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
  
    var firebaseApp;
   
    var sortedListKeys = ["sorted", "unsorted", "dnp"];
    var sortedLists = {"sorted" : [], "unsorted" : [], "dnp" : []};
    var localPickedTeamLookup = [];
    
    var pickListSortable, notSortedSortable, dnpSortable;
    
    var lockListEdit = false;
    
    var currPicklistName = null;
    
    var eventCode = null;
    
    var localAverages = null;
    var localNotes = {};
    
    var canEdit = false;
    
    function setEditable(state){
      if (state != null){
        canEdit = state; 
      }
      
      pickListSortable.option("disabled", !canEdit);
      notSortedSortable.option("disabled", !canEdit);
      dnpSortable.option("disabled", !canEdit);
      
      
      if (canEdit){
        $(".pick-check").change(function(){
          modPickedTeams(this.checked, $(this).parent().parent().attr('data-team'));
          addPickedTeamsToFirebase();
        });
        
        $(".teamNotes").removeAttr('disabled');
        
        // Bind comment edit function
        $(".teamNotes").on("focusout", function() {
          var newText = $(this).val();
          var teamNumber = $(this).attr('data-team');
          // if text changed
          if(localNotes[teamNumber] != newText && !(newText == "" && !(teamNumber in localNotes))){
            localNotes[teamNumber] = newText; 
            firebaseApp.set("picklist/"+eventCode+"/notes", localNotes);
          }
        });
      }
      else {
        $(".teamNotes").attr('disabled', 'disabled');
      }
      
      if (canEdit){
        // sorttable.makeSortable(document.getElementById("unsortedDiv"));
      }
      else {
        // sorttable.makeSortable(document.getElementById("unsortedDiv"));
      }
    }
    
    /*
      Firebase Table Format
      data = {picklist: {eventCode: {picklists: {picklistName : {unsorted : [], sorted : [], dnp : []}}, pickedTeams : []}}}
    */
    
    function createNewPicklist(picklistName){
      if(picklistName == ""){
        return false;
      }
      
      $.get("./tbaAPI.php", {getTeamList : true}, function(teamList){
        teamList = JSON.parse(teamList);
        var dataFormat = {"unsorted" : teamList, "sorted" : [], "dnp" : []};
        firebaseApp.set("picklist/"+eventCode+"/picklists/"+picklistName, dataFormat);
        loadPicklist(picklistName);
        loadPicklistNames();
      });
      
      return true;
    }
    
    function loadPicklist(picklistName){
      console.log(picklistName);
      if (currPicklistName != null){
        firebaseApp.removeAllListeners("picklist/"+eventCode+"/picklists/"+currPicklistName);
      }
      currPicklistName = picklistName;
      $("#pickListName").html("Pick List: " + currPicklistName);
      var reqURI = "picklist/"+eventCode+"/picklists/"+picklistName;
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
        setEditable(null);
      });
      saveDefaultPicklist();
      bindPickedTeamsFromFirebase();
      bindNotesFromFirebase();
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
      firebaseApp.set("picklist/"+eventCode+"/pickedTeams", pickedTeamList);
    }
    
    function bindPickedTeamsFromFirebase(){
      /* On firebase change, get picked teams from there and update highlighted rows.
      */
      var reqURI = "picklist/"+eventCode+"/pickedTeams";
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
    
    function bindNotesFromFirebase(){
      /* On firebase change, get notes and update rows
      */
      var reqURI = "picklist/"+eventCode+"/notes";
      firebaseApp.attachListener(reqURI, function(data){
        var dval = data.val();
        console.log(dval);
        console.log(localNotes);
        // Checks if team notes changed, only update if it did change
        if (! dictEqual(localNotes, dval) && dval != null){
          console.log(dval);
          localNotes = {...dval};
          addTeamsToLists();
          setEditable(null);
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
    
    function addTeamsToLists(){
      var ids = ["picklistDiv", "unsortedDiv", "doNotPickDiv"];
      var teamSet = new Set();
      for(var i = 0; i != sortedListKeys.length; i++){
        $("#"+ids[i]).html("");
        var sortIndex = 0;
        for(var j = 0; j != sortedLists[sortedListKeys[i]].length; j++){
          var teamNumber = sortedLists[sortedListKeys[i]][j];
          if (!teamSet.has(teamNumber)){
            $("#"+ids[i]).append(createNewRow(++sortIndex, teamNumber));
            teamSet.add(teamNumber);
          }
        }
      }
      lockListEdit = false;
      // Make sortable
      
    }
    
    function dummylocalAveragesLookup(team,item){
      if (!localAverages){
        return "NA";
      }
      if (!(team in localAverages)){
        return "NA";
      }
      return localAverages[team][item];
    }
  
  function commentLookup(team){
    if (!localNotes){
      return "";
    }
    if (!(team in localNotes)){
      return "";
    }
    return localNotes[team];
  }
    
    function createNewRow(index, team){
      var out = "";
      var icon_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-move" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 1.707V5.5a.5.5 0 0 1-1 0V1.707L6.354 2.854a.5.5 0 1 1-.708-.708l2-2zM8 10a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 14.293V10.5A.5.5 0 0 1 8 10zM.146 8.354a.5.5 0 0 1 0-.708l2-2a.5.5 0 1 1 .708.708L1.707 7.5H5.5a.5.5 0 0 1 0 1H1.707l1.147 1.146a.5.5 0 0 1-.708.708l-2-2zM10 8a.5.5 0 0 1 .5-.5h3.793l-1.147-1.146a.5.5 0 0 1 .708-.708l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L14.293 8.5H10.5A.5.5 0 0 1 10 8z"/></svg>';
      
      if (team in localPickedTeamLookup){
        out += "<tr data-team='"+team+"' class='table-dark'>";
        out += "  <td scope='col' class='pickHandle'>"+icon_svg+"</td>";
        out += "  <td scope='col'> <input class='form-check-input pick-check' type='checkbox' role='switch' checked></td>";
      }
      else {
        out += "<tr data-team='"+team+"'>";
        out += "  <td scope='col' class='pickHandle'>"+icon_svg+"</td>";
        out += "  <td scope='col'> <input class='form-check-input pick-check' type='checkbox' role='switch'></td>";
      }
      out += "  <td scope='col'>"+index+"</td>";
      out += "  <td scope='col'><b>"+team+"</b></td>";
      out += "  <td scope='col'>"+ dummylocalAveragesLookup(team, "avgtotalpoints") +"</td>";
      out += "  <td scope='col'>"+ dummylocalAveragesLookup(team, "maxtotalpoints") +"</td>";
      out += "  <td scope='col'>"+ dummylocalAveragesLookup(team, "avgautopoints") +"</td>";
      out += "  <td scope='col'>"+ dummylocalAveragesLookup(team, "avgteleoppoints") +"</td>";
      out += "  <td scope='col'>"+ dummylocalAveragesLookup(team, "avgendgamepoints") +"</td>";
      out += "  <td scope='col'>"+ dummylocalAveragesLookup(team, "totaldied") +"</td>";
      out += "  <td><textarea style='min-width:200px' class='form-control teamNotes' rows='1' data-team='"+team+"'>"+ commentLookup(team) +"</textarea></td>";
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
      if (needUpdate && !lockListEdit && canEdit){ 
        firebaseApp.set("picklist/"+eventCode+"/picklists/"+currPicklistName, sortedLists);
      }
    }
    
    function arraysEqual(a, b) {
      if (a.length !== b.length) return false;
      for (var i = 0; i < a.length; ++i) {
        if (a[i] !== b[i]) return false;
      }
      return true;
    }
    
    function dictEqual(a, b){
      if (typeof a !== "object" || typeof b !== "object" || a == null || b == null){
        return false;
      }
      var a_keys = Object.keys(a);
      var b_keys = Object.keys(b);
      if (!arraysEqual(a_keys, b_keys)){
        return false;
      }
      for(let i in a_keys){
        var key = a_keys[i];
        if (Array.isArray(a[key]) && Array.isArray(b[key])){
          console.log("compared arr, " + key);
          if (!arraysEqual(a[key], b[key])){ return false; }
        }
        else if (typeof a[key] === "object" && typeof b[key] === "object"){
          console.log("compared dict, " + key);
          if (!dictEqual(a[key], b[key])){ return false; }
        }
        else {
          console.log("compared otehr, " + key);
          if (a[key] !== b[key]){ return false; }
        }
      }
      return true;
    }
    
    
    function loadPicklistNames(){
      var firstName = null;
      var itemSelected = false;
      $("#picklistSelect").html("");
      firebaseApp.get("picklist/"+eventCode+"/picklists/", function(data){
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
    
    function bindSortScroll(){
      $( "div" ).mousemove(function( event ) {
        if(!draggingElement){
          var pageCoords = "( " + event.pageX + ", " + event.pageY + " )";
          var clientCoords = "( " + event.clientX + ", " + event.clientY + " )";
          console.log(pageCoords);
          console.log(clientCoords);
        }
      });
    }
    
    
  class scrollHandler{
    /* Handle AutoScrolling when dragging elements because SortableJS is awful at it. */
    constructor(){
      this.draggingElement = false;
      this.y = null;
      this.upperPercentTresh = 0.20;
      this.lowerPercentTresh = 0.20;
      this.percentTresh = 0.30;
      this.screenHeight = screen.height;
      this.primaryCounter = 0;
      this.primaryCounterHit = 20;
      this.secondaryCounter = 0;
      this.secondaryCounterHit = 10;
      this.lowTresh = this.lowerPercentTresh * this.screenHeight;
      this.highTresh = this.screenHeight - (this.upperPercentTresh * this.screenHeight);
      this.state = 0; //0 no hit, 1 low hit, 2 high hit
      this.scrollVal = 100;
    }
    
    setY(y){
      if (y != undefined){
        this.y = y;
      }
    }
    
    startDrag(){
      this.draggingElement = true;
    }
    
    endDrag(){
      this.draggingElement = false;
      // this.y = null;
    }
    
    handleScroll(){
      if(!this.draggingElement){
        return;
      }
      console.log(this.state);
      switch (this.state){
        case 0: // Idle
          if (this.y < this.lowTresh){ this.state = 1; }
          else if (this.y > this.highTresh){ this.state = 4; }
          this.primaryCounter = 0;
          this.secondaryCounter = 0;
          break;
        case 1: // Low start
          if (this.y > this.lowTresh){ this.state = 0; }
          else if (this.primaryCounter >= this.primaryCounterHit){ this.state = 3; }
          this.primaryCounter++;
          break;
        case 2: // Scroll wait
          if (this.y > this.lowTresh){ this.state = 0; }
          else if (this.secondaryCounter >= this.secondaryCounterHit){ this.state = 3; }
          this.secondaryCounter++;
          break;
        case 3: // Scroll down
          if (this.y > this.lowTresh){ this.state = 0; }
          this.setScroll(-this.scrollVal);
          this.secondaryCounter = 0;
          this.state = 2;
          break;
        case 4: // High start
          if (this.y < this.highTresh){ this.state = 0; }
          else if (this.primaryCounter >= this.primaryCounterHit){ this.state = 6; }
          this.primaryCounter++;
          break;
        case 5: // Scroll wait
          if (this.y < this.highTresh){ this.state = 0; }
          else if (this.secondaryCounter >= this.secondaryCounterHit){ this.state = 6; }
          this.secondaryCounter++;
          break;
        case 6: // Scroll down
          if (this.y < this.highTresh){ this.state = 0; }
          this.setScroll(this.scrollVal);
          this.secondaryCounter = 0;
          this.state = 5;
          break;
        default:
          this.state = 0;
      }
      
    }
    
    setScroll(verticalScroll){
      window.scrollBy({
        top: verticalScroll,
        behavior: 'smooth'
      });
    }
  }

    
    $(document).ready(function() {
        
        // Initialize Firebase
        firebaseApp = new firebaseWrapper();
        
        readDefaultPicklist();
        
        var scrollHandlerObj = new scrollHandler();
        
        $.get("./tbaAPI.php", {getEventCode : true}, function(data){
          eventCode = data;
          loadPicklistNames();
        });
        
        pickListSortable = new Sortable(document.getElementById('picklistDiv'), {
          group: 'shared',
          animation: 150,
          sort: true,
          delayOnTouchOnly: true,
          fallbackTolerance: 3,
          scroll: true,
          handle: '.pickHandle',
          onStart: function(){scrollHandlerObj.startDrag()},
          onEnd: function(){scrollHandlerObj.endDrag(); tableManualChange()},
          setData: function(){},
          onMove: function(evt, originalEvent){scrollHandlerObj.setY(originalEvent.clientY)}
          // scrollFn: function(){console.log("A")}
        });
        
        notSortedSortable = new Sortable(document.getElementById('unsortedDiv'), {
          group: 'shared',
          animation: 150,
          sort: true,
          delayOnTouchOnly: true,
          fallbackTolerance: 3,
          scroll: true,
          handle: '.pickHandle',
          onStart: function(){scrollHandlerObj.startDrag()},
          onEnd: function(){scrollHandlerObj.endDrag(); tableManualChange()},
          setData: function(){},
          onMove: function(evt, originalEvent){scrollHandlerObj.setY(originalEvent.clientY)}
          // onChange: function(){console.log("B")}
        });
        
        dnpSortable = new Sortable(document.getElementById('doNotPickDiv'), {
          group: 'shared',
          animation: 150,
          sort: true,
          delayOnTouchOnly: true,
          fallbackTolerance: 3,
          scroll: true,
          handle: '.pickHandle',
          onStart: function(){scrollHandlerObj.startDrag()},
          onEnd: function(){scrollHandlerObj.endDrag(); tableManualChange()},
          setData: function(){},
          onMove: function(evt, originalEvent){scrollHandlerObj.setY(originalEvent.clientY)}
          // onChange: function(){console.log("C")}
        });
        
        $("#editPicklist").change(function(){
          setEditable(this.checked);
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
        
        
        $('#picklistSelect').change(function() {
            loadPicklist($(this).val());
        });
        
        
        setEditable(false);
        
        var intervalId = setInterval(function() {
          scrollHandlerObj.handleScroll();
        }, 10);
        
        
        $.get( "readAPI.php", {getAllData: 1}).done( function( data ) {
          matchData = JSON.parse(data);
          var mdp = new matchDataProcessor(matchData);
          localAverages = mdp.getAverages();
          //loadPicklist(picklistName);
        });
        
        
        
    });
     
    
</script>

<script type="text/javascript" src="./scripts/firebaseWrapper.js"></script>
    
<script type="text/javascript" src="./scripts/matchDataProcessor.js"></script>
    
