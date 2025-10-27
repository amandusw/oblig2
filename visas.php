<?php  

  include("db.php");  

  $sqlSetning="SELECT * FROM student;";

  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");

  $antallRader=mysqli_num_rows($sqlResultat);  

  print ("<h3>Registrerte studenter</h3>");
  print ("<table border=1>");
  print ("<tr><th align=left>Brukernavn</th> <th align=left>Fornavn</th> <th align=left>Etternavn</th></tr>"); 

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  
      $brukernavn=$rad["brukernavn"];        
      $fornavn=$rad["fornavn"]; 
      $etternavn=$rad["etternavn"];    

    print ("<tr> <td> $brukernavn </td> <td> $fornavn </td> <td> $etternavn </td> </tr>");
    }
  print ("</table>"); 
  
?>