<p class="text">Pregled disciplin</p>
<table width="600" border="1" cellpadding="1" cellspacing="0" bordercolor="#666666" class="text">
   ##START##
     <tr>
      <td>##NAME##</td>
      <td><a href="event.php?event_id=##EVENT_ID##">zacni</a>

		<form action="run.php" method="GET">
		##TEKMA_DROP##
		<input type="hidden" name="event_id" value="##EVENT_ID##">
		<input type="submit" name="casi" value="casi">
		</form>

		</td>
      <td><form action="results.php" method="POST">
		##TEKMA_DROP##
		<input type="hidden" name="event_id" value="##EVENT_ID##">
		<input type="submit" name="rezultati" value="rezultati">
		</form>
			

</td>
    </tr>
  ##STOP##
  </table>