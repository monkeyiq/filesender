<?php 
// WARNING, this is a read only file created by import scripts
// WARNING
// WARNING,  Changes made to this file will be clobbered
// WARNING
// WARNING,  Please make changes on poeditor instead of here
// 
// 
?>
subject: Pozvánka pro hosta odeslána

{alternative:plain}

Vážený uživateli,

Pozvánka umožňující přístup k {cfg:site_name} byla odeslána na {guest.email}.

S pozdravem,
{cfg:site_name}

{alternative:html}

<p>
    Vážený uživateli,
</p>

<p>
    Pozvánka umožňující přístup k  <a href="{cfg:site_url}">{cfg:site_name}</a> byla odeslána na <a href="mailto:{guest.email}">{guest.email}</a>.
</p>

<p>
    S pozdravem,<br />
    {cfg:site_name}
</p>

