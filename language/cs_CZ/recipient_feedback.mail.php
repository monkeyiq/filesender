<?php 
// WARNING, this is a read only file created by import scripts
// WARNING
// WARNING,  Changes made to this file will be clobbered
// WARNING
// WARNING,  Please make changes on poeditor instead of here
// 
// 
?>
subject: Zpětná vazba od {if:target_type=="recipient"}příjemce{endif}{if:target_type=="guest"}hosta{endif} {target.email}

{alternative:plain}

Vážený uživateli,

Obdržel jsem emailem zpětnou vazbu od Vašeho {if:target_type=="recipient"}příjemce{endif}{if:target_type=="guest"}hosta{endif} {target.email}, text je přiložen.

S pozdravem,
{cfg:site_name}

{alternative:html}

<p>
    Vážený uživateli,
</p>

<p>
    Obdržel jsem emailem zpětnou vazbu od Vašeho {if:target_type=="recipient"}příjemce{endif}{if:target_type=="guest"}hosta{endif} {target.email}, text je přiložen.
</p>

<p>
    S pozdravem,<br />
    {cfg:site_name}
</p>

