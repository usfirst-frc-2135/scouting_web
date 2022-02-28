/*
  Global Variable Definition
*/
var scannedData = {};
var scannedCount = 0;

/*
  Function Definition
*/

function qrStringToList(dataString){
  out = dataString.trim().split("\t");
  for(var i = 0; i < out.length; ++i){
    out[i] = out[i].trim();
  }
  return out;
}

function validateQrList(dataList){
  if (dataList.length != 13){
    return false;
  }
  return true;
}

function qrListToDict(dataList){
  out = {};
  out["teamnumber"]       = dataList[0];
  out["startpos"]         = dataList[1];
  out["tarmac"]           = dataList[2];
  out["autonlowpoints"]   = dataList[3];
  out["autonhighpoints"]  = dataList[4];
  out["teleoplowpoints"]  = dataList[5];
  out["teleophighpoints"] = dataList[6];
  out["climbed"]          = dataList[7];
  out["died"]             = dataList[8];
  out["matchnumber"]      = dataList[9];
  out["eventcode"]        = dataList[10];
  out["scoutname"]        = dataList[11];
  out["comment"]          = dataList[12];
  return out;
}

function qrListToKey(dataObj){
  return dataObj["eventcode"] + "_" + dataObj["matchnumber"] + "_" + dataObj["teamnumber"];
}

function addQrData(dataObj){
  var key = qrListToKey(dataObj);
  
  if (!scannedData.hasOwnProperty(key)){
    // Modify global variables
    scannedData[key] = dataObj;
    ++scannedCount;
    $("#submitData").html("Submit Data: " + scannedCount);
    // Modify table
    $("#qrValidationTable").append(
      $("<tr>").append([
        $("<td>").text(dataObj["eventcode"]),
        $("<td>").text(dataObj["matchnumber"]),
        $("<td>").text(dataObj["teamnumber"]),
        $("<td>").append(
          "<button id='"+key+"_delete' value='"+key+"' type='button' class='btn btn-danger deleteRowButton'>Delete</button>"
        )
      ]).prop("id" , key+"_row")
    );
    // Add delete button
    $("#"+key+"_delete").on('click', function(event){
      removeQrData($(this).val());
    });
  }
}

function removeQrData(dataKey){
  if (scannedData.hasOwnProperty(dataKey)){
    // Modify global variables
    delete scannedData[dataKey];
    --scannedCount;
    $("#submitData").html("Submit Data: " + scannedCount);
    // Modify table
    $("#"+dataKey+"_row").remove();
  } 
}

/*
  Saves default camera ID to localStorage for on reload camera config persistence
*/
function setDefaultDeviceID(id){
  localStorage.setItem("cameraDefaultID", id);
}

/*
  Reads default camera ID from localStorage, or passes default first ID
*/
function getDefaultDeviceID(id){
  var defaultId = localStorage.getItem("cameraDefaultID");
  if (defaultId == null){
    return id;
  }
  else {
    return defaultId;
  }
}

/*
  Responsible for handling actions that occur when camera is scanning
*/
function scanCamera(reader, id){
  reader.decodeFromInputVideoDeviceContinuously(id, 'camera', (result, err) => {
    if (result) {
      var dataList = qrStringToList(result.text);
      
      if (validateQrList(dataList)){
        addQrData(qrListToDict(dataList));
      }
    }
  });
}

/*
  Function bound to the QR Reader
  Handles reading the different cameras connected to device
*/
function createCameraSelect(reader){
  reader.getVideoInputDevices().then((videoInputDevices) => {
    
    // Creates drop down menu to switch between cameras
    var initial_id = null;
    if (videoInputDevices.length >= 1) {
      videoInputDevices.forEach((element) => {
        if (initial_id == null){
          initial_id = element.deviceId;
        }
        $("#cameraSelect").append($('<option>', {value: element.deviceId, text: element.label}));
      });
    }
    
    // Creates default camera scanner based on saved data
    scanCamera(reader, getDefaultDeviceID(initial_id));

    // Binds drop down on change to select new camera when necessary
    $("#cameraSelect" ).change(function() {
      var selCamID = $("#cameraSelect").val();
      scanCamera(reader, selCamID);
      setDefaultDeviceID(selCamID);
    });
  });
}

/*
  Submit Function
*/
function submitFunction(){
  $("#submitData").on('click', function(event){
    var indexedData = [];
    for(const [key, value] of Object.entries(scannedData)){
      indexedData.push(value);
    }
    $.post("writeAPI.php", {"writeData" : JSON.stringify(indexedData)}, function(data){
      console.log(data);  
    });
  });
}

$(document).ready(function() {
    const reader = new ZXing.BrowserQRCodeReader();
    
    createCameraSelect(reader);
    
    submitFunction();
    
});