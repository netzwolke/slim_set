<?php


namespace App\Interfaces;


use Psr\Http\Message\ResponseInterface;



interface Controller
{

    public function create() : ResponseInterface;

    public function store() : ResponseInterface;

    public function edit() : ResponseInterface;

    public function update() : ResponseInterface;

    public function delete() : ResponseInterface;
}