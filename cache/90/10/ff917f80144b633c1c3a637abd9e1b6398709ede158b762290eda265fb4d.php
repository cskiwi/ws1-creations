<?php

/* dir.twig */
class __TwigTemplate_9010ff917f80144b633c1c3a637abd9e1b6398709ede158b762290eda265fb4d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("layout.twig");

        $this->blocks = array(
            'pageStyle' => array($this, 'block_pageStyle'),
            'pageContent' => array($this, 'block_pageContent'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        $context["pageTitle"] = "Directory listing";
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_pageStyle($context, array $blocks = array())
    {
        // line 6
        echo "    ";
        $this->displayParentBlock("pageStyle", $context, $blocks);
        echo "

    ul {list-style: none;}
";
    }

    // line 11
    public function block_pageContent($context, array $blocks = array())
    {
        // line 12
        echo "    <ul>
        <a href=\"index.php\">Home</a>
        <hr / >
        ";
        // line 15
        if ((isset($context["dirs"]) ? $context["dirs"] : null)) {
            // line 16
            echo "            ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["dirs"]) ? $context["dirs"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["dir"]) {
                // line 17
                echo "                <li>
                    <a href=\"?page=";
                // line 18
                echo twig_escape_filter($this->env, (isset($context["dir"]) ? $context["dir"] : null), "html", null, true);
                echo "\"> ";
                echo twig_escape_filter($this->env, (isset($context["dir"]) ? $context["dir"] : null), "html", null, true);
                echo "</a>
                </li>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['dir'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 21
            echo "        ";
        }
        // line 22
        echo "        ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["files"]) ? $context["files"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["file"]) {
            // line 23
            echo "            <li>
                <a href=\"";
            // line 24
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["file"]) ? $context["file"] : null), "location"), "html", null, true);
            echo "\"> ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["file"]) ? $context["file"] : null), "name"), "html", null, true);
            echo "</a>
            </li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['file'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 27
        echo "    </ul>
";
    }

    public function getTemplateName()
    {
        return "dir.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  94 => 27,  83 => 24,  80 => 23,  75 => 22,  72 => 21,  61 => 18,  58 => 17,  53 => 16,  51 => 15,  46 => 12,  43 => 11,  34 => 6,  31 => 5,  26 => 3,);
    }
}
