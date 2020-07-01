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









	//--------------------------------------------------------------------

}