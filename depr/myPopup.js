// JavaScript Document
//fichier Js qui permet de stocker les evenements lies aux traitements.

function myPopup(llink, popWidth, popHeight){
	myPopWindow = window.open("popUp.php?link="+llink, "myPopWindow","fullscreen=1,menubar=no,resizable=0,location=1,status=1,scrollbars=1,width="+popWidth+",height="+popHeight);
    myPopWindow.moveTo(400, 100);
}

function setAlert(){
	alert("rouge");
	/*test = document.getElementById('LIAISONID_EI_0');
	test.value = "true";*/
}

function closePopUp(){
	myPopWindow.close();
}

//enregistre dans un tableau les element cochés
function sendToWindowValue(nbLigne){
	arrayID = new Array();
	
	strID = "";
	j=0;
	
	//1ere ligne, je mets l'intitulé tableau.
	arrayCouplIDVAL = ["<strong>ID</strong>", "<strong>Evénement</strong>"];
	arrayID[j]= arrayCouplIDVAL;
	j = j+1;
	
	for(i=0;i<nbLigne;i++){
		myID = "#LIAISONID_"+i+":checked";
		myValue = $(myID).val();
		if(myValue=="on"){
			//alert("LIAISONID_"+i+"="+myValue);
			myIDEI = "#LIAISONID_EI_"+i;
			myValueEI = $(myIDEI).val();
			
			arrayCouplIDVAL = new Array();
			myEvenement = "#LIAISONID_EVENEMENT_"+i;
			myValueEvenement = $(myEvenement).val();
			
			arrayCouplIDVAL = [myValueEI, myValueEvenement];

			arrayID[j]= arrayCouplIDVAL;
			j = j+1;
			//alert("arrayID"+j+" = "+myValueEI);
		}
	}
	
	/*for(k=0;k<arrayID.length;k++){
		strID = strID+", "+arrayID[k];
	}
	alert(strID);*/
	return arrayID;
}



//Meme fonction que la précédente, mais cette fois s'applique aux traitements non liés vers les ei
function sendToWindowValue2(nbLigne){
	arrayID = new Array();
	
	strID = "";
	j=0;
	
	//1ere ligne, je mets l'intitulé tableau.
	arrayCouplIDVAL = ["<strong>ID</strong>", "<strong>Traitement</strong>"];
	arrayID[j]= arrayCouplIDVAL;
	j = j+1;
	
	for(i=0;i<nbLigne;i++){
		myID = "#LIAISONID_"+i+":checked";
		myValue = $(myID).val();
		if(myValue=="on"){
			//alert("LIAISONID_"+i+"="+myValue);
			myIDTTNVHB = "#LIAISONID_TTNVHB_"+i;
			myValueTTNVHB = $(myIDTTNVHB).val();
			
			arrayCouplIDVAL = new Array();
			myTraitement = "#LIAISONID_TRAITEMENT_"+i;
			myValueTraitement = $(myTraitement).val();
			
			arrayCouplIDVAL = [myValueTTNVHB, myValueTraitement];

			arrayID[j]= arrayCouplIDVAL;
			j = j+1;
			//alert("arrayID"+j+" = "+myValueEI);
		}
	}
	
	/*for(k=0;k<arrayID.length;k++){
		strID = strID+", "+arrayID[k];
	}
	alert(strID);*/
	return arrayID;
}


//met le contenu du tableau dans le champ du parent
function setElementToParent(champ, champ2, arrayValeurs, idToHtml){
	myID = "#"+champ;
	strID = "";
	strIDandLIBEL = "";
	
	//on va créer le tableau 
	strTable = "<table border=\"0\" width=\"50%\" >\r";
	
	for(k=0;k<arrayValeurs.length;k++){
		strTable = strTable+"<tr><td>";
		if(k<=1){//saute le champ d'entete du tableau
			if(k==1){
				strIDandLIBEL = arrayValeurs[k][0]+", "+arrayValeurs[k][1];
				strID = arrayValeurs[k][0];	
			}			
		}else{
			strIDandLIBEL = strIDandLIBEL+", \r"+arrayValeurs[k][0]+", "+arrayValeurs[k][1];	
			strID = strID+","+arrayValeurs[k][0];
		}
		strTable = strTable+arrayValeurs[k][0]+"&nbsp; </td><td>"+arrayValeurs[k][1]+"</td></tr>";
	}
	
	//alert("myID="+myID+", val="+strID);
	$(myID).val(strIDandLIBEL);
	myID = "#"+champ2;
	$(myID).val(strID);
	
	strTable = strTable+"</table>";
	//$("#idEvenements").html(strTable);
	$("#"+idToHtml).html(strTable);
	
	
}



//set CheckBoxByStringArray methode qui va cocher en focntion de la valeur mise dans la barre adresse
function setCByStringArray(){
	param = window.location.search.slice(1,window.location.search.length); 
    //alert('paramsize='+param.length);
	stringArray=param.slice(44)
	//alert(stringArray);
	
	if(stringArray!=null){
		var elem = stringArray.split(',');
		var nbLigne = $("#NBLIGNE").val();
		
		for(i=0;i<nbLigne;i++){
			var strName = "#LIAISONID_EI_"+i;
			var valueID = $(strName).val();
			//alert('valueID='+valueID);
			for(j=0;j<elem.length;j++){
				//alert('elem['+j+']='+elem[j]);
				if(valueID==elem[j]){
					strCBName = "LIAISONID_"+i;
					$('input[name='+strCBName+']').attr('checked', true);
					break;
				}	
			}
		}
	}

}


//idem mais cette fois avec traitement.
function setCByStringArray2(){
	param = window.location.search.slice(1,window.location.search.length); 
/*    alert('param='+param);
	alert('paramsize='+param.length);*/
	stringArray=param.slice(43)
//	alert(stringArray);
	
	if(stringArray!=null){
		var elem = stringArray.split(',');
		var nbLigne = $("#NBLIGNE").val();
		
		for(i=0;i<nbLigne;i++){
			var strName = "#LIAISONID_TTNVHB_"+i;
			var valueID = $(strName).val();
			//alert('valueID='+valueID);
			for(j=0;j<elem.length;j++){
				//alert('elem['+j+']='+elem[j]);
				if(valueID==elem[j]){
					strCBName = "LIAISONID_"+i;
					$('input[name='+strCBName+']').attr('checked', true);
					break;
				}	
			}
		}
	}

}


function unsetHiddenInput(){
	document.forms[0].EI_PRECIS.value = "" ;
	document.forms[0].EI_POPTTNVHB.value = "" ;
}
