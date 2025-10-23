<?php

?>

<h3>Registrer student</h3>

<form method="post" action="" id="registrerStudentSkjema" name="registrerStudentSkjema">
  Brukernavn <input type="text" id="brukernavn" name="brukernavn" required /> <br/>
  Fornavn <input type="text" id="fornavn" name="fornavn" required /> <br/>
  Etternavn <input type="text" id="etternavn" name="etternavn" required /> <br/>
  Klassekode
  <select name="klassekode" id="klassekode" required>
    <option value="">Velg klassekode</option>

    <?php
      include("db.php");  // kobler til database

      $sqlSetning = "SELECT * FROM klasse ORDER BY klassekode;";
      $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");
      $antallRader = mysqli_num_rows($sqlResultat);

      for ($r = 1; $r <= $antallRader; $r++) {
        $rad = mysqli_fetch_array($sqlResultat);
        $klassekode = $rad["klassekode"];
        print("<option value='$klassekode'>$klassekode</option>");
      }
    ?>


  <input type="submit" value="Registrer student" id="registrerStudentKnapp" name="registrerStudentKnapp" /> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php 
mysqli_report(MYSQLI_REPORT_OFF);
  if (isset($_POST ["registrerStudentKnapp"]))
    {
      $brukernavn=$_POST ["brukernavn"];
      $fornavn=$_POST ["fornavn"];
      $etternavn=$_POST ["etternavn"]; 

      if (!$brukernavn ||!$fornavn || !$etternavn)
        {
          print ("Alle felt m&aring; fylles ut");
        }
      else
        {
          include("db.php");  /* tilkoblingggg til database-serveren utført og valg av database foretatt */

          $sqlSetning="SELECT * FROM student WHERE brukernavn='$brukernavn';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if ($antallRader!=0)  /* studenten er registrert fra før */
            {
              print ("Studenten er registrert fra f&oslashr");
            }
          else
            {
              $sqlSetning="INSERT INTO student VALUES('$brukernavn','$fornavn','$etternavn');";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; registrere data i databasen");
                /* SQL-setning sendt til database-serveren */

              print ("F&oslash;lgende student er n&aring; registrert: $brukernavn $fornavn $etternavn"); 
            }
        }
    }
?> 