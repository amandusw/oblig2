
<script src="funksjoner.js"></script>

<h3>Slett student</h3>

<form method="post" action="" id="slettStudentSkjema" name="slettStudentSkjema" onsubmit="return bekreft()">
  Brukernavn:
  <select name="brukernavn" id="brukernavn" required>
    <option value="">Velg student</option>

    <?php
      include("db.php"); 

      $sqlSetning = "SELECT * FROM student ORDER BY brukernavn;";
      $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");
      $antallRader = mysqli_num_rows($sqlResultat);

      for ($r = 1; $r <= $antallRader; $r++) {
        $rad = mysqli_fetch_array($sqlResultat);
        $brukernavn = $rad["brukernavn"];
        $fornavn = $rad["fornavn"];
        $etternavn = $rad["etternavn"];
        $klassekode = $rad["klassekode"];

        print("<option value='$brukernavn'>$brukernavn - $fornavn $etternavn ($klassekode)</option>");
      }
    ?>
  </select>
  <br><br/>

  <input type="submit" value="Slett student" name="slettStudentKnapp" id="slettStudentKnapp" /> 
</form>

<?php
mysqli_report(MYSQLI_REPORT_OFF);

if (isset($_POST["slettStudentKnapp"])) {	
  $brukernavn = $_POST["brukernavn"];
  
  if (!$brukernavn) {
    print("Du må velge en student.");
  } else {
    include("db.php");

    $sqlSetning = "SELECT * FROM student WHERE brukernavn='$brukernavn';";
    $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");
    $antallRader = mysqli_num_rows($sqlResultat);

    if ($antallRader == 0) {
      print("Studenten finnes ikke i databasen.");
    } else {
      $sqlSetning = "DELETE FROM student WHERE brukernavn='$brukernavn';";
      $ok = mysqli_query($db, $sqlSetning);

      if ($ok) {
        print("Følgende student er nå slettet: <b>$brukernavn</b><br>");
      } else {
        print("Feil ved sletting: " . mysqli_error($db));
      }
    }
  }
}
?>
