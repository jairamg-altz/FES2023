<?php $this->load->view('common/header'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="<?= base_url(); ?>assets/css/data_dashboard.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://xeno-canto.org/static/js/jplayer/xcplayer.css?v2-0-8">
<section class="p-0">
    <div class="col-md-42 page-header" style="width: 100%;">
        <div class="Data-header-details">
          <div class="Data-header-details-desc">
                <div class="desc-1">
                    <h4>
                       Data Dashboard
                    </h4>
                    <p class="col-md-6">
                       How many species inhabit the Indian subcontinent? What exactly do we
know about them? Some of us are in the quest to find answers. Many more
of us are curious to know. The Data Dashboard of IBIS is an effort to bring
such information pertaining to all species to anyone who wants to know.
                    </p>
                </div>
                <div class="desc-1">
                    <h5>
                       Statistics
                    </h5>
                    <div class="col-md-12">
                    <div class="row" style="flex-wrap: nowrap;">   
                     <span class="col-md-3 card"><span class="card-body"><p style="color: black"><?php if($TotalStatistics[0]['sp_parameter']=='Taxonomy Data') { echo $TotalStatistics[0]['sp_count']; } elseif($TotalStatistics[1]['sp_parameter']=='Taxonomy Data') { echo $TotalStatistics[1]['sp_count'];} elseif($TotalStatistics[2]['sp_parameter']=='Taxonomy Data') { echo 
                        $TotalStatistics[2]['sp_count']; } elseif($TotalStatistics[3]['sp_parameter']=='Taxonomy Data') { echo 
                        $TotalStatistics[3]['sp_count']; } else { echo 0; }?><div class="text-muted">No. of Occurence Data</div></p></span></span> &nbsp;

                    <span class="col-md-3 card"><span class="card-body"><p style="color: black"><?php if($TotalStatistics[0]['sp_parameter']=='Total Species') { echo $TotalStatistics[0]['sp_count']; } elseif($TotalStatistics[1]['sp_parameter']=='Total Species') { echo $TotalStatistics[1]['sp_count'];} elseif($TotalStatistics[2]['sp_parameter']=='Total Species') { echo $TotalStatistics[2]['sp_count']; } elseif($TotalStatistics[3]['sp_parameter']=='Total Species') { echo $TotalStatistics[3]['sp_count']; } else { echo 0; }?><div class="text-muted">No. of Species</div></p></span>
                </span>&nbsp;
                    
                    <span class="col-md-3 card"><span class="card-body"><p style="color: black"><?php if($TotalStatistics[0]['sp_parameter']=='Total Families') { echo $TotalStatistics[0]['sp_count']; } elseif($TotalStatistics[1]['sp_parameter']=='Total Families') { echo $TotalStatistics[1]['sp_count'];} elseif($TotalStatistics[2]['sp_parameter']=='Total Families') { echo $TotalStatistics[2]['sp_count']; } elseif($TotalStatistics[3]['sp_parameter']=='Total Families') { echo $TotalStatistics[3]['sp_count']; } else { echo 0; }?><div class="text-muted">No. of Total Families</div></p></span></span>&nbsp;

                    <span class="col-md-3 card"><span class="card-body"><p style="color: black"><?php if($TotalStatistics[0]['sp_parameter']=='Added this week') { echo $TotalStatistics[0]['sp_count']; } elseif($TotalStatistics[1]['sp_parameter']=='Added this week') { echo $TotalStatistics[1]['sp_count'];} elseif($TotalStatistics[2]['sp_parameter']=='Added this week') { echo $TotalStatistics[2]['sp_count']; } elseif($TotalStatistics[3]['sp_parameter']=='Added this week') { echo $TotalStatistics[3]['sp_count']; } else { echo 0; }?><div class="text-muted">No. of Added this week</div></p>
                    </span></span></div>
</div>
                </div>              
            </div>
        </div>
    </div>
    <div class="Data-nav-tabs">
        <ul class="nav nav-tabs justify-content-around">
            <li class="nav-item">
                <a href="<?= site_url('DataDashboard/index');?>"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#fea_ref">
                    <span class="h5">
                        Featured
                    </span>
                </button></a>
            </li>
            <li class="nav-item active">
                <a href="<?= site_url('DataDashboard/Species');?>"><button id="speciesNavitemTabButton" class="nav-link active" data-bs-toggle="tab" data-bs-target="#species_ref">
                   <span class="h5">
                        Species
                    </span>
                </button></a>
            </li>
             <li class="nav-item">
                <a href="<?= site_url('DataLayer/index');?>"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#species_ref">
                   <span class="h5">
                        Data Layers
                    </span>
                </button></a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('DataDashboard/Dataset');?>"><button id="datasetsNavitemTabButton" class="nav-link" data-bs-toggle="tab" data-bs-target="#dataset_ref">                   
                    <span class="h5">
                        Data Set
                    </span>
                </button></a>
            </li>
             <li class="nav-item">
                <a href="<?= site_url('DataDashboard/PtArea');?>"><button id="datasetsNavitemTabButton" class="nav-link" data-bs-toggle="tab" data-bs-target="#dataset_ref">                   
                    <span class="h5">
                        Protected area
                    </span>
                </button></a>
            </li>
        </ul>
    </div>
    <div class="tab-content">        
        <div class="container-fluid tab-pane active" id="species_ref"> 
        <div class="row">
           <div id="Datadashboard_map" class="map col-md-12">
             <div class="col-md-6 position-absolute" style="z-index: 1;margin-left:2%;">
                <div class="input-group px-5 py-4">
                    <input id="searchSpeciesTextBox" class="form-control" type="search" placeholder="Search species..." onclick="toggleDropDownDiv()" onkeyup="searchSpeciesOnKeyPress(this.value)" aria-label="Search" aria-describedby="basic-addon2">
                </div>
                <div id="searchSpeciesTextBoxDropDown" class="dropdown-div"></div>
                <div id="currentPosition"></div>
            </div>
        </div> 
         </div> 
        <div class="Data-nav-tabs">
        <ul class="nav nav-tabs justify-content-around">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#Overview_ref">
                    <span class="h5">
                        Overview
                    </span>
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#Descriptions_ref">
                   <span class="h5">
                        Descriptions
                    </span>
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#Literature_ref">
                    <span class="h5">
                        Literature
                    </span>
                </button>
            </li>
           <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#Media_ref">            
                    <span class="h5">
                        Media
                    </span>
                </button>
            </li>
            <li class="nav-item" style="display:none;" id="callValue">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#Calls_ref">           
                    <span class="h5">
                        Calls
                    </span>
                </button>
            </li>
        </ul>
    </div> 
    <div class="tab-content">
        <div class="container-fluid tab-pane active" id="Overview_ref">
            <table class="table table-striped">
  <tbody>
    <tr>
      <th scope="row">Family</th>
      <td><span id="pppp115"></span></td>
        </tr>
    <tr>
      <th scope="row">Genus</th>
      <td><span id="pppp116"></span></td>
      
    </tr>
    <tr>
      <th scope="row">Species</th>
      <td><span id="pppp1175"></span></td>     
    </tr>
    <tr>    
      <th scope="row">Vernacular Name</th>
      <td><span id="pppp111"></span></td>
      
    </tr>
  </tbody>
</table>
        </div>
        <div class="container-fluid tab-pane" id="Descriptions_ref">
        <table class="table table-striped">   
    <div class="card-body">
    <h4 class="card-title">Taxonomy</h4>
        </div>     
  <tbody>
    <tr>
      <th scope="row">Kingdom</th>
      <td><span id="pppp"></span></td>
        </tr>
    <tr>
      <th scope="row">Phylum</th>
      <td><span id="pppp1"></span></td>
      
    </tr>
    <tr>
      <th scope="row">Class</th>
      <td><span id="pppp2"></span></td>
     
    </tr>
    <tr>
      <th scope="row">Subclass</th>
      <td><span id="pppp3"></span></td>
      
    </tr>
    <tr>
      <th scope="row">Order</th>
      <td><span id="pppp4"></span></td>
      
    </tr>
    <tr>
      <th scope="row">Family</th>
      <td><span id="pppp5"></span></td>
      
    </tr>
    <tr>
      <th scope="row">Subfamily</th>
      <td><span id="pppp6"></span></td>
      
    </tr>
  </tbody>
</table>
<p><div id="ccc1"></div></p>
<p><div id="sss1"></div></p>
<p><div id="hhh1"></div></p>
<p><div id="cms11"></div></p>
<p><table class="table table-striped">
    
    <div class="card-body">
    <h4 class="card-title">Narrative</h4>
        </div>
        
  <tbody>
    <tr>
      <th scope="row">Conservation Measures</th>
      <td><span id="nnn1"></span></td>
        </tr>
    <tr>
      <th scope="row">Geographic Range</th>
      <td><span id="nnn2"></span></td>      
    </tr>
    <tr>
      <th scope="row">Habitat</th>
      <td><span id="nnn3"></span></td>     
    </tr>
    <tr>
      <th scope="row">Population</th>
      <td><span id="nnn4"></span></td>      
    </tr>
    <tr>
      <th scope="row">Population Trend</th>
      <td><span id="nnn5"></span></td>      
    </tr>
    <tr>
      <th scope="row">Rationale</th>
      <td><span id="nnn6"></span></td>      
    </tr>
    <tr>
      <th scope="row">Taxonomic Notes</th>
      <td><span id="nnn7"></span></td>      
    </tr>
    <tr>
      <th scope="row">Threates</th>
      <td><span id="nnn8"></span></td>      
    </tr>
    <tr>
      <th scope="row">Use and Trade</th>
      <td><span id="nnn9"></span></td>      
    </tr>
  </tbody>
</table></p>
</div>
<div class="container-fluid tab-pane" id="Literature_ref">
    <div class="card-body">
    <h3 class="card-title">ReFindit</h3></div>
    <div class="profile-nav-tabs">
        <ul class="nav nav-tabs justify-content-around" id="tabIData">
           
        </ul>
    </div>
    <div class="tab-content" id="dataTab">

    </div>   
    </div>
    <div class="container-fluid tab-pane" id="Maps_ref">
    </div>
    <div class="container-fluid tab-pane" id="Media_ref">
        <div id="obs_img"></div>

    </div>
<style type="text/css">.xc-mini-player {
    border-radius: 3px;
    border: 1px solid rgb(171,171,171);
    background-color: rgb(220,220,220);
    display: inline-block;
    float: left;
    margin-right: 5px;
    cursor: pointer;
    padding: 0;
}

.xc-mini-player:hover {
    background-color: rgb(242,242,242);
}

.xc-mini-player img {
    float: left;
    max-height: 20px;
}</style>    
    <div class="container-fluid tab-pane" id="Calls_ref">
        <!-- <input type="text" name="scientificName" id="datR"> -->
        <div>
<table id="callDataTable" class="display" width="100%">
    <thead>
            <tr>
                <th></th>
                <th>Scientific Name</th>
                <th>Recordist</th>
                <th>Length</th>
                <th>Date</th>
                <th>Time</th>
                <th>Country</th>
                <th>Location</th>
               <th>Elev. (m)</th>
               <th>Type (predef. / other)</th>
               <th>Remarks</th>
            </tr>
        </thead>
</table>
        </div>

    </div>
    </div>  
        </div>        
</div>
</section>
<?php $this->load->view('common/footer'); ?>
<script src="<?= base_url(); ?>assets/js/data_dashboard.js"></script>
 <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
//jQuery.jPlayer.timeFormat.padMin = false; 
//jQuery(function($).noConflict();   
$(document).ready(function () {
$( ".jp-type-single" ).each(function() {
  xcCreatePlayerForControls(this);
});
}); 
 // Light version for mini-players that circumvents jPlayer
    var isPlaying;
    var playButton;
    var pauseButton;

    jQuery('button.xc-mini-player').click(
        function () {
            var audioId = this.id.replace('btn_', '');
            var audio = jQuery('audio#' + audioId);
            var icon = jQuery(this).data("icon");
            playButton = '/static/img/play-' + icon + '.svg'
            pauseButton = '/static/img/pause-' + icon + '.svg';

            if (audio[0].error != null) {
                xc.showErrorMessage('XC' + this.id.split('_')[3] + ': Media URL could not be loaded.');
            } else if (audioId != isPlaying) {
                // Pause all other audio
                jQuery("audio").each(function(){
                    this.pause();
                });
                isPlaying = audioId;
                audio[0].play();
            } else {
                isPlaying = false;
                audio[0].pause();
            }
        }
    );
jQuery("audio").on({
        play: function() {
            jQuery(this).next().children().attr('src', pauseButton);
            // jPlayer posts itself, so only update count for mini-player
            if (jQuery(this).hasClass('xc-mini-player')) {
                jQuery.post("/api/internal/play-ping", {XC: this.id.split('_')[2]});
            }
        },
        pause: function() {
            jQuery(this).next().children().attr('src', playButton);
        }
    })

    function play() {
        jQuery("audio.xc-mini-player").trigger("play");
    }

    function pause() {
        jQuery("audio.xc-mini-player").trigger("pause");
    }
 function initializeXCPlayer(playerId, controlsId, xcid, filename) {
    var player = jQuery('#' + playerId);
    player.jPlayer({
        ready: function () {
            jQuery(this).jPlayer("setMedia", {
                mp3: filename
            });
        },
        play: function (event) { // only play one audio clip at a time
            var error = player.data("init-error");
            if (!error) {
                // force playhead to start at beginning (mini-players other start at click position)
                if (event.jPlayer.status.currentTime == 0 && event.jPlayer.status.paused === false) {
                    jQuery(this).jPlayer("playHead", 0);
                }
                jQuery(this).jPlayer("pauseOthers");
                jQuery.post("/api/internal/play-ping", {XC: xcid});
            } else {
                xc.showErrorMessage('XC' + xcid + ': ' + player.data("init-error"));
            }
        },
        error: function (event) {
            var message = event.jPlayer.error.message;
            if (event.jPlayer.error.type == jQuery.jPlayer.error.NO_SOLUTION) {
                noSolutionNotified = true;
                return;
            }

            if (noSolutionNotified) {
                message = noSolutionMessage(event);
            }

            player.data("init-error", message);
        },
        cssSelectorAncestor: '#' + controlsId,
        swfPath: "/static/js/jplayer",
        solution: "html,flash",
        supplied: "mp3",
        errorAlerts: false,
        warningAlerts: false,
        wmode: "window"
    });
}
function xcCreatePlayerForControls(controls) {
    var filepath = jQuery(controls).attr("data-xc-filepath");
    var xcid = jQuery(controls).attr("data-xc-id");
    var slowFactor = jQuery(controls).attr("data-xc-factor");
    var controlsId = jQuery(controls).attr("id");
    var playerId = "p_" + controlsId;
    var player = jQuery('#' + playerId);
    if (!player.length) {
        player = jQuery(document.createElement("div"));
        player.addClass("jp-player");
        player.addClass("jp-player-" + xcid);
        player.attr("id", playerId);
        player.attr("data-factor", slowFactor);
        player.attr("data-init-error", "");
        jQuery(document.body).append(player);
    }
    initializeXCPlayer(playerId, controlsId, xcid, filepath);
    return playerId;
}

var noSolutionNotified = false;

/* FIXME: find a way to translate these... */
function noSolutionMessage(event) {
    var nativeMp3 = event.jPlayer.html.audio.available && event.jPlayer.html.canPlay.mp3;
    var message = "Your browser does not support playing the audio files on xeno-canto. While you can still download the files to play them on your computer, the audio players on the website will not work properly. ";
    if (!event.jPlayer.flash.available && !nativeMp3)
        message += "Possible solutions include upgrading to a recent browser that supports the MP3 format, installing or upgrading <a href='http://get.adobe.com/flashplayer/'>Flash Player</a>, or disabling flash blockers for this site."
    else if (!event.jPlayer.flash.available)
        message += "Try installing or upgrading <a href='http://get.adobe.com/flashplayer/'>Flash Player</a> or disabling any flash blockers for this site."
    else if (!nativeMp3)
        message += "Try upgrading to a recent browser that supports the MP3 format."

    return message;
}  
</script>