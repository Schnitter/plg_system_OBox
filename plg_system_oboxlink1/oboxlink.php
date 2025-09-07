<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;

class PlgSystemOboxlink extends CMSPlugin
{
    public function onAfterRender()
    {
        $app = Factory::getApplication();

        // Nur im Administratorbereich ausführen
        if (!$app->isClient('administrator')) {
            return;
        }

        $body = $app->getBody();

        // URL und Text aus Plugin-Parametern holen
        $linkUrl = $this->params->get('link_url', 'https://example.com');
        $linkText = $this->params->get('link_text', 'Mein benutzerdefinierter Link');
        $linkIcon = $this->params->get('link_icon', 'fa-solid fa-link'); // FontAwesome Icon

        // HTML für die Admin-Box
        $customLink = '
        <div style="
            margin: 10px 0;
            padding: 15px;
            background: #f5f5f5;
            border-left: 4px solid #007BFF;
            border-radius: 4px;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            font-family: Arial, sans-serif;
        ">
            <span style="font-size: 18px; margin-right: 10px;">
                <i class="' . htmlspecialchars($linkIcon) . '"></i>
            </span>
            <a href="' . htmlspecialchars($linkUrl) . '" target="_blank" style="
                text-decoration: none;
                color: #007BFF;
                font-weight: bold;
            ">
                ' . htmlspecialchars($linkText) . '
            </a>
        </div>';

        // Box oben im Dashboard einfügen
        $body = str_replace('<div id="j-main-container">', '<div id="j-main-container">' . $customLink, $body);

        $app->setBody($body);
    }
}
