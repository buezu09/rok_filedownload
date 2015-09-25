<?php
namespace ROLAND\RokFiledownload\Domain\Model;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Alex Lötscher <al@frontal.ch>, Agentur Frontal AG
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Room
 */
class Filter extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
	
	/**
	 * category
	 *
	 * @var \ROLAND\RokFiledownload\Domain\Model\Category
	 * @lazy
	 */
	protected $category;	

	/**
	 * Returns the category
	 *
	 * @return \ROLAND\RokFiledownload\Domain\Model\Category $category
	 */
	public function getCategory() {
		return $this->category;
	}
	
	/**
	 * Sets the category
	 *
	 * @param \ROLAND\RokFiledownload\Domain\Model\Category $category
	 * @return void
	 */
	public function setCategory($category) {
		$this->category = $category;
	}	
		
	protected function objectStorageToUidArray($storageObject){
		if(!($storageObject instanceof \TYPO3\CMS\Extbase\DomainObject\ObjectStorage)) return array();
		$storageArray = $storageObject->toArray();
		$uidArray = array();
		foreach($storageArray as $storageElement){
			$uidArray[] = $storageElement->getUid();
		}
		return $uidArray;
	}
	
		
	public function __sleep() {
		
		// replace objects with uids to save minimize the saved session data
		// the object will be restored by system from the uid in the _wakeup()-function

		if(is_object($this->category)) $this->category = $this->category->getUid();
		
		if(is_object($this->category)) $this->category = $this->objectStorageToUidArray($this->category);

		return array('category');
	}
}
?>