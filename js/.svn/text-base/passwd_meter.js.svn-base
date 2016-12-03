function passwordStrength(password)

{

        var desc = new Array();

        desc[0] = "Tres faible";

        desc[1] = "Faible";

        desc[2] = "Tres moyen";

        desc[3] = "Moyen";

        desc[4] = "Fort";

        desc[5] = "Très fort";



        var score   = 0;



        //if password bigger than 6 give 1 point

        if (password.length > 6) score++;



        //if password has both lower and uppercase characters give 1 point      

        if ( ( password.match(/[a-z]/) ) && ( password.match(/[A-Z]/) ) ) score++;



        //if password has at least one number give 1 point

        if (password.match(/\d+/)) score++;



        //if password has at least one special caracther give 1 point

        if ( password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/) ) score++;



        //if password bigger than 12 give another 1 point

        if (password.length > 12) score++;



         document.getElementById("passwordDescription").innerHTML = desc[score];

         document.getElementById("passwordStrength").className = "strength" + score;

}
