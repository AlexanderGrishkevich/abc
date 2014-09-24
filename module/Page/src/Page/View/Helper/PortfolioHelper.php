<?php
namespace Page\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceManager;

use Page\Model\PortfolioTable;
 
class PortfolioHelper extends AbstractHelper {
    public function __invoke() {

        $dbAdapter = $this->serviceLocator->get('DbAdapter');
        $portfolioTable = new PortfolioTable($dbAdapter);
        $portfolios = $portfolioTable->fetchAll()->toArray();
        
        return $this->getView()->render('partial/portfolio', array('portfolios' => $portfolios, 'portfolioTable' => $portfolioTable));
    }

    public function setServiceLocator(ServiceManager $serviceLocator) {
        $this->serviceLocator = $serviceLocator;
    }
}
