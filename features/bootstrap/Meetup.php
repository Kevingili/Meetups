<?php
/**
 * Created by PhpStorm.
 * Date: 04/02/2018
 * Time: 23:35
 */

final class Meetup
{
    private $title;
    private $datebegin;
    private $dateend;
    private $description;

    public function __construct()
    {

    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDatebegin()
    {
        return $this->datebegin;
    }

    public function setDatebegin($datebegin)
    {
        $this->datebegin = $datebegin;
    }

    public function getDateend()
    {
        return $this->dateend;
    }

    public function setDateend($dateend)
    {
        $this->dateend = $dateend;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function isMeetupOk(){
        if (
            trim($this->title) != "" &&
            $this->description != "" &&
            $this->datebegin != "" &&
            $this->dateend != "" &&
            strtotime($this->dateend) != "" &&
            strtotime($this->datebegin) != "" &&
            strtotime($this->dateend) > strtotime($this->datebegin)

        ){
            return true;
        }
        return false;
    }

}