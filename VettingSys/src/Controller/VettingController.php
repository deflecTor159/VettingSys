<?php
namespace App\Controller;

use Cake\Mailer\Email;


/**
 * Vetting Controller
 *
 * @property \App\Model\Table\VettingTable $Vetting
 */
class VettingController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */

    public function index()
    {
        $vetting = $this->paginate($this->Vetting);
        $this->set(compact('vetting'));
        $this->set('_serialize', ['vetting']);
    }

    /**
     * View method
     *
     * @param string|null $id Vetting id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vetting = $this->Vetting->get($id, [
            'contain' => []
        ]);

        $this->set('vetting', $vetting);
        $this->set('_serialize', ['vetting']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {



        $vetting = $this->Vetting->newEntity();
        if ($this->request->is('post')) {
            $vetting = $this->Vetting->patchEntity($vetting, $this->request->data);
            if ($this->Vetting->save($vetting)) {
                $this->Flash->success(__('The vetting has been saved.'));
                //Email
                $emailAddress=$this->request->session()->read('Auth.User')['email'];
                $username=$this->request->session()->read('Auth.User')['username'];
                $email = new Email('gmail');
                $email->from(['vettingsys@gmail.com' => 'Access Now Vetting System']);
                        $email ->to($emailAddress);
                        //$email ->message("Hi, " .$username. " \n\n\r\n\" A new Vetting Process has been created!!" );
                        $email ->subject('New Vetting Process Created');
                        $email ->send("Hi, " .$username. " \n\n\r\n" ."A new Vetting Process has been created!!");

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The vetting could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('vetting'));
        $this->set('_serialize', ['vetting']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Vetting id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vetting = $this->Vetting->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vetting = $this->Vetting->patchEntity($vetting, $this->request->data);
            if ($this->Vetting->save($vetting)) {
                $this->Flash->success(__('The vetting has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The vetting could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('vetting'));
        $this->set('_serialize', ['vetting']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Vetting id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vetting = $this->Vetting->get($id);
        if ($this->Vetting->delete($vetting)) {
            $this->Flash->success(__('The vetting has been deleted.'));
        } else {
            $this->Flash->error(__('The vetting could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
