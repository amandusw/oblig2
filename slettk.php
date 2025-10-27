
<script src="funksjoner.js"></script>

<h3>Slett klasse</h3>

<form method="post" action="" id="slettKlasseSkjema" name="slettKlasseSkjema" onsubmit="return bekreft()">
  Klassekode:
  <select name="klassekode" id="klassekode" required>
    <option value="">Velg klassekode</option>

    <?php
      include("db.php");  

      $sqlSetning = "SELECT * FROM klasse;";
      $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");
      $antallRader = mysqli_num_rows($sqlResultat);

      for ($r = 1; $r <= $antallRader; $r++) {
        $rad = mysqli_fetch_array($sqlResultat);
        $klassekode = $rad["klassekode"];
        print("<option value='$klassekode'>$klassekode</option>");
      }
    ?>
  </select>
  <br><br/>

  <input type="submit" value="Slett klasse" name="slettKlasseKnapp" id="slettKlasseKnapp" /> 
</form>

<?php
mysqli_report(MYSQLI_REPORT_OFF);

if (isset($_POST["slettKlasseKnapp"])) {	
  $klassekode = $_POST["klassekode"];
  
  if (!$klassekode) {
    print("Du må velge en klassekode.");
  } else {
    include("db.php");

    $sqlSetning = "SELECT * FROM klasse WHERE klassekode='$klassekode';";
    $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");
    $antallRader = mysqli_num_rows($sqlResultat);

    if ($antallRader == 0) {
      print("Klassen finnes ikke i databasen.");
    } else {
      $sqlSetning = "DELETE FROM klasse WHERE klassekode='$klassekode';";
      $ok = mysqli_query($db, $sqlSetning);

      if ($ok) {
        print("Følgende klasse er nå slettet: <b>$klassekode</b><br>");
      } else {
        print("Feil ved sletting: " . mysqli_error($db));
      }
    }
  }
}
?>
