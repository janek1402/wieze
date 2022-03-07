<?php

declare(strict_types=1);

namespace App\Controller;

use App\MyHelpers\Functions;

class UploadsController extends AppController
{
    public function index()
    {
        $this->Authorization->skipAuthorization();

        $stages = Functions::$stages;

        $this->loadModel('Towers');

        $towers = $this->Towers->find('list', ['order' => 'nr_stacji ASC']);

        if ($this->request->is('post')) {
            $tower_id = $this->request->getData('tower_id');
            $stage_id = $this->request->getData('stage_id');

            $filesArray = $this->request->getData('files');

            $directory = WWW_ROOT . "docs/$tower_id/$stage_id";
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }

            $tumb_directory = WWW_ROOT . "docs/$tower_id/$stage_id/tumb";
            if (!file_exists($tumb_directory)) {
                mkdir($tumb_directory, 0777, true);
            }

            foreach ($filesArray as  $file) {
                $tmp_name = $file->getStream()->getMetadata('uri');
                $info = getimagesize($tmp_name);
                if ($info !== FALSE and (($info[2] === IMAGETYPE_GIF) or ($info[2] === IMAGETYPE_JPEG) or ($info[2] === IMAGETYPE_PNG))) {
                    $type = Functions::getImageExtension($info[2]);
                    $file_with_tumb = Functions::createTempFileWithTumb($directory, 'img', $type);
                    $filename = $file_with_tumb[0];
                    $tumbname = $file_with_tumb[1];
                    $file->moveTo($filename);
                    Functions::createTumb($filename, $tumbname);
                }
                else{
                    unlink($tmp_name);
                }
            }

            $this->Flash->success(__('Zdjęcia zostały zapisane.'));
            return $this->redirect(['controller' => 'towers', 'action' => 'view', $tower_id]);
        }

        $this->set(compact('towers', 'stages'));
    }
}
