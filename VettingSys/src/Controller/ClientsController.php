<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\CountryTable;

/**
 * Clients Controller
 *
 * @property \App\Model\Table\ClientsTable $Clients
 */
class ClientsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */


    public function index()
    {
        $clients = $this->paginate($this->Clients);

        $this->set(compact('clients'));
        $this->set('_serialize', ['clients']);

    }

    /**
     * View method
     *
     * @param string|null $id Client id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $client = $this->Clients->get($id, [
            'contain' => []
        ]);

        $this->set('client', $client);
        $this->set('_serialize', ['client']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $data = $this->loadModel('Country')->find('list',array('fields' => array('name')));
        $this->set('countries',$data);

        $client = $this->Clients->newEntity();
        if ($this->request->is('post')) {
            $client = $this->Clients->patchEntity($client, $this->request->data);
            if ($this->Clients->save($client)) {
                $this->Flash->success(__('The client has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The client could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('client'));
        $this->set('_serialize', ['client']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Client id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $client = $this->Clients->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $client = $this->Clients->patchEntity($client, $this->request->data);
            if ($this->Clients->save($client)) {
                $this->Flash->success(__('The client has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The client could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('client'));
        $this->set('_serialize', ['client']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Client id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $client = $this->Clients->get($id);
        if ($this->Clients->delete($client)) {
            $this->Flash->success(__('The client has been deleted.'));
        } else {
            $this->Flash->error(__('The client could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function QuickSearch(){

        $name= $_GET['Name'];
        $email= $_GET['Email'];
        if($name && !$email){
            $clients = $this->paginate($this->Clients->findAllByName($name));
        }
        elseif($email && !$name){
            $clients = $this->paginate($this->Clients->findAllByEmail($email));
        }else{
            $this->redirect(['action' => 'index']);
        }

        $this->set('clients',$clients);

        $this->set(compact('clients'));
        $this->set('_serialize', ['clients']);


    }

    public function AdvancedSearch(){

        $status1= $_GET['Status1'];
        $country = $_GET['location'];

        if($status1 && $country==0){
            $clients = $this->paginate($this->Clients->findAllByStatus($status1));
        }else{
            if($status1 && $country!=0){
                $clients = $this->paginate($this->Clients->findAllByStatusAndIdCountry($status1,$country));
            }else{
                $this->redirect(['action' => 'index']);
            }
        }

        $this->set('clients',$clients);

        $this->set(compact('clients'));
        $this->set('_serialize', ['clients']);

    }

}
