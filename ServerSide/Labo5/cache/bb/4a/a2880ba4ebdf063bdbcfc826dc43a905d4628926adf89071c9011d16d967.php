<?php

/* layout.twig */
class __TwigTemplate_bb4aa2880ba4ebdf063bdbcfc826dc43a905d4628926adf89071c9011d16d967 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'javascript' => array($this, 'block_javascript'),
            'pageHeader' => array($this, 'block_pageHeader'),
            'pageContent' => array($this, 'block_pageContent'),
            'pageFooter' => array($this, 'block_pageFooter'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<!--[if lt IE 7 ]><html class=\"oldie ie6\" lang=\"en\"><![endif]-->
<!--[if IE 7 ]><html class=\"oldie ie7\" lang=\"en\"><![endif]-->
<!--[if IE 8 ]><html class=\"oldie ie8\" lang=\"en\"><![endif]-->
<!--[if IE 9 ]><html class=\"ie9\" lang=\"en\"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang=\"en\"><!--<![endif]-->
<head>

    <title>";
        // line 9
        echo twig_escape_filter($this->env, (isset($context["pageTitle"]) ? $context["pageTitle"] : null), "html", null, true);
        echo "</title>

    <meta charset=\"UTF-8\" />
    <meta name=\"viewport\" content=\"width=520\" />
    <meta http-equiv=\"cleartype\" content=\"on\" />
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\" />

    <!--[if lt IE 9]><script src=\"http://html5shiv.googlecode.com/svn/trunk/html5.js\"></script><![endif]-->

    <link rel=\"stylesheet\" media=\"screen\" href=\"css/reset.css\" />
    <link rel=\"stylesheet\" media=\"screen\" href=\"css/screen.css\" />

    ";
        // line 21
        $this->displayBlock('javascript', $context, $blocks);
        // line 22
        echo "
</head>
<body>
<div id=\"siteWrapper\">

    <!-- header -->
    ";
        // line 28
        $this->displayBlock('pageHeader', $context, $blocks);
        // line 31
        echo "
    <!-- content -->
    <div>
        <section>
            ";
        // line 35
        $this->displayBlock('pageContent', $context, $blocks);
        // line 38
        echo "        </section>
    </div>

    <!-- footer -->
    ";
        // line 42
        $this->displayBlock('pageFooter', $context, $blocks);
        // line 45
        echo "
</div>
</body>
</html>";
    }

    // line 21
    public function block_javascript($context, array $blocks = array())
    {
    }

    // line 28
    public function block_pageHeader($context, array $blocks = array())
    {
        // line 29
        echo "        <header><h1><a href=\"index.php\">";
        echo twig_escape_filter($this->env, (isset($context["pageTitle"]) ? $context["pageTitle"] : null), "html", null, true);
        echo "</a></h1></header>
    ";
    }

    // line 35
    public function block_pageContent($context, array $blocks = array())
    {
        // line 36
        echo "                <p>This should never be displayed!</p>
            ";
    }

    // line 42
    public function block_pageFooter($context, array $blocks = array())
    {
        // line 43
        echo "        <footer><p>&copy; 2013, <a href=\"http://www.ikdoeict.be/\" title=\"IkDoeICT.be\">IkDoeICT.be</a></p></footer>
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
        return array (  109 => 43,  106 => 42,  101 => 36,  98 => 35,  91 => 29,  88 => 28,  76 => 45,  66 => 35,  60 => 31,  58 => 28,  48 => 21,  33 => 9,  23 => 1,  170 => 72,  161 => 70,  157 => 69,  153 => 67,  150 => 66,  145 => 62,  140 => 59,  136 => 57,  127 => 54,  123 => 53,  119 => 52,  113 => 51,  110 => 50,  105 => 49,  103 => 48,  97 => 44,  83 => 21,  74 => 42,  70 => 27,  68 => 38,  63 => 25,  59 => 24,  50 => 22,  44 => 14,  42 => 13,  39 => 12,  34 => 7,  31 => 6,  26 => 3,);
    }
}
