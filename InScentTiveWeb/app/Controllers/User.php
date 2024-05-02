<?php

namespace App\Controllers;


use App\Models\User_model;

class User extends BaseController
{


    public function __construct()
    {
        $this->UserModel = new User_model();
    }
    public function index()
    {

        $data['user_info'] = $this->UserModel->getUserInfo();
        $data['Header'] = 'This is the new Header';
        echo view('template/header', $data);
        echo view('user/index', $data);
        echo view('template/footer');
    }

    public function createUser()
    {
        $data['Title'] = "Add User Record";

        if ($this->request->getMethod() == "POST") {
            $validation = \Config\Services::validation();

            $rules = [
                "UN" => [
                    "label" => "User Name",
                    "rules" => "required|min_length[3]|max_length[100]"
                ],
                "UFN" => [
                    "label" => "User Full Name",
                    "rules" => "required|min_length[3]|max_length[500]"
                ],
                "UE" => [
                    "label" => "User Email",
                    "rules" => "required|min_length[3]|max_length[100]"
                ],
                "UP" => [
                    "label" => "User Password",
                    "rules" => "required|min_length[1]|max_length[20]"
                ],


            ];
            if ($this->validate($rules)) {
                $postdata = array(
                    "userID" => $this->request->getVar("UID"),
                    "name" => $this->request->getVar("UN"),
                    "fullName" => $this->request->getVar("UFN"),
                    "email" => $this->request->getVar("UE"),
                    "password" => password_hash($this->request->getVar("UP"), PASSWORD_BCRYPT),

                );
                $result = $this->UserModel->insertUserRecord($postdata);
                if ($result == 1) {
                    return redirect()->to('/');
                }
            } else {
                $data["validation"] = $validation->getErrors();
            }
        }

        $data['Title'] = 'ITEC 222 Title';
        $data['Header'] = 'This is the new Header';
        echo view('template/header');
        echo view('user/addUser', $data);
        echo view('template/footer');
    }

    public function editUser($userID)
    {
        $data['Title'] = "Add USer Record";

        $data['user_info'] = $this->UserModel->getUserInfoBySN($userID);

        if ($this->request->getMethod() == "POST") {

            $validation = \Config\Services::validation();

            $rules = [

                "UN" => [
                    "label" => "User Name",
                    "rules" => "required|min_length[3]|max_length[100]"
                ],
                "UFN" => [
                    "label" => "User Full Name",
                    "rules" => "required|min_length[3]|max_length[500]"
                ],
                "UE" => [
                    "label" => "User Email",
                    "rules" => "required|min_length[3]|max_length[100]"
                ],
                "UP" => [
                    "label" => "User Password",
                    "rules" => "required|min_length[1]|max_length[20]"
                ],
            ];

            if ($this->validate($rules)) {
                $postdata = array(
                    "name" => $this->request->getVar("UN"),
                    "fullName" => $this->request->getVar("UFN"),
                    "email" => $this->request->getVar("UE"),
                    "password" => password_hash($this->request->getVar("UP"), PASSWORD_BCRYPT),
                );
                $result = $this->UserModel->updateUserRecord($postdata, $this->request->getVar("UID"));

                if ($result == 1) {
                    return redirect()->to('/');
                }
            } else {
                $data["validation"] = $validation->getErrors();
            }
        }

        $data['Title'] = 'ITEC 222 Title';
        $data['Header'] = 'This is the new Header';
        echo view('template/header');
        echo view('user/editUser', $data);
        echo view('template/footer');
    }

    public function deleteUser($id)
    {
        $result = $this->UserModel->deleteUserRecord($id);

        if ($result == 1) {
            return redirect()->to('/');
        }
    }
}
