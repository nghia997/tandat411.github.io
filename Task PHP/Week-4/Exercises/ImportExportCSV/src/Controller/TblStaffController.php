<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Datasource\ConnectionManager;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class TblStaffController extends AppController
{

    /**
     * Method to displays view of Home page
     * @return void
     */
    public function home()
    {
        // Set title for tis page
        $this->set(['title' => 'Import and Export file CSV']);
        // Check this request is POST or not
        if ($this->request->is('post')) {
            // Check button 'Import' on click or not
            if (isset($_POST['btnImport'])) {
                $input = ['fileImport' => $this->request->data('fileImport')];
                $validation = $this->TblStaff->validateImport($input);
                // Check validate file input
                if ($validation != null) {
                    $this->set($validation);
                } else {
                    $file = $input['fileImport']['tmp_name'];
                    $handle = fopen($file, 'r');
                    // Get first row in file CSV
                    fgetcsv($handle);
                    // Number of line in file CSV
                    $line = 1;
                    // List validate errors
                    $valid = [];
                    // Run loop to insert ervery row in file CSV
                    while ($row = fgetcsv($handle)){
                        $input['id'] = $row[0];
                        $input['name'] = $row[1];
                        $input['email'] = $row[2];
                        $input['address'] = $row[3];
                        $validation = $this->TblStaff->validateImport($input);
                        // Check validate value in row
                        if ($validation != null) {
                            $valid[] = [$validation, 'line' => $line];
                        } else {
                            $staff = $this->TblStaff->find('all', [
                                    'conditions' => ['id' => $input['id']
                                ]
                            ])->toArray();
                            // Check this record is exist or not
                            if ($staff) {
                                // Update this record
                                $thisStaff = $this->TblStaff->get($input['id']);
                                $thisStaff->name = $input['name'];
                                $thisStaff->email = $input['email'];
                                $thisStaff->address = $input['address'];
                                $this->TblStaff->save($thisStaff);
                            } else {
                                // Insert to new record
                                $staff = $this->TblStaff->newEntity();
                                $insert = $this->TblStaff->patchEntity($staff, [
                                    'id' => $input['id'],
                                    'name' => $input['name'],
                                    'email' => $input['email'],
                                    'address' => $input['address']
                                ]);
                                $this->TblStaff->save($insert);
                            }
                        }
                        $line++;
                    }
                    $this->set(['valid' => $valid]);
                    $this->Flash->success('Import success');
                }
            } else if (isset($_POST['btnExport'])) {
                // Export to new file CSV with name 'export'
                $handle = fopen('file/export.csv', 'w');
                fputcsv($handle, ['ID', 'Name', 'Email', 'Adress']);
                $listStaff = $this->TblStaff->find('all')->toArray();
                // Run loop to get every record in table 'tbl_staff' and put to file 'export.csv'
                foreach ($listStaff as $staff) {
                    $data = [$staff->id, $staff->name, $staff->email, $staff->address];
                    fputcsv($handle, $data);
                }
                fclose($handle);
                $this->Flash->success('Export success');
            }
        }
    }
}
