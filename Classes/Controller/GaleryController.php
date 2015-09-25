<?php
namespace ROLAND\RokFiledownload\Controller;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Kneub
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
 * GaleryController
 */
class GaleryController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * galeryRepository
	 *
	 * @var \ROLAND\RokFiledownload\Domain\Repository\GaleryRepository
	 * @inject
	 */
	protected $galeryRepository = NULL;

	/**
	 * categoryRepository
	 *
	 * @var \ROLAND\RokFiledownload\Domain\Repository\CategoryRepository
	 * @inject
	 */
	protected $categoryRepository = NULL;

	/**
	 * sessionStorageService
	 *
	 * @var \Tx_FagExtbase_Service_SessionStorageService
	 * @inject
	 */
	protected $sessionStorageService;

	/**
	 * filter
	 *
	 * @var \ROLAND\RokFiledownload\Domain\Model\Filter
	 * @inject
	 */
	protected $filter = NULL;

	/**
	 * action list
	 *
	 * @param \ROLAND\RokFiledownload\Domain\Model\Filter $filter
	 * @param boolean $filterReset
	 * @return void
	 */
	public function listAction($filter = NULL, $filterReset = NULL) {

		if($filterReset){
			$filter = $this->objectManager->create('ROLAND\\RokFiledownload\\Domain\\Model\\Filter');
        }

        $filter = $this->sessionStorageService->getAndSet('filter', 'ROLAND\\RokFiledownload\\Domain\\Model\\Filter', $filter);

		$this->view->assign('filter', $filter);
		$this->view->assign('galeries', $this->galeryRepository->findByFilter($filter));

		$this->view->assign('categories', $this->categoryRepository->findAll());

		//$galeries = $this->galeryRepository->findAll();
		//$this->view->assign('galeries', $galeries);
	}

	/**
	 * action show
	 *
	 * @param \ROLAND\RokFiledownload\Domain\Model\Galery $galery
	 * @return void
	 */
	public function showAction(\ROLAND\RokFiledownload\Domain\Model\Galery $galery) {
		$this->view->assign('galery', $galery);
	}

}