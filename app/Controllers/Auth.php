<?php namespace App\Controllers;
use App\Models\UserModel;
class Auth extends BaseController
{
	public function loginUser()
	{
        $data=[];
        helper(['form']);

        if($this->request->getMethod() =="post"){
			$rules = [
				'email' =>'required|valid_email',
				'password'=>'required',
				
            ];

            $errors = [
				'password' => [
					'validateUser' => 'Email or Password don\'t match'
                ]
                
            ];
            if(!$this->validate($rules,$errors)){
            
                $data['validation'] = $this->validator; 
            }else{
                $model = new UserModel();

				$user = $model->where('email', $this->request->getVar('email'))->first();
				$this->sessionUser($user);
				return redirect()->to('index');
            }
        }

		return view('auths/login',$data);
    }


    private function sessionUser($user){

		$data = [
			'id' => $user['id'],
			'email' => $user['email'],
			'address' => $user['address'],
			'role' => $user['role'],
			'isLoggedIn' => true,
		];

		session()->set($data);
		return true;
	}

	public function registerUser()
	{
        $data=[];
        helper(['form']);

        if($this->request->getMethod() =="post"){
			$rules = [
				'email' =>'required|valid_email',
				'password'=>'required',
				'address'=>'required'
            ];
     
        if(!$this->validate($rules)){
            
				$data['validation'] = $this->validator; 
			}else{
                $user = new UserModel();
                $newData = [
					'email' =>$this->request->getVar('email'),
					'password' =>$this->request->getVar('password'),
                    'address' =>$this->request->getVar('address'),
                    'role' =>$this->request->getVar('role'),
                    
                ];
                $user->createUser($newData);
                $session = session();
				$session->setFlashdata('success', 'Successful Registration!!!');
				return redirect()->to('/');
            }
        }


		return view('auths/register',$data);


	//--------------------------------------------------------------------

}

}