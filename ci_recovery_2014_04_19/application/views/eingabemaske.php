<h1>Bitte Ihre Daten eingeben</h1>

<?php

echo form_open('anmeldung/create');
echo form_input('vname', set_value('vname', 'Vorname'));
echo form_input('nname', set_value('nname', 'Nachname'));
echo form_submit('submit', 'Abschicken');



?>