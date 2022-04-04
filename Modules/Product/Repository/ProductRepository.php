<?php
 namespace Modules\Product\Repository;

 use Modules\Product\Entities\Product;

 class ProductRepository
 {
    //Modoel property in class instance
    private $model;

    //constructor to bind Model to Repository
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    //Functions
    public function index()
        {
            return $this->model::all();
        }


        public function store($data)
        {
            try{
                $data = $this->model->create($data);
                return $data;
            }catch (\Exception $e) {
                return $e->getMessage();
            }
        }

        public function find($id)
        {
            return $this->model->find($id);
        }

        public function update($data)
        {
            try{
                $data = $this->model->updatw($data);
            }catch (\Exception $e){
                return $e->getMessage();
            }
        }

        public function destroy($id)
        {
            return $this->model->destroy($id);
        }
    
 }

