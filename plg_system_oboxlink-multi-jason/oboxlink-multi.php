<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;

class PlgSystemOboxlinkMulti extends CMSPlugin
{
    public function onAfterRender()
    {
        $app = Factory::getApplication();

        // Nur im Administratorbereich ausführen
        if (!$app->isClient('administrator')) {
            return;
        }

        $body = $app->getBody();

        // Links aus Plugin-Parametern holen (JSON)
        $links = json_decode($this->params->get('links_json', '[]'), true);

        if (!empty($links)) {
            $customHtml = '<div style="display:flex; flex-wrap:wrap; gap:10px; margin-bottom:10px;">';

            foreach ($links as $link) {
                $url = htmlspecialchars($link['url'] ?? '#');
                $text = htmlspecialchars($link['text'] ?? 'Link');
                $icon = htmlspecialchars($link['icon'] ?? 'fa-solid fa-link');

                $customHtml .= '
                <div style="
                    flex:1 1 200px;
                    min-width:180px;
                    padding:15px;
                    background:#f5f5f5;
                    border-left:4px solid #007BFF;
                    border-radius:4px;
                    display:flex;
                    align-items:center;
                    box-shadow:0 2px 4px rgba(0,0,0,0.05);
                    font-family:Arial,sans-serif;
                ">
                    <span style="font-size:18px; margin-right:10px;">
                        <i class="' . $icon . '"></i>
                    </span>
                    <a href="' . $url . '" target="_blank" style="
                        text-decoration:none;
                        color:#007BFF;
                        font-weight:bold;
                    ">
                        ' . $text . '
                    </a>
                </div>';
            }

            $customHtml .= '</div>';

            // Boxen oben im Dashboard einfügen
            $body = str_replace('<div id="j-main-container">', '<div id="j-main-container">' . $customHtml, $body);
            $app->setBody($body);
        }
    }
}
