function HTTPObject(){
    //xmlhttp est la variable qui va contenir l'objet lui même
    var xmlhttp = false;
    
    //args est le tableau des valeurs à passer à la page que l'on veut appeler
    var args=new Array();
    
    //vars est un tableau de valeurs associées à l'objet lui même. 
    //On peut y stocker des valeurs à utiliser après le retour de la fonction
    var vars=new Array();
    
    //Cette partie du code permet de créer l'objet XMLHTTPRequest en fonction du navigateur
    if ( window.XMLHttpRequest ){
        xmlhttp = new window.XMLHttpRequest();
    }    else {
        if ( window.ActiveXObject ) {
            //Le code de création pour Windows est simple.
            //On peut le simplifier pour gérer les différente versions de l'objet
             xmlhttp = new window.ActiveXObject( "Microsoft.XMLHTTP" );
        }    else    {
             throw "XMLHTTPRequest non supporté";
        }
    }
    //Cette méthode permet d'ajouter des éléments au tableau args
    this.addArg = function(p,v){
        args[p]=v;
    }
    //Cette méthode permet d'ajouter des éléments au tableau vars
    this.setVar = function(p,v){
        vars[p]=v;
    }
    //Méthode pour récupérer une valeur de vars
    this.getVar = function(p){
        return vars[p];
    }

    //Méthode pour récupérer une valeur de args
    this.getArg = function(p){
        return args[p];
    }
    
    //CallBack permet de spécifier le nom de la fonction à appeler après le traitement asynchrone
    //Deux valeurs seront renvoyées : 
    //- L'objet XMLHTTP lui même 
    //- le tableau des Variables que on y a sauvegardé
    this.callBack = function(func){
      xmlhttp.onreadystatechange = function() {
          if(xmlhttp.readyState != 4) return;
            try {xmlhttp.status;}
            catch (e) {return;}
          if ( xmlhttp.status != '200' ) {
              return;
          } else {
              eval(func+'(xmlhttp,vars);');
            }
      }
    }
    //Appel à la page de traitment avec la méthode POST
    this.post = function(p){
        s='';
        for(x in args)
            s+='&'+x+'='+args[x];
        xmlhttp.open('POST',p,true);
        xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        xmlhttp.send(s);
    }
    //Appel à la page de traitment avec la méthode GET
    this.get = function(p){
        s='';
        for(x in args)
            s+='&'+x+'='+args[x];
        xmlhttp.open('GET',p+'?'+s,true);
        xmlhttp.send(null);
    }
}
