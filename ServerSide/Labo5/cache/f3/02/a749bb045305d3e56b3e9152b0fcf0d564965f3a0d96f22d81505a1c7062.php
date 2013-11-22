<?php

/* edit.twig */
class __TwigTemplate_f302a749bb045305d3e56b3e9152b0fcf0d564965f3a0d96f22d81505a1c7062 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("layout.twig");

        $this->blocks = array(
            'javascript' => array($this, 'block_javascript'),
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
        $context["pageTitle"] = "Edit Item";
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_javascript($context, array $blocks = array())
    {
        // line 5
        echo "        <script src=\"js/edit.js\"></script>
    ";
    }

    // line 8
    public function block_pageContent($context, array $blocks = array())
    {
        // line 9
        echo "    <div class=\"box\" id=\"boxAddTodo\">

        ";
        // line 12
        echo "        <h2>Edit existing todo</h2>
        <div class=\"boxInner\">
            <form action=\"";
        // line 14
        echo twig_escape_filter($this->env, (isset($context["directTo"]) ? $context["directTo"] : null), "html", null, true);
        echo "\" method=\"post\">
                <fieldset>
                    <dl class=\"clearfix columns\">
                        <dd class=\"column column-46\"><input type=\"text\" name=\"what\" id=\"what\" value=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "what"), "html", null, true);
        echo "\" /></dd>
                        <dd class=\"column column-16\" id=\"col-priority\">
                            <select name=\"priority\" id=\"priority\">
                                ";
        // line 20
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["priorities"]) ? $context["priorities"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["prior"]) {
            // line 21
            echo "                                    <option value=\"";
            echo twig_escape_filter($this->env, (isset($context["prior"]) ? $context["prior"] : null), "html", null, true);
            echo "\"
                                            ";
            // line 22
            if (((isset($context["prior"]) ? $context["prior"] : null) == $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "priority"))) {
                // line 23
                echo "                                                selected
                                            ";
            }
            // line 25
            echo "                                            >";
            echo twig_escape_filter($this->env, (isset($context["prior"]) ? $context["prior"] : null), "html", null, true);
            echo "</option>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['prior'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 27
        echo "                            </select>
                        </dd>
                        <dd class=\"column column-16\" id=\"col-submit\">
                            <label for=\"btnSubmit\"><input type=\"submit\" id=\"btnSubmit\" name=\"btnSubmit\" value=\"Edit\" /></label>
                            <input type=\"hidden\" name=\"id\" value=\"";
        // line 31
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id"), "html", null, true);
        echo "\" />
                            <input type=\"hidden\" name=\"moduleAction\" id=\"moduleAction\" value=\"edit\" />
                        </dd>
                    </dl>
                </fieldset>
            </form>
            <p class=\"cancel\">or <a href=\"index.php\" title=\"Cancel and go back\">Cancel and go back</a></p>
        </div>
    </div>

    ";
        // line 42
        echo "    ";
        if ((isset($context["errors"]) ? $context["errors"] : null)) {
            // line 43
            echo "        <div class=\"box\" id=\"boxError\">
            <ul class=\"errors\">
                ";
            // line 45
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["errors"]) ? $context["errors"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 46
                echo "                    <li>";
                echo twig_escape_filter($this->env, (isset($context["error"]) ? $context["error"] : null), "html", null, true);
                echo "</li>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 48
            echo "            </ul>
        </div>
    ";
        }
        // line 51
        echo "
";
    }

    public function getTemplateName()
    {
        return "edit.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  130 => 51,  125 => 48,  116 => 46,  112 => 45,  108 => 43,  105 => 42,  92 => 31,  86 => 27,  77 => 25,  73 => 23,  71 => 22,  66 => 21,  62 => 20,  56 => 17,  50 => 14,  46 => 12,  42 => 9,  39 => 8,  34 => 5,  31 => 4,  26 => 3,);
    }
}
