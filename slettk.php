<?php  /* slett-klasser */
/*
/*  Programmet lager et skjema for å velge et poststed som skal slettes  
/*  Programmet sletter det valgte poststedet
*/
?> 

<script src="funksjoner.js"> </script>

<h3>Slett klasse</h3>

<form method="post" action="" id="slettKlasseSkjema" name="slettKlasseSkjema" onSubmit="return bekreft()">
  Klassekode 
  <select name="klassekode" id="klassekode" required>
    <option value=""> Velg klassekode </option>
    <?php
      include("db.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

      $sqlSetning="SELECT * FROM klasse;";
      $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
      $antallRader=mysqli_num_rows($sqlResultat); 

      for ($r=1;$r<=$antallRader;$r++)
        {
          $rad=mysqli_fetch_array($sqlResultat);  
          $klassekode=$rad["klassekode"];        

          print ("<option value='$klassekode'> $klassekode </option>");
        }
    ?>
  <input type="text" id="klassekode" name="klassekode" required /> <br/>
  <input type="submit" value="Slett klasse" name="slettKlasseKnapp" id="slettKlasseKnapp" /> 
</form>

<?php
  if (isset($_POST ["slettPoststedKnapp"]))
    {	
      $klassekode=$_POST ["postnr"];
	  
	  if (!$klassekode)
        {
          print ("Postnr m&aring; fylles ut");
        }
      else
        {
          include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

          $sqlSetning="SELECT * FROM klasse WHERE klasse='$klassekode';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if ($antallRader==0)  /* poststedet er ikke registrert */
            {
              print ("Poststedet finnes ikke");
            }
          else
            {	  
              $sqlSetning="DELETE FROM poststed WHERE postnr='$klassekode';";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; slette data i databasen");
                /* SQL-setning sendt til database-serveren */
		
              print ("F&oslash;lgende poststed er n&aring; slettet: $klassekode  <br />");
            }
        }
    }
?> 