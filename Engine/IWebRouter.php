<?php

namespace Engine;

interface IWebRouter
{
    public function handleRequest(): void;
}