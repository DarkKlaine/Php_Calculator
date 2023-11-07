<?php

namespace Engine\Controllers;

interface IAccessDeniedView
{
    public function render(): void;
}