<?php

/**
 * BackendContentblocksIndex
 * This is the index-action (default), it will display the contentblocks-overview
 *
 * @package		backend
 * @subpackage	contentblocks
 *
 * @author 		Davy Hellemans <davy@netlash.com>
 * @author 		Tijs Verkoyen <tijs@netlash.com>
 * @since		2.0
 */
class BackendContentblocksIndex extends BackendBaseActionIndex
{
	/**
	 * Execute the action
	 *
	 * @return	void
	 */
	public function execute()
	{
		// call parent, this will probably add some general CSS/JS or other required files
		parent::execute();

		// load the datagrid
		$this->loadDatagrid();

		// parse the datagrid
		$this->parse();

		// display the page
		$this->display();
	}


	/**
	 * Load the datagrids
	 *
	 * @return	void
	 */
	private function loadDatagrid()
	{
		// create datagrid
		$this->datagrid = new BackendDataGridDB(BackendContentblocksModel::QRY_BROWSE, array('active'));

		// set headers
		$this->datagrid->setHeaderLabels(array('title' => ucfirst(BL::getLabel('Title'))));

		// sorting columns
		$this->datagrid->setSortingColumns(array('title'));

		// add edit column
		$this->datagrid->addColumn('edit', null, BL::getLabel('Edit'), BackendModel::createURLForAction('edit') .'&id=[id]', BL::getLabel('Edit'));
	}


	/**
	 * Parse the datagrid and the reports
	 *
	 * @return	void
	 */
	private function parse()
	{
		$this->tpl->assign('datagrid', ($this->datagrid->getNumResults() != 0) ? $this->datagrid->getContent() : false);
	}
}

?>