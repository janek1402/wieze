<?php

declare(strict_types=1);

namespace App\Controller;

use App\MyHelpers\Functions;

/**
 * Towers Controller
 *
 * @property \App\Model\Table\TowersTable $Towers
 * @method \App\Model\Entity\Tower[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TowersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();

        $this->paginate = [
            'contain' => ['Investors', 'Managers', 'Inspectors', 'Representatives'],
        ];
        $towers = $this->paginate($this->Towers);

        $this->set(compact('towers'));
    }

    /**
     * View method
     *
     * @param string|null $id Tower id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();

        $tower = $this->Towers->get($id, [
            'contain' => ['Investors', 'Managers', 'Inspectors', 'Representatives'],
        ]);

        //pliki uploadowne
        $images_ext = ['jpg', 'jpeg', 'png', 'gif'];
        $stages = Functions::$stages;

        $images = [];
        $other_documents = [];
        foreach ($stages as $key => $value) {

            $images[$key] = [];
            $other_documents[$key] = [];
            $directory = WWW_ROOT . "docs/$id/$key/*";
            $files = glob($directory);
            foreach ($files as $value) {
                if (is_file($value)) {
                    $file_parts = pathinfo($value);
                    if (in_array(strtolower($file_parts['extension']), $images_ext)) {
                        $images[$key][] = $file_parts['basename'];
                    } else {
                        $other_documents[$key][] = $file_parts['basename'];
                    }
                }
            }
        }

        $this->set(compact('tower', 'images', 'other_documents', 'stages'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tower = $this->Towers->newEmptyEntity();
        $this->Authorization->authorize($tower);
        if ($this->request->is('post')) {
            $tower = $this->Towers->patchEntity($tower, $this->request->getData());
            if ($this->Towers->save($tower)) {
                $this->Flash->success(__('The tower has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tower could not be saved. Please, try again.'));
        }
        $investors = $this->Towers->Investors->find('list', ['limit' => 200]);
        $managers = $this->Towers->Managers->find('list', ['limit' => 200]);
        $inspectors = $this->Towers->Inspectors->find('list', ['limit' => 200]);
        $representatives = $this->Towers->Representatives->find('list', ['limit' => 200]);
        $this->set(compact('tower', 'investors', 'managers', 'inspectors', 'representatives'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tower id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tower = $this->Towers->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($tower);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tower = $this->Towers->patchEntity($tower, $this->request->getData());
            if ($this->Towers->save($tower)) {
                $this->Flash->success(__('The tower has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tower could not be saved. Please, try again.'));
        }
        $investors = $this->Towers->Investors->find('list', ['limit' => 200]);
        $managers = $this->Towers->Managers->find('list', ['limit' => 200]);
        $inspectors = $this->Towers->Inspectors->find('list', ['limit' => 200]);
        $representatives = $this->Towers->Representatives->find('list', ['limit' => 200]);
        $this->set(compact('tower', 'investors', 'managers', 'inspectors', 'representatives'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tower id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tower = $this->Towers->get($id);
        $this->Authorization->authorize($tower);
        if ($this->Towers->delete($tower)) {
            $this->Flash->success(__('The tower has been deleted.'));
        } else {
            $this->Flash->error(__('The tower could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function deleteImages()
    {
        if ($this->request->is('post')) {
            $tower_id = $this->request->getData('tower_id');
            $stage_id = $this->request->getData('stage_id');

            $tower = $this->Towers->get($tower_id);
            $this->Authorization->authorize($tower);

            $todelete = $this->request->getData('todelete');

            foreach ($todelete as $img) {
                $img_name = WWW_ROOT . "docs/$tower_id/$stage_id/$img";
                $tumb_name = WWW_ROOT . "docs/$tower_id/$stage_id/tumb/$img";

                unlink($img_name);
                unlink($tumb_name);
            }

            $this->Flash->success('Zdjęcia zostały usunięte.');

            return $this->redirect(
                ['controller' => 'Towers', 'action' => 'view', $tower_id]
            );
        } else {
            $this->Flash->error('Spadaj hakerze.');

            return $this->redirect(
                ['controller' => 'Towers', 'action' => 'index']
            );
        }
    }

    //pobieranie obrazków z wieży o nr $id i etapu etap_id
    public function getImages($id, $etap_id)
    {
        $tower = $this->Towers->get($id);
        $this->Authorization->authorize($tower);

        $zipName = tempnam(WWW_ROOT . "docs/", "zip");
        $imagesDirectory = WWW_ROOT . "docs/$id/$etap_id/";

        $this->zipData($imagesDirectory, $zipName);

        header("Content-Type: application/zip");
        header('Content-Disposition: attachment; filename=' . $tower['nr_stacji'] . "_" . Functions::$stages[$etap_id] . "_foto" . ".zip");
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($zipName));

        readfile($zipName);
        unlink($zipName);

        return $this->redirect(
            ['controller' => 'Towers', 'action' => 'view', $id]
        );
    }

    private function zipData($source, $destination)
    {
        if (extension_loaded('zip')) {
            if (file_exists($source)) {
                $zip = new \ZipArchive();
                if ($zip->open($destination, \ZIPARCHIVE::CREATE)) {
                    $source = realpath($source);
                    if (is_dir($source)) {
                        $iterator = new \RecursiveDirectoryIterator($source);
                        // skip dot files while iterating 
                        $iterator->setFlags(\RecursiveDirectoryIterator::SKIP_DOTS);
                        $files = new \RecursiveIteratorIterator($iterator, \RecursiveIteratorIterator::SELF_FIRST);
                        foreach ($files as $file) {
                            $file = $file->getPathname();
                            if (is_dir($file)) {
                                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                            } else if (is_file($file)) {
                                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                            }
                        }
                    } else if (is_file($source)) {
                        $zip->addFromString(basename($source), file_get_contents($source));
                    }
                }
                return $zip->close();
            } else {
                $this->Flash->error('Nie ma jeszcze żadnych zdjęć z tego etapu.');
            }
        }
        return false;
    }
}
