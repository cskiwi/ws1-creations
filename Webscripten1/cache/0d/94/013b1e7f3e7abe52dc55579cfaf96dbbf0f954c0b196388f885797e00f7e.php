<?php

/* layout.tpl */
class __TwigTemplate_0d94013b1e7f3e7abe52dc55579cfaf96dbbf0f954c0b196388f885797e00f7e extends Twig_Template
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
        // line 9
        echo "    </style>
</head>
<body>
<h1>";
        // line 12
        echo twig_escape_filter($this->env, (isset($context["pageTitle"]) ? $context["pageTitle"] : null), "html", null, true);
        echo "</h1>
<div>
    ";
        // line 14
        $this->displayBlock('pageContent', $context, $blocks);
        // line 16
        echo "</div>
";
        // line 17
        $this->displayBlock('pageFooter', $context, $blocks);
        // line 20
        echo "</body>
</html>";
    }

    // line 6
    public function block_pageStyle($context, array $blocks = array())
    {
        // line 7
        echo "        div { padding-left: 1em; margin-left: 1em; border-left: 0.125em solid #666;}
        ";
    }

    // line 14
    public function block_pageContent($context, array $blocks = array())
    {
        // line 15
        echo "    ";
    }

    // line 17
    public function block_pageFooter($context, array $blocks = array())
    {
        // line 18
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
        return array (  74 => 18,  71 => 17,  67 => 15,  64 => 14,  59 => 7,  56 => 6,  51 => 20,  49 => 17,  46 => 16,  44 => 14,  39 => 12,  34 => 9,  32 => 6,  27 => 4,  22 => 1,);
    }
}
