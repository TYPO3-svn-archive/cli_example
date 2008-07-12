<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2008 Julian Kleinhans (jk@web-factory.de)
*  All rights reserved
*
*  Developed for Marketing Factory Consulting GmbH
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*  A copy is found in the textfile GPL.txt and important notices to the license
*  from the author is found in LICENSE.txt distributed with these scripts.
*
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * tx_cliexample command line interface example
 *
 * The shell call is
 * /www/typo3/cli_dispatch.phpsh EXTKEY TASK
 * 
 * real example
 * /www/typo3/cli_dispatch.phpsh cli_example myFunction
 * 
 * 
 * 
 * 
 * @author	Julian Kleinhans <jk@web-factory.de>
 * @package TYPO3
 * @subpackage tx_cliexample
 */

if (!defined('TYPO3_cliMode'))  die('You cannot run this script directly!');

// Include basis cli class
require_once(PATH_t3lib.'class.t3lib_cli.php');


/**
 * Enter description here...
 *
 */
class tx_cliexample_cli extends t3lib_cli {
	
	/**
	 * Constructor
	 *
	 * @return tx_cliexample_cli
	 */
    function tx_mfcarticletocontent_cli () {

        // Running parent class constructor
        parent::t3lib_cli();

        // Setting help texts:
        $this->cli_help['name'] = 'Name of script';        
        $this->cli_help['synopsis'] = '###OPTIONS###';
        $this->cli_help['description'] = "Class with basic functionality for CLI scripts";
        $this->cli_help['examples'] = "/.../cli_dispatch.phpsh EXTKEY TASK";
        $this->cli_help['author'] = "Julian Kleinhans, (c) 2008";
    }

    /**
     * CLI engine
     *
     * @param    array        Command line arguments
     * @return    string
     */
    function cli_main($argv) {
    	
        // get task (function)
        $task = (string)$this->cli_args['_DEFAULT'][1];
        
        if (!$task){
            $this->cli_validateArgs();
            $this->cli_help();
            exit;
        }

        if ($task == 'myFunction') {
            $this->cli_echo("\n\nmyFunction will be called:\n\n");
            $this->myFunction();            
        }

        /**
         * Or other tasks
         * Which task shoud be called can you define in the shell command
         * /www/typo3/cli_dispatch.phpsh cli_example otherTask
         */
        if ($task == 'otherTask') {
            // ...         
        }
    }
    
	/**
	 * myFunction which is called over cli
	 *
	 */
    function myFunction(){
    	
    	// Output
    	$this->cli_echo("Whats your name:");
    	
    	// Input
    	$input = $this->cli_keyboardInput();
    	$this->cli_echo("\n\nHi ".$input.", your CLI script works :)\n\n");
    	
    	// Input yes/no
    	$input = $this->cli_keyboardInput_yes('You want money?');
    	if($b){
    		$this->cli_echo("\nHaha.. go working! :)\n");
    	}else{
    		$this->cli_echo("\nOh ok.. are you ill?\n");
    	}
    }
}

// Call the functionality
$cleanerObj = t3lib_div::makeInstance('tx_cliexample_cli');
$cleanerObj->cli_main($_SERVER['argv']);

?>