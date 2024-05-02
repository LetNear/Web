<?php

namespace App\Controllers;


use App\Models\User_model;


class Api extends BaseController
{


    public function __construct()
    {
        $this->UserModel = new User_model();
    }

    public function users()
    {
        $users = $this->UserModel->getUserInfo();
        $response = [
            'code' => 200,
            'message' => 'Successfully fetched users',
            'data' => $users
        ];

        return $this->response->setJSON($response);
    }

    public function getUser($id)
    {
        $user = $this->UserModel->getUserInfoBySN($id);

        if (!$user) {
            $response = [
                'code' => 404,
                'message' => "No user found with id = $id",
                'data' => [],
            ];
        }

        $response = [
            'code' => 200,
            'message' => "Successfully fetched user with id = $id",
            'data' => $user
        ];

        return $this->response->setJSON($response);
    }

    public function deleteUser($id)
    {
        $user = $this->UserModel->getUserInfoBySN($id);
        $this->UserModel->deleteUserRecord($id);

        return $this->response->setJSON([
            'code' => 200,
            'message' => 'User successfully deleted',
            'data' => $user,
        ]);
    }

    public function createUser()
    {
        $name = $this->request->getPost('UN');
        $fullName = $this->request->getPost('UFN');
        $email = $this->request->getPost('UE');
        $password = $this->request->getPost('UP');

        $userData = [
            'name' => $name,
            'fullName' => $fullName,
            'email' => $email,
            'password' => $password,
        ];

        $user = $this->UserModel->insertUserRecord($userData);

        if (!$user) {
            $response = [
                'code' => 500,
                'message' => "There was an unexpected error",
                'data' => $userData,
            ];
        }
        $response = [
            'code' => 200,
            'message' => 'Success',
            'data' => $user,
        ];

        return $this->response->setJSON($response);
    }

    public function updateUser($id)
    {
        $input = $this->request->getRawInput();
        $userData = $this->UserModel->getUserInfoBySN($id);
        $name = $input['UN'];
        $fullName = $input['UFN'];
        $email = $input['UE'];
        $password = $input['UP'];

        $userData = [
            'name' => $name,
            'fullName' => $fullName,
            'email' => $email,
            'password' => $password,
        ];

        $user = $this->UserModel->updateUserRecord($userData, $id);


        if (!$user) {
            $response = [
                'code' => 500,
                'message' => "There was an unexpected error",
                'data' => $userData,
            ];
        }

        $userData = $this->UserModel->getUserInfoBySN($id);

        $response = [
            'code' => 200,
            'message' => 'Success',
            'data' => $userData,
        ];

        return $this->response->setJSON($response);
    }


    // public function plant($PID = null)
    // {
    //     $method = $this->request->getMethod();

    //     if ($method == 'get') {
    //         if ($PID) {
    //             $plant_info = $this->PlantModel->getPlantInfoBySN($PID);

    //             $respData = [
    //                 'meta' => array(
    //                     'code' => 200,
    //                     'message' => 'Get Plant Record',
    //                 ),
    //                 'data' => array(
    //                     'plant_info' => $plant_info,
    //                 ),
    //             ];
    //         } else {
    //             $plant_info = $this->PlantModel->getPlantInfo();
    //             $respData = [
    //                 'meta' => array(
    //                     'code' => 200,
    //                     'message' => 'Get Plant Record',
    //                 ),
    //                 'data' => array(
    //                     'plant_info' => $plant_info,
    //                 ),
    //             ];
    //         }


    //         // $student_info = $this->StudentModel->getStudentInfo();

    //         // $respData = [
    //         //     'meta' => array(
    //         //         'code' => 200,
    //         //         'message' => 'Get Student Record',
    //         //     ),
    //         //     'data' => array(
    //         //         'student_info' => $student_info,
    //         //     ),
    //         // ];
    //     } else if ($method == 'post') {
    //         $postData = $this->request->getPost();

    //         if ($postData) {
    //             if (
    //                 isset($postData['PID']) &&
    //                 isset($postData['PN']) &&
    //                 isset($postData['PD']) &&
    //                 isset($postData['PM']) &&
    //                 isset($postData['PP'])

    //             ) {

    //                 try {
    //                     $PID = $postData['PID'];
    //                     $PN = $postData['PN'];
    //                     $PD = $postData['PD'];
    //                     $PM = $postData['PM'];
    //                     $PP = $postData['PP'];


    //                     if (!$PID) {
    //                         $respData = [
    //                             'meta' => array(
    //                                 'code' => 412,
    //                                 'message' => 'Plant ID is Required',
    //                             ),
    //                             'data' => array(),
    //                         ];
    //                         return $this->response->setJSON($respData);

    //                     }
    //                     if (!$PN) {
    //                         $respData = [
    //                             'meta' => array(
    //                                 'code' => 412,
    //                                 'message' => 'Plant Name is Required',
    //                             ),
    //                             'data' => array(),
    //                         ];
    //                         return $this->response->setJSON($respData);

    //                     }
    //                     if (!$PD) {
    //                         $respData = [
    //                             'meta' => array(
    //                                 'code' => 412,
    //                                 'message' => 'Plant Description is Required',
    //                             ),
    //                             'data' => array(),
    //                         ];
    //                         return $this->response->setJSON($respData);

    //                     }
    //                     if (!$PM) {
    //                         $respData = [
    //                             'meta' => array(
    //                                 'code' => 412,
    //                                 'message' => 'Plant Image is Required',
    //                             ),
    //                             'data' => array(),
    //                         ];
    //                         return $this->response->setJSON($respData);

    //                     }

    //                     if (!$PP) {
    //                         $respData = [
    //                             'meta' => array(
    //                                 'code' => 412,
    //                                 'message' => 'Plant Price is Required',
    //                             ),
    //                             'data' => array(),
    //                         ];
    //                         return $this->response->setJSON($respData);

    //                     }
    //                     $postdata = array(
    //                         "plantID" => $PID,
    //                         "plantName" => $PN,
    //                         "plantDescription" => $PD,
    //                         "plantImage" => $PM,
    //                         "plantPrice" => $PP,

    //                     );
    //                     $result = $this->PlantModel->insertPlantRecord($postdata);

    //                     if ($result == 1) {
    //                         $respData = [
    //                             'meta' => array(
    //                                 'code' => 200,
    //                                 'message' => 'Plant Record Successfully Inserted',
    //                             ),
    //                             'data' => array(),
    //                         ];
    //                     } else {
    //                         $respData = [
    //                             'meta' => array(
    //                                 'code' => 500,
    //                                 'message' => $result,
    //                             ),
    //                             'data' => array(),
    //                         ];
    //                     }


    //                 } catch (\Exception $e) {
    //                     die($e->getMessage());
    //                 }

    //             } else {
    //                 $respData = [
    //                     'meta' => array(
    //                         'code' => 301,
    //                         'message' => 'Bad request. Plant ID, Plant Name, Plant Description, Plant Image, Plant Price is Required',
    //                     ),
    //                 ];
    //             }
    //         }

    //     } else if ($method == 'put') {

    //         $postData = $this->request->getRawInput();

    //         if ($postData) {
    //             if (
    //                 isset($postData['PID']) &&
    //                 isset($postData['PN']) &&
    //                 isset($postData['PD']) &&
    //                 isset($postData['PM']) &&
    //                 isset($postData['PP'])
    //             ) {

    //                 try {
    //                     $PID = $postData['PID'];
    //                     $PN = $postData['PN'];
    //                     $PD = $postData['PD'];
    //                     $PM = $postData['PM'];
    //                     $PP = $postData['PP'];


    //                     if (!$PID) {
    //                         $respData = [
    //                             'meta' => array(
    //                                 'code' => 412,
    //                                 'message' => 'Plant ID is Required',
    //                             ),
    //                             'data' => array(),
    //                         ];
    //                         return $this->response->setJSON($respData);

    //                     }
    //                     if (!$PN) {
    //                         $respData = [
    //                             'meta' => array(
    //                                 'code' => 412,
    //                                 'message' => 'Plant Name is Required',
    //                             ),
    //                             'data' => array(),
    //                         ];
    //                         return $this->response->setJSON($respData);

    //                     }
    //                     if (!$PD) {
    //                         $respData = [
    //                             'meta' => array(
    //                                 'code' => 412,
    //                                 'message' => 'Plant Description is Required',
    //                             ),
    //                             'data' => array(),
    //                         ];
    //                         return $this->response->setJSON($respData);

    //                     }
    //                     if (!$PM) {
    //                         $respData = [
    //                             'meta' => array(
    //                                 'code' => 412,
    //                                 'message' => 'Plant Image is Required',
    //                             ),
    //                             'data' => array(),
    //                         ];
    //                         return $this->response->setJSON($respData);

    //                     }

    //                     if (!$PP) {
    //                         $respData = [
    //                             'meta' => array(
    //                                 'code' => 412,
    //                                 'message' => 'Plant Price is Required',
    //                             ),
    //                             'data' => array(),
    //                         ];
    //                         return $this->response->setJSON($respData);

    //                     }
    //                     $postdata = array(

    //                         "plantName" => $PN,
    //                         "plantDescription" => $PD,
    //                         "plantImage" => $PM,
    //                         "plantPrice" => $PP,
    //                     );

    //                     $result = $this->PlantModel->updatePlantRecord($postdata, $PID);
    //                     // "StudentNo" => $SN,
    //                     if ($result == 1) {
    //                         $respData = [
    //                             'meta' => array(
    //                                 'code' => 200,
    //                                 'message' => 'Plant Record Successfully Updated',
    //                             ),
    //                             'data' => array(),
    //                         ];
    //                     } else {
    //                         $respData = [
    //                             'meta' => array(
    //                                 'code' => 500,
    //                                 'message' => $result,
    //                             ),
    //                             'data' => array(),
    //                         ];
    //                     }


    //                 } catch (\Exception $e) {
    //                     die($e->getMessage());
    //                 }

    //             } else {
    //                 $respData = [
    //                     'meta' => array(
    //                         'code' => 301,
    //                         'message' => 'Bad request. Plant ID, Plant Name, Plant Description, Plant Image, Plant Price is Required',
    //                     ),
    //                 ];
    //             }
    //         }

    //     } else if ($method == 'delete') {

    //         $postData = $this->request->getRawInput();

    //         if ($postData) {
    //             if (
    //                 isset($postData['PID'])

    //             ) {

    //                 try {
    //                     $PID = $postData['PID'];


    //                     if (!$PID) {
    //                         $respData = [
    //                             'meta' => array(
    //                                 'code' => 412,
    //                                 'message' => 'Plant ID is Required',
    //                             ),
    //                             'data' => array(),
    //                         ];
    //                         return $this->response->setJSON($respData);

    //                     }

    //                     $result = $this->PlantModel->deletePlantRecord($PID);
    //                     // "StudentNo" => $SN,
    //                     if ($result == 1) {
    //                         $respData = [
    //                             'meta' => array(
    //                                 'code' => 200,
    //                                 'message' => 'Plant Record Successfully Deleted',
    //                             ),
    //                             'data' => array(),
    //                         ];
    //                     } else {
    //                         $respData = [
    //                             'meta' => array(
    //                                 'code' => 500,
    //                                 'message' => $result,
    //                             ),
    //                             'data' => array(),
    //                         ];
    //                     }


    //                 } catch (\Exception $e) {
    //                     die($e->getMessage());
    //                 }

    //             } else {
    //                 $respData = [
    //                     'meta' => array(
    //                         'code' => 301,
    //                         'message' => 'Bad request. Plant ID, Plant Name, Plant Description, Plant Image, Plant Price is Required',
    //                     ),
    //                 ];
    //             }
    //         }

    //     }

    //     return $this->response->setJSON($respData);

    // }


    /*
public function index()
{
$data['student_info'] = $this-> StudentModel->getStudentInfo();
$data['Header'] = 'This is the new Header';
echo view ('template/header' , $data);
echo view ('student/index', $data);
echo view ('template/footer');
}
public function addRecord()
{   
$data['Title'] = "Add Student Record";
if($this->request->getMethod() == "post"){
$validation = \Config\Services::validation();
$rules = [
"txtSN" => [
"label" => "Student Number",
"rules" => "required"
],
"txtFN" => [
"label" => "First Name",
"rules" => "required|min_length[3]|max_length[20]"
],
"txtMN" => [
"label" => "Middle Name",
"rules" => "required|min_length[3]|max_length[20]"
],
"txtLN" => [
"label" => "Last Name",
"rules" => "required|min_length[3]|max_length[20]"
],
"cbSex" => [
"label" => "Sex",
"rules" => "required"
],
"txtDOB" => [
"label" => "Date of Birth",
"rules" => "required"
],
];
if($this->validate($rules)){
$postdata = array(
"StudentNo" => $this->request->getVar("txtSN"),
"FirstName" => $this->request->getVar("txtFN"),
"MiddleName" => $this->request->getVar("txtMN"),
"LastName" => $this->request->getVar("txtLN"),
"isMale" => $this->request->getVar("cbSex"),
"DateOfBirth" => $this->request->getVar("txtDOB"),
);
$result = $this-> StudentModel->insertStudentRecord($postdata);
if($result == 1){
return redirect()->to('Student');
}
}else{
$data["validation"] = $validation->getErrors();
}
}
$data['Title'] = 'ITEC 222 Title';
$data['Header'] = 'This is the new Header';
echo view ('template/header');
echo view ('student/addRecord' , $data);
echo view ('template/footer');
}
public function editRecord($StudentNo)
{   
$data['Title'] = "Add Student Record";
$data['student_info'] = $this-> StudentModel->getStudentInfoBySN($StudentNo);
if($this->request->getMethod() == "post"){
$validation = \Config\Services::validation();
$rules = [
"txtSN" => [
"label" => "Student Number",
"rules" => "required"
],
"txtFN" => [
"label" => "First Name",
"rules" => "required|min_length[3]|max_length[20]"
],
"txtMN" => [
"label" => "Middle Name",
"rules" => "required|min_length[3]|max_length[20]"
],
"txtLN" => [
"label" => "Last Name",
"rules" => "required|min_length[3]|max_length[20]"
],
"cbSex" => [
"label" => "Sex",
"rules" => "required"
],
"txtDOB" => [
"label" => "Date of Birth",
"rules" => "required"
],
];
if($this->validate($rules)){
$postdata = array(
"FirstName" => $this->request->getVar("txtFN"),
"MiddleName" => $this->request->getVar("txtMN"),
"LastName" => $this->request->getVar("txtLN"),
"isMale" => $this->request->getVar("cbSex"),
"DateOfBirth" => $this->request->getVar("txtDOB"),
);
$result = $this-> StudentModel->updateStudentRecord($postdata , $this->request->getVar("txtSN"));
if($result == 1){
return redirect()->to('Student');
}
}else{
$data["validation"] = $validation->getErrors();
}
}
$data['Title'] = 'ITEC 222 Title';
$data['Header'] = 'This is the new Header';
echo view ('template/header');
echo view ('student/editRecord' , $data);
echo view ('template/footer');
}
public function deleteRecord($StudentNo){
$result = $this->StudentModel->deleteStudentRecord($StudentNo);
if($result == 1){
return redirect()->to('Student');
}
}
*/
}
