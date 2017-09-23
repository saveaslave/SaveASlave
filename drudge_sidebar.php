<?php
// Hit Counter for today's hits.
$counter_file	= 'daily_counter.csv';	// can use your own filename here.

// Should not have to edit anything below this line.
$today	= getdate();		// Array for today's information
$handle	= @fopen($counter_file, "r");	// Read-only access
$data	= @fgetcsv($handle, 1000, ',');	// Reads file comma-separated values & places into array $data.
@fclose($handle);
$counter = $data[1];
if($data[0]==$today['mday'])// Check file's day-stamp against current day.
	{
		$counter++;
	}
	else
	{
		$counter=1;
	}
$output	= $today['mday'].', '.$counter;	// Format output into comma-separated values for file.
$handle	= @fopen($counter_file, "w");
@fwrite($handle, $output);
@fclose($handle);
/*if(!isset($_GET['silent']))	// Display output unless 'silent' appears in URL.
	{
		echo $counter;
	} */
// display PayPal after 1000 hits in a single day
if ($counter >= 1000) {
	?>
	<a target="_blank" href="https://www.paypal.me/GiveAGiftSaveAslave"><img src="images/paypal.gif" class="img-responaive" alt="PayPal" /></a>
    <hr>
	<?php
	}
?>
<a target="_blank" href="https://twitter.com/SaveAslave"><img src="images/social1.png" class="img-responaive" alt="social1 (1K)" /></a>
<a target="_blank" href="https://www.facebook.com/SaveAslave-160680597330595/"><img src="images/social2.png" class="img-responaive" alt="social2 (1K)" /></a>
<a target="_blank" href="https://www.youtube.com/channel/UCfswdn_UhJ3Rq-0wFJl5rxg"><img src="images/social3.png" class="img-responaive" alt="social3 (1K)" /></a>
<!-- Added TripIt Icon by James Arbaugh on December 22, 2016 by request of Marty -->
<a target="_blank" href="https://www.tripit.com/">
<img src="images/tripit_icon_thumb_flat.png" class="img-responaive" alt="social4 (1K)" height="34" width="34" /></a>
<a target="_blank" href="https:/www.tripadvisor.com"><img src="images/trip_advisor.jpg" alt="trip_advisor (1K)" height="34" width="34"/></a>
<hr>
<?php 
if (isset($newsfeed)) {
	echo $newsfeed;
} else {
	echo $default_newsfeed;
}
?>
<hr>
<div class="wrap">
<!-- Show videos -->
<?php while($row = $top_videos->fetch_assoc()) { 
	$other_url = 1;
 	if ( strrpos($row["url"], '_')  ) {
		$video_url = "https://www.youtube.com/embed/".substr($row["url"],strrpos($row["url"], '_'));
		$other_url = 0;
 	} 
 	if ( strrpos($row["url"], '=')  ) {
		$video_url = "https://www.youtube.com/embed/".substr($row["url"],strrpos($row["url"], '=')+1);
		 $other_url = 0;
	}
	if ( $other_url == 1 ) {
		$video_url = "https://www.youtube.com/embed/".substr($row["url"],strrpos($row["url"], '/')+1);
	}

	?>
	<h5><?php echo substr($row["name"], 0, strrpos($row["name"], ' - YouTube' ));?></h5>
	<iframe src="<?php echo $video_url;?>" width="365" frameborder="0" allowfullscreen></iframe>
	<?php } ?>
</div>
<br>

<!-- Show the Add Link Form -->
<iframe src="addlink.php?lang=<?php echo $language?>&page=<?php echo $name?>" width="365" height="575" scrolling="no" align="top"></iframe>
<hr>
<h2><?php echo $un_agencies; ?></h2>
<h3><?php echo $un_description; ?></h3>

<a target="_blank" href="http://amnesty.org">Amnesty International</a>
<br>
<a target="_blank" href="http://www.hrw.org">Human Rights Watch</a> 
<br>
<a target="_blank" href="http://www.derechos.org">Derechos Human Rights</a>
<br>
<a target="_blank" href="http://www.frontlinedefenders.org">Front 
Line, The International Foundation for the Protection of Human 
Rights Defenders</a> 
<br>
<a target="_blank" href="http://www.hri.ca">Human Rights Internet</a> 
<br>
<a target="_blank" href="http://www.hrni.org">Human Rights Network 
International database</a> 
<br>
<a target="_blank" href="http://hrusa.org">Human Rights Resource 
Center</a> 
<br>
<a target="_blank" href="http://hrweb.org">Human Rights Web</a> 
<br>
<a target="_blank" href="http://www.newint.org">New Internationalist</a> 
<br>
<a target="_blank" href="http://www.antislavery.org">Anti-slavery</a> 
<br>
<a target="_blank" href="http://www.anti-slaverysociety.com">
Anti-slavery society</a> 
<br>
<a target="_blank" href="http://www.iAbolish.org">American 
Anti-Slavery Group (ASSG)</a> 
<br>
<a target="_blank" href="http://www.freetheslaves.net">Free the 
Slaves</a> 
<br>
<a target="_blank" href="http://www.saveaslave.com">SaveAslave</a> 
<br>
<a target="_blank" href="http://uk.geocities.com/wyndham_ct">The 
Wyndham Charitable Trust</a> 
<br>
<a target="_blank" href="http://www.PolarisProject.org">Polaris 
Project</a> 
<br>
<a target="_blank" href="http://www.esclavagemoderne.org">Committee 
Against Modern Slavery</a> 
<br>
<a target="_blank" href="http://www.sosesclaves.org">SOS Esclaves 
Mauritania</a> 
<br>
<h3>Trafficking and sexual slavery</h3>
<a target="_blank" href="http://www.unodc.org">United Nations Office 
on Drugs and Crime</a>
<br>
<a target="_blank" href="http://www.emancipationnetwork.org">The 
emancipation Network</a> 
<br>
<a target="_blank" href="http://www.catwinternational.org">Coalition 
against Trafficking in Women</a> 
<br>
<a target="_blank" href="http://www.endhumantrafficking.org">Project 
to end Human Trafficking</a> 
<br>
<a target="_blank" href="http://www.humantrafficking.org">
Humantrafficking.org</a> 
<br>
<a target="_blank" href="http://www.orgsites.com/mi/people-against-trafficking-humans/">
People Against Trafficking Humans</a> 
<br>
<a target="_blank" href="http://www.ban-ying.de">Ban-Ying (Germany)</a> 
<br>
<a target="_blank" href="http://www.gaatw.org">Global Alliance 
Against Trafficking in Women</a> 
<br>
<a target="_blank" href="http://www.globalrights.org/trafficking">
Global Rights, Initiative Against Trafficking in Persons</a> 
<br>
<a target="_blank" href="http://www.humantraffickingsearch.net">
Human Trafficking Search (National Multicultural Institute)</a> 
<br>
<a target="_blank" href="http://www.refocusbaltic.net/en">
International Organization for Migration, Prevention of Trafficking 
in Women in the Baltic States project</a> 
<br>
<a target="_blank" href="http://www.lastradainternational.org">La 
Strada International</a> 
<br>
<a target="_blank" href="http://www.cavt.ru">Perm Center Against 
Violence and Human Trafficking (Russia)</a> 
<br>
<a target="_blank" href="http://www.stopalbanianslavery.blogspot.com">
Stop Albanian Slavery</a> 
<br>
<a target="_blank" href="http://www.barnabainstitute.org">The 
Barnaba Institute</a> 
<br>
<a target="_blank" href="http://www.castla.org">Coalition to Abolish 
Slavery and Trafficking</a> 
<br>
<a target="_blank" href="http://www.bsccoalition.org">Bilateral 
Safety Corridor Coalition</a> 
<br>
<a target="_blank" href="http://www.sharedhope.org">Shared Hope 
International</a> 
<br>
<a target="_blank" href="http://www.afesip.org">AFESIP</a> 
<br>
<a target="_blank" href="http://www.endexploitation.org">Action to 
End Exploitation</a> 
<br>
<a target="_blank" href="http://www.protectionproject.org">
Protection Project</a> 
<br>
<h3>Forced labour and migrant exploitation</h3> 
<a target="_blank" href="http://www.ilo.org">International Labor 
Organisation</a> 
<br>
<a target="_blank" href="http://www.laborrights.org">International 
Labor Rights Fund</a> 
<br>
<a target="_blank" href="http://www.iom.int">International 
Organization for Migration</a> 
<br>
<a target="_blank" href="http://www.kalayaan.org.uk">Kalayaan 
Justice for migrant workers</a> 
<br>
<a target="_blank" href="http://www.eyeoftheday.org">Matahari Eye of 
the Day</a> 
<br>
<a target="_blank" href="http://www.globalworkers.org">Global 
Workers Justice Alliance</a> 
<br>
<a target="_blank" href="http://www.senser.com/index.htm">Human 
Rights for workers</a> 
<br>
<a target="_blank" href="http://www.ictu.ie">Irish Congress of Trade 
Unions</a> 
<br>
<a target="_blank" href="http://www.icftu.org">International 
Confederation of Free Trade Unions</a> 
<br>
<a target="_blank" href="http://www.sweatshopwatch.org">
Sweatshopwath</a> 
<br>
<a target="_blank" href="http://www.tuc.org.uk">Trades Union 
Congress UK</a> 
<br>
<a target="_blank" href="http://www.iscos.cisl.it">Instituto 
Sindicale per la Cooperazione et lo Sviluppo</a> 
<br>
<a target="_blank" href="http://www.cluw.org">Coalition of Labor 
Union Women</a> 
<br>
<a target="_blank" href="http://www.ioe-emp.org">International 
Organization of Employers</a> 
<br>
<a target="_blank" href="http://www.ituc-csi.org">World 
Confederation of Labour</a> 
<br>
<a target="_blank" href="http://www.unicef.org ">Children (forced 
labour and sexual slavery) UNICEF</a> 
<br>
<a target="_blank" href="http://www.endchildlabor.org">International 
Initiative to End Child Labor</a> 
<br>
<a target="_blank" href="http://www.ecpat.net">ECPAT International 
(child prostitution and trafficking of children for sexual purposes)</a> 
<br>
<a target="_blank" href="http://www.jfci.org">Justice for Children 
International</a> 
<br>
<a target="_blank" href="http://www.savethechildren.org">Save the 
children</a> 
<br>
<a target="_blank" href="http://www.stopchildlabor.org">Child Labor 
Coalition</a> 
<br>
<a target="_blank" href="http://www.world-tourism.org//protect_children/index.htm">
World Tourism Organization - Task to Protect Children from Sexual 
Exploitation in Tourism</a> 
<br>
<a target="_blank" href="http://bbasaccs.org">South Asian Coalition 
on Child Servitude</a> 
<br>
<a target="_blank" href="http://www.crin.org/resources/index.asp">
Child Rights Information Network</a>
<br>
<a target="_blank" href="http://atsec.tripod.com/atsecbangladeshchapter/id1.html">
Action Against Trafficking and Sexual Exploitation of Children 
(ALTEN)</a> 
<br>
<a target="_blank" href="http://alten.apinc.org">Association pour la 
lutte Contre le Travail des Enfants au Niger (ALTEN)</a> 
<br>
<a target="_blank" href="http://www.childrightsindia.org">
Butterflies Programme for Street and Working Children (India)</a> 
<br>
<a target="_blank" href="http://www.casa-alianza.org">Casa Alianza 
Latina America</a> 
<br>
<a target="_blank" href="http://www.casa-alianza.org.uk">Casa 
Alianza UK</a> 
<br>
<a target="_blank" href="http://childlabour.typepad.com">Child 
Labour Awareness</a> 
<br>
<a target="_blank" href="http://www.crin.org">Child Rights 
Information Network</a> 
<br>
<a target="_blank" href="http://www.cwa.tnet.co.th">Child Workers in 
Asia</a> 
<br>
<a target="_blank" href="http://www.cwin.org.np">Child Workers in 
Nepal</a> 
<br>
<a target="_blank" href="http://www.phuket.com/island/child.htm">
Child Watch</a> 
<br>
<a target="_blank" href="http://www.workingchild.org/htm/cwc.htm">
Concerned for Working Children</a> 
<br>
<a target="_blank" href="http://www.freethechildren.org">Free the 
Children</a> 
<br>
<a target="_blank" href="http://www.ftcindia.org">Free the Children 
India</a> 
<br>
<a target="_blank" href="http://www.globalmarch.org">Global March 
Against Child Labour</a> 
<br>
<a target="_blank" href="http://www.haqcrc.org">HAQ: Centre for 
Child Rights and Campaign to Stop Child Labour</a> 
<br>
<a target="_blank" href="http://www.icftu.org">International 
Federation of Free Trade Unions (Child labour section)</a> 
<br>
<a target="_blank" href="http://www.ilo.org/ipec/index.htm">ILO - 
International Programme of the Elimination of Child Labour</a> 
<br>
<a target="_blank" href="http://www.childtrafficking.com">Child 
Trafficking Digital Library</a> 
<br>
<a target="_blank" href="http://www.csecworldcongress.org">World 
Congress Against Commercial Sexual Exploitation of Children</a> 
<br>
<a target="_blank" href="http://www.worldbank.org">The World Bank- 
Child Labour</a> 
<br>
<a target="_blank" href="http://www.ucw-project.org/">Understanding 
Children's Work: An inter-agency research cooperation project on 
child labour</a> 
<br>
<a target="_blank" href="http://www.eclt.org">ECLT Foundation - 
addressing the challenge of child labour in tobacco growing</a>
<br>
<a target="_blank" href="http://www.csecworldcongress.org">World 
Congress against Sexual Exploitation of Children (CSEC)</a> 
<br>
<a target="_blank" href="http://www.rugmark.org">RugMark Foundation</a> 
<hr>
<a href="<?php echo basename($_SERVER['PHP_SELF']); ?>?lang=en<?php if(basename($_SERVER['PHP_SELF'])=='drudge_country.php') {echo "&name=".$name;} ?>">
English</a> | <a href="<?php echo basename($_SERVER['PHP_SELF']); ?>?lang=es<?php if(basename($_SERVER['PHP_SELF'])=='drudge_country.php') {echo "&name=".$name;} ?>">
Español</a> | <a href="<?php echo basename($_SERVER['PHP_SELF']); ?>?lang=fr<?php if(basename($_SERVER['PHP_SELF'])=='drudge_country.php') {echo "&name=".$name;} ?>">
Français</a> | <a href="<?php echo basename($_SERVER['PHP_SELF']); ?>?lang=pt<?php if(basename($_SERVER['PHP_SELF'])=='drudge_country.php') {echo "&name=".$name;} ?>">
Português</a> | <a href="<?php echo basename($_SERVER['PHP_SELF']); ?>?lang=ru<?php if(basename($_SERVER['PHP_SELF'])=='drudge_country.php') {echo "&name=".$name;} ?>">
русский</a>
<hr>
<?php echo $last_updated.$row["created_date"].$by.$creator;?> <br>
<a href="mailto:saveaslave@aol.com?Subject=Contact%20from%20saveaslave.com"><?php echo $contact; ?></a> 
| <a href="index.php?lang=<?php echo $language?>"><?php echo $home; ?></a> 
| <a href="disclaimer.php"><?php echo $disclaimer; ?></a> | <a href="help.php"><?php echo $help; ?></a>
