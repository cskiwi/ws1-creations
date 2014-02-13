<?php

/* layout.tpl */
class __TwigTemplate_75853ddfd5d426ee7f99a442a6af9c806a2dfc55951b5753b54d3acc223e6e4d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'pageStyle' => array($this, 'block_pageStyle'),
            'pageContent' => array($this, 'block_pageContent'),
            'pageFooter' => array($this, 'block_pageFooter'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!doctype html>
<html>
<head>
    <title>";
        // line 4
        echo twig_escape_filter($this->env, (isset($context["pageTitle"]) ? $context["pageTitle"] : null), "html", null, true);
        echo "</title>
    <style>
        ";
        // line 6
        $this->displayBlock('pageStyle', $context, $blocks);
        // line 15
        echo "    </style>
</head>
<body>
<h1>";
        // line 18
        echo twig_escape_filter($this->env, (isset($context["pageTitle"]) ? $context["pageTitle"] : null), "html", null, true);
        echo "</h1>
<div>
    ";
        // line 20
        $this->displayBlock('pageContent', $context, $blocks);
        // line 22
        echo "</div>
";
        // line 23
        $this->displayBlock('pageFooter', $context, $blocks);
        // line 26
        echo "</body>
</html>";
    }

    // line 6
    public function block_pageStyle($context, array $blocks = array())
    {
        // line 7
        echo "        div {
            padding-left: 1em;
            margin-left: 1em;
        }
        footer {
            text-align: center;
            padding-top: 2em; }
        ";
    }

    // line 20
    public function block_pageContent($context, array $blocks = array())
    {
        // line 21
        echo "    ";
    }

    // line 23
    public function block_pageFooter($context, array $blocks = array())
    {
        // line 24
        echo "    <footer>This is the footer</footer>
";
    }

    public function getTemplateName()
    {
        return "layout.tpl";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  80 => 24,  77 => 23,  73 => 21,  70 => 20,  59 => 7,  56 => 6,  51 => 26,  49 => 23,  46 => 22,  44 => 20,  39 => 18,  34 => 15,  32 => 6,  27 => 4,  22 => 1,);
    }
}
