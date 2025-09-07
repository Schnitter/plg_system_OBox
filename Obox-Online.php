<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\HTML\HTMLHelper;

class PlgSystemCustomlink extends CMSPlugin
{
    public function onAfterRender()
    {
        $app = Factory::getApplication();

        // Nur im Administratorbereich ausführen
        if (!$app->isClient('administrator')) {
            return;
        }

        $body = $app->getBody();

        // Hier deinen benutzerdefinierten Link definieren
        $customLink = '<div style="margin:10px 0; padding:5px; background:#f0f0f0; border:1px solid #ccc;">
            <a href="https://example.com" target="_blank">Mein benutzerdefinierter Link</a>
        </div>';

        // Den Link ganz oben im Dashboard hinzufügen
        $body = str_replace('<div id="j-main-container">', '<div id="j-main-container">' . $customLink, $body);

        $app->setBody($body);
    }
}
