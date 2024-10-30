<?php
/*
Plugin Name: Mahkeme Kararıyla
Description: Bu eklenti sayesinde, hökümete heeeeeç zahmet vermeden kendi sitenizi efendi efendi kapatabilirsiniz. Adamı uğraştırmayın kardeşim !
Author: Eray Alakese
Version: 0.1
Author URI: http://erayalakese.com
*/

function kapat()
{
if(is_front_page() || is_home())
{
include("giris.php");
die();
}
}

add_action('wp', 'kapat');

function mahkemekarariyla_activate() {

    add_option('nedenKapali', 'Bu site gayet keyfi sebeplerden ötürü kapatılmıştır.');
    add_option('nedenKapaliENG', 'Access has been blocked by Telecommunication Communication Presidency.');
}
register_activation_hook( __FILE__, 'mahkemekarariyla_activate' );
function mahkemekarariyla_deactivate() {

    delete_option('nedenKapali');
    delete_option('nedenKapaliENG');
}
register_deactivation_hook( __FILE__, 'mahkemekarariyla_deactivate' );

add_action('admin_menu', 'mahkemeKarariMenu');

function mahkemeKarariMenu() {
	add_options_page('Mahkeme Kararıyla Kapat', 'Mahkeme Kararıyla Kapat', 'manage_options', 'mahkemeKarariyla', 'mahkemekarariyla_page');
}
function mahkemekarariyla_page()
{
	if(isset($_POST['nedenKapali']))
	{
		update_option('nedenKapali', $_POST["nedenKapali"]);
		update_option('nedenKapaliENG', $_POST["nedenKapaliENG"]);
	}
	?>
	<form action="" method="post">
	<label for='nedenKapali'>Geçmiş olsun, sizinkinin neyi var?</label><br><textarea name="nedenKapali"><?=get_option('nedenKapali')?></textarea><br>
	<label for='nedenKapali'>Bi de ingilizce anlat</label><br><textarea name="nedenKapaliENG"><?=get_option('nedenKapaliENG')?></textarea><br>
	<input type="submit" class="button-primary" value="göndergitsin">
	</form>
	<?php
}