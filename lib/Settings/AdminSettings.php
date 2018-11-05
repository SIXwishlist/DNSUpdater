<?php
/**
 * @copyright Copyright (c) 2017 Joas Schilling <coding@schilljs.com>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */
namespace OCA\DNSUpdater\Settings;

use OCP\AppFramework\Http\TemplateResponse;
use OCP\Settings\ISettings;
use OCP\IConfig;

class AdminSettings implements ISettings {

        /** @var IConfig */
        private $config;

        /**
         * Admin constructor.
         *
         * @param IConfig $config
         */
        public function __construct(IConfig $config) {
                $this->config = $config;
        }

        /**
         * @return TemplateResponse
         */
        public function getForm() {
            $savedentries = array();
            for($i=0; $this->config->getAppValue('dnsupdater', (string)$i) !== ''; $i++){
                $savedentries[] = $this->config->getAppValue('dnsupdater', (string)$i);
            }
            return new TemplateResponse(
                'dnsupdater',
                'settings/admin',
                array(
                    'ip-service' => $this->config->getAppValue('dnsupdater','ip-service'),
                    'ip-service-fallback' => $this->config->getAppValue('dnsupdater','ip-service-fallback'),
                    'ipservices' => $this->config->getAppValue('dnsupdater','ipservices'),
                    'dnsservices' => $this->config->getAppValue('dnsupdater','dnsservices'),
                    'savedentries' => $savedentries,
                )
            );
        }

        /**
         * @return string the section ID, e.g. 'sharing'
         */
        public function getSection() {
                return 'additional';
        }

        /**
         * @return int whether the form should be rather on the top or bottom of
         * the admin section. The forms are arranged in ascending order of the
         * priority values. It is required to return a value between 0 and 100.
         */
        public function getPriority() {
                return 50;
        }

}
