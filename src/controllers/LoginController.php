<?php

class LoginController extends BaseController
{
    public function listar(): void
    {
        $this->view("login");
    }

}