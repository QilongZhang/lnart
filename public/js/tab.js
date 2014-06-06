function setTab(name,num,n){
	for(i=1;i<=n;i++){
		var menu=document.getElementById(name+i);
		var con=document.getElementById(name+"_"+"con"+i);
		menu.className=i==num?"now":"";
  		con.style.display=i==num?"block":"none"; 
	}
}
