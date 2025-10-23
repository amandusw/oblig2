<?php  /* vis-alle-studenter /

/*  Programmet skriver ut alle registrerte studenter
*/
  include("db.php");  /* tilkobling til database-serveren utf�rt og valg av database foretatt */

  $sqlSetning="SELECT * FROM student;";

  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
    /* SQL-setning sendt til database-serveren */

  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  print ("<h3>Registrerte studenter</h3>");
  print ("<table border=1>");
  print ("<tr><th align=left>Brukernavn</th> <th align=left>Fornavn</th> <th align=left>Etternavn</th></tr>"); 

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
      $brukernavn=$rad["brukernavn"];        /* ELLER $brukernavn=$rad[0]; */
      $fornavn=$rad["fornavn"]; 
      $etternavn=$rad["etternavn"];    /* ELLER $etternavn=$rad[1]; */

    print ("<tr> <td> $brukernavn </td> <td> $fornavn </td> <td> $etternavn </td> </tr>");
    }
  print ("</table>"); 
?>