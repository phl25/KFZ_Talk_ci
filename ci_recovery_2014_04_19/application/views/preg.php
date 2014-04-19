<h1>Registrierung</h1>
<div id="reg">
<fieldset><legend> Autokennzeichen </legend>  
<?php

echo form_open('pkfz/addMember');
echo 'Geben Sie Ihr Kennzeichen ein:<br>';

$data1 = array(
	'name' 		=> 'kenn1',
	'value'		=> 'F',
	'size'		=> '5',
);

$data2 = array(
	'name' 		=> 'kenn2',
	'value'		=> 'XX',
	'size'		=> '5',
);

$data3 = array(
	'name' 		=> 'kenn3',
	'value'		=> '0000',
	'size'		=> '5',
);

echo form_input($data1);
echo form_input($data2);
echo form_input($data3);
?>
</fieldset>
<fieldset>
<legend>Weiter Daten</legend> 
<?php
echo 'Geben Sie Ihre Emailadresse ein:';
echo form_input('email', set_value('email', 'Email')); echo '<br>';
echo 'Geben Sie ihr Passwort ein:';
echo form_password('pass', set_value('pass', '***')); echo '<br>';
echo 'Passwort wiederholen:';
echo form_password('pass2', set_value('pass2', '***'));
echo form_submit('submit', 'Registrieren');

?>

<?php echo validation_errors('<p class = error>Fehler</p>');?>

</fieldset>
</div>