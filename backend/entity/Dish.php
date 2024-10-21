<?php

namespace Palmo\entity;

class Dish
{
    private string $name;
    private string $category;
    private string $area;
    private string $img;
    private string $description;

    public function __construct(string $name, string $category, string $area, string $img, string $description)
    {
        $this->name = $name;
        $this->category = $category;
        $this->area = $area;
        $this->img = $img;
        $this->description = $description;
    }

    public function getArea(): string
    {
        return $this->area;
    }

    public function setArea(string $area): void
    {
        $this->area = $area;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getImg(): string
    {
        return $this->img;
    }

    public function setImg(string $img): void
    {
        $this->img = $img;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

}