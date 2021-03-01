<!DOCTYPE html>
<?php
    $headerclass = "header";

    try {
        if (Auth::isAuthenticated()) {
            if (Auth::isAdmin()) {
            
                $uid = Utilities::arrayKeyOrDefault( $_GET, 'uid', 0, FILTER_VALIDATE_INT  );
                if( $uid ) {
                    if( Config::get('admin_can_view_user_transfers_page')) {
                        $headerclass = 'headeruid';
                    }
                }
            }
        }
    } catch (Exception $e) {
        // this is just for $headerclass if they are a superuser.
        // nothing to do on failure
    }


$var="ccc";
$LanguageSelectorShown = false;
$LanguageSelectorOptions = array();

if(Config::get('lang_selector_enabled') && (count(Lang::getAvailableLanguages()) > 1)) {
    $LanguageSelectorShown   = true;
    $LanguageSelectorOptions = array();
    $code = Lang::getCode();
    foreach(Lang::getAvailableLanguages() as $id => $dfn) {
        $selected = ($id == $code) ? 'selected="selected"' : '';
        $LanguageSelectorOptions[] = '<option value="'.$id.'" '.$selected.'>'.Utilities::sanitizeOutput($dfn['name']).'</option>';
    }
}

?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo Lang::getCode() ?>" xml:lang="<?php echo Lang::getCode() ?>">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        
        <title><?php echo htmlspecialchars(Config::get('site_name')); ?></title>

        <?php GUI::includeStylesheets() ?>
        
        <?php GUI::includeFavicon() ?>
        
        <?php GUI::includeScripts() ?>
        
        <script type="text/javascript" src="{path:filesender-config.js.php}"></script>
        
        <script type="text/javascript" src="{path:rest.php/lang?callback=lang.setTranslations}"></script>
        
        <meta name="robots" content="noindex, nofollow" />
        
        <meta name="auth" content="noindex, nofollow" />
    </head>
    
    <body data-security-token="<?php echo Utilities::getSecurityToken() ?>" data-auth-type="<?php echo Auth::type() ?>">

    <div class="container sticky-top filesender-topcontent ">
        <header class="filesender-header py-3 ">
             
            <div class="row" id="header"></div>

            <div class="row">
                <div class="col-12" >
                    <?php if($LanguageSelectorShown): ?>
                        <div class="form-inline float-right">
                            <div class="form-group">
                                <label for="language_selector" class="mr-1"><?php echo Lang::tr('user_lang') ?></label>
                                <select class="form-control" id="language_selector"><?php echo implode('', $LanguageSelectorOptions) ?></select>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>


            

