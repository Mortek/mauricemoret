<?php
interface DataAccessObject
{
        
    function __construct($database);
    public function select($id);
    public function selectAll($id);
    public function add($object);
    public function edit($object);
    public function delete($id);

}
?>