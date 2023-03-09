<?php $this->load->view('common/header'); ?>
<style>
    .page-header {
        background-image: linear-gradient(135deg, #31b551 0%, #2249a7 100%);
        min-height: 250px;
        margin-top: 110px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 20px 70px;
        color: #fff;
    }
</style>    
<section class="p-0">
    <div class="col-md-12 page-header">
        <h1 class="display-4">Taxonomy Details</h1>
        <!-- <p class="fs-2">Lorem Ipsum is simply dummy text of the <br />printing and typesetting industry </p> -->
    </div>
</section>
<section>
    <div class="py-5 team4">
  <div class="container">   
    <div class="row">
      <div class="col-md-12">
      <!-- column  -->
<!-- <h2 style="text-align: center;"><u>Taxonomy</u></h2>     -->
<p style="font-family:Arial, Helvetica, sans-serif;text-align: justify; "><b>Taxonomy is the branch of science that names all plant and animal species, much like how humans are 
named. Every human is given a name at birth. Some of us get more than one: While one official name 
goes into documents such as birth certificate, school document, and passport, we could be known 
among family and friends by various pet names. However, when we talk in official or legal terms, the 
name we use is the official one. This is pretty much the case with animals, plants, and even fungi. </b></p>  
<h4>Scientific and Common Names </h4>
<p style="font-family:Arial, Helvetica, sans-serif;text-align: justify; ">Local communities have named each organism by various common names and have been referring to 
them by these names for millennia. However, these names are not standardised. They change, 
depending on the language, culture, and region of the people who use the names. 
The scientific community refers to each of these species by a unique scientific name that is constant, 
standardised, and universal. Researchers use binomial nomenclature, a two-part naming system that 
dates back to Plato and Aristotle. Words of Latin origin are used to name most plants and animals. The 
scientific names of species are formed by the combination of the genus and species names. For example, 
the scientific name for humans is Homo sapiens, in which Homo indicates the genus and sapiens denotes 
the species. And this stays the same irrespective of the language in which you are communicating. 
Besides providing an identity to any given species, the scientific naming convention plays other roles too: 
They are useful internationally in identification, communication, creation of conservation laws, trade, 
disease management, community conservation, and species management.</p>
<h4>History of Taxonomy</h4>
<p style="font-family:Arial, Helvetica, sans-serif;text-align: justify; ">One of the most vocal advocates of modern taxonomy was a highly influential 18th century scientist, Carl 
Linnaeus. Known as the first ecologist and the father of botany, Linnaeus (1707-1778) introduced his 
taxonomy in his work, System Naturae published in 1735. Contrary to popular misconception, Linnaeus 
did not invent the ranking taxonomy, but he simply devised a version of ordering life. He attempted to 
describe the natural world in its entirety and explore the relationships between groups of organisms and 
individual species. 
Linnaeus proposed kingdoms, which were further divided into classes. From classes, the groups were 
further divided into orders, families, genera, and species. Though modern science has discarded a lot of 
his classifications, the modern identification and categorising still use a modified version of the same 
Linnaean classification system. </p>
<h4>Taxonomy and IBIS</h4>
<p style="font-family:Arial, Helvetica, sans-serif;text-align: justify; ">Today, scientists across the globe are working towards defining the nomenclature of various groups. In a 
citizen science portal such as IBIS, managing the current and accurate taxonomy is of prime importance. 
For the purpose of IBIS, we have followed taxonomy of Catalogue of Life (Hobern et al 2021). 
Catalogue of Life (CoL) is the most authoritative list of species of the world. An international 
collaboration of hundreds of taxonomists keeps the CoL global species list updated. 
Currently, CoL offers taxonomy data in four different formats: 
<ol><li><a href="https://api.checklistbank.org/dataset/9804/export.zip?format=ColDP">ColDP Archive </a></li><li><a href="https://api.checklistbank.org/dataset/9804/export.zip?format=DwCA">Darwin Core Archive </a></li><li><a href="https://api.checklistbank.org/dataset/9804/export.zip?format=ACEF">ACEF Archive </a></li><li><a href="https://api.checklistbank.org/dataset/9804/export.zip?format=TextTree">TextTree  </a></li></ol>All through IBIS, we use the Darwin Core Archive format of global checklist. Darwin Core 
is a data standard for publishing and integrating biodiversity information (Wieczorek et al 2012). It 
includes a glossary of terms intended to <b>facilitate the sharing of information about biological diversity</b> by providing identifiers, labels, and definitions.The taxonomy data from CoL in Darwin core format consists of four tab-separated value (TSV) files:<ol><li><a href="#">Distribution This is a description of the range of species. </a></li><li><a href="#">VernacularName 
A list of the vernacular names of species in various languages. </a></li><li><a href="#">SpeciesProfile 
This specifies whether the species is marine, freshwater, or terrestrial.  </a></li><li><a href="#">Taxon 
This specifies the taxonomical details of the species.  </a></li></ol>Of the four files, currently we make use of VernacularName and Taxon files to curate lists for IBIS. Each of 
the four files have a column named dwc:taxonID, which provides codes unique to each species. This code 
can be used to developed connections between all the four types of files. 

</p>
<p><img src="<?= base_url('media/img/dd.png');?>" style="height: 340px;">&nbsp;&nbsp;&nbsp;<img src="<?= base_url('media/img/dd1.png');?>" style="height: 340px;"></p>
<p style="font-family:Arial, Helvetica, sans-serif ">In IBIS, of the two files, the VernacularNames file is curated to address the taxonomy nomenclature 
needs for Indian Sub-continent species. 
Firstly, for each taxon, various vernacular names exist in many Indian languages such as Pahari, Tamil, 
Bhojpuri, Hindi, Marwari, Gujarati, Telugu, Dangi, or Kannada. The following screenshot shows four 
different vernacular names of Butea monosperma, or the Flame of the Forest tree. </p>
<p><img src="<?= base_url('media/img/dd4.png');?>" style="height: 260px;"></p>
<p style="font-family:Arial, Helvetica, sans-serif ">First, the list is filtered; only English names are retained in the list.  
Then, all mammal, birds, amphibian, and reptile species of Indian subcontinent are searched and checked for anomalies such as repetition of names, common name attributed to another species,  and missing common names. The errors are corrected in the VernacularNames file. </p>
<p><img src="<?= base_url('media/img/dd3.png');?>" style="height: 260px;"></p>
<p style="font-family:Arial, Helvetica, sans-serif ">Here, two species show the same common name. This needs to be corrected. </p>
<p><img src="<?= base_url('media/img/dd3.png');?>" style="height: 260px;"></p>
<p style="font-family:Arial, Helvetica, sans-serif ">Here, the name is repeated. 
After thoroughly checking all the four groups, mammals, aves, amphibians, and reptiles, the Vernacular 
names file is merged with the Taxon file by using the dwc:taxonID code column. This way, species can be 
searched by using both vernacular names and the scientific name. 
Although, the list is curated only for Indian species, the global list is not removed. Upon search, all the 
global species will be visible in the results. However, location data will only be available for species that 
occur within the limits of Indian subcontinent, which includes the Indian ocean, Sri Lanka, Nepal, Bhutan, 
Bangladesh, and Pakistan. 
For more information about catalogues of life and the taxonomy sources, please visit the following link: 
<a href="https://www.catalogueoflife.org/data/source-datasets">https://www.catalogueoflife.org/data/source-datasets</a> 
In spite of through checks  before curating the species list of the Indian subcontinent, you may still notice 
some minor errors or variations in the taxonomy. If you encounter any such error, please notify IBIS by 
doing the following steps: <ol type="1"><li><a href="#">Click <b>Forums</b> > <b>Bugs and Suggestions.</b> </a></li><li>Report the error.We will rectify the error at the earliest. Thank you in advance. Your effort and participation are highly appreciated in constantly improving IBIS. </li></ol></p>
<h4>References: </h4>
<p style="font-family:Arial sans-serif;">Wieczorek J, Bloom D, Guralnick R, Blum S, Do¨ ring M, et al. (2012) Darwin Core: An Evolving 
Community-Developed Biodiversity Data Standard. PLoS ONE 7(1): e29715. 
doi:10.1371/journal.pone.0029715 </p>
<p>Hobern, D., Barik, S. K., Christidis, L., Garnett, S. T., Kirk, P., Orrell, T. M., Pape, T., Pyle, R. L., Thiele, K. R., 
Zachos, F. E., Bánki, O. (2021). Towards a global list of accepted species VI: The Catalogue of Life 
Checklist. Organisms Diversity & Evolution. <br>
<a href="https://doi.org/10.1007/s13127-021-00516-w" style="cursor: pointer;">https://doi.org/10.1007/s13127-021-00516-w</a> </p>
<p>Helmenstine, Anne Marie, Ph.D. "Linnaean Classification System (Scientific Names)." ThoughtCo, Aug. 26, 
2020 <br><a href="https://thoughtco.com/linnaean-classification-system-4126641" style="cursor: pointer;">thoughtco.com/linnaean-classification-system-4126641</a>. </p>
    </div>
    </div>
  </div>
</div>
</section>
<?php $this->load->view('common/footer'); ?>