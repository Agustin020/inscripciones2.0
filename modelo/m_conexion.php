<?php
class Conexion
{

    protected $link;

    public function Conexion()
    {
        try {
            $this->link = new mysqli("localhost", "id19276062_root", "Proyecto2022.", "id19276062_inscripciones");
        } catch (Exception $e) {
            die('Error' . $e->getMessage());
        }
        return $this->link;
    }
}
