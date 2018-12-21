<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class ChartController extends AppController
{

    /**
     * Method to displays a view
     * @return void
     */
    public function index()
    {
        $dataRadar = $this->dataRadar();
        $dataBar = $this->dataBar();
        $dataPie = $this->dataPie();

        $this->set(['dataRadar' => $dataRadar, 'dataBar' => $dataBar, 'dataPie' => $dataPie, 'title' => 'Charts']);
    }

    /**
     * Method to get data for Radar Chart
     * @return string is a json object
     */
    public function dataRadar()
    {
        $data = [1, 2.5, 3, 4, 3.2, 5];
        return json_encode($data);
    }

    /**
     * Method to get data for Bar Chart
     * @return string is a json object
     */
    public function dataBar()
    {
        $data = [3, 2.5, 5, 4, 3.2, 1.5];
        return json_encode($data);
    }

    /**
     * Method to get data for Pie Chart
     * @return string is a json object
     */
    public function dataPie()
    {
        $data = [1.8, 2.5, 3, 4, 4.8, 5];
        return json_encode($data);
    }
}
