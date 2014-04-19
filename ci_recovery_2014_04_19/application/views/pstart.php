<div id="plogin">
<?php

echo form_open('pkfz/validate_active');
echo form_input('kenn', 'Kennzeichen');
echo form_password('pass', 'Passwort');
echo form_submit('submit', 'Einloggen');
echo anchor('pkfz/signup', 'Registrieren');

?>
</div>