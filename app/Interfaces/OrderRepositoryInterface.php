<?php


namespace App\Interfaces;


interface OrderRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function create(array $data);
    public function update(array $data, $id, $attribute = "id");
    public function delete($id);
    public function paginate($perPage = 15, $columns = array('*'));
    public function getByIdWith(int $orderId, array|string $relation);
}
