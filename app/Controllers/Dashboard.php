<?php namespace App\Controllers;
use App\Models\PizzaModel;
class Dashboard extends BaseController
{
	public function index()
	{
		$pizzaModel = new PizzaModel();
		$data['pizzas']=$pizzaModel->findAll();
		return view('index',$data);
	}

	public function addPizza(){
		$data = [];
		if($this->request->getMethod() == "post"){
			helper(['form']);
			$rules = [
                'name'=>'required',
                'ingredient'=>'required',
				'price'=>'required|min_length[1]|max_length[50]',
				
				
			];

			  $errors = [
				'ingredient' => [
					'validateUser' => 'name,ingredient or price don\'t match'
                ]
                
			];
			
			// if(!$this->validate($rules,$errors)){
            
            //     $data['validation'] = $this->validator; 
            // }else{
            //     $model = new PizzaModel();

			// 	$user = $model->where('name', $this->request->getVar('name'))->first();
			// 	$this->sessionUser($user);
			// 	return redirect()->to('/index');
			// }

			

			
			
			

				$pizzaModel = new PizzaModel();
				$pizzaName = $this->request->getVar('name');	
				$pizzaIngredient = $this->request->getVar('ingredient');
				$pizzaPrice = $this->request->getVar('price')."$";
				$pizzaData = array(
					'name'=>$pizzaName,
					'price'=>$pizzaPrice,
					'ingredient'=>$pizzaIngredient,
				);
				$pizzaModel->insert($pizzaData);
				return redirect()->to('/index');
		}
		
	}

	public function deletePizza($id)
	{
		$pizzaModel = new PizzaModel();
		$pizzaModel ->delete($id);
		return redirect()->to('/index');
	}
		// edit pizza

		public function editPizza($id)
		{
			$model = new PizzaModel();
			$data['edit'] = $model->find($id);
			return view('index',$data);
		}
	
		// update pizza
	
		public function updatePizza()
		{
			$model = new PizzaModel();
			$model->update($_POST['id'],$_POST);
			return redirect()->to('/index');
		}


	








	//--------------------------------------------------------------------

}