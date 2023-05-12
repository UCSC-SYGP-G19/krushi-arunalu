<?php

/**
 * @file
 * Controller which handles purchased stocks of Manufacturers
 */

namespace app\controllers;

use app\core\Controller;
use app\helpers\Session;

class PurchasedStocksController extends Controller
{
    public function index(): void
    {
        $this->loadView('Manufacturer/PurchasedStocksPage', 'Purchased Stocks', 'purchased-stocks');
        $this->view->render();
    }

    public function getJsonForPurchasedStocks(): void
    {
        $this->loadModel('PurchasedStock');
        $this->sendArrayAsJson($this->model->getByOrderStatus(Session::getSession()->id));
    }

    public function sendUpdatedQuantity($stockItemId): bool
    {
        $this->loadModel('PurchasedStock');

        $this->model->fillData([
            "totalQuantity" => $_POST["totalQuantity"],
            "stockItemId" => $stockItemId
        ]);

        if ($this->model->updateStockQuantityInDb()) {
            http_response_code(200);
            $this->sendArrayAsJson(["Message" => "Successfully updated"]);
            return true;
        } else {
            http_response_code(500);
            return false;
        }
    }
}
