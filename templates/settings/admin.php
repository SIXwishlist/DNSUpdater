<?php
/** @var array $_ */
script('dnsupdater', 'admin');
style('dnsupdater', 'settings-admin');
?>

<div id="dnsupdatersettings" class="section">
	<h2><?php p($l->t('DNS Updater')); ?></h2>
	<p class="settings-hint"><?php p($l->t('Allows to update multiple DNS addresses with your public IP.')); ?></p>


	<div id="dyndnsserviceselection">
		<label for="ip-service">IP-Service:</label>
		<select id="ip-service">
			<?php foreach(json_decode($_['ipservices']) as $ipservice => $link): ?>
				<option <?php p($_['ip-service']===$ipservice ? 'selected="selected"' : ''); ?>><?php p($ipservice); ?></option>
			<?php endforeach; ?>
		</select>
		<p class="ip-service-message"> </p>

		<br>

		<label for="ip-service-fallback">IP-Service-Fallback:</label>
		<select id="ip-service-fallback">
			<?php foreach(json_decode($_['ipservices']) as $ipservice => $link): ?>
				<option <?php p($_['ip-service-fallback']===$ipservice ? 'selected="selected"' : ''); ?>><?php p($ipservice); ?></option>
			<?php endforeach; ?>
		</select>
		<p class="ip-service-message"> </p>

		<br><em><?php p($l->t('This selection will decide from which provider the IP will be received.')); ?></em>
	</div>

	<button id="dyndnsaddentry" class=""><?php p($l->t('+ Add DynDNS Entry')); ?></button>

	<div id="dyndns-entries">
		<?php
		//p((int)isset($_['savedentries'][1]));
		//p((int)isset($_['savedentries'][0]));
			if ( isset($_['savedentries'][0] )) {
				for($i=0; isset($_['savedentries'][$i]); $i++){
					$params = json_decode($_['savedentries'][$i], true);
					$params['id'] = $i;
					print_unescaped($this->inc('settings/entry', $params));
				}
			}
			else {
				print_unescaped($this->inc('settings/entry', array('id' => 0)));
			}
		?>
	</div>

	<button id="dyndnssave" class=""><?php p($l->t('Save and Test DynDNS Settings')); ?></button>

	<div id="entrytemplate">
		<?php print_unescaped($this->inc('settings/entry')); ?>
	</div>

	<?php
	var_dump($_);
	?><br><br><?php
	//var_Dump($theme);
	?>
</div>
