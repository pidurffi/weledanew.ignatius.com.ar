
var httpAjaxObject;
var idControlAjax;


function htmlEntityDecode(str) {
	var textTmp = document.createElement('textarea');
	textTmp.innerHTML = str;
	return textTmp.value;
} 

function vaciarSelect(combo) {
	for(i=combo.options.length-1;i>=0;i--) {
		combo.remove(i);
	}
} 

function vaciarElemento(elemento) {
	elemento.innerHTML = "";
}

function fillCombo(combo,elements,value) {
	var elem = combo;
	if(!elem) return false;
	vaciarSelect(combo);
	for(i=0; i < elements.length; i++) {
		option = document.createElement('option');
		option.setAttribute('value', elements[i].getAttribute('value'));
		option.appendChild(document.createTextNode(htmlEntityDecode(elements[i].firstChild.nodeValue)));
		elem.appendChild(option);
	}
	elem.value = value;
	elem.onchange();
}

function getXmlHttpObject() {
	var xmlhttp;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch (e) {
		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch (e) {
			try {
				xmlhttp = new XMLHttpRequest();
			}
			catch (e) {
				xmlhttp = false;
				alert("Error de configuracion. Imposible ejecutar Ajax Request");
			}
		}
	}
	return xmlhttp;
}

function enviaQuery( xmlHttpObject, archivo, onReadyStateChangeCallback) {
	xmlHttpObject.open("GET", archivo, true);
	xmlHttpObject.onreadystatechange = onReadyStateChangeCallback;
	xmlHttpObject.send(null);
}

