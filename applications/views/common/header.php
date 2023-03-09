<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IBIS</title>
    <meta content="IBIS" name="description">
    <meta content="IBIS" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url(); ?>media/img/favicon.png" rel="icon">
    <link href="<?= base_url(); ?>media/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Dosis:300,400,500,600,700,700i|Lato:300,300i,400,400i,700,700i" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/solid.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/a13faq.css" />
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
<style type="text/css">
    body {
    max-width: 100%;
    overflow-x: hidden;
}
</style>
    <script>
        const maxAllowedSizeInMB = 5;
        const searchSpeciesCommonNameUrl = "<?= API_URL?>/Apis/searchSpeciesCommonName";
        const nodeAppUrl = "<?= NODE_URL?>";
       //  alert(nodeAppUrl);
        const addCheckListUrl = "<?= NODE_URL?>/addCheckList";
        const getChecklistsUrl = "<?= NODE_URL?>/getChecklists";
        const addObservationUrl = "<?= API_URL?>/Apis/addObservationNew";
        const projectaddObservationUrl = "<?= API_URL?>/Apis/addObservationNew";
        const getObservationUrl = "<?= API_URL?>/Apis/getObservations";
		const getObservationsForChecklistUrl = "<?= API_URL?>/Apis/getObservationsForChecklist";
        const getObservationDetailsUrl = "<?= API_URL?>/Apis/getObservationDetails";
        //const searchSpeciesUrl = "<?= NODE_URL?>/searchSpecies";
        const searchSpeciesUrl = "<?= API_URL?>/Apis/searchSpecies";
        const getSpeciesLocationUrl= "<?= API_URL?>/Apis/getSpeciesLocation";
		const getSpeciesDynamicCitationUrl= "<?= API_URL?>/Apis/getSpeciesDynamicCitation";
        const getUserProfileStatistics = '<?= API_URL?>/Apis/getUserProfileStatistics';
        const getTotalObservationsUrl = "<?= API_URL?>/Apis/getTotalObservations";
        const apiUrl = "<?= API_URL ?>";
        const submitPFeedbackUrl =   "<?= API_URL ?>/Apis/PFeedbackReg";
        const submitFeedbackUrl =   "<?= API_URL ?>/Apis/FeedbackReg";   
        const FeedbackData = "<?= API_URL ?>/Apis/FeedbackData"; 
        const PublicFeedbacks = "<?= API_URL ?>/Apis/PublicFeedbacks";
        const forgotPassword = "<?= API_URL ?>/Apis/forgotPassword";
        const forgotUserId = "<?= API_URL ?>/Apis/forgotUserId";
        const getTotalStatistics = "<?= API_URL?>/Apis/getTotalStatistics";
        const getStates = "<?= API_URL?>/Apis/getStates";
        const getDistricts = "<?= API_URL?>/Apis/getDistricts";
        const getSubDistricts = "<?= API_URL?>/Apis/getSubDistricts";
        const getBlocks = "<?= API_URL?>/Apis/getBlocks";
        const getUploadedDataSessions = "<?= API_URL?>/Apis/getUploadedDataSessions";
		const getLocationsForDataset = "<?= API_URL?>/Apis/getLocationsForDataset";
        const searchSpeciesBiomeUrl = "<?= API_URL?>/Apis/searchSpeciesBiome";
        const getProtectedAreasUrl = "<?= API_URL?>/Apis/getProtectedAreas";
        const COLKey = '2351';
        const COLSpeciesListURL = 'https://api.catalogueoflife.org/dataset/' + COLKey + '/nameusage/suggest?fuzzy=false&limit=25&q=';
        const COLTaxonomyURL = 'https://api.catalogueoflife.org/dataset/' + COLKey + '/taxon/';
        const COLTaxonHeirarchyURL = 'https://api.catalogueoflife.org/dataset/' + COLKey + '/tree/COLID?catalogueKey=' + COLKey + '&insertPlaceholder=true&type=CATALOGUE';
//const speciesData;
const speciesBiomesWMSUrl = "<?= speciesBiomesWMSUrl?>";
const speciesBiomesLayerName = "<?= speciesBiomesLayerName?>";

const avesLayerURL = "<?= avesLayerURL?>";
const ambhibiansLayerURL = "<?= ambhibiansLayerURL?>";
const reptiliansLayerURL = "<?= reptiliansLayerURL?>";
const mammalianLayerURL = "<?= mammalianLayerURL?>";
const spatialDemandLayerURL = "<?= spatialDemandLayerURL?>";
const temporalDemandLayerURL = "<?= temporalDemandLayerURL?>";
const avesLayerName = "<?= avesLayerName?>";
const ambhibiansLayerName = "<?= ambhibiansLayerName?>";
const reptiliansLayerName = "<?= reptiliansLayerName?>";
const mammaliansLayerName = "<?= mammaliansLayerName?>";
const spatialDemandLayerName = "<?= spatialDemandLayerName?>";
const temporalDemandLayerName = "<?= temporalDemandLayerName?>";

    </script>
    <?php if (empty($_SESSION[SESSION_NAME]['user_uuid'])) { ?>
        <!-- Vendor CSS Files -->
        <link href="<?= base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url(); ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="<?= base_url(); ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="<?= base_url(); ?>assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="<?= base_url(); ?>assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
         <!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/css/ol.css" type="text/css">
        <script src="<?= base_url(); ?>assets/js/ol.js"></script> -->
        <!-- Template Main CSS File -->
        <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet">
        <link href="<?= base_url(); ?>assets/css/fedback.css" rel="stylesheet">
        <header id="header" class="fixed-top" style="z-index: 99999;">
            <div class="container d-flex align-items-center justify-content-between">
                <h1 class="logo logo-text">
                <i class="bi bi-list mobile-nav-toggle"></i><a href="<?= site_url('Home'); ?>"><img src="<?= IMAGE_URL.'logo/IBLOGO.png';?>"></a>
                </h1>
                <nav id="navbar" class="navbar">
                    <ul>
                        <li><a class="nav-link scrollto active" href="<?= site_url('#hero')?>">Home</a></li>
                        <li><a class="nav-link scrollto" href="<?= site_url('#about')?>">About</a></li>
                        <li><a class="nav-link scrollto" href="<?= site_url('#how-it-works')?>">How It Works</a></li>
                        <li><a class="nav-link scrollto" href="<?= site_url('#features')?>">Features</a></li>
                        <!-- <li><a class="nav-link scrollto " href="#news">News</a></li> -->

                        <li><a class="nav-link scrollto" href="<?= site_url('Welcome/contact');?>">Contact</a></li>
                    </ul>
                </nav><!-- .navbar -->
                <div class="header-right">
                    <button class="btn btn-outline-dark mx-1" type="button" data-bs-toggle="modal" data-bs-target="#signUpModal">JOIN US</button>
                    <button class="btn btn-dark mx-1" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">LOGIN</button>
                </div>
            </div>
        </header>
    <?php } else { ?>
        <!-- Vendor CSS Files -->        
        <link href="<?= base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url(); ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="<?= base_url(); ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="<?= base_url(); ?>assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="<?= base_url(); ?>assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
        <!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/css/ol.css" type="text/css"> -->
        <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet">
        <link href="<?= base_url(); ?>assets/css/dashboard.css" rel="stylesheet">
        
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/styleguidebl.css" />
<style type="text/css">
.clear{
    clear:both;
    margin-top: 20px;
}

.autocomplete{
    width: 250px;
    position: relative;
}
.autocomplete #searchResult{
    list-style: none;
    padding: 0px;
    width: 100%;
    position: absolute;
    margin: 0;
    background: white;
}

.autocomplete #searchResult li{
    background: #F2F3F4;
    padding: 4px;
    margin-bottom: 1px;
}

.autocomplete #searchResult li:nth-child(even){
    background: #E5E7E9;
    color: black;
}

.autocomplete #searchResult li:hover{
    cursor: pointer;
    background: #CACFD2;
}

.autocomplete input[type=text]{
    padding: 5px;
    width: 100%;
    letter-spacing: 1px;
}
   
</style><script>

</script>       
</head>
<body>
    <?php $segment1 = $this->uri->segment(1);
    $segment2 = $this->uri->segment(2); 
    $this->session->flashdata('item');?>
    <!-- ======= Header ======= -->
<?php $userD = $this->Crud_model->GetData('users_details','',"user_uuid='".$_SESSION[SESSION_NAME]['user_uuid']."'",'','','','1');?>
    <header id="header" class="fixed-top">
        <input type="hidden" class="GuiD" id="loggedInUserId" value="<?php if (!empty($_SESSION[SESSION_NAME]['user_uuid'])) { echo $_SESSION[SESSION_NAME]['user_uuid']; } else { echo 0; } ?>">
        <div class=" container d-flex justify-content-between">
            <div class="brand">
                <h1 class="logo logo-text">
                    <i class="bi bi-list mobile-nav-toggle"></i><a href="<?= site_url('dashboard'); ?>"><img src="<?= IMAGE_URL.'logo/IBLOGO.png';?>"></a>
                </h1>
            </div>
            <nav id="navbar" class="navbar align-items-end justify-content-start">
                <ul class=" order-lg-2 order-xl-1">
                    <li><a class="nav-link <?= $segment1 == 'dashboard' ? 'active' : ''; ?>" href="<?= site_url('dashboard'); ?>">Home</a>
                        <div class="nav-bb"></div>
                    </li>
                    <li><a class="nav-link <?= $segment1 == 'DataDashboard' ? 'active' : ''; ?>" href="<?= site_url('DataDashboard'); ?>">Data Dashboard</a>
                        <div class="nav-bb"></div>
                    </li> 
                   <!--  <li><a class="nav-link <?= $segment1 == 'species' ? 'active' : ''; ?>" href="<?= site_url('species'); ?>">Species</a>
                        <div class="nav-bb"></div>
                    </li> -->
                    <li><a class="nav-link <?= $segment1 == 'DataPlayground' ? 'active' : ''; ?>" href="<?= site_url('DataPlayground'); ?>">Data Playground</a>
                        <div class="nav-bb"></div>
                    </li>
                    <li><a class="nav-link <?= $segment1 == 'Forum' ? 'active' : ''; ?>" href="<?= site_url('Forum/index'); ?>">Forums</a>
                        <div class="nav-bb"></div>
                    </li>
                    <li><a class="nav-link <?= $segment2 == 'blog' ? 'active' : ''; ?>" href="<?= site_url('Dashboard/blog'); ?>">Blog</a>
                        <div class="nav-bb"></div>
                    </li>
                    <li><a class="nav-link <?= $segment1 == 'observations' ? 'active' : ''; ?>" href="<?= site_url('observations'); ?>">Observations</a>
                        <div class="nav-bb"></div>
                    </li>
                </ul>
<form autocomplete="off" action="<?= site_url('Search/GetSearchData');?>" method="POST">
  <div class="autocomplete" style="width:294px;margin-left:225px;">
    <input id="txt_search" type="search" name="txt_search" placeholder="Search" placeholder="Search" aria-label="Search" aria-describedby="search-addon" style="width:300px;" class="form-control"><input type="submit" class="btn btn-outline-dark" style="position: absolute;margin-top:-13%;margin-left: 300px;background-color: black;color: white;"> 
    <ul id="searchResult"></ul>

    <div class="clear"></div>
    <!-- <div id="userDetail"></div> -->
  </div>
   
</form>
                <div class="btn-group ms-4 d-none d-md-inline-flex order-lg-1 order-xl-2">
                </div>
            </nav><!-- .navbar -->
            <div class="header-right">
                    <div class="my-account-block dropdown">
                        <img src="<?php if(!empty($_SESSION[SESSION_NAME]['profileImg'])) { echo IMAGE_URL.'../uploads/'.$_SESSION[SESSION_NAME]['profileImg']; } 
                            else { echo IMAGE_URL.'/user.png'; } ?>" alt="User" class="avatar responsive">
                        <h6 class="d-none d-md-inline-block text-truncate mt-2"><a href="javascript:void(0)" class="dropdown-toggle" role="button" data-bs-toggle="dropdown">
                            <?php if(strlen($_SESSION[SESSION_NAME]['name']) > 12) { echo substr($_SESSION[SESSION_NAME]['name'],0,12).'...'; } else { echo $_SESSION[SESSION_NAME]['name']; } ?></a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= site_url('PMS/index'); ?>">My Projects</a></li>
                            <li><a class="dropdown-item" href="<?= site_url('Profile'); ?>">Profile</a></li>
                            <?php if($userD->data_upload_status=='Pending' || $userD->data_upload_status=='Rejected' || empty($userD->data_upload_status)) { ?>
                            <li><a class="dropdown-item" href="<?= site_url('Profile/upload_data'); ?>">Upload Data</a></li>
                        <?php } elseif($userD->data_upload_status=='Approved') { ?>
                            <li><a class="dropdown-item" href="<?= site_url('Profile/uploadData'); ?>">Upload Data</a></li>
                         <?php } ?>  
                         <li><a class="dropdown-item" href="<?= site_url('Profile/DataSetList'); ?>">My DataSet</a></li> 
                                <li><a class="dropdown-item" href="<?= site_url('Home/logout'); ?>">Logout</a></li>
                            </ul>
                        </h6>
                    </div>
            </div>
        </div>
    </header>
<?php } ?>