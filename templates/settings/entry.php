<div class="entry" id="entry<?php p($_['id']); ?>">
    <div class="deletewrapper">
        <div class="deleteicon" title="<?php p('Delete this entry.'); ?>"></div>
    </div>
    <label>
        Provider:
        <select name="provider">
            <?php foreach(json_decode($_['dnsservices']) as $dnsservice => $link): ?>
                <option <?php p($_['provider'] === $dnsservice ? 'selected="selected"' : ''); ?>><?php p($dnsservice); ?></option>
            <?php endforeach; ?>
        </select>
    </label>

    <label>
        Username:
        <input name="username" type="text" value="<?php p($_['user']); ?>">
    </label>

    <label>
        Password:
        <input name="password" type="password"  value="<?php p($_['password']); ?>">
    </label>
    <br>
    <label>
        Domain:
        <input name="domain" type="text"  value="<?php p($_['domain']); ?>">
    </label>

    <label>
        Parameter:
        <input name="params" type="text"  value="<?php p($_['params']); ?>">
    </label>

    <label>
        Https:
        <input name="usehttps" type="checkbox" <?php p((bool)$_['https'] ? 'checked="checked"' : ''); ?>>
    </label>
</div>
