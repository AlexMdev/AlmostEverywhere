/*
 * (c) mDev.it
 */

/*******************************************************************************
*		Variabili base
********************************************************************************/

var basePath = 'http://' + top.location.host + '/movida';

var urlToImages = '/commons/images/';
var urlToProducts = '/commons/contents/elenco/';
var urlToPage = '/commons/contents/page/';

var pathToPage = basePath + urlToPage;
var pathToImages = basePath + urlToImages;
var pathToProducts = basePath + urlToProducts;


/*******************************************************************************
*		Funzioni
********************************************************************************/

function setCurrentPage(){

	var sezione, pagina;
	sezione = location.href;
	if(sezione.search('#/') > 0){
		pagina = sezione.split('#/');
		location.href = basePath + '/' + pagina[1];
		//reqSection(pagina[1]);
	}
}

function infoLoadingStart(){
$("article").fadeTo("slow", 0.50);
$("article").html("<img src=\"" + pathToImages + "loader.gif\" alt=\"Caricamento\" /><br />caricamento in corso...");
}

function infoLoadingStop(){
$("article").fadeTo("slow", 1.00);
}

function displayDataResults(xml){

	var testo, totale;
	totale = '';

	if($.trim($(xml).find("code").text()) == "200"){
		$(xml).find("evento").each(function(index){
			testo = '';
			testo += '<div class="evento">';
			testo += '<div class="nome_evento"><b />Nome: ' + $(this).find("nome").text() + '</div>';
			testo += '<div class="data"><b />Data/Ora: ' + $(this).find("data_ora").text() + '</div>';
			//testo += '<div class="orario"><b />Orario: ' + $(this).find("orario_inizio").text() + ' / ' + $(this).find("orario_fine").text() + '</div>';
			testo += '<div class="luogo"><b />Luogo: ' + $(this).find("luogo").text() + ' (via ' + $(this).find("via").text() + ' ' + $(this).find("n_civico_luogo").text() + ')</div>';
			testo += '<div class="costo"><b />Prezzo: ' + $(this).find("costo").text() + '</div>';
			testo += '<div class="min_eta"><b />Et&agrave; minima: ' + $(this).find("min_eta").text() + '</div>';
			testo += '<div class="descrizione"><b />Descrizione: ' + $(this).find("descrizione").text() + '</div>';
			testo += '<form method="post" name="iscrizione" action="signup_event.php">';
			testo += '<input type="hidden" name="id_evento" value="' + $(this).find("id").text() + '" />';
			testo += '<input type="submit" value="Iscriviti a questo evento" />';
			testo += '</form>';
			testo += '<hr />';
			testo += '</div>';
			totale += testo;
		});
	}

	else if($.trim($(xml).find("code").text()) == "404"){
		totale = "Il prodotto richiesto non &egrave; stato trovato.";
	}

	else
		totale = "Si &egrave; verificato un errore sconosciuto.";

	$("#eventi").html(totale);

}

function getDataResults(idcode){

	if(idcode != undefined)
		urlTo = pathToProducts + idcode;
	else
		urlTo = pathToProducts;

	$.ajax({
		type: "GET",
		url: urlTo,
		dataType: "xml",
		success: displayDataResults,
		error: function(){$("article").html("Errore nel reperimento delle informazioni.");}
	});

}

function changeSection(xml){
		if($.trim($(xml).find("code").text()) == "200"){
			$("title").html($(xml).find("titolo").text());
			$("h1").html($(xml).find("titolo").text());
			$("article").html($(xml).find("testo").text());
		}
		else if($.trim($(xml).find("code").text()) == "404"){
			$("title").html("Contenuto non trovato");
			$("h1").html("Contenuto non trovato.");
			$("article").html("Il contenuto della pagina non &egrave; stato trovato. Sei sicuro di aver digitato un indirizzo corretto o che la pagina esista?");
		}
		else if($.trim($(xml).find("code").text()) == "403"){
			$("title").html("Accesso negato");
			$("h1").html("Accesso negato.");
			$("article").html("Non disponi dei privilegi necessari per visualizzare la pagina.");
		}
		else{
			$("title").html("Errore sconosciuto");
			$("h1").html("Errore sconosciuto.");
			$("article").html("Si &egrave; verificato un errore sconosciuto.");
		}
}

function reqSection(section){
	
	$.ajax({
		type: "GET",
		url: pathToPage + section,
		dataType: "xml",
		success: changeSection
      	});
      	
      	window.location.href = "#/" + section;
}

function getProdByInput(elem){
	if($(elem).val().length > 31){
		getDataResults($(elem).val());
	}
}


/*******************************************************************************
*		Chiamate immediate durante il caricamento della pagina
********************************************************************************/
/* !!! Controllo come prima cosa l'url dove sono e nel caso tolgo l'ancora !!! */
setCurrentPage();

/*******************************************************************************
*		Chiamate a documento caricato
********************************************************************************/
$(document).ready(function(){

	// $(".link").click(function(){reqSection($(this).attr("title"))});

$("nav a").click(function(event){
if(!$(this).hasClass("noajx")){

event.preventDefault();
reqSection($(this).attr("title"));
}
});
	 
});