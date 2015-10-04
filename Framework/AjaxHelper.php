<?php

namespace SCart;

class AjaxScriptViewHelper
{
    private $sourceId;
    private $ajaxElement;
    private $preventDefault;
    private $data;
    private $output;
    public function __construct()
    {
        $this->sourceId = "#";
        $this->ajaxElement = array();
        $this->preventDefault = false;
        $this->data = array();
        $this->output = "#";
        return new self();
    }
    public function render()
    {
        $data = "{\n";
        if (count($this->data) > 0) {
            foreach ($this->data as $key => $value) {
                $data .= "\t\t\t" . $key . ": " . $value . ",\n";
            }
        }
        $data .= "\t\t}\n";
        $result = "<script>\n";
        $result .= "$(\"" . $this->sourceId . "\").click(function(e) {\n";
        if($this->preventDefault) {
            $result .= "\te.preventDefault();\n";
        }
        $result .= "\t$.ajax({\n";
        if(count($this->ajaxElement) > 0) {
            foreach ($this->ajaxElement as $key => $value) {
                $result .= "\t\t" . $key . ":'" . $value . "',\n";
            }
        }
        $result .= "\t\tdata: " . $data;
        $result .= "\t}).done(function(data) {\n";
        $result .= "\t\t$(\"" . $this->output . "\").text(data);\n";
        $result .= "\t})\n";
        $result .= "});\n";
        $result .= "</script>";
        echo $result;
    }
    public function setSourceId($id)
    {
        $this->sourceId .= $id;
        return new self();
    }
    public function setPreventDefault()
    {
        $this->preventDefault = true;
        return new self();
    }
    public function setElement($key, $value)
    {
        $this->ajaxElement[$key] = $value;
        return new self();
    }
    public function setData($key, $value)
    {
        $this->data[$key] = $value;
        return new self();
    }
    public function setDestinationId($id)
    {
        $this->output .= $id;
        return new self();
    }
}