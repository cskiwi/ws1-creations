<?php

/* layout.twig */
class __TwigTemplate_b5f663422e779efe77e7277c9c2623d8e401fc39b337adf62de0dcbd063e6069 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'pageHeader' => array($this, 'block_pageHeader'),
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
    <meta charset=\"UTF-8\" />
    <link rel=\"stylesheet\" href=\"css/styles.css\" />
    <link rel=\"stylesheet\" href=\"css/forms.css\" />
    <link rel=\"stylesheet\" href=\"css/tooltips.css\" />
</head>
<body>
<!-- header -->
";
        // line 12
        $this->displayBlock('pageHeader', $context, $blocks);
        // line 15
        echo "
<!-- content -->
<div>
    <section>
        ";
        // line 19
        $this->displayBlock('pageContent', $context, $blocks);
        // line 22
        echo "    </section>
</div>

<!-- footer -->
";
        // line 26
        $this->displayBlock('pageFooter', $context, $blocks);
        // line 31
        echo "</body>
</html>";
    }

    // line 12
    public function block_pageHeader($context, array $blocks = array())
    {
        // line 13
        echo "    <header><h2>";
        echo twig_escape_filter($this->env, (isset($context["pageTitle"]) ? $context["pageTitle"] : null), "html", null, true);
        echo "</h2></header>
";
    }

    // line 19
    public function block_pageContent($context, array $blocks = array())
    {
        // line 20
        echo "            <p>This should never be displayed!</p>
        ";
    }

    // line 26
    public function block_pageFooter($context, array $blocks = array())
    {
        // line 27
        echo "    <footer>
        <p>Herhalingsoefening Webscripten 1, Serverside Webscripten, 2013</p>
    </footer>
";
    }

    public function getTemplateName()
    {
        return "layout.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  82 => 27,  79 => 26,  74 => 20,  71 => 19,  64 => 13,  61 => 12,  56 => 31,  54 => 26,  48 => 22,  46 => 19,  40 => 15,  38 => 12,  27 => 4,  22 => 1,);
    }
}
