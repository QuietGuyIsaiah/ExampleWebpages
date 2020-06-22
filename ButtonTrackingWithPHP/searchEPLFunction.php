<!DOCTYPE html>
<html>
<?php 
if(isset($_GET['fname']) || isset($_GET['lname']) || isset($_GET['title']) || isset($_GET['Org']) || isset($_GET['subOrg'])){
$Org = $_GET['Org'];
$subOrg = $_GET['subOrg'];
$title = $_GET['title'];
$lname = $_GET['lname'];
$fname = $_GET['fname'];
$date = date("m/j/Y");
$Org = 
$list = array(
  array($date, $fname, $lname, $title, $Org, $subOrg)
);

$file = fopen("trackingButton.csv","a");

foreach ($list as $line) {
  fputcsv($file, $line);
}

fclose($file);
}
else{
    header("Location: http://localhost/php/stats.php");
    die();
}
?>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>


<body>
    <header>
        <div class="headerBackground">
            <div class="adjust">
                <img src="resources/menu.svg" width="40" height="40">
            </div>
            <div class="container">

                <div class="adjust">
                    <img src="resources/logo.png" width="200" height="50">
                </div>
                <div>
                    <p>National Security Agency Central Security Service</p>
                    <h4> Defending our Nation. Securing the Future.</h4>
                </div>
            </div>
            <div class="adjust">
                <img src="resources/search.png" width="40" height="40">
            </div>
        </div>

    </header>


    <br>

    <div class="breadcrumbContianer">
        <ul class="breadcrumb">
            <li><a href="#">HOME</a></li>
            <li><a href="#">RESOURCES FOR ...</a></li>
            <li><a href="#">EVERYONE</a></li>
            <li><a href="#">MEDIA DESTRUCTION GUIDANCE </a></li>
        </ul>
    </div>
<div align="center">
    <a href="showTrackingButton.html" >Show Tracking Button CSV</a>
</div>
    <div class="Searchcontainer">

        <div align="center">
            <div>
                <h4>Search for a device</h4>
                <h5> Last updated March 2020</h5>
                <h6> Put in all available information</h6>
                <table>

                    <tr>
                        <td>
                            <label for="tou"> Type of unit </label>
                        </td>
                        <td>
                            <input type="text" id="tou" name="tou">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="name"> Model number/ name </label>
                        </td>
                        <td>
                            <input type="text" id="name" name="name">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="vendor"> Vendor </label>
                        </td>
                        <td>
                            <input type="text" id="vendor" name="vendor">
                        </td>
                    </tr>


                </table>

                <button type="button" name="load_data" id="load_data" class="btn btn-info">Search</button>
            </div>
            <br />
            <div id="employee_table">
            </div>
        </div>
    </div>


</body>

</html>

<script>
    /*function record(){
        $.ajax({
type: "GET",
  url: "write.php",
  data: {lineData: "foo"},
  success: function(){
      console.log('the data was successfully sent to the server');
       location.reload();
  }
});
    }*/


    $(document).ready(function() {
        $('#load_data').click(function() {
            console.log("confirm")
            $.ajax({
                url: "data.csv",
                dataType: "text",
                success: function(data) {
                    //record();
                    var employee_data = data.split(/\r?\n|\r/);
                    var arr = [];
                    arr.push(employee_data[0]);
                    for (var i = 1; i < employee_data.length; i++) {
                        var row = employee_data[i].split(",");
                        var tou = String(document.getElementById("tou").value).toLowerCase();
                        var name = String(document.getElementById("name").value).toLowerCase();
                        var vendor = String(document.getElementById("vendor").value).toLowerCase();
                        //var SearchedText= String(document.getElementById("search").value).toLowerCase();
                        //var typeNumber= parseInt(document.getElementById("By").value, 10);
                        //var hold = String(row[typeNumber]).toLowerCase();
                        var csvTouText = String(row[0]).toLowerCase();
                        var csvNameText = String(row[1]).toLowerCase();
                        var csvVendorText = String(row[2]).toLowerCase();
                        if (csvTouText.includes(tou) && csvNameText.includes(name) && csvVendorText.includes(vendor)) {
                            arr.push(employee_data[i]);
                        }

                    }



                    //print
                    var table_data = '<table class="table table-bordered table-striped">';

                    for (var count = 0; count < arr.length; count++) {
                        var cell_data = arr[count].split(",");
                        table_data += '<tr>';
                        for (var cell_count = 0; cell_count < cell_data.length; cell_count++) {
                            if (count === 0) {
                                table_data += '<th>' + cell_data[cell_count] + '</th>';
                            } else {
                                var addLink;
                                var finalStr = [];

                                if (String(cell_data[0]).trim().localeCompare(String("Hard Disk Drive Destruction Devices").trim()) == 0) {
                                    addLink = '<a href="https://www.nsa.gov/Portals/70/documents/resources/everyone/media-destruction/NSAEPLHardDiskDriveDestructionDevicesMarch2020.pdf?ver=2020-03-17-094745-757" target="_blank">';
                                } else if (String(cell_data[0]).trim().localeCompare(String("Magnetic Degaussers").trim()) == 0) {
                                    addLink = '<a href="https://www.nsa.gov/Portals/70/documents/resources/everyone/media-destruction/NSAEPLMagneticDegaussersMarch2020.pdf?ver=2020-03-17-094749-040" target="_blank">';
                                } else if (String(cell_data[0]).localeCompare(String("Optical Destruction Devices").trim()) == 0) {
                                    addLink = '<a href="https://www.nsa.gov/Portals/70/documents/resources/everyone/media-destruction/NSAEPLOpticalDestructionDevicesMarch2020.pdf?ver=2020-03-17-094733-693" target="_blank">';
                                } else if (String(cell_data[0]).localeCompare(String("Paper Disintegrators").trim()) == 0) {
                                    addLink = '<a href="https://www.nsa.gov/Portals/70/documents/resources/everyone/media-destruction/NSAEPLPaperDisintegratorsMarch2020.pdf?ver=2020-03-17-094733-413" target="_blank">';
                                } else if (String(cell_data[0]).localeCompare(String("Paper Shredders").trim()) == 0) {
                                    addLink = '<a href="https://www.nsa.gov/Portals/70/documents/resources/everyone/media-destruction/NSAEPLPaperShreddersMarch2020.pdf?ver=2020-03-17-094747-943" target="_blank">';
                                } else if (String(cell_data[0]).localeCompare(String("Punched Tape Disintegrators").trim()) == 0) {
                                    addLink = '<a href="https://www.nsa.gov/Portals/70/documents/resources/everyone/media-destruction/NSAEPLPunchedTapeDisintegratorsMarch2020.pdf?ver=2020-03-17-094744-633" target="_blank">';
                                } else {
                                    addLink = '<a href="https://www.nsa.gov/Portals/70/documents/resources/everyone/media-destruction/NSAEPLSolidStateDisintegratorsMarch2020.pdf?ver=2020-03-17-094746-867" target="_blank">';
                                }

                                var alterMN = addLink + cell_data[1] + "</a>";
                                finalStr.push(cell_data[0]);
                                finalStr.push(alterMN);
                                finalStr.push(cell_data[2]);
                                finalStr.push(cell_data[3]);

                                table_data += '<td>' + finalStr[cell_count] + '</td>';
                            }
                        }
                        table_data += '</tr>';
                    }
                    table_data += '</table>';

                    $('#employee_table').html(table_data);
                }
            });
        });

    });

</script>
