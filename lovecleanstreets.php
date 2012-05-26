<?php
/**
 * lovecleanstreets.php
 * Dependencies
 * - API key for love clean streets - http://api.mediaklik.com/
 * - CloudMade leaflet mapping (call the download folder leaflet) - http://leaflet.cloudmade.com/
 * - html5 boilerplate (place all the content within the downloaded boilerplate folder) - http://html5boilerplate.com/
 *
 * Approved feeds should be visible (on the test server) at: http://apitest.mediaklik.com/reports/georss?age=40&authorityid=242&approvedonly=false
 * Unapproved feeds should be visible (on the test server) at: http://apitest.mediaklik.com/reports/?approvedonly=false&age=40&authorityid=242
 *
 *
 * See README.md
 *
 * @package default
 */


$title = 'lovecleanstreets';

$api_key = $_GET['api'];

showHeader($title);

if (isset($api_key) && $api_key != '') {
	if (sizeof($_FILES)===0) {
		showForm();
	}
	else {
		handleForm();
	}
} else {
	print "<p>Please add your api key</p>";
}

showFooter();


/**
 *
 *
 * @param string  $title
 */
function showHeader($title) {
?>
	<!DOCTYPE html>
		<head>
		  <meta charset="utf-8">
			<style type="text/css" media="screen">
			div#main{
				width:272px;;
			}
			</style>
		<link rel="stylesheet" href="leaflet/dist/leaflet.css" />
		<!--[if lte IE 8]>
		    <link rel="stylesheet" href="leaflet/dist/leaflet.ie.css" />
		<![endif]-->
		<!-- loads CloudMade leaflet -->
		<script src="leaflet/dist/leaflet.js"></script>


		  <!-- Use the .htaccess and remove these lines to avoid edge case issues.
		       More info: h5bp.com/i/378 -->
		  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		  <title><?php echo $title; ?></title>
		  <meta name="description" content="">

		  <!-- Mobile viewport optimized: h5bp.com/viewport -->
		  <meta name="viewport" content="width=device-width">

		  <!-- <link rel="stylesheet" href="css/style.css"> -->

		  <!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->

		</head>
		<body>
		<div id="main">
<?php
}


/**
 *
 */
function showFooter() {
?>
		<!-- closes div#main -->
		</div>
		</body>
		</html>
<?php
}


/**
 *
 */
function showForm() {
?>
			<!-- The data encoding type, enctype, MUST be specified as below -->
			<form enctype="multipart/form-data" action="" method="POST">
			  <h2>Love clean hills</h2>
			  <fieldset class="addReport-fieldset">
			    <legend>Add a new report </legend>
			    <div id="shooters-hill"></div>
			    <div style="color: Red" id="errorMessage"></div>
				Drag the blue pin on the map or type an address
			            <span id="addressError"></span>
			            <label for="CategoryList">Category:</label>
			            <select id="CategoryList" name="CategoryList" style="margin:0px; width:100%;">
			              <option value="1">[Undefined]</option>
			              <option value="249">A Boards</option>
			              <option value="191">A Recycling Bin (broken)</option>
			              <option value="192">A Recycling Bin Missed Collection</option>
			              <option value="193">A Refuse - Missed Collection</option>
			              <option value="130">Abandoned Trolley</option>
			              <option value="2">Abandoned Vehicles</option>
			              <option value="153">Alchohol related litter</option>
			              <option value="57">Assisted Refuse/Recycling Collection</option>
			              <option value="136">Beautiful Bull Breed</option>
			              <option value="50">Bins on Street</option>
			              <option value="38">Bins on Street - Commercial</option>
			              <option value="37">Bins on Street - Domestic</option>
			              <option value="71">Bird Mess</option>
			              <option value="6">Blocked Street Drains/Gullies</option>
			              <option value="243">Boat Moorings</option>
			              <option value="103">Bollard - Maintenance</option>
			              <option value="177">Broken Shade</option>
			              <option value="77">Building Materials on Highway</option>
			              <option value="134">bulky / wees</option>
			              <option value="152">Cleansing</option>
			              <option value="196">Cleansing Assessment Request</option>
			              <option value="195">Cleansing Litter</option>
			              <option value="194">Cleansing Offensive Material</option>
			              <option value="56">Clinical Waste Collection</option>
			              <option value="96">Clutter - too many signs, bollards etc.</option>
			              <option value="4">Commercial Waste/Recycling</option>
			              <option value="100">Cones – no works/incidents</option>
			              <option value="255">Contaminated recycling - not lifted</option>
			              <option value="99">Cranes - oversailing</option>
			              <option value="94">Crossing - Maintenance</option>
			              <option value="5">Dead Animals</option>
			              <option value="113">Dead Tree</option>
			              <option value="112">Diseased Tree</option>
			              <option value="135">dog bins</option>
			              <option value="150">Domestic Refuse Bin Broken</option>
			              <option value="154">Drug related litter</option>
			              <option value="111">Dying Tree</option>
			              <option value="31">Estate Services </option>
			              <option value="109">Fallen Branch</option>
			              <option value="108">Fallen Tree</option>
			              <option value="47">FCHO FYI IFI (For Info, I Fixed It) </option>
			              <option value="197">Fire 39</option>
			              <option value="198">Fire 43</option>
			              <option value="69">Flood</option>
			              <option value="179">Fly Tipped Tyres</option>
			              <option value="58">Fly Tipping after Investigation</option>
			              <option value="8">Fly-tipping</option>
			              <option value="9">Footway &amp; Footpath Defects</option>
			              <option value="27">For Information</option>
			              <option value="36">FYI IFI (For Info, I Fixed It)</option>
			              <option value="11">Grass Verges and Shrub - Maintenance</option>
			              <option value="29">Great Park (For Info)</option>
			              <option value="95">Gullies - broken/missing cover etc.</option>
			              <option value="48">H21 FYI IFI (For Info, I Fixed It) </option>
			              <option value="110">Hanging Branch</option>
			              <option value="90">Highway Obstruction</option>
			              <option value="66">Highways Maintenance</option>
			              <option value="78">Hoardings / scaffolding (Unlicensed)</option>
			              <option value="49">I Cleaned London</option>
			              <option value="85">Kerb Stones – uneven/missing</option>
			              <option value="30">Landmark (For Info)</option>
			              <option value="67">Leaf Fall / Blossom</option>
			              <option value="64">Litter</option>
			              <option value="13">Litter Bins – Damaged</option>
			              <option value="12">Litter Bins – Overflowing</option>
			              <option value="244">Locking Parks</option>
			              <option value="40">Missed bin - recycling contamination</option>
			              <option value="41">Missed bin - refuse unacceptable items</option>
			              <option value="34">NI195 Snapshot: 'A' Standard</option>
			              <option value="33">NI195 Snapshot: 'B Minus' Standard</option>
			              <option value="35">NI195 Snapshot: 'B' Standard</option>
			              <option value="32">NI195 Snapshot: 'C' Standard</option>
			              <option value="44">NI195 Snapshot: 'D' Standard</option>
			              <option value="101">Nuisance Vehicles</option>
			              <option value="70">Oil Spillage</option>
			              <option value="89">Overhanging Trees &amp; Hedges</option>
			              <option value="98">Parks – broken play equipment</option>
			              <option value="14">Parks – Damage/Maintenance</option>
			              <option value="245">Parks - Time in, Time out</option>
			              <option value="82">Pavements - uneven/trip</option>
			              <option value="189">Poor box replacememt</option>
			              <option value="54">Pro Active Jobs</option>
			              <option value="145">Proactive flyposting removal</option>
			              <option value="143">Proactive non offensive graffiti removal</option>
			              <option value="144">Proactive offensive graffiti removal</option>
			              <option value="3">Recycling Banks</option>
			              <option value="43">Recycling bin - broken</option>
			              <option value="72">Recycling Container Overflowing</option>
			              <option value="42">Refuse - side waste not collected </option>
			              <option value="51">Refuse Out Early</option>
			              <option value="16">Refuse/Recycling Collection</option>
			              <option value="73">Road Not Gritted</option>
			              <option value="74">Road Traffic Accident (RTA)</option>
			              <option value="17">Road/Carriageway - Defects</option>
			              <option value="81">Roads - markings faded/missing</option>
			              <option value="178">Rubbish Fires</option>
			              <option value="138">Rubbish in front gardens</option>
			              <option value="155">Sex litter e.g. condoms</option>
			              <option value="86">Signs – missing/out of date/error</option>
			              <option value="63">Skips</option>
			              <option value="91">Skips &amp; Scaffolding</option>
			              <option value="137">Stray/Found Dog</option>
			              <option value="18">Street Cleansing - Sweeping</option>
			              <option value="19">Street Furniture – Damaged</option>
			              <option value="20">Street Lighting - Maintenance</option>
			              <option value="185">Street Lighting: Dim light</option>
			              <option value="183">Street Lighting: Door missing/unsecured</option>
			              <option value="240">Street Lighting: Electric Shock</option>
			              <option value="187">Street Lighting: Exposed wires</option>
			              <option value="186">Street Lighting: Light flashing</option>
			              <option value="184">Street Lighting: Light leaning dangerously</option>
			              <option value="205">Street Lighting: Light not working</option>
			              <option value="182">Street Lighting: Light not working</option>
			              <option value="181">Street Lighting: Light on during daytime</option>
			              <option value="202">Street Lighting: Light on too late/too early</option>
			              <option value="188">Street Lighting: On too late/off too early</option>
			              <option value="180">Street Lighting: Other</option>
			              <option value="241">Street Lighting: Outer Cover Hanging</option>
			              <option value="242">Street Lighting: Overgrown Vegetation</option>
			              <option value="102">Traffic Light Maintenance</option>
			              <option value="21">Traffic Lights &amp; Panda Crossings - Maintenance</option>
			              <option value="22">Traffic Sign - Maintenance</option>
			              <option value="79">Trees - dangerous</option>
			              <option value="83">Trees - empty tree pit</option>
			              <option value="23">Trees - Maintenance</option>
			              <option value="247">Untaxed Vehicles</option>
			              <option value="62">Untidy Land</option>
			              <option value="106">Utilities underground services</option>
			              <option value="114">Utility Road Works</option>
			              <option value="61">Vandalism</option>
			              <option value="248">Vehicles for Sale</option>
			              <option value="84">Weeds - on highway</option>
			              <option value="28">XTest</option>
			            </select>
						<label for="Notes">Description:</label>
			            <textarea cols="20" id="Notes" name="Notes" onblur="notesBlur();" rows="2" style="margin:0px;width:100%"></textarea>
			            <label for="userfile">Select an Image to upload, Max file size (3Mb):</label>
					    <!-- MAX_FILE_SIZE must precede the file input field -->
					    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
					    <input type="file" name="userfile" />
			            <br>
						<label>Select a location by moving the pin:</label>
						<div id="map" style="height: 200px"></div>
						<script type="text/javascript" charset="utf-8">
						// initialize the map on the "map" div with a given center and zoom
						var map = new L.Map('map', {
						    center: new L.LatLng(51.46898018751684, 0.06827831268310547),
						    zoom: 14
						});

						var cloudmade = new L.TileLayer('http://{s}.tile.cloudmade.com/44c0861a525b49a38d56c7af2525a4c8/997/256/{z}/{x}/{y}.png', {
						    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>[…]',
						    maxZoom: 18
						});

						var markerLocation = new L.LatLng(51.46898018751684, 0.06827831268310547);
						var marker = new L.Marker(markerLocation,{draggable: true});
						map.addLayer(marker);

						var popupContent = '(' + marker.getLatLng().lat.toFixed(3) + ', ' + marker.getLatLng().lng.toFixed(3) + ')';
						marker.bindPopup(popupContent).openPopup();
						marker.on('dragend', onMarkerClick);

						function onMarkerClick(e) {
							lat = marker.getLatLng().lat;
							lng = marker.getLatLng().lng;
							popupContent = '(' + lat.toFixed(3) + ', ' + lng.toFixed(3) + ')';
							marker.bindPopup(popupContent).openPopup();
							document.getElementById('latitude').textContent=lat.toFixed(3);
							document.getElementById('ReportLatitude').value=lat;
							document.getElementById('longitude').textContent=lng.toFixed(3);
							document.getElementById('ReportLongitude').value=lng;
						}


						// add the CloudMade layer to the map
						map.addLayer(cloudmade);

						</script>
			     <input id="ResponseRequired" name="ResponseRequired" type="hidden" value="True">
			    <input id="ReportLatitude" name="ReportLatitude" type="hidden" value="0">
			    <input id="ReportLongitude" name="ReportLongitude" type="hidden" value="0">
			    <span style="font-size: 0.8em" id="latitude"></span>
			    <span style="font-size: 0.8em" id="longitude"></span>
			    <div style="text-align: right; float: right">
			      <input type="submit" id="submitButton" value="Add" class="largeButton">
			      <div id="uploadMessage" style="display: none">
			                    Uploading your report...</div>
			    </div>
			    <div>
			      <img id="loading" style="display: none" alt="" src="/Content/Lightbox/images/lightbox-ico-loading.gif">
			    <!-- closes div map-->
			    </div>
			  </fieldset>
			</form>
<?php
}


/**
 * TODO - handle times in relation to completion
 * TODO	- validate form, noting missing Category,  for example
 */
function handleForm() {
	$DateTimeRecorded=date("c", time()-(1*24*3600));

	if (isset($_REQUEST['CategoryList'])) {
		$CategoryId = $_REQUEST['CategoryList'];
	} else {
		$CategoryId = '';
		/*
			TODO prompt user
		*/
	}
	$Completed='false';
	// $CompletedDate=date("c");
	$CompletedDate='';
	$demo_or_live='demo';

	if (isset($_FILES['userfile'])) {
		$userfile = file_get_contents($_FILES['userfile']['tmp_name']);
	}else {
		$userfile='';
	}

	if (isset($_REQUEST['ReportLatitude']) && isset($_REQUEST['ReportLongitude'])) {
		$lat = $_REQUEST['ReportLatitude'];
		$lng = $_REQUEST['ReportLongitude'];
	} else {
		/*
			TODO prompt user
		*/
	}

	if (isset($_REQUEST['Description'])) {
		$Description = $_REQUEST['Description'];
	} else {
		/*
			TODO prompt user
		*/
		$Description='';
	}

	  // <!-- <CompletedDate>'.$CompletedDate.'</CompletedDate> -->
	$xml_data ='<?xml version="1.0" encoding="utf-8"?>
	<ClientReportItem
	  xmlns:i="http://www.w3.org/2001/XMLSchema-instance"
	  xmlns="http://schemas.datacontract.org/2004/07/LCSAPI.DataContracts">
	  <CategoryId>'.$CategoryId.'</CategoryId>
	  <DateTimeRecorded>'.$DateTimeRecorded.'</DateTimeRecorded>
	  <Description>'.$Description.'</Description>
	  <ImageData>'.base64_encode($userfile).'</ImageData>
	  <ImageUrl i:nil="true" />
	  <Latitude>'.$lat.'</Latitude>
	  <Longitude>'.$lng.'</Longitude>
	  <NotifyEmail>true</NotifyEmail>
	  <AssignedTo>webmaster@e-shootershill.co.uk</AssignedTo>
	  <Completed>'.$Completed.'</Completed>
	  <Approved>true</Approved>
	  <JobName>This is the job name</JobName>
	  <ReportId>00000000-0000-0000-0000-000000000000</ReportId>
	  <ResponseRequired>true</ResponseRequired>
	  <StatusId>1</StatusId>
	  <Tags xmlns:a="http://schemas.microsoft.com/2003/10/Serialization/Arrays">
	    <a:string>'.$demo_or_live.'</a:string>
	  </Tags>
	</ClientReportItem>';

	// re-register the api variable from the global scope
	global $api_key;
	
	$URL = "http://apitest.mediaklik.com/mobile/reports/webmaster@e-shootershill.co.uk/deviceid?APPKEY=$api_key";
	$ch = curl_init($URL);
	curl_setopt($ch, CURLOPT_MUTE, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
	curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	echo $output;
	curl_close($ch);
	echo "<p>Test here: http://apitest.mediaklik.com/reports/report/$output?APPKEY=$api_key</p>";
	print('<p>Approved reports should be visible at: <a href="http://apitest.mediaklik.com/reports/?approvedonly=false&age=40&authorityid=242">http://apitest.mediaklik.com/reports/?approvedonly=false&age=40&authorityid=242</a></p>');
}



?>
