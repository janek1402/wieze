<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Database\Exception\DatabaseException;
use PhpOffice\PhpWord\TemplateProcessor;

use Cake\I18n\Time;

class PagesController extends AppController
{
    private $wieza = ['nr_stacji', 'miejscowosc', 'adres_masztu', 'decyzja_pnb', 'nazwa_budowy', 'wyskosc', 'odstepstwa_od_projektu'];
    private $inspektor = ['nazwa', 'adres_ulica', 'adres_miasto', 'telefon', 'uprawnienia'];
    private $inwestor = ['nazwa', 'adres_ulica', 'adres_miasto', 'telefon'];
    private $kierownik = ['nazwa', 'adres_ulica', 'adres_miasto', 'telefon', 'nr_uprawnien'];
    private $przedstawiciel = ['nazwa', 'adres_ulica', 'adres_miasto', 'telefon'];

    public function index()
    {
        $this->Authorization->skipAuthorization();

        $user = $this->request->getAttribute('identity');

        if ($user['role'] === 'pracownik_polowy') {
            return $this->redirect(['controller' => 'uploads', 'action' => 'index']);
        }

        $this->loadModel('Towers');
        $this->loadModel('Templates');

        $towers = $this->Towers->find('list', ['order' => 'nr_stacji ASC']);
        $templates = $this->Templates->find('list', ['order' => 'nazwa ASC']);

        $this->set(compact('towers', 'templates'));
    }

    public function generate()
    {
        $this->Authorization->skipAuthorization();

        $user = $this->request->getAttribute('identity');

        if ($user['role'] !== 'pracownik_biurowy' and $user['role'] !== 'admin') {
            $this->Flash->error('Nie posiadasz uprawnień aby generować dokument.');
            return $this->redirect(['action' => 'index']);
        }

        $this->loadModel('Towers');
        $this->loadModel('Templates');

        $tower_id = $this->request->getData('tower_id');
        $template_id = $this->request->getData('template_id');

        $template_name = WWW_ROOT . "files/pismo_$template_id.docx";
        $tower = $this->Towers->get($tower_id, [
            'contain' => ['Investors', 'Managers', 'Inspectors', 'Representatives'],
        ]);

        $template = $this->Templates->get($template_id);

        $nr_wiezy = $tower['nr_stacji'];

        $nazwa_pisma = $template['nazwa'];
        $nazwa_pisma = preg_replace('/\s+/', '_', $nazwa_pisma); //!


        $templateProcessor = new TemplateProcessor($template_name);

        foreach ($this->wieza as $column) {
            $templateProcessor->setValue("wieza_$column", $tower[$column]);
        }

        foreach ($this->inspektor as $column) {
            $templateProcessor->setValue("inspektor_$column", $tower['inspector'][$column]);
        }

        foreach ($this->inwestor as $column) {
            $templateProcessor->setValue("inwestor_$column", $tower['investor'][$column]);
        }

        foreach ($this->kierownik as $column) {
            $templateProcessor->setValue("kierownik_$column", $tower['manager'][$column]);
        }

        foreach ($this->przedstawiciel as $column) {
            $templateProcessor->setValue("przedstawiciel_$column", $tower['representative'][$column]);
        }

        $now = Time::now();
        $data = $now->i18nFormat('dd-MM-yyyy');
        $templateProcessor->setValue("data", $data);

        $filename = $nr_wiezy . "_" . $nazwa_pisma . "_" . $data . ".docx"; //

        $tmpfname = $templateProcessor->save();


        header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
        header('Content-Disposition: attachment; filename=' . $filename);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($tmpfname));

        readfile($tmpfname);
        unlink($tmpfname);

        return $this->redirect(
            ['controller' => 'Pages', 'action' => 'index']
        );
    }
}
