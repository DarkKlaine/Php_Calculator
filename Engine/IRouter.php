<?php

namespace Engine;

interface IRouter
{
    public function handleRequest(): void;
}