<?php
/**
 * i-MSCP Postgrey plugin
 * @copyright 2015-2017 Laurent Declercq <l.declercq@nuxwin.com>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

use iMSCP_Plugin_Action as PluginAction;
use iMSCP_Plugin_Exception as PluginException;
use iMSCP_Plugin_Manager as PluginManager;
use iMSCP_Registry as Registry;

/**
 * Class iMSCP_Plugin_Postgrey
 */
class iMSCP_Plugin_Postgrey extends PluginAction
{
    /**
     * Plugin installation
     *
     * @throws iMSCP_Plugin_Exception
     * @param PluginManager $pluginManager
     * @return void
     */
    public function install(PluginManager $pluginManager)
    {
        // Only there to force installation context, else distribution packages
        // won't be installed and an error will be raised
    }

    /**
     * Plugin activation
     *
     * @throws PluginException
     * @param PluginManager $pluginManager
     * @return void
     */
    public function enable(PluginManager $pluginManager)
    {
        try {
            # Make sure that Postgrey smtp restriction is evaluated first. This is based on plugin_priority field.
            if ($pluginManager->pluginIsKnown('PolicydWeight')
                && $pluginManager->pluginIsEnabled('PolicydWeight')
            ) {
                $pluginManager->pluginChange('PolicydWeight');
            }

            Registry::get('dbConfig')->set(
                'PORT_POSTGREY',
                $this->getConfigParam('postgrey_port', 10023) . ';tcp;POSTGREY;1;127.0.0.1'
            );
        } catch (Exception $e) {
            throw new PluginException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Plugin deactivation
     *
     * @throws PluginException
     * @param PluginManager $pluginManager
     * @return void
     */
    public function disable(PluginManager $pluginManager)
    {
        try {
            Registry::get('dbConfig')->del('PORT_POSTGREY');
        } catch (Exception $e) {
            throw new PluginException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
