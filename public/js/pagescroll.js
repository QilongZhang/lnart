// JavaScript Document

document.onselectstart = function () { return false; }

var nI  = 0;
var kI  = 0;
var run = false;

function setOpacity(obj,o) {
	if (o<0) o=0; else if (o>100) o = 100;
	if (obj.filters)obj.filters.alpha.opacity=o; else obj.style.opacity = o/100;
}
function TPR__(p) {
	P1.style.left  = 50-(2.5*p)+"%";
	P1.style.width = (2.5*p)+"%";
	setOpacity(P1i, .5*p*p);
	if (p == 20) run = false;
}
function TPR_(p) {
	P2.style.width = 50-(2.5*p)+"%";
	setOpacity(P2i, 100-.5*(p*p));
	if (p == 20) {
		P2i.src = IMGSRC[kI].src;
		setOpacity(P2i, 100);
		P2.style.width = "50%";
		for(var i=1; i<=20; i++) setTimeout("TPR__("+i+")", i*32);
	}
}
function TPR() {
	if (!run) {
		run = true;
		P01i.src = IMGSRC[kI].src;
		P1.style.width = 0;
		kI++;
		if (kI>=nI) kI = 0;
		titLe(kI);
		P02i.src = IMGSRC[kI].src;
		P1i.src  = IMGSRC[kI].src;
		for (var i=1; i<=20; i++) setTimeout("TPR_("+i+")", i*32);
	} else setTimeout("TPR()", 100);
}

function TPL__(p) {
	P2.style.width = (2.5*p)+"%";
	setOpacity(P2i, .5*p*p);
	if (p == 20) run = false;
}
function TPL_(p) {
	P1.style.left  = (2.5*p)+"%";
	P1.style.width = 40+(10-2.5*p)+"%";
	setOpacity(P1i, 100-.5*(p*p));
	if (p == 20) {
		P1i.src = IMGSRC[kI].src;
		setOpacity(P1i, 100);
		P1.style.left  = 0;
		P1.style.width = "50%";
		for(var i=1; i<=20; i++) setTimeout("TPL__("+i+")", i*32);
	}
}
function TPL() {
	if (!run) {
		run = true;
		P02i.src = IMGSRC[kI].src;
		P2.style.width = 0;
		kI--;
		if (kI < 0) kI = nI-1;
		titLe(kI);
		P01i.src = IMGSRC[kI].src;
		P2i.src  = IMGSRC[kI].src;
		for(var i=1; i<=20; i++) setTimeout("TPL_("+i+")", i*32);
	} else setTimeout("TPL()", 100);
}
function titLe(p) {
	document.getElementById("TXTBOX").innerHTML = IMGSRC[p].alt;
}
onload = function() {
	IMGSRC  = document.getElementById("imgsrc").getElementsByTagName("img");
	DB      = document.getElementById("DHTMLBOOK");
	P01     = DB.getElementsByTagName("span")[0];
	P01i    = P01.getElementsByTagName("img")[0];
	P02     = DB.getElementsByTagName("span")[1];
	P02i    = P02.getElementsByTagName("img")[0];
	P1      = DB.getElementsByTagName("span")[2];
	P1i     = P1.getElementsByTagName("img")[0];
	P2      = DB.getElementsByTagName("span")[3];
	P2i     = P2.getElementsByTagName("img")[0];
	nI      = IMGSRC.length;
	P1i.src = IMGSRC[kI].src;
	P2i.src = IMGSRC[kI].src;
	titLe(kI);
	DB.style.visibility = "visible";
}