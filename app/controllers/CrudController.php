<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: CrudController
 * 
 * Automatically generated via CLI.
 */
class CrudController extends Controller {
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $data = $this->UserModel->All();
        $this->call->view('View', $data);
    }


    public function create()
    {
        if($this->io->method() === 'post') {
            $name = $this->io->post('name');
            $email = $this->io->post('email');

            $data = [
                'name'  => $name,
                'email' => $email
            ];
            $this->UserModel->Insert($data);
            redirect('/');
        } else {
            $this->call->view('Create');
        }
    }

    public function login()
    {
        $this->call->view('Login');
    }

    public function auth()
    {
        if($this->io->method() === 'post') {
            $email = $this->io->post('email');
            $data = $this->UserModel->All();
            $user = false;
            foreach($data as $u) {
                if($u['email'] === $email) {
                    $user = true;
                    break;
                }
            }
        if (!$user) {
                echo "Invalid email address.";
                return;
            }
            echo "Login successful. Welcome, " . htmlspecialchars($email) . "!";
      }   
    }

    public function update($id)
    {
        if($this->io->method() === 'post') {
            $name = $this->io->post('name');
            $email = $this->io->post('email');

            $data = [
                'name'  => $name,
                'email' => $email
            ];
            $this->UserModel->Update($id, $data);
            redirect('/');
        } else {
            $data = $this->UserModel->Find($id);
            $this->call->view('Update', $data);
        }
    }

    public function delete($id)
    {
        $this->UserModel->Delete($id);
        redirect('/');
    }
}