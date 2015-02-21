<?php
/**
 * i-MSCP ClamAV plugin
 * Copyright (C) 2013-2015 Laurent Declercq <l.declercq@nuxwin.com>
 * Copyright (C) 2013-2015 Rene Schuster <mail@reneschuster.de>
 * Copyright (C) 2013-2015 Sascha Bay <info@space2place.de>
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

return array(
	/**
	 * Clamav-milter configuration options
	 * 
	 * For more information about the different configuration options please check 'man clamav-milter.conf'.
	 * 
	 * Warning: Don't change anything if you don't know what you are doing. Be aware that when changing the port of the
	 * Postfix smtpd_milter for ClamAV require to rerun the i-MSCP setup script.
	 */

	// Postfix smtpd_milter for ClamAV ( default: inet:localhost:32767 )
	//
	// Possible values:
	//  inet:localhost:32767 ( for connection through TCP )
	//  unix:/clamav/clamav-milter.ctl ( for connection through socket )
	'PostfixMilterSocket' => 'inet:localhost:32767',

	/**
	 * The following configuration options are added in the /etc/clamav/clamav-milter.conf file
	 *
	 * Note: If one options is missing, just add it with it name and it will be automatically added.
	 *
	 * See man clamav-milter.conf for further details about these options.
	 */

	// Main options

	'MilterSocket' => 'inet:32767@localhost',
	'MilterSocketGroup' => 'clamav',
	'MilterSocketMode' => '666',
	'FixStaleSocket' => 'true',
	'User' => 'clamav',
	'AllowSupplementaryGroups' => 'true',
	'ReadTimeout' => '120',
	'Foreground' => 'false',
	'PidFile' => '/var/run/clamav/clamav-milter.pid',
	'TemporaryDirectory' => '/tmp',

	// Clamd options

	'ClamdSocket' => 'unix:/var/run/clamav/clamd.ctl',

	// Exclusions

	'MaxFileSize' => '25M',

	// Actions

	'OnClean' => 'Accept',
	'OnInfected' => 'Reject',
	'OnFail' => 'Defer',
	'RejectMsg' => 'Blocked by ClamAV - FOUND VIRUS: %v',
	'AddHeader' => 'Replace',
	'VirusAction' => '',

	// 'VirusAction' => ''
	'LogFile' => '/var/log/clamav/clamav-milter.log',
	'LogFileUnlock' => 'false',
	'LogFileMaxSize' => '0M',
	'LogTime' => 'true',
	'LogSyslog' => 'true',
	'LogFacility' => 'LOG_MAIL',
	'LogVerbose' => 'false',
	'LogInfected' => 'Basic',
	'LogClean' => 'Off',
	'LogRotate' => 'true',
	'SupportMultipleRecipients' => 'false'
);
