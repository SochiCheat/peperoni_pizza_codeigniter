<?php namespace App\Models;
use CodeIgniter\Model;
class PizzaModel extends Model
{
    protected $table      = 'peperoni';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $allowedFields = ['name','ingredient' ,'price'];

    public function listPizza($user)
    {
        $this->insert([
                'name'=>$user['name'],
                'ingredient'=>$user['ingredient'],
                'price'=>$user['price'],
               
        
                
        ]);
    }


}


    
